<?
class myVars {
    
    static function set($var, $name){
        
        $GLOBALS[$name] = $var;
    }
    
    static function set2(&$var, $name){
        $GLOBALS[$name] =& $var;
    }
    
    static function get($name){
        
        if (isset($GLOBALS[$name]))
            return $GLOBALS[$name];
        else
            return false;
    }
}

class TConstantList{
	
	public $defines;
	public $defs;
	function __set($nm,$val){
		$this->defines[$nm] = $val;
		if (!defined($nm))
			define($nm,$val, false);
	}
	
	function __get($nm){
		if( isset($this->defines[$nm]) )
			return $this->defines[$nm];
		if( defined($nm) )
		{
			$this->defines[$nm] = constant($nm);
			return constant($nm);
		}
	}
	
	function setConstList($names,$setName=false,$beg = 0){
		for($i=0;$i<count($names);$i++){
		    if (! defined($names[$i]) ){
			define($names[$i],$i+$beg, false);
			$this->defines[$names[$i]] = $i+$beg;
		    }
		}
		if( $setName )
			$this->defs[$setName] = $names;
	}
	function s($name)
	{
		if(isset($this->defs[$name]))
			return $this->defs[$name];
		return [];
	}
	function delete($nm){
		if( defined($nm) ){
			if( isset($this->defines[$nm]) )
				unset($this->defines[$nm]);
		}
	}
	
	function redefine($nm, $val){
		if( defined($nm) ){
			if( isset($this->defines[$nm]) )
				unset($this->defines[$nm]);
			
			$this->defines[$nm] = $val;
			define($nm,$val, false);
		}
	}
}


$GLOBALS['_c'] = new TConstantList;

