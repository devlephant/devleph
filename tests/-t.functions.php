<?php
require_once "-t.comparators.php";

global $unit, $UNIT, $Unit;
class type
{
	const UNDEF = -1;
	const UNIT = 0;
	const STRUCT = 1;
	const EXT = 2;
	const Constant = 0;
	const Variable = 1;
	const Method = 2;
}
class Unit
{
	
	public $UnitEvents;
	public $TypedEvents;
	public $NotifyEvents;
	
	public $name;
	public $type;
	
	protected $instance;
	public function __construct()
	{
		$this->UnitEvents = new UnitEvents;
		$this->TypedEvents = new TypedEvents;
		$this->NotifyEvents = new NotifyEvents;
	}
	
	public function GetClassFunc($name)
	{
		if( is_array($name) )
			return $name;
		
		if( strpos($name, "::") !== false )
			return explode("::", $name);
		
		if( isSet($this->instance) && method_exists($this->instance, $name) )
		{
			return [$this->instance, $name];
		}
		
		if( $this->type !== type::STRUCT)
			return $name;
		
		if( method_exists($this->name, $name) )
			return [$this->name, $name];
	}
	
	public function SetInstance($instance)
	{
		if(is_object($instance))
			$this->instance = $instance;
	}
}
$unit = new Unit;
$UNIT =& $GLOBALS["unit"];
$Unit =& $GLOBALS["unit"];
class OFunction
{
	public $name;
	public $class = Null;
	public $instance = Null;
	public function __construct($name)
	{ 
		if( is_array($name) )
		{
			$this->name	 = $name[1];
			$this->class = is_object($name[0])? get_class($name[0]): $name[0];
			if( is_object($name[0]) )
				$this->instance = $name[0];
		} else
			$this->name	= $name;
	}
	
	public function GetFullName()
	{
		if( $this->instance !== Null )
			return [$this->instance, $this->name];
		
		if( $this->class !== Null )
			return [$this->class, $this->name];
		
		return $this->name;
	}
	
	public function Call(&...$argument)
	{
		if( !$this->Check() ) 
			return -1;
		
		return TestUnit::Call($this->GetFullName(), ...$argument);
	}
	
	public function CallStaticArg(...$argument)
	{
		if( !$this->Check() ) 
			return -1;
		
		return TestUnit::Call($this->GetFullName(), ...$argument);
	}
	
	public function Check()
	{
		return is_callable($this->GetFullName());
	}
}

class OConstant
{
	public $name;
	public $class = Null;
	public $instance = Null;
	public function __construct($name, $class=false)
	{
		if( is_string)
			if( strpos($name, "::") !== false)
				$name = explode("::", $name);
		if( is_array($name) )
		{
			$this->name = $name[1];
			$this->class = is_object($name[0])? get_class($name[0]): $name[0];
			if( is_object($name[0]) )
				$this->instance = $name[0];
		}
	}
	public function GetFullName()
	{
		if( $this->class !== Null )
			return "{$this->class}::{$this->name}";
		
		if( $this->instance !== Null )
		{
			$this->class = get_class($this->instance);
			return "{$this->class}::{$this->name}";
		}
		return $this->name;
	}
	
	public function Check()
	{
		return defined($this->GetFullName());
	}
	
	public function GetValue()
	{
		if( $this->Check() )
			return constant($this->GetFullName());
		return NULL;
	}
	
	public function SetValue($value)
	{
		define($this->name, $value);
	}
	
	public function Compare( ...$argument ) //Can return: int є > 0, -1, bool
	{
		$r = $this->GetValue();
		if( $this->err == true )
			RETURN -1;
		
		$ct = count($argument);
		if( $ct == 1 )
		{
			if( is_callable($argument[0]) )
				return $argument[0]( $r );
			
			if( is_object($argument[0]) && is_subclass_of($argument[0], "Check") )
				return $argument[0]->Execute( $r );
			
			return (new Check("==", $argument[0]))->Execute($r);
		} elseif( $ct == 2 )
		{
			return (new Check($argument[0], $argument[1]))->Execute($r);
		}
		
		return $r == TRUE;
	}
}
class OVariable
{
	public $name;
	public $class = Null;
	public function __construct($name)
	{
		if( strpos($name, "::") !== false )
			$name = explode("::", $name);
		if( is_array($name) )
		{
			$this->class = $name[0];
			$this->name = $name[1];
		} else $this->name = $name;
	}
	
