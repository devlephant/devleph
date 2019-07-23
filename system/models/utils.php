<?

function str_replace_once($search, $replace, $subject) {
    $firstChar = strpos($subject, $search);
    if($firstChar !== false) {
        $beforeStr = substr($subject,0,$firstChar);
        $afterStr = substr($subject, $firstChar + strlen($search));
        return $beforeStr.$replace.$afterStr;
    }
        return $subject;
}

class myUtils
{
 
    static $forms; // [$name]
    static $handle;
    static function formProp($file, $prop, $def = false){
        
        $arr = (is_array($file))? $file: file($file);
        foreach ($arr as $i=>$line){
            
            if (substr(trim($line),0,6)=='object' && $i>0)
                return $def;
            
            $info = explode(' = ',$line);
            if (trim($info[0])==$prop){
                
                return trim($info[1]);
            }
        }
        
        return $def;
    }
    
    static function delProp($str, $prop){
        $arr   = explode(_BR_, $str);
        $index = false;
        
        foreach ($arr as $i=>$line){
            
            $info = explode(' = ',$line);
            if (trim($info[0])==$prop){
                $index = $i;
                break;
            }
            
            if (substr(trim($line),0,6)=='object' && $i>0)
                break;
        }
        
        if ($index)
            unset($arr[$index]);
        
        return implode(_BR_, $arr);        
    }
    
    static function replaceProp($str, $prop, $value){
        $arr   = explode(_BR_, $str);
        $index = false;
        
        foreach ($arr as $i=>$line){
            
            $info = explode(' = ',$line);
            if (trim($info[0])==$prop){
                $index = $i;
                break;
            }
            
            if (substr(trim($line),0,6)=='object' && $i>0)
                break;
        }
        
        if ($index)
            $arr[$index] = $value;
        
        return implode(_BR_, $arr);        
    }
    
	static function formPropArr(&$arr, $prop, $def = false){
        foreach ($arr as $i=>$line){
            
            if (substr(trim($line),0,6)=='object' && $i>0)
                return $def;
            
            $info = explode(' = ',$line);
            if (trim($info[0])==$prop){
                
                return trim($info[1]);
            }
        }
        
        return $def;
    }
    
    static function delPropArr(&$arr, $prop){
        $index = false;
        foreach ($arr as $i=>$line)
		{    
            $info = explode(' = ',$line);
            if (trim($info[0])==$prop){
                $index = $i;
                break;
            }
            
            if (substr(trim($line),0,6)=='object' && $i>0)
                break;
        }
        
        if ($index)
            unset($arr[$index]);
    }
    
    static function replacePropArr(&$arr, $prop, $value){
        $arr   = explode(_BR_, $str);
        $index = false;
        foreach ($arr as $i=>$line)
		{
            
            $info = explode(' = ',$line);
            if (trim($info[0])==$prop){
                $index = $i;
                break;
            }
            
            if (substr(trim($line),0,6)=='object' && $i>0)
                break;
        }
        
        if ($index)
            $arr[$index] = $value;
    }
   
	static function delObjectArr(&$arr, $object)
	{
		$object = "object {$object}";
        $len = strlen($object);
		$skip = false;
        foreach ($arr as $i=>$line)
		{
            if (substr(trim($line),0,$len)==$object && $i>0)
			{
                $skip = true;
			}
			if( $skip)
			{
				unset($arr[$i]);
				if(trim($line)=='end' ) 
					$skip = false;
			}
        }
	}
	
