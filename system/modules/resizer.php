<?
// Resizer by kurandx
class resize{ 
    static $objects = []; 
    static $speed = 15; 
    static function resize_object($obj, $params=false) 
    {
		if(!$params) $params = [];
		$pars = array('x', 'y', 'w', 'h', 'func', 'speed', 'time');
		$s = 7;
		for($i=0;$i<$s;++$i)
		{
			if(!isset($params[$pars[$i]])) $params[$pars[$i]] = false;
		}
		if($params['time']!==false) $params['time'] += microtime(1);
		$sides = array($params['x'], $params['y'], $params['w'], $params['h']);
        resize::$objects[$obj->self] = array($sides, $params['func'], $params['speed'], $params['time']); 
    } 
    static function set_speed($i)
    { 
        resize::$speed = $i; 
    } 
    static function get_speed() 
    { 
        return resize::$speed; 
    } 
    static function tick() 
    { 
        $objs = &resize::$objects; 
        $size = count($objs); 
        if($size>0)
        { 
			$m = microtime(1);
            foreach($objs as $self=>$data) 
            { 
                list($sides, $func, $speed, $time) = $data; 
				$sname = array('Left', 'Top', 'Width', 'Height');

				$s = 4;
				if( $time !== false )if( $time > $m ) continue;
				
				for($i=0;$i<$s;++$i)
				{
					$sidetmp[$i] = gui_propGet($self, $sname[$i]);
					$remp[$i] = resize::eval_formule($sidetmp[$i], $sides[$i], $speed);
				}
                
                if($remp[0]===false && $remp[1]===false && $remp[2]===false && $remp[3]===false) 
                { 
                    unset($objs[$self]);
					for($i=0;$i<$s;++$i)
					{
						if($sides[$i]!==false) gui_propSet($self, $sides[$i], $sides[$i]);
					}
                    if($func!==false && is_callable($func) ) $func($self); 
                } 
                else 
                {
					for($i=0;$i<$s;++$i)
					{
						if($remp[$i]!==false) gui_propSet($self,$sname[$i],$sidetmp[$i]+$remp[$i]);
					}
                } 
            } 
        } 
    }
	static function syncfunc()
	{
	
	}
    private static function eval_formule($x, $y, $speed=false) 
    { 
        if($x===false || $y===false) return false; 
        if($speed===false) $speed = resize::$speed; 
        $remp = ($y-$x)/100*resize::$speed; 
        if($remp==0) return false; 
        return $remp>0?ceil($remp):floor($remp); 
    } 
} 
if( !$GLOBALS['APP_DESIGN_MODE'] )
{
	setTimer(5, 'resize::tick();'); 
}
?>