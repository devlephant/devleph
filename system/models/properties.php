<?


class myProperties {
    
    
    public $panels; // панель свойств компонентов...
    
    public $params;
    public $elements;
    public $panel;
    
    public $selObj;
    
    public $last_class;
    
    public static function VSFormClick($self){
        
        global $myProperties, $_sc, $fmEdit;
        
        $param = $myProperties->elements[ $self ];
        $prop  = $param['PROP'];
        
        $form = c($param['PROP']);
    
        self::formShow($self, $form);
        if ($form->showModal()==mrOk){
            
            self::formSelect($self, $form);
        }
        
    }
    
    public static function VSImageClick($self){
        
        global $myProperties, $_sc, $fmEdit;
        
        $param = $myProperties->elements[ $self ];
        $prop  = $param['PROP'];
		
        $dlg = new TImageDialog;
        $dlg->value = $myProperties->selObj->$prop;
        
        if ($dlg->execute()){
            
            $obj = _c($self);
            $bitmap = $dlg->value;
            $targets = count($_sc->targets_ex) ? $_sc->targets_ex : array($fmEdit);
            $m = 'set_' . $prop;
            foreach ($targets as $el){
                if ($el->link_self) $el = _c($el->link_self);
                $el->$prop->assign($bitmap);
					if( method_exists($el, $m) )
					$el->$m($bitmap);
            }
            
			if(isset($param['UPDATE']))
				if ($param['UPDATE']) $myProperties->setProps();
            
            if (!$bitmap->isEmpty()){
                $obj->value = '(' . t('image') . ')';
            } else
                $obj->value = '(' . t('None') . ')';
                
            $_sc->update();  // fix bug
        }
        
        $dlg->free();
		self::updateProps();
	}
    
    public static function VSComponentsClick($self){
        
        global $myProperties, $_sc, $fmEdit;
        
        $param = $myProperties->elements[ $self ];
        $prop  = $param['PROP'];
        
        $dlg = new TObjectsDialog;
        
        if ($dlg->execute(false,'',true)){
            
            $obj = _c($self);
            $value = $dlg->value;
            $targets = count($_sc->targets_ex) ? $_sc->targets_ex : array($fmEdit);
            
            foreach ($targets as $el)
			{
				$el->$prop = $value;
			}
			if(isset($param['UPDATE']))
				if ($param['UPDATE']) $myProperties->setProps();
            $obj->value = $value;
        }
        
        $dlg->free();
        self::updateProps();
    }
    
    public static function VSSizesClick($self){
        
        global $myProperties, $_sc, $fmEdit;
        
        $param = $myProperties->elements[ $self ];
        $prop  = $param['PROP'];
        
        $dlg = new TSizesDialog;
        $dlg->setSizeControl( '_sc' );
        $dlg->setObject( $myProperties->selObj );
        
        if ($dlg->execute()){
            
        }
        $_sc->update();  // fix bug
        $dlg->free();
		self::updateProps();
    }
    
    public static function VSFontClick($self){
       
        global $myProperties, $_sc, $fmEdit;
        
        $param = $myProperties->elements[ $self ];
        $prop  = $param['PROP'];
        
        $dlg = new TFontDialog;
        $dlg->font->assign( $myProperties->selObj->$prop );
        
        if ($dlg->execute()){
            
            $font  = $dlg->font;
            $targets = count($_sc->targets_ex) ? $_sc->targets_ex : array($fmEdit);

            foreach ($targets as $link=>$el){
                if ($el->link_self) $el = _c($el->link_self);
                $el->$prop->assign($font);
            }
            
            self::setFontDsgn(_c($self), $font);
            $_sc->update();  // fix bug
        }
        
        $dlg->free();
		self::updateProps();
    }
    
