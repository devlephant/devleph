<?
/*--pseudocode--*
interface IEditor
{
	const Type = "TNxButtonItem";
	public static function OnCreate(TNxPropertyItem $Item, $class);
	public static function Update(TNxButtonItem $Item, TComponent $Object, $prop);
}
*/
class myProperties
{   
    public $panels; // панель свойств компонентов...
    
    public $params;
    public $panel;
    
    public $selObj;
    
    public $last_class;
	public static $types;
	
    static function updateProps()
	{
        $GLOBALS['myProperties']->_setProps(true);
    }
    function _setProps($update = false){
        
        global $_c, $toSetProp, $fmEdit;
        $toSetProp = true;
        if( !is_object($this->selObj) )
			$this->selObj = $fmEdit;
		if( is_array($this->params[$this->selObj->className]) )
			foreach ($this->params[$this->selObj->className] as $self=>$param)
			{
				if (!isset($param['TYPE'])) continue;
				if(isset(self::$types[$param['TYPE']))
				{
					$type = self::$types[$param['TYPE'];
					$type::Update(_c($self),$this->selObj,is_array($param['PROP']) ? $param['PROP'][0] : $param['PROP']);
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
			
            if ($class!=='TForm'){
                $componentProps[$class] =
                array_merge([['CAPTION'=>t('Name'),'TYPE'=>'Name','PROP'=>'name','ADD_GROUP'=>true]],
                            (array)$componentProps[$class]);
                $componentProps[$class] = array_values($componentProps[$class]);
            }
            
            if (is_array($componentProps[$class]))
			{
                    
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
					$type::OnCreate( $edt, isset($prop['CLASS'])?$prop['CLASS']:false, $prop );
					$this->params[$class][$edt->self] =& $prop;
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