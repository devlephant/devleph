<?
/*--pseudocode--*
interface IEditor
{
	//!! - Required
	
	const type = "TNxButtonItem";
	//!!
	
	const caption = "Static Property";
	
	public static function OnCreate( TNxPropertyItem $Item, $class, array &$prop );
	//!!
	
	public static function OnEdit( TNxProperty item $Item, string $property, mixed $value, bool &$continue);
	public static function SaveValue( array &$prop, mixed $value);
	public static function Click( int $self );
	public static function Update( TNxButtonItem $Item, $value );
}
*/
class myProperties
{   
	const ButtonCaption = ". . .";
	const ButtonWidth = 19;
    public $panels; // панель свойств компонентов...
    public $elements;
    public $params;
    public $panel;
    
    public $selObj;
    
    public $last_class;
	public static $types;
	
    static function updateProps($p=false,$link=false)
	{
        $GLOBALS['myProperties']->_setProps($p,$link);
    }
    function _setProps($interclude=false,$exclude=false){
        
        global $_c, $toSetProp, $fmEdit;
        $toSetProp = true;
        if( !is_object($this->selObj) )
			$this->selObj = $fmEdit;
		if($interclude)
		{
			$arr = [$exclude];
			$exclude = false;
		}$arr =& $this->params[$this->selObj->className];
		if( is_array($arr) )
			foreach($arr as $self)
			{
				$param =& $this->elements[$self];
				if($self==$exclude) continue;
				if (!isset($param['TYPE'])) continue;
				if(isset(self::$types[$param['TYPE']]))
				{
					$type = self::$types[$param['TYPE']];
					if( defined("$type::caption") ) continue;
					$prop = $param['PROP'];
					$p = $this->selObj->$prop;
					if($this->selObj instanceof TForm && !is_object($this->selObj->$prop))
					{
						$fname =& $GLOBALS['_FORMS'][$GLOBALS['formSelected']];
						$formsinfo =& $GLOBALS['myProject']->formsInfo[$fname];
						if(strtolower($prop)=='name')
						{
							$p = $fname;
						} elseif( isSet( $formsinfo[$prop] ) )
						{
							$p = $formsinfo[$prop];
						}
					}
					if( $this->selObj->name!=="" && !gui_is($this->selObj->self, 'TControl') )
					{
						$prop =	strtolower($prop);
						$arr = ["x","y","w","h","left","top","width","height"];
						if(in_array($prop,$arr))
						{
							$pos = array_search($prop,$arr);
							$p = $GLOBALS['myProject']->formsInfo[$GLOBALS['_FORMS'][$GLOBALS['formSelected']]]["_v"][$this->selObj->name][ ($pos%2==0?1:0) ];
							if($pos%3==0||$pos%4==0)
								$p = 24;
						}
					}
					if( method_exists($type, "Update") )
					{
						$type::Update(_c($self),$p);
					} else _c($self)->value = $p;
				}
			}
		$toSetProp = false;
    }
    
    function setProps(){
        global $myProperties; $myProperties->_setProps();
        //setTimeout(25, 'global $myProperties; $myProperties->_setProps()');
    }
    
    static function unFocusPanel(){
        
        global $myProperties;
		if(is_object($myProperties) && is_object($myProperties->panels[$myProperties->last_class]['PANEL']))
        if ( $myProperties->panels[$myProperties->last_class]['PANEL']->self ){ // fix bug
            $myProperties->panels[$myProperties->last_class]['PANEL']->unfocus();
        }
    }
    
