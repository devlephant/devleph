<?php

class myCompile
{
	static public $codes;
	
	static public function setStatus($type, $text, $color = clGray)
	{
		$list = c('fmMain->debugList');
		
		if (!$text) return NULL;
		if($type=='')$list->text .= '['.t('Info').'] ' . $text;	
			else $list->text .= '[' . t($type) . '] ' . $text;
		switch($type)
		{
			case 'Info':			
				$list->setitemfontcolor($list->items->count-1, 3552822);
				break;
			case 'Error':
				$list->setitemfontcolor($list->items->count-1, 8421631);
				break;
			case 'Success':
				$list->setitemfontcolor($list->items->count-1, 0x00FF8000);
				break;
			case 'Warning':
				$list->setitemfontcolor($list->items->count-1, 46312);
				break;
			case 'Project':
				$list->setitemfontcolor($list->items->count-1, 7119482);
				break;
			case '':
				$list->setitemfontcolor($list->items->count-1, 3552822);
				break;
			default:
				$list->setitemfontcolor($list->items->count-1, $color);
				break;
		}
		$list->itemIndex = $list->items->count-1;	
	}
	static public function addStatus($type, $text, $color = clGray)
	{
		$list = c('fmMain->debugList');
		
		if (!$text) return NULL;
		
		if($type=='')$list->text .= '['.t('Info').'] ' . $text;	
			else $list->text .= '[' . t($type) . '] ' . $text;
		switch($type)
		{
			case 'Info':			
				$list->setitemfontcolor($list->items->count-1, 3552822);
				break;
			case 'Error':
				$list->setitemfontcolor($list->items->count-1, 8421631);
				break;
			case 'Success':
				$list->setitemfontcolor($list->items->count-1, 0x00FF8000);
				break;
			case 'Warning':
				$list->setitemfontcolor($list->items->count-1, 46312);
				break;
			case 'Project':
				$list->setitemfontcolor($list->items->count-1, 7119482);
				break;
			case 'Debug':
				$list->setitemfontcolor($list->items->count-1, 13762770);
				break;
			case '':
				$list->setitemfontcolor($list->items->count-1, 3552822);
				break;
			default:
				$list->setitemfontcolor($list->items->count-1, $color);
				break;
		}
		$list->itemIndex = $list->items->count-1;	
	}
	
	static public function addCompileCode($code)
	{
		self::$codes[] = $code;
	}

	static public function callModifers($check = false)
	{
		global $projectFile;
		$arr = myProject::getFormsObjects();

		foreach ($arr as $form => $objs) {
			foreach ($objs as $obj) {
				$class = 'modifer_' . $obj['CLASS'];

				if (class_exists($class,false)) {
					if ($check) {
						if (method_exists($class, 'listEvent')) {
							$tmp = new $class();
							$listEvent = $tmp->listEvent();

							foreach (eventEngine::$DATA[strtolower($form)][strtolower($obj['NAME'])] as $event => $code) {
								if (!in_array($event, $listEvent)) {
									unset(eventEngine::$DATA[strtolower($form)][strtolower($obj['NAME'])]);
								}
							}

							unset($tmp);
						}
					}
					else if (method_exists($class, 'toResult')) {
						$tmp = new $class();
						$tmp->toResult($form, $obj['NAME'], $obj, eventEngine::$DATA[strtolower($form)][strtolower($obj['NAME'])]);
						unset($tmp);
					}
				}
			}
		}
	}

	static public function generateIncFile()
	{
		global $projectFile, $exten_dir;
		$inc = file_get_contents(SYSTEM_DIR . '/project_parts/inc.php');
		exemod_addstr('$PHPSOULENGINE\\inc.php', $inc);

		global $myProject;
		$modules = [];
		
		foreach ((array) $myProject->config['modules'] as $mod) {
			if (file_exists(dirname(EXE_NAME) . $exten_dir . $mod)) {
				$modules[] = $mod;
			}
		}

		exemod_addstr('$PHPSOULENGINE\\mods', implode(',', $modules));
	}
	
	static public function checkisext(array $n)
	{
		foreach($n as $r)
			if( substr($r, 0, 4) == 'php_' && (substr($r, -4)=='.dll'||substr($r, -3)=='.so'))
				return $r;
		return false;
	}
	
