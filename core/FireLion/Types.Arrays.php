<?
/*----------------------------------------------------------------------------\
|					FireLion Visual Framework Array Library		 	          |
/*----------------------------------------------------------------------------/
|																			  |
|	Version: 1																  |
|	Date Modified: 14 August 2019 year										  |
|	Time:	19:34 (Ua)														  |
|	Autors:																	  |
|															Andrew Zenin	  |
|																			  |
\*----------------------------------------------------------------------------/
|
|							Types:
|				StaticArray -> Static Array object
|				DynamicArray-> Dynamic Array Object
|				TypedArray	-> Array With Typization
|				AbstractArray->Array with Abstract Typization
|
*/

class oArray implements IArray
{
	protected $_____data;
	protected $_____count = 0;
	protected $_____position = 0;
	protected $_____locked;
	public function __construct($data)
	{
		$this->_____count = count($data);
		$this->_____data = $data;
	}
	public function Get( $Key )
	{
		return $this->_____data[$Key];
	}
	public function Merge( $data )
	{
		if( $this->_____locked ) return;
		if( is_array($data) )
		{
			foreach($data as $value)
				$this->append($value);
		} elseif ( is_object($data) ) {
			$cImple = class_implements($data, false);
			if( in_array('IAbstractArray',$cImple) )
			{
				$cnt = count($data);
				for($i=0;$i<$cnt;$i++)
					$this->append( $data->GetEitherNotAs($i, $this->_____types, $this->_____not) );
			}elseif( in_array('IArray', $cImple) || in_array('ITerator', $cImple) )
				foreach($data as $v)
					$this->append($v);
		}
	}
	public function count()
	{
		return $this->_____count;
	}
	public function current()
	{
		return current($this->_____data);
	}
	public function getArrayCopy ()
	{
		return $this->_____data;
	}
	public function key ()
	{
		return key($this->_____data);
	}
	public function next ()
	{
		++$this->_____position;
		next($this->_____data);
	}
	public function prev ()
	{
		--$this->_____position;
		prev($this->_____data);
	}
	public function offsetExists ( $index )
	{
		return IsSet($this->_____data[$index]);
	}
	public function offsetGet ($index)
	{
		return $this->_____data[$index];
	}
	public function rewind ()
	{
		$this->_____position = 0;
		rewind($this->_____data);
	}
	public function seek ( $position )
	{
		if ( $position < $this->_____count )
		{
			if( $position == $this->_____position ) return;
			if( $position > $this->_____position )
			{
				while($position > $this->_____position) $this->next();
			}
			if( $position < $this->_____position )
			{
				while($position > $this->_____position) $this->prev();
			}
		}
	}
	public function serialize ()
	{
		return serialize($this->_____data);
	}
	public function unserialize ( string $serialized )
	{
		$this->_____data = unserialize($this->_____data);
	}
	public function uasort ( $cmp_function )
	{
		if($this->_____locked) return;
		uasort($this->_____data, $cmp_function);
	}
	public function uksort ( $cmp_function )
	{
		if($this->_____locked) return;
		uksort($this->_____data, $cmp_function);
	}
	public function ksort
	{
		if($this->_____locked) return;
		ksort($this->_____data);
	}
	public function natcasesort ()
	{
		if($this->_____locked) return;
		natcasesort($this->_____data);
	}
	public function natsort ()
	{
		if($this->_____locked) return;
		natsort($this->_____data);
	}
	public function asort ()
	{
		if($this->_____locked) return;
		asort($this->_____data);
	}
	public function valid (){ return $this->_____position < $this->_____count; }
	public function append ( $value )
	{
		if($this->_____locked) return;
		$this->_____data[] = $value;
		++$this->_____count;
	}
	public function offsetSet ( $index , $value )
	{
		if($this->_____locked) return;
		if(is_integer($index) && $index > $this->_____count)
			++$this->_____count;
		$this->_____data[$index] = $value;
	}
	public function offsetUnset ( $index )
	{
		if($this->_____locked) return;
		if($index > $this->_____count) return;
		if( $index >= $this->_____position )
			--$this->_____position;
		unset($this->_____data[$index]);
	}
}

class StaticArray extends oArray
{
	public function __construct($data)
	{
		$this->_____count = count($data);
		$this->_____data = $data;
		$this->_____locked = true;
	}
}

