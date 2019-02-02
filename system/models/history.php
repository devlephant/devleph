<?


class myHistory {
    
    
    static function add($objects, $prop){
        
        if (!count($objects)) return;
        
        global $HISTORY_ARRAY, $_FORMS, $formSelected, $__toRedo, $__toUndo;
        
        if ($__toRedo){
            unset($HISTORY_ARRAY[$_FORMS[$formSelected]]);
            $HISTORY_ARRAY[$_FORMS[$formSelected]] = array();
            $GLOBALS['historyIndex'] = 0;
            $__toRedo = false;
            $__toUndo = false;
        }
        
        $arr = array();
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
        $GLOBALS['historyIndex']++;
    }
    
    static function addXY($objects){
        
        self::add($objects, array('x','y'));
    }
    
    static function addWH($objects){
        
        self::add($objects, array('w','h','x','y'));
    }
    
    static function open($arr){
        
        /*if ( c('fmMain->tmpEdit')->visible )
            c('fmMain->tmpEdit')->setFocus();*/
        
        foreach ((array)$arr as $el){
            
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
    
    
    static function dir(){
        
        $dir = replaceSl( win_tempdir() . '\\DS\\History\\' . md5($projectFile) . '\\' );
        return $dir;
    }
    
    static function init(){
        
        global $projectFile;
        
        $GLOBALS['HISTORY_ARRAY'] = array();
            
        myVars::set(0, 'historyIndex');
    }
    
    static function load($index){
        
        global $HISTORY_ARRAY,  $_FORMS, $formSelected;
      
        self::open($HISTORY_ARRAY[$_FORMS[$formSelected]][$index]);
    }
    
    static function go(){
        
        return false;
        global $historyIndex;
        self::save($historyIndex);
        $historyIndex++;
    }
    
    static function undo(){
        global $_sc;
        $index = myVars::get('historyIndex');
        if ($index == 0) return false;
        
        myVars::set(true,'__toRedo');
        self::load($index-1);
		$_sc->update();
        myVars::set($index-1, 'historyIndex');
    }
    
    static function redo(){
        global $_sc;
        global $HISTORY_ARRAY,  $_FORMS, $formSelected;
        
        $index = myVars::get('historyIndex');
        if ($index == count($HISTORY_ARRAY[$_FORMS[$formSelected]]) - 1) return false;
        
        myVars::set(true,'__toRedo');
        self::load($index+1);
		$_sc->update();
        myVars::set($index+1, 'historyIndex');
    }
}

myHistory::init();