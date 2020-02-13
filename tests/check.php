<?php
if( !defined("STDOUT") )
{
	if( !is_file("stdout.log") )
		file_put_contents("stdout.log", "");
	define("STDOUT", fopen("stdout.txt", "w+"));
}
class TestUnit
{
	public static $LogHandler = STDOUT; //Doesn't work until launch with -t parameter
	
	public static $IS_NOT_CALLABLE = "%s1 is not callable!";
	public static $FUNCTION_DNE = "Function \"%s1\" does not exists!";
	public static $ERROR_WHILE_EXECUTING = "Function \"%s1\" raised Error" . PHP_EOL . "%s3";
	public static $WRONG_RESULT = "Function \"%s1\" returned wrong result!";
	public static $WRONG_PARAM = "Function \"%s1\" variated wrong parameter!";
	public static $ARGUMENT_DNE = "Specified argument \"%s3\" does not exists!";
	public static $COMPARING_RESULT = "Comparing function \"%s1\" result";
	public static $COMPARING_ARG = "Comparing function \"%s1\" argument #%s2";
	
	/* not intended */
	public static $CONST_UNDEF = "Constant \"%s1\" undefined!";
	public static $CONST_WRONG_VAL = "Constant \"%s1\" has wrong value of %s2";
	
	public static $FUNC_UNDEF = "Function \"%s1\" undefined!";
	
	public static $CLASS_UNDEF = "Class \"%s1\" undefined!";
	
	public static $ext_err = "UNABLE TO LOAD %s1 extension!";
	public static $rtl_err = "UNABLE TO LOAD %s1 runtime library!";
	
	/* intersected */
	public static $__WRONG_COUNT = "Wrong argument count for \"%s1\" [required: %s2; passed: %s3]";
	public static $__WRONG_PASSED_TO = "Wrong parameter type passed to \"%s1\"" . PHP_EOL . "[passed: %s2]";
	/*?------------*/
	
	static $Error = false;
	static $NamePrePend = '';
	public static function Dump($v)
	{
		ob_start();
		var_dump($v);
		return ob_get_clean();
	}
	public static function LibLoaded($l)
	{
		if( substr($l,0,4) == "php_" and explode(".", $l)[substr_count($l,".")-1] == "dll" )
		{
			$r = SELF::ExtensionLoaded($l);
		} else $r = SELF::ModuleLoaded($l);
	}
	
	public static function CheckLibFuncs($l, array $funcs, CheckEvents $FuncE)
	{
		$r = SELF::LibLoaded($l);
		if( !$r ) 
		{
			SELF::$Error = false;
			$FuncE->Call("OnError", $l);
			return FALSE;
		}
		$res = TRUE;
		SELF::$NamePrePend = $l . "/";
		$res = SELF::CheckFuncs($funcs, $FuncE, true);
		if($res)
			$FuncE->Call("OnSucces", $l);
		SELF::$NamePrePend = '';
		return $res;
	}
	
	public static function CheckLibFuncsExistance($l, array $funcs)
	{
		$r = SELF::LibLoaded($l);
		if( !$r ) 
		{
			SELF::$Error = false;
			return FALSE;
		}
		$flist = get_extension_funcs($l);
		foreach($funcs as $f)
		{
			if(!in_array($f, $flist, false)) return FALSE;
		}
		return TRUE;
	}
	
	public static function CheckConsts(array $consts, CheckEvents $ConstE)
	{
		$res = TRUE;
		$i=0;
		$t = count($consts);
		if($t > 0)
		foreach( $consts as $ci=>$val )
		{
			$FuncE->Call("OnProgress", ++$i, $t);
			if( is_string($ci) )
			{
				$res = $res and SELF::ConstVal($ci, $val);
			} else {
				$name = $val;
				$res = $res and SELF::ConstExist($ci);
			}
			$FuncE->Call(	($res? "OnPass": "OnFail"), $name	);
		}
		
		if($res)
			$FuncE->Call( "OnSucces" );
		return $res;
	}
	