    public static function VSColorClick($self){
       
        global $myProperties, $_sc, $fmEdit;
        
        $param = $myProperties->elements[ $self ];
        $prop  = $param['PROP'];
		
        $dlg = new TDMSColorDialog;
        $dlg->color = $myProperties->selObj->$prop;
        $colors = myOptions::get('colors','in',null);
		if( $colors!==null )
		{
			list($dlg->MainColors->text, $dlg->CustomColors->text) = unserialize(base64_decode($colors));
		}
        $x = cursor_real_x($dlg->form,10);
        $y = cursor_real_y($dlg->form,10);
        
        if ($dlg->execute($x, $y)){
            
            $color  = $dlg->color;
            $targets = count($_sc->targets_ex) ? $_sc->targets_ex : array($fmEdit);
            myHistory::add($targets, $prop);
            
            foreach ($targets as $link=>$el){
                if ($el->link_self) $el = _c($el->link_self);
                $el->$prop = $color;
            }
            
            self::setColorDsgn(_c($self), $color);
            $_sc->update();  // fix bug
			myOptions::set('colors', 'in', base64_encode(serialize(array($dlg->MainColors->text, $dlg->CustomColors->text))));
        }

			
        $dlg->free();
		self::updateProps();
    }
    public static function VSTIBClick($self)
	{
		global $myProperties, $_sc, $fmEdit;
        $prop  = 'images';
		$targets = count($_sc->targets_ex) ? $_sc->targets_ex : array($fmEdit);
		$ib = current($targets);
		if($ib == $fmEdit) return;
		$prev = $ib->$prop;
		$prev2 = isset($ib->state)? $ib->state: null;
		if( master_TIB::execute( $ib ) )
		{
            myHistory::add($targets, $prop);
            if( count($targets) > 1 )
				foreach ($targets as $link=>$el){
					if ($el->link_self) $el = _c($el->link_self);
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
        
        global $myProperties, $toSetProp, $_sc;
        if ($toSetProp) return;
        
        $param = $myProperties->elements[ $self ];
        $prop  = $param['PROP'];
        
        $dlg = new TMenuDialog;
        $dlg->value = $myProperties->selObj->$prop;
        
        if ($dlg->execute()){
            
            $value = $dlg->value;
            c($self)->value = $value;
            
            $targets = count($_sc->targets_ex) ? $_sc->targets_ex : array($fmEdit);
            myHistory::add($targets, $prop);
            
                foreach ($targets as $self=>$el){
                    if ($el->link_self) $el = _c($el->link_self);
                    $el->$prop = $value;
                }
                
            $_sc->update();  // fix bug
        }
        
        $dlg->free(); 
		self::updateProps();
    }
    
    public static function VSButtonClick($self){
        
        global $myProperties, $toSetProp, $_sc;
        if ($toSetProp) return;
        
        clearEditorHotKeys();
        
        $param = $myProperties->elements[ $self ];
        $prop  = $param['PROP'];
        
        $dlg = new TTextDialog;
        $dlg->value = $myProperties->selObj->$prop;
        
        if ($dlg->execute()){
            
            c($self)->value = $dlg->value;
            $value = $dlg->value; // f.b.
            
            $targets = count($_sc->targets_ex) ? $_sc->targets_ex : array($fmEdit);
            myHistory::add($targets, $prop);
            
                foreach ($targets as $self=>$el){
                    if ($el->link_self) $el = _c($el->link_self);
                    $el->$prop = $value;
                }
            
            $_sc->update();  // fix bug
        }
        
        $dlg->free();
		self::updateProps();
    }
    
    public static function VSEdit($self, $link, $value, $CAN){
        
        global $myProperties, $_sc, $fmEdit, $toSetProp;
        if ($toSetProp) return;
        
        clearEditorHotKeys();
        
        $param = $myProperties->elements[ $link ];
        $prop  = $param['PROP'];
        
        
        if ($param['TYPE']=='font'){
            
            $font = $myProperties->selObj->$prop;    
            
            self::setFontDsgn(c($link), $font);
            return false;
        }
		if ($param['TYPE']=='stfont'){
            
            $font = $myProperties->selObj->$prop;    
            
            self::setFontDsgn(c($link), $font);
            return false;
        }
        
        if ($param['TYPE']=='color'){
            
            $color = $myProperties->selObj->$prop;    
            
            self::setColorDsgn(c($link), $color);
            return false;
        }
        
        if ($param['TYPE']=='sizes'){
            
            $color = $myProperties->selObj->$prop;    
            
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
            
            global $myProperties;
            $obj = $myProperties->selObj;    
            
            //myHistory::add($obj, $prop);
            
		
	    if (!preg_match('/^[a-z]{1}[a-z0-9\_]*$/i',$value)){
                c($link)->value = $value;
                return;
            }
	        
            myDesign::changeName($obj, $value);
        
        } else {
            
            $targets = count($_sc->targets_ex) ? $_sc->targets_ex : array($fmEdit);
            myHistory::add($targets, $prop);
			
            foreach ($targets as $self=>$el){
                
                $el->$prop = $value;
            }
            
            $_sc->update();  // fix bug
            $_sc->updateBtns();
            
            //$myProperties->unFocusPanel();
        }
		self::updateProps();
    }
    
    public static function VSBarClick($self, $prop, $index){
        
        global $myProperties, $_sc, $fmEdit, $toSetProp;
        if ($toSetProp) return;
        
        $param = $myProperties->elements[ $prop ];
        
        if ($param['TYPE']!=='check') return;
        
        $value = _c($prop)->value === t('Yes') ? true : false;
        
        $prop  = $param['PROP'];
        $targets = count($_sc->targets_ex) ? $_sc->targets_ex : array($fmEdit);
        myHistory::add($targets, $prop);
        
        foreach ($targets as $self=>$el){
            if ($el->link_self) $el = _c($el->link_self);
            $el->$prop = $value;
        }
        $_sc->update();  // fix bug
		self::updateProps();
    }
    
    function formSelect($self, $form){
        
        global $myProject, $fmEdit, $formSelected, $_FORMS;
        
        $position     = $form->findComponent('c_position')->items->selected;
        $windowState  = $form->findComponent('c_windowstate')->items->selected;
        $formStyle    = $form->findComponent('c_formstyle')->items->selected;
        $borderStyle  = $form->findComponent('c_borderstyle')->items->selected;
        
        $visible      = $form->findComponent('c_visible')->checked;
        $noload       = $form->findComponent('c_noload')->checked;
        $i_close      = $form->findComponent('c_close')->checked;
        $i_min        = $form->findComponent('c_min')->checked;
        $i_max        = $form->findComponent('c_max')->checked;
               
        $e_minwidth   = $form->findComponent('e_minwidth');
        $e_minheight  = $form->findComponent('e_minheight');
        $e_maxheight  = $form->findComponent('e_maxheight');
        $e_maxwidth   = $form->findComponent('e_maxwidth');
        
        $fmEdit->constraints->maxheight  = $e_maxheight->text;
        $fmEdit->constraints->maxwidth  = $e_maxwidth->text;
        $fmEdit->constraints->minheight = $e_minheight->text;
        $fmEdit->constraints->minwidth  = $e_minwidth->text;
        
        $info =& $myProject->formsInfo[$_FORMS[$formSelected]];
        $info['position']    = $position;
        $info['windowState'] = $windowState;
        $info['formStyle']   = $formStyle;
        $info['borderStyle'] = $borderStyle;
        $info['visible']     = $visible;
        $info['noload']      = $noload;
        $info['i_close']     = $i_close;
        $info['i_min']       = $i_min;
        $info['i_max']       = $i_max;
        
        myProject::saveFormInfo();
    }
    
    
    function formShow($self, $form, $x = true){
        
        global $myProject, $formSelected, $_FORMS, $fmEdit;
        
        $c_position   = $form->findComponent('c_position');
        $c_windowState= $form->findComponent('c_windowstate');
        $c_formstyle  = $form->findComponent('c_formstyle');
        $c_borderstyle= $form->findComponent('c_borderstyle');
        
        $c_visible    = $form->findComponent('c_visible');
        $c_noload     = $form->findComponent('c_noload');
        $i_close      = $form->findComponent('c_close');
        $i_min        = $form->findComponent('c_min');
        $i_max        = $form->findComponent('c_max');
        
        $e_minwidth   = $form->findComponent('e_minwidth');
        $e_minheight  = $form->findComponent('e_minheight');
        $e_maxheight  = $form->findComponent('e_maxheight');
        $e_maxwidth   = $form->findComponent('e_maxwidth');
        
        $e_maxheight->text = $fmEdit->constraints->maxheight;
        $e_maxwidth->text  = $fmEdit->constraints->maxwidth;
        $e_minheight->text = $fmEdit->constraints->minheight;
        $e_minwidth->text  = $fmEdit->constraints->minwidth;
        
        $form->findComponent('ud_maxheight')->position = $fmEdit->constraints->maxheight;
        $form->findComponent('ud_maxwidth')->position  = $fmEdit->constraints->maxwidth;
        $form->findComponent('ud_minheight')->position = $fmEdit->constraints->minheight;
        $form->findComponent('ud_minwidth')->position  = $fmEdit->constraints->minwidth;
        
        $info = $myProject->formsInfo[$_FORMS[$formSelected]];
        
        if ($info['position']){
            $c_position->items->selected    = $info['position'];
            $c_windowState->items->selected = $info['windowState'];
            $c_formstyle->items->selected   = $info['formStyle'];
            $c_borderstyle->items->selected   = $info['borderStyle'];
            
            $c_visible->checked      = (bool)$info['visible'];
            $c_noload->checked       = (bool)$info['noload'];
            $i_close->checked        = $info['i_close'];
            $i_max->checked          = $info['i_max'];
            $i_min->checked          = $info['i_min'];
        } else {
            $c_position->items->selected    = 'poDesigned';
            $c_windowState->items->selected = 'wsNormal';
            $c_formstyle->items->selected   = 'fsNormal';
            $c_visible->checked = false;
            $c_noload->checked = false;
            $i_close->checked   = true;
            $i_max->checked     = true;
            $i_min->checked     = true;
        }
        
    }
    
    static function setFontDsgn($obj, $font){
        
        $obj->valueFont('name',$font->name);
        $obj->valueFont('color',$font->color);
        $obj->valueFont('style',$font->style);
        $obj->valueFont('charset',$font->charset);
             
        $obj->value = $font->name. ','. $font->size .','. toHTMLColor($font->color);
    }
    
    static function setColorDsgn($obj, $color){
        
       // $obj->valueFont('color',$color);
        $obj->value = toHTMLColor($color);
    }
    
    static function updateProps()
	{
        $GLOBALS['myProperties']->_setProps(true);
    }
    function _setProps($update = false){
        
        global $_c, $toSetProp, $fmEdit;
        $toSetProp = true;
        if( !is_object($this->selObj) )
			$this->selObj = $fmEdit;
        $elements = $this->params[$this->selObj->className];
        
		if( is_array($elements) )
			foreach ($elements as $self=>$param){
            
				if (!isset($param['TYPE'])) continue;
            
				$prop = is_array($param['PROP']) ? $param['PROP'][0] : $param['PROP'];
				$value = $this->selObj->$prop;
            
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
                
					$ovalue = $this->selObj->$prop;
                
					if ($ovalue)
					if (!$ovalue->isEmpty())
						$obj->value = '(' . t('image') . ')';
					else
						$obj->value = '(' . t('None') . ')';
                    
                
				} elseif ($param['TYPE']=='font'){
                
					self::setFontDsgn($obj, $this->selObj->$prop);
                
				} elseif ($param['TYPE']=='stfont'){
                
					self::setFontDsgn($obj, $this->selObj->$prop);
                
				} elseif ($param['TYPE']=='color'){
                
					self::setColorDsgn($obj, $this->selObj->$prop);
                
				} elseif ($param['TYPE']=='form') {
                
					$obj->value = '('.t('Properties').')';
                
				} elseif ($param['TYPE']=='sizes') {
                
					$obj->value = '('.t('Sizes & Position').')';
                
				} elseif ($param['TYPE']=='hotkey') {
					$obj->value = $this->selObj->$prop;
                
				} elseif ($param['TYPE']=='components'){
                
					$obj->value = $this->selObj->$prop;
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
						$file = str_replace(array(dirname($projectFile),'//'),array('','//'), $file);
						if ($file[0]=='/')
							$file[0] = ' '; $file = ltrim($file);
                    
						if (!in_array($file, $items))
							$items[] = $file;
					}
                
					$obj->text  = $items;
					$obj->value = $this->selObj->$prop;
				} elseif ($param['TYPE']=='tib') {
					self::setTibDsgn($obj, count($this->selObj->images));
				} else {
					//$obj->text = $this->selObj->$prop;
					$obj->value = (string)$this->selObj->$prop;
				}
            
			}
			
			$toSetProp = false;
    }
    
