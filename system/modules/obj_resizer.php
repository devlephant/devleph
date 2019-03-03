<?php
    # АВТОР: НЯШИК
    # VER : 0.2
    # Profile: http://community.develstudio.ru/member.php/6675-%D0%9D%D1%8F%D1%88%D0%B8%D0%BA
    # Site :  http://community.develstudio.ru/showthread.php/13619-TResize-%D0%9F%D0%BB%D0%B0%D0%B2%D0%BD%D0%BE%D0%B5-%D0%B8%D0%B7%D0%BC%D0%B5%D0%BD%D0%B5%D0%BD%D0%B8%D0%B5-%D1%80%D0%B0%D0%B7%D0%BC%D0%B5%D1%80%D0%BE%D0%B2-%D0%B8-%D0%BF%D0%BE%D0%B7%D0%B8%D1%86%D0%B8%D0%B8-%D0%BA%D0%BE%D0%BC%D0%BF%D0%BE%D0%BD%D0%B5%D0%BD%D1%82%D0%BE%D0%B2?p=123971#post123971
    

    class TResize {
        private static $TimerTick = array();
        public static $CallBackInSitu = null;

        public static function SetInSitu($CallBack) {
            if($CallBack === null or $CallBack == '') {
                self::$CallBackInSitu = null;
            } elseif(is_callable($CallBack, true)) {
                self::$CallBackInSitu = $CallBack;
            }
        }
        
        public static function UnSetBase($obj) {
            if(array_key_exists($name = is_object($obj) ? $obj->name : $obj, self::$TimerTick)) {
                gui_destroy(self::$TimerTick[$name][1]);
                unset(self::$TimerTick[$name]);
            }
        }
        
        public static function Start($obj, $v = array(), $speed  = 15) {
            if($obj = array_key_exists($name = is_object($obj) ? $obj->name : $obj, self::$TimerTick)
                ? self::$TimerTick[$name][0] 
                : (is_object($obj)
                    ? (self::$TimerTick[$name][0] = $obj->self)
                    : (is_string($obj)
                        ? (self::$TimerTick[$name][0] = findComponent($obj)->self)
                        : (is_numeric($obj)
                            ? (self::$TimerTick[$name][0] = $obj)
                            : false)))) {
                $t = &self::$TimerTick[$name];

                if(!$t[3]) {
                    if(!array_key_exists(1, (array)$t)) {
                        $t[1] = gui_create('TTimer', null);
                        
                        $rw = $rh = $ry = $rx = false;
                        event_set($t[1], 'onTimer', function($self) use (&$t, $obj, &$speed, &$rw, &$rh, &$ry, &$rx) {
                            foreach($t[2] as $i => $prop) {
                                if(!(${'r' . $i} = ($t[2][$i] == $p0 = call_user_func_array('control_' . $i, array($obj, null)))))
                                    call_user_func_array('control_' . $i, array($obj, $p0 + (($r = ($prop - $p0) / 100 * $speed) > 0 ? ceil($r) : floor($r))));
                            }
                            
                            if($rw and $rh and $ry and $rx) {
                                gui_propSet($t[1], 'interval', 0);
                                gui_propSet($t[1], 'enable', false);
                                $t[3] = false;
                            
                                if($t[4] !== null) {
                                    call_user_func_array($t[4], array($obj));
                                } elseif(TResize::$CallBackInSitu !== null) {
                                    call_user_func_array(TResize::$CallBackInSitu, array($obj));
                                }
                            }
                        });
                    }
                    
                    $t[2] = array('x' => control_x($obj, null), 'y' => control_y($obj, null), 'h' => control_h($obj, null), 'w' => control_w($obj, null));
                    $t[3] = true;
                    $t[4] = null;
                    foreach($v as $i => $v)
                        if(($i = strtolower(trim($i))) == 'x' or $i == 'y' or $i == 'h' or $i == 'w')
                            $t[2][$i] = $v;
                        elseif($i == 'f' and is_callable($v, true))
                            $t[4] = $v;
                        elseif($i == 's')
                            $speed = $v;

                    gui_propSet($t[1], 'interval', 1);
                    gui_propSet($t[1], 'enable', true);
                }
            }
            return false;
        }
    }
?>