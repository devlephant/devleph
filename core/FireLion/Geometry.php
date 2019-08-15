<?
/*----------------------------------------------------------------------------\
|				FireLion Visual Framework Geometry Library					  |
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
|				Point				-> TPoint
|				Floating Point		-> TPointF
|				Line 				-> TLine
|				Floating Line		-> TLineF
|				Triangle			-> TTriangle
|				Floating Triangle	-> TTriangleF
|				Rectangle 			-> TRect
|				Floating Rectangle	-> TRectF
|				Polygon				-> TPolygon
|				Floating Polygon	-> TPolygonF
|
*/

function UnclosedGeoArrayToClosed(&$point, $type)
{
	$point = array_values($point);
	$cnt = count($point);
	for($i=0;$i<$cnt;$i++)
	{
		$result[] = new $type($point[$i], $point[($i=$cnt)?0:$i+1]);
	}
	return $result;
}
//example: $Lines = UnclosedGeoArrayToClosed($Shape->GetPoints());
function UnclosedGeoArrayToUnion(&$Union, &$point, $type)
{
	$point = array_values($point);
	$cnt = count($point);
	for($i=0;$i<$cnt;$i++)
	{
		$Union->Union(new $type($point[$i], $point[($i=$cnt)?0:$i+1]));
	}
}

///////////////////////////////////////////////////////////////////////////////
///                             TPoint                                      ///
///	Main graphical position class, which  stores x, y integer values		///
///	Created for point equation, mirroring and comparison					///
/// Also used for positioning and calculating areas of different shapes		///
///////////////////////////////////////////////////////////////////////////////
class TPoint implements ArrayAccess
{
	#public int $x
	#public int $y
	public $OrigX;
	public $OrigY;
    
	public $_x;
	public $_y;

    function __construct(...$p)
	{
		switch(count($p))
		{
			default:
			{
				$this->_x = $this->_y = 0;
			} break;
			case 1:
			{
				if(($p[0] instanceof SELF))
				{
					$this->_x = $p[0]->_x;
					$this->_y = $p[0]->_y;
				} elseif($p[0] instanceof TRect) {
					$this->_x = $p[0]->Left;
					$this->_y = $p[0]->Top;
				} elseif($p[0] instanceof TLine) {
					$this->_x = $p[0]->Start->_x;
					$this->_y = $p[0]->Start->_y;
				} else {
					$this->_x = $p[0];
					$this->_y = $p[0];
				}
			} break;
			case 2:
			{
				list($this->_x,$this->_y) = $p;
				list($this->OrigX,$this->OrigY) = $p;
			} break;
		}
    }
	
	public function Add($pt)
	{
		if($pt instanceof SELF)
		{
			$this->_x += $pt->_x;
			$this->_y += $pt->_y;
		} elseif($pt instanceof TRect) {
			$this->_x += $pt->Left;
			$this->_y += $pt->Top;
		} else {
			$this->_x += $pt;
			$this->_x += $pt;
		}
	}
	
	public function Multiply($pt)
	{
		if($pt instanceof SELF)
		{
			$this->_x *= $pt->_x;
			$this->_y *= $pt->_y;
		} elseif($pt instanceof TRect) {
			$this->_x *= $pt->Left;
			$this->_y *= $pt->Top;
		} else {
			$this->_x *= $pt;
			$this->_x *= $pt;
		}
	}
	
	public function Divide($pt)
	{
		if($pt instanceof SELF)
		{
			$this->_x /= $pt->_x;
			$this->_y /= $pt->_y;
		} elseif($pt instanceof TRect) {
			$this->_x /= $pt->Left;
			$this->_y /= $pt->Top;
		} else {
			$this->_x /= $pt;
			$this->_x /= $pt;
		}
	}
	
	public function Subtract($pt)
	{
		if($pt instanceof SELF)
		{
			$this->_x -= $pt->_x;
			$this->_y -= $pt->_y;
		} elseif($pt instanceof TRect) {
			$this->_x -= $pt->Left;
			$this->_y -= $pt->Top;
		} else {
			$this->_x -= $pt;
			$this->_x -= $pt;
		}
	}
	public function Between($pt)
	{
		$SELF = get_class($this);
		if($pt instanceof SELF)
		{
			return new $SELF(($this->_x + $pt->_x) / 2, ($this->_y + $pt->_y) / 2);
		} elseif($pt instanceof TRect) {
			return new $SELF(($this->_x + $pt->Left) / 2, ($this->_y + $pt->Top) / 2);
		} elseif($pt instanceof TLine) {
			return new $SELF(($this->_x + $pt->Center->_x) / 2, ($this->_y + $pt->Center->_y) / 2);
		}
		return new $SELF(($this->_x + $pt) / 2, ($this->_y + $pt) / 2);
	}
	public function Offset(TPoint $pt)
	{
		$this->_x += $pt->_x;
		$this->_y += $pt->_y;
	}
	
	public function OffsetXY($x, $y)
	{
		$this->_x += $x;
		$this->_y += $y;
	}
	
	public function Angle(TPoint $pt)
	{
		return (int)rad2deg(atan2((double)$this->_y - $pt->_y,(double)$this->_x - $pt->_x));
	}
	
	public function AngleBetween(TPoint $pt)
	{
		return $this->Angle($pt);
	}
	
	public function Rotate(TPoint $Center, $Angle)
	{
		if($Angle = 0 ) return;
		//Convert degrees to radians
		$Angle = deg2rad($Angle);
     // Perform rotation
     $this->_x =
           ROUND(
                 $Center->_x + ($this->_x - $Center->_x)* COS($Angle)
                         - ($this->_y - $Center->_y)* SIN($Angle) );

     $this->_y =
           ROUND(
                 $Center->_y + ($this->_x - $Center->_x)* SIN($Angle)
                         + ($this->_y - $Center->_y)* COS($Angle) );
	}
	
	public function Distance(TPoint $pt)
	{
		return (int)hypot($pt->_x - $this->_x, $pt->_y - $this->_y);
	}
	
	public function DistancePoint(TPoint $pt)
	{
		$SELF = get_class($this);
		return new $SELF($pt->_x - $this->_x, $pt->_y - $this->_y);
	}
	
	public function Difference(TPoint $pt)
	{
		return (int)hypot($this->_x - $pt->_x, $this->_y - $pt->_y);
	}
	
	public function DifferencePoint(TPoint $pt)
	{
		$SELF = get_class($this);
		return new $SELF($this->_x - $pt->_x, $this->_y - $pt->_y);
	}
	
	public function Bigger(TPoint $pt)
	{
		return ( $pt->_x + $pt->_y > $this->_x + $this->_y )?$pt:$this;
	}
	
	public function Smaller(TPoint $pt)
	{
		return ( $pt->_x + $pt->_y > $this->_x + $this->_y )?$this:$pt;
	}
	
	public function isSmaller(TPoint $pt)
	{
		return $pt->_x + $pt->_y > $this->_x + $this->_y;
	}
	