    static function loadFormDFM($file, $form = false){
        
        global $fmEdit, $_sc, $myProperties, $APPLICATION, $projectFile;
        
        if (!$form)
            $form = $fmEdit;
        
        $form->hide();
        if( !file_exists($file) ) {
			message(t('Form %s1 does not exist!', basenamenoext($file)));
			$form = new TForm(c('fmMain->pDockMain'));
		} else {
			$str = file_get_contents($file);
			
			$str = str_replace_once('Visible = True','Visible = False',$str);
			$str = str_ireplace('fsMDIChild','fsNormal',$str);
			$str = str_ireplace('fsStayOnTop','fsNormal',$str);
			$str = str_ireplace('fsMDIForm','fsNormal',$str);
        
			$str = str_ireplace('bsDialog','bsNone', $str);
			$str = str_ireplace('bsSizeable','bsNone',$str);
			$str = str_ireplace('bsSingle','bsNone', $str);
			$str = str_ireplace('bsToolWindow','bsNone',$str);
			$str = str_ireplace('bsSizeToolWin','bsNone',$str);
			dfm_read('',$form, $str);
		}
        
        
       
        $form->formStyle   = fsNormal;
        $form->borderStyle = bsNone;
		if(!isset($GLOBALS['sc_offset']))
        $GLOBALS['sc_offset'] = (int)myOptions::get('sc', 'offset', 8);
	
		$obj = c("fmMain->shapeSize");
		$obj->w = $form->w + $GLOBALS['sc_offset'] * 2;
		$obj->h = $form->h + $GLOBALS['sc_offset'] * 2;
		$form->position = poDesigned;
		$form->left = $obj->left + $GLOBALS['sc_offset'];
		$form->top = $obj->top + $GLOBALS['sc_offset'];
        
        
        $form->borderIcons = '';
        $form->align = alNone;
        
        $cap        = $form->caption;
        $form->name = 'fmEdit';
        $form->caption = $cap;
        $components = $form->componentList;
        
        foreach ($components as $i=>$el){
            
            $class = rtti_class($el->self);
            $real_class = __rtti_class($el->self);
                    
            if (!in_array($class,array('TEvents','TSizeCtrl'))){
                //$_sc->registerTarget($el);
               
                if (is_subclass_of($el,  '__TNoVisual')){
                    $el->label = '';
                    $el->obj   = '';
                    
                }
                
                if (method_exists($el,'__loadDesign'))
				{
                    $el->__loadDesign();           
				} elseif(method_exists($el, '__initComponentInfo'))
				{
					$el->__initComponentInfo();
				}
                
                if (method_exists($el,'__updateDesign'))
                    $el->__updateDesign();
                
                
            } elseif ($class=='TEvents') {        
               
                // это для формата старых объектов...
                if ($real_class !== 'TEvents'){
                    $el = convertOldEvents($el);
                }
           }
        }
       
        c('fmMain')->caption = 'Devel Studio '.DV_YEAR.' ['.basenameNoExt($projectFile).']';
        c('fmMain->statusBar')->caption = " ".replaceSr($projectFile);
       
        form_parent($form->self, c('fmMain->pDockMain')->self);
        $form->show();
    }

    static function loadForCache($form = false, $no_clear_sc = false){
        
        global $_sc;
        
        if (!$form)
            $form = $GLOBALS['fmEdit'];
        
        
        if (is_object($_sc) && !$no_clear_sc){
            $_sc->free();
	    $_sc = false;
        }
        
        $form->onMouseDown = 'myDesign::mouseDown';
        $form->onMouseMove = 'myDesign::mouseMove';
        $form->onMouseUp   = 'myDesign::mouseUp';
        $form->onCanResize = 'myDesign::lockEditForm';
        $form->onResize    = 'myDesign::resizeEditForm';
        
        
        $_sc = new TSizeCtrl($form);
        $_sc->showGrid = (bool)myOptions::get('sc','showGrid',false);
        $_sc->gridSize = myOptions::get('sc','gridSize',8);
		$_sc->MovePanelCanvas->brush->color = myOptions::get('sc', 'SizerInnerColor', 12632256);
		$_sc->MovePanelCanvas->pen->color = myOptions::get('sc', 'SizerOuterColor', clBlack);
		$_sc->MovePanelCanvas->pen->style = (int)myOptions::get('sc','SizerPenStyle',2);
		$_sc->BtnColor = myOptions::get('sc','BtnColor',clBlue);
		$_sc->DisabledBtnColor = myOptions::get('sc','DisabledBtnColor',clGray);
        
        $_sc->onSizeMouseDown = 'myDesign::selectComponent';
        $_sc->onEndSizeMove   = 'myDesign::endSizeMove';
        $_sc->onStartSizeMove = 'myDesign::startSizeMove';
        
        $_sc->popupMenu= c('fmMain->editorPopup');
            
        $_sc->enable   = true;
         
        $targets = $form->componentList;
        foreach ($targets as $el){
            if (!$el->isClass(array('TEvents','TSizeCtrl'))){
                
                $_sc->registerTarget($el);
            }
        }
        
        c('fmMain->shapeSize')->w = $form->w + $GLOBALS['sc_offset']*2;
        c('fmMain->shapeSize')->h = $form->h + $GLOBALS['sc_offset']*2;
         
         
        /*foreach ($targets_ex as $el){
            $_sc->addTarget($el);
        } */
    }
    