    function setProps(){
        global $myProperties; $myProperties->_setProps();
        //setTimeout(25, 'global $myProperties; $myProperties->_setProps()');
    }
    
    
    function createXName(&$param, $class){
    
        self::createXText($param, $class);    
    }
    
    function createXText(&$param, $class){
        
        $edt = new TNxButtonItem;
        $edt->caption = $param['CAPTION'];
        
		if (isset($param['ADD_GROUP'])){
			if ($param['ADD_GROUP']){
				$edt = _c($this->panels[$class]['GROUP_ADD']->add($edt, $param['CAPTION']));
			}else{
				$edt = _c($this->panels[$class]['GROUP']->add($edt, $param['CAPTION']));
			}
		}else{
			$edt = _c($this->panels[$class]['GROUP']->add($edt, $param['CAPTION']));
		}
        $edt->ButtonCaption = '...';
        $edt->buttonWidth = 19;

		if(trim(isset($param['REAL_PROP'])? $param['REAL_PROP']: '')>'')
			$edt->hint = $param['CAPTION']."\r\n[->{$param['REAL_PROP']}]";
		else
			$edt->hint = $param['CAPTION']."\r\n[->{$param['PROP']}]";
        $edt->showHint = true;
        $edt->onButtonClick = 'myProperties::VSButtonClick';
        
        $this->params[$class][$edt->self] =& $param; 
        $this->elements[$edt->self] = $param;
    }
    
    
    function createXMenu(&$param, $class){
        
        $edt = new TNxButtonItem;
        
        if (isset($param['ADD_GROUP'])){
			if ($param['ADD_GROUP']){
				$edt = _c($this->panels[$class]['GROUP_ADD']->add($edt, $param['CAPTION']));
			}else{
				$edt = _c($this->panels[$class]['GROUP']->add($edt, $param['CAPTION']));
			}
		}else{
			$edt = _c($this->panels[$class]['GROUP']->add($edt, $param['CAPTION']));
		}
        $edt->ButtonCaption = '...';
        $edt->buttonWidth = 19;
        if(trim(isset($param['REAL_PROP'])? $param['REAL_PROP']: '')>'')
			$edt->hint = $param['CAPTION']."\r\n[->{$param['REAL_PROP']}]";
		else
			$edt->hint = $param['CAPTION']."\r\n[->{$param['PROP']}]";
        $edt->showHint = true;
        //$edt->readOnly = true;
        $edt->onButtonClick = 'myProperties::VSMenuClick';
        
        $this->params[$class][$edt->self] =& $param;
        $this->elements[$edt->self] = $param;
    }
    
    
    function createXForm(&$param, $class){
        
        $edt = new TNxButtonItem;
        
        if (isset($param['ADD_GROUP'])){
			if ($param['ADD_GROUP']){
				$edt = _c($this->panels[$class]['GROUP_ADD']->add($edt, $param['CAPTION']));
			}else{
				$edt = _c($this->panels[$class]['GROUP']->add($edt, $param['CAPTION']));
			}
		}else{
			$edt = _c($this->panels[$class]['GROUP']->add($edt, $param['CAPTION']));
		}
        $edt->ButtonCaption = '...';
        $edt->buttonWidth = 19;
        if(trim(isset($param['REAL_PROP'])? $param['REAL_PROP']: '')>'')
			$edt->hint = $param['CAPTION']."\r\n[->{$param['REAL_PROP']}]";
		else
			$edt->hint = $param['CAPTION']."\r\n[->{$param['PROP']}]";
        $edt->showHint = true;
        $edt->value  = '('.t('Properties').')';
        
        $edt->onButtonClick = 'myProperties::VSFormClick';
        
        $this->params[$class][$edt->self] =& $param;
        $this->elements[$edt->self] = $param;
    }
    