	public static CheckFuncs(array $funcs, CheckEvents $FuncE, $ref=false)
	{
		$res = TRUE;
		$i=0;
		$t = count($funcs);
		if($t > 0)
		foreach( $funcs as $func=>$args )
		{
			$FuncE->Call("OnProgress", ++$i, $t);
			if( is_string($func) || is_callable($func) )
			{
				$name = $func;
				if( !is_array($args) )
				{
					$res = $res and SELF::Call($name);
				} else {
					if( isset($args[1]) )
					{
						if( is_array($args[1]) )
						{
							if( IsSet($args[1][0]) ) //return/result type
							{
								$res = $res and SELF::CallRet($name, $args[1][0], ...$args[0]);
							}
							if( IsSet($args[1][1]) && is_array($args[1][1]) )//input-var/parameter/argument type
							{
								$res = $res and Self::CallArg($name, $args[1][1][0], $args[1][1][1], ...$args[0]);
							}
						} else {//return/result type
							$res = $res and SELF::CallRet($name, $args[1], ...$args[0]);
						}
					} else {
						$res = $res and SELF::Call($name, ...$args[0]);
					}
				}
			} else {
				$name = $args;
				$res = $res and SELF::Call($name);
			}
			$FuncE->Call(	($res? "OnPass": "OnFail"), $name	);
		}
		
		if($res && !$ref)
			$FuncE->Call( "OnSucces" );
		return $res;
	}
	
	public static function Log($data)
	{
		if( is_resource(SELF::$LogHandler) )
		{
			fwrite(SELF::$LogHandler, PHP_EOL . $data);
		}elseif( is_file(SELF::$LogHandler) )
		{
			file_put_contents(SELF::$LogHandler, $data, FILE_APPEND);
		} elseif ( is_callable(SELF::$LogHandler) )
		{
			call_user_func_array(SELF::$LogHandler, [$data]);
		} elseif ( is_object(SELF::$LogHandler) || (is_string(SELF::$LogHandler) && class_exists(SELF::$LogHandler,false)) )
		{
			if(  is_object( SELF::$LogHandler) )
			{
				if( IsSet(SELF::$LogHandler->Text) )
				{
					SELF::$LogHandler->Text .= PHP_EOL . $data;
				} elseif( IsSet(SELF::$LogHandler->Html) )
				{
					SELF::$LogHandler->Html .= PHP_EOL . $data;
				} elseif( IsSet(SELF::$LogHandler->Content) )
				{
					SELF::$LogHandler->Content .= PHP_EOL . $data;
				} 
			}
			if( method_exists(SELF::$LogHandler, "Log") )
			{
				call_user_method("Log", SELF::$LogHandler, $data);
			} elseif( method_exists(SELF::$LogHandler, "Execute") )
			{
				call_user_method("Execute", SELF::$LogHandler, $data);
			}
		}
	}
	
	protected static function Doerrf($estr, ...$args)
	{
		SELF::Log( "Function " . SELF::$NamePrePend.$args[0] . ":{" . PHP_EOL . print_r($args[1],true) . PHP_EOL "}:" . SELF::$NamePrePend.$args[0] );
		SELF::DoErr($estr, ...$args);
	}
	
	public static function Doerr($erstr, ...$args)
	{
		$args[0] = SELF::$NamePrePend . $args[0];
		foreach( $args as &$_content )
			$_content = print_r($_content,true);
		SELF::$Error = true;
		SELF::Log( "ERROR: " . sprintf($erstr, ...$_content) );
	}
	
	public static function Call( $name, ...&$args )
	{
		SELF::Log(SELF::${"CALLING"}, $name, $args);
		if( !is_callable($name) and substr($name, 0, 2) !== "<?" )
			if( is_string($name) )
			{
				SELF::DoErrf( SELF::${"FUNCTION_DNE"}, $name, $args);
			} else SELF::DoErrf( SELF::${"IS_NOT_CALLABLE"}, $name, $args );
		try{
			call_user_func_array($name, $args);
		} catch( Exception $e )
		{
			SELF::DoErrf(SELF::${"ERROR_WHILE_EXECUTING"}, $name, $args, $e);
		}
	}
	
