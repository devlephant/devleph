<?

class myProject {
    
    public $formsInfo;
    public $config;
    public $add_info;
    private static $repclasses;
	
    static function registerFileType(){
		
        registerFileType('dvs', dirname(EXE_NAME).'/DS KE.exe');
        //registerFileType('upr', dirname(EXE_NAME).'/DS KE.exe');
		registerFileType('msppr', dirname(EXE_NAME).'/DS KE.exe');
        registerFileType('dspak', dirname(EXE_NAME).'/DS KE.exe');
        registerFileType('zipdspak', dirname(EXE_NAME).'/DS KE.exe');
        registerFileType('dvsexe', dirname(EXE_NAME).'/DS KE.exe');
		writeRegKey(HKEY_LOCAL_MACHINE, "SYSTEM\\CurrentControlSet\\Control\\Session Manager\\Environment\\dsApps", str_replace('/', DIRECTORY_SEPARATOR, DS_USERDIR), 0);
		
    }
    
    static function openLsProject(  $vv = false ){
        
        global $_PARAMS;
        global $projectFile;
        
        setTimeout( 10000, 'myProject::registerFileType()' );
        
        $fileName = isset($_PARAMS[2])? replaceSl($_PARAMS[2]): '';
        
        if (file_exists($fileName)){

            if (fileExt($fileName)=='dvs'){
                if (!self::openFromDVS($fileName)){
                    self::open( $projectFile, true, true );
                }
            } elseif (fileExt($fileName)=='upr' or fileExt($fileName)=='msppr')
                self::open($fileName, true, false);
            elseif(fileExt($fileName)=='dspak' || fileExt($fileName)=='zipdspak') {
                
                if (class_exists('master_Packages'))
                    master_Packages::installPak($fileName);
                    
                self::open( $projectFile, true, true );
            }
            
        } elseif ( is_file($projectFile) ){
            self::open( $projectFile, true, true );
			
        }
    }
    
    static function setStatus($text, $progress){
        
        
    }
    
    static function cfg($name, $value = null){
        
        global $myProject;
        if ($value === null){
			if( isset($myProject->add_info[$name]) )
				return $myProject->add_info[$name];
			return [];
        } elseif ($value === false)
            unset($myProject->add_info[$name]);
        else
            $myProject->add_info[$name] = $value;
    }
    
    static function showIncorrect(){
        global $myProject;
        $classes = [];
		if($myProject->formsInfo)
        foreach ($myProject->formsInfo as $form=>$data){
            
            $objs = $data['objects'];
			if( is_array($objs) )
            foreach($objs as $o){
                
                if ( !class_exists($o['CLASS']) ){
                    $classes[] = $o['CLASS'];
                }
            }
        }
        
        array_unique($classes);
        
        if ( count($classes)>0 ){
            
            message(t('В проекте используются следующие несуществующие классы:')."\n\r\n\r".
                    implode(',', $classes));
        }
    }
    
    static function genTabs(){
        
        global $_FORMS;
        
        c('fmMain->tabForms')->tabs->clear();
		 
        foreach ($_FORMS as $form){
            c('fmMain->tabForms')->addPage($form.'.dfm');
	}
    }
    
    static function getFormsObjects( $classes = false ){
        
        global $myProject, $_FORMS, $formSelected, $fmEdit;
        
        $result = [];
        for ($i=0;$i<count($_FORMS);$i++){
            
            $result[$_FORMS[$i]] = [];
			if(isset($myProject->formsInfo[$_FORMS[$i]]))
            $result[$_FORMS[$i]] = $myProject->formsInfo[$_FORMS[$i]]['objects'];
        }
        
        $result[$_FORMS[$formSelected]] = [];
        $components = $fmEdit->componentList;
        foreach ($components as $el){
            if ($el->name){
				$RTclass = rtti_class($el->self);
                if( $classes && !in_array($RTClass, $classes)) next;
                $arr = array('NAME'=>$el->name, 'CLASS'=>$RTclass);
                
                if (method_exists($el,'__inspectProperties')){
                    $i_props = $el->__inspectProperties();
                    foreach((array)$i_props as $x_prop){
                        $arr[$x_prop] = $el->$x_prop;
                    }
                }
                
                $result[$_FORMS[$formSelected]][] = $arr;
            }
        }
        
        return (array)$result;
    }
    