    function createXColor(&$param, $class){
        
        $edt = new TNxButtonItem;
        
        if (isset($param['ADD_GROUP'])){
			if ($param['ADD_GROUP']){
				$edt = _c($this->panels[$class]['GROUP_ADD']->add($edt, $param['CAPTION']));
			}else{
				$edt = _c($this->panels[$class]['GROUP']->add($edt, $param['CAPTION']));
			}
		}else{
			$edt = _c($this->panels[$class]['GROUP']->add($edt, $param['CAPTION']));
		}
        $edt->ButtonCaption = '...';
        $edt->buttonWidth = 19;
        if(trim(isset($param['REAL_PROP'])? $param['REAL_PROP']: '')>'')
			$edt->hint = $param['CAPTION']."\r\n[->{$param['REAL_PROP']}]";
		else
			$edt->hint = $param['CAPTION']."\r\n[->{$param['PROP']}]";
        $edt->showHint = true;
        
        $edt->onButtonClick = 'myProperties::VSColorClick';
        
        $this->params[$class][$edt->self] =& $param;
        $this->elements[$edt->self] = $param;
    }
    function createXTib(&$param, $class){
        
        $edt = new TNxButtonItem;
        
        if (isset($param['ADD_GROUP'])){
			if ($param['ADD_GROUP']){
				$edt = _c($this->panels[$class]['GROUP_ADD']->add($edt, $param['CAPTION']));
			}else{
				$edt = _c($this->panels[$class]['GROUP']->add($edt, $param['CAPTION']));
			}
		}else{
			$edt = _c($this->panels[$class]['GROUP']->add($edt, $param['CAPTION']));
		}
        $edt->ButtonCaption = '...';
        $edt->buttonWidth = 19;
        if(trim(isset($param['REAL_PROP'])? $param['REAL_PROP']: '')>'')
			$edt->hint = $param['CAPTION']."\r\n[->{$param['REAL_PROP']}]";
		else
			$edt->hint = $param['CAPTION']."\r\n[->{$param['PROP']}]";
        $edt->showHint = true;
        
        $edt->onButtonClick = 'myProperties::VSTIBClick';
        
        $this->params[$class][$edt->self] =& $param;
        $this->elements[$edt->self] = $param;
    }
    function createXFont(&$param, $class){
        
        $edt = new TNxButtonItem;
         if (isset($param['ADD_GROUP'])){
			if ($param['ADD_GROUP']){
				$edt = _c($this->panels[$class]['GROUP_ADD']->add($edt, $param['CAPTION']));
			}else{
				$edt = _c($this->panels[$class]['GROUP']->add($edt, $param['CAPTION']));
			}
		}else{
			$edt = _c($this->panels[$class]['GROUP']->add($edt, $param['CAPTION']));
		}
        if(trim(isset($param['REAL_PROP'])? $param['REAL_PROP']: '')>'')
			$edt->hint = $param['CAPTION']."\r\n[->{$param['REAL_PROP']}]";
		else
			$edt->hint = $param['CAPTION']."\r\n[->{$param['PROP']}]";
        $edt->showHint    = true;
        $edt->buttonWidth = 19;
        $edt->value       = '('. t('Font options') .')';
        
        $edt->ButtonCaption = '...';
        
        $edt->onButtonClick = 'myProperties::VSFontClick';
        
        $this->params[$class][$edt->self] =& $param;
        $this->elements[$edt->self] = $param;
    }
    function createXSTFont(&$param, $class){
        
        $edt = new TNxButtonItem;
        if (isset($param['ADD_GROUP'])){
			if ($param['ADD_GROUP']){
				$edt = _c($this->panels[$class]['GROUP_ADD']->add($edt, $param['CAPTION']));
			}else{
				$edt = _c($this->panels[$class]['GROUP']->add($edt, $param['CAPTION']));
			}
		}else{
			$edt = _c($this->panels[$class]['GROUP']->add($edt, $param['CAPTION']));
		}
        
        if(trim(isset($param['REAL_PROP'])? $param['REAL_PROP']: '')>'')
			$edt->hint = $param['CAPTION']."\r\n[->{$param['REAL_PROP']}]";
		else
			$edt->hint = $param['CAPTION']."\r\n[->{$param['PROP']}]";
        $edt->showHint    = true;
        $edt->buttonWidth = 19;
        $edt->value       = '('. t('Font options') .')';
        
        $edt->ButtonCaption = '...';
        
        $edt->onButtonClick = 'myProperties::VSFontClick';
        
        $this->params[$class][$edt->self] =& $param;
        $this->elements[$edt->self] = $param;
    }
    function createXNumber(&$param, $class){
        
        $edt = new TNxSpinItem;
        if (isset($param['ADD_GROUP'])){
			if ($param['ADD_GROUP']){
				$edt = _c($this->panels[$class]['GROUP_ADD']->add($edt, $param['CAPTION']));
			}else{
				$edt = _c($this->panels[$class]['GROUP']->add($edt, $param['CAPTION']));
			}
		}else{
			$edt = _c($this->panels[$class]['GROUP']->add($edt, $param['CAPTION']));
		}
        if ($class == 'TForm'){
            global $propFormW, $propFormH;
            
            if ($param['PROP']=='clientWidth')
                $propFormW = $edt;
            if ($param['PROP']=='clientHeight')
                $propFormH = $edt;
        }
        
        if(trim(isset($param['REAL_PROP'])? $param['REAL_PROP']: '')>'')
			$edt->hint = $param['CAPTION']."\r\n[->{$param['REAL_PROP']}]";
		else
			$edt->hint = $param['CAPTION']."\r\n[->{$param['PROP']}]";
        $edt->showHint = true;
        
        $this->params[$class][$edt->self] =& $param;
        $this->elements[$edt->self] = $param;
    }
    