	public function isBigger(TPoint $pt)
	{
		return $pt->_x + $pt->_y < $this->_x + $this->_y;
	}
	
	public function isEqual(TPoint $pt)
	{
		return ($pt->_x == $this->_x && $pt->_y == $this->_y);
	}
	
	public function Equals(TPoint $pt)
	{
		return $this->isEqual($pt);
	}
	
	public function Compare(TPoint $pt)
	{
		if($pt->_x + $pt->_y < $this->_x + $this->_y)
			return -1;
		if($pt->_x + $pt->_y > $this->_x + $this->_y)
			return 1;
		return 0;
	}
	
	public function isClose(TPoint $pt)
	{
		return ( $pt->_x <= $this->_x ) and ( $pt->_y <= $this->_y );
	}
	
	public function isFar(TPoint $pt)
	{
		return ( $pt->_x > $this->_x ) and ( $pt->_y > $this->_y );
	}
	
	public function Flip()
	{
		$a = [$this->_x,$this->_y];
		$this->_x = $a[1];
		$this->_y = $a[0];
	}
	
	public function FlippedPt()
	{
		$pt = clone $this;
		$pt->Flip();
		return $pt;
	}
	
	public function AutoMirror(TPoint $Sizes)
	{
		$Center = new TPointF($Sizes);
		$Center->DivideDigit(2);
		$Angle = ($Center->isFar($this->DifferencePoint($Sizes)))?-180:180;
		$this->Rotate($Sizes, $Angle);
	}
	
	public function Mirror(TPoint $Sizes)
	{
		$this->Rotate($Sizes, 180);
	}
	
	public function Invert()
	{
		$this->_x = -$this->_x;
		$this->_y = -$this->_y;
	}
	
	public function InCircle(TPoint $Center, $Radius)
	{
		return ($Radius > 0) && ((pow($Center->_x-$this->_x,2)+pow($Center->_y-$this->_y,2)) < pow($Radius,2));
	}
	
	public function InArray($array)
	{
		if(is_array($array))
			foreach( $array as $v )
				if(($v instanceof SELF and $v == $this) or (is_array($v)&&$v[0]==$this->_x&&$v[1]==$this->_y))
					return true;
		return false;
	}
	
	public function InRect(TRect $Rect)
	{
		return (($this->_x >= $Rect->left) and ($this->_x <= $Rect->right)) and (($this->_y >= $Rect->top) and ($this->_y <= $Rect->bottom)); 
	}
	
	public function InSquare($x,$y,$w,$h)
	{
		return (($this->_x >= $x) and ($this->_x <= $x+$w)) and (($this->_y >= $y) and ($this->_y <= $y+$h)); 
	}
	
	public function InPolygon(TPolygon $Polygon)
	{
		return $Polygon->Contains($this);
	}
	
	public function InTransientPolygon(TPolygon $Polygon)
	{
		return $Polygon->PtInTransientSquare($this);
	}
	
	public function Assign(TPoint $pt)
	{
		$this->_x = $pt->_x;
		$this->_y = $pt->_y;
	}
	
	public function IsZero()
	{
		return $this == call_user_method('Zero', get_called_class());
	}
	
	public function IsEmpty()
	{
		return $this->IsZero();
	}
	
	public function GetSquare()
	{
		return 1;
	}
	
	public function GetPerimeter()
	{
		return 1;
	}
	
	public function GetAngles()
	//Returns shape-only angles -> insider angles
	{
		return [90,90,90,90];
	}
	
	public function getOutsiderAngles()
	//Returns only outsider angles
	{
		return [270,270,270,270];
	}
	
	public function GetAllAngles()
	//Returns also outsider angles
	{
		return [270,90,270,90,270,90,270,90];
	}
	
	public function GetSides()
	//Returns sides...
	{
		return [0.5,0.5];
	}
	
	public static function PointInCircle(TPoint $Point, TPoint $Center, $Radius)
	{
		return $Point->InCircle($Center, $Radius);
	}
	
	public static Function Zero()
	{
		$SELF = get_called_class();
		return new $SELF(0,0);
	}
	
	protected function _getX()
	{
		return (double) $this->_x;
	}
	
	protected function  _getY()
	{
		return (double) $this->_y;
	}

	public function __set($n, $v)
	{
		switch(strtolower($n))
		{
			case 'x':
			case 'width':
			case 'w':
			case '0':
			case 'left': $this->_x = $v;
			case 'y':
			case 'height':
			case 'h':
			case '1':
			case 'top': $this->_y = $v;
		}
	}
	
	public function __get($n)
	{
		switch(strtolower($n))
		{
			case 'x':
			case 'width':
			case 'w':
			case '0':
			case 'left': return $this->_getX();
			case 'y':
			case 'height':
			case 'h':
			case '1':
			case 'top': return $this->_getY();
			case 'iszero': case 'isempty': return $this->IsZero();
			case 's': case 'square':
			return $this->GetSquare();
			case 'p': case 'perimeter':
			return $this->GetPerimeter();
			case 'angles':
			return $this->GetAngles();
			case 'allangles':
			return $this->GetAllAngles();
			case 'outsiderangles':
			return $this->GetOutsiderAngles();
			case 'sides':
			return $this->GetSides();
		}
	}

	public function offsetSet($offset, $v)
	{
        $this->$offset = $v;
    }

    public function offsetExists($offset)
	{
        return in_array(strtolower($offset), ['0','1','h','height','w','width','left','top',
		'x','y','s','square','p','perimeter','angles','allangles','outsiderangles','sides']);
    }
	
	public function __isset($n)
	{
		return $this->offsetExists($n);
	}

    public function offsetUnset($offset) 
	{
		$this->$offset = 0;
    }

    public function offsetGet($offset)
	{
       return $this->$offset;
    }
	public function __ToString()
	{
		return get_class($this)."=>[{$this->x},{$this->y}]";
	}
}


///////////////////////////////////////////////////////////////////////////////
///                             TPointF                                     ///
///	Unlike TPoint, it can contain and return float, and double values		///
///	Just because creating < 1px point is unreal, formally, it's	an			///
/// Alpha-Transparent circle or square, depending on AA method 				///
///////////////////////////////////////////////////////////////////////////////
class TPointF extends TPoint
{
	#public double $x
	#public double $y
	
	protected function GetReadyForThis($float)
	{
		$s = (string)$float;
		$s = "0.".substr($s, strpos($s, '.')+1);
		return (double)$s;
	}
	
	protected function TestForThis($float)
	{
		return ceil($float) !== floor($float);
	}
	
	public function Angle(TPoint $pt)
	{
		return rad2deg(atan2((double)$this->_y - $pt->_y,(double)$this->_x - $pt->_x));
	}
	
	public function Distance(TPoint $pt)
	{
		return hypot($pt->_x - $this->_x, $pt->_y - $this->_y);
	}
	