    static function saveFormInfo(){
        
        global $fmEdit, $myProject, $formSelected, $_FORMS;
        
        $info =& $myProject->formsInfo[$_FORMS[$formSelected]];
        
        $info['maxwidth'] = $fmEdit->constraints->maxwidth;
        $info['minwidth'] = $fmEdit->constraints->minwidth;
        $info['maxheight']= $fmEdit->constraints->maxheight;
        $info['minheight']= $fmEdit->constraints->minheight;
        
        $props = array('autoScroll','autoSize','alphaBlend','alphaBlendValue','screenSnap','clientWidth','clientHeight',
                        'snapBuffer','transparentColor','transparentColorValue','borderWidth');
        foreach ($props as $p){
            $info[$p] = $fmEdit->$p;
        }
        
        $info['objects'] = [];
        $components = $fmEdit->componentList;
        foreach ($components as $el){
            
            if ($el->name){
                
                $arr = array('NAME'=>$el->name,'CLASS'=>rtti_class($el->self));
                
                if (method_exists($el,'__inspectProperties')){
                    $i_props = $el->__inspectProperties();
                    foreach((array)$i_props as $x_prop){
                        $arr[$x_prop] = $el->$x_prop;
                    }
                }
                
                $info['objects'][] = $arr;
                
            }
        }
        
        self::save();
    }
    
    static function loadFormInfo(){
        
        global $fmEdit, $myProject, $formSelected, $_FORMS;
        
		if(!isset($myProject->formsInfo[$_FORMS[$formSelected]])) return;
        $info = $myProject->formsInfo[$_FORMS[$formSelected]];
        
        $props = array('autoScroll','autoSize','alphaBlend','alphaBlendValue','screenSnap','clientWidth','clientHeight',
                        'snapBuffer','transparentColor','transparentColorValue','borderWidth');

        $fmEdit->constraints->maxwidth = $info['maxwidth'];
        $fmEdit->constraints->minwidth = $info['minwidth'];
        $fmEdit->constraints->maxheight= $info['maxheight'];
        $fmEdit->constraints->minheight= $info['minheight'];
        
        foreach ($props as $p){
            $fmEdit->$p = $info[$p];
        } 
    }
    
    static function setPropForm($prop, $value){
        
        global $fmEdit, $myProject, $formSelected, $_FORMS;
        
        $myProject->formsInfo[$_FORMS[$formSelected]][$prop] = $value;
    }
    
    static function getPropForm($prop, $def = false){
        
        global $fmEdit, $myProject, $formSelected, $_FORMS;
        
        if (!isset($myProject->formsInfo[$_FORMS[$formSelected]][$prop]))
            return $def;
        else
            return $myProject->formsInfo[$_FORMS[$formSelected]][$prop];
    }
    
    static function lastFileClick($self){
        
        $xfile = _c($self)->caption;
        $xfile = trim($xfile);
        $xfile = str_replace("&",'', $xfile);
        
        if (file_exists($xfile)){
            
            if (confirm(t('Are you sure to open "%s" ?',$xfile)))
                self::open($xfile, true, false);
        }
    }
	
	static function demosClick($self){
	
		$xfile = _c($self)->caption;
        $xfile = trim($xfile);
        $xfile = str_replace("&",'', $xfile);
		
		$xfile = dirname(EXE_NAME) . '/demos/' . $xfile . '.dvs';
        
        if (file_exists($xfile)){
            
            if (confirm(t('Are you sure to open "%s" ?',$xfile)))
                self::openFromDVS($xfile);
        }
	}
    
    static function lastClearClick($self){
        
        global $lastFiles;
        $lastFiles = [];
        self::initLastFiles();
    }
    
