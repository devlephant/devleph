<?


class myBehaviours {
	
	static function setFontDsgn($obj, $font)
	{    
		foreach(['name', 'color', 'style', 'charset'] as $p)
		$obj->ValueFont->$p = $font->$p;
        $obj->value = $font->name. ','. $font->size .','. toHTMLColor($font->color);
    }
    
    static function setColorDsgn($obj, $color){
        
       // $obj->valueFont('color',$color);
        $obj->value = toHTMLColor($color);
    }
    
    static function updateProps()
	{
        $GLOBALS['myBehaviours']->_setProps(true);
    }
    function _setProps($update = false){
        
        global $_c, $toSetBProp, $fmEdit;
        $toSetBProp = true;
        if( !is_object($this->selObj) )
			$this->selObj = $fmEdit;
		$name = $this->selObj->className == 'TForm'?$_FORMS[$formSelected]:$this->selObj->name;
        $elements = $this->params[$name];
        
		if( is_array($elements) )
			foreach ($elements as $self=>$param){
            
				if (!isset($param['TYPE'])) continue;
            
				$data = $param['DATA'];
				$value = $data;
            
				$obj = _c($self);
				
				if ($param['TYPE']=='combo'){
                
					if (substr($param['PROP'],0,6)=='cursor'){
                    
						if (is_string($value))
							$index = array_search(constant($value), array_keys($GLOBALS['cursors_meta']));
						else
							$index = array_search($value, array_keys($GLOBALS['cursors_meta']));
						$value = $index;
					}
						
					if (preg_match('/^([0-9]+)$/',$value)){
						$value = (int)$value;
						$i = -1;
						foreach ($param['VALUES'] as $key => $el){
                        
							++$i;
							if ($key == $value) break;
						}
                    
						$obj->itemIndex = $i;
					} else {
						if(isset($param['NO_CONST'])){
							if ($param['NO_CONST']){
								$lines = explode(_BR_,$obj->text);
								$k     = array_search($value, $lines);
							
								$obj->itemIndex = $k;
							} else {
								$obj->itemIndex = $_c->$value;
							}
						} else {
							$obj->itemIndex = $_c->$value;
						}
					}
				} elseif ($param['TYPE']=='scombo'){
                
					$obj->itemIndex = constant($value);
                
				} elseif ($param['TYPE']=='check') {
                
					$obj->value = $value ? t('Yes') : t('No');
					//$obj->itemIndex = $value ? 0 : 1;
               
				} elseif ($param['TYPE']=='image'){
                
					$ovalue = $data;
                
					if ($ovalue)
					if (!$ovalue->isEmpty())
						$obj->value = '(' . t('image') . ')';
					else
						$obj->value = '(' . t('None') . ')';
                    
                
				} elseif ($param['TYPE']=='font'){
                
					self::setFontDsgn($obj, $data);
                
				} elseif ($param['TYPE']=='stfont'){
                
					self::setFontDsgn($obj, $data);
                
				} elseif ($param['TYPE']=='color'){
                
					self::setColorDsgn($obj, $data);
                
				} elseif ($param['TYPE']=='form') {
                
					$obj->value = '('.t('Properties').')';
                
				} elseif ($param['TYPE']=='sizes') {
                
					$obj->value = '('.t('Sizes & Position').')';
                
				} elseif ($param['TYPE']=='hotkey') {
					$obj->value = $data;
                
				} elseif ($param['TYPE']=='components'){
                
					$obj->value = $data;
					//$obj->inText = $this->selObj->$prop;
					/*global $_FORMS, $formSelected;
					$forms = myProject::getFormsObjects();
					$items = [];
                
					if ($param['ONE_FORM']){
                    
						foreach ($forms[$_FORMS[$formSelected]] as $x)
							$items[] = ($x['NAME']); 
					} else {
                    
						foreach ($forms as $form=>$objs){
							$items[] = ($form);
                        foreach ($objs as $x)
                            $items[] = ($form.'->'.$x['NAME']);
						}
					}
                
					$obj->text = $items;
					$obj->value = $this->selObj->$prop;*/
                
				} elseif ($param['TYPE']=='files') {
                
					$items = [];
                
					global $projectFile;
					$files = findFiles(dirname($projectFile), $param['EXT'], $param['RECURSIVE'], true);
                
					foreach ($files as $file){
						$file = str_replace([dirname($projectFile),'//'],['','//'], $file);
						if ($file[0]=='/')
							$file[0] = ' '; $file = ltrim($file);
                    
						if (!in_array($file, $items))
							$items[] = $file;
					}
                
					$obj->text  = $items;
					$obj->value = $data;
				} elseif ($param['TYPE']=='tib') {
					self::setTibDsgn($obj, count($data));
				} else {
					//$obj->text = $this->selObj->$prop;
					$obj->value = (string)$data;
				}
				$param['DATA'] = $data;
			}
			
			$toSetBProp = false;
    }
    