    static function saveFormDFM($file,$newname=false){
        
        global $fmEdit, $_sc;
               
        if ( $newname && is_object($_sc) )
		{
			$targets_ex = $_sc->targets_ex;
            $_sc->clearTargets();
            $_sc->free();
            $_sc = false;
        }
        
        //$fmEdit->borderStyle = myProject::getPropForm('borderStyle','bsSizeable');
        $str = str_replace_once('Visible = True','Visible = False',gui_writeStr($fmEdit->self));
        $str = explode(_BR_, str_replace_once('BorderStyle = bsNone',
                                'BorderStyle = '.myProject::getPropForm('borderStyle', 'bsSizeable'),
                                $str));
        
        if (self::formPropArr($str,'Width',null)!==null)
		{
            self::replacePropArr($str,'Width',' ClientWidth = '. $fmEdit->Width );
            self::replacePropArr($str,'Height',' ClientHeight = '. $fmEdit->clientHeight );
        }
		if( self::formPropArr($str,'PopupMenu',false) == 'fmMain.editorPopup' )
		{
			self::delPropArr($str, 'PopupMenu');
        }
		self::delObjectArr($str, 'TSizeCtrl');
		$str = implode(_BR_,$str);
		file_put_contents(replaceSr($file), $str);
		if(!$newname) return;
		self::loadForCache($fmEdit);
        foreach ($targets_ex as $el)
		{
            $_sc->addTarget($el);
        }
    }
    