    static function initLastFiles($file = false, $v = false){
        
        global $lastFiles;
        
		if(!$v)
        if ($file){
            $lastFiles = array_reverse($lastFiles);
            
            $file = str_replace('//','/',$file);
            
            if (array_search($file,$lastFiles)!==false)
                unset($lastFiles[array_search($file,$lastFiles)]);
            $lastFiles = array_values($lastFiles);
            
            $lastFiles[] = $file;
			
            $lastFiles = array_reverse($lastFiles);
            if (count($lastFiles)>15){
                $lastFiles = array_values(array_slice($lastFiles, 0, 15));
            }
            
           
        }
        
        foreach ($lastFiles as $i=>$xfile)
            if (!is_file($xfile)){
                
                unset($lastFiles[$i]);
            }
            
        $lastFiles = array_values($lastFiles);
        file_put_contents(DS_USERDIR . 'last.lst', serialize($lastFiles));
        
            $objLast = c('fmMain->it_lastprojects');
            
            $objLast->clear();
            
            $it = new TMenuItem($objLast);
            $it->caption = t('clear_list');
            $it->onClick = 'myProject::lastClearClick';
            $objLast->addItem($it);
            
            $it = new TMenuItem($objLast);
            $it->caption = '-';
            $objLast->addItem($it);
            
        
        foreach ($lastFiles as $xfile){
                $it = new TMenuItem($objLast);
                $it->caption = $xfile;
                $it->onClick = 'myProject::lastFileClick';
                $objLast->addItem($it);
        }
		
		
		global $demoLoad;
		
		if ( $demoLoad ) return;
		
		$demoLoad = true;
		$objLast = c('fmMain->it_demoprojects');
		
		$demos = findFiles( dirname(EXE_NAME) . '/demos/', 'dvs' );
		foreach ( $demos as $xfile ){
			
			$it = new TMenuItem($objLast);
            $it->caption = basenameNoExt($xfile);
            $it->onClick = 'myProject::demosClick';
            $objLast->addItem($it);
		}

    }
    
    static function convertOldNoVisual($obj){
        
        global $fmEdit;
        $obj_name = $obj->name;
        $obj->name = '';
        $props = TComponent::__getPropExArray($obj->self);
        $class = rtti_class($obj->self);
        
       
        $result = new $class($fmEdit);
        $result->parent = $fmEdit;
        
        $result->name = $obj_name;
        $result->x = $obj->x;
        $result->y = $obj->y;
        
        
        foreach ($props as $key=>$value)
            $result->$key = $value;
            
        return $result;
    }   
	static function convertAs($obj, $class)
	{
		global $fmEdit;
        $obj_name = $obj->name;
        $obj->name = '';
        $props = TComponent::__getPropExArray($obj->self);
        
       
        $result = new $class($fmEdit);
        $result->parent = $fmEdit;
        
        $result->name = $obj_name;
        $result->x = $obj->x;
        $result->y = $obj->y;
        
        
        foreach ($props as $key=>$value)
            $result->$key = $value;
   
        return $result;
	}
	static function addReplaceable($class, $replaceAs)
	{
		self::$repclasses[ strtolower($class) ] = $replaceAs;
	}
    static function checkOldFormat(){
        
        if (self::cfg('DV_VERSION')=='' || version_compare(self::cfg('DV_VERSION'), DV_VERSION, '<')){
			$GLOBALS['IS_OLD_PROJECT'] = true;
            alert(t("You're trying to load old-format project. This project will be converted!"));
            
            global $_FORMS, $fmEdit;
            
            foreach ($_FORMS as $form){
                myUtils::loadForm($form);
                $del_objs = [];
                
                $components = $fmEdit->componentList;
                foreach($components as $el){
					$realClass = strtolower(rtti_class($el->self));
					if ( isset(self::$repclasses[$realClass]) )
					{
						self::convertAs($el, self::$repclasses[$realClass]);
						$del_objs[] = $el;
					}elseif (isset(self::$repclasses[get_class($el)]))
					{
						self::convertAs($el, self::$repclasses[get_class($el)]);
						$del_objs[] = $el;
                    }elseif (is_subclass_of($el,  '__TNoVisual')){
                        
                        self::convertOldNoVisual($el);
                        $del_objs[] = $el;
                        
                    } elseif ($el instanceof TEvents){
                        $obj_name = $el->component_name;
                        
                        if ($obj_name === '')
                            $obj_name = '--fmedit';
                        
                        if ($obj_name)
						{    
                            $obj_ind  = $fmEdit->findComponent($obj_name)->componentIndex;
                            if (($obj_ind+1) || $obj_name=='--fmedit'){
                                $events   = $el->list;
                                eventEngine::$DATA[strtolower($form)][strtolower($obj_name)] = $events;
                            }
                        }
                        $del_objs[] = $el;
                    }
                }
                
                 
                foreach ($del_objs as $el){
                    $el->free();
                }
                
                
                myUtils::saveForm();        
            }
            
            eventEngine::dataToLower();
            myUtils::saveProject();
            return true;
        }
        
        $GLOBALS['IS_OLD_PROJECT'] = false;
        return true;
    }
    