    function setProps(){
        global $myBehaviours; $myBehaviours->_setProps();
        //setTimeout(25, 'global $myBehaviours; $myBehaviours->_setProps()');
    }
	
	public static function VSFormClick($self){
        
        global $myBehaviours, $_sc, $fmEdit;
        
        $param = $myBehaviours->elements[ $self ];
        $prop  = $param['PROP'];
        
        $form = c($param['PROP']);
    
        self::formShow($self, $form);
        if ($form->showModal()==mrOk){
            
            self::formSelect($self, $form);
        }
        
    }
    
    public static function VSImageClick($self){
        
        global $myBehaviours, $_sc, $fmEdit, $myProperties;
        
        $param = $myBehaviours->elements[ $self ];
        $data  = $param['DATA'];
		$prop  = $param['PROP'];
		
        $dlg = new TImageDialog;
        $dlg->value = $data;
        
        if ($dlg->execute()){
            
            $obj = _c($self);
            $bitmap = $dlg->value;
            $targets = count($_sc->targets_ex) ? $_sc->targets_ex : array($fmEdit);
            $m = 'set_' . $prop;
				$el = _c(myDesign::noVisAlias($targets[0]->self));
                $el->$prop->assign($bitmap);
					if( method_exists($el, $m) )
					$el->$m($bitmap);
            
			if(isset($param['UPDATE']))
				if ($param['UPDATE']) $myBehaviours->setProps();
            
            if (!$bitmap->isEmpty()){
                $obj->value = '(' . t('image') . ')';
            } else
                $obj->value = '(' . t('None') . ')';
                
            $_sc->update();  // fix bug
        }
        
		$myBehaviours->elements[ $self ]['DATA'] = $el->$prop;
        $dlg->free();
		self::updateProps();
	}
    
    public static function VSComponentsClick($self){
        
        global $myBehaviours, $_sc, $fmEdit;
        
        $param = $myBehaviours->elements[ $self ];
        $prop  = $param['PROP'];
		$data  = $param['DATA'];
        
        $dlg = new TObjectsDialog;
        
        if ($dlg->execute(false,'',true)){
            
            $obj = _c($self);
            $value = $dlg->value;
            $targets = count($_sc->targets_ex) ? $_sc->targets_ex : array($fmEdit);
            
				$el = _c(myDesign::noVisAlias($targets[0]->self));
				$el->$prop = $value;
				
			if(isset($param['UPDATE']))
				if ($param['UPDATE']) $myBehaviours->setProps();
            $obj->value = $value;
        }
        
        $dlg->free();
        self::updateProps();
    }
    
    public static function VSSizesClick($self){
        
        global $myBehaviours, $_sc, $fmEdit, $myProperties;
        
        $param = $myBehaviours->elements[ $self ];
        $data  = $param['DATA'];
		$prop  = $param['PROP'];
        
        $dlg = new TSizesDialog;
        $dlg->setSizeControl( '_sc' );
        $dlg->setObject( $myBehaviours->selObj );
        
        if ($dlg->execute()){
            
        }
        $_sc->update();  // fix bug
        $dlg->free();
		self::updateProps();
    }
    
