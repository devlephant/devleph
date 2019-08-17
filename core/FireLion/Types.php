<?
class TypeHelperClass
{
public static $BinaryFormats = [
			"exe", "dll", "so", "bpl", "com", "cmd", "sys", "sh", "bat", "apk", "lpk", "bin", "dmp",
			"mf4", "res", "dlf", "pld", "oct", "pib", "bdf", "00", "sbn", "vtz", "sea", "ami", "fcm",
			"qq", "dpl", "pbo", "dmt", "lsb", "aab", "vdb", "dcp", "pbt", "shk", "1", "dde", "aks",
			"264", "zbf", "buml", "oca", "baml", "mdf", "x3db", "dmg", "blg", "dcu", "bny", "rbf",
			"dsm", "bxy", "bfy", "odb", "grib", "grub", "exp", "iso", "vmd", "bif", "tpa", "bws"
			];
	public static $Typos
	[
		"array"=>"is_array",
		"binaries"=>function($file)
		{
			if(is_file($file))
				return in_array(array_pop( explode(".",$file) ), TypedArray::$BinaryFormats);
			return false;
		},
		"bin"=>function($file)
		{
			if(is_file($file))
				return in_array(array_pop( explode(".",$file) ), TypedArray::$BinaryFormats);
			return false;
		},
		"bool"=>"is_bool",
		"boolean"=>"is_bool",
		"class"=>function($class)
		{
			return class_exists($class,false);
		},
		"closure"=>function($obj)
		{
			return is_object($obj) && get_class($obj)=="Closure";
		},
		"invokable"=>function($obj)
		{
			return is_object($obj) && is_callable($obj);
		},
		"function"=>function($f)
		{
			return is_callable($f) && (is_object($f) || (is_string($f) && strpos($f, '::')==false) );
		},
		"dir"=>"is_dir",
		"directory"=>"is_dir",
		"path"=>function($path)
		{
			return is_file($path) || is_dir($path);
		},
		"double"=>"is_double",
		"float"=>"is_float",
		"int"=>"is_int",
		"integer"=>"is_integer",
		"long"=>"is_long",
		"num"=>"is_numeric",
		"number"=>"is_numeric",
		"numeric"=>"is_numeric",
		"link"=>"is_link",
		"exe"=>"is_executable",
		"executable"=>"is_executable",
		"file"=>"is_file",
		"finite"=>"is_finite",
		"fin"=>"is_finite",
		"inf"=>"is_infinite",
		"infinite"=>"is_infinite",
		"infinity"=>"is_infinite",
		"nan"=>"is_nan",
		"null"=>"is_null",
		"nil"=>function($nil)
		{
			return $nil==-1;
		},
		"object"=>"is_object",
		"resource"=>"is_resource",
		"string"=>"is_string",
		"str"=>"is_string",
		"scalar"=>"is_scalar",
		"invokableclass"=>function($class)
		{
			return method_exists($class, '__invoke');
		},
		"staticclass"=>function($class)
		{
			return !method_exists($class, '__construct');
		},
		"dynamicclass"=>function($class)
		{
			return method_exists($class, '__construct');
		},
		"objectclass"=>function($class)
		{
			return method_exists($class, '__construct');
		},
		"callable"=>"is_callable",
		"mixed"=> function($v){ return true }
	];
	
	public static function AddType($name, $check_func)
	{
		if(!is_callable($check_func) ) return false;
		self::$Typos[is_string($name)?strtolower($name):$name] = $check_func;
		return true;
	}
	
	public static function RemType($name)
	{
		$name = strtolower($name);
		if(isset(self::$Typos[$name]))
		{
			unset(self::$Typos[$name]);
			return true;
		}
		return false;
	}
	protected static function DoCall($type, $v)
	{
		if( isset(self::$Typos[$type]) )
			call_user_func(self::$Typos[$type], $v)
		elseif( class_exists($type, false) )
			return is_object($v) && is_a($v, $type);
	}

	public static function CheckType($type, $v)
	{
		$inv = substr($type,0,1) == '!';
		$r = isset(self::$Typos[$type])? call_user_func(self::$Typos[$type], $v): false;
		return ($inv)? !$r: $r; 
	}
	
	public static function CheckTypes($types, $not, $v)
	{
		if( count($not) > 0 )
		foreach($not as $type)
		{
			if( self::DoCall($type, $v) )
				return false;
		}
		if( count($types) > 0)
		foreach($types as $type)
		{
			if( self::DoCall($type, $v) )
				return true;
		}
		return false;
	}
	protected static function FixNot(&$v, &$t, &$not, &$def)
	{
		if( is_object($v)?!in_array(gettype($v),$not):!in_array(gettype($v),$not) ) return true;
		foreach( $not as $NT )
		{
			switch($NT)
			{
				case 'long':
				case 'int':
				case 'integer':
				$v = in_array('float', $t)? (float)$v: (in_array('double',$t)?(double)$v:(in_array('string',$t)?(string)$v:$def));
				
				case 'float':
				$v = in_array('double',$t)?(double)$v: ((in_array('int', $t)||in_array('integer', $t)||in_array('long', $t))?
				 (integer)$v:(in_array('string',$t)?(string)$v:$def));
				
				case 'double':
				$v = in_array('float',$t)?(float)$v: ((in_array('int', $t)||in_array('integer', $t)||in_array('long', $t))?
				 (integer)$v:(in_array('string',$t)?(string)$v:$def));
				
				case 'bigint':
				$v = (in_array('int', $t)||in_array('integer', $t)||in_array('long', $t))
				? PHP_INT_MAX: (in_array('string',$t)?(string)$v:$def);
				
				case 'bool':
				case 'boolean':
				$v = (in_array('int', $t)||in_array('integer', $t)||in_array('long', $t))?
				 (integer)$v:(in_array('float',$t)?(float)$v: (in_array('string',$t)?(string)$v:$def));
				
				default:
				{
					$v = $def;
					return false;
				} break;
			}
		}
		return true;
	}
	public static function ConvertValue(&$v,$c,$types,$not,$Default=null)
	{
		$r = $Default;
		foreach ($types as $T)
			if( isset($c[gettype($v)]) && $c[gettype($v)]->compatible($T) )
				{
					$r = $c[gettype($v)]->convert($v,$T);
				} elseif (is_object($v))
				{
					$class = get_class($v);
					if(isset($c[$class]) && $c[$class]->compatible($T))
					{
						$r = $c[get_class($v)]->convert($v,$T);
					}
				} else {
					$v = $r;
					return false;
				}
				
		return self::FixNot($r, $types, $not, $Default);
	}
	
	public static function GetType($v)
	{
		if( is_object($v) )
		{
			$class = get_class($v);
			return  is_callable($v)? ($class=="Closure"?"callable": "invokable"):
			(is_subclass_of($class,"DynamicClass")?$v->GetClass():$class );
		} elseif( is_string($v) && class_exists($v) )
		{
			return "class";
		} elseif( is_string($v) && function_exists($v) )
		{
			return "callable";
		} else {
			foreach( self::$Typos as $type=>$check )
				if( call_user_func($check,$v) ) return $type;
		}
	}
	public static function IsType($v,$type)
	{
		return self::CheckType(strtolower($type),$v);
	}
}