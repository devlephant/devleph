<?
// Resizer by kurandx
class resize{ 
    static $objects = []; 
	static $obj_tmp = [];
    static $speed	= 15; 
	static function resize_object($obj, $params = false)
	{
		if(!is_array($params))
		{
			trigger_error(t("\"%s\" class error", __CLASS__) . ":" . t("cannot create sizing model without correct parameters!"));
			return false;
		}
		$pars = ['x', 'y', 'w', 'h', 'func', 'speed', 'time'];
		for($i=0;$i<7;++$i)
		{
			if(!isset($params[$pars[$i]])) $params[$pars[$i]] = false;
		}
		if($params['time']!==false) $params['time'] += microtime(1);
		return self::Perform($obj, $params['func'], $params['speed'], $params['time'], 
		['x', $params['x']], ['y', $params['y']], ['w', $params['w']], ['h', $params['h']]);
	}
    static function Perform($obj, $func=false, $speed=false, $time=false, ...$Props) 
    {
		if( empty($Props) )
		{
			trigger_error(t("\"%s\" class error", __CLASS__) . ":" . t("cannot create sizing model without correct parameters!"));
			return false;
		}
		for($i=0;$i<count($Props);$i++)
		{
			if( count($Props[$i]) == 1 && is_array($Props[$i]) )
				$Props[$i] = [array_keys($Props)[0], $Props[0]];
			if( !is_string( $Props[$i][0] ) ) unset($Props[$i]);
			if( !isset( $Props[$i][1]) ) unset($Props[$i]);	
		}
		
		if($time!==false) $time += microtime(1);
        self::$objects[$obj->self] = [$Props, $func, $speed, $time];
		return true;
    }
	
    static function set_speed($i)
    { 
        self::$speed = $i; 
    } 
    static function get_speed() 
    { 
        return self::$speed; 
    } 
    static function tick() 
    { 
        $objs = &self::$objects; 
        if(!empty($objs))
        { 
			$m = microtime(1);
            foreach($objs as $self=>$data) 
            { 
				/*
				const p_name = 0;
				const p_values = 1; //values count
				*/
				list($Props, $func, $speed, $time) = $data;
				/*	props =
					[ [ name, [...values] ], ,,,[] ]
				*/
				$s = count($Props);
				if( $time !== false )if( $time > $m ) continue;
				$OBJECT = _c($self);
				for($i=0;$i<$s;++$i)
				{
					$cnt = Count($Props[$i][1]);
					if($cnt>1)
					{
						if( !isSet(self::$obj_tmp[$self][$i]) )
						{
							self::$obj_tmp[$self][$i] = 0;
						}
						$sidetmp[$i] = self::$obj_tmp[$self][$i];
						$remp[$i] = self::eval_formule($sidetmp[$i], $cnt, $speed);
					}
					else
					{
						$sidetmp[$i] = $OBJECT->{$Props[$i][0]};
						$remp[$i] = self::eval_formule($sidetmp[$i], $Props[$i][1], $speed);
					}
				}
                $check = array_unique($remp);
                if(count($check)==1&&$check[0]===false) 
                { 
                    unset($objs[$self]);
					unset(self::$obj_tmp[$self]);
					for($i=0;$i<$s;++$i)
					{
						$cnt = Count($Props[$i][1]);
						if($cnt > 1)
						{
							$v = $Props[$i][1][ $cnt - 1];
							if($v!==false)$OBJECT->{$Props[$i][0]} = $v;
						} else {
							if($Props[$i][1]!==false)$OBJECT->{$Props[$i][0]} = $Props[$i][1];
						}
					}
                    if(is_callable($func)) call_user_func($func, $self); 
                } 
                else
                {
					for($i=0;$i<$s;++$i)
					{
						if($remp[$i]==false) continue;
						$cnt = Count($Props[$i][1]);
						if( $cnt > 1 )
						{
							self::$obj_tmp[$self][$i] = $sidetmp[$i] + $remp[$i];
							$OBJECT->{$Props[$i][0]} = $Props[$i][1][ self::$obj_tmp[$self][$i] ];
						} else {
							$OBJECT->{$Props[$i][0]} = $sidetmp[$i] + $remp[$i];
						}
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
        if($speed===false) $speed = self::$speed; 
        $remp = ($y-$x)/100*self::$speed; 
        if($remp==0) return false; 
        return $remp>0?ceil($remp):floor($remp); 
    } 
}
	setTimer(5, 'resize::tick();');
?>