    public static function VSFontClick($self){
       
        global $myBehaviours, $_sc, $fmEdit, $myProperties;
        
        $param = $myBehaviours->elements[ $self ];
        $prop  = $param['PROP'];
		$data  = $param['DATA'];
        
        $dlg = new TFontDialog;
        $dlg->font->assign( $data );
        
        if ($dlg->execute()){
            
            $font  = $dlg->font;
			
                $data = $font;
            
            self::setFontDsgn(_c($self), $font);
            $_sc->update();  // fix bug
        }
        
		$myBehaviours->elements[$self]['DATA'] = $data;
        $dlg->free();
		self::updateProps();
    }
    
    public static function VSColorClick($self){
       
        global $myBehaviours, $_sc, $fmEdit;
        
        $param = $myBehaviours->elements[ $self ];
        $data  = $param['DATA'];
		$prop  = $param['PROP'];
		
        $dlg = new TDMSColorDialog;
        $dlg->color = $data;
		
        $colors = myOptions::get('colors','in',null);
		if( $colors!==null )
		{
			list($dlg->MainColors->text, $dlg->CustomColors->text) = unserialize(base64_decode($colors));
		}
        $x = cursor_real_x($dlg->form,10);
        $y = cursor_real_y($dlg->form,10);
        
        if ($dlg->execute($x, $y)){
            
            $color  = $dlg->color;
                $data = $color;
            
            self::setColorDsgn(_c($self), $color);
            $_sc->update();  // fix bug
			myOptions::set('colors', 'in', base64_encode(serialize(array($dlg->MainColors->text, $dlg->CustomColors->text))));
        }

		$myBehaviours->elements[ $self ]['DATA'] = $data;
        $dlg->free();
		self::updateProps();
    }
    public static function VSTIBClick($self)
	{
		global $myBehaviours, $_sc, $fmEdit;
        $prop  = 'images';
		$targets = count($_sc->targets_ex) ? $_sc->targets_ex : array($fmEdit);
		$ib = _c(myDesign::noVisAlias(current($targets)->self));;
		if($ib == $fmEdit) return;
		$prev = $ib->$prop;
		$prev2 = isset($ib->state)? $ib->state: null;
		if( master_TIB::execute( $ib ) )
		{
            myHistory::add($targets, $prop);
            if( count($targets) > 1 )
				foreach ($targets as $link=>$el){
					$el = _c(myDesign::noVisAlias($el->self));
					if( isset($el->$prop) )
						$el->$prop = $ib->$prop;
					if( isset($el->state) )
						$el->state = $ib->state;
				}
		} else {
			$ib->$prop = $prev;
			if( isset($ib->state) )
				$ib->state = $prev2;
		}
		self::setTibDsgn(c($self), count($ib->$prop) );
		$_sc->update();  // fix bug
		self::updateProps();	// fix bug
	}
	public static function setTibDsgn($obj, $cnt)
	{
		$cnt = str_split($cnt);
		$cnt = end($cnt);
		switch( $cnt )
		{
			case 1: {
				$cnt = $cnt . " " . t("img_cnt_1");
			} break;
			case 2: case 3: case 4:
			{
				$cnt = $cnt . " " . t("img_cnt_234");
			} break;
			case 5: case 6: case 7: case 8: case 9: case 0:
			{
				$cnt = $cnt . " " . t("img_cnt_5_0");
			} break;
		}
		$obj->value = "[ " . $cnt . " ]";
	}
    public static function VSMenuClick($self){
        
        global $myProperties, $toSetBProp, $_sc;
        if ($toSetBProp) return;
        
        $param = $myBehaviours->elements[ $self ];
        $prop  = $param['PROP'];
		$data  = $param['DATA'];
        
        $dlg = new TMenuDialog;
        $dlg->value = $data;
        
        if ($dlg->execute()){
            
            $value = $dlg->value;
            c($self)->value = $value;
            
                    $data = $value;
                
            $_sc->update();  // fix bug
        }
        
		$myBehaviours->elements[$self]['DATA'] = $data;
        $dlg->free(); 
		self::updateProps();
    }
    