	public function Check()
	{
		if( $this->class!==Null )
		{
			$c = $this->class;
			return isSet($c::${$this->name});
		} return isSet($GLOBALS[$this->name]);
	}
	
	public function GetValue()
	{
		if(!$this->Check())
			return NULL;
		if( $this->class !== Null)
		{
			$c = $this->class;
			return $c::${$this->name};
		} return $GLOBALS[$this->name];
	}
	
	public function SetValue($value)
	{
		if( $this->class !== Null)
		{
			$c = $this->class;
			$c::${$this->name} = $value;
		} $GLOBALS[$this->name] = $value;
	}
	
	public function Compare(...$argument)
	{
		if( $this->class !== Null)
		{
			$c = $this->class;
			$pointer =& $c::${$this->name};
		} $pointer =& $GLOBALS[$this->name];
		$ct = count($argument);
		if( $ct == 1 )
		{
			if( is_callable($argument[0]) )
				return $argument[0]( $pointer );
			
			if( is_object($argument[0]) && is_subclass_of($argument[0], "Check") )
				return $argument[0]->Execute( $pointer );
			
			return (new Check("==", $argument[0]))->Execute( $pointer );
		} elseif( $ct == 2 )
		{
			return (new Check($argument[0], $argument[1]))->Execute( $pointer );
		}
		
		return $pointer == TRUE;
	}
}
class OProperty
{
	public $name;
	public $class;
	public $instance = Null;
	
	public function __construct($name)
	{
		if( is_string($name) )
			if( stripos($name, "::") !== false )
			{
				$name = explode("::", $name);
			} else $name = [$name, $name];
		$this->name = $name[1];
		if( is_object($name[0]) )
		{
			$this->instance = $name[0];
			$this->class = get_class($name[0]);
		} else $this->class = $name[0];
	}
	
	public function Check()
	{
		if( $this->instance !== Null )
			return property_exists( $this->instance, $this->name );
		
		if( property_exists($this->class, $this->name) )
			return True;
		$c = $this->class;
		return isSet( $c::${ $this->name } );
	}
	
	public function Is_Set()
	{
		if( $this->Instance !== Null )
		{
			return isSet( $this->Instance->{ $this->name } );
		}
		$c = $this->class;
		
		return isSet( $c::${ $this->name } );
	}
	
	public function GetValue()
	{
		if( !$this->Check() )
			return NULL;
		
		if( $this->Instance != Null )
		{
			$pointer =& $this->Instance->{$this->name};
		} else {
			$c = $this->class;
			$pointer =& $c::${$this->name};
		}
		if( !isSet($pointer) )
			return NULL;
		
		return $pointer;
	}
	
	public function SetValue($value)
	{
		if( $this->Instance != Null )
		{
			$this->Instance->{$this->name} = $value;
		} else {
			$c = $this->class;
			$c::${$this->name} = $value;
		}
	}
	
	public function Compare(...$argument)
	{
		if( !$this->Check() )
			return -1;
		if( $this->Instance != Null )
		{
			$pointer =& $this->Instance->{$this->name};
		} else 
		{
			$c = $this->class;
			$pointer =& $c::${$this->name};
		}
		$ct = count($argument);
		
		if( $ct == 1 )
		{
			if( is_callable($argument[0]) )
				return $argument[0]($pointer);
			
			if( is_object($argument[0]) && is_subclass_of($argument[0], "Check") )
				return $argument[0]->Execute( $pointer );
			
			return ( new Check("==", $argument[0]))->Execute( $pointer );
		}
		
		if( $ct == 2)
		{
			return (new Check($argument[0],  $argument[1]))->Execute( $pointer );
		}
		
		return $pointer == TRUE;
	}
}
class OClass
{
	public $name;
	public $instance = Null;
	
	#public functions
	#public properties
	
	#public methods
	#public variables
	#public constants
	
	#public interfaces
	#public traits 
	#public abstract
	#public extension
	#public namespace
	#public anonymous
	#public iterable
	#public instantiable == object
	#public cloneable
	
	public function __construct($name)
	{
	}
	
	public function IsSubclass( $class )
	{
		if( $class instanceof SELF )
		{
			return (new ReflectionClass($this->___get()))->IsSubclassOf( $class->instance !== Null? $class->instance: $class->name );
		} elseif( $class instanceof OTrait ) {
			return $this->ImplementsTrait($class->name);
		} elseif( $class instanceof OInterface ) {
			return $this->ImplementsInterface($class->name);
		}
		
		return is_subclass_of($this->name, $class);
	}
	