    static function loadForm($nam){
        
        global $fmMain, $_sc, $projectFile, $myInspect, $fmEdit, $formSelected, $_FORMS, $myProperties, $myEvents;
		
		if(stripos($nam, '.dfm')){
			$name = explode('.',$nam);
			if( $name[count($name)-1] == 'dfm' ) unset($name[count($name)-1]);
			$name = implode('.',$name);
		}else{ $name = $nam; }
        
		$file = dirname($projectFile) .'/'. $name . '.dfm';
        
        myProperties::unFocusPanel(); // fix
        
        foreach ((array)$_FORMS as $i=>$el)
            if (strtolower($el) == strtolower($name)){
                $formSelected = $i;
                c('fmMain->tabForms')->tabIndex = $i;
            }
        
        $myEvents->last_self = ''; // fix bug 
        $l_name = strtolower($name); // fix bug ... 
		c('fmMain->pdockMain')->VertScrollBar->position = c('fmMain->pdockMain')->HorzScrollBar->position = 0;		
        if (isset(self::$forms[$l_name])){
        if (self::$forms[$l_name]){
            
            $fmEdit->hide();
            $fmEdit->name = '';
            self::$forms[$l_name]->show();
            $fmEdit = self::$forms[$l_name];
            $cap = $fmEdit->caption;
            $fmEdit->name = 'fmEdit';
            $fmEdit->caption = $cap;
            
            self::loadForCache($fmEdit);
            $fmEdit->StyleElements = '[]';
            $fmEdit->repaint();
            
        } else {
            
            
            $fmEdit->hide();
            $fmEdit->name = '';
            $fmEdit = new TForm;
			$fmEdit->StyleElements = '[]';
            $fmEdit->position = poDesigned;
            $fmEdit->h = 50;
            $fmEdit->w = 50;
            $fmEdit->x = 10;
            $fmEdit->y = 10;
            self::loadFormDFM($file, $fmEdit);
            $fmEdit->x = 10;
            $fmEdit->y = 10;
            $fmEdit->StyleElements = '[]';
            self::$forms[$l_name] = $fmEdit;
            self::loadForCache($fmEdit);
            
            $fmEdit->repaint();
            $fmEdit->show();
        }
		
		} else {
            
            
            $fmEdit->hide();
            $fmEdit->name = '';
            $fmEdit = new TForm;
			$fmEdit->StyleElements = '[]';
            $fmEdit->position = poDesigned;
            $fmEdit->h = 50;
            $fmEdit->w = 50;
            $fmEdit->x = 10;
            $fmEdit->y = 10;
            self::loadFormDFM($file, $fmEdit);
            $fmEdit->x = 10;
            $fmEdit->y = 10;
            $fmEdit->StyleElements = '[]';
            self::$forms[$l_name] = $fmEdit;
            self::loadForCache($fmEdit);
            
            $fmEdit->repaint();
            $fmEdit->show();
        }
		if( $fmEdit->y !== (c("fmMain->shapeSize")->y + $GLOBALS['sc_offset']) ) 
			{
				$fmEdit->y = c("fmMain->shapeSize")->y + $GLOBALS['sc_offset'];
				$fmEdit->x = c("fmMain->shapeSize")->x + $GLOBALS['sc_offset'];
            }
        myProject::loadFormInfo();

        $myInspect->generate($fmEdit);

        eventEngine::setForm();    
		
        myDesign::formProps();
		
		$myProperties->setProps();
		
        
        $fmMain->repaint();
        $fmMain->invalidate();
    }
    
    static function saveForm($nam = false){
        
        global $myProject, $projectFile, $formSelected, $_FORMS;
        if(stripos($nam, '.dfm')){
			$name = explode('.',$nam);
			if( $name[count($name)-1] == 'dfm' ) unset($name[count($name)-1]);
			$name = implode('.',$name);
		}else{ $name = $nam; }
        if (!$name || is_numeric($name))
            $name = $_FORMS[$formSelected];        
        
        
        $file = dirname($projectFile) .'/'. $name . '.dfm';
        
        myProject::saveFormInfo();
        self::saveFormDFM($file,$nam!==false);
        //eventEngine::updateIndexes();
        
    }
    
    static function deleteForm($nam = false){
        global $projectFile, $formSelected, $_FORMS, $_sc;
        if(stripos($nam, '.dfm')){
			$name = explode('.',$nam);
			if( $name[count($name)-1] == 'dfm' ) unset($name[count($name)-1]);
			$name = implode('.',$name);
		}else{ $name = $nam; }
        if (count($_FORMS)==1) return;
        
        if (!$name || is_numeric($name))
            $name = $_FORMS[$formSelected];
            
        if ( !confirm(t('Are you sure to delete form "%s"?',$name)) ) return; 	
        
        c('fmMain->tabForms')->tabs->delete($formSelected);
        if ($formSelected == 0)
            $last_form = $_FORMS[1];
        else
            $last_form = $_FORMS[$formSelected-1];
        
        if (!$last_form)
            $last_form = $_FORMS[0];
        
        if (file_exists(dirname($projectFile) .'/'. $name . '.dfm'))
            unlink(dirname($projectFile) .'/'. $name . '.dfm');
        
        foreach ($_FORMS as $i=>$el)
            if (strtolower($el)==strtolower($name)) unset($_FORMS[$i]);
        
        unset(eventEngine::$DATA[strtolower($name)]);
        
        $l_name = strtolower($name); // fix bug forms
        if (self::$forms[$l_name]){
            
            self::$forms[$l_name]->free();
            $_sc = false;
            unset(self::$forms[$l_name]);
        }
        
        $_FORMS = array_values($_FORMS);
        self::loadForm($last_form);
		myProject::save();
        treeBwr_add();
    }
    