    public static function VSButtonClick($self){
        
        global $myBehaviours, $toSetBProp, $_sc;
        if ($toSetBProp) return;
        
        clearEditorHotKeys();
        
        $param = $myBehaviours->elements[ $self ];
        $prop  = $param['PROP'];
		$data  = $param['DATA'];
        
        $dlg = new TTextDialog;
        $dlg->value = $data;
        
        if ($dlg->execute()){
            
            c($self)->value = $dlg->value;
            $value = $dlg->value; // f.b.
            
                    $data = $value;
            
            $_sc->update();  // fix bug
        }
        
		$myBehaviours->elements[$self]['DATA'] = $data;
        $dlg->free();
		self::updateProps();
    }
    
    public static function VSEdit($self, $link, $value, $CAN){
        
        global $myBehaviours, $_sc, $fmEdit, $toSetBProp;
        if ($toSetBProp) return;
        
        clearEditorHotKeys();
        
        $param = $myBehaviours->elements[ $link ];
        $prop  = $param['PROP'];
		$data  = $param['DATA'];
        
        
        if ($param['TYPE']=='font'){
            
            $font = $data;    
            
            self::setFontDsgn(c($link), $font);
            return false;
        }
		if ($param['TYPE']=='stfont'){
            
            $font = $data;    
            
            self::setFontDsgn(c($link), $font);
            return false;
        }
        
        if ($param['TYPE']=='color'){
            
            $color = $data;    
            
            self::setColorDsgn(c($link), $color);
            return false;
        }
        
        if ($param['TYPE']=='sizes'){
            
            $color = $data;    
            
            c($link)->value = '('.t('Sizes & Position').')';
            return false;
        }
        
        if (substr($param['PROP'],0,6)=='cursor'){
            
            $value = constant($value);
        } elseif ($param['TYPE']=='combo'){
            
			
            if ( isset($param['NO_CONST']) )
                $value = ((bool)$param['NO_CONST'])? array_search($value,$param['VALUES']): constant($value);
            else {
                $value = constant($value);
            }
			
        }
				
        if ($param['PROP']=='modalResult'){
            
			if ( !is_numeric($value) ) // fix
            $value = constant($value);
        }
		
	
        if ($param['TYPE']=='form'){
            
            c($link)->value  = '('.t('Properties').')';
            return;
        }
        
        if ($param['PROP']=='name'){
            
            $obj = $myBehaviours->selObj;    
            
            //myHistory::add($obj, $prop);
            
		
	    if (!preg_match('/^[a-z]{1}[a-z0-9\_]*$/i',$value)){
                c($link)->value = $value;
                return;
            }
	        
            myDesign::changeName($obj, $value);
        
        } else {
            
                $data = $value;
            
            $_sc->update();  // fix bug
            $_sc->updateBtns();
            
            //$myProperties->unFocusPanel();
        }
		
		$myBehaviours->elements[$self]['DATA'] = $data;
		self::updateProps();
    }
    
    public static function VSBarClick($self, $prop, $index){
        
        global $myBehaviours, $_sc, $fmEdit, $toSetBProp;
        if ($toSetBProp) return;
        
        $param = $myBehaviours->elements[ $prop ];
		$prop_l  = $prop;
		$data  = $param['DATA'];
        
        if ($param['TYPE']!=='check') return;
        
        $value = _c($prop)->value === t('Yes') ? true : false;
        
            $data = $value;
		
		$myBehaviours->elements[$prop_l]['DATA'] = $data;
        $_sc->update();  // fix bug
		self::updateProps();
    }
	
	function createXName(&$param, $name){
    
        self::createXText($param, $name);    
    }
    