	public function Check()
	{
		return class_exists( $this->name, FALSE );
	}
	
	public function ImplementsInterface( $interface )
	{
		if( !$this->Check() )
			return -1;
		
		if( is_object($interface))
			if( property_exists($interface, "name") )
			{
				$interface = $interface->name;
			} elseif( method_exists($interface, "__toString") )
			{
				$interface = (string)$interface;
			} else {
				return NULL;
			}
		
		return (new ReflectionClass($this->___get()))->ImplementsInterface($interface);
	}
	
	public function ImplementsTrait( $trait )
	{
		if( !$this->Check() )
			return -1;
		
		if( is_object($trait) )
			if( property_exists($trait, "name") )
			{
				$trait = $trait->name;
			} elseif( method_exists($trait, "__toString") ) {
				$trait = (string)$trait;
			} else {
				return NULL;
			}
			
		foreach( (new ReflectionClass($this->___get()))->GetTraitNames() as $_trait )
			if( strtolower($_trait) == strtolower($trait) )
				return TRUE;
		
		return FALSE;
	}
	
	public function IsImplements( $something )
	{
		return $this->ImplementsInterface($something) or $this->ImplementsTrait($something) or $this->IsSubclass($something);
	}
	
	private function ___get()
	{
		if( $this->instance !== Null )
			return $this->instance;
		
		return $this->name;
	}
	
	public function GetInstance()
	{
		if( $this->instance !== Null )
			return $this->instance;
		
		return (new ReflectionClass($this->__get()))->NewInstanceWithoutConstructor();
	}
	
	
	public function __get($name)
	{
		if( !$this->Check() )
			return NULL;
		
		if( $name == "Functions" )
		{
			$res = [];
			foreach( array_diff(get_class_methods($this->___get(), $this->__get("Methods"))) as $m )
				$res[] = new OFunction([$this->___get(), $m]);
			return $res;
		} elseif( $name == "Variables" ) 
		{
			$c = $this->name;
			$res = [];
			foreach( get_class_vars($this->___get()) as $pname )
			{
				if( isSet( $c::$$pname ) )
					$res[] = new OVariable([$this->___get(), $pname]);
			}
			return $res;
		} elseif( $name == "Properties" )
		{
			$c = $this->name;
			$res = [];
			foreach( get_class_vars($this->___get()) as $pname )
			{
				if( !isSet( $c::$$pname ) )
					$res[] = new OProperty([$this->___get(), $pname]);
			}
			return $res;
		} elseif( $name == "Constants" ) {
			$res = [];
			foreach( array_keys((new ReflectionClass($this->___get()))->GetConstants()) as $constant)
				$res[] = new OConstant([$this->___get(), $constant]);
			return $res;
		} elseif( $name == "Methods" ) {
			$res = [];
			foreach( (new ReflectionClass($this->___get()))->GetMethods( ReflectionMethod::IS_PUBLIC | ReflectionMethod::IS_STATIC ) as $m )
			{
				$res[] = new OFunction([$this->___get(), $m]);
			}
			return $res;
		} elseif( $name == "Interfaces" ) {
			$res = [];
			foreach( (new ReflectionClass($this->___get()))->GetInterfaceNames() as $interface )
				$res[] = new OInterface($interface);
			return $res;
		} elseif( $name == "Traits" ) {
			$res = [];
			foreach( (new ReflectionClass($this->___get()))->GetTraitNames() as $trait )
				$res[] = new OTrait($trait);
			return $res;
		} elseif( $name == "Abstract" )
		{
			return (new ReflectionClass($this->___get()))->IsAbstract();
		} elseif( $name == "Extension" )
		{
			return (new ReflectionClass($this->___get()))->getExtensionName();
		} elseif( $name == "Namespace" )
		{
			return (new ReflectionClass($this->___get()))->GetNamespaceName();
		} elseif( $name == "Anonymous" or $name == "Dynamic" )
		{
			return (new ReflectionClass($this->___get()))->IsAnonymous();
		} elseif( $name == "Iterable" )
		{
			return (new ReflectionClass($this->___get()))->IsIterable();
		} elseif( $name == "Instantiable" or $name == "Object" )
		{
			return (new ReflectionClass($this->___get()))->IsInstantiable();
		} elseif( $name == "Cloneable" )
		{
			return (new ReflectionClass($this->___get()))->IsCloneable();
		} elseif( $name == "Implementations" )
		{
			$ref = (new ReflectionClass($this->___get()));
			$traits = $ref->GetTraitNames();
			$traits = array_combine($traits, array_fill(0, count($traits), 0));
			$interfaces = $ref->GetInterfaceNames();
			$interfaces = array_combine($interfaces, array_fill(0, count($interfaces), 1));
			$implementations = array_merge( $traits, $interfaces );
			unset($ref, $traits, $interfaces);
			asort($implementations);
			$res = [];
			foreach(  $implementations as $it=>$t )
			{
				$type = $t==1? "OInterface": "OTrait";
					$res[] = new $type($it);
			}
			return $res;
		}
	}
	