class DynamicArray extends oArray implements IDynamicArray
{
	public function Lock()
	{
		$this->_____locked = false;
	}
	public function UnLock()
	{
		$this->_____locked = true;
	}
	public function IsLocked()
	{
		return $this->_____locked;
	}
	public function Clear()
	{
		if($this->_____locked) return;
		$this->_____data  = [];
		$this->_____position = 0;
		$this->_____count = 0;
	}
	public function Exists( $Key )
	{
		return $this->offsetExists($Key);
	}
	public function ExistsElement( $Value )
	{
		$valyes = array_flip($this->_____data);
		return isset($valyes[$Value]);
	}
	public function Add( $KeyValue )
	{
		$this->append($KeyValue);
	}
	public function Remove( $Key )
	{
		$this->offsetUnset($Key);
	}
	public function Replace( $Ley, $NewValue )
	{
		if($this->_____locked) return;
		if($this->offsetExists($Ley))
			$this->offsetSet($Ley, $NewValue);
	}
	public function ReplaceElement( $Value, $NewValue )
	{
		if($this->_____locked) return;
		$valyes = array_flip($this->_____data);
		if( isset($valyes[$Value]) )
			$this->_____data[$valyes[$Value]] = $NewValue;
	}
	public function RemoveElement( $Value )
	{
		if($this->_____locked) return;
		$valyes = array_flip($this->_____data);
		if( isset($valyes[$Value]) )
			unset($this->_____data[$valyes[$Value]]);
	}
	public function Insert( $Key, $KeyValue )
	{
		if($this->_____locked) return;
		if($this->Exists($Key))
		$this->_____data = array_merge(array_slice($this->_____data,0,$Key-1), $KeyValue, array_slice($this->_____data,$Key-1));
	}
	//------------------------------------
	public function Set( $Key, $KeyValue )
	{
		$this->offsetSet($Key, $KeyValue);
	}
	public function __get( $name )
	{
		return $this->offsetGet($name);
	}
	public function __set( $name, $value )
	{
		$this->offsetSet($name,$value);
	}
}

class TypedArray extends DynamicArray implements ITypedArray
{
	protected $_____types = [];
	protected $_____not = [];
	protected $_____tlocked = false;
	public function __construct($type=false,$data)
	{
		if( is_string($type) )
		$this->_____types = [strtolower($type)];
		foreach($data as $i=>$v)
			$this->offsetSet($i,$v);
	}
	
	public function AddType( $type )
	{
		if($this->_____tlocked) return;
		$type = strtolower($type);
		if( substr($type,0,1) == '!' )
		{
			$type = substr($type,1,0);
			if(!array_search($type, $this->_____not))
				$this->_____not[] = $type;
		} else {
		if(!array_search($type, $this->_____types))
			$this->_____types[] = $type;
		}
	}

	public function RemoveType( $type )
	{
		if($this->_____tlocked) return;
		$types = array_flip($this->_____types);
		if( isset($types[$type]) )
			unset($this->_____types[$types[$type]]);
	}
	
	protected function CheckTypes( &$v )
	{
		if( empty( $this->_____types ) && empty( $this->_____not ) ) return true;
		return TypeHelperClass::checkTypes($this->_____types, $this->_____not, $v);
	}
	
	public function isType($v)
	{
		return $this->CheckTypes($v);
	}
	
	public function ExistsElement( $Value )
	{
		if(!$this->CheckTypes($Value)) return;
		$valyes = array_flip($this->_____data);
		return isset($valyes[$Value]);
	}

	public function GetType()
	{
		foreach($this->_____types as $t)
			yield $t;
			
		foreach($this->_____not as $t)
			yield $t;
	}
	
	public function GetTypes( )
	{
		foreach($this->_____types as $t)
			yield class_exists($t,false)?"[object] $t":$t;
			
		foreach($this->_____not as $t)
			yield class_exists($t, false)?"![object] {$t}": "!{$t}";
	}
	
	public function Add( $LeyValue )
	{
		$this->append($LeyValue);
	}
	public function Replace( $Ley, $NewValue )
	{
		if($this->_____locked) return;
		if(!$this->CheckTypes($NewValue)) return;
		if($this->offsetExists($Ley))
			$this->offsetSet($Ley, $NewValue);
	}
	public function append ( $value )
	{
		if($this->_____locked) return;
		if(!$this->CheckTypes($value)) return;
		$this->_____data[] = $value;
		++$this->_____count;
	}
	public function offsetSet ( $index, $value )
	{
		if($this->_____locked) return;
		if(!$this->CheckTypes($value)) return;
		if(is_integer($index) && $index > $this->_____count)
			++$this->_____count;
		$this->_____data[$index] = $value;
	}
	public function ReplaceElement( $Value, $NewValue )
	{
		if($this->_____locked) return;
		if(!$this->CheckTypes($Value)
			||!$this->CheckTypes($NewValue)) return;
		$valyes = array_flip($this->_____data);
		if( isset($valyes[$Value]) )
			$this->_____data[$valyes[$Value]] = $NewValue;
	}
	public function RemoveElement( $Value )
	{
		if($this->_____locked) return;
		if(!$this->CheckTypes($Value)) return;
		$valyes = array_flip($this->_____data);
		if( isset($valyes[$Value]) )
			unset($this->_____data[$valyes[$Value]]);
	}
	public function Insert( $Key, $KeyValue )
	{
		if($this->_____locked) return;
		if(!$this->CheckTypes($KeyValue)) return;
		if($this->Exists($Key))
		$this->_____data = array_merge(array_slice($this->_____data,0,$Key-1), $KeyValue, array_slice($this->_____data,$Key-1));
	}
}
class TypeLockedArray extends TypedArray
{
	public function __construct($data)
	{
		foreach($data as $i=>$v)
			$this->offsetSet($i,$v);
	}
	
	public function AddType( $type )
	{
	}

	public function RemoveType( $type )
	{
	}
}