    function createXHotkey(&$param, $class){
        
        $edt = new TNxButtonItem;
        $edt->caption = $param['CAPTION'];
        
        if (isset($param['ADD_GROUP'])){
			if ($param['ADD_GROUP']){
				$edt = _c($this->panels[$class]['GROUP_ADD']->add($edt, $param['CAPTION']));
			}else{
				$edt = _c($this->panels[$class]['GROUP']->add($edt, $param['CAPTION']));
			}
		}else{
			$edt = _c($this->panels[$class]['GROUP']->add($edt, $param['CAPTION']));
		}
        $edt->ButtonCaption = '...';
        $edt->buttonWidth = 19;
        if(trim(isset($param['REAL_PROP'])? $param['REAL_PROP']: '')>'')
			$edt->hint = $param['CAPTION']."\r\n[->{$param['REAL_PROP']}]";
		else
			$edt->hint = $param['CAPTION']."\r\n[->{$param['PROP']}]";
        $edt->showHint = true;
        $edt->onButtonClick = 'myProperties::VSButtonClick';
        
        $this->params[$class][$edt->self] =& $param;
        $this->elements[$edt->self] = $param;
    }
    
    function createXImage(&$param, $class){
        
        $edt = new TNxButtonItem;
        $edt->caption = $param['CAPTION'];
        
        if (isset($param['ADD_GROUP'])){
			if ($param['ADD_GROUP']){
				$edt = _c($this->panels[$class]['GROUP_ADD']->add($edt, $param['CAPTION']));
			}else{
				$edt = _c($this->panels[$class]['GROUP']->add($edt, $param['CAPTION']));
			}
		}else{
			$edt = _c($this->panels[$class]['GROUP']->add($edt, $param['CAPTION']));
		}
        $edt->ButtonCaption = '...';
        $edt->buttonWidth = 19;
        if(trim(isset($param['REAL_PROP'])? $param['REAL_PROP']: '')>'')
			$edt->hint = $param['CAPTION']."\r\n[->{$param['REAL_PROP']}]";
		else
			$edt->hint = $param['CAPTION']."\r\n[->{$param['PROP']}]";
        $edt->showHint = true;
        $edt->value       = '('. t('None') .')';
        
        $edt->onButtonClick = 'myProperties::VSImageClick';
        
        $this->params[$class][$edt->self] =& $param;
        $this->elements[$edt->self] = $param;
    }
    
