<?
/*----------------------------------------------------------------------------\
|			FireLion Visual Framework Geometry Interfaces Library			  |
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
|								Types:
|				IGeometryObject		-> Geometrical Object
|
*/

interface IGeometryObject extends ArrayAccess, Countable
{
	public function Multiply( $Data );
	public function Add		( $Data );
	public function Divide	( $Data );
	public function Subtract( $Data );
	public function Angle( TPoint $P );
	public function GetAngle(  void );
	public function Rotate	( $Data );
	
	/*--------------Generic--------------*/
	public function Assign(IGeometryObject $to);
	
	/*---------------Sizes---------------*/
	public function GetSquare();
	public function GetPerimeter();
	public function GetSizes();
	public function GetCenter();
	
	/*--------------Polymer--------------*/
	public function GetAngleCount();
	public function GetAngles();
	public function GetOutsiderAngles();
	public function GetAllAngles();
	public function GetPolygon();
	public function GetPoints();
	public function GetLines();
	public function GetSides();
	
	/*------------Comparison------------*/
	public function IsZero();
	public function IsEmpty();
	
	/*--------Defaults----------*/
	public static function Zero();
}