    static function open($file, $init = true, $dnt = false){
        
        $file = replaceSl($file);
        
        if (!file_exists($file)) return false;
        
        global $_FORMS, $myProject, $projectFile;
		$last_project = $projectFile;
		
		self::initLastFiles($projectFile, $dnt);
		
        $forms	 = file_get_contents($file);
        $forms   = strlen(str_replace(["\w", "\t", " ", "\r", "\n"],'',$forms))? explode(_BR_,$forms): findfiles(dirname($file), 'dfm', 0, 0, 0);
		
        $file_ex = dirname($file).'/'.basenameNoExt($file);
    
        if ($init)
        if (file_exists($file_ex.'.inf')){
            
            $info  = unserialize(file_get_contents($file_ex.'.inf')); // fix bug
            $myProject->config    = $info['config'];
			if( !isset($myProject->config['data_dir']) ) $myProject->config['data_dir'] = 'data'; //bugfix
            $myProject->formsInfo = $info['formsInfo']; 
        }
        
        if (file_exists($file_ex.'.cfg')){
            $myProject->add_info = unserialize(file_get_contents($file_ex.'.cfg'));
        }
        
        if (file_exists($file_ex.'.events')){
            
            eventEngine::$DATA = unserialize(file_get_contents($file_ex.'.events'));
            
        } else {
            
        }

        self::clearProject();

        myVars::set($file, 'projectFile');
        myVars::set($forms,'_FORMS');
        myVars::set(0, 'formSelected');

        myUtils::loadForm($forms[0], true);
		
        self::genTabs();

        if (!self::checkOldFormat()){
            self::open($last_project, true, $dnt);
            return;
        }
        
        self::showIncorrect();
		myInspect::genList(false);
		
    }
    
    
    static function save($file = false){
        
        global $projectFile, $_FORMS, $myProject;
        
        // в событии сохранения передавался $self элемента меню, из-за чего в файл подставлялся $self - индетификатор
        if (is_numeric($file)) $file = false; // fix bug _empty() when compile
        
        
        if ($file)
            $projectFile = replaceSl($file);
        
        if (!file_exists(dirname($projectFile)))
            mkdir(dirname($projectFile),0777,true);
        
        if (!file_exists(dirname($projectFile).'/'.basenameNoExt($projectFile).'.inf')){
            
            $myProject->config['debug'] = [];
            $myProject->config['debug']['enabled'] = true;
			$myProject->config['apptitle'] = 'Project';
            $myProject->config['data_dir'] = 'data';
        }
        
        myProject::cfg('DV_VERSION', DV_VERSION);
        myProject::cfg('DV_PREFIX', DV_PREFIX);
        
        $info['formsInfo'] = $myProject->formsInfo;
        $info['config']    = $myProject->config;
        
        file_put_contents(dirname($projectFile).'/'.basenameNoExt($projectFile).'.inf', serialize($info));
        file_put_contents(dirname($projectFile).'/'.basenameNoExt($projectFile).'.cfg', serialize($myProject->add_info));
        file_put_contents(dirname($projectFile).'/'.basenameNoExt($projectFile).'.events', serialize((array)eventEngine::$DATA));
        
        if(implode(_BR_,$_FORMS)) file_put_contents($projectFile, implode(_BR_,$_FORMS));
        
    }
    
    // сохранить проект в формате .DVS - Devel Studio Format
    static function saveAsDVS($file,$chks=true){
        
        $file = replaceSl($file);
        
        if (!is_writable(dirname($file)))
            return false;
        

        myUtils::saveForm();
        
        global $projectFile, $_FORMS, $myProject;
        
        $dir  = dirname($projectFile);
        $data = []; // здесь храним структуру файла...
        $data['CONFIG']    = $myProject->config;
        $data['formsInfo'] = $myProject->formsInfo;
        $data['add_info']  = $myProject->add_info;
        $data['eventDATA'] = eventEngine::$DATA;
        
        /* запись скриптов */
        $scripts = findFiles($dir.'/scripts/','php');
        foreach($scripts as $x_file)
            $data['scripts'][$x_file] = file_get_contents($dir.'/scripts/'.$x_file);
        /****************/
        
        
        /* запись ресурсов */
        if (trim($myProject->config['data_dir'])){
            $data_dir = $dir.'/'.$myProject->config['data_dir'].'/';
            $files = findFiles($data_dir,null,true,true);
            foreach($files as $x_file){
                $data['data'][ str_replace($data_dir,'/',$x_file) ] = file_get_contents($x_file);     
            }
        }
        
        foreach ($_FORMS as $form){
            
            $dfm_file = $dir .'/'. $form .'.dfm';
            if (file_exists($dfm_file)){
                
                $str = file_get_contents($dfm_file);
                $data['DFM'][$form] = $str;
            }
        }
        
        $result = base64_encode(serialize($data));
		if( $chks ) foreach( scandir(dirname($file)) as $file_link )
		{
			if($file_link !== '..' and $file_link !== '.' and is_file(dirname($file).'/'.$file_link)){
				$full_link = dirname($file).'/'.$file_link;
				if(md5($result) == md5(file_get_contents($full_link)))
					return false;
			}
		}
        
        file_put_contents($file, $result);
		return true;
    }
       