	public function __isset($name)
	{
		if( !$this->Check() )
			return -1;
		
		return in_array($name, ["Functions", "Properties", "Methods", "Variables", "Constants", "Interfaces", "Traits", "Implementations",
								"Extension", "Namespace", "Anonymous", "Abstract", "Iterable", "Cloneable", "Instantiable", "Object", "Dynamic"]);
	}
	
	public function __set($name, $value)
	{
	}
}
class OInterface 
{
	public $name;
	public function __construct( $name )
	{
		$this->name = $name;
	}
	
	public function Check()
	{
		return interface_exists($this->name);
	}
	
	public function IsImplements( $interface )
	{
		if( !$this->Check() )
			return -1;
		
		if( is_object($interface))
			if( property_exists($interface, "name") )
			{
				$interface = $interface->name;
			} elseif( method_exists($interface, "__toString") )
			{
				$interface = (string)$interface;
			} else {
				return NULL;
			}
		
		return (new ReflectionClass($this->name))->ImplementsInterface($interface);
	}
	
	public function __get($name)
	{
		if( !$this->Check() )
			return NULL;
		
		if( $name == "Constants" ) {
			$res = [];
			foreach( array_keys((new ReflectionClass($this->name))->GetConstants()) as $constant)
				$res[] = new OConstant([$this->name, $constant]);
			return $res;
		} elseif( $name == "Functions" ) {
			$ref = new ReflectionClass($this->name);
			return array_diff($ref->GetMethods(), $ref->GetMethods( ReflectionMethod::IS_PUBLIC | ReflectionMethod::IS_STATIC ));
		} elseif( $name == "Methods" ) {
			return (new ReflectionClass($this->name))->GetMethods( ReflectionMethod::IS_PUBLIC | ReflectionMethod::IS_STATIC );
		} elseif( $name == "Interfaces" or $name == "Implementations" ) {
			$res = [];
			foreach( (new ReflectionClass($this->name))->GetInterfaceNames() as $interface )
				$res[] = new SELF($interface);
			return $res;
		}
	}
	
	public function __isset($name)
	{
		if( !$this->Check() )
			return -1;
		return in_array($name, ["Constants", "Functions", "Methods", "Interfaces", "Implements"]);
	}
	
	public function __set($name, $value)
	{
	}
}
class OTrait
{
		public $name;
	public function __construct( $name )
	{
		$this->name = $name;
	}
	
	public function Check()
	{
		return interface_exists($this->name);
	}
	
	public function ImplementsInterface( $interface )
	{
		if( !$this->Check() )
			return -1;
		
		if( is_object($interface))
			if( property_exists($interface, "name") )
			{
				$interface = $interface->name;
			} elseif( method_exists($interface, "__toString") )
			{
				$interface = (string)$interface;
			} else {
				return NULL;
			}
		
		return (new ReflectionClass($this->name))->ImplementsInterface($interface);
	}
	
	public function ImplementsTrait( $trait )
	{
		if( !$this->Check() )
			return -1;
		
		if( is_object($trait) )
			if( property_exists($trait, "name") )
			{
				$trait = $trait->name;
			} elseif( method_exists($trait, "__toString") ) {
				$trait = (string)$trait;
			} else {
				return NULL;
			}
			
		foreach( (new ReflectionClass($this->name))->GetTraitNames() as $_trait )
			if( strtolower($_trait) == strtolower($trait) )
				return TRUE;
		
		return FALSE;
	}
	
	public function IsImplements( $something )
	{
		return $this->ImplementsInterface($something) or $this->ImplementsTrait($something);
	}
	
