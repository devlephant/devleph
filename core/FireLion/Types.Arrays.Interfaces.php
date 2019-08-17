<?
/*----------------------------------------------------------------------------\
|			FireLion Visual Framework Array Interfaces Library			 	  |
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
|						Types:
|				IArray		-> Normal Dynamic Array
|				ITypedArray	-> Array with typization
|
*/

interface IArray extends Countable, ArrayAccess, SeekableIterator, Serializable
{
	public function __construct($data);
	public function Get( $Key );
	public function Merge( $Data );
}

interface IDynamicArray extends IArray
{
	public function Add( $KeyValue );
	public function Remove( $Key );
	public function Replace( $Key, $NewValue );
	public function ReplaceElement( $Value, $NewValue );
	public function RemoveElement( $Value );
	public function Insert( $Key, $KeyValue );
	public function Set( $Key, $KeyValue );
	public function Lock( void );
	public function UnLock( void );
	public function IsLocked( void );
	public function Clear( void );
	public function __get( $name );
	public function __set( $name, $value );
}

interface ITypedArray extends IDynamicArray
{
	public function gettype( void );
	public function GetTypes();
	public function AddType( $type );
	public function RemType( $type );
	public function istype( $Value );
}

interface IAbstractArray extends ITypedArray
{
	public function settype( $AType );
	public function RegisterConverter( callable $AFunc, $AType, $AClass=null );
	public function GetAs($Key, $AType);
	public function GetEitherAs($Key, $Types);
	public function GetEitherNotAs($Key, $Types, $NotAs, $Default=null);
	public function GetOrNot($Key, $Not, $Default=null);
	public function SetTypes( $ATypes );
	public function LockTypes();
	public function UnLockTypes();
	public function IsTypesLocked();
}