	public static function CallRet( $name, Check $check, ...&$args)
	{
		$argcopy = $args;
		$r = SELF::Call($name, ...$args);
		if( SELF::$Error )
		{
			SELF::$Error = false;
			return FALSE;
		}
		
		SELF::Log(SELF::${"COMPARING_RESULT"}, $name);
		$res = $check->Execute( $r );
		SELF::DoCmpRes(SELF::Dump($res), $check, $name, SELF::Dump($argcopy), SELF::Dump($args), SELF::Dump($r));
		return $res;
	}
	
	public static function CallArg( $name, $ArgNum, Check $check, ...&$args)
	{
		SELF::Call($name, ...$args);
		if( SELF::$Error )
		{
			SELF::$Error = false;
			return FALSE;
		}
		
		SELF::Log(SELF::${"COMPARING_ARG"}, $name, $ArgNum);
		if( !isSet($args[$ArgNum]) )
		{
			SELF::DoErrf(SELF::${"ARGUMENT_DNE"}, $name, SELF::Dump($args), $ArgNum);
			SELF::$Error = false;
			return FALSE;
		} else {
			$res = $check->Execute( $args[$ArgNum] );
			SELF::DoCmpRes(SELF::Dump($res), $check, $name, SELF::Dump($argcopy), SELF::Dump($args));
		}
		
		return $res;
	}
	
	public static function ConstExist( $name )
	{
		$res = defined($name);
			if(!$res)
				SELF::DoErr(SELF::${"CONST_UNDEF"}, $name);
			SELF::$Error = false;
		return $res;
	}
	
	public static function FuncExist( $name )
	{
		$res = function_exists($name);
			if(!$res)
				SELF::DoErr(SELF::${"FUNC_UNDEF"}, $name);
			SELF::$Error = false;
		return $res;
	}
	
	public static function ClassExist( $name )
	{
		$res = function_exists($name);
			if(!$res)
				SELF::DoErr(SELF::${"FUNC_UNDEF"}, $name);
			SELF::$Error = false;
		return $res;
	}
	
	public static function ExtensionLoaded( $name ) //?PHP Extensions
	{
		$name = BaseNameNoExt($name);
		if( strtolower( substr($name,0,4) ) == 'php_')
			$name = substr($name, 5);
			
		if( !extension_loaded($name) )
			SELF::DoErr( SELF::${"ext_err"}, 'php_' + $name + '.dll');
	}
	
	public static function ModuleLoaded( $name ) //RTL
	{	
		if( !rtll($name) )
			SELF::DoErr( SELF::${"rtl_err"}, $name);
	}
	
	public static function ConstVal( $name, Check $compare )
	{
		SELF::Compare( [ defined($name)? constant($name): null, $compare ], SELF::${"CONST_WRONG_VAL"} );
	}
	
	public static function Compare( $data, $ErrStr = "" )
	{
		if( count($data) < 2 || count($data) > 3)
		{
			SELF::DoErr(SELF::${"__WRONG_COUNT"}, __FUNCTION__, "2 or 3", count($data));
			SELF::$Error = false;
			return false;
		}
			
		if( count($data) == 2 )
		{
			if(!( $data[1] instanceof Check ))
			{
				SELF::DoErr(SELF::${"__WRONG_PASSED_TO"}, __FUNCTION__, $data);
				SELF::$Error = false;
				return false;
			}
			$cmp = $data[1];
		} else {
			$cmp = new Check($data[1], $data[2]);
		}
		$res = $cmp->Execte($data[0]);
			if( $ErrStr !== "" )
				SELF::DoErr($ErrStr, $data[0], $cmp->value, $cmp->type);
		return $res;
	}
	
	public static function Cmp( $data, $ErrStr = "" )
	{
		return SELF::Compare($data, $ErrStr);
	}
	
}
/*SKELETON*/
interface IEvented_ut
{
	public $OnError;
	public $OnFail;
	public $OnProgress;
	public $OnPass;
	public $OnSucces;
	//=> Событий хватает. Параметры - подходят?
	public function AddConstant( $Constant );
	public function AddFunction( $Function );
	public function GetStat(); //=> Формат статистики:?
	public function GetScope(); //=> Сводка.
	public function GetResult(); //=> Bool
	public function WriteLog(); //=> Вывод в консоль.
}