    static function clearProject(){
        
	global $_sc;
	if(myUtils::$forms)
        foreach (myUtils::$forms as $form)
            $form->free();
        
	$_sc = false;
        myUtils::$forms = [];
    }
    
    // открыть файл проекта формата .DVS...
    static function openFromDVS($file, $dir = false){
        
        $file = replaceSl($file);
        $dir  = replaceSl($dir);
        $file = str_replace('\\\\','\\',$file);
        if (!is_readable($file))
            return false;
        
        if (!file_exists($dir) && $dir)
            mkdir($dir,0777,true);
        
        global $projectFile, $_FORMS, $myProject, $formSelected;
        $last_project = $projectFile;
        
        if ($dir){
            $projectFile = $dir .'/'. basenameNoExt($file) . '.msppr';
        } else {
            
            $path = self::projectDialog(replaceSr(dirname($file)) .'\\'. basenameNoExt($file) .'\project.msppr');
            
            if ($path){
                        
                self::clearProject();
                $projectFile = replaceSl($path['PATH']);
                self::initLastFiles($projectFile);
                
                if (!is_dir(dirname($projectFile)))
                    mkdir(dirname($projectFile),0777,true);
                
                if ($path['DEL_ALL_FILES'])
                    deleteDir(dirname($projectFile), false);
                    
            } else
                return false;
        }
         
            $result = file_get_contents($file);
            //pre([$file, $result]);
			if(strlen($result)>0)
            $result = is_gzcompressed($result)? unserialize(base64_decode(gzuncompress($result))): unserialize(base64_decode($result));
			if(!is_array($result)) 
			{
				dssMessages::error(DSS_FATAL_ERROR, t('Project file is corrupt or empty!'));
			}
        $myProject->config    = $result['CONFIG'];
        $myProject->formsInfo = $result['formsInfo'];
        $myProject->add_info  = $result['add_info'];
        eventEngine::$DATA    = $result['eventDATA'];
        
        
        foreach((array)$result['scripts'] as $x_file=>$data)
            file_p_contents(dirname($projectFile).'/scripts/'.$x_file, $data );
        
        foreach((array)$result['data'] as $x_file=>$x_data){
        
            $x_file = dirname($projectFile) .'/'. $myProject->config['data_dir'] .'/'. $x_file;
        
            if (!is_dir(dirname($x_file)))
                mkdir( dirname($x_file), 0777, true);
            
            file_put_contents($x_file, base64_decode($x_data) );
        }
    
        $_FORMS = [];
        
        foreach ($result['DFM'] as $form=>$data){
            
            $dfm_file = dirname($projectFile) .'/'.$form.'.dfm';
            //($dfm_file)){
                $_FORMS[] = $form;
                file_put_contents($dfm_file, $data);
            //}
        }
        
        if (!self::checkOldFormat()){
            self::open($last_project);
            return;
        }
        
        self::genTabs();
        $formSelected = 0;
        myUtils::loadForm($_FORMS[0], true);
        myUtils::saveProject();
        return true;
    }
    
    
    static function projectDialogKeyDown($self, $key){
        
        if ($key==VK_RETURN){
            $GLOBALS['__newproject_modalresult'] = mrOk;
        } elseif ($key==VK_ESCAPE){
            $GLOBALS['__newproject_modalresult'] = mrCancel;
            c('fmNewProject')->close();
        }
    }
    