	public function Difference(TPoint $pt)
	{
		return hypot($this->_x - $pt->_x, $this->_y - $pt->_y);
	}
	
	public function GetAngles()
	//Returns shape-only angles -> insider angles
	{
		//In fact, if the point is solid, it have 4 angles, but, if not, it's not point anymore,so...
		return ($this->TestForThis($this->_x)||$this->TestForThis($this->_y))?[360]:[90,90,90,90];
	}
	
	public function getOutsiderAngles()
	//Returns only outsider angles
	{
		return ($this->TestForThis($this->_x)||$this->TestForThis($this->_y))?[360]:[270,270,270,270];
	}
	
	
	public function GetAllAngles()
	//Returns also outsider angles
	{
		return ($this->TestForThis($this->_x)||$this->TestForThis($this->_y))?[360,360]:[270,90,270,90,270,90,270,90];
	}
	
	public function GetSquare()
	{
		$a = ($this->TestForThis($this->_x))? $this->GetReadyForThis($this->_x): 1;
		$a = ($this->TestForThis($this->_y))? $a + $this->GetReadyForThis($this->_y): 1;
		return pow(M_PI * ($a),2);
	}
	
	public function GetPerimeter()
	{
		$a = ($this->TestForThis($this->_x))? $this->GetReadyForThis($this->_x): 1;
		$a = ($this->TestForThis($this->_y))? $a + $this->GetReadyForThis($this->_y): 1;
		return 2 * M_PI * ($a/2);
	}
	
	public function GetSides()
	{
		return ($this->TestForThis($this->_x)||$this->TestForThis($this->_y))?[null]:[0.5,0.5];
	}
	
	protected function _getX()
	{
		return (double) $this->_x;
	}
	
	protected function  _getY()
	{
		return (double) $this->_y;
	}

}

///////////////////////////////////////////////////////////////////////////////
///                             TLine										///
///	Linear data storage - synergy of 2 TPoints								///
///	Used by FireLion Framework for calculating polygons						///
///////////////////////////////////////////////////////////////////////////////
class TLine
{
	public $Start;
	public $End;
	public function __construct(...$P)
	{
		Switch(Count($P))
		{
			Case 0: {$this->Start = $this->End = new TPoint();} break;
			Case 1: {
				if($P[0] instanceof SELF){
					$this->Assign($P[0]);
				}else{
					$this->Start = $this->End = $P[0];
				}
			} 	break;
			Case 2: {$this->Start = $P[0]; $this->End = $P[1];}	break;
			Case 3: 
			if($P[2] instanceof TPoint)
			{
				$this->Start = new TPoint($P[0],$P[1]);
				$this->End = $P[2];
			} elseif($P[0] instanceof TPoint) {
				$this->Start = $P[0];
				$this->End = new TPoint($P[1],$P[2]);
			} else {
				$this->Start = new TPoint($P[0], $P[1]);
				$this->End = new TPoint($P[2], $P[2]);
			}	break;
			Case 4:
			{
				$this->Start = new TPoint($P[0], $P[1]);
				$this->End = new TPoint($P[2], $P[3]);
			} break;
		}
	}
	public function IntersectsWithPt(TPoint $p)
	//https://stackoverflow.com/a/36365358
	{
		$l = Atan2($this->Start->_y - $this->End->_y, $this->Start->_x - $this->End->_x);
		$aTanTest = Atan2($this->Start->_y - $p->_y, $this->Start->_x - $p->_x);
		if ($l == $aTanTest) {
			$l = Atan2($this->End->_y - $this->Start->_y, $this->End->_x - $this->Start->_x);
			$aTanTest = Atan2($this->End->_y - $p->_y, $this->End->_x - $p->_x);
		}
		
		return $l == $aTanTest;
	}
	public function ContainsPolygonHeights($poly)
	//=> TTriangle, TRect, TPolygon
	{
		if($poly instanceof TRect || $poly instanceof TTriangle)
			$poly = $poly->GetPolygon();
		foreach($poly->Points as $Point)
			if(!$this->IntersectsWithPt($Point)) return false;
		return true;
	}
	public function AngleBetween(TLine $ln)
	{
		return
		Atan2($this->End->_y - $this->Start->_y, $this->End->_x - $this->Start->_x)
		- Atan2($ln->End->_y - $ln->Start->_y,$ln->End->_x - $ln->Start->_x);
	}
	public function GetCenterPoint()
	{
		return new TPoint(($this->Start->_x + $this->End->_x)/2, ($this->Start->_y + $this->End->_y)/2);
	}
	public function Intersect($Ln)
	{
		if($Ln instanceof TPolygon){
			foreach($Ln->Points as $Point)
				$this->Intersect($Point);
		}elseif($Ln instanceof TRect){
			if($Ln->Left < $this->Start->_x) $this->Start->_x = $Ln->Left;
			if($Ln->Top < $this->Start->_y) $this->Start->_y = $Ln->Top;
			if($Ln->Right > $this->End->_x) $this->End->_x = $Ln->Right;
			if($Ln->Bottom > $this->End->_y) $this->End->_y = $Ln->Bottom;
		}elseif($Ln instanceof SELF){
			if($Ln->Start->_x < $this->Start->_x) $this->Start->_x = $Ln->Start->_x;
			if($Ln->Start->_y < $this->Start->_y) $this->Start->_y = $Ln->Start->_y;
			if($Ln->End->_x > $this->End->_x) $this->End->_x = $Ln->End->_x;
			if($Ln->End->_y > $this->End->_y) $this->End->_y = $Ln->End->_y;
		}elseif($Ln instanceof TPoint){
			if($Ln->_x < $this->Start->_x) $this->Start->_x = $Ln->_x;
			if($Ln->_y < $this->Start->_y) $this->Start->_y = $Ln->_y;
			if($Ln->_x > $this->End->_x) $this->End->_x = $Ln->_x;
			if($Ln->_y > $this->End->_y) $this->End->_y = $Ln->_y;
		}
	}
	public function Extersect($Ln)
	{
		if($Ln instanceof TPolygon){
			foreach($Ln->Points as $Point)
				$this->Intersect($Point);
		}elseif($Ln instanceof TRect){
			if($Ln->Left > $this->Start->_x) $this->Start->_x = $Ln->Left;
			if($Ln->Top > $this->Start->_y) $this->Start->_y = $Ln->Top;
			if($Ln->Right < $this->End->_x) $this->End->_x = $Ln->Right;
			if($Ln->Bottom < $this->End->_y) $this->End->_y = $Ln->Bottom;
		}elseif($Ln instanceof SELF){
			if($Ln->Start->_x > $this->Start->_x) $this->Start->_x = $Ln->Start->_x;
			if($Ln->Start->_y > $this->Start->_y) $this->Start->_y = $Ln->Start->_y;
			if($Ln->End->_x < $this->End->_x) $this->End->_x = $Ln->End->_x;
			if($Ln->End->_y < $this->End->_y) $this->End->_y = $Ln->End->_y;
		}elseif($Ln instanceof TPoint){
			if($Ln->_x > $this->Start->_x) $this->Start->_x = $Ln->_x;
			if($Ln->_y > $this->Start->_y) $this->Start->_y = $Ln->_y;
			if($Ln->_x < $this->End->_x) $this->End->_x = $Ln->_x;
			if($Ln->_y < $this->End->_y) $this->End->_y = $Ln->_y;
		}
	}
	public function Angle()
	{
		return $this->Start->Angle( $this->End );
	}
	public function Assign(TLine $l)
	{
		$this->Start = $l->Start;
		$this->End = $l->End;
	}
	public function GetPolygon()
	{
		$poly = new TPolygon([$this->Start,$this->End]);
		$poly->open = true;
		return $poly;
	}
	public function GetPoints()
	{
		return $this->GetPolygon();
	}
	public function GetAngles()
	{
		
	}
	public function __get($nm)
	{
		switch(strtolower($nm))
		{
			case 'center':
			return $this->Start->Between($this->End);
			case 'length':
			case 'l':
			case 'distance':
			case 'w':
			case 'width':
			return $this->Start->Distance($this->End);
		}
	}
	