    static function cloneForm($nam = false){
        global $projectFile, $formSelected, $_FORMS, $myProject;
        if(stripos($nam, '.dfm')){
			$name = explode('.',$nam);
			if( $name[count($name)-1] == 'dfm' ) unset($name[count($name)-1]);
			$name = implode('.',$name);
		}else{ $name = $nam; }
        if (!$name || is_numeric($name))
            $name = $_FORMS[$formSelected];
            
        self::saveForm($name);
        myProject::save();
            
        $new_name = $name;
        $i = 1; 
        while (in_array($new_name.$i, $_FORMS)) $i++;
        $new_name = $new_name.'_'.$i;    
            
            
        $index = c('fmMain->tabForms')->tabIndex;
        c('fmMain->tabForms',1)->addPage($new_name.'.dfm');
        c('fmMain->tabForms',1)->tabIndex = $index;
        
        $dfm_file = dirname($projectFile) .'/'. $name . '.dfm';
        $dfm_file2= dirname($projectFile) .'/'. $new_name . '.dfm';
        copy($dfm_file, $dfm_file2);
        
        eventEngine::$DATA[strtolower($new_name)] = eventEngine::$DATA[strtolower($name)];
        
        $_FORMS[] = $new_name;
        
        $myProject->formsInfo[$new_name] = $myProject->formsInfo[$name];
        
		treeBwr_add();
    }
    
    static function formExists($nam){
        if(stripos($nam, '.dfm')){
			$name = explode('.',$nam);
			if( $name[count($name)-1] == 'dfm' ) unset($name[count($name)-1]);
			$name = implode('.',$name);
		}else{ $name = $nam; }
        $name = strtolower($name);
        global $_FORMS, $formSelected;
            foreach ($_FORMS as $el)
                if (strtolower($el)==$name)
                    return true;
        
        return false;
    }
    
    static function renameForm($nam = false){
        global $projectFile, $formSelected, $_FORMS, $myProject;
        if(stripos($nam, '.dfm')){
			$name = explode('.',$nam);
			if( $name[count($name)-1] == 'dfm' ) unset($name[count($name)-1]);
			$name = implode('.',$name);
		}else{ $name = $nam; }
        if (!$name || is_numeric($name))
            $name = $_FORMS[$formSelected];
          
        $new_name = inputText(t('Rename this form'),t('New form name'), $name);
        if ($new_name)
        if (preg_match('/^([a-z]{1})([a-z0-9\_]+)$/i',$new_name)){
            
            global $_FORMS, $formSelected;
            foreach ($_FORMS as $el){
                if (strtolower($el)==strtolower($new_name)){
                    msg(t('Form %s already exists in the project',$el));
                    return false;
                }
            }
    
        
        $dfm_file = dirname($projectFile) .'/'. $name . '.dfm';
        $dfm_file2= dirname($projectFile) .'/'. $new_name . '.dfm';
        if (file_exists($dfm_file2))
            unlink($dfm_file2);
        
        rename($dfm_file, $dfm_file2);
        myDesign::groupChangeFormName($name, $new_name);
        myDesign::eventChangeFormName($name, $new_name);
        
            $k = array_search($name, $_FORMS);
            $_FORMS[$k] = $new_name;
            $id = c('fmMain->tabForms')->tabIndex;
            c('fmMain->tabForms')->tabs->setLine($k,$new_name.'.dfm');
            c('fmMain->tabForms')->tabIndex = $id;
            $myProject->formsInfo[$new_name] = $myProject->formsInfo[$name];
            unset($myProject->formsInfo[$name]);
            
			treeBwr_add();
        }
    }
    
    static function openProject($file){
        
        myProject::open($file);
    }
    
    static function saveProject(){
        
        myProject::save();
    }
    
    
    static function run($self=-1){
        self::stop();
        myCompile::start();
    }
    
	static function runDebug(){
        self::stop();
        myCompile::start(true, true);
        c('fmRunDebug')->show();
    }
       