	static public function generatePHP_Ini($moveext = true)
	{
		global $myProject,$projectFile,$exten_dir;
		
		if(!file_exists(dirname($projectFile).'/c_php.ini')) copy( dirname(EXE_NAME) . '/core/c_php.ini', dirname($projectFile).'/c_php.ini');
			$php_ini = file_get_contents(dirname($projectFile).'/c_php.ini');
		$myProject->config['modules'] = array_unique($myProject->config['modules']);
		$str = '';
		$already = [];
		if( !empty((array)$myProject->config['modules']) )
		{
			foreach ($myProject->config['modules'] as $mod) {
				if (file_exists(dirname(EXE_NAME) . $exten_dir . $mod))
				{
					if(!empty($already) && in_array($mod, $already)) continue;
					if(isset($GLOBALS['MODULES_INFO'][$mod]) && ($a = self::checkisext($GLOBALS['MODULES_INFO'][$mod])) && $a)
					{
						$str .=  ((isset($GLOBALS['MODULES_INFO'][$a]) && in_array(' Z', $GLOBALS['MODULES_INFO'][$a]))?
								'zend_extension':'extension=') . $a . "\n";
						$already[] = $a;
					}
					$str .= ((isset($GLOBALS['MODULES_INFO'][$mod]) && in_array(' Z', $GLOBALS['MODULES_INFO'][$mod]))?
							'zend_extension':'extension=') . $mod . "\n";
				}
			}
			
			$php_ini = ($moveext)?str_ireplace('; %_modules_% ;', $str, $php_ini):
			preg_replace("#extension_dir=\"\S+\"|extension_dir\s+=\s+\"\S+\"|extension_dir\s+=\"\S+\"|extension_dir=\s+\"\S+\"#i", 'extension_dir="' . dirname(EXE_NAME) . $exten_dir . '"',
			str_ireplace('; %_modules_% ;', $str, $php_ini));

		}
		
		return $php_ini;
	}

	static public function attachPHPEngine($path = false, $attach_ini = false)
	{
		global $projectFile;

		if (!$path) {
			$path = dirname($projectFile);
		}

		$ini = self::generatePHP_Ini($attach_ini);
		
		if ($attach_ini) {
			exemod_addstr('$PHPSOULENGINE\\php.ini', $ini);
		} else {
			file_put_contents($path . '/php.ini', $ini);
		}
		self::copyPHPts(false);
		exemod_addstr('$PHPSOULENGINE\\info', serialize(
		['version'	=> DV_VERSION,
		'year'		=> DV_YEAR,
		'prefix'	=> DV_PREFIX,
		]
		));
	}

	static public function getVersion()
	{
		return DV_VERSION.DV_PREFIX.DV_YEAR;
	}

	static public function attachPHPSoulEngine($attach = true)
	{
		global $projectFile;
		$build = new DS_BuildSoulEngine(dirname(EXE_NAME) . '/core/');

		if ($attach) {
			$str = $build->SaveToFile(false);
			exemod_addstr('$soulEngine', $str);
		}
		else {
			$str = $build->SaveToFile(dirname($projectFile) . '/soulEngine.pak');
		}
	}

	static public function attachResources($dir = false)
	{
		global $projectFile;

		if (!$dir) {
			$dir = dirname($projectFile) . '/data/';
		}


		$files = findFiles($dir, NULL, true, true);
		$aliases = [];

		foreach ($files as $file) {
			$file = str_replace($dir . '/', '', $file);
			$alias = str_replace('//', '/', '$RES$' . replaceSl($file));
			$aliases[] = $alias;
			exemod_addfile($alias, $dir . '/' . $file);
		}

		exemod_addstr('$RESLIST$', serialize($aliases));
	}