    function generate($self,$panel)
	{   
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
                if (is_array($componentProps[$class]))
				{                                  
                    $this->generateClass($class, 0);      
                    if (isset($this->panels[$this->last_class]['PANEL'])){
                        $this->panels[$class]['PANEL']->splitterPosition = $this->panels[$this->last_class]['PANEL']->splitterPosition;
                        myOptions::set('panelLeft', 'splitterW', $this->panels[$this->last_class]['PANEL']->splitterPosition);
                    } else {
						
						if(is_object($this) && isset($this->panels) && isset($this->panels[$class]) && isset($this->panels[$class]['PANEL']))
							if(is_object($this->panels[$class]['PANEL']))
								if(myOptions::get('panelLeft', 'splitterW', null)!==null)
								$this->panels[$class]['PANEL']->splitterPosition = (int)myOptions::get('panelLeft', 'splitterW',0);
                    }
                }      
            } else {
                if (isset($this->panels[$this->last_class]['PANEL']))
				{
                    $this->panels[$class]['PANEL']->splitterPosition = $this->panels[$this->last_class]['PANEL']->splitterPosition;
                    myOptions::set('panelLeft', 'splitterW', $this->panels[$this->last_class]['PANEL']->splitterPosition);
                }
                
				if( isset($this->panels[$class]) )
				{
					$this->panels[$class]['PANEL']->toFront();
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
            
        }
        
        myInspect::updateSelected();   
    }
	public static function VSEdit($self, $link, $value, $CAN){
        global $myProperties, $_sc, $fmEdit, $toSetProp, $_FORMS, $projectFile, $myProject, $formSelected;
        if ($toSetProp) return;
        clearEditorHotKeys();
        $param = $myProperties->elements[ $link ];
		$type = self::$types[$param['TYPE']];
		if( defined("$type::caption") )
		{
			_c($link)->value = "(" . t($type::caption) . ")";
		}
        $prop  = $param['PROP'];
		$obj =& $myProperties->selObj;
		if($obj instanceof TForm)
		{
			$prop = strtolower($prop);
			if($prop=="name")
			{
				$value = Localization::toEncoding($value);
				if (preg_match('/^([a-z]{1})([a-z0-9\_]+)$/i',$value)){
				foreach ($_FORMS as $el){
					if (strtolower($el)==strtolower($value)){
						return;
					}
				}
				myHistory::add([$fmEdit], $prop);
				$name = $GLOBALS['_FORMS'][$GLOBALS['formSelected']];
				$dfm_file = dirname($projectFile) .'/'. $name . '.dfm';
				$dfm_file2= dirname($projectFile) .'/'. $value . '.dfm';
				if (file_exists($dfm_file2))
					unlink($dfm_file2);
				
				rename($dfm_file, $dfm_file2);
				
				myDesign::groupChangeFormName($name, $value);
				myDesign::eventChangeFormName($name, $value);
				
					$k = array_search($name, $_FORMS);
					$_FORMS[$k] = $value;
					$id = c('fmMain->tabForms')->tabIndex;
					c('fmMain->tabForms')->tabs->setLine($k,$value.'.dfm');
					c('fmMain->tabForms')->tabIndex = $id;
					$myProject->formsInfo[$value] = $myProject->formsInfo[$name];
					unset($myProject->formsInfo[$name]);
					
					treeBwr_add();
				}
				return;
			}elseif( in_array($prop, ['cursor','x','y','autoscroll','alphablend','alphablendvalue','screensnap','snapbuffer','transparentcolor','transparentcolorvalue','doublebuffered']) )
			{
				myHistory::add([$fmEdit], $prop);
				$myProject->formsInfo[$_FORMS[$formSelected]][$prop] = Localization::toEncoding(method_exists($type,"SaveValue")?$type::SaveValue($param,$value):$value);
				return;
			}
		}
		$set_prop = false;
		$upd_sc = true;
			if ($prop=="name")
			{
				$upd_sc = false;
				if (!preg_match('/^[a-z]{1}[a-z0-9\_]*$/i',$value)){
					_c($link)->value = $value;
					return;
				}
				myHistory::add([$obj], $prop);
				myDesign::changeName($obj, $value);
			} elseif( method_exists($type, "OnEdit") )
			{
				$type::OnEdit(_c($link), $prop, $value, $set_prop);
			}
			else 	
				{
				$targets = $_sc->targets_ex;
				$targets = count($targets)>0? $targets: [$fmEdit];
				myHistory::add($targets, $prop);
				
				foreach ($targets as $link=>$el){
					_c(myDesign::noVisAlias($link))->$prop = $value;
				}
			}
		if($upd_sc)
		{
			$_sc->update();  // fix bug
			$_sc->updateBtns();
		}
		self::updateProps($set_prop,$link);
    }
	