	public function __set($nm,$v)
	{
	}
}

class TLineF extends TLine {}

///////////////////////////////////////////////////////////////////////////////
///                             TRect                                       ///
///	Rectangle geometric shape, which is used as an elemental graphic		///
///	Can be converted into Polygon Array										///
///////////////////////////////////////////////////////////////////////////////
class TRect implements ArrayAccess
{

    #public int $left
    #public int $top
    #public int $right
    #public int $bottom
	#public TPoint $TopLeft
	#public TPoint $BottomRight
	#public TPoint $Location
	#public TPoint $Position
	#public TPoint $Size
	#public int Square
	#TSplit |  0 |	 1	 |	2  |	3  |
	#		Left , Right , Top , Bottom
	public $CenterPointOriginal;
	protected $_Left;
	protected $_Top;
	protected $_Right;
	protected $_Bottom;
    function __construct(...$p)
	{
		switch( count($p) ) //The price of the comfortability
		{
			case 1:
			{
				if($p[0] instanceof SELF)
				{
					$this->Assign($p[0]);
				} elseif($p[0] instanceof TPoint)
				{
					$this->_Left = $p[0]->_x;
					$this->_Top 	= $p[0]->_y;
					$this->_Right = 0;
					$this->_Bottom = 0;
				}					
			} break;
			case 2:
			{
				if(($p[0] instanceof TPoint) && ($p[1] instanceof TPoint))
				{
					$this->_Left = $p[0]->_x;
					$this->_Top 	= $p[0]->_y;
					$this->_Right = $p[1]->_x;
					$this->_Bottom = $p[1]->_y;
				} elseif($p[0] instanceof TPoint) {
					$this->_Left = $p[0]->_x;
					$this->_Top 	= $p[0]->_y;
					$this->_Right = $p[1];
					$this->_Bottom = 0;
				} elseif ($p[1] instanceof TPoint) {
					$this->_Left = $p[0];
					$this->_Top 	= 0;
					$this->_Right = $p[1]->_x;
					$this->_Bottom = $p[1]->_y;
				} else {
					$this->_Left = $p[0];
					$this->_Top 	= $p[1];
					$this->_Right = 0;
					$this->_Bottom = 0;
				}
			} break;
			case 3:
			{
				if(( $p[0] instanceof TPoint ) && ( $p[1] instanceof TPoint ))
				{
					$this->_Left		= $p[0]->_x;
					$this->_Top		= $p[0]->_y;
					$this->_Right	= $p[1]->_x;
					$this->_Bottom	= $p[1]->_x;
					if($p[2])
						$this->Normalize();
				} elseif($p[0] instanceof TPoint)
				{
					$this->_Left = $p[0]->_x;
					$this->_Top = $p[0]->_y;
					$this->_Right = $p[1];
					$this->_Bottom = $p[2];
				} elseif($p[2] instanceof TPoint) {
					$this->_Left = $p[0];
					$this->_Top = $p[1];
					$this->_Right = $p[2]->_x;
					$this->_Bottom = $p[2]->_y;
				}
				else {
					$this->_Left = $p[0];
					$this->_Top = $p[1];
					$this->_Right = $p[2];
					$this->_Bottom = 0;
				}
			} break;
			case 4:
			{
				$this->_Left = $p[0];
				$this->_Top = $p[1];
				$this->_Right = $p[2];
				$this->_Bottom = $p[3];
			} break;
			case 5:
			{
				$this->_Left = $p[0];
				$this->_Top = $p[1];
				$this->_Right = $p[2];
				$this->_Bottom = $p[3];
			if($p[$i])
				$this->Normalize();
			} break;
			default:
			{
				$this->_Left = 0;
				$this->_Top = 0;
				$this->_Right = 0;
				$this->_Bottom = 0;
			}
			break;
		}
		$this->CenterPointOriginal = $this->CenterPoint();
    }
	
	public function InRect(TRect $Rect)
	{
		return ($this->_Left >= $Rect->_Left) and ($this->_Right <= $Rect->_Right) and ($this->_Top >= $Rect->_Top) and ($this->_Bottom <= $Rect->_Bottom);
	}
	
	public function OverLays(TRect $Rect)
	{
		return $this->InRect($Rect);
	}
	
	public function Contains($R) //TRect, TPoint, TFloatPoint
	{
		if( ( $R instanceof TRect) || ( $R instanceof TPoint ) )
			return $R->InRect($this);
		if(( $R instanceof TPolygon ))
			return $R->Rect->InRect($this);
		return false;
	}
	
	public static function Zero()
	{
		$SELF = get_called_class();
		return new $SELF(0,0,0,0);
	}
	
