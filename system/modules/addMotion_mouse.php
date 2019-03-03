<?php
class AddMotion_mouse {
    static function MouseDown($self, $button, $shift, $x, $y) {	$GLOBALS["motion_mouse"] = array($x, $y);	}
    static function MouseUp($self, $button, $shift, $x, $y){ $GLOBALS['motion_mouse'] = false;	}
    static function MouseMove($self, $shift, $x, $y, $obj2) {
        if($GLOBALS['motion_mouse']) {
            if($obj2 <> 0)
             $self = $obj2;
            control_x($self, control_x($self, null) - ($GLOBALS['motion_mouse'][0] - $x));
            control_y($self, control_y($self, null) - ($GLOBALS['motion_mouse'][1] - $y));
        }
    }

    private static function DefaultObjEvent($self, $NameEvent) {
        $Event = event_get($self, $NameEvent);
        if(!empty($Event)) {
            event_set($self, $NameEvent,  null);
            event_set($self, $NameEvent,  $Event);
        }
    }
    
    public static function Add($Obj, $obj2 = null) {
        $Obj = ___c($Obj);
        event_add($Obj, 'onMouseDown', 'AddMotion_mouse::MouseDown');
        event_add($Obj, 'onMouseUp', 'AddMotion_mouse::MouseUp');
        event_add($Obj, 'onMouseMove', 'AddMotion_mouse::MouseMove');
        event_args($Obj, 'onMouseMove', array(___c($obj2)));
    }
    
    public static function Clear($Obj) {
        $Obj = ___c($Obj);
        self::DefaultObjEvent($Obj, 'onMouseDown');
        self::DefaultObjEvent($Obj, 'onMouseUp');
        self::DefaultObjEvent($Obj, 'onMouseMove');
    }
}  
?>