    static function stop(){
		global $ProjectFile;
			if(  myUtils::$handle <> 0 )
			{
				exec('taskkill /pid ' . myUtils::$handle . ' /T /F');
				myUtils::$handle = 0;
			}
			if( c('fmRunDebug')->visible )
				c('fmRunDebug')->visible = false;
    }
    
    static function createForm($nam){
        
        global $projectFile, $_FORMS, $myProject;
        $name = str_replace(array('\\', '/', '.', '+', '-', '$', '#', '!', '%', '%', '^', '&', '*'), '', $nam);
        if (!file_exists(SYSTEM_DIR . '/project_parts/form.dfm'))
            msg(t('Blank form is not found: /project_parts/form.dfm'));
            
        if (!file_exists(dirname($projectFile)))
            mkdir(dirname($projectFile),0777,true);
        
        
        copy(SYSTEM_DIR . '/project_parts/form.dfm', dirname($projectFile) .'/'. $name . '.dfm');
        $_FORMS[] = $name;
        
        $info ['position'] = 'poScreenCenter';
        $info ['windowState'] = 'wsNormal';
        $info ['formStyle'] = 'fsNormal';
		$info ['borderStyle'] = 'bsSizeable';
        $info ['i_close'] = true;
        $info ['i_min']   = true;
        $info ['i_max']   = true;
        
        $myProject->formsInfo[$name] = $info;
        
      
        
        c('fmMain->tabForms',1)->addPage($name.'.dfm');
        self::saveProject();
    }
    
    static function newForm(){

		global $_FORMS, $formSelected;
		
			$fname = isset($_FORMS[$formSelected])? str_replace(range(0, 9), '', $_FORMS[$formSelected]): 'Form';
			if( isset($_FORMS[$formSelected]) ){
				$f = preg_match_all('!\d+!', $_FORMS[$formSelected], $int);
				
				$int = $f? max( current($int) ): 1;
				$intpos = $f? strpos($_FORMS[$formSelected], $int): strlen($fname);
			} else {
				$int = 1;
				$intpos = 4;
			}
				while( in_array($fname.$int, $_FORMS) ) $int++;
					$name = strins($fname, $intpos, $int);
			
		
        $name = inputText(t('Create new form'),t('Form name'), $name);
        
        if ($name)
        if (preg_match('/([a-z0-9\_]+)/i',$name)){
            
            foreach ($_FORMS as $el){
                if (strtolower($el)==strtolower($name)){
                    msg(t('Form %s already exists in the project',$el));
                    return false;
                }
            }
            
            
            self::saveForm();
            self::createForm($name); // создаем форму из бланка...
            self::loadForm($name); // загружаем форму в проект...
            
			treeBwr_add();
        }
    }
    
    static function leftForm(){
        
        global $_FORMS, $formSelected;
        
        if ($formSelected == 0) return;
        
        
        self::saveForm($_FORMS[$formSelected]);
        
        $tmp = $_FORMS[$formSelected];
        $_FORMS[$formSelected]   = $_FORMS[$formSelected-1];
        $_FORMS[$formSelected-1] = $tmp;
        c('fmMain->tabForms',1)->tabs->exchange($formSelected, $formSelected-1);
        
        self::loadForm($tmp);

    }
    
    static function rightForm(){
        
        global $_FORMS, $formSelected;
        
        if ($formSelected == count($_FORMS)-1) return;

        
        self::saveForm($_FORMS[$formSelected]);
        
        $tmp = $_FORMS[$formSelected];
        $_FORMS[$formSelected]   = $_FORMS[$formSelected+1];
        $_FORMS[$formSelected+1] = $tmp;
        c('fmMain->tabForms',1)->tabs->exchange($formSelected, $formSelected+1);
        
        self::loadForm($tmp);
        
    }
    
    // реальное число компонентов на форме...
    static function componentCount(){
        
        global $fmEdit;
        $i = 0;
        $components = $fmEdit->componentList;
        
        foreach ($components as $el){
            
            if (!$el->name) continue;
            $i++;
        }
        
        return $i;
    }
}