	static public function attachModules($attach_dll = false)
	{
		global $exten_dir, $projectFile;
		self::callModifers();
		$md5s = [];
		$dir = SYSTEM_DIR . '/project_parts/include/';
		$files = findFiles($dir, 'php', false, true);

		if ($GLOBALS['DEBUG_MODE']) {
			$files = array_merge($files, findFiles($dir . 'debug/', 'php', false, true));
		}

		$str = '';
		$modules = myModules::getInc();

		foreach ($modules as $mod) {
			$mod = str_replace('.dll', '', $mod);

			if (file_exists(dirname(EXE_NAME) . $exten_dir . $mod . '.php')) {
				$files[] = dirname(EXE_NAME) . $exten_dir . $mod . '.php';
			}

			if (file_exists(dirname(EXE_NAME) . $exten_dir . $mod . '.phpe2')) {
				$files[] = dirname(dirname(EXE_NAME) . $exten_dir . $mod . '.phpe2');
			}
		}
        
       

		$files = array_merge($files, myModules::getPHPModules());

		foreach ($files as $i => $file) {
			if (fileExt($file) == 'phpe2') {
				$addstr = myXVer::unPack(file_get_contents($file));
				$md5s[] = md5($addstr);
				$str .= $addstr;
			}
			else {
				$addstr = trim(file_get_contents($file));
				$md5s[] = md5($addstr);
				$str .= $addstr;
			}

			if (($str[strlen($str) - 2] . $str[strlen($str) - 1]) !== '?>') {
				$str .= '?>';
			}
		}

		foreach ((array) self::$codes as $code) {
			$str .= '<? ' . $code . ' ?>';
		}
		
		$str = php_strip_whitespace_ex($str);
		exemod_addstr('$X_MODULES', base64_encode($str));
		$files = findFiles( dirname($projectFile).'/scripts/', 'php' );	
		if(!empty($files))
		{
			foreach ($files as $file)
			{
				$addstr = trim( file_get_contents( dirname($projectFile).'/scripts/'.$file ) );
				$md5 = md5($addstr);
				$addstr = php_strip_whitespace_ex($addstr);
				if(stripos($addstr, '<?')==false)
				{
					$addstr = substr($addstr, stripos($addstr,'<?')+2);

					if( strtolower(substr($addstr, 0, 3)) === 'php' )
						$addstr = substr($addstr, 5);
				}
			while( substr($addstr, strlen($addstr)-2) === '?>' )
			{
				$addstr = substr($addstr, 0, strlen($addstr)-2);
			}
				if( !in_array($md5, $md5s) )
				{
					$esc[] = $addstr;
					$md5s[] = $md5;
				}
			}	
		}
		if( empty($esc) )
		{
			exemod_addstr('$X_S', base64_encode(serialize(false)));
		}
		else
		{
			exemod_addstr('$X_S', base64_encode(serialize($esc)));
		}
		
		self::$codes = [];
	}

	static public function attachForms($attachData = false)
	{
		global $_FORMS;
		global $projectFile;
		global $myProject;
		exemod_addstr('$X_FORMS', implode(_BR_, $_FORMS));

		$info['formsInfo'] = $myProject->formsInfo;
		$myProject->config['attachData'] = $attachData;
		$info['config'] = $myProject->config;
		exemod_addstr('$X_CONFIG', base64_encode(serialize($info)));


		foreach ($_FORMS as $name) {
			$str = file_get_contents(dirname($projectFile) . '/' . $name . '.dfm');
			$str = str_replace('fsMDIChild', 'fsNormal', $str);
			$data[$name] = $str;
		}

		self::callModifers(true);

			$compileDATA = eventEngine::$DATA;

		exemod_addstr('$_EVENTS', base64_encode(gzcompress(serialize($compileDATA),5)));
		exemod_addstr('$F\\Xforms', base64_encode(gzcompress(serialize($data),5)));
	}

	static public function getExeModule()
	{
		return EXE_NAME;

		if (DS_DEBUG_MODE === true) {
			return EXE_NAME;
		}

		if (file_exists(EXE_NAME . '.small')) {
			$result = EXE_NAME . '.small';
		}
		else {
			$result = EXE_NAME;
		}

		return $result;
	}

