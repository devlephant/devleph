<?
class myHistory {
	static function add($objects, $prop)
	{
        
        if (!count($objects)) return;
        
        global $HISTORY_ARRAY, $_FORMS, $formSelected, $__isUndo;
		if( $__isUndo )
		{
			$HISTORY_ARRAY[$_FORMS[$formSelected]] = array_slice($HISTORY_ARRAY[$_FORMS[$formSelected]], 0, $GLOBALS['historyIndex']);
			$__isUndo = false;
		}
        $arr = [];
        foreach ($objects as $el){
            
            $el = toObject($el);
            
            
            if (is_array($prop)){
                foreach ($prop as $x)
                    $value[] = self::getProp($el, $x);
            } else
                $value = self::getProp($el, $prop);
            
            $arr[] = array ('name'=>$el->name,
                            'self'=>$el->self,
                            'prop'=>$prop,
                            'value'=>$value);
            unset($value);
            
        }
        
        $HISTORY_ARRAY[$_FORMS[$formSelected]][] = $arr;
        ++$GLOBALS['historyIndex'];
    }
    
	static function addArr($objects, $prop, $vals)
	{
        
        if (!count($objects)) return;
        
        global $HISTORY_ARRAY, $_FORMS, $formSelected, $__isUndo;
		if( $__isUndo )
		{
			$HISTORY_ARRAY[$_FORMS[$formSelected]] = array_slice($HISTORY_ARRAY[$_FORMS[$formSelected]], 0, $GLOBALS['historyIndex']);
			$__isUndo = false;
		}
        $arr = [];
        foreach ($objects as $link=>$el){
            
            $el = toObject($el);
            
            $arr[] = array ('name'=>$el->name,
                            'self'=>$el->self,
                            'prop'=>$prop,
                            'value'=>$vals[$link]);
            unset($value);
            
        }
        
        $HISTORY_ARRAY[$_FORMS[$formSelected]][] = $arr;
        ++$GLOBALS['historyIndex'];
    }
	
    static function addXY($objects)
	{
        self::add($objects, ['x','y']);
    }
    
    static function addWH($objects)
	{
        self::add($objects, ['w','h','x','y']);
    }
    static function setProp($o, $prop, $val)
	{
		global $myProperties, $_sc, $_FORMS, $projectFile, $myProject, $formSelected, $fmEdit;
		$o = _c(myDesign::noVisAlias($o->self));
		
		if($o instanceof TForm)
		{
			$prop = strtolower($prop);
			if($prop=="name")
			{
				if (preg_match('/^([a-z]{1})([a-z0-9\_]+)$/i',$val)){
				foreach ($_FORMS as $el){
					if (strtolower($el)==strtolower($val)){
						return;
					}
				}
				$name = $GLOBALS['_FORMS'][$GLOBALS['formSelected']];
				$dfm_file = dirname($projectFile) .'/'. $name . '.dfm';
				$dfm_file2= dirname($projectFile) .'/'. $val . '.dfm';
				if (file_exists($dfm_file2))
					unlink($dfm_file2);
				
				rename($dfm_file, $dfm_file2);
				
				myDesign::groupChangeFormName($name, $value);
				myDesign::eventChangeFormName($name, $value);
				
					$k = array_search($name, $_FORMS);
					$_FORMS[$k] = $val;
					$id = c('fmMain->tabForms')->tabIndex;
					c('fmMain->tabForms')->tabs->setLine($k,$val.'.dfm');
					c('fmMain->tabForms')->tabIndex = $id;
					$myProject->formsInfo[$val] = $myProject->formsInfo[$name];
					unset($myProject->formsInfo[$name]);
					
					treeBwr_add();
				}
			}elseif( in_array($prop, ['cursor','x','y','autoscroll','alphablend','alphablendvalue','screensnap','snapbuffer','transparentcolor','transparentcolorvalue','doublebuffered']) )
			{
				$myProject->formsInfo[$_FORMS[$formSelected]][$prop] = $val;
			}
		} else {
			if ($prop=="name")
			{
				myDesign::changeName($o, $val);
			}
			else 	
			{
				$o->$prop = $val;
			}
		}
	}
	static function getProp($o, $prop)
	{
		global $fmEdit;
		$o = _c(myDesign::noVisAlias($o->self));
		$p = $o->$prop;
		if($o instanceof TForm && !is_object($o->$prop))
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
		if( $o->name!=="" && !gui_is($o->self, 'TControl') )
		{
			$prop =	strtolower($prop);
			$arr = ["x","y","w","h","left","top","width","height"];
			if(in_array($prop,$arr))
			{
				$pos = array_search($prop,$arr);
				$p = $GLOBALS['myProject']->formsInfo[$GLOBALS['_FORMS'][$GLOBALS['formSelected']]]["_v"][$o->name][ ($pos%2==0?1:0) ];
				if($pos%3==0||$pos%4==0)
					$p = 24;
			}
		}
		return $p;
	}
    static function open($arr)
	{
		if(!is_array($arr)) return;
        foreach ($arr as $el)
		{    
            $obj  = _c($el['self']);
            $prop = $el['prop'];
            
            if (is_array($prop)){
                foreach ($prop as $i=>$x){
                    self::SetProp($obj, $x, $el['value'][$i]);
                }
            } else
                self::SetProp($obj, $prop, $el['value']);
        }
        
        myProperties::updateProps();
    }
    
    static function init()
	{    
        global $projectFile;   
        $GLOBALS['HISTORY_ARRAY'] = [];
        myVars::set(0, 'historyIndex');
    }
    
    static function load($index)
	{    
        global $HISTORY_ARRAY,  $_FORMS, $formSelected;
        self::open($HISTORY_ARRAY[$_FORMS[$formSelected]][$index]);
    }
    
    static function go()
	{    
		return false;
    }
	
    static function undo(){
        global $_sc, $__isUndo;
        $index = myVars::get('historyIndex');
        if ($index == 0) return false;
        $__isUndo = true;
        self::load($index-1);
		$_sc->update();
        myVars::set($index-1, 'historyIndex');
    }
    
    static function redo(){
        global $_sc, $HISTORY_ARRAY,  $_FORMS, $formSelected;
        
        $index = myVars::get('historyIndex');
        if ($index == count($HISTORY_ARRAY[$_FORMS[$formSelected]]) - 1) return false;
        
        self::load($index+1);
		$_sc->update();
        myVars::set($index+1, 'historyIndex');
    }
}

myHistory::init();