    function createXText(&$param, $name){
        
        $edt = new TNxButtonItem;
        $edt->caption = $param['CAPTION'];
        
		$edt = _c($this->panels[$name]['GROUP']->add($edt, $param['CAPTION']));
		
        $edt->ButtonCaption = '...';
        $edt->buttonWidth = 19;
        $edt->onButtonClick = 'myBehaviours::VSButtonClick';
        
        $this->params[$name][$edt->self] =& $param; 
        $this->elements[$edt->self] = $param;
    }
    
    
    function createXMenu(&$param, $name){
        
        $edt = new TNxButtonItem;
        
		$edt = _c($this->panels[$name]['GROUP']->add($edt, $param['CAPTION']));
		
        $edt->ButtonCaption = '...';
        $edt->buttonWidth = 19;
        //$edt->readOnly = true;
        $edt->onButtonClick = 'myBehaviours::VSMenuClick';
     
        $this->params[$name][$edt->self] =& $param;
        $this->elements[$edt->self] = $param;
    }
    
    
    function createXForm(&$param, $name){
        
        $edt = new TNxButtonItem;
        
		$edt = _c($this->panels[$name]['GROUP']->add($edt, $param['CAPTION']));
		
        $edt->ButtonCaption = '...';
        $edt->buttonWidth = 19;
        $edt->value  = '('.t('Properties').')';
        
        $edt->onButtonClick = 'myBehaviours::VSFormClick';
        
        $this->params[$name][$edt->self] =& $param;
        $this->elements[$edt->self] = $param;
    }
    
    function createXColor(&$param, $name){
        
        $edt = new TNxButtonItem;
        
		$edt = _c($this->panels[$name]['GROUP']->add($edt, $param['CAPTION']));
		
        $edt->ButtonCaption = '...';
        $edt->buttonWidth = 19;

        $edt->onButtonClick = 'myBehaviours::VSColorClick';
        
        $this->params[$name][$edt->self] =& $param;
        $this->elements[$edt->self] = $param;
    }
    function createXTib(&$param, $name){
        
        $edt = new TNxButtonItem;
        
		$edt = _c($this->panels[$name]['GROUP']->add($edt, $param['CAPTION']));
		
        $edt->ButtonCaption = '...';
        $edt->buttonWidth = 19;

        $edt->onButtonClick = 'myBehaviours::VSTIBClick';
        
        $this->params[$name][$edt->self] =& $param;
        $this->elements[$edt->self] = $param;
    }
    function createXFont(&$param, $name){
        
        $edt = new TNxButtonItem;

		$edt = _c($this->panels[$name]['GROUP']->add($edt, $param['CAPTION']));

        $edt->buttonWidth = 19;
        $edt->value       = '('. t('Font options') .')';
        
        $edt->ButtonCaption = '...';
        
        $edt->onButtonClick = 'myBehaviours::VSFontClick';
        
        $this->params[$name][$edt->self] =& $param;
        $this->elements[$edt->self] = $param;
    }
    function createXSTFont(&$param, $name){
        
        $edt = new TNxButtonItem;

		$edt = _c($this->panels[$name]['GROUP']->add($edt, $param['CAPTION']));

        $edt->buttonWidth = 19;
        $edt->value       = '('. t('Font options') .')';
        
        $edt->ButtonCaption = '...';
        
        $edt->onButtonClick = 'myBehaviours::VSFontClick';
        
        $this->params[$name][$edt->self] =& $param;
        $this->elements[$edt->self] = $param;
    }
    function createXNumber(&$param, $name){
        
        $edt = new TNxSpinItem;
		
		$edt = _c($this->panels[$name]['GROUP']->add($edt, $param['CAPTION']));
		
        if ($class == 'TForm'){
            global $propFormW, $propFormH;
            
            if ($param['PROP']=='clientWidth')
                $propFormW = $edt;
            if ($param['PROP']=='clientHeight')
                $propFormH = $edt;
        }
        
        $this->params[$name][$edt->self] =& $param;
        $this->elements[$edt->self] = $param;
    }
    
    function createXHotkey(&$param, $name){
        
        $edt = new TNxButtonItem;
		
		$edt = _c($this->panels[$name]['GROUP']->add($edt, $param['CAPTION']));
		
        $edt->caption = $param['CAPTION'];
        $edt->ButtonCaption = '...';
        $edt->buttonWidth = 19;

        $edt->onButtonClick = 'myBehaviours::VSButtonClick';
        
        $this->params[$name][$edt->self] =& $param;
        $this->elements[$edt->self] = $param;
    }
    