	static public function _start($check = true, $sstrs = false)
	{
		global $projectFile, $exten_dir, $ProjectProc;
		if(file_exists(dirname($projectFile).'/c_php.ini')){
			$scl = parse_ini_file(dirname($projectFile).'/c_php.ini');
			$exten_dir = str_replace(array('.\\', '\\'), '/', $scl['extension_dir']);
		}
		
		global $myProject;
		myUtils::saveForm();
		myDesign::szRefresh();
		$startTime = microtime(1);
		self::setStatus('', t('Starting Project') . '...');

		$php_dir = dirname(replaceSl(EXE_NAME)) . '/php/';
		$p_dir = dirname($projectFile) . '/php/';
		$exeFile = dirname($projectFile) . '/' . basenameNoExt($projectFile) . '.exe';
		
		if (file_exists($exeFile)) {
			if(	$ProjectProc <>0 )
			{
				exec('taskkill /pid '.$ProjectProc.' /T /F');
				$ProjectProc = 0;
			}
			unlink($exeFile);
			if ($check && file_exists($exeFile))
			{
				sleep(1);
				return self::_start(false);
			}
			if (file_exists($exeFile)) {
				self::setStatus('Error', t(
				(DS_DEBUG_MODE)?
				'Project file is busy, let\'s try again':
				'Project file is busy, try to stop his process') . '!');
				message_beep(MB_ICONERROR);
				return false;
			}
		}

		x_copy(self::getExeModule(), $exeFile);
		exemod_finish();
		exemod_start($exeFile);
		self::generateIncFile();
		myModules::inc(false,true,true);
		self::attachPHPEngine(false, false);
		self::attachPHPSoulEngine(false);
		self::attachForms(false);
		self::attachModules();
		exemod_save();
		exemod_finish();
		$fileIco = myVars::get('__iconFile');
		
		winRes::changeIcon($exeFile, (file_exists($fileIco)?$fileIco:SYSTEM_DIR . '/project_parts/project.ico'));
		
		$vtime = round( microtime(1) - $startTime, 1 );
		$vtime = $vtime>=60? round($vtime/60,1).t('min.'): $vtime.t('sec.');
		self::setStatus('Success', t('Start Finished for') . ' ' . $vtime );
		unset($_e, $vtime);
		shell_execute(0, 'open', replaceSr($exeFile), ' -c ' . receiver_handle(), replaceSr(dirname($exeFile)), SW_SHOW);
		myDesign::szRefresh();
		dsErrorDebug::ErrStatus($_e);
	}

	static function checkphp($file)
	{
		if( file_exists($file) )
		if( filesize($file) === filesize(dirname(DOC_ROOT).'/php5ts.dll') )
			return true;
		return false;
	}

	static public function copyPHPts($to)
	{
		global $projectFile;
		$php_dir = dirname(replaceSl(EXE_NAME)) . '/';

		if (!$to) {
			$p_dir = dirname($projectFile) . '/';
		}
		else {
			$p_dir = $to . '/';
		}

		if (!is_dir($p_dir)) {
			mkdir($p_dir, 511, true);
		}

		$m = 0;

		if (!self::checkphp(($p_dir . 'php5ts.dll')))
		copy($php_dir . 'php5ts.dll', $p_dir . 'php5ts.dll');
		
		return $p_dir . 'php5ts.dll';
	}

	static public function start($back = true, $debug = false)
	{
		global $DEBUG_MODE, $myProject;
		$DEBUG_MODE = $debug;

		if (!mySyntaxCheck::checkProject()) {
			return NULL;
		}
		myUtils::saveForm();
		if ($back) {
			$GLOBALS['APPLICATION']->processMessages();
			self::_start(false);
		}
		else {
			self::_start(false);
		}
	}

