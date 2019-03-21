<?

/* эмуляция загрузки проекта в программу, как работающую...*/
    
    enc_setValue('__incCode', 'global $APPLICATION, $SCREEN, $_c, $progDir, $_PARAMS, $argv;');
    $GLOBALS['__evalProject_md5scripts'] = [];
    
class evalProject {
    
    public $forms;
    public $config;
    public $formsInfo;
    public $rand;
    
    public $dvs_dir;
    
    public function __construct(){
        
        $this->rand = rand(0, 9999999999);
        $this->dvs_dir = TEMP_DIR .'/devels/'. $this->rand . '/';
    }
    
    public function loadDVS($file, $to_show = false){
        
        $GLOBALS['APP_DESIGN_MODE'] = false;
        
        
        if (EMULATE_DVS_EXE)
        if (!is_file($file))
            $file .= 'exe';
            
        $result = file_get_contents($file);
        
        $GLOBALS['___startFunctions'] = [];
        $GLOBALS['___startFunctionsBefore'] = [];
        
        $_e = err_status(false);
        $x = unserialize(base64_decode(gzuncompress($result)));    
        if (!$x)
            $result = unserialize(base64_decode($result));
        else
            $result = $x;
            
        unset($x);
        err_status($_e);
        
        
        $this->config    = $result['CONFIG'];
        $this->formsInfo = $result['formsInfo'];
        
        
        $last_DATA = eventEngine::$DATA;
        eventEngine::$DATA = $result['eventDATA'];
        eventEngine::dataToLower();
        
        foreach((array)$result['scripts'] as $x_file=>$data){
            
            if (!in_array(md5($data),$GLOBALS['__evalProject_md5scripts'])){
                file_p_contents($this->dvs_dir.$x_file, $data);
                include $this->dvs_dir.$x_file;
                unlink($this->dvs_dir.$x_file);
               // eval($data);
            }
            
            $GLOBALS['__evalProject_md5scripts'][] = md5($data);
        }
        
        DSApi::__doStartBeforeFunc();
        
        foreach ($result['DFM'] as $form=>$data){
            $this->loadFormStr($data, $form);
        }
        
        eventEngine::$DATA = $last_DATA;
       
        DSApi::__doStartFunc();
            
        if ($to_show)
            $this->showModal();
        
        if (!EMULATE_DVS_EXE)    
        $GLOBALS['APP_DESIGN_MODE'] = true;
    }
    
    // file.msppr
    public function loadFile($file, $to_show = false){
        
        $GLOBALS['APP_DESIGN_MODE'] = false;
        
        if (file_exists(dirname($file).'/'.basenameNoExt($file).'.inf')){
            
            $info  = unserialize(file_get_contents(dirname($file).'/'.basenameNoExt($file).'.inf'));
            $this->config    = $info['config'];
            $this->formsInfo = $info['formsInfo'];
        }
        
        $last_DATA = eventEngine::$DATA;
        
        if (file_exists(dirname($file).'/'.basenameNoExt($file).'.events')){
            
            eventEngine::$DATA = unserialize(file_get_contents(dirname($file).'/'.basenameNoExt($file).'.events'));
        }
        
        eventEngine::$DATA = $result['eventDATA'];
        eventEngine::dataToLower();
        
        $scripts = findFiles(dirname($file).'/scripts/','php', false, true);
        foreach($scripts as $x_file){
            
            include_once $x_file;
        }
        
        $forms = explode(_BR_,file_get_contents($file));
        foreach($forms as $i=>$name)
            $this->loadForm(dirname($file).'/'.$name.'.dfm');
        
        eventEngine::$DATA = $last_DATA;
            
        
        //pre($this->formsInfo);
        if ($to_show)
            $this->showModal();
            
        $GLOBALS['APP_DESIGN_MODE'] = true;
    }
    
    public function showModal(){
        
        $GLOBALS['APP_DESIGN_MODE'] = false;
        $result = current($this->forms)->showModal();
        $GLOBALS['APP_DESIGN_MODE'] = true;
        return $result;
    }
    
    function initFormCfg($fmEdit, $name){
        
        $info =& $this->formsInfo[$name];
        DSApi::initForm($fmEdit, $info);    
    }
    
    public function loadFormStr($str, $name){
        
        if (c($name)->valid()){         
            error_msg('Form "'.$name.'" is already exists!');
        }
        
        $str  = str_ireplace('fsMDIChild','fsNormal',$str);
        
        $this->forms[$name] = _c(dfm_read('', false, $str, $name, true));
        $this->forms[$name]->hide();
        // загружаем опции формы
        $this->initFormCfg($this->forms[$name], $name);
        
        DSApi::initEvent($this->forms[$name], false, true);
        Localization::localForm($this->forms[$name]);
        
        return $this->forms[$name];
    }
    
    public function loadForm($dfm_file){
        
        $name = basenameNoExt($dfm_file);
        
        if (c($name)->valid()) error_msg('Form "'.$name.'" is already exists!');
        
        $str  = file_get_contents($dfm_file);
        $str  = str_ireplace('fsMDIChild','fsNormal',$str);
    
        $this->forms[$name] = _c(dfm_read('', false, $str, $name, true));
        $this->forms[$name]->hide();
        
        // загружаем опции формы
        $this->initFormCfg($this->forms[$name], $name);
        
        DSApi::initEvent($this->forms[$name]);
        Localization::localForm($this->forms[$name]);
        
        return $this->forms[$name];
    }
    
    public function free(){
        
        foreach($this->forms as $form){
            $form->free();
        }
    }
    
    static function open($msp_project, $update = false){
        
        global $msp_projects_utils;
        
        
        $util =& $msp_projects_utils[$msp_project];
        
        if ($update && $util){
            $util->free();
        } elseif ($util)
            return $util;
            
            $util = new evalProject;
            if (fileExt($msp_project)=='dvs')
                $util->loadDVS($msp_project);    
            else
                $util->loadFile($msp_project);
            
            $msp_projects_utils[$msp_project];
            
            return $util;
    }
    
    static function openAsExe($project){
        
        $fileExe = dirname(EXE_NAME).'/DS KE.exe';
        
        if (file_exists($fileExe)){
            if (fileExt($project)!=='dvsexe')
                $project .= 'exe';
                
            shell_execute(0, 'open', replaceSr($fileExe), '"'.replaceSr($project).'"', '', SW_SHOW);
        }
    }
}