	public static function IsEmpty()
	{
		return ($this->_Right == $this->_Left) || ($this->_Top = $this->_Bottom);
	}
	public function Add($r)
	{
		if( $r instanceof SELF )
		{
			$this->_Left += $r->_Left;
			$this->_Top  += $r->_Top;
			$this->_Right += $r->_Right;
			$this->_Bottom+= $r->_Bottom;
		}elseif( $r instanceof TPoint )
		{
			$this->_Left += $r->_x;
			$this->_Top += $r->_y;
			$this->_Right+= $r->_x;
			$this->_Bottom+=$r->_y;
		} else 
		{
			$this->_Left += $r;
			$this->_Top += $r;
			$this->_Right+= $r;
			$this->_Bottom+=$r;
		}
	}
	public function Multiply($r)
	{
		if( $r instanceof SELF )
		{
			$this->_Left *= $r->_Left;
			$this->_Top  *= $r->_Top;
			$this->_Right *= $r->_Right;
			$this->_Bottom*= $r->_Bottom;
		}elseif( $r instanceof TPoint )
		{
			$this->_Left *= $r->_x;
			$this->_Top  *= $r->_y;
			$this->_Right*= $r->_x;
			$this->_Bottom*=$r->_y;
		} else 
		{
			$this->_Left *= $r;
			$this->_Top *= $r;
			$this->_Right*= $r;
			$this->_Bottom*=$r;
		}
	}
	public function Divide($r)
	{
		if( $r instanceof SELF )
		{
			$this->_Left /= $r->_Left;
			$this->_Top  /= $r->_Top;
			$this->_Right /= $r->_Right;
			$this->_Bottom/= $r->_Bottom;
		}elseif( $r instanceof TPoint )
		{
			$this->_Left /= $r->_x;
			$this->_Top  /= $r->_y;
			$this->_Right/= $r->_x;
			$this->_Bottom/=$r->_y;
		} else 
		{
			$this->_Left /= $r;
			$this->_Top /= $r;
			$this->_Right/= $r;
			$this->_Bottom/=$r;
		}
	}
	public function Subtract($r)
	{
		if( $r instanceof SELF )
		{
			$this->_Left -= $r->_Left;
			$this->_Top  -= $r->_Top;
			$this->_Right -= $r->_Right;
			$this->_Bottom-= $r->_Bottom;
		}elseif( $r instanceof TPoint )
		{
			$this->_Left -= $r->_x;
			$this->_Top  -= $r->_y;
			$this->_Right-= $r->_x;
			$this->_Bottom-=$r->_y;
		} else 
		{
			$this->_Left -= $r;
			$this->_Top  -= $r;
			$this->_Right-= $r;
			$this->_Bottom-=$r;
		}
	}
	
	//Intersect(TRect)
	//Intersect(TPoint,TPoint)
	public function Union(...$pr)
	{
		if(count($pr)>0)
		{
			if(count($pr)==1&&is_array($pr[0])) $pr = $pr[0];
			foreach($pr as $el)
			{
				if($el instanceof SELF)
				{
					if($el->_Left > $this->_Left) $this->_Left = $el->_Left;
					if($el->_Top > $this->_Top) $this->_Top = $el->_Top;
					if($el->_Right > $this->_Right) $this->_Right = $el->_Right;
					if($el->_Bottom > $this->_Bottom) $this->_Bottom = $el->_Bottom;
				} elseif($el instanceof TPoint)
				{
					if($el->_x < $this->_Left) $this->_Left = $el->_x;
					if($el->_y < $this->_Top) $this->_Top = $el->_y;
					if($el->_x > $this->_Right) $this->_Right = $el->_x;
					if($el->_y > $this->_Bottom) $this->_Bottom = $el->_y;
				} elseif($el instanceof TPolygon)
					$this->Union($el->Points);
			}
		}
	}
	public function Inflate(...$Input)
	{
		switch(Count($Input))
		{
			case 2:
			{
				$this->_Left -= $Input[0];
				$this->_Right += $Input[0];
				$this->_Top -= $Input[1];
				$this->_Bottom += $Input[1];
			}
			break;
			case 4:
			{
				$this->_Left -= $Input[0];
				$this->_Right += $Input[1];
				$this->_Top -= $Input[2];
				$this->_Bottom += $Input[3];
			}
			break;
		}
	}
	public function Split($Side, $ER)
	{
		if( is_float($ER) || is_double($ER) )
			$ER *= 100;
		switch($Side)
		{
			case 1:
			{
				$this->_Left -= $ER;
			}
			break;
			case 2:
			{
				$this->_Top -= $ER;
			}
			break;
			case 3:
			{
				$this->_Right -= $ER;
			}
			break;
			case 4:
			{
				$this->_Bottom -= $ER;/////////////8855961.21
			}
			break;
		}
	}
	public function Intersect(...$Input)
	{
		$this->Union($Input);
	}
	public function isUnite(TRect $R)
	{
		return
			!(
				($this->BottomRight->_x < $R->TopLeft->_x)||
				($this->BottomRight->_y < $R->TopLeft->_y)||
				($R->BottomRight->_x < $this->TopLeft->_x) ||
				($R->BottomRight->_y < $this->TopLeft->_y)
			);
	}
	public function IntersectsWith(TRect $R)
	{
		return $this->isUnite($R);
	}
	//function SplitRect(SplitType: TSplitRectType; Size: Integer): TRect; overload;
    //function SplitRect(SplitType: TSplitRectType; Percent: Double): TRect; overload;
	public function Angle($Center)
	{
		if( $Center instanceof SELF )
		{
			$Center = $Center->CenterPoint();
		} elseif(!($Center instanceof TPoint))
			$Center = $this->CenterPointOriginal;
		return rad2deg(atan2((double)$this->_Left - $Center->_y,(double)$this->_Top - $Center->_x));
	}
	
	public function Rotate($Center, $Angle)
	{
		if($Angle = 0 ) return;
		if( $Center instanceof SELF )
		{
			$Center = $Center->CenterPoint();
		} elseif(!($Center instanceof TPoint))
			$Center = $this->CenterPointOriginal;
		//Convert degrees to radians
		$Angle = deg2rad($Angle);
     // Perform rotation
     $this->_Left =
           ROUND(
                 $Center->_x + ($this->_Left - $Center->_x)* COS($Angle)
                         - ($this->_Top - $Center->_y)* SIN($Angle) );

     $this->_Top =
           ROUND(
                 $Center->_y + ($this->_Left - $Center->_x)* SIN($Angle)
                         + ($this->_Top - $Center->_y)* COS($Angle) );
	
	$this->_Right =
           ROUND(
                 $Center->_x + ($this->_Right - $Center->_x)* COS($Angle)
                         - ($this->_Bottom - $Center->_y)* SIN($Angle) );

     $this->_Right =
           ROUND(
                 $Center->_y + ($this->_Right - $Center->_x)* SIN($Angle)
                         + ($this->_Bottom - $Center->_y)* COS($Angle) );
	}
	public function Distance($R,$DST_TYPE=0)
	{
		if ($R instanceof SELF)
		//Notice: distance for self-instanced objects is calculated by Rectangle center.
		{
			$x = $R->CenterPoint()->_x;
			$y = $R->CenterPoint()->_y;
		} elseif ($R instanceof TPoint)
		{
			$x = $R->x;
			$y = $R->y;
		} else {
			$x = $y = (double)$R;
		}
		switch($DST_TYPE)
		{
			case -1:
			{
				$dx = $this->_Right;
				$dy = $this->_Bottom;
			} break;
			case 0:
			{
				$dx = $this->CenterPoint()->_x;
				$dy = $this->CenterPoint()->_y;
			} break;
			case 1:
			{
				$dx = $this->_Left;
				$dy = $this->_Top;
			}	break;
		}
		return hypot($x - $dx, $y - $dy);
	}