	static public function adv_start($fileExe, $attachPHP = true, $attachSE = true, $attachData = true, $UPXLevel = 0, $companyName = '', $version = '', $desc = '', 
	$cabin = false,
	$fileIco = '')
	{
		$startTime = microtime(1);
		global $myProject;
		self::setStatus('', t('Building Project') . '...');
		$debug_enabled = $myProject->config['debug']['enabled'];
		$myProject->config['debug']['enabled'] = false;
		myUtils::saveForm();
		$fileExe = replaceSl($fileExe);
		$dir = dirname($fileExe);
		if (file_exists($fileExe)) {
			unlink($fileExe);
			if( is_file($dir . '/php5ts.dll') )
				unlink($dir . '/php5ts.dll');
		}

		if (!is_dir($dir)) {
			mkdir($dir, 511, true);
		}

		$_e = dsErrorDebug::ErrStatus(false);
		dsErrorDebug::clearErr();
		x_copy(self::getExeModule(), $fileExe);
		
		if (dsErrorDebug::getLastMsg()) {
			self::setStatus('Warning', t('Selected directory is inaccessible') . '!');
			$myProject->config['debug']['enabled'] = $debug_enabled;
			return false;
		}

		
		if (!file_exists($fileIco)) {
			$fileIco = SYSTEM_DIR . '/project_parts/project.ico';
		}

		if (file_exists($fileIco)) {
			$x=0;
			while (!is_writable($fileExe)) {
				$x++;
				if($x>30)
				{
					self::setStatus('Error', t(
					(DS_DEBUG_MODE)?
					'Project file is busy, let\'s try again':
					'Project file is busy, try to stop his process') . '!');
					message_beep(MB_ICONERROR);
					return false;
				}
			}
		}
		$p_dir = false;
		self::copyPHPts($dir);
		exemod_finish();
		exemod_start($fileExe);
		exemod_addstr('$PHPSOULENGINE\\inc.php', self::generateIncFile());
		self::attachPHPEngine($p_dir, true);
		if( $cabin )
			$res1 = myModules::inc($fileExe);
		else 
			myModules::inc($fileExe);

		if ($attachSE) {
			self::attachPHPSoulEngine($attachSE);
			
			$x=0;
			while (!is_writable($fileExe)) {
				$x++;
				if($x>30)
				{
					self::setStatus('Error', t(
					(DS_DEBUG_MODE)?
					'Project file is busy, let\'s try again':
					'Project file is busy, try to stop his process') . '!');
					message_beep(MB_ICONERROR);
					return false;
				}
			}
		}
		else {
			self::setStatus('Error', t('Fatal error of project compiling') . '!');
			x_copy(DOC_ROOT . '/project_parts/soulEngine.pak', $dir . '/soulEngine.pak');
		}

		self::attachForms($attachData);
		self::attachModules();

		if ($attachData) {
			self::attachResources();
		}
		if( $cabin)
			$res1 = array_merge($res1, myModules::inc($fileExe, $attachPHP) );
		else
			myModules::inc($fileExe, $attachPHP);
		$x = 0;
		exemod_save();
		exemod_finish();

		winRes::changeIcon($fileExe, $fileIco);
		/*
		winRes::changeVersion($fileExe, $version);
		winRes::changeInfo($fileExe, 'ProductVersion', $version, $version);
		winRes::changeInfo($fileExe, 'FileVersion', $version, $version);
		if( strlen(trim($companyName)) <= 0 ) $companyName = "Example Company";
		winRes::changeInfo($fileExe, 'Copyright', $version, $companyName . " (c)" . date("Y"));
		//*/
		if( $UPXLevel > 0 )
		{
			myUPX::compress($fileExe, $UPXLevel);
			myUPX::compress($dir.'/php5ts.dll', $UPXLevel);
		}
		if( $cabin )
			foreach($res1 as $dll)
			myUPX::compress($dll, $UPXLevel);
		$res = null;
		$vtime = round( microtime(1) - $startTime, 1 );
		$vtime = $vtime>=60? round($vtime/60,1).t('min.'): $vtime.t('sec.');
		self::setStatus('Success', t('Building Completed') . '. ( '.$vtime.' )');

		dsErrorDebug::ErrStatus($_e);
		$myProject->config['debug']['enabled'] = $debug_enabled;
		
		return true;
	}

	public function generateEventsClasses($DATA)
	{
		$code = '<? /* autocode from DS Compiler */' . _BR_ . _BR_ . _BR_;
		$rDATA = [];
		$classes = [];

		foreach ($DATA as $form => $objs) {
			if ($form[0] == '-') {
				continue;
			}

			foreach ($objs as $name => $eventList) {
				if (count($eventList)) {
					foreach ($eventList as $event => $icode) {
						if (trim($icode)) {
							if (!in_array('__ev_' . $form . '_' . $name, $classes)) {
								$code .= 'class __ev_' . $form . '_' . $name . '{' . _BR_;
							}

							$rDATA[$form][$name][$event] = '__ev_' . $form . '_' . $name . '::' . $event;
							$code .= '  static function ' . $event . '(' . DSApi::getEventParams($event) . '){' . _BR_;
							$code .= '    eval($GLOBALS["__incCode"]); ' . _BR_;
							$code .= '    ' . $icode . _BR_;
							$code .= '  }' . _BR_;

							if (!in_array('__ev_' . $form . '_' . $name, $classes)) {
								$code .= '}' . _BR_ . _BR_;
							}

							$classes[] = '__ev_' . $form . '_' . $name;
						}
					}
				}
			}
		}

		array_unique($classes);
		return array('code' => $code, 'rDATA' => $rDATA, 'classes' => $classes);
	}
}