    static function projectDialogBtn(){
        
        $dlg = new TSaveDialog;
        $dlg->filter = 'DevelStudio Project (*.msppr)|*.msppr';
        
        if ($dlg->execute()){
            
            
            $dlg->fileName = fileExt($dlg->fileName)=='msppr' ? $dlg->fileName : $dlg->fileName . '.msppr';
            c('fmNewProject->path')->text = $dlg->fileName;
        }
        
        $dlg->free();
		c('fmNewProject')->toFront();
    }
    
    static function projectLastProjects($self){
        
        $file = str_replace(array('//', '/'), '/', replaceSl(
            str_replace('%dsApps%', replaceSr(DS_USERDIR), _c($self)->items->selected)
            ) );
		
        if (file_exists($file)){
            
            if (confirm(t('Are you sure to open "%s" ?',$file))) 
			{
				$GLOBALS['__newproject_close'] = false;
                self::open($file, true, false);
				self::initLastFiles($file, false);
				c('fmNewProject')->close();
			}
        }
            
        
    }
    
    static function projectDialog($text = '', $setmain_form=false){
        global $APPLICATION, $fmMain;
        $dlg = c('fmNewProject');
		if( $setmain_form )
		{
			$APPLICATION->mainFormOnTaskBar = false; 
			gui_formsetmain( c('fmNewProject')->self );
			$APPLICATION->mainFormOnTaskBar = true; 
		}
		c('fmNewProject->path')->text = str_replace('\\\\','\\',$text);
        c('fmNewProject->btn_dlg')->onClick = 'myProject::projectDialogBtn';
        c('fmNewProject->path')->onKeyDown  = 'myProject::projectDialogKeyDown';
        c('fmNewProject->lastProjects')->onDblClick = 'myProject::projectLastProjects';
		c('fmNewProject->bitbtn2')->onClick = function($self){
			if( $GLOBALS['__newproject_close']  )
			{
				application_terminate();
				die();
				$GLOBALS['__newproject_close'] = 'exit';
			}
		};
        
        global $lastFiles;
        
        foreach ($lastFiles as $file){
            $arr[] = replaceSr(
                str_replace( DS_USERDIR,'%dsApps%\\', $file)
                );
        }
        
        c('fmNewProject->lastProjects')->items->setArray($arr);
        $dlg->FormState = 'fsmodal';
        $res = $dlg->showModal();
		if( $setmain_form )
		{
			$APPLICATION->mainFormOnTaskBar = false; 
			gui_formsetmain( $fmMain->self );
			$APPLICATION->mainFormOnTaskBar = true; 
		}
		
        $__fix = isset($GLOBALS['__newproject_modalresult'])? $GLOBALS['__newproject_modalresult']: '';
        if ($res==mrOk || $__fix==mrOk){
            
            $result['PATH'] = replaceSl(c('fmNewProject->path')->text);
            if (fileExt($result['PATH'])!=='msppr'){
				$GLOBALS['__newproject_close'] = false;
                msg(t('Project file must have a ".msppr" extension'));
                return false;
            }
            
            $result['DEL_ALL_FILES'] = c('fmNewProject->c_alldelete')->checked;
        } else
            $result = false;  
		if( $GLOBALS['__newproject_close'] && !$result )
			{
				application_terminate();
				die();
				$GLOBALS['__newproject_close'] = 'exit';
			} else $GLOBALS['__newproject_close'] = false;
        return $result;
    }
    
