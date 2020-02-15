<?php
if( !defined("STDOUT") )
{
	if( !is_file("stdout.log") )
		file_put_contents("stdout.log", "");
	define("STDOUT", fopen("stdout.log", "w"), false);
}
class TestUnit
{
	public static $LogHandler = STDOUT; //Doesn't work until launch with -t parameter
	
	public static $CALLING = "Calling function \"%s\" with parameters:" . PHP_EOL . "%s";
	public static $CMP_RESULT = "Comparison result: " . PHP_EOL . "%s";
	public static $ARG_CMP_RESULT = "Argument comparison result: " . PHP_EOL . "%s";
	public static $FUNC_CMP_RESULT = "%s result comparison result: " . PHP_EOL . "%s";
	public static $FUNC_ARG_CMP_RESULT = "%s argument comparison result: " . PHP_EOL . "%s" . PHP_EOL . "Arguments before: %s" . PHP_EOL . "Arguments after: %s"; 
	
	public static $IS_NOT_CALLABLE = "%s is not callable!";
	public static $FUNCTION_DNE = "Function \"%s\" does not exists!";
	public static $ERROR_WHILE_EXECUTING = "Function \"%s\" raised Error" . PHP_EOL . "%s";
	public static $WRONG_RESULT = "Function \"%s\" returned wrong result!";
	public static $WRONG_PARAM = "Function \"%s\" variated wrong parameter!";
	public static $ARGUMENT_DNE = "Specified argument \"%s\" does not exists!";
	public static $COMPARING_RESULT = "Comparing function \"%s\" result";
	public static $COMPARING_ARG = "Comparing function \"%s\" argument #%s";
	
	/* not intended */
	public static $CONST_UNDEF = "Constant \"%s\" undefined!";
	public static $CONST_WRONG_VAL = "Constant \"%s\" has wrong value of %s";
	
	public static $FUNC_UNDEF = "Function \"%s\" undefined!";
	
	public static $CLASS_UNDEF = "Class \"%s\" undefined!";
	
	public static $ext_err = "UNABLE TO LOAD %s extension!";
	public static $rtl_err = "UNABLE TO LOAD %s runtime library!";
	
	/* intersected */
	public static $__WRONG_COUNT = "Wrong argument count for \"%s\" [required: %s; passed: %s]";
	public static $__WRONG_PASSED_TO = "Wrong parameter type passed to \"%s\"" . PHP_EOL . "[passed: %s]";
	/*?------------*/
	
	static $Error = false;
	static $NamePrePend = '';
	
	private static function Clear()
	{
		SELF::$Error = false;
	}
	
	public static function Dump($v)
	{
		ob_start();
		var_dump($v);
		return ob_get_clean();
	}
	public static function LibLoaded($l)
	{
		self:$Error = false;
		$name = BaseNameNoExt($l);
		if( strtolower( substr($name,0,4) ) == 'php_')
			$name = substr($name, 4);
			
		if( !extension_loaded($name) and !rtll($name) and !rtll($l) )
			SELF::DoErr( SELF::${"ext_err"}, 'php_' + $name);
		return !SELF::$Error;
	}
	
	public static function StructLoaded($s)
	{
		return interface_exists($s, false) or trait_exists($s, false) or class_exists($s, false);
	}
	
	public static function CheckGlobal($Name)
	{
		return isSet($GlOBALS[$Name]);
	}
	