	public function __get($name)
	{
		if( !$this->Check() )
			return NULL;
		
		if( $name == "Constants" ) {
			$res = [];
			foreach( array_keys((new ReflectionClass($this->name))->GetConstants()) as $constant)
				$res[] = new OConstant([$this->name, $constant]);
			return $res;
		} elseif( $name == "Functions" ) {
			$ref = new ReflectionClass($this->name);
			return array_diff($ref->GetMethods(), $ref->GetMethods( ReflectionMethod::IS_PUBLIC | ReflectionMethod::IS_STATIC ));
		} elseif( $name == "Methods" ) {
			return (new ReflectionClass($this->name))->GetMethods( ReflectionMethod::IS_PUBLIC | ReflectionMethod::IS_STATIC );
		} elseif( $name == "Interfaces" ) {
			$res = [];
			foreach( (new ReflectionClass($this->name))->GetInterfaceNames() as $interface )
				$res[] = new OInterface($interface);
			return $res;
		} elseif( $name == "Traits" ) {
			$res = [];
			foreach( (new ReflectionClass($this->name))->GetTraitNames() as $trait )
				$res[] = new SELF($trait);
			return $res;
		} elseif( $name == "Implementations" )
		{
			$ref = (new ReflectionClass($this->name));
			$traits = $ref->GetTraitNames();
			$traits = array_combine($traits, array_fill(0, count($traits), 0));
			$interfaces = $ref->GetInterfaceNames();
			$interfaces = array_combine($interfaces, array_fill(0, count($interfaces), 1));
			$implementations = array_merge( $traits, $interfaces );
			unset($ref, $traits, $interfaces);
			asort($implementations);
			$res = [];
			foreach(  $implementations as $it=>$t )
			{
				$type = $t==1? "OInterface": "OTrait";
					$res[] = new $type($it);
			}
			return $res;
		}
	}
	public function __isset($name)
	{
		if( !$this->Check() )
			return -1;
		return in_array($name, ["Constants", "Functions", "Methods", "Traits", "Interfaces", "Implements"]);
	}
	
	public function __set($name, $value)
	{
	}
}
class OLibrary
{
	public $name;
	public $ext;
	
	public function __construct($name)
	{
		if( strpos($name, ".") !== false )
		{
			$name = explode(".", $name);
		}
		if( is_array($name) )
		{
			$this->ext = array_pop($name);
			$this->name = $name;
		} else $this->name = $name;
		if( $this->ext == "" || $this->ext == Null )
			$this->ext = (substr($this->name,0,4) == "php_")? ( stripos(php_uname(), "win")!==false? "dll": "so") : "bpl";
	}
	
	public function Check()
	{
		$name = $this->name;
		if( strtolower( substr($name,0,4) ) == 'php_')
			$name = substr($name, 4);
			
		return extension_loaded($name) or rtll($name) or rtll($this->name);
	}
	
	public function Loaded()
	{
		return $this->Check();
	}
	
	public function Available()
	{
		return file_exists("{$this->name}.{$this->ext}") or file_exists(ini_get("extension_dir") . "/{$this->name}.{$this->ext}");
	}
	
	protected function ___get()
	{
		return new ReflectionExtension(
										startswith($this->name, "php_", true)?
										substr($this->name, 4): $this->name
									   );
	}
	
	public function __get($name)
	{
		if( startswith($name, "Is") )
			$name = substr($name, 2);
		
		if($name == "Loaded" )
		{
			return $this->Loaded();
		} elseif($name == "Available" ) {
			return $this->Available();
		} elseif($name == "Path" )
		{
			$f = "{$this->name}.{$this->ext}";
			if( file_exists(ini_get("extension_dir") . "/$f") )
				return realpath(ini_get("extension_dir") . "/$f");
			if( file_exists(ini_get("include_dir") . "/$f" ) )
				return realpath(ini_get("include_dir") . "/$f");
			return FALSE;
		}
		if(!extension_loaded($this->___get())) 
			return false;
		
		if($name == "PHP")
		{
			return TRUE;
		} elseif( $name == "Constants"){
			$res = [];
			foreach( array_keys($this->___get()->getConstants) as $constant)
				$res[] = new OConstant($constant);
			return $res;
		} elseif( $name == "Functions" ) {
			$res = [];
			foreach( array_keys($this->___get()->getFunctions) as $function )
				$res[] = new OFunction($function);
			return $res;
		} elseif( $name == "Classes" ) {
			$res = [];
			foreach( $this->___get()->GetClassNames as $class )
				$res[] = new OClass($class);
			return $res;
		} elseif( $name == "Dependencies" or $name == "Libraries" or $name == "Requires" )
		{
			$res = [];
			foreach( $this->___get()->GetDependencies() as $library=>$dt )
			{
				if($dt == "Required")
					$res[] = new SELF($library);
			}
			return $res;
		} elseif( StrToLower($name) == "ini" ) {
			$res = [];
			foreach( $this->___get()->GetINIEntries() as $key=>$dv )
				$res[] = new OIniEntry([$this->name, $key]);
			return $res;
		} elseif( $name == "Persistent" or $name == "Linked" or $name == "Embedded" )
		{
			return $this->__get()->IsPersistent();
		} elseif( $name == "Temporary" or $name == "External" or $name == "Static")
		{
			return $this->__get()->IsTemporary();
		}
	}
	