    function createXCombo(&$param, $class){
        
        $edt = new TNxComboBoxItem;
        $edt->caption = $param['CAPTION'];
        
        if (isset($param['ADD_GROUP'])){
			if ($param['ADD_GROUP']){
				$edt = _c($this->panels[$class]['GROUP_ADD']->add($edt, $param['CAPTION']));
			}else{
				$edt = _c($this->panels[$class]['GROUP']->add($edt, $param['CAPTION']));
			}
		}else{
			$edt = _c($this->panels[$class]['GROUP']->add($edt, $param['CAPTION']));
		}
        
        if (count($param['VALUES']))
            $edt->text = $param['VALUES'];
        
        if(trim(isset($param['REAL_PROP'])? $param['REAL_PROP']: '')>'')
			$edt->hint = $param['CAPTION']."\r\n[->{$param['REAL_PROP']}]";
		else
			$edt->hint = $param['CAPTION']."\r\n[->{$param['PROP']}]";
        $edt->showHint = true;
		
        //_c($tmp)->onButtonClick = 'myProperties::VSButtonClick';
        $this->params[$class][$edt->self] =& $param;
        $this->elements[$edt->self] = $param;
    }
    
    /*function createXComponents($param, $class){
        
        $edt = new TNxComboBoxItem;
        $edt->caption = $param['CAPTION'];
        
        if ($param['ADD_GROUP'])
            $edt = _c($this->panels[$class]['GROUP_ADD']->add($edt, $param['CAPTION']));
        else
            $edt = _c($this->panels[$class]['GROUP']->add($edt, $param['CAPTION']));
        
        $edt->hint = $param['CAPTION'];
        $edt->showHint = true;

        $this->elements[$edt->self] = $param;
    }*/
        
    
    function createXComponents(&$param, $class){
      
        $edt = new TNxButtonItem;
        
        if (isset($param['ADD_GROUP'])){
			if ($param['ADD_GROUP']){
				$edt = _c($this->panels[$class]['GROUP_ADD']->add($edt, $param['CAPTION']));
			}else{
				$edt = _c($this->panels[$class]['GROUP']->add($edt, $param['CAPTION']));
			}
		}else{
			$edt = _c($this->panels[$class]['GROUP']->add($edt, $param['CAPTION']));
		}
        if(trim(isset($param['REAL_PROP'])? $param['REAL_PROP']: '')>'')
			$edt->hint = $param['CAPTION']."\r\n[->{$param['REAL_PROP']}]";
		else
			$edt->hint = $param['CAPTION']."\r\n[->{$param['PROP']}]";
        $edt->showHint    = true;
        $edt->buttonWidth = 19;
        $edt->ButtonCaption = '...';
        $edt->caption = $param['CAPTION'];
        
        $edt->onButtonClick = 'myProperties::VSComponentsClick';
        $this->params[$class][$edt->self] =& $param;
        $this->elements[$edt->self] = $param;
    }
    
    function createXFiles(&$param, $class){
        
        $edt = new TNxComboBoxItem;
        $edt->caption = $param['CAPTION'];
        
        if (isset($param['ADD_GROUP'])){
			if ($param['ADD_GROUP']){
				$edt = _c($this->panels[$class]['GROUP_ADD']->add($edt, $param['CAPTION']));
			}else{
				$edt = _c($this->panels[$class]['GROUP']->add($edt, $param['CAPTION']));
			}
		}else{
			$edt = _c($this->panels[$class]['GROUP']->add($edt, $param['CAPTION']));
		}
        if(trim(isset($param['REAL_PROP'])? $param['REAL_PROP']: '')>'')
			$edt->hint = $param['CAPTION']."\r\n[->{$param['REAL_PROP']}]";
		else
			$edt->hint = $param['CAPTION']."\r\n[->{$param['PROP']}]";
        $edt->showHint = true;

        $this->params[$class][$edt->self] =& $param;
        $this->elements[$edt->self] = $param;
    }
    
    function createXCheck(&$param, $class){
        
        $edt = new TNxCheckBoxItem;
        
        if (isset($param['ADD_GROUP'])){
			if ($param['ADD_GROUP']){
				$edt = _c($this->panels[$class]['GROUP_ADD']->add($edt, $param['CAPTION']));
			}else{
				$edt = _c($this->panels[$class]['GROUP']->add($edt, $param['CAPTION']));
			}
		}else{
			$edt = _c($this->panels[$class]['GROUP']->add($edt, $param['CAPTION']));
		}
        
        $edt->showText = true;
        $edt->TextKind = 'tkCustom';
        $edt->TrueText = t('Yes');
        $edt->FalseText = t('No');
        if(trim(isset($param['REAL_PROP'])? $param['REAL_PROP']: '')>'')
			$edt->hint = $param['CAPTION']."\r\n[->{$param['REAL_PROP']}]";
		else
			$edt->hint = $param['CAPTION']."\r\n[->{$param['PROP']}]";
        $edt->showHint = true;
        
        //_c($tmp)->onButtonClick = 'myProperties::VSButtonClick';
        $this->params[$class][$edt->self] = &$param;
        $this->elements[$edt->self] = $param;
    }
    