    static function newProjectDialog( $setmainform = false ){
        
        global $projectFile, $_FORMS, $myProject;
        if( !is_bool($setmainform) ) $setmainform = false;
        $dir = replaceSr(DS_USERDIR);
	//(winLocalPath(CSIDL_PERSONAL)).'\\DevelStudio';
        
        $i = 1;
        while (is_dir($dir.'\Project'.$i)) $i++;
        
            /****** event *****/
            if (!CApi::doEvent('onProjectDialog',array('dir'=>$dir,'index'=>$i))) return;
            /****** ---- *****/
        
        $result = self::projectDialog($dir.'\Project'.$i.'\Project'.$i.'.msppr', $setmainform);
        if( $GLOBALS['__newproject_close'] == 'exit') return;
        if (is_array($result)){
            
            /****** event *****/
            if (!CApi::doEvent('onNewProject',array('filename'=>$result['PATH']))) return;
            /****** ---- *****/
            
            $_FORMS = [];
            c('fmMain->tabForms')->tabs->clear();
            $projectFile = $result['PATH'];
            
            if (file_exists($projectFile))
                unlink($projectFile);
            
            $myProject->config['modules'] = [];
            
            $myProject->config['debug'] = [];
            $myProject->config['debug']['enabled'] = true;
            $myProject->config['data_dir'] = 'data';
            
            $myProject->config['debug']['no_warnings'] = false;
            $myProject->config['debug']['no_errors'] = false;
            $myProject->config['prog_type'] = 0;

            
            if ( file_exists(dirname($projectFile).'/'.basenameNoExt($projectFile).'.events'))
                unlink(dirname($projectFile).'/'.basenameNoExt($projectFile).'.events');
            

            $myProject->config['apptitle'] = 'Project'.$i;
            eventEngine::$DATA = [];

            myUtils::saveProject();
            myUtils::createForm('Form1');
            self::open($projectFile, false, false);
            
			
            /****** event *****/
            if (!CApi::doEvent('onNewProjectAfter',array('filename'=>$result['PATH']))) return;
            /****** ---- *****/
        } 
    }
    
    
    static function saveAsDFM($file){
        
        myUtils::saveFormDFM($file);
    }
    
    static function saveAsDVSDialog(){
        
        $dlg = new TSaveDialog;
        $dlg->filter = 'Devel Visual Project (*.dvs)|*.dvs|DFM Form (*.dfm)|*.dfm';
        
        if ($dlg->execute()){
        
            $dlg->fileName = replaceSl($dlg->fileName);
            if (file_exists($dlg->fileName)
                && !confirm(t('File "%s" already exists! You want to replace this file?',basename($dlg->fileName)))) return false;
            
            $index = $dlg->filterIndex;
            
            /****** event *****/
            if (!CApi::doEvent('onSaveProject',array('filename'=>$dlg->fileName,'ext'=>$index===1?'dvs':'dfm'))) return;
            /****** ---- *****/
            
            switch ($index){
                
                case 1:
                        $dlg->fileName = fileExt($dlg->fileName)=='dvs' ? $dlg->fileName : $dlg->fileName . '.dvs';
                        self::saveAsDVS($dlg->fileName);
                        break;
                case 2:
                        $dlg->fileName = fileExt($dlg->fileName)=='dfm' ? $dlg->fileName : $dlg->fileName . '.dfm';
                        self::saveAsDFM($dlg->fileName);
                        break;
            }
            
            /****** event *****/
            if (!CApi::doEvent('onSaveProjectAfter',array('filename'=>$dlg->fileName,'ext'=>$index===1?'dvs':'dfm'))) return;
            /****** ---- *****/
            
            return true;
        } else
            return false;
        
        $dlg->free();
    }
    
    static function openAsDFM($file){
        
        global $_FORMS, $formSelected, $fmEdit, $myInspect;
        myUtils::loadFormDFM($file);
        
        $myInspect->generate($fmEdit);
        myDesign::formProps();
    }
    
    static function openFromFileDialog(){
        
        
        $dlg = new TOpenDialog;
        $dlg->filter =
        'Devel Studio Files (*.dvs, *.msppr, *.dfm)|*.dvs;*.msppr;*.dfm|Devel Visual Project (*.dvs)|*.dvs|DevelStudio Project (*.msppr)|*.msppr' .
        '|Delphi Form (*.dfm)|*.dfm';
        
        if ($dlg->execute()){
            
            $dlg->fileName = replaceSl($dlg->fileName);

            $ext = fileExt($dlg->fileName);
            $filename = $dlg->fileName;
            
            /****** event *****/
            if (!CApi::doEvent('onOpenProject',array('filename'=>$filename,'ext'=>$ext))) return;
            /****** ---- *****/
              
            switch ($ext){
                
                case 'dvs':
                    self::openFromDVS($filename);
                    break;
                case 'upr':
                    self::open($filename, true, false);
					self::initLastFiles($filename, false);
                    break;
				case 'msppr':
					self::open($filename, true, false);
					self::initLastFiles($filename, false);
					break;
                case 'dfm':
                    self::openAsDFM($filename);
                    break;
            }
            
            /****** event *****/
            if (!CApi::doEvent('onOpenProjectAfter',array('filename'=>$filename,'ext'=>$ext))) return;
            /****** ---- *****/
        }
    }
}

$GLOBALS['myProject'] = new myProject;