	public function __set($name, $value)
	{
	}
	
	public function __isset($name)
	{
		return in_array($name, ["php", "ini", "loaded", "available", "constants", "functions", "classes",
								"dependencies", "libraries", "requires",
								"persistent", "linked", "embedded", "temporary", "external", "static", "path"]);
	}
}
class OIniEntry
{
	public $name;
	public $src;
	public function __construct($name)
	{
		if( is_string($name) )
		if( strpos($name, ".") !== false )
			$name = explode(".", $name);
		
		if( is_array($name) )
		{
			$this->src = is_object($name[0])? $name[0]->name: $name[0];
			$this->name = $name[1];
		}
	}
	public function Check()
	{
		if( is_file($this->src) )
		{
			$r = parse_ini_file($this->src);
		} elseif( is_string($this->src) && trim($this->src) != "" )
		{
			$r = ( new ReflectionExtension($this->src) )->GetINIEntries;
		} elseif( is_array($this->src) ) {
			$r = $this->src;
		} else {
			return ini_get($this->name) !== false;
		}
		return isSet( $r[$this->name] );
	}
	public function GetValue()
	{
		if( !$this->Check() )
			return NULL;
		if( is_file($this->src) )
		{
			$r = parse_ini_file($this->src);
		} elseif( is_string($this->src) && trim($this->src) != "" )
		{
			$r = ( new ReflectionExtension($this->src) )->GetINIEntries;
		} elseif( is_array($this->src) )
		{
			$r = $this->src;
		} else {
			$res = ini_get($this->name);
			if( $res == "" )
				return false;
			if( $res == "1" )
				return 1;
			return $res;
		}
		return $r[$this->name];
	}
	public function SetValue($value)
	{
		if( is_string($this->src) && trim($this->src) != "" )
		{
			ini_set("{$this->src}.{$this->name}", (string)$value);
		} elseif( is_array($this->src) )
		{
			$this->src[$this->name] = $value;
		} else {
			ini_set($this->name, (string)$value);
		}
	}
	public function Compare(...$argument)
	{
		if( is_file($this->src) )
		{
			$r = parse_ini_file($this->src);
			$pointer =& $r[$this->name];
		} elseif( is_string($this->src) && trim($this->src) != "" )
		{
			$r = ( new ReflectionExtension($this->src) )->GetINIEntries();
			$pointer =& $r[$this->name];
		} elseif( is_array($this->src) ) {
			$pointer =& $this->src[$this->name];
		} else {
			$res = ini_get($this->name);
			if( $res == "" )
				$res = false;
			if( $res == "1" )
				$res = 1;
			$pointer =& $res;
			if( ini_get($this->name) == false )
				unset($res);
		}
		
		
		$ct = count($argument);
		
		if( $ct == 1 )
		{
			if( is_callable($argument[0]) )
				return $argument[0]($pointer);
			
			if( is_object($argument[0]) && is_subclass_of($argument[0], "Check") )
				return $argument[0]->Execute( $pointer );
			
			return ( new Check("==", $argument[0]))->Execute( $pointer );
		}
		
		if( $ct == 2)
		{
			return (new Check($argument[0],  $argument[1]))->Execute( $pointer );
		}
		
		return $pointer == TRUE;
	}
}
/*-- Type-Helper Routines --*/
function of($name)
{
	global $unit;
	if( $unit->type == type::STRUCT )
		if( class_exists($unit->name, FALSE) && !is_array($name) )
			$name = $unit->GetClassFunc($name);
	return new OFunction($name);
}
function ov($name)
{
	return new OVariable($name);
}
function oc($name)
{
	if( class_exists($name) or is_object($name) )
		return new OClass($name);
	
	return new OConstant($name);
}
function ocl($name)
{
	return new OClass($name);
}
function oi($name)
{
	return new OInterface($name);
}
function ot($name)
{
	return new OTrait($name);
}
function ol($name)
{
	return new OLibrary($name);
}
function op($name)
{
	if( is_string($name) )
	{
		if( stripos($name, "::")!==false )
			return new OVariable(explode("::", $name));
	
	} elseif ( is_array($name) )
		return new OProperty($name);
}
function o($name)
{
	$type = Null;
	if( is_string($name) )
	{
		$name = str_replace([" ", "\t", "\r", "\n", "\0"], "", $name);
		if( endswith($name, ".so") || endswith($name, ".dll") || endswith($name, ".bpl") )
		{
			$type = "Library";
		} elseif( endswith($name, "()") )
		{
			$type = "Function";
			$name = substr($name, 0, strlen($name)-2);
			if( strpos("::", $name) !== false )
				$name = explode("::", $name);
		} elseif( strpos($name, "::") !== false ) {
			$name = explode("::", $name);
		} else {
			if( startswith($name, '$') or startswith('var ') )
			{
				$type = "Variable";
					$name = substr($name, startswith($name, '$')? 1:4);
			} elseif( class_exists($name, FALSE) ) {
				$type = "Class";
			} elseif( interface_exists($name, FALSE) ) {
				$type = "Interface";
			} elseif( trait_exists($name, FALSE) ) {
				$type = "Trait";
			} else
				$type = "Constant";
		}
	}
	if( $type == Null )
	{
	    if( is_string($name) )
		{
			if( startswith($name[1], '$') or startswith($name[1], 'var ') )
			{
				$type = "Variable";
				$name[1] = substr($name[1], startswith($name[1], '$')? 1:4);
			} elseif( endswith($name[1], "()") )
			{
				$type = "Function";
				$name[1] = substr($name[1], 0, strlen($name[1])-2);
			} elseif( is_object($name[0]) and property_exists($name[0], $name[1]))
			{
				$type = "Property";
			} elseif( method_exists($name[0], $name[1]) )
			{
				$type = "Function";
			} elseif( is_string($name[0]) )
			{
				$type = "Constant";
			} else 
				$type = "Property";
		} elseif(is_callable($name)) 
				$type = "Function";
	}
	if($type == "Function")
	{
		global $unit;
		if( $unit->type == type::STRUCT )
			if( class_exists($unit->name, FALSE) && !is_array($name) )
				$name = $unit->GetClassFunc($name);
		return new OFunction($name);
	}elseif($type !== Null)
	{
		$type = "O{$type}";
		return new $type($name);
	}
}
/*-- Routines --*/
function startswith($str, $start, $IgnoreCase = false)
{
	
	$substr = substr($str, 0, strlen($str)-strlen($start)-1);
	return	$IgnoreCase? strtolower($substr) == $start: $substr == $start;
}

