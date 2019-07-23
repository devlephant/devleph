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
                    $value[] = $el->$x;
            } else
                $value = $el->$prop;
            
            $arr[] = array ('name'=>$el->name,
                            'self'=>$el->self,
                            'prop'=>$prop,
                            'value'=>$value);
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
    
    static function open($arr)
	{        
        foreach ((array)$arr as $el)
		{    
            $obj  = _c($el['self']);
            $prop = $el['prop'];
            
            if (is_array($prop)){
                foreach ($prop as $i=>$x){
                    $obj->$x = $el['value'][$i];
                }
            } else
                $obj->$prop = $el['value'];
        }
        
        global $myProperties;
        $myProperties->setProps();
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