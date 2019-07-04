<?


class animate {
    
    static function toSpeed(){
        
        $vspeed =& $GLOBALS['__VSPEED'];
        if (count($vspeed))
        foreach ($vspeed as $self=>$speed){
            if (link_null($self)){
                unset($vspeed[$self]);
                continue;
            }
            control_y($self, control_y($self, null) + $speed);
        }
        
        $hspeed =& $GLOBALS['__HSPEED'];
        if (count($hspeed))
        foreach ($hspeed as $self=>$speed){
            if (link_null($self)){
                unset($hspeed[$self]);
                continue;
            }
            control_x($self, control_x($self, null) + $speed);
        }
        
        // collisions
        $coll =& $GLOBALS['__COLLISION'];
        if ($coll)
        foreach ($coll as $self=>$arr){
            
            if (link_null($self)){
                unset($coll[$self]);
                continue;
            }
            
            $arr1['x'] = control_x($self, null);
            $arr1['y'] = control_y($self, null);
            $arr1['w'] = control_w($self, null);
            $arr1['h'] = control_h($self, null);
            foreach ($arr as $toobj=>$event){
                
                if (link_null($toobj)){
                    unset($coll[$self][$toobj]);
                    continue;
                }
                
                $arr2['x'] = control_x($toobj, null);
                $arr2['y'] = control_y($toobj, null);
                $arr2['w'] = control_w($toobj, null);
                $arr2['h'] = control_h($toobj, null);
                
                if (Geometry::collision2D($arr1, $arr2)){
                    
                    //
                    if (is_object($event)){
                        f($event, $self, $toobj);
                    } elseif ($event[0]=='%'){
                        $event[0] = ' '; $event = ltrim($event);
                        f($event, $self, $toobj);
                    } else {
                        $event($self, $toobj);
                    }
                }
            }
        }
    }
    
    static function toView(){
        
        if (!isset($GLOBALS['__VIEW'])) return;
        
        $f   = $GLOBALS['__VIEW']['OWNER'];
        $f_w = control_w($f, null);
        $f_h = control_h($f, null);
        $f_x = control_x($f, null);
        $f_y = control_y($f, null);
        
        $o   = $GLOBALS['__VIEW']['OBJECT'];
        $w   = control_w($o, null);
        $h   = control_h($o, null);
        $x   = control_x($o, null);
        $y   = control_y($o, null);
        
        $view_x = 0;
        $view_y = 0;
        
        if (!isset($GLOBALS['__VIEW']['OFFSET_X'])){
            
            $offset_x = $x;
            $offset_y = $y;
            $GLOBALS['__VIEW']['OFFSET_X'] = $x;
            $GLOBALS['__VIEW']['OFFSET_Y'] = $y;
        } else {
            
            $offset_x = $GLOBALS['__VIEW']['OFFSET_X'];
            $offset_y = $GLOBALS['__VIEW']['OFFSET_Y'];
        }
        
        // определим центр окна...
        $move_x = intval($f_w / 2) - $x - intval($w/2);
        $move_y = intval($f_h / 2) - $y - intval($h/2);
         
        
        form_scrollby($f, $move_x, $move_y);
    }
    
    static function hspeed($obj, $value = null){
        
        if ($obj instanceof group){
            
            foreach ($obj->objects as $self){
                self::hspeed($self, $value);
            }
        }
        
        if (!is_object($obj))
            $obj = toObject($obj);
            
        if ($value === null)
            return (int)$GLOBALS['__HSPEED'][$obj->self];
        else {
            if ($value == 0)
                unset($GLOBALS['__HSPEED'][$obj->self]);
            else
                $GLOBALS['__HSPEED'][$obj->self] = (int)$value;
        }
    }
    
    static function vspeed($obj, $value = null){
        
        if ($obj instanceof group){
            foreach ($obj->objects as $self)
                self::vspeed($self, $value);
        }
        
        if (!is_object($obj))
            $obj = toObject($obj);
            
        if ($value === null)
            return (int)$GLOBALS['__VSPEED'][$obj->self];
        else {
            if ($value == 0){
                
                unset($GLOBALS['__VSPEED'][$obj->self]);
            }
            else
                $GLOBALS['__VSPEED'][$obj->self] = (int)$value;
        }
    }
    
    static function collision($obj, $toobj, $event){
        
        if ($obj instanceof group){
            foreach ($obj->objects as $self)
                self::collision($self, $toobj, $event);
        }
        
        if (!is_object($obj))
            $obj = toObject($obj);
        
        if (!is_object($toobj))
            $obj = toObject($toobj);
        
        $GLOBALS['__COLLISION'][$obj->self][$toobj->self] = $event;
    }
    
    static function delCollision($obj, $toobj = false){
        
        $obj = toObject($obj);
        if ($toobj){
            $toobj = toObject($toobj);
            unset($GLOBALS['__COLLISION'][$obj->self][$toobj->self]);
        } else {
            unset($GLOBALS['__COLLISION'][$obj->self]);
        }
    }
    
    static function setView($obj, $offsetX = 0, $offsetY = 0){
        
        
        if (!is_object($obj))
            $obj = toObject($obj);
        
        if (!isset($GLOBALS['__VIEW']))
            setTimer(10, 'animate::toView()');
        
        if (!$obj){
            unset($GLOBALS['__VIEW']);
        } else {
            $GLOBALS['__VIEW']['OBJECT'] = $obj->self;
            $GLOBALS['__VIEW']['OWNER']  = $obj->owner;
        }
    }
    
    static function objectFree($self){
        
        if ($GLOBALS['__VIEW']['OBJECT'] == $self)
            unset($GLOBALS['__VIEW']);
        
        unset($GLOBALS['__VSPEED'][$self]);
        unset($GLOBALS['__HSPEED'][$self]);
        
        unset($GLOBALS['__COLLISION'][$self]);
        
        if ($GLOBALS['__COLLISION'])
        foreach ($GLOBALS['__COLLISION'] as $s=>$arr){
            foreach ($arr as $toobj=>$event)
                if ($toobj == $self)
                    unset($GLOBALS['__COLLISION'][$s][$toobj]);
        }
    }
}

?>