class __evented_test implements IEvented_ut
{
	public $OnError;
	public $OnFail;
	public $OnProgress;
	public $OnPass;
	public $OnSucces;
	
	public $UnitName;
	protected $Stats;
	protected $Result = Null;
	
	public $Constants = [];
	public $Functions = [];
	
	protected $EventsOverload;
	
	public function __construct($Name)
	{
		$this->UnitName = $Name;
		$this->EventsOverload = new CheckEvents([$this, "Progress"], [$this, "Fail"], [$this, "Pass"], [$this, "Succes"], [$this, "Error"]);
	}
	
	public function Progress($i, $t)
	{
		
	}
	
	public function Pass($i)
	{
		
	}
	
	public function Fail($i)
	{
		$this->Result = false;
	}
	
	public function Success($i)
	{
		$this->Result = $this->Result and True;
	}
	
	public function Error($i)
	{
		$this->Result = false;
	}
	
	public function AddConstant( $Constant, Check $TypeCheck = null)
	{
		if( $TypeCheck == null )
		{
			$this->Constants[] = $Constant;
		} else $this->Constants[$Constant] = $TypeCheck;
	}
	
	public function AddFunction( $Function, $args = [], Check $RtCheck = null, $ArgNum = null, Check $ArgCheck = null)
	{
		if( $RtCheck == null && $ArgCheck == null && empty($args))
		{
			$this->Functions[] = $Function;
		} elseif( $RtCheck == null && $ArgCheck == null )
		{
			$this->Functions[$Function] = [$args];
		} else {
			$this->Funtions[$Function]  = [$args, [$RtCheck, [$ArgNum, $ArgCheck]]];
		}
	}
	protected _imprtf(&$From)
	{
		if( IsSet($From) )
		foreach( $From as $Functions=>$Values )
		{
			$Function = is_string($Functions)? $Functions: $Values;
			if( is_array($Values) )
			{
				if( !isSet($Values[0]) )
				$Values[0] = [];
				if( isSet($Values[1]) )
				{
					$this->Functions[$Function] = [$Values[0], [new Check($Values[1][0][0], $Values[1][0][1]), [$Values[1][1][0], new Check($Values[1][1][1][0], $Values[1][1][1][1])]]];
				}	else 
				{
					$this->Functions[$Function] = $Values;
				}
			} else {
				$this->Functions[] = $Function;
			}
		}
	}
	protected _imprtc(&$From)
	{
		if( IsSet($From) )
		foreach( $From as $Constants=>$Values )
		{
			$Constant = is_string( $Constants )? $Constants: $Values;
			if( is_array($Values) )
			{
				$this->Constants[$Constants] = new Check($Values[0], $Values[1]);
			} else $this->Constants[] = $Values;
		}
	}
	protected _imprtn(&$From)
	{
		if( IsSet($From) )
		{
			if( is_array($From) )
			{
				$this->_imprtn($From[0]);
				$this->_imprtl($From[1]);
			} else 
				$this->UnitName = $From;
		}
	}
	protected _imprtl(&$Names)
	{
		
	}
	protected _imprte(&$From)
	{
		static $order = 
		["Progress", "Fail", "Pass", "Success", "Error"];
		//PR-FPS-E
		if( IsSet($From) )
		{
			if( is_array($From) )
			{
				foreach($From as $i=>$arr)
				{
					list($args, $code) = $arr;
					$this->{"On" . $order[$i]} = create_function($args, $code);
				}
			}
		}
	}
	public function Import( $From )
	{
		$this->_imprtc($From[0]);
		$this->_imprtf($From[1]);
		$this->_imprtn($From[2]);
		$this->_imprte($From[3]);
	}
	
	public function GetResult()
	{
		return $this->Result;
	}
}

class IUnitTest extends __evented_test
{
	public $Libs = [];
	