    function createXImage(&$param, $name){
        
        $edt = new TNxButtonItem;
		
		$edt = _c($this->panels[$name]['GROUP']->add($edt, $param['CAPTION']));
		
        $edt->caption = $param['CAPTION'];
        $edt->ButtonCaption = '...';
        $edt->buttonWidth = 19;

        $edt->value       = '('. t('None') .')';
        
        $edt->onButtonClick = 'myBehaviours::VSImageClick';
        
        $this->params[$name][$edt->self] =& $param;
        $this->elements[$edt->self] = $param;
    }
    
    function createXCombo(&$param, $name){
        
        $edt = new TNxComboBoxItem;
        $edt->caption = $param['CAPTION'];
        
		$edt = _c($this->panels[$name]['GROUP']->add($edt, $param['CAPTION']));
		
        if (count($param['VALUES']))
            $edt->text = $param['VALUES'];
        
        //_c($tmp)->onButtonClick = 'myBehaviours::VSButtonClick';
        $this->params[$name][$edt->self] =& $param;
        $this->elements[$edt->self] = $param;
    }
    
    /*function createXComponents($param, $class){
        
        $edt = new TNxComboBoxItem;
        $edt->caption = $param['CAPTION'];
        
        $edt->hint = $param['CAPTION'];
        $edt->showHint = true;

        $this->elements[$edt->self] = $param;
    }*/
        
    
    function createXComponents(&$param, $name){
      
        $edt = new TNxButtonItem;
        
		$edt = _c($this->panels[$name]['GROUP']->add($edt, $param['CAPTION']));
		
        $edt->buttonWidth = 19;
        $edt->ButtonCaption = '...';
        $edt->caption = $param['CAPTION'];
        
        $edt->onButtonClick = 'myBehaviours::VSComponentsClick';
        $this->params[$name][$edt->self] =& $param;
        $this->elements[$edt->self] = $param;
    }
    
    function createXFiles(&$param, $name){
        
        $edt = new TNxComboBoxItem;
        $edt->caption = $param['CAPTION'];
        
		$edt = _c($this->panels[$name]['GROUP']->add($edt, $param['CAPTION']));
		
        $this->params[$name][$edt->self] =& $param;
        $this->elements[$edt->self] = $param;
    }
    
    function createXCheck(&$param, $name){
        
        $edt = new TNxCheckBoxItem;

		$edt = _c($this->panels[$name]['GROUP']->add($edt, $param['CAPTION']));
	
        $edt->showText = true;
        $edt->TextKind = 'tkCustom';
        $edt->TrueText = t('Yes');
        $edt->FalseText = t('No');

        //_c($tmp)->onButtonClick = 'myBehaviours::VSButtonClick';
        $this->params[$name][$edt->self] = &$param;
        $this->elements[$edt->self] = $param;
    }
    
    function createXSizes(&$param, $name){
        
        $edt = new TNxButtonItem;
        
		$edt = _c($this->panels[$name]['GROUP']->add($edt, $param['CAPTION']));
		
        $edt->buttonWidth = 19;
        $edt->value       = '('.t('Sizes & Position').')';;
        
        $edt->ButtonCaption = '...';
        
        $edt->onButtonClick = 'myBehaviours::VSSizesClick';
        $this->params[$name][$edt->self] =& $param;
        $this->elements[$edt->self] = $param;
    }
    
   function generate($self){
	   
	   global $componentBehaviours, $myProject, $_FORMS, $formSelected;
	   
	   if (is_object($self)){
            $class = $self->className;
            $self  = $self->self;
        } else
            $class = rtti_class($self);
		
		$this->selObj = toObject($self);
		$name = $class == 'TForm'?'fmEdit':_c($self)->name;
		$all_props = $componentBehaviours[$class];
		$main_props = !isset($myProject->objectsInfo['behaviours'][$name])?$all_props:$myProject->objectsInfo['behaviours'][$name];
		$$myProject->objectsInfo['behaviours'][$name] = $main_props;
		
		$this->_generate($self, $name, $main_props);
   }
   