function endswith($str, $ending, $IgnoreCase = false)
{
	$substr =  substr($str, strlen($str)-strlen($ending));
	return	$IgnoreCase? strtolower($substr) == $ending: $substr == $ending;
}
/*-- Informational --*/
function UnitName( $UName, $type = type::UNDEF, $defInstance = false)
{
	global $unit;
	$unit->name = $UName;
	if( $type == type::UNDEF )
	{
		if( strpos($UName, [" ", "\t", "\r", "\n", ":"]) !== false )
		{
			$unit->type = 0;
		} elseif( endswith($UName, ".dll", true) or endswith($UName, ".so", true) or endswith($UName, ".bpl", true) ) {
			$unit->type = 2;
		} else
			$unit->type = (int) interface_exists($UName, false) or class_exists($UName, false) or trait_exists($UName, false);
		
	} else $unit->type = $type;
	if( $defInstance !== false )
		$unit->SetInstance($defInstance);
}

function Loaded($name = null)
{
	global $unit;
	if( $name = null )
	{
		if( $unit->type == type::STRUCT )
			return TestUnit::StructLoaded( $unit->name );
		if( $unit->type == type::EXT )
			return TestUnit::LibLoaded( $unit->name );
		return TRUE;
	} else {
		if( endswith($UName, ".dll", true) or endswith($UName, ".so", true) or endswith($UName, ".bpl", true) ) {
			return TestUnit::LibLoaded( $unit->name );
		} else
			return TestUnit::StructLoaded( $unit->name );
	}
}