    function createXSizes(&$param, $class){
        
        $edt = new TNxButtonItem;
        
        if (isset($param['ADD_GROUP'])){
			if ($param['ADD_GROUP']){
				$edt = _c($this->panels[$class]['GROUP_ADD']->add($edt, $param['CAPTION']));
			}else{
				$edt = _c($this->panels[$class]['GROUP']->add($edt, $param['CAPTION']));
			}
		}else{
			$edt = _c($this->panels[$class]['GROUP']->add($edt, $param['CAPTION']));
		}
        
       if(trim(isset($param['REAL_PROP'])? $param['REAL_PROP']: '')>'')
			$edt->hint = $param['CAPTION']."\r\n[->{$param['REAL_PROP']}]";
		else
			$edt->hint = $param['CAPTION']."\r\n[->{$param['PROP']}]";;
        
        $edt->showHint    = true;
        $edt->buttonWidth = 19;
        $edt->value       = '('.t('Sizes & Position').')';;
        
        $edt->ButtonCaption = '...';
        
        $edt->onButtonClick = 'myProperties::VSSizesClick';
        $this->params[$class][$edt->self] =& $param;
        $this->elements[$edt->self] = $param;
    }
    
    static function unFocusPanel(){
        
        global $myProperties;
		if(is_object($myProperties) && is_object($myProperties->panels[$myProperties->last_class]['PANEL']))
        if ( $myProperties->panels[$myProperties->last_class]['PANEL']->self ){ // fix bug
            $myProperties->panels[$myProperties->last_class]['PANEL']->unfocus();
        }
    }
    
    function generate($self,$panel){
       
        global $componentProps;
        
        if (is_object($self)){
            $class = $self->className;
            $self  = $self->self;
        } else
            $class = rtti_class($self);
         

        if (!is_object($this->selObj) || $this->last_class !== $class){
          
            $this->selObj = toObject($self);
            $this->panel  = $panel;    
           
            if (!isset($this->panels[$class])){
                if (is_array($componentProps[$class])){
                    
					
                                       
                    $this->generateClass($class, 0);      
                    if (isset($this->panels[$this->last_class]['PANEL'])){
                        $this->panels[$class]['PANEL']->splitterPosition = $this->panels[$this->last_class]['PANEL']->splitterPosition;
                        myOptions::set('panelLeft', 'splitterW', $this->panels[$this->last_class]['PANEL']->splitterPosition);
                    }
                    else {
						
						if(is_object($this) && isset($this->panels) && isset($this->panels[$class]) && isset($this->panels[$class]['PANEL']))
							if(is_object($this->panels[$class]['PANEL']))
								if(myOptions::get('panelLeft', 'splitterW', null)!==null)
								$this->panels[$class]['PANEL']->splitterPosition = (int)myOptions::get('panelLeft', 'splitterW',0);
                    }
					//pre( $this->panels[$class]['PANEL'] 
                }
                
                       
            } else {
                
                if (isset($this->panels[$this->last_class]['PANEL'])) {
                    $this->panels[$class]['PANEL']->splitterPosition = $this->panels[$this->last_class]['PANEL']->splitterPosition;
                    myOptions::set('panelLeft', 'splitterW', $this->panels[$this->last_class]['PANEL']->splitterPosition);
                }
                
				if( isset($this->panels[$class]['PANEL']) ){
					$panel = $this->panels[$class]['PANEL'];

					$panel->show();
					$panel->toFront();
				}
            }
            
            global $fmMain;
            
            $this->setProps();
            
            myInspect::genList($this->selObj);
            
            $this->last_class = rtti_class($this->selObj->self);
            
        } else {
            
            $to_update = $this->selObj->self !== $self;
            $this->selObj = _c($self);
            
            
            if ($to_update){
                $this->setProps();
                myInspect::genList($this->selObj);
            }
            
            if ($this->selObj->link_name){
                $this->selObj = _c($this->selObj->link_self);
            }
            
        }
        
        myInspect::updateSelected();   
    }
    