   function _generate($self, $name, $all_props){
	   
	   global $fmMain;
	   
	   if (!isset($this->panels[$name])){
		   $theme = dsThemeDesign::$dir; //#ADDOPT;
			
            c("fmMain->editorPopup")->AutoPopup = false;
			lockWindowUpdate(c('fmPropsAndEvents->tabBeha')->handle);
            $panel = new TNextInspector( $fmMain );
            $panel->parent = c('fmPropsAndEvents->tabBeha');
            $panel->BeginUpdate();
			$panel->h = $panel->parent->h -1;
			$panel->align  = 'alTop';
            $panel->enableVisualStyles = true;
			$panel->borderStyle = bsNone;
            $panel->rowHeight = 20;
            $panel->HighlightTextColor = 0xC1FFFF;
            $panel->onVSEdit = 'myBehaviours::VSEdit';
            $panel->onVSToolBarClick = 'myBehaviours::VSBarClick';
			$panel->Glyphs = c("fmMain->NXGlyphos");
			$panel->ButtonsStyle = 1; //btCustom
			gui_propSet($panel->self, 'Color', clWindow);
			gui_propSet($panel->self, 'CategoriesColor', clBtnFace);
			
			foreach($all_props as $beha_name=>$props){
				$gr = new TNxToolbarItem;
				gui_propSet(gui_propGet($gr->self, 'Font'), 'Color', clWindowText);
				$gr->caption = t('gr_'.$beha_name);
				gui_propSet($gr->self, 'Color', clBlack);
				$panel->addItem(null, $gr, apFirst);
				$this->panels[$name]['GROUP'] = $gr;
				foreach($props as $prop){
					if (!isset($prop['TYPE'])) continue;
					
					if (method_exists($this,'createX'.$prop['TYPE'])){
					
							$this->{'createX'.$prop['TYPE']}($prop, $name);

							if ($prop['TYPE']=='font'){
								$xprop = ['CAPTION'=>t('Font Color'), 'TYPE'=>'color', 'PROP'=>'fontColor', 'REAL_PROP'=>'font->color'];
								$this->{'createX'.$xprop['TYPE']}($xprop, $name);
							}	
							if ($prop['TYPE']=='font' or (strtolower($prop['CAPTION'])==strtolower(t('Font Color')) and $prop['TYPE']=='color')){
								$xr = ['CAPTION'=>t('Font Size'), 'TYPE'=>'number', 'PROP'=>'fontsize', 'REAL_PROP'=>'font->size'];
								$xt = ['CAPTION'=>t('Font Height'), 'TYPE'=>'number', 'PROP'=>'fontheight'];
								$xo = ['CAPTION'=>t('Font Pitch'), 'TYPE'=>'combo', 'PROP'=>'fontpitch', 'REAL_PROP'=>'font->pitch', 'VALUES'=>['fpDefault','fpVariable', 'fpFixed']];
								$xq = ['CAPTION'=>t('Font Quality'), 'TYPE'=>'combo', 'PROP'=>'fontquality', 'REAL_PROP'=>'font->quality', 'VALUES'=>['fqDefault', 'fqDraft', 'fqProof', 'fqNonAntialiased', 'fqAntialiased', 'fqClearType', 'fqClearTypeNatural']];
								$xla = ['CAPTION'=>t('Font Orientation'), 'TYPE'=>'number', 'PROP'=>'fontori', 'REAL_PROP'=>'font->orientation'];
							
								$this->{'createX'.$xr['TYPE']}($xr, $name);
							
								$this->{'createX'.$xt['TYPE']}($xt, $name);
							
								$this->{'createX'.$xo['TYPE']}($xo, $name);
							
								$this->{'createX'.$xq['TYPE']}($xq, $name);
							
								$this->{'createX'.$xla['TYPE']}($xla, $name);
							}
					}
				}
			}
				
			$this->panels[$name]['EL']  = $this->elements;
				
			c("fmMain->editorPopup")->AutoPopup = true;
			$panel->EndUpdate();
			lockWindowUpdate(0);
	   }
   }
}