// Delphi: System.UITYPES.TColor
Class TColor implements Iterator, ArrayAccess {
//Allowed values
const min = -2147483648;
const max = 2147483647;

//Constants
const TYPE = 'Integer';

//Variables
protected static $TYPES = ['bgr', 'rgb', 'hsv', 'hsl', 'cmyk', 'hex'];
protected static $classname = __CLASS__;
static $def = 'bgr';
protected static $list;
protected $isstatic;
protected $rgb;
protected $name;

	// Properties: Contrast, Hue, Lightness, Darkness, Saturation 																						   
	// Formats: RGB, BGR, HSV, HSL, CMYK, DHEX, HEX, COLOR 																							  	 
	// Functions: compare_contrast( $c [TColor/Hex/RGB], [...] ) - returns most cotrast color, MakeStatic() - makes instance of TColor static for ever! 
	// Methods: compare_contrast($hexStr1, $hexStr2) - returns most cotrast color, BGR, HSV, HSL, CMYK, HEX, DHEX, COLOR <=> RGB - return rgb or instant
	
	//возвращает массив поддерживаемых форматов
	public function formats()
	{
		return self::$TYPES;
	}
	
	//ищет цвет TColor по имени константы
	public static function search( $name )
	{
			if( isset( $GLOBALS['_c'] ) ) {
				if( isset($this->defines[$name]) )
					if( $this->defines[$name] instanceof self::$classname )
							return $this->defines[$name];
			} else {
					if( constant($name) instanceof self::$classname )
							return constant($name);
			}
		
		return False;
	}
	
	//проверка типа входящих данных, корректировка вида записи цвета
	public static function check_color(&$cl, $return = false)
	{
		if( is_bool($cl) ) {
					$cl = ($cl)? clWhite: clBlack;
		} elseif( is_numeric($cl) || is_scalar($cl) || is_double($cl)  ) {
			
			if( $cl == 1 ) {
					$cl	= clWHite;
					
			} elseif( $cl == 0 ) {
					$cl	= clBlack;
					
			}
			
		} elseif( is_string($cl) ) {
				if(	substr($cl, 0, 1) == '$' )						{
					$cl	= hexdec('0x'.substr($cl, 1, strlen($cl)-1));
					
				} elseif( substr($cl, 0, 1) == '#' ) 				{
					$cl	= hexdec($cl);
					
				} elseif( strtolower(substr($cl, 0, 2)) == 'ox' )	{
					$cl	= hexdec('0x'.substr($cl, 2, strlen($cl)-2));
					
				} elseif (	@trim(trim($cl), '0..9A..Fa..f') == '' ){
					$cl	= hexdec($cl);
					
				} else {
					$cl	= clBlack;
				}
		}

		if( $return ) 
			return $cl;
	}
	
	//преобразование входящих данных в RGB-массив
	private function switchdef($cls, $tp=-1)
	{
		if( $tp == -1 ) {
			$type = strtolower(self::$def);
			
		}elseif( is_numeric($tp) && $tp <= 5 ) {
			$type = self::$TYPES[$tp];
			
		} else {
			$type = strtolower($type);
			
		}
		
		if( is_array($cls) )
		{
			if( count($cls) > 3 )	{
				if( is_string($cls[3]) && !is_numeric($cls[3]) )
					return $this->switchdef(array_slice($cls, 0, 3), $cls[3]);
				
				if( !$this->check_value($cls, 'CMYK', 4) ) 			return false;
				$this->rgb = self::CMYKtoRGB($cls[0], $cls[1], $cls[2], $cls[3]);
				
			} else {
				switch( $type )	{
				
				case 'bgr': {
					 if( !$this->check_value($cls, 'BGR') ) 		return false;
					$this->rgb	= [$cls[2], $cls[1], $cls[0]];			} break;
					
				case 'rgb': {
					 if( !$this->check_value($cls, 'RGB') ) 		return false;
					$this->rgb	= $cls;										} break;
					
				case 'hsv': {
					 if( !$this->check_value($cls, 'HSV', 3, 1) ) return false;
					$this->rgb	= self::HSVtoRGB($cls[0], $cls[1], $cls[2]);} break;
					
				case 'hsl': {
					 if( !$this->check_value($cls, 'HSL', 3) ) 	return false;
					$this->rgb	= self::HSLtoRGB($cls[0], $cls[1], $cls[2]);} break;
					
				default:  {
					 if( !$this->check_value($cls, 'RGB') ) 		return false;
					$this->rgb	= $cls;										} break;
					
				}
			}
		}	  else	{
			switch( $type )	{
				
				case 'bgr':  {
					 if( hexdec($cls) < self::min or hexdec($cls) > self::max ) {
						trigger_error("Integer overflow, YOU cannot create the dhex color with value of {$cls}",	E_USER_ERROR);
						return false;
					}
					$this->rgb = self::DHEXtoRGB($cls);} break;
					
				default: {
					if( hexdec($cls) < self::min or hexdec($cls) > self::max ) {
						trigger_error("Integer overflow, YOU cannot create the hex color with value of {$cls}",		E_USER_ERROR);
						return false;
					}	
					$this->rgb 	= self::HEXtoRGB($cls);} break;
					
				}
			}
		return true;
	}
	
	//перегруженный конструктор класса
	public function __construct($color)
	{
		if( func_num_args() < 1 ) {
			$arguments = [clWhite];
			return false;
		}
		//получение аргументов вызова конструктора
		$arguments = func_get_args();
		
		switch( func_num_args() ) //условие на количество аргументов
	  {
		case 0: {
			trigger_error('Not enough parameters passed to ' . __METHOD__, 						E_USER_ERROR);
		} break;
		case 1: {
		if( $arguments[0] instanceof self::$classname ){
			
			$this->rgb = $arguments[0]->rgb;
		}elseif( is_array($arguments[0]) ){
			
			if( !$this->switchdef($arguments[0]) ) 					return false;
		} else {
			self::check_color($arguments[0]); //конвертирует данные
			
			if( $arguments[0] < self::min or $arguments[0] > self::max ) {
				trigger_error("Integer overflow, YOU cannot create color with value of {$arguments[0]}",	E_USER_ERROR);
				return false;
			}
			if( !$this->switchdef($arguments[0]) )					return false;
			
		}
		} break;
		case 2: {
			
		if( $arguments[0] instanceof self::$classname ){
			$this->rgb = $arguments[0]->rgb;
			
		}elseif( is_array($arguments[0]) ){
			if( !$this->switchdef($arguments[0], $argumets[1]) )			return false;
			
		} else {
			self::check_color($arguments[0]); //конвертирует данные
			
			if( $arguments[0] < self::min or $arguments[0] > self::max ) {
				trigger_error("Integer overflow, YOU cannot create color with value of {$arguments[0]}",	E_USER_ERROR);
				return false;
			}
			if( !$this->switchdef($arguments[0], $argumets[1]) )			return false;
			
		}
		} break;
		case 3: {
			if( !$this->switchdef([$arguments[0], $arguments[1], $arguments[2]]) )					return false;
			
		} break;
		case 4: {
			if( is_string($argumets[3]) ) {
				if( !$this->switchdef([$arguments[0], $arguments[1], $arguments[2]], $argumets[3]) )	return false;
				
			} else {
				
				if( !$this->switchdef($arguments) )				return false;
			}
		} break;
	  }
	  $this->isstatic = false; //при успешном завершении операции построения объекта, делаем его не статическим.
	}
	
	//in-class trait
	private function check_value($val, $nm, $c = 3, $mx=255)
	{
			if( !is_array($val) ) {
						trigger_error("YOU can set the {$nm} color value only to another array",					E_USER_ERROR);
						return false;
			 }
			if( count($val) < $c ) {
						trigger_error("{$nm} Color array must contain {$c} dimensions with integer values",			E_USER_ERROR);
						return false;
			}
			foreach( $val as $v ) {
				if( !is_numeric($v) && !is_scalar($v) &&  !is_double($v) ){
						trigger_error("{$nm} Color array dimension must contain only integers",						E_USER_ERROR);
						return false;
					}
					
					if($v > $mx){
						trigger_error("{$nm} Color array dimension must contain integer with max value of {$mx}",	E_USER_ERROR);
						return false;
					}
					
			 }
		
		return true;
	}
	
	public function check_val($val, $name, $type='int', $max=255)
	{
		
		switch( strtolower(trim($type)) )
		{
			case 'int': {
				if( is_integer($val) || is_int($val) ){
					if( $val > $max  && $max <> 0 ) {
						trigger_error("{$name} must contain data with max value of {$max}",		E_USER_ERROR);
						return false;
					}
				} else {
					trigger_error("{$name} must contain integer data type",						E_USER_ERROR);
						return false;
				}
			}	break;
			case 'float': {
				if( is_integer($val) || is_int($val) ){
					if( $val > $max  && $max <> 0 ) {
						trigger_error("{$name} must contain data with max value of {$max}",		E_USER_ERROR);
						return false;
					}
				} else {
					trigger_error("{$name} must contain float data type",						E_USER_ERROR);
						return false;
				}
			}
			case 'num': {
				if( is_numeric($val) ){
					if( $val > $max && $max <> 0 ) {
						trigger_error("{$name} must contain data with max value of {$max}",		E_USER_ERROR);
						return false;
					}
				} else {	
					trigger_error("{$name} must contain numeric data type",						E_USER_ERROR);
						return false;
				}
			}	break;
			case 'str':
			case 'string':
			{
				if( is_string($val) ){
					if( strlen($val) > $max && $max <> 0) {
						trigger_error("{$name} must contain data with max length of {$max}",	E_USER_ERROR);
						return false;
					}
				} else {
					trigger_error("{$name} must contain string data type",						E_USER_ERROR);
						return false;
				}
			}	break;
		}
		return true;
	}
	
	public function __get($name)
	{
		switch( strtolower(trim($name)) )
		{
			 // Formats
			 case 'bgr':	{ return	[ (int)$this->rgb[2], (int)$this->rgb[1],(int) $this->rgb[0] ];							} break;
			 case 'rgb':	{ return	[ (int)$this->rgb[0], (int)$this->rgb[1], (int)$this->rgb[2] ];							} break;
			 case 'hsv':	{ return	self::RGBtoHSV((int)$this->rgb[0], (int)$this->rgb[1], (int)$this->rgb[2]);				} break;
			 case 'hsl':	{ return 	self::RGBtoHSL((int)$this->rgb[0], (int)$this->rgb[1], (int)$this->rgb[2]);				} break;
			 case 'cmyk':	{ return 	self::RGBtoCMYK((int)$this->rgb[0], (int)$this->rgb[1], (int)$this->rgb[2]);			} break;
			 case 'dhex':	{ return	hexdec(self::RGBtoDHEX((int)$this->rgb[0], (int)$this->rgb[1], (int)$this->rgb[2]));	} break;
			 case 'hex':	{ return 	self::RGBtoHEX((int)$this->rgb[0], (int)$this->rgb[1], (int)$this->rgb[2]);				} break;
			 case 'color':	{ return	hexdec(self::RGBtoDHEX((int)$this->rgb[0], (int)$this->rgb[1], (int)$this->rgb[2]));	} break;
			 
			 // Properties
			 case 'contrast':	{ return 0.2126 * pow($this->rgb[0] / 255, 2.2) +
										 0.7152 * pow($this->rgb[1] / 255, 2.2) +
										 0.0722 * pow($this->rgb[2] / 255, 2.2);	} break;
			 case 'hue':		{ return $this->hsv[0];								} break;
			 case 'saturation':	{ return $this->hsv[1];								} break;
			 case 'vibrance':	{ return $this->hsv[2];								} break;
			 case 'lightness':	{ return $this->hsl[2];								} break;
			 case 'darkness':	{ return 255 - ($this->hsl[2]); 					} break;
			 case 'name':		{ return $this->name; 								} break;
		}
	}

	public function __set($name, $value)
	{
		$f = function($int, $pow) {
			$float = floor(pow($int, $pow) * 255);
			
				if( (int)floor($float) > 255 )
					return 255;

					return $float;
		};
		if( $this->isstatic ) {
			trigger_error('This instance of ' . self::$classname . ' cannot be changed');
			return;
		}
		switch( strtolower(trim($name)) )
		{
			 //Formats
			 case 'bgr': { 
			 if( !$this->check_value($value, 'BGR') ) 			return false;
			 $this->rgb   		= [(int)$value[2], (int)$value[1], (int)$value[0]];
			 return true;
			 																										} break;
			 case 'rgb': { 
			 if( !$this->check_value($value, 'RGB') )		 	return false;
			 $this->rgb 		= $value;
			 																										} break;
			 case 'hsv': { 
			  if( !$this->check_value($value, 'HSV', 3, 360) )	return false;
				$this->rgb 		= self::HSVtoRGB((float)$value[0], (float)$value[1], (float)$value[2]);
			 																										} break;
			 case 'hsl': {
			if( !$this->check_value($value, 'HSL', 3, 2) ) 		return false;				 
			 $this->rgb 		= self::HSLtoRGB($value[0], $value[1], $value[2]);
																													} break;
			 case 'cmyk': { 
			 if( !$this->check_value($value, 'CMYK', 4) ) 		return false;
			 $this->rgb			= self::CMYKtoRGB($value[0], $value[1], $value[2], $value[3]);
																													} break;
			 case 'hex': { 
			 if( hexdec($value) < self::min or hexdec($value) > self::max ) {
				trigger_error("Integer overflow, YOU cannot change  the hex color value to {$value}", E_USER_ERROR);
																return false;
			}
			 $this->rgb			= self::HEXtoRGB($value);
																													} break;
			 case 'dhex': { 
			  if( is_string($value) ) $value = hexdec($value);
			 if( $value < self::min or $value > self::max ) {
				trigger_error("Integer overflow, YOU cannot change the dhex color value to {$value}", E_USER_ERROR);
																return false;
			}
			
			 $this->rgb			= self::DHEXtoRGB($value);
																													} break;
			 case 'color': { 
			  if( is_string($value) ) $value = hexdec($value);
			 if( $value < self::min or $value > self::max ) {
				trigger_error("Integer overflow, YOU cannot change the dhex color value to {$value}", E_USER_ERROR);
																return false;
			}
			 $this->rgb			= self::DHEXtoRGB($value);
																													} break;
																													
			 
			 // Properties
			 case 'contrast':	{ 
			 $value = $value/222;
				if( !$this->check_val($value, 'TColor contrast property', 'num', 22.2) )		return false;
									$this->rgb		= [$f(($this->rgb[0] /255) + (0.02126 * ($value)), 1/2.2), 
															$f(($this->rgb[1] /255) + (0.07152 * ($value)), 1/2.2),
															$f(($this->rgb[2] /255) + (0.00722 * ($value)), 1/2.2)];
																																	} break;
			 case 'hue':		{
				  if( !$this->check_val($value, self::$classname . ' hue property', 'num', 360)	)			return false;
									$this->hsv		= [$value, $this->hsv[1], $this->hsv[2]];									} break;
			 case 'saturation':	{
				  if( !$this->check_val($value, self::$classname . ' saturation property', 'num', 100) )	return false;
									$this->hsv		= [$this->hsv[0], $value, $this->hsv[2]];									} break;
			 case 'vibrance':	{
				  if( !$this->check_val($value, self::$classname . ' vibrance property', 'num', 100) )		return false;
									$this->hsv		= [$this->hsv[0], $this->hsv[1], $value];									} break;
			 case 'lightness':	{
				  if( !$this->check_val($value, self::$classname . ' lightness property', 'num', 255) )		return false;
									$this->hsl		= [$this->hsl[0], $this->hsl[1], $value/100];									} break;
			 case 'darkness':	{
				  if( !$this->check_val($value, self::$classname . ' darkness property', 'num', 255) )		return false;
									$this->hsl		= [$this->hsl[0], $this->hsl[1], 255 - ($value)];							} break;
									
			 case 'name': 		{
				  if( !$this->check_val($value, self::$classname . ' name', 'string', 255) )				return false;
				  if( defined($value) ) {
					  trigger_error("Cannot rename " . self::$classname . " instance: constant with name {$value} already exist!", E_USER_ERROR);
																											return false;
				  }
									
					if( defined($this->name) )
						if( isset($GLOBALS['_c']) ) {
							$GLOBALS['_c']->delete($this->name);
						}	
									$this->name		= $value;
						if( isset($GLOBALS['_c']) ) {
							$GLOBALS['_c']->add($value, $this);
						} else {
							define($value, $this, false);
						}				
																							} break;
		}

	}
	
	//In-class trait
	private function __compare($cargs, array $args, &$ret, &$ret2, $func_name)
	{
		if ( $cargs == 1 )																										 {
					$ret2	= ($args[0] instanceof self::$classname)? $args[0]: self::__invoke($args[0]);
				
		} elseif ( $cargs == 2 ) 																								 {
				$ret 	= ($args[0] instanceof self::$classname)? $args[0]: self::__invoke($args[0]);
					$ret2	= ($args[1] instanceof self::$classname)? $args[1]: self::__invoke($args[1]);
				
		} elseif ( $cargs == 3 && is_numeric($args[0]) && is_numeric($args[1]) && is_numeric($args[2]) ) 						 {
					$ret2 	= self::__invoke([$args[0], $args[1], $args[2]], strtolower(self::$def));
				
		} elseif ( $cargs == 4 && is_numeric($args[0]) && is_numeric($args[1]) && is_numeric($args[2]) && is_numeric($args[3]) ) {
					$ret2	= self::__invoke($args, 'cmyk');
				
		} elseif ( $cargs == 4 && is_numeric($args[0]) && is_numeric($args[1]) && is_numeric($args[2]) && is_string($args[3]) && !is_numeric($args[3]))	{
					$ret2	= self::__invoke($args[0], $args[1], $args[2], $args[3]);
				
		} else	{
				if( $args[0] == $this || self::__invoke($args[0]) == $this || empty($args[0]) || trim(strtolower($args[0])) == 'this' || trim(strtolower($args[0])) == 'c' ) 
				{
					$i = 0;
					while( $this->$func_name($args[$i])->rgb == $this->rgb and $i < count($args)-1 ) {
						++$i;
					}
					
					$ret2 = $this->$func_name($args[$i]);
					
				} else {
					$prop = substr($func_name, 'compare_', true);
					if( trim($prop) ) 
					{
						foreach( $args as $k=>$v ) {
							$vc = ($v instanceof self::$classname)? $v: self::__invoke($v);
							$props[ $vc->$prop ] = $vc;
						}
						
						$ret = $props[ max( array_keys($props) ) ];
						
						unset( $props[ max( array_keys($props) ) ] );
						
						$ret2 = $props[ max( array_keys($props) ) ];
					}
				}
		}
	}

	public function compare_lightness($c)
	{
		$ret = $this;
		$ret2 = false;
		$this->__compare(func_num_args(), func_get_args(), $ret, $ret2, __FUNCTION__);
		
			if( $ret->hsl[2] > $ret2->hsl[2] ) 
				return $ret;
			
				return $ret2;
	}
	
	public function compare_darkness($c)
	{
		$ret = $this;
		$ret2 = false;
		$this->__compare(func_num_args(), func_get_args(), $ret, $ret2, __FUNCTION__);
		
			if( $ret->darkness > $ret2->darkness ) 
				return $ret;
			
				return $ret2;
	}
	
	public function compare_vibrance($c)
	{
		$ret = $this;
		$ret2 = false;
		$this->__compare(func_num_args(), func_get_args(), $ret, $ret2, __FUNCTION__);
		
			if( $ret->hsv[2] > $ret2->hsv[2] ) 
				return $ret;
			
				return $ret2;
	}
	
	public function compare_saturation($c)
	{
		$ret = $this;
		$ret2 = false;
		$this->__compare(func_num_args(), func_get_args(), $ret, $ret2, __FUNCTION__);
		
			if( $ret->hsv[1] > $ret2->hsv[1] ) 
				return $ret;
			
				return $ret2;
	}

	public function compare_hue($c)
	{
		$ret = $this;
		$ret2 = false;
		$this->__compare(func_num_args(), func_get_args(), $ret, $ret2, __FUNCTION__);
		
			if( $ret->hsv[0] > $ret2->hsv[0] ) 
				return $ret;
			
				return $ret2;
	}
	
	public function compare_contrast($c)
	{
		if( !is_object($this) || !isset($this) )
			return self::__callStatic('compare_contrast', func_get_args());
		
		$ret = $this;
		$ret2 = false;
		
		$this->__compare(func_num_args(), func_get_args(), $ret, $ret2, __FUNCTION__);

			$L1 = $ret->contrast;
			$L2 = $ret2->contrast;
			
			$contrastRatio = ($L1 > $L2)? (int)(($L1 + 0.05) / ($L2 + 0.05)): (int)(($L2 + 0.05) / ($L1 + 0.05));

			if ($contrastRatio > 5) {
				return $ret2;
				
			} else {
				
					if( $ret->contrast >  $ret2->contrast )
						return $ret;
					
						return $ret2;
			}
	}
	
	public function MakeStatic()
	{
		$this->isstatic = true;
	}
	
	public static  function DHEXtoRGB($hex)
	{
		$hex = preg_replace("/[^0-9A-Fa-f]/", '', $hex);
		$rgb = [];
	
		if (strlen($hex) == 6) {
			
			$colorVal = hexdec($hex);
			
			
			
			$rgb[0] = 0xFF & $colorVal;
			$rgb[1] = 0xFF & ($colorVal >> 0x8);
			$rgb[2] = 0xFF & ($colorVal >> 0x10);
			
		} elseif (strlen($hex) == 3) {
		
			$rgb[0] = hexdec(str_repeat(substr($hex, 0, 1), 2));
			$rgb[1] = hexdec(str_repeat(substr($hex, 1, 1), 2));
			$rgb[2] = hexdec(str_repeat(substr($hex, 2, 1), 2));
		
		} else {
		
			$rgb[0] = $hex & 0xFF;
			$rgb[1] = ($hex >> 8) & 0xFF;
			$rgb[2] = ($hex >> 16) & 0xFF; 
		
		}
    return $rgb;
	}
	
	public static function HEXtoRGB($hexStr)
	{
		$rgb = self::DHEXtoRGB($hexStr);
	return [$rgb[2], $rgb[1], $rgb[0]];
	}
	
	public static function DhexToHex($dhexStr)
	{
		return self::RGBtoHEX( ...self::DHEXtoRGB($dhexStr) );
	}
	
	public static function RGBtoHEX($r, $g, $b)
	{
		return sprintf("#%02x%02x%02x", $r, $g, $b);
	}
	
	public static function RGBtoDHEX($r, $g, $b)
	{
		return sprintf("#%02x%02x%02x", $b, $g, $r);
	}
	
	public static function RGBtoHSV ($r,$g,$b)
	{

    
        // get highest and lowest colors
        $max = max($r,$g,$b);
        $min = min($r,$g,$b);
        
        $v = $max;          // 'value' is always the highest value from RGB
        $delta = $max-$min; // get midway between highest and lowest, this is our delta!
		if ($delta == 0) $delta = 1;
        if ($max == 0)  return [0,0,0]; // this is black, if the biggest value is 0
    
        $s = 100*($delta/$max);  // 'saturation' is our delta divided by max 
        
        // see which color is most dominant
        if ($r == $max)          $h = @round(( $g - $b ) / $delta);     // between yellow & magenta
        elseif ($g == $max)    $h = @round(2 + ( $b - $r ) / $delta);   // between cyan & yellow
        else                        $h = @round(4 + ( $r - $g ) / $delta);  // between magenta & cyan
    
        $h*=60; // move into primary/secondary color group
        
        // we can't be having negatives.. if it's in negatives, add 360 (full circle)
        $h = ($h < 0) ? $h = 0: $h;
        return [ceil($h),ceil($s),ceil(100*($v/255))];
	}
	
	public static function HSVtoRGB ($h, $s, $v)
	{
        // safegaurds against invalid values
        if ($h < 0 ) $h+=359; elseif ($h > 359) $h-=359;
        if ($v > 100) $v=100; elseif ($v < 0) $v = 0; 
        if ($s > 100) $s=100; elseif ($s < 0) $s=0;
        if ($s == 0)
		{
			$v = floor($v*2.55);
			return [$v, $v, $v];
		} // this is grey
    
        $h/=60;              // move hue into 1-6 (primary & secondary colors)
        $s/=100; $v/=100; // divide by 100 so we are dealing with proper 0.0 - 0.1 
        $factor = $h-floor($h); // get fractional part of the hue
    
        // math to get into the 255 range of things from the _sat and _val
        $color1 = ceil($v * (1-$s)*255);
        $color2 = ceil($v * (1-($s * $factor))*255);
        $color3 = ceil($v * (1-($s * (1-$factor)))*255);
        $v = ceil($v*255);
    
        // return rgb based on which primary/secondary color group we are in
        switch (floor($h))
        {
            case 0: $red = $v; $green = $color3; $blue = $color1; break;
            case 1: $red = $color2; $green = $v; $blue = $color1; break;
            case 2: $red = $color1; $green = $v; $blue = $color3; break;
            case 3: $red = $color1; $green = $color2; $blue = $v; break;
            case 4: $red = $color3; $green = $color1; $blue = $v; break;
            case 5: $red = $v; $green = $color1; $blue = $color2; break;
        }
        return [$red, $green, $blue];
	}
	
	public static function RGBtoHSL( $r, $g, $b )
	{
		$oldR = $r;
		$oldG = $g;
		$oldB = $b;
		$r /= 255;
		$g /= 255;
		$b /= 255;
		$max = max( $r, $g, $b );
		$min = min( $r, $g, $b );
		$l = ( $max + $min ) / 2;
		$d = $max - $min;
    	if( $d == 0 ){
        	$h = $s = 0; // achromatic
    	} else {
        	$s = $d / ( 1 - abs( 2 * $l - 1 ) );
			switch( $max ){
					case $r:
						$h = 60 * fmod( ( ( $g - $b ) / $d ), 6 ); 
							if ($b > $g) {
							$h += 360;
						}
						break;
					case $g: 
						$h = 60 * ( ( $b - $r ) / $d + 2 ); 
						break;
					case $b: 
						$h = 60 * ( ( $r - $g ) / $d + 4 ); 
						break;
				}			        	        
		}
	return [ round( $h, 2 ), round( $s, 2 ), round( $l, 2 ) ];
	}
	
	public static function RGBtoBGR( $r, $g, $b )
	{
		return [$b,$g,$r];
	}
	
	public static function HSLtoRGB( $h, $s, $l )
	{
		$c = ( 1 - abs( 2 * $l - 1 ) ) * $s;
		$x = $c * ( 1 - abs( fmod( ( $h / 60 ), 2 ) - 1 ) );
		$m = $l - ( $c / 2 );
		if ( $h < 60 ) {
			$r = $c;
			$g = $x;
			$b = 0;
		} else if ( $h < 120 ) {
			$r = $x;
			$g = $c;
			$b = 0;			
		} else if ( $h < 180 ) {
			$r = 0;
			$g = $c;
			$b = $x;					
		} else if ( $h < 240 ) {
			$r = 0;
			$g = $x;
			$b = $c;
		} else if ( $h < 300 ) {
			$r = $x;
			$g = 0;
			$b = $c;
		} else {
			$r = $c;
			$g = 0;
			$b = $x;
		}
		$r = ( $r + $m ) * 255;
		$g = ( $g + $m ) * 255;
		$b = ( $b + $m  ) * 255;
	return [ floor( $r ), floor( $g ), floor( $b ) ];
	}
	
	public static function RGBtoCMYK($r, $g, $b)
	{
				$tC = 1 - ($r / 255);
		$tM = 1 - ($g / 255);
		$tY = 1 - ($b / 255);
		
		$min = min($tC, $tM, $tY) ;
		
		if ($min == 1) {
			
			return [0,0,0,1];
		} else {
			
				$K = $min;
				$tK = 1 - $K;
			
            return [
				($tC - $K) / $tK,
				($tM - $K) / $tK,
				($tY - $K) / $tK,
				$K
            ];
		}
	}
	
	public static function CMYKtoRGB($c, $m, $y, $k)
	{
		$r = 1 - ($c * (1 - $k) + $k);
		$g = 1 - ($m * (1 - $k) + $k);
		$b = 1 - ($y * (1 - $k) + $k);
		
		return [
			(integer) (($r * 255) + 0.5),
			(integer) (($g * 255) + 0.5),
			(integer) (($b * 255) + 0.5),
		];
	}
	
	public static function BGRtoRGB($b, $g, $r)
	{
		return [$r, $g, $b];
	}
	
	public static function COLORtoRGB($color)
	{
		if( $color instanceof self::$classname )
			
			return $color->rgb;
		else
			return self::DHEXtoRGB($color);
	}
	
	public static function __callStatic($name, $arguments) 
	{
		if( $name !== 'compare_contrast' ) return;
		
		$hexColor	= $arguments[0];
		$hexColor2	= isset($arguments[1])? $arguments[1]: "#000000";
		
			// Convert input color to the RGB
			$B1 = hexdec(substr($hexColor, 1, 2));
			$G1 = hexdec(substr($hexColor, 3, 2));
			$R1 = hexdec(substr($hexColor, 5, 2));

			// Convert contrast color to the RGB
			$B2hx = hexdec(substr($hexColor2, 1, 2));
			$G2hx = hexdec(substr($hexColor2, 3, 2));
			$R2hx = hexdec(substr($hexColor2, 5, 2));

			// Calculate the contrast ratio
			$L1 = 0.2126 * pow($R1 / 255, 2.2) +
				0.7152 * pow($G1 / 255, 2.2) +
				0.0722 * pow($B1 / 255, 2.2);
	
			$L2 = 0.2126 * pow($R2hx / 255, 2.2) +
				0.7152 * pow($G2hx / 255, 2.2) +
				0.0722 * pow($B2hx / 255, 2.2);

			$contrastRatio = ($L1 > $L2)? (int)(($L1 + 0.05) / ($L2 + 0.05)): (int)(($L2 + 0.05) / ($L1 + 0.05));

			if ($contrastRatio > 5) {
				return $hexColor2;
			} else { 
					if($L1 > $L2)
					return $hexColor;	
				return $hexColor2;
			}
	}
	
	//non-static context only
	//вызывается только на объекте
	public function __toString()
	{
		return hexdec(self::RGBtoDHEX((int)$this->rgb[0], (int)$this->rgb[1], (int)$this->rgb[2]));
	}
	
	public function __invoke($color)
	{
		$args = func_get_args();
		
		switch( func_num_args() ) {
			
			case 1: {
					return new self::$classname( $args[0] );
			}	break;
			
			case 2: {
					return new self::$classname($args[0], $args[1]);
			}	break;
			
			case 3: {
					return new self::$classname($args[0], $args[1], $args[2]);
			}	break;
			
			case 4: {
					return new self::$classname($args[0], $args[1], $args[2], $args[3]);
			}	break;
			
			case 0:		trigger_error('Not enough parameters passed to '.self::$classname.'::__construct()',		E_USER_ERROR);	break;
			
			default:	trigger_error('Too many actual parameters passed to '.self::$classname.'::__construct()',	E_USER_ERROR);	break;	
			
		}
	}
	
	public function mix( $color )
	{
		$color = call_user_func_array([self::$classname, "__invoke"], func_get_args());
		if( isset($color->rgb) ) {
		$this->rgb = [	round(($this->rgb[0] + $color->rgb[0])/2), 
							round(($this->rgb[1] + $color->rgb[1])/2),
							round(($this->rgb[2] + $color->rgb[2])/2)
						   ];
			return true;
		}
		return false;
	}
	
	public function unmix( $color )
	{	
		$color = call_user_func_array([self::$classname, "__invoke"], func_get_args());
		if( isset($color->rgb) ) {
		$this->rgb = [	round(($this->rgb[0] - $color->rgb[0])/2), 
							round(($this->rgb[1] - $color->rgb[1])/2),
							round(($this->rgb[2] - $color->rgb[2])/2)
						   ];
			return true;
		}
		return false;
	}
	
	public function add( $color )
	{
		if( is_numeric($color) && $color < 256 ) {
			$this->rgb = [ $this->rgb[0] + $color,  $this->rgb[1] + $color,  $this->rgb[2] + $color ];
			return true;
		} else {
			$color = call_user_func_array([self::$classname, "__invoke"], func_get_args());
			if( isset($color->rgb) )
				$this->rgb = [ $this->rgb[0] + $color->rgb[0],  $this->rgb[1] + $color->rgb[1],  $this->rgb[2] + $color->rgb[2] ];
			
			return isset($color->rgb);
		}
	}
	
	public function subtract( $color )
	{
		if( is_numeric($color) && $color < 256 ) {
			$this->rgb = [ $this->rgb[0] - $color,  $this->rgb[1] - $color,  $this->rgb[2] - $color ];
			return true;
		} else {
			$color = call_user_func_array([self::$classname, "__invoke"], func_get_args());
			if( isset($color->rgb) )
				$this->rgb = [ $this->rgb[0] - $color->rgb[0],  $this->rgb[1] - $color->rgb[1],  $this->rgb[2] - $color->rgb[2] ];
			
			return isset($color->rgb);
		}
	}
	
	public function gradient ($c, $Step)
	{
		--$Step;
		$color = call_user_func_array([self::$classname, "__invoke"], array_slice(func_get_args(), 0, func_num_args()-1));
		$GradientColors = [];
		
		if( $Step == 1 )
			return $this;
		elseif( $Step == 2 )
			return [$this, $color];
		
		for($I=0;$I<=2;$I++)
		{
				$Steps[$I] = ($this->rgb[$I] - $color->rgb[$I]) / ($Step - 1);
		}

		for($i = 0; $i <= $Step; $i++)
		{
			$rgb = [floor($this->rgb[0] - ($Steps[0] * $i)),
										floor($this->rgb[1] - ($Steps[1] * $i)),
										floor($this->rgb[2] - ($Steps[2] * $i))];
			if( min($rgb) > 0 && max($rgb) < 256) 
				$GradientColors[] =  new self::$classname(	$rgb, 'rgb');
		}
		
	return $GradientColors;
	}
	
	public function multiply( $v )
	{
		if( is_int($v) || is_integer($v) || is_float($v) ) {
			if( $v <= 255 ){
				if( !$this->check_val($v, 'Color multiplier', 'int', 255) )				return false;
				$this->rgb = [ $this->rgb[0] * $v,  $this->rgb[1] * $v,  $this->rgb[2] * $v ];
				return true;
			}
		}
		$v = call_user_func_array([self::$classname, "__invoke"], func_get_args());
				if( isset($v->rgb) )
					for($i=0;$i<=3;$i++) 
						{
								$this->rgb[$i] = $this->rgb[$i] * $v->rgb[$i];
						}
				return isset($v->rgb);
	}
	
	public function divide( integer $v )
	{
		if( is_int($v) || is_integer($v) || is_float($v) ) {
			if( $v <= 255 ){
				if( !$this->check_val($v, 'Color divider', 'int', 255) )				return false;
					if( $v <> 0 ) {
						for($i=0;$i<=3;$i++) 
						{
							if( $this->rgb[$i] > 0 )
								$this->rgb[$i] = $this->rgb[$i] / $v;
						}
						return true;
					} else {
						return $this->multiply( $v );
					}
		
			}
		}
		$v = call_user_func_array([self::$classname, "__invoke"], func_get_args());
				if( isset($v->rgb) )
					for($i=0;$i<=3;$i++) 
						{
							if( $this->rgb[$i] > 0 && $v->rgb[$i] > 0) {
								$this->rgb[$i] = $this->rgb[$i] / $v->rgb[$i];
							} else {
								$this->rgb[$i] = 0;
							}
						}
				return isset($v->rgb);
	}
	
	public function increase( $percent )
	{
		if( !$this->check_val($v, 'Color increasement percent', 'int', 100) )	return false;
		$this->rgb = [$this->rgb[0] + (($this->rgb[0]/100) * $percent),
					$this->rgb[1] + (($this->rgb[1]/100) * $percent),
					$this->rgb[2] + (($this->rgb[2]/100) * $percent)];
		return true;
	}
	
	public function decrease( $percent )
	{
		if( !$this->check_val($v, 'Color decreasement percent', 'int', 100) )	return false;
		$this->rgb = [$this->rgb[0] - (($this->rgb[0]/100) * $percent),
					$this->rgb[1] - (($this->rgb[1]/100) * $percent),
					$this->rgb[2] - (($this->rgb[2]/100) * $percent)];
		return true;
	}
	
	public function assume( $color )
	{
		$color = call_user_func_array([self::$classname, "__invoke"], func_get_args());
		if( $this->isstatic ) {
			trigger_error("Static ".self::$classname." cannot be assumed to",	E_USER_ERROR);
			return false;
		} else {
			$this->rgb = $color->rgb;
			return true;
		}
	}
	
	public function assign( $color )
	{
		$color = call_user_func_array([self::$classname, "__invoke"], func_get_args());
		if( $this->isstatic ) {
			trigger_error("Static ".self::$classname." cannot be assigned to",	E_USER_ERROR);
			return false;
		} else {
			$this->rgb = $color->rgb;
			return true;
		}
	}
	
	public function rewind()
	{
		reset($this->rgb);
	}
	
	public function offsetExists($id)
	{
		return isset($this->rgb[$id]);
	}

    public function offsetGet($id)
    {
        if( $this->offsetExists($id) )
			return $this->rgb[$id];
		
				trigger_error("Element {$id} of " . self::$classname . " RGB Array not found!", 				E_USER_ERROR);
			return false;
    }

    public function offsetSet($id, $v)
    {
        if ( !is_null($id) && !empty($id) ) {
            if( isset($this->rgb[$id] ) ) {
				
				if( $this->check_val($v, 'RGB Array Element', 'int', 255) )
					$this->rgb[$id] = $v;
					return true;
			} else {
				
				trigger_error("Element {$id} of " . self::$classname . " RGB Array not found!", 				E_USER_ERROR);
				return false;
			}
		}
    }

    public function offsetUnset($id)
    {
		if( $this->offsetExists[$id] ) {
			
			trigger_error("YOU cannot unset " . self::$classname . " RGB Array elements, just set it to zero.",	E_USER_ERROR);
			$this->rgb[$id] = 0;
			return true;
		} else {
			
			trigger_error("Element {$id} of " . self::$classname . " RGB Array not found!", 					E_USER_ERROR);
			return false;
		}
    }
	
    public function current()
    {
        return current($this->rgb);
    }
  
    public function key() 
    {
        return key($this->rgb);
    }
  
    public function next() 
    {
        return next($this->rgb);
    }
  
    public function valid()
    {
		$key = key($this->rgb);
		
        return ($key !== NULL && $key !== FALSE);
    }
}

function TColor( $color ) {
	return call_user_func_array(["TColor", "__invoke"], func_get_args());
}

?>