	public function AddLib( $Library )
	{
		if( file_exists($Library) or file_exists("ext/{$Library}") )
			$this->Libs[] = $Library;
	}
	
	protected _imprtl(&$Names)
	{
		if( IsSet($Names) )
			foreach($Names as $Name)
				$this->AddLib($Name);
	}
	
	public function Run()
	{
		$this->Result = True;
	}
}

class ILibTest extends __evented_test
{
	public function __construct($Name)
	{
		$ext = substr_count($Name,".")>0? explode(".",$Name)[substr_count($Name,".")-1]: (is_dir($Name)? "[\$ DIRECTORY]": "[\$ FILE]");
		if( $ext !== "dll" and $ext !== "so" and $ext !== "bpl" )
		{
			TestUnit::Log("Error: ILibTest::__construct({$Name}): Unsupported library type \"{$ext}\""); 
		} else {
			parent::__construct($Name);
		}
	}
}

class ITests
{
	protected $_t;
	protected $NoAdded;
	public function __construct($LogFunc=Null, $ErrFunc=Null)
	{
		
	}
	public function Add( IEvented_ut $Test )
	{
		$this->_t[] = $Test;
		$this->NoAdded = False;
	}
	
	public function Rem( IEvented_ut $Test )
	{
		$r = array_search($Test, $this->_t, true);
		
		if($r!==false)
			unset( $this->_t[$r] );
	}
	
	public function Include( $filename )
	{
		$ext = strtolower( explode(".",$filename)[substr_count($filename,".")-1] );
		if( $ext == "php" )
		{
			$this->NoAdded = True;
			$classes = get_declared_classes();
			include_once($filename);
			
			if( $this->NoAdded )
				$classes = array_diff(get_declared_classes(), $classes);
			
			foreach( $classes as $UnitTest )
			{
				if( in_array("IEvented_ut", class_implements($UnitTest, false) ) )
					$this->Add( new $UnitTest() );
			}
		} elseif( $ext == "js" || $ext == "pt" || $ext == "json" )
		{
			$type = explode(".",$filename);
			array_pop($type);
			$ext = $type[count($type)-1];
			$type = implode(".", $type);
			$test = ($ext == "dll" || $ext == "so" || $ext == "bpl")? new ILibTest($type): new IUnitTest($type);
				$this->Add( $test );
			$test->Import( json_decode( file_get_contents($filename), true ) );
		}
	}
}
/*SKELETON*/
class Check
{
	public $type;
	public $value;
	protected static $types = 
	[
		"="=>0,
		"=="=>0,
		"==="=>1,
		">"=>2,
		">="=>3,
		"<"=>4,
		"<="=>5,
		"<>"=>6,
		"!="=>7,
		"~"=>8,
		"`"=>9,
		"in"=>10,
		"?"=>11,
		"??"=>12,
		"is"=>13,
		""=>14,
		"sub"=>15,
		"range"=>16,
		"instance"=>17,
		"instanceof"=>17,
		"objectof"=>17,
		"class"=>17,
		"classof"=>17,
	];
	
	public function __construct($type, $value)
	{
		$this->type = is_integer($type)? $type: ( isSet( STATIC::$types[$type] )? STATIC::$types[$type]: 0 );
		$this->value = $value;
	}
	