    public function _generateClass($class){
        
        global $componentProps, $fmMain;
        
            
        if (!isset($this->panels[$class])){
			$theme = dsThemeDesign::$dir; //#ADDOPT;
			
            c("fmMain->editorPopup")->AutoPopup = false;
			
            $panel = new TNextInspector( $fmMain );
            $panel->parent = c('fmPropsAndEvents->tabProps');
            $panel->align  = 'alClient';
            $panel->enableVisualStyles = true;
			$panel->borderStyle = bsNone;
            $panel->rowHeight = 20;
            $panel->HighlightTextColor = 0xC1FFFF;
            $panel->onVSEdit = 'myProperties::VSEdit';
            $panel->onVSToolBarClick = 'myProperties::VSBarClick';
			$panel->Glyphs = c("fmMain->NXGlyphos");
			$panel->ButtonsStyle = 1; //btCustom
			gui_propSet($panel->self, 'Color', clWindow);
			gui_propSet($panel->self, 'CategoriesColor', clBtnFace);
            $gr = new TNxToolbarItem;
			gui_propSet(gui_propGet($gr->self, 'Font'), 'Color', clWindowText);
            $gr->caption = t('gr_main');
			gui_propSet($gr->self, 'Color', clBlack);
            $panel->addItem(null, $gr, apFirst);
            
            $this->panels[$class]['PANEL'] = $panel;
            $this->panels[$class]['GROUP'] = $gr;
                
            if ($class!=='TForm'){
                $componentProps[$class] =
                array_merge(array(array('CAPTION'=>t('Name'),'TYPE'=>'Name','PROP'=>'name','ADD_GROUP'=>true)),
                            (array)$componentProps[$class]);
                $componentProps[$class] = array_values($componentProps[$class]);
            }
            
            if (is_array($componentProps[$class])){
                    
                $create_addgr = false;
				$del = true;
			foreach ($componentProps[$class] as &$prop){
                    
                if (!isset($prop['TYPE'])) continue;
                
				if(isset($prop['ADD_GROUP']))
				{
					if (!$create_addgr && $prop['ADD_GROUP']){
						$gr2 = new TNxToolbarItem;
						$gr2->caption = t('gr_additional');
						$panel->addItem(null, $gr2);
                    
						$this->panels[$class]['GROUP_ADD'] = $gr2;
						$create_addgr = true;
					}
					if( !$prop['ADD_GROUP'] )
						$del = false;
				} else {
					$del = false;
				}
					
                if (method_exists($this,'createX'.$prop['TYPE'])){
					
                        $this->{'createX'.$prop['TYPE']}($prop, $class);

                        if ($prop['TYPE']=='font'){
                            $xprop = array('CAPTION'=>t('Font Color'), 'TYPE'=>'color', 'PROP'=>'fontColor', 'REAL_PROP'=>'font->color');
                            $this->{'createX'.$xprop['TYPE']}($xprop, $class);
						}	
						 if ($prop['TYPE']=='font' or (strtolower($prop['CAPTION'])==strtolower(t('Font Color')) and $prop['TYPE']=='color')){
							$xr = array('CAPTION'=>t('Font Size'), 'TYPE'=>'number', 'PROP'=>'fontsize', 'REAL_PROP'=>'font->size');
							$xt = array('CAPTION'=>t('Font Height'), 'TYPE'=>'number', 'PROP'=>'fontheight');
							$xo = array('CAPTION'=>t('Font Pitch'), 'TYPE'=>'combo', 'PROP'=>'fontpitch', 'REAL_PROP'=>'font->pitch', 'VALUES'=>array('fpDefault','fpVariable', 'fpFixed'));
							$xq = array('CAPTION'=>t('Font Quality'), 'TYPE'=>'combo', 'PROP'=>'fontquality', 'REAL_PROP'=>'font->quality', 'VALUES'=>array('fqDefault', 'fqDraft', 'fqProof', 'fqNonAntialiased', 'fqAntialiased', 'fqClearType', 'fqClearTypeNatural'));
							$xla = array('CAPTION'=>t('Font Orientation'), 'TYPE'=>'number', 'PROP'=>'fontori', 'REAL_PROP'=>'font->orientation');
							
                            $this->{'createX'.$xr['TYPE']}($xr, $class);
							
                            $this->{'createX'.$xt['TYPE']}($xt, $class);
							
                            $this->{'createX'.$xo['TYPE']}($xo, $class);
							
                            $this->{'createX'.$xq['TYPE']}($xq, $class);
							
							$this->{'createX'.$xla['TYPE']}($xla, $class);
						}
                }
            }
            }
            if( $del )
			 {	$gr->free(); }   
                $this->panels[$class]['EL']  = $this->elements;
				
			c("fmMain->editorPopup")->AutoPopup = true;
        }
    }
    
    public function generateClass($class, $back = false){
        
        $this->_generateClass($class);
    }
    
    public function _generateAllClasses(){
        
        $this->panel = c('fmPropsAndEvents->tabProps',1);
        lockWindowUpdate($this->panel->handle);
        
        global $componentClasses;
        $i = 0;
        foreach ((array)$componentClasses as $c){
            ++$i;
            if ($i>=1) break;
            $this->generateClass($c['CLASS']);
        }
        
        lockWindowUpdate(0);    
    }
    
    public function generateAllClasses(){
        $this->_generateAllClasses();
    }
    
    static function getPropertyText($code){
        
        global $componentProps;
        $result = [];
        
        foreach ((array)$componentProps as $x)
            foreach ((array)$x as $el){
                if (!$el['PROP']) continue;
            
                if ($el['REAL_PROP'])
                    $el['PROP'] = $el['REAL_PROP'];
                
                if ( $code==$el['PROP'] ){
                    return $el['CAPTION'];
                }
            }
            
        return '';
    }
    
    static function getPropertiesInfo($class){
        
        global $componentProps;
        $result = [];
        
        foreach ((array)$componentProps[$class] as $el){
            
            if (!$el['PROP']) continue;
            
            if ($el['REAL_PROP'])
                $el['PROP'] = $el['REAL_PROP'];
                
            $result[] = $el;
        }
        return $result;
    }
    
    static function getMethodsInfo($class){
        if( !strlen(trim($class) ) ) return [
		[
		'CAPTION'=>t('Free'),
		'PROP'=>'free()',
		'INLINE'=>'free ( void )',
		]];
		return get_sorted_methods($class);
    }
    
    static function fixSplitterMoved($self){
        if(!c('fmPropsAndEvents') || c('fmPropsAndEvents') instanceof DebugClass ) return;
        c('fmPropsAndEvents->tabProps',1)->repaint();
    }
	static function fixSel($self)
	{
		global $_sc;
		if( isset($_sc) && !($_sc instanceof DebugClass) )
			$_sc->update();
	}
}