	public static function VSBarClick($self, $link, $index){
        global $myProperties, $_sc, $fmEdit, $toSetProp, $myProject, $_FORMS, $formSelected;
        if ($toSetProp) return;
        
        $param = $myProperties->elements[ $link ];
        
        if ($param['TYPE']!=='check') return;
        
        $value = _c($link)->value === t('Yes') ? true : false;
        
        $prop  = $param['PROP'];
		if($myProperties->selObj instanceof TForm && 
			in_array(strtolower($prop), ['autoscroll','alphablend','screensnap','transparentcolor','doublebuffered']))
		{
			$myProject->formsInfo[$_FORMS[$formSelected]][$prop] = $value;
		} else {
		$targets = $_sc->targets_ex;
		$targets = count($targets)>0?$targets: [$fmEdit];
        myHistory::add($targets, $prop);
        
        foreach ($targets as $self=>$el){
           $el = _c(myDesign::noVisAlias($el->self));
            $el->$prop = $value;
        }
        $_sc->update();  // fix bug
		self::updateProps(false,$link);
		}
    }
    
    public function _generateClass($class)
	{    
        global $componentProps, $fmMain;
        if (!isset($this->panels[$class]))
		{
            c("fmMain->editorPopup")->AutoPopup = false;
			lockWindowUpdate($this->panel->handle);
            $panel = new TNextInspector( $fmMain );
            $panel->parent = c('fmPropsAndEvents->tabProps');
            $panel->BeginUpdate();
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
                $componentProps[$class][] =
							['CAPTION'=>t('Name'),'TYPE'=>'text','PROP'=>'name','ADD_GROUP'=>true];
				$componentProps[$class][] =
							['CAPTION'=>t('p_Left'),'TYPE'=>'int','PROP'=>'x','ADD_GROUP'=>true];
				$componentProps[$class][] =
							['CAPTION'=>t('p_Top'),'TYPE'=>'int','PROP'=>'y','ADD_GROUP'=>true];
				$componentProps[$class][] =
							['CAPTION'=>t('Width'),'TYPE'=>'int','PROP'=>'w','REAL_PROP'=>"clientWidth",'ADD_GROUP'=>true];
				$componentProps[$class][] =
							['CAPTION'=>t('Height'),'TYPE'=>'int','PROP'=>'h','REAL_PROP'=>"clientHeight",'ADD_GROUP'=>true];
							
                $create_addgr = false;
				$del = true;
			foreach ($componentProps[$class] as &$prop){
                    
                if (!isset($prop['TYPE'])) continue;
                if (!isset(self::$types[$prop['TYPE']])) continue;
					$prop['TYPE'] = strtolower($prop['TYPE']);
					$type	= self::$types[$prop['TYPE']];
					$edt	= $type::type;
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
						{
							$del = false;
							$edt = $gr->add(new $edt, $prop['CAPTION']);
						} else $edt = $gr2->add(new $edt, $prop['CAPTION']);
					} else {
						$del = false;
						$edt = $gr->add(new $edt, $prop['CAPTION']);
					}
					$type::OnCreate( $edt, $class, $prop );
					if( defined("$type::caption") )
					{
						$edt->value = "(" . t($type::caption) . ")";
					}
					$this->params[$class][] = $edt->self;
					$this->elements[$edt->self] =& $prop;
					if(trim($prop['PROP'])=="")
					{
						$edt->showHint = false;
						continue;
					}
					if(isset($prop['REAL_PROP']))
						$edt->hint = $prop['CAPTION']._BR_."[->{$prop['REAL_PROP']}]";
					else
						$edt->hint = $prop['CAPTION']._BR_."[->{$prop['PROP']}]";
					$edt->showHint = true;
            }
            if( $del )
			 {	$gr->free(); }
				
			c("fmMain->editorPopup")->AutoPopup = true;
			$panel->EndUpdate();
			lockWindowUpdate(0);
		}
	}
    public static function AddType($typenames, $class)
	{
		if( is_array($typenames) )
			foreach($typenames as $type)
				Self::$types[$type] = $class;
		else 
			Self::$types[$typenames] = $class;
	}
    public function generateClass($class, $back = false)
	{
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
    
    static function fixSplitterMoved($self)
	{
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