	public function Execute( &$in )
	{
		if( $this->type == 11 )
			return isSet($in);
		
		if( $this->type == 12 )
		{
			if( !isSet($in) ) return false;
			
			return !is_null($in) && !is_nan($in);
		}
		
		if( $this->type == 0 )
			return $in == $this->value;
		
		if( $this->type == 1 )
			return $in == $this->value && gettype($in) == gettype($this->value);
		
		if( $this->type == 2 )
			return $in > $this->value;
		
		if( $this->type == 3 )
			return $in >= $this->value;
		
		if( $this->type == 4 )
			return $in < $this->value;
		
		if( $this->type == 5 )
			return $in <= $this->value;
		
		if( $this->type == 6 )
			return $in <> $this->value;
		
		if( $this->type == 7 )
			return $in != $this->value;
		
		if( $this->type == 8 )
		{
			if( is_string($in) )
			{
				$inv = $in;
				if( strlen($in) > strlen($this->value))
					$inv = substr($in, 0, strlen($this->value));
				return strtolower($inv) == strtolower($this->value);
			}
			if( is_float($in) || is_double($in) )
			{
				return ceil($in) == $this->value or floor($in) == $this->value;
			}
			if( is_infinite($in) )
			{
				return $in == $this->value or $this->value == PHP_INT_MAX;
			}
			if( is_integer($in) )
			{
				if( is_infinite($this->value) )
					return is_infinite($in) or $in == PHP_INT_MAX;
				return $in == $this->value or (is_null($this->value) && $in == -1);
			}
			if( is_nan($in) or is_null($in) )
			{
				return is_nan($this->value) or is_null($this->value);
			}
			
			if( is_array($in) )
			{
				if( is_array($this->value) )
				{
					$ct = Count($in);
					$ctc = Count($this->value);
					if( $ct < $ctc )
						return FALSE;
					
					$cmp_arr = array_values($in);
					$i = 0;
					while($ct>0 && $i<$ctc)
					{
						if( in_array($cmp_arr[$i], $this->value[$i], false) )
							--$ct;
						++$i;
					}
					return $ct == 0;
				}
					return in_array($this->value, $in);
			}
		}
		
		if( $this->type == 9 )
			return stripos($in, $this->value) !== false;
		
		if( $this->type == 10 )
		{
			if( is_string($this->value) )
				return stripos($this->value, $in) !== false;
			
			if( is_array($this->value) )
				return in_array($in, $this->value);
		}
		
		if( $this->type == 13 )
			return gettype($in) == strtolower($this->value);
		
		if( $this->type == 14 )
		{
			if( is_object($in) )
				if( $in instanceof $this->value )
					return true;	
			
			gettype($in) == $this->value;
		}
		
		if( $this->type == 15 )
		{
			$c = is_object($in)? get_class($in): $in;
			return in_array($this->value, class_implements($c)) or in_array($this->value, class_parents($c));
		}
		
		if( $this->type == 16 )
			return $in > $this->value[0] && $in < $this->value[1];
		
		if( $this->type == 17 )
			return $in instanceof $this->value;
	}
}
class_alias("Check", "CMP");
class_alias("Check", "Compare");
class_alias("Check", "CMPFunc");
function Compare($i, $type, $i2)
{
	return (new Check($type, $i))->Execute($i2);
}
function Check($i, $type, $i2)
{
	return (new Check($type, $i))->Execute($i2);
}
class CheckEvents
{
	#public $OnProgress;
	#public $OnFail;
	#public $OnPass;
	
	#public $OnSucces;
	#public $OnError;
	protected $evts = ["OnProgress"=>0, "OnFail"=>0, "OnPass"=>0, "OnSucces"=>0, "OnError"=>0];
	
	public function __construct(...$e)
	{
		if(!empty($e))
			for($i=0;$i<=5;$i++)
				$this->evts[$i] = is_callable($e[$i])?$e[$i]:0;
	}
	
	public function Call(...$args)
	{
		$name = array_shift($args);
		if( isSet($this->evts[$name]) )
		{
			call_user_func($this->evts[$name], ...$args);
		}
	}
	
	public function __set($name, $v)
	{
		if( !is_callable($v) ){
			TestUnit::Log("Error: value for " . __CLASS__  . "->{$name} is not CALLABLE!");
		return;}
		if( !isSet($this->evts[$name]) ){
			TestUnit::Log("Error: Event " . __CLASS__  . "->{$name} doesn't supporting!");
		return;}
		$this->evts[$name] = $v;
	}
	
	public function __get($name)
	{
		if( !isSet($this->evts[$name]) ){
			TestUnit::Log("Error: Event " . __CLASS__  . "->{$name} doesn't supporting!");
		return;}
	return $this->evts[$name]!==0? $this->evts[$name]: Null;
	}
	
	public function __isset($name)
	{
		return isSet($this->evts[$name]) && $this->evts[$name]!==0;
	}
}
