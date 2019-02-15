<?

class DS_Loader
{
	public $soulEngine;
	public $config;
	public $exeName;
	public $temdDir;
	public $startTime;
	public $formsData;
	public $isStart = false;
	private $checks = array();

	static public function InitLoader($no_load = false)
	{
		global $LOADER;
		if (!$LOADER && !$no_load) {
			$LOADER = new DS_Loader();
		}
	}

	public function __construct()
	{
		global $LOADER;
		$LOADER = $this;
		$this->initVars();

		if (!$this->loadSE()) {
			gui_message("FATAL ERROR OF LOADING");
			return NULL;
		}

		DS_Loader::InitLoader();
		$this->loadModules();
		$this->loadOptions();
		DSApi::__doStartBeforeFunc();
		$this->loadForms();
		DSApi::__doStartFunc();
		$this->startApp();
	}

	public function InitVars()
	{
		srand();
		$GLOBALS['APP_DESIGN_MODE'] = false;
		$this->tmpDir = win_tempdir();
		$this->exeName = param_str(0);
		$this->startTime = microtime(1);
		chdir(dirname($this->exeName));
		enc_setvalue('__incCode', 'global $APPLICATION, $SCREEN, $_c, $progDir, $_PARAMS, $argv;');
	}

	public function LoadSE()
	{
		$this->soulEngine = exemod_extractstr('$soulEngine');
		if (!$this->soulEngine && file_exists(dirname(param_str(0)) . '/soulEngine.pak')) {
			$this->soulEngine = file_get_contents(dirname(param_str(0)) . '/soulEngine.pak');
		}

		if (!$this->soulEngine) {
			application_messagebox('soulEngine: fatal error of loading', 'System Error', 16);
			application_terminate();
			exit();
		}

		eval( gzuncompress($this->soulEngine));
		
		$this->soulEngine = '';
		return true;
	}

	public function LoadModules()
	{
		$modules = gzuncompress(exemod_extractstr('$X_MODULES'));
		eval( '?>' . $modules);
		$modules = unserialize( gzuncompress(exemod_extractstr('$X_S')) );

		if( is_array($modules) )
		{
			foreach($modules as $s)
			{
				eval($s);
			}
		}
		unset($modules,$s,$e);
	}

	public function LoadOptions()
	{
		global $__config;
		$__config = unserialize(base64_decode(exemod_extractstr('$X_CONFIG')));
		$this->config = $__config['config'];
		$__config['formsInfo'] = array_change_key_case($__config['formsInfo'], 0);
		
		if (param_str(2)) {
			if($this->config['debug']['enabled'] )
				define('DEBUG_OWNER_WINDOW', param_str(2));
			
			Receiver::send(param_str(2), array('RECEIVER_HANDLE'=>receiver_handle()));
		}

		define('ERROR_NO_WARNING', (bool) $this->config['debug']['no_warnings']);
		define('ERROR_NO_ERROR', (bool) $this->config['debug']['no_errors']);
	}

	public function CreateForm($name, $load_events = true, $new_name = '')
	{
		$name = strtolower($name);

		if ($this->formsData[$name]) {
			$form = _c(dfm_read('', false, $this->formsData[$name]));
			$form->formStyle = fsNormal;

			if ($new_name) {
				$form->name = $new_name;
			}
			else {
				$form->name = '';
			}

			if ($load_events) {
				DSApi::initEvent($form, $name);
			}

			DSApi::initFormEx($form, $name);
			return $form;
		}
		else {
			return NULL;
		}
	}

	public function LoadForm($name)
	{
		global $_FORMS;
		$name = strtolower($name);

		if ($_FORMS[$name]) {
			return $_FORMS[$name];
		}

		$_FORMS[$name] = $this->CreateForm($name, true, $name);

		if ($_FORMS[$name]) {
			return $_FORMS[$name];
		}
		else {
			unset($_FORMS[$name]);
			return NULL;
		}
	}

	public function LoadForms()
	{
		$formsData = unserialize(gzuncompress(exemod_extractstr('$F\\Xforms')));
		if( empty($formsData) ) return;
		$this->formsData = array_change_key_case($formsData);
		eventEngine::$DATA = unserialize(gzuncompress(exemod_extractstr('$_EVENTS')));
		global $_FORMS;
		global $__config;
		$i = -1;

		foreach ($formsData as $form => $data) {
			$i++;
			$form = strtolower($form);
			if ($i && $__config['formsInfo'][$form]['noload']) {
				continue;
			}

			$_FORMS[$form] = _c(dfm_read('', false, $data, $form));
			$_FORMS[$form]->formStyle = fsNormal;

			if ($i == 0) {
				gui_formsetmain($_FORMS[$form]->self);

				if ($this->config['apptitle']) {
					$GLOBALS['APPLICATION']->title = $this->config['apptitle'];
				}
			}

			$_FORMS[$form]->name = $form;
			DSApi::initEvent($_FORMS[$form]);
		}

		global $mainForm;
		$mainForm = current(&$_FORMS);
		$mainFormName = strtolower(key(&$_FORMS));
		DSApi::initFormEx($mainForm, $mainFormName);
	}

	public function SetMainForm(TForm $form)
	{
		global $mainForm;
		global $mainFormName;
		$mainForm = $form;
		$mainFormName = $form->name;
		gui_formsetmain($form->self);
	}

	public function StartApp()
	{
		global $APPLICATION;
		global $_FORMS;
		global $mainForm;

		switch ($this->config['prog_type']) {
		case 1:
			$tmp = new TForm();
			gui_formsetmain($tmp->self);
			$tmp->hide();
			$APPLICATION->mainFormOnTaskBar = false;

			if ($mainForm) {
				$mainForm->show();
			}

			break;

		case 2:
			$APPLICATION->mainFormOnTaskBar = false;
			break;

		default:
			if ($mainForm) {
				$mainForm->show();
			}

			break;
		}

		if ($mainForm) {
			$mainFormName = $mainForm->name;
		}

		if ($this->config['prog_type'] !== 2) {
			foreach ($_FORMS as $form => $data) {
				if ($mainFormName !== $form) {
					DSApi::initFormEx($data, $form);
				}
			}
		}

		$this->isStart = true;
	}
}
	
if ( !( $globals['LOADER'] = new DS_Loader ) )
{
	die();
}