	public static function CompareGlobal($Name, Check $Cmp)
	{
		return $Cmp->Execute($GLOBALS[$Name]);
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
	
	public static function CheckFuncs(array $funcs, CheckEvents $FuncE, $ref=false)
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
	
	public static function Log($data, ...$params)
	{
		if(!empty($params))
			$data = sprintf($data, ...$params);
		if( is_resource(SELF::$LogHandler) )
		{
			fwrite(SELF::$LogHandler, PHP_EOL . $data, strlen(PHP_EOL . $data));
			fflush(SELF::$LogHandler);
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
		SELF::Log( "Function " . SELF::$NamePrePend.$args[0] . ":{" . PHP_EOL . print_r($args[1],true) . PHP_EOL . "}:" . SELF::$NamePrePend.$args[0] );
		SELF::DoErr($estr, ...$args);
	}
	
	public static function Doerr($erstr, ...$args)
	{
		$args[0] = SELF::$NamePrePend . $args[0];
		foreach( $args as &$_content )
			$_content = print_r($_content,true);
		SELF::$Error = true;
		SELF::Log( "ERROR: " . sprintf($erstr, ...$args) );
	}
		
	public static function CallRet( $name, Check $check, &...$args)
	{
		$argcopy = $args;
		$r = SELF::Call($name, ...$args);
		if( SELF::$Error )
		{
			SELF::$Error = false;
			return FALSE;
		}
		
		$res = $check->Execute( $r );
		SELF::DoCmpRes($res, $check, $r, "Function ".$name);
		return $res;
	}
	
	public static function CallArg( $name, $ArgNum, Check $check, &...$args)
	{
		SELF::Call($name, ...$args);
		if( SELF::$Error )
		{
			SELF::$Error = false;
			return FALSE;
		}
		
		if( !isSet($args[$ArgNum]) )
		{
			SELF::DoErrf(SELF::${"ARGUMENT_DNE"}, $name, SELF::Dump($args), $ArgNum);
			SELF::$Error = false;
			return FALSE;
		} else {
			$res = $check->Execute( $args[$ArgNum] );
			SELF::DoCmpRes($res, $check, SELF::Dump($args), "Function ".$name, SELF::Dump($argcopy));
		}
		
		return $res;
	}
	
	public static function IsCallable(&$name)
	{
		if( is_callable($name) )
		{
			return True;
		} elseif( is_array($name) )
			if( is_callable([$name[1], $name[0]]) ) 
			{
				$name = array_flip($name);
				return True;
			}
		return FALSE;
	}
	
	public static function IsMethod($name)
	{
		if( is_array($name) )
			return method_exists($name[0], $name[1]);
		return FALSE;
	}
	
	public static function IsClassMethod($name)
	{
		if( Self::IsMethod($name) )
		{
			return is_string($name[0]);
		}
		return FALSE;
	}
	
	public static function Call( $name, &...$ars )
	{
		SELF::Clear();
		$ct = count($ars)-1;
		$chck = is_array($ars) && !empty($ars);
		if( $chck )
			$chck = is_object($ars[0]);
		if( $chck )
			$chck = is_subclass_of($ars[0], "Arg");
		if( $chck )
		{
			for($i=0;$i<=$ct;$i++)
			{
				if( !is_subclass_of($ars[$i], 'Check') )
				{
					$io = $i;
					break;
				}
				$args[] = $ars[$i];
			}
			$Arguments = $ArgumentsCopy = array_slice($ars, $io+1);
		} else {
			$io = 0;
			for($i=$ct;$i>=0;$i--)
			{
				if( !is_subclass_of($ars[$i], 'Check') )
				break;
				$argstart = $i;
			}
			if( isSet($argstart) )
			{
				$iv = 0;
				$Arguments = $ArgumentsCopy = array_slice($ars, 0, $ct - $argstart + 1);
				$args = array_slice($ars, $argstart);
			}
		}
		if(isSet($args)){
			foreach( $args as $i=>$arg )
			{
				if( !is_subclass_of($args[$i], "Arg") )
				{
					$Result = $arg;
					$iv = $i;
					unset($args[$i]);
				} else
				{
					if( $arg->Position < 0 )
						$arg->Position = $io + $i - $iv;
					if( !$arg->vls() ) //vls - Values Is Set
						$arg->SetValue($Arguments[$i-$iv]);
				}
			}
			$args = array_values($args);
		} else $Arguments = $ArgumentsCopy = $ars;
		
		if( !Self::IsCallable($name) )
			if( is_string($name) && substr($name, 0, 2) == "<?" )
			{
				$cargs = count($Arguments);
				for($i=1;$i<=$cargs;$i++)
					$arg_s[] = '$arg' . $i;
			
				if( StrToLower(SubStr($name, 0, 5) == "<?php") )
					$cout = 5;
				else 
					$cout = 2;
			
				$name = create_function(implode(", ", $arg_s), SubStr($name, $cout));
			} Else {
				SELF::DoErrf( SELF::${is_string($name)? "FUNCTION_DNE": "IS_NOT_CALLABLE"}, print_r($name, True), Self::Dump($ArgumentsCopy));
				return FALSE;
			}
		$ns = (self::IsClassMethod($name)? "Method ": "Function ") . print_r($name,true);
		SELF::Log(SELF::$CALLING, $ns, Self::Dump($Arguments));
		try
		{
			$r = call_user_func_array($name, $Arguments);
			if( $Arguments !== $ArgumentsCopy )
			{
				foreach( array_diff($Arguments, $ArgumentsCopy) as $i=>$v )
				$ars[$io + $i] = $v;
			}
		} catch( Exception $e )
		{
			SELF::DoErrf(SELF::${"ERROR_WHILE_EXECUTING"}, $ns, Self::Dump($ArgumentsCopy), Self::Dump($e));
			return FALSE;
		}
		$res = TRUE;
		if( is_subclass_of($Result, 'Check') )
		{
			$res = $Result->Execute( $r ) !== false;
			SELF::DoCmpRes($res, $Result, $r, $ns);
		}
		if( isSet($args) )
		{
			foreach($args as &$arg)
			{
				$r = $arg->Execute( $ars[$arg->Position] );
				$res = $res and $r!==false;
				SELF::DoCmpRes($r, $arg, SELF::Dump($ars), $ns, SELF::Dump($ArgumentsCopy));
			}
		}
		return $res;
	}
	public static function DoCmpRes($result, Check $check, $argsout,  $funcname=Null, $argsin=Null)
	{
		$s = Self::${( $funcname!==null? "FUNC_": "" ) . ( is_subclass_of($check, "Arg")? "ARG_": "" ) . "CMP_RESULT"} . PHP_EOL;
		$cmpres = $check->ToStr($result, (is_subclass_of($check, "Arg")? $argsout[$check->Position]: $argsout));
		if($funcname !== null )
		{
			if( $argsin !== null )
			{
				Self::Log($s, $funcname, $argsin, $argsout, $cmpres); 
			} else Self:: Log($s, $funcname, $cmpres);
		} else Self::Log($s, $cmpres);
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
	#public $OnError;
	#public $OnFail;
	#public $OnProgress;
	#public $OnPass;
	#public $OnSucces;
	//=> Событий хватает. Параметры - подходят?
	public function AddConstant( $Constant );
	public function AddFunction( $Function );
	public function GetStat(); //=> Формат статистики:?
	public function GetScope(); //=> Сводка.
	public function GetResult(); //=> Bool
	public function WriteLog(); //=> Вывод в консоль.
}
class Stats
{
	public $FunctionsTotal = 0;
	public $FunctionsFaulted = 0;
	public $FunctionsPassed =0;
	
	public $ConstantsTotal = 0;
	public $ConstantsFaulted = 0;
	public $ConstantsPassed = 0;
	
	public $LibrariesTotal  = 0;
	public $DLLibraries = 0;
	public $BPLibraries = 0;
	public $LibrariesFaulted = 0;
	public $LibrariesPassed = 0;
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
		$this->Stats = new Stats;
	}
	
	public function GetStat(){ return clone $this->Stats; }
	public function GetScope()
	{
		$output = str_repeat("#", strlen($this->UnitName) + 10);
		$output .= PHP_EOL . "#####{$this->UnitName}#####" .  PHP_EOL;
		$output = str_repeat("#", strlen($this->UnitName) + 10) . PHP_EOL;
		$output .= "#Auto-Globals:\t{$this->Stats->GlobalsPassed} of {$this->Stats->GlobalsTotal}"  . PHP_EOL;
		$output .= "#Constants:\t{$this->Stats->ConstantsPassed} of {$this->Stats->ConstantsTotal}" . PHP_EOL;
		$output .= "#Classes:\t{$this->Stats->ClassesPassed} of {$this->StatsClassesTotal}"			. PHP_EOL;
		foreach( $this->Stats->Classes as $Class )
		{
			$output .= "~~~{$Class->Name}~~~" . PHP_EOL;
			$output .= "   ~Variables:\t{$Class->VariablesTotal} of {$Class->VariablesPassed}"		. PHP_EOL;
			$output .= "   ~Methods:\t{$Class->MethodsPassed} of {$Class->MethodsTotal}" 			. PHP_EOL;
			$output .= "   ~Constants:\t{$Class->ConstantsTotal} of {$Class->ConstantsPassed}"		. PHP_EOL;
			$output .= "   ~Functions\t{$Class->FunctionsTotal} of {$Class->FunctionsPassed}"		. PHP_EOL;
			$output .= "   ~Properties:\t{$Class->PropertiesPassed} of {$Class->PropertiesTotal}"	. PHP_EOL;
			$output .= PHP_EOL;
		}
		$output .= "#Functions:\t{$this->Stats->FunctionsPassed} of {$this->Stats->FunctionsTotal}" . PHP_EOL;
		
		return $output;
	}
	public function WriteLog()
	{
		TestUnit::Log( $this->GetScope() );
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
	protected function _imprtf(&$From)
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
	protected function _imprtc(&$From)
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
	protected function _imprtn(&$From)
	{
		if( IsSet($From) )
		{
			if( is_array($From) )
			{
				$this->_imprtn($From[0]);
			} else 
				$this->UnitName = $From;
		}
	}

	protected function _imprte(&$From)
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
	
	public function Inc( $filename )
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
	
	public function RunAll($ext="php")
	{
		global $unit;
		foreach( findfiles( __DIR__ . "/cli", [$ext], false, true) as $s )
		{
			if( !is_object($unit) )
				$unit = new Unit;
			
			UnitName( substr(BaseName($s), 0, strlen(BaseName($s)) - strlen($ext) - 1) );
			include_once( $s );
		}
		$unit->name = '';
		$unit->type = type::UNDEF;
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
		"typeof"=>14,
		"sub"=>15,
		"range"=>16,
		"instance"=>17,
		"instanceof"=>17,
		"objectof"=>17,
		"class"=>17,
		"classof"=>17,
		"oneof"=>18,
		"r"=>18,
		"checkarr"=>18,
		"check"=>18,
		"cmp"=>18,
		"!"=>19,
		"!!"=>20,
		//dyn
		"<=>"=>22,
		"!<=>"=>23,
	];
	protected static $strings =
	[
			-1=>"correct",
			0=>"equal to %",
			1=>"the same as %",
			2=>"greater than %",
			3=>"greater than or same as %",
			4=>"lesser than %",
			5=>"lesser than or same as %",
			6=>"greater or lesser than %",
			7=>"%!not equal to %",
			8=>"partially equal to %",
			9=>"does %not contains %",
			10=>"present in %",
			11=>"set",
			12=>"%not set %{or,and} %not defined",
			13=>"%",
			14=>"the same type as % type",
			15=>"subclass of %",
			16=>"in range of %",
			17=>"instance of %",
			18=>"successfull result of multi-comparison check",
			19=>"not set or not defined",
			20=>"not set",
			"the first compare result, equal to %res",
			"the first negative compare result, equal to %res",
	];
	protected $CallFunc;
	public function ToStr($res, $v)
	{
		$false = $res==false? "not": "";
		$true = $res==false? "": "not";
		$s = ( stripos(Self::$strings[$this->type], "%not")==false? "%1 is $false ": "%1 is" ) . Self::$strings[$this->type];
		if( strpos($s, "%{") !== false )
			{
				$ss = substr($s, strpos($s, "%{")+2);
				$ss = substr($ss, 0, strpos($ss, "}"));
				$s = str_replace("%{" . $ss . "}", explode(",",$ss)[(int)$res!==false], $s);
			}
		return str_ireplace(["%not", "%res", "%!not", "%1", "%"],[$false,$res,$true,print_r($v,true),print_r($this->value,true)],
			$s);
	}
	public static final function GetComparators()
	{ return array_keys(SELF::$types); }
	
	public static final function GetComparisonFunctions()
	{ return SELF::GetComparators(); }
	
	public static final function GetCMPFuncs()
	{ return SELF::GetComparators(); }
	
	public function GetCMPType( $Exp )
	{
		return isSet( STATIC::$types[$Exp] )? STATIC::$types[$Exp]: -1;
	}
	
	public function __construct($type = "==", $value = True)
	{
		if( is_object($type) && is_callable($type) )
		{
			$this->CallFunc = $type;
			$this->type = -1;
		} else {
			$this->type = is_integer($type)? $type: ( isSet( STATIC::$types[$type] )? STATIC::$types[$type]: 0 );
			$this->value = $value;
		}
	}
	
	public function Execute( &$in )
	{
		if( $this->type == -1 )
		{
			return isSet($this->CallFunc)? call_user_func($this->CallFunc, $in): FALSE;
		}
		
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
					$inv = substr($in, 0, strlen($this->value)-1);
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
			$cr = is_object($this->value)? get_class($this->value): $this->value;
			$cl = is_object($in)? get_class($in): $in;
			return in_array($cl, class_implements($cr)) or in_array($cr, class_parents($cl));
		}
		
		if( $this->type == 16 )
			return $in > $this->value[0] && $in < $this->value[1];
		
		if( $this->type == 17 )
			return $in instanceof $this->value;
		
		if( $this->type == 18 )
		{
			if( is_array( $this->value ) )
				foreach($this->value as &$cmp)
					if( $cmp instanceof SELF )
						if( $cmp->Execute( $in ) ) return TRUE;
			return FALSE;
		}
		
		if( $this->type == 19 )
		{
			if(!isSet($in))
				return TRUE;
			return is_null($in) or is_nan($in);
		}
		
		if( $this->type == 20 )
			return !isSet($in);
		
		if( $this->type == count(SELF::$types)-2 )
		{
			$res = -1;
			for($type=18;$type>=0;$type--)
			{
				$this->type = $type;
				if(  $this->Execute( $in ) )
				{
					$res = $type;
					break;
				}
			}
			return $res;
		}
		if( $this->type == count(SELF::$types)-1 )
		{
			$res = -1;
			for($type=18;$type>=0;$type--)
			{
				$this->type = $type;
				if( !$this->Execute( $in ) )
				{
					$res = $type;
					break;
				}
			}
			return $res;
		}
	}
}
class Result extends Check {}
class Arg extends Check
{
	public $Position;
	protected $valueset = false;
	
	public function __construct($type = "==", $position=-1)
	{
		if( is_object($type) && is_callable($type) )
		{
			$this->CallFunc = $type;
			$this->type = -1;
		} else {
			$this->type = is_integer($type)? $type: ( isSet( STATIC::$types[$type] )? STATIC::$types[$type]: 0 );
		}
		$this->position = $position;
		$this->valueset = false;
	}
	
	public function SetValue($v)
	{
		$this->value = $v;
		$this->valueset = true;
	}
	
	public function vls()
	{
		return $this->valueset;
	}
}
class MultiCheck extends Check
{
	protected $data;
	public function __construct(Check ...$checks)
	{
		$this->data = $checks;
	}
	
	public function Execute( &$in )
	{
		foreach( $this->data as $check )
		{
			if( $check->Execute( $in ) )
				Return TRUE;
		}
		Return FALSE;
		
	}
}
class MultiResult extends Result
{
	protected $data;
	public function __construct(Check ...$checks)
	{
		$this->data = $checks;
	}
	
	public function Execute( &$in )
	{
		foreach( $this->data as $check )
		{
			if( $check->Execute( $in ) )
				Return TRUE;
		}
		Return FALSE;
		
	}
}
class MultiArg extends Arg
{
	protected $data;
	public function __construct(Check ...$checks)
	{
		$this->data = $checks;
		$this->Position = count($checks) > 0? $checks[0]->Position: -1;
	}
	
	public function Execute( &$in )
	{
		foreach( $this->data as $check )
		{
			if( $check->Execute( $in ) )
				Return TRUE;
		}
		Return FALSE;
		
	}
}
class_alias("Check", "CMP");
class_alias("Check", "Compare");
class_alias("Check", "CMPFunc");

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
require_once "-t.functions.php";