	public function DistancePoint($R,$DST_TYPE=0)
	{
		if ($R instanceof SELF)
		//Notice: distance for self-instanced objects is calculated by Rectangle center.
		{
			$x = $R->CenterPoint()->_x;
			$y = $R->CenterPoint()->_y;
		} elseif ($R instanceof TPoint)
		{
			$x = $R->x;
			$y = $R->y;
		} else {
			$x = $y = (double)$R;
		}
		switch($DST_TYPE)
		{
			case -1:
			{
				$dx = $this->_Right;
				$dy = $this->_Bottom;
			} break;
			case 0:
			{
				$dx = $this->CenterPoint()->_x;
				$dy = $this->CenterPoint()->_y;
			} break;
			case 1:
			{
				$dx = $this->_Left;
				$dy = $this->_Top;
			}	break;
		}
		return new TPoint($x - $dx, $y - $dy);
	}
	
	public function Difference($R)
	{
		if($R instanceof SELF)
		{
			$this->_Left	-= $R->_Left;
			$this->_Top		-= $R->_Top;
			$this->_Right	-= $R->_Right;
			$this->_Bottom	-= $R->_Bottom;
		}elseif($R instanceof TPoint)
		{
			$this->_Left	-= $R->x;
			$this->_Top		-= $R->y;
			$this->_Right	-= $R->x;
			$this->_Bottom	-= $R->y;
		} else {
			$this->_Left	-= (double)$R;
			$this->_Top		-= (double)$R;
			$this->_Right	-= (double)$R;
			$this->_Bottom	-= (double)$R;
		}
	}
	
	public function DifferenceRect($R)
	{
		$Result = clone $this;
		if($R instanceof SELF)
		{
			$Result->_Left	-= $R->_Left;
			$Result->_Top		-= $R->_Top;
			$Result->_Right	-= $R->_Right;
			$Result->_Bottom	-= $R->_Bottom;
		}elseif($R instanceof TPoint)
		{
			$Result->_Left	-= $R->_x;
			$Result->_Top		-= $R->_y;
			$Result->_Right	-= $R->_x;
			$Result->_Bottom	-= $R->_y;
		} else {
			$Result->_Left	-= (double)$R;
			$Result->_Top		-= (double)$R;
			$Result->_Right	-= (double)$R;
			$Result->_Bottom	-= (double)$R;
		}
		return $Result;
	}
	
	public function Bigger(TRect $R)
	{
		return ( $R->_Right + $R->_Bottom > $this->_Right + $this->_Bottom )?$R:$this;
	}
	
	public function Smaller(TRect $R)
	{
		return ( $R->_Right + $R->_Bottom < $this->_Right + $this->_Bottom )?$R:$this;
	}
	
	public function isSmaller(TRect $R)
	{
		return $R->_Right + $R->_Bottom > $this->_Right + $this->_Bottom;
	}
	
	public function isBigger(TRect $R)
	{
		return $R->_Right + $R->_Bottom < $this->_Right + $this->_Bottom;
	}
	
	public function isEqual(TRect $R)
	{
		return ($R->_Right + $R->_Bottom == $this->_Right + $this->_Bottom);
	}
	
	public function Equals(TRect $R)
	{
		return $this->isEqual($pt);
	}
	
	public function Compare(TRect $R)
	{
		if($R->_Right + $R->_Bottom > $this->_Right + $this->_Bottom)
			return -1;
		if($R->_Right + $R->_Bottom < $this->_Right + $this->_Bottom)
			return 1;
		return 0;
	}
	
	public function Flip()
	{
		$this->Normalize();
	}
	
	public function FlippedRect()
	{
		$pt = clone $this;
		$pt->Normalize();
		return $pt;
	}
	
	public function NormalizedRect()
	{
		$pt = clone $this;
		$pt->Normalize();
		return $pt;
	}
	
	public function AutoMirror(TPoint $Sizes)
	{
		$Center = new TPointF($Sizes);
		$Center->DivideDigit(2);
		$Angle = ($Center->isFar($this->CenterPoint()->DifferencePoint($Sizes)))?-180:180;
		$this->Rotate($Sizes, $Angle);
	}
	
	public function Mirror(TPoint $Sizes)
	{
		$this->Rotate($Sizes, 180);
	}
	
	public function Invert()
	{
		$this->_Left	= -$this->_Left;
		$this->_Top		= -$this->_Top;
		$this->_Right	= -$this->_Right;
		$this->_Bottom	= -$this->_Bottom;
	}
	
	public function InCircle(TPoint $Center, $Radius)
	{
		$LT = new TPoint($this->_Left,$this->_Top);
		$LB = new TPoint($this->_Left, $this->_Bottom);
		$RT = new TPoint($this->_Right, $this->_Top);
		$RB = new TPoint($this->_Right, $this->_Bottom);
		return $LT->InCircle($Center,$Radius) && $LB->InCircle($Center,$Radius) && $RT->InCircle($Center,$Radius) && $RB->InCircle($Center,$Radius);
	}
	
	public function InArray($array)
	{
		if(is_array($array))
			foreach( $array as $v )
				if($v instanceof SELF and $v == $this)
					return true;//Sorry, just a small condition - optimization purposes
		return false;
	}
	
	public function InSquare($x,$y,$w,$h)
	{
		return (($this->_x >= $x) and ($this->_x <= $x+$w)) and (($this->_y >= $y) and ($this->_y <= $y+$h)); 
	}
	
	public function Assign(TRect $R)
	{
		$this->_Left	= $R->_Left;
		$this->_Top		= $R->_Top;
		$this->_Right	= $R->_Right;
		$this->_Bottom	= $R->_Bottom;
		$this->CenterPointOriginal = $R->CenterPointOriginal;
	}
	
	public function IsZero()
	{
		return ($this->_Right == 0 and $this->_Top == 0 and $this->_Left == 0 and $this->_Bottom == 0);
	}
	
	public function CenterPoint()
	{
		return new TPoint(($this->_Left+$this->_Right)/2, ($this->_Top+$this->_Bottom)/2);
	}
	
	public function CenteredRect(TRect &$CenteredRect)
	{
		$w = $CenteredRect->Width;
		$h = $CenteredRect->Height;
		$x = ($this->_Right + $this->_Left)/2;
		$y = ($this->_Top + $this->_Bottom)/2;
		$SELF = get_class($this);
		return new $SELF($x-$w/2, $y-$h/2, $x+($w+1)/2, $y+($h+1)/2);
	}
	public function Normalize()
	{
		if ($this->_Left > $this->_Right)
		{
		  $i = $this->_Left;
		  $this->_Left = $this->_Right;
		  $this->_Right = $i;
		}
		if ($this->_Top > $this->_Bottom)
		{
		  $i = $this->_Top;
		  $this->_Top = $this->_Bottom;
		  $this->_Bottom = $i;
		}
	}
	
	public function GetPerimeter()
	{
		return 2 * $this->Height + 2 * $this->Width;
	}
	
	public function GetSquare()
	{
		return $this->Height * $this->Width;
	}
	