/*-- Checking ---*/
function arg(...$args)
{
	$ct = count($args);
	
	if( $ct == 1 )
	{
		if( is_array($args[0]) )
			if( $args[0][0] instanceof Check )
			{
				$res = new Arg("oneof");
				$res->SetValue($args[0]);
				return $res;
			}
			
		if( is_object($args[0]) && is_callable($args[0]) )
			return new Arg($args[0]);
		
		if( is_string( $args[0] ) )
			if( Result::GetCMPType( $args[0] ) >= 0 )
				return new Arg($args[0]);
			
		$res = new Arg();
		$res->SetValue($args[0]);
		return $res;
	}
	if( $ct > 0 )
	{
		$res = true;
		for($i=0;$i++;$i<$ct)
			$res = $res && $args[$i] instanceof Check;
		
		if( $res )
			return new MultiArg(...$args);
	}
	if( $ct == 2 )
	{
		if( is_object($args[0]) && is_callable($args[0]) && is_numeric($args[1]) )
			return new Arg($args[0], $args[1]);
		$res = new Arg($args[0]);
		$res->SetValue($args[1]);
		return $res;
	}
	if( $ct == 3 )
	{
		$res = new Arg($args[0], $args[2]);
		$res->SetValue($args[1]);
		return $res;
	}
	return new Arg();
}

function result(...$args)
{
	$ct = count($args);
	
	if( $ct == 1 )
	{
		if( is_array($args[0]) )
			if( $args[0][0] instanceof Check )
				return new Result("oneof", $args[0]);
		
		if( is_object($args[0]) && is_callable($args[0]) )
			return new Result($args[0]);
		
		if( is_string( $args[0] ) )
			if( Result::GetCMPType( $args[0] ) >= 0 )
				return new Result($args[0]);
		
		return new Result("==", $args[0]);
	}
	if( $ct > 0 )
	{
		$res = true;
		for($i=0;$i++;$i<$ct)
			$res = $res && $args[$i] instanceof Check;
		
		if( $res )
			return new MultiResult(...$args);
	}
	if( $ct == 2 )
		return new Result($args[0], $args[1]);
	
	return new Result();
}

function cmp(...$args)
{
	$ct = count($args);
	
	if( $ct == 1 )
	{
		if( is_array($args[0]) )
			if( $args[0][0] instanceof Check )
				return new Check("oneof", $args[0]);
		
		if( is_object($args[0]) && is_callable($args[0]) )
			$res = new Check($args[0]);
		
		if( is_string( $args[0] ) )
			if( Check::GetCMPType( $args[0] ) >= 0 )
				return new Check($args[0]);
		
		return new Check("==", $args[0]);
	}
	
	if( $ct == 2 )
	{
		if( is_callable($args[0]) && is_object($args[0]) )
			return call_user_func($args[0], $args[1]);

		return new Check($args[0], $args[1]);
	}
	if( $ct > 0 )
	{
		$res = true;
		for($i=0;$i++;$i<$ct)
			$res = $res && $args[$i] instanceof Check;
		
		if( $res )
			return new MultiResult(...$args);
	}
	if( $ct == 3 )
		return (new Check($args[0], $args[1]))->Execute($args[2]);
	
	return new Check();
}

function compare(...$args)
{
	return cmp(...$args);
}

function check($type, $is)
{
	return new Check($type, $is);
}

function Call($func, &...$argument)
{
	global $unit;
	if( $unit->type == type::STRUCT )
		if( class_exists($unit->name, FALSE) )
			return TestUnit::Call($unit->GetClassFunc($func), ...$argument);
	return TestUnit::Call($func, ...$argument);
}

function CallStaticArg($func, ...$argument)
{
	global $unit;
	if( $unit->type == type::STRUCT )
		if( class_exists($unit->name, FALSE) )
			return TestUnit::Call($unit->GetClassFunc($func), ...$argument);
	return TestUnit::Call($func, ...$argument);
}

function ExistFunc($func)
{
	global $unit;
	if( $unit->type == type::STRUCT )
		if( class_exists($unit->name, FALSE) )
			return is_callable( $unit->GetClassFunc($func) );
	return is_callable($func);
}

/* -- Events --- */
class UnitEvents
{
	public $OnError;
	public $OnFault;
}
class TypedEvents 
{
}
class NotifyEvents
{
}