class AbstractArray extends TypedArray implements IAbstractArray
{
	protected $_____converters;
	protected function ConvertV(&$v,$types=false,$not=false,$Default=null)
	{
		if(!$types) $types = $this->_____types;
		if(!$not)	$not = $this->_____not;
		return TypeHelperClass::ConvertValue($v,$this->_____converters,$types,$not,$Default);
	}
	protected function CheckTypes( &$v )
	{
		if( empty( $this->_____types ) && empty( $this->_____not ) ) return true;
		if(!TypeHelperClass::checkTypes($this->_____types, $this->_____not, $v))
			return $this->ConvertV($v);
	}
	public function settype( $Type )
	{
		$d = $this->_____data;
		$this->_____data = [];
		$this->_____not = [];
		$this->_____types = [];
		if( substr($Type,0,1) == '!' )
		{
			foreach($d as $k=>$v)
			{
				if (TypeHelperClass::checkType($Type, $v))
					$endarr[$k] = $v;
			}
				$this->_____not[] 	= substr($Type,1,0);
		}	else
				{
					foreach($d as $k=>$v)
					{
						if( isset($this->_____converters[gettype($v)]) && $this->_____converters[gettype($v)]->compatible($Type) )
						{
							$this->_____data[$k] = $this->_____converters[gettype($v)]->convert($v,$Type);
							unset($d[$k]);
						} elseif (is_object($v))
						{
							$class = get_class($v);
							if(isset($this->_____converters[$class]) && $this->_____converters[$class]->compatible($Type))
							{
								$this->_____data[$k] = $this->_____converters[get_class($v)]->convert($v,$Type);
								unset($d[$k]);
							}
						}
					}
					$this->_____types[]	= $Type;
				}
		if(!empty($d))
			foreach($d as $k=>$v)
			{
				if($this->ConvertV($v))
					$this->_____data[$k] = $v;
			}
	}
	public function RegisterConverter( callable $AFunc, $AType, $AClass=null );
	public function GetAs($Key, $AType)
	{
		$V = $this->OffSetGet($Key);
		$this->ConvertV( $V, [$AType]);
		return $V;
	}
	public function GetEitherAs($Key, $Types)
	{
		$V = $this->OffSetGet($Key);
		$this->ConvertV( $V, $Types);
		return $V;
	}
	public function GetEitherNotAs($Key, $Types, $NotAs, $Default=null)
	{
		$V = $this->OffSetGet($Key);
		$this->ConvertV( $V, $Types, $NotAs, $Default );
		return $V;
	}
	public function GetOrNot($Key, $Not, $Default=null)
	{
		$V = $this->OffSetGet($Key);
		$this->ConvertV( $V, false, $NotAs, $Default );
		return $V;
	}
	public function SetTypes( $ATypes )
	{
		$this->_____not = [];
		$this->_____types = []
		$d = $this->_____data;
		$this->_____data = [];
		if(!is_array($ATypes))$ATypes = [$ATypes];
		foreach( $ATypes as $Type )
		{
			if( substr($Type,0,1) == '!' )
			{
				foreach($d as $k=>$v)
				{
					if( !TypeHelperClass::checkType($Type, $v) )
						unset($d[$k]);
				}
				$this->_____not[] 	= substr($Type,1,0);
			} else	{
					foreach($d as $k=>$v)
					{
						if( isset($this->_____converters[gettype($v)]) && $this->_____converters[gettype($v)]->compatible($Type) )
						{
							$this->_____data[$k] = $this->_____converters[gettype($v)]->convert($v,$Type);
							unset($d[$k]);
						} elseif (is_object($v))
						{
							$class = get_class($v);
							if(isset($this->_____converters[$class]) && $this->_____converters[$class]->compatible($Type))
							{
								$this->_____data[$k] = $this->_____converters[get_class($v)]->convert($v,$Type);
								unset($d[$k]);
							}
						}
					}
						$this->_____types[]	= $Type;
				}
		}
		if(!empty($d))
			foreach($d as $k=>$v)
			{
				if($this->ConvertV($v))
					$this->_____data[$k] = $v;
			}
	}
	public function LockTypes()
	{
		$this->_____tlocked = true;
	}
	public function UnLockTypes()
	{
		$this->_____tlocked = false;
	}
	public function IsTypesLocked()
	{
		return $this->_____tlocked;
	}
}


class IntegerArray extends TypeLockedArray
{
	protected $_____types = ['integer'];
}

class FloatArray extends TypeLockedArray/
{
	protected $_____types = ['float','double'];
}

class NumericArray extends TypeLockedArray
{
	protected $_____types = ['numeric'];
}

class ArrayArray extends TypeLockedArray
{
	protected $_____types = ['array'];
}

class BoolArray extends TypeLockedArray
{
	protected $_____types = ['bool'];
}

class BooleanArray extends BoolArray {}

class CallableArray extends TypeLockedArray
{
	protected $_____types = ['callable'];
}

Class ObjectArray extends TypeLockedArray
{
	protected $_____types = ['object'];
}

class StringArray extends TypeLockedArray
{
	protected $_____types = ['string'];//
}