	public function GetAngles()
	{
		$lines = $this->GetLines();
		$cnt = count($lines)-1;
		foreach($lines as $i=>$line)
		{
			$angles[] = $line->AngleBetween($lines[($i<$cnt)?$i+1:0]);
		}
		return $angles;
	}
	
	public function GetOutsiderAngles()
	{
		$lines = $this->GetLines();
		$cnt = count($lines)-1;
		foreach($lines as $i=>$line)
		{
			$angles[] = 360-$line->AngleBetween($lines[($i<$cnt)?$i+1:0]);
		}
		return $angles;
	}
	
	public function GetAllAngles()
	{
		$lines = $this->GetLines();
		$cnt = count($lines)-1;
		foreach($lines as $i=>$line)
		{
			$a = $line->AngleBetween($lines[($i<$cnt)?$i+1:0]);
			$angles[] = 360-$a;
			$angles[] = $a;
		}
		return $angles;
	}

	public function GetSides()
	{
		$LT = new TPoint($this->_Left,$this->_Top);
		$LB = new TPoint($this->_Left, $this->_Bottom);
		$RT = new TPoint($this->_Right, $this->_Top);
		$RB = new TPoint($this->_Right, $this->_Bottom);
		return [(int)$LT->Distance($RT), (int)$RT->Distance($RB), (int)$RB->Distance($LB), (int)$LB->Distance($LT)];
	}
	
	public function GetPoints()
	{
		return [ new TPoint($this->_Left,$this->_Top), new TPoint($this->_Right, $this->_Top),
				new TPoint($this->_Right, $this->_Bottom), new TPoint($this->_Left, $this->_Bottom) ];
	}
	
	public function GetLines()
	{
		$LT = new TPoint($this->_Left,$this->_Top);
		$LB = new TPoint($this->_Left, $this->_Bottom);
		$RT = new TPoint($this->_Right, $this->_Top);
		$RB = new TPoint($this->_Right, $this->_Bottom);
		
		return [ new TLine($LT,$RT), new TLine($RT,$RB), new TLine($RB,$LB), new Tline($LB,$LT) ];
	}
	
	public function GetPolygon()
	{
		return new TPolygon($this->GetPoints());
	}
	
	public function GetHeight()
	{
		$LT = new TPointF($this->_Left,$this->_Top);
		$LB = new TPointF($this->_Left, $this->_Bottom);
		return $LT->Distance($LB);
	}
	
	public function GetWidth()
	{
		$LT = new TPointF($this->_Left,$this->_Top);
		$RT = new TPointF($this->_Right, $this->_Top);
		return $LT->Distance($RT);
	}

	public function __set($nm,$v)
	{
		switch(strtolower($nm))
		{
			case '0':
			case 'x':
			case 'x1':
			case 'left':
			$this->_Left = $v;
			case '1':
			case 'x2':
			case 'right':
			$this->_Right = $v;
			case '2':
			case 'y':
			case 'y1':
			case 'top':
			$this->_Top = $v;
			case '3':
			case 'y2':
			case 'bottom':
			$this->_Bottom = $v;
			case 'topleft':
			{
				$this->_Top = $v->y;
				$this->_Left = $v->x;
			}
			break;
			case 'bottomright':
			{
				$this->_Bottom = $v->y;
				$this->_Right = $v->x;
			}
			break;
			break;
			case 'w':
			case 'width':
			$this->_Right = $this->_Left + $v;
			case 'h':
			case 'height':
			$this->_Bottom = $this->_Top + $v;
			case 'size':
			{
				$this->_Right = $this->_Left + $v->Width;
				$this->_Bottom = $this->_Top + $v->Height;
			} break;
		}
	}
	
	public function __get($nm)
	{
		switch(strtolower($nm))
		{
			case '0':
			case 'x':
			case 'x1':
			case 'left':
			return (int)$this->_Left;
			case '1':
			case 'x2':
			case 'right':
			return (int)$this->_Right;
			case '2':
			case 'y':
			case 'y1':
			case 'top':
			return (int)$this->_Top;
			case '3':
			case 'y2':
			case 'bottom':
			return (int)$this->_Bottom;
			case 'topleft':
			{
				return new TPoint($this->_Left,$this->_Top);
			}
			break;
			case 'bottomright':
			{
				return new TPoint($this->_Right,$this->_Bottom);
			}
			break;
			case 'w':
			case 'width':
			return (int)$this->GetWidth();
			case 'h':
			case 'height':
			return (int)$this->GetHeight();
			case 'isempty': return $this->IsEmpty();
			case 'iszero': return $this->IsZero();
			case 'sizes':
			case 'size': return new TPoint($this->_Right - $this->_Left, $this->_Bottom - $this->_Top);
			case 'position':
			case 'location': return new TPoint($this->_Left,$this->_Top);
			case 'p': 
			case 'perimeter': return (int) $this->GetPerimeter();
			case 's':
			case 'square': return (int) $this->GetSquare();
			case 'angles':
			return $this->GetAngles();
			case 'allangles':
			return $this->GetAllAngles();
			case 'outsiderangles':
			return $this->GetOutsiderAngles();
			case 'sides':
			return $this->GetSides();
		}
	}
	
	public function offsetSet($offset, $v)
	{
        $this->$offset = $v;
    }

    public function offsetExists($offset)
	{
        return in_array(strtolower($offset),
		['0','x','x1','left','1','x2','right','2','y','y1','top','3','y2','bottom','position',
		'topleft','bottomright','w','width','h','height','isempty','iszero','sizes','location',
		'size','p', 's', 'perimeter', 'square', 'angles', 'allangles', 'outsiderangles','sides']);
    }
	
	public function __isset($n)
	{
		return $this->offsetExists($n);
	}

    public function offsetUnset($offset) 
	{
		$this->$offset = 0;
    }

    public function offsetGet($offset)
	{
       return $this->$offset;
    }
	public function __ToString()
	{
		return get_class($this)."=>[{$this->Left},{$this->Top},{$this->Right},{$this->Bottom}]";
	}
}

class TRectF Extends TRect
{
	#public double $left
    #public double $top
    #public double $right
    #public double $bottom
	#public TPointF $TopLeft
	#public TPointF $BottomRight
	#public TPointF $Location
	#public TPointF $Position
	#public TPointF $Size
	public function DistancePoint($R,$DST_TYPE=0)
	{
		if ($R instanceof SELF)
		//Notice: distance for self-instanced objects is calculated by Rectangle center.
		{
			$x = $R->CenterPoint()->_x;
			$y = $R->CenterPoint()->_y;
		} elseif ($R instanceof TPoint)
		{
			$x = $R->_x;
			$y = $R->_y;
		} else {
			$x = $y = (double)$R;
		}
		switch($DST_TYPE)
		{
			case -1:
			{
				$dx = $this->_Right;
				$dy = $this->_Bottom;
			} break;
			case 0:
			{
				$dx = $this->CenterPoint()->_x;
				$dy = $this->CenterPoint()->_y;
			} break;
			case 1:
			{
				$dx = $this->_Left;
				$dy = $this->_Top;
			}	break;
		}
		return new TPointF($x - $dx, $y - $dy);
	}
	public function InCircle(TPoint $Center, $Radius)
	{
		$LT = new TPointF($this->_Left,$this->_Top);
		$LB = new TPointF($this->_Left, $this->_Bottom);
		$RT = new TPointF($this->_Right, $this->_Top);
		$RB = new TPointF($this->_Right, $this->_Bottom);
		return $LT->InCircle($Center,$Radius) && $LB->InCircle($Center,$Radius) && $RT->InCircle($Center,$Radius) && $RB->InCircle($Center,$Radius);
	}
	
	public function CenterPoint()
	{
		return new TPointF(($this->_Left+$this->_Right)/2, ($this->_Top+$this->_Bottom)/2);
	}
	
	public function __get($nm)
	{
		switch(strtolower($nm))
		{
			case '0':
			case 'x':
			case 'x1':
			case 'left':
			return (double)$this->_Left;
			case '1':
			case 'x2':
			case 'right':
			return (double)$this->_Right;
			case '2':
			case 'y':
			case 'y1':
			case 'top':
			return (double)$this->_Top;
			case '3':
			case 'y2':
			case 'bottom':
			return (double)$this->_Bottom;
			case 'topleft':
			{
				return new TPointF($this->_Left,$this->_Top);
			}
			break;
			case 'bottomright':
			{
				return new TPointF($this->_Right,$this->_Bottom);
			}
			break;
			case 'w':
			case 'width':
			return (double)$this->GetWidth();
			case 'h':
			case 'height':
			return (double)$this->GetHeight();
			case 'isempty': return $this->IsEmpty();
			case 'iszero': return $this->IsZero();
			case 'sizes':
			case 'size': return new TPointF($this->_Right - $this->_Left, $this->_Bottom - $this->_Top);
			case 'position':
			case 'location': return new TPointF($this->_Left,$this->_Top);
			case 'p': 
			case 'perimeter': return (double) $this->GetPerimeter();
			case 's':
			case 'square': return (double) $this->GetSquare();
			case 'angles':
			return $this->GetAngles();
			case 'allangles':
			return $this->GetAllAngles();
			case 'outsiderangles':
			return $this->GetOutsiderAngles();
			case 'sides':
			return $this->GetSides();
		}
	}
}

class TPolygon
{
	#public TRect $Rect;
	public $Points;
	private $Open = false;
	public function __construct($arr=[])
	{
		$this->Points = $arr;
	}
	
	public function Open()
	{
		if(!$this->Open && $this->Points[ count($this->Points)-1 ] !== $this->Points[0])
		{
			$this->Points[] = $this->Points[0];
		}
		$this->Open = true;
	}
	
	public function Close()
	{
		if($this->Open && $this->Points[ count($this->Points)-1 ] == $this->Points[0])
			unset($this->Points[ count($this->Points)-1 ]);
		$this->Open = false;
	}
	
	public function GetCenterPoint()
	{
		$n = 0;
		$res = new TPoint();
		$cnt = count($this->Points);
		for($i=0;$i<$cnt;$i++)
		{
			$res->_x += $this->Points[$i]->_x;
			$res->_y += $this->Points[$i]->_y;
		}
		$res->_x /= $cnt;
		$res->_y /= $cnt;
		return $res;
	}
	
	public function PtInside(TPoint $pt)
	{
		return in_array($pt, $this->Points);
	}
	
	public function PtInSquare(TPoint $pt)
	//with content
	{
		
	}
	
	public function PtInTransientSquare(TPoint $pt)
	//without content
	{
		
	}
	
	public function Contains($p)
	{
	}
	
	public function GetRect()
	{
		if( empty($this->Points) ) return new TRect(0,0,0,0);
				$max = clone $this->Points[0];
				$min = clone $this->Points[0];
				foreach($this->Points as $point)//here we go...
				{
					if($point->_x > $max->_x)
						$max->_x = $point->_x;
					if($point->_y > $max->_y)
						$max->_y = $point->_y;
					if($point->_y < $min->_y)
						$min->_y = $point->_y;
					if($point->_x < $min->_x)
						$min->_x = $point->_x;
				}
				$max->Subtract($min);//here we arrive
		return new TRect($min,$max);
	}
	
	public function __set($nm,$v)
	{
		switch(strtolower($nm))
		{
			case 'highpoint':
			{
				if( empty($this->Points) ) return new TPoint();
				$max = clone $this->Points[0];
				foreach($this->Points as $id=>$point)//here we go...
				{
					if($point->_x > $max->_x||$point->_y > $max->_y)
					{
						$max->_x = $point->_x;
						$max->_y = $point->_y;
						$idx = $id;
					}
				}
				$this->Points[$idx] = $v;
			} break;
			
			case 'lowpoint':
			{
				if( empty($this->Points) ) return new TPoint();
				$min = clone $this->Points[0];
				foreach($this->Points as $id=>$point)//here we go...
				{
					if($point->_x < $min->_x||$point->_y < $min->_y)
					{
						$min->_y = $point->_y;
						$min->_x = $point->_x;
						$idx = $id;
					}
				}
				$this->Points[$idx] = $v;
			} break;
			
			case 'open':
				if($v)
					$this->Open();
				else
					$this->Close();
		}
	}
	
	public function __get($nm)
	{
		switch(strtolower($nm))
		{
			
			case 'rect':
			return $this->GetRect();
			
			case 'highpoint':
			{
				if( empty($this->Points) ) return new TPoint();
				$max = clone $this->Points[0];
				foreach($this->Points as $point)//here we go...
				{
					if($point->_x > $max->_x||$point->_y > $max->_y)
					{
						$max->_x = $point->_x;
						$max->_y = $point->_y;
					}
				}
				return $max;
			} break;
			
			case 'lowpoint':
			{
				if( empty($this->Points) ) return new TPoint();
				$min = clone $this->Points[0];
				foreach($this->Points as $point)//here we go...
				{
					if($point->_x < $min->_x||$point->_y < $min->_y)
					{
						$min->_y = $point->_y;
						$min->_x = $point->_x;
					}
				}
				return $min;
			} break;
			
			case 'open':
				return $this->Open;
		}
	}
}


///////////////////////////////////////////////////////////////////////////////
///                            Sample functions                             ///
///					Use it for creating Geometry Shapes 					///
///////////////////////////////////////////////////////////////////////////////
function rect($left,$top,$right,$bottom)
{
    return new TRect($left,$top,$right,$bottom);
}

function rectf($left,$top,$right,$bottom)
{
    return new TRectF($left,$top,$right,$bottom);
}

function point($x,$y)
{
    return new TPoint($x,$y);
}

function pointf($x,$y)
{
    return new TPointF($x,$y);
}