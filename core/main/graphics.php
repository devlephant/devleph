<?
/*

  PHP4Delphi Graphics Library

  2018 ver 3.1

*/
global $_c;
$_c->setConstList(['bsSolid', 'bsClear', 'bsHorizontal', 'bsVertical',
    'bsFDiagonal', 'bsBDiagonal', 'bsCross', 'bsDiagCross'], 'TBrushStyle');

$_c->setConstList(['pmBlack', 'pmWhite', 'pmNop', 'pmNot', 'pmCopy', 'pmNotCopy',
    'pmMergePenNot', 'pmMaskPenNot', 'pmMergeNotPen', 'pmMaskNotPen', 'pmMerge',
    'pmNotMerge', 'pmMask', 'pmNotMask', 'pmXor', 'pmNotXor'],'TPenMode');
$_c->setConstList(['psSolid', 'psDash', 'psDot', 'psDashDot', 'psDashDotDot', 'psClear',
    'psInsideFrame', 'psUserStyle', 'psAlternate'],'TPenStyle');

$_c->setConstList(array_keys(gui_get_recordinfo('TShape', 'Shape')),'TShapeType');
$_c->setConstList(
				["htrError", "htrTransparent", "htrNowhere",
				"htrClient","htrCaption", "htrSystemMenu",
				"htrSizingHandle", "htrMenu", "htrHorzScroll",
				"htrVertScroll", "htrMinReduceBtn", "htrMaxZoomBtn",
				"htrLeftOrSizeFirst", "htrRight", "htrTop",
				"htrTopLeft", "htrTopRight", "htrBottom",
				"htrBottomLeft", "htrBottomRightOrSizeLast", "htrBorder",
				"htrObject", "htrClose", "htrHelp"],
				 "HitResult",
				-2
				);

  $_c->COLOR_SCROLLBAR = 0;
  $_c->COLOR_BACKGROUND = 1;
  $_c->COLOR_ACTIVECAPTION = 2;
  $_c->COLOR_INACTIVECAPTION = 3;
  $_c->COLOR_MENU = 4;
  $_c->COLOR_WINDOW = 5;
  $_c->COLOR_WINDOWFRAME = 6;
  $_c->COLOR_MENUTEXT = 7;
  $_c->COLOR_WINDOWTEXT = 8;
  $_c->COLOR_CAPTIONTEXT = 9;
  $_c->COLOR_ACTIVEBORDER = 10;
  $_c->COLOR_INACTIVEBORDER = 11;
  $_c->COLOR_APPWORKSPACE = 12;
  $_c->COLOR_HIGHLIGHT = 13;
  $_c->COLOR_HIGHLIGHTTEXT = 14;
  $_c->COLOR_BTNFACE = 15;
  $_c->COLOR_BTNSHADOW = 0x10;
  $_c->COLOR_GRAYTEXT = 17;
  $_c->COLOR_BTNTEXT = 18;
  $_c->COLOR_INACTIVECAPTIONTEXT = 19;
  $_c->COLOR_BTNHIGHLIGHT = 20;

  $_c->COLOR_3DDKSHADOW = 21;
  $_c->COLOR_3DLIGHT = 22;
  $_c->COLOR_INFOTEXT = 23;
  $_c->COLOR_INFOBK = 24;

  $_c->COLOR_HOTLIGHT = 26;
  $_c->COLOR_GRADIENTACTIVECAPTION = 27;
  $_c->COLOR_GRADIENTINACTIVECAPTION = 28;

  $_c->COLOR_MENUHILIGHT = 29;
  $_c->COLOR_MENUBAR = 30;

  $_c->COLOR_ENDCOLORS = COLOR_MENUBAR;

  $_c->COLOR_DESKTOP = COLOR_BACKGROUND;
  $_c->COLOR_3DFACE = COLOR_BTNFACE;
  $_c->COLOR_3DSHADOW = COLOR_BTNSHADOW;
  $_c->COLOR_3DHIGHLIGHT = COLOR_BTNHIGHLIGHT;
  $_c->COLOR_3DHILIGHT = COLOR_BTNHIGHLIGHT;
  $_c->COLOR_BTNHILIGHT = COLOR_BTNHIGHLIGHT;


  $_c->clSystemColor = 0xFF000000;

  $_c->clScrollBar = clSystemColor | COLOR_SCROLLBAR;
  $_c->clBackground = clSystemColor | COLOR_BACKGROUND;
  $_c->clActiveCaption = clSystemColor | COLOR_ACTIVECAPTION;
  $_c->clInactiveCaption = clSystemColor | COLOR_INACTIVECAPTION;
  $_c->clMenu = clSystemColor | COLOR_MENU;
  $_c->clWindow = clSystemColor | COLOR_WINDOW;
  $_c->clWindowFrame = clSystemColor | COLOR_WINDOWFRAME;
  $_c->clMenuText = clSystemColor | COLOR_MENUTEXT;
  $_c->clWindowText = clSystemColor | COLOR_WINDOWTEXT;
  $_c->clCaptionText = clSystemColor | COLOR_CAPTIONTEXT;
  $_c->clActiveBorder = clSystemColor | COLOR_ACTIVEBORDER;
  $_c->clInactiveBorder = clSystemColor | COLOR_INACTIVEBORDER;
  $_c->clAppWorkSpace = clSystemColor | COLOR_APPWORKSPACE;
  $_c->clHighlight = clSystemColor | COLOR_HIGHLIGHT;
  $_c->clHighlightText = clSystemColor | COLOR_HIGHLIGHTTEXT;
  $_c->clBtnFace = clSystemColor | COLOR_BTNFACE;
  $_c->clBtnShadow = clSystemColor | COLOR_BTNSHADOW;
  $_c->clGrayText = clSystemColor | COLOR_GRAYTEXT;
  $_c->clBtnText = clSystemColor | COLOR_BTNTEXT;
  $_c->clInactiveCaptionText = clSystemColor | COLOR_INACTIVECAPTIONTEXT;
  $_c->clBtnHighlight = clSystemColor | COLOR_BTNHIGHLIGHT;
  $_c->cl3DDkShadow = clSystemColor | COLOR_3DDKSHADOW;
  $_c->cl3DLight = clSystemColor | COLOR_3DLIGHT;
  $_c->clInfoText = clSystemColor | COLOR_INFOTEXT;
  $_c->clInfoBk = clSystemColor | COLOR_INFOBK;
  $_c->clHotLight = clSystemColor | COLOR_HOTLIGHT;
  $_c->clGradientActiveCaption = clSystemColor | COLOR_GRADIENTACTIVECAPTION;
  $_c->clGradientInactiveCaption = clSystemColor | COLOR_GRADIENTINACTIVECAPTION;
  $_c->clMenuHighlight = clSystemColor | COLOR_MENUHILIGHT;
  $_c->clMenuBar = clSystemColor | COLOR_MENUBAR;

  $_c->clBlack = 0x000000;
  $_c->clMaroon = 0x000080;
  $_c->clGreen = 0x008000;
  $_c->clOlive = 0x008080;
  $_c->clNavy = 0x800000;
  $_c->clPurple = 0x800080;
  $_c->clTeal = 0x808000;
  $_c->clGray = 0x808080;
  $_c->clSilver = 0xC0C0C0;
  $_c->clRed = 0x0000FF;
  $_c->clLime = 0x00FF00;
  $_c->clYellow = 0x00FFFF;
  $_c->clBlue = 0xFF0000;
  $_c->clFuchsia = 0xFF00FF;
  $_c->clAqua = 0xFFFF00;
  $_c->clLtGray = 0xC0C0C0;
  $_c->clDkGray = 0x808080;
  $_c->clWhite = 0xFFFFFF;
  $_c->StandardColorsCount = 16;

  $_c->clMoneyGreen = 0xC0DCC0;
  $_c->clSkyBlue = 0xF0CAA6;
  $_c->clCream = 0xF0FBFF;
  $_c->clMedGray = 0xA4A0A0;
  $_c->ExtendedColorsCount = 4;

  $_c->clNone = 0x1FFFFFFF;
  $_c->clDefault = 0x20000000;


///////////////////////////////////////////////////////////////////////////////
///                             TPoint                                      ///
///	Main graphical position class, which  stores x, y integer values		///
//	Used for Windows API (WinAPI for short) only							///
///////////////////////////////////////////////////////////////////////////////
class TPoint implements ArrayAccess
{
	#public int $x
	#public int $y
	public $OrigX;
	public $OrigY;
    protected $_x;
	protected $_y;

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
		return rad2deg(atan2((double)$this->_y - $pt->_y,(double)$this->_x - $pt->_x));
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
		return hypot($pt->_x - $this->_x, $pt->_y - $this->_y);
	}
	
	public function DistancePoint(TPoint $pt)
	{
		return new TPoint($pt->_x - $this->_x, $pt->_y - $this->_y);
	}
	
	public function Difference(TPoint $pt)
	{
		return hypot($this->_x - $pt->_x, $this->_y - $pt->_y);
	}
	
	public function DifferencePoint(TPoint $pt)
	{
		return new TPoint($this->_x - $pt->_x, $this->_y - $pt->_y);
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
		//0, 5, 10
		//0=>10
		$Center = new TPointF($Sizes); //Центр
		$Center->DivideDigit(2);
		$Angle = ($Center->isFar($this->DifferencePoint($Sizes)))?-180:180; //Если точка удалена от центра направо, вращаем влево, иначе вправо
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
			case 'left': return (integer)$this->_x;
			case 'y':
			case 'height':
			case 'h':
			case '1':
			case 'top': return (integer)$this->_y;
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
		return get_class($this)."=>[{$this->x},{$this->y}]";//вот таким хитрым образом это не надо перезаписывать для TFloatPoint
	}
}

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
	
	public function __get($n)
	{
		switch(strtolower($n))
		{
			case 'x':
			case 'width':
			case 'w':
			case '0':
			case 'left': return (double)$this->_x;
			case 'y':
			case 'height':
			case 'h':
			case '1':
			case 'top': return (double)$this->_y;
			case 'iszero': case 'isempty': return $this->IsZero();
			case 's': case 'square':
			return (double) $this->GetSquare();
			case 'p': case 'perimeter':
			return (double) $this->GetPerimeter();
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

///////////////////////////////////////////////////////////////////////////////
///                             TRect                                       ///
///	Rectangle data storage - position and sizes (height, width)				///
///	Used both by WinAPI and VCL framework									///
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
		switch( count($p) ) //вот чего стоит удобство программирования...
		{
			case 1:
			{
				if($p[0] instanceof SELF)
				{
					$this->Assign($p[0]);
				} elseif($p[0] instanceof TPoint)
				{
					$this->_Left = $p[0]->x;
					$this->_Top 	= $p[0]->y;
					$this->_Right = 0;
					$this->_Bottom = 0;
				}					
			} break;
			case 2:
			{
				if(($p[0] instanceof TPoint) && ($p[1] instanceof TPoint))
				{
					$this->_Left = $p[0]->x;
					$this->_Top 	= $p[0]->y;
					$this->_Right = $p[1]->x;
					$this->_Bottom = $p[1]->y;
				} elseif($p[0] instanceof TPoint) {
					$this->_Left = $p[0]->x;
					$this->_Top 	= $p[0]->y;
					$this->_Right = $p[1];
					$this->_Bottom = 0;
				} elseif ($p[1] instanceof TPoint) {
					$this->_Left = $p[0];
					$this->_Top 	= 0;
					$this->_Right = $p[1]->x;
					$this->_Bottom = $p[1]->y;
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
					$this->_Left		= $p[0]->x;
					$this->_Top		= $p[0]->y;
					$this->_Right	= $p[1]->x;
					$this->_Bottom	= $p[1]->x;
					if($p[2])
						$this->Normalize();
				} elseif($p[0] instanceof TPoint)
				{
					$this->_Left = $p[0]->x;
					$this->_Top = $p[0]->y;
					$this->_Right = $p[1];
					$this->_Bottom = $p[2];
				} elseif($p[2] instanceof TPoint) {
					$this->_Left = $p[0];
					$this->_Top = $p[1];
					$this->_Right = $p[2]->x;
					$this->_Bottom = $p[2]->y;
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
			$this->_Left += $r->x;
			$this->_Top += $r->y;
			$this->_Right+= $r->x;
			$this->_Bottom+=$r->y;
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
			$this->_Left *= $r->x;
			$this->_Top  *= $r->y;
			$this->_Right*= $r->x;
			$this->_Bottom*=$r->y;
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
			$this->_Left /= $r->x;
			$this->_Top  /= $r->y;
			$this->_Right/= $r->x;
			$this->_Bottom/=$r->y;
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
			$this->_Left -= $r->x;
			$this->_Top  -= $r->y;
			$this->_Right-= $r->x;
			$this->_Bottom-=$r->y;
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
					if($el->x < $this->_Left) $this->_Left = $el->x;
					if($el->y < $this->_Top) $this->_Top = $el->y;
					if($el->x > $this->_Right) $this->_Right = $el->x;
					if($el->y > $this->_Bottom) $this->_Bottom = $el->y;
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
		//case(gettype($ER))
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
				($this->BottomRight->x < $R->TopLeft->x)||
				($this->BottomRight->y < $R->TopLeft->y)||
				($R->BottomRight->x < $this->TopLeft->x) ||
				($R->BottomRight->y < $this->TopLeft->y)
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
		return rad2deg(atan2((double)$this->_Left - $Center->y,(double)$this->_Top - $Center->x));
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
                 $Center->x + ($this->_Left - $Center->x)* COS($Angle)
                         - ($this->_Top - $Center->y)* SIN($Angle) );

     $this->_Top =
           ROUND(
                 $Center->y + ($this->_Left - $Center->x)* SIN($Angle)
                         + ($this->_Top - $Center->y)* COS($Angle) );
	
	$this->_Right =
           ROUND(
                 $Center->x + ($this->_Right - $Center->x)* COS($Angle)
                         - ($this->_Bottom - $Center->y)* SIN($Angle) );

     $this->_Right =
           ROUND(
                 $Center->y + ($this->_Right - $Center->x)* SIN($Angle)
                         + ($this->_Bottom - $Center->y)* COS($Angle) );
	}
	public function Distance($R,$DST_TYPE=0)
	{
		if ($R instanceof SELF)
		//Notice: distance for self-instanced objects is calculated by Rectangle center.
		{
			$x = $R->CenterPoint()->x;
			$y = $R->CenterPoint()->y;
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
				$dx = $this->CenterPoint()->x;
				$dy = $this->CenterPoint()->y;
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
			$x = $R->CenterPoint()->x;
			$y = $R->CenterPoint()->y;
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
				$dx = $this->CenterPoint()->x;
				$dy = $this->CenterPoint()->y;
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
			$Result->_Left	-= $R->x;
			$Result->_Top		-= $R->y;
			$Result->_Right	-= $R->x;
			$Result->_Bottom	-= $R->y;
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
		//0, 5, 10
		//0=>10
		$Center = new TPointF($Sizes); //Центр
		$Center->DivideDigit(2);
		$Angle = ($Center->isFar($this->CenterPoint()->DifferencePoint($Sizes)))?-180:180; //Если точка удалена от центра направо, вращаем влево, иначе вправо
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
		foreach($this->Sides as $side)
		{
			
		}
	}
	
	public function GetOutsiderAngles()
	{
		
	}
	
	public function GetAllAngles()
	{
		
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
			$x = $R->CenterPoint()->x;
			$y = $R->CenterPoint()->y;
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
				$dx = $this->CenterPoint()->x;
				$dy = $this->CenterPoint()->y;
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
class TLine// implements ArrayAccess
{
	public $Start;
	public $End;
	public function __construct(...$P)
	{
		Switch(Count($P))
		{
			Case 0: {$this->Start = $this->End = new TPoint();} break;
			Case 1: {$this->Start = $this->End = $P[0];} 	break;
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
	public function CrossPoint($R)
	{
		if( $R instanceof TRect )
		{
			
		} elseif ($R instanceof SELF ) 
		{
			
		} elseif ($R instanceof TPoint )
		{
			
		}
	}
}

class TLineF extends TLine {}

class TPolygon
{
	#public TRect $Rect;
	public $Points;
	public function __construct($arr=[])
	{
		$this->Points = $arr;
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
	
	public function __get($nm)
	{
		switch(strtolower($nm))
		{
			
			case 'rect':
			{
				if( empty($this->Points) ) return new TRect(0,0,0,0);
				$max = clone $this->Points[0];
				$min = clone $this->Points[0];
				foreach($this->Points as $point)//here we go...
				{
					if($point->x > $max->x)
						$max->x = $point->x;
					if($point->y > $max->y)
						$max->y = $point->y;
					if($point->y < $min->y)
						$min->y = $point->y;
					if($point->x < $min->x)
						$min->x = $point->x;
				}
				$max->Subtract($min);//here we arrive
				return new TRect($min,$max);
			}
			break;
		}
	}
}

function rect($left,$top,$right,$bottom)
{
    return new TRect($left,$top,$right,$bottom);
}

function rectf()
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
///////////////////////////////////////////////////////////////////////////////
///                             TPen, TBrush                                ///
///	I do not really want to explain you this things							///
///////////////////////////////////////////////////////////////////////////////
class TPen extends TComponent
{
    public $self;
}

class TBrush extends TComponent
{
    public $self;
}


///////////////////////////////////////////////////////////////////////////////
///                             TCanvas                                     ///
///////////////////////////////////////////////////////////////////////////////
class TCanvas extends TControl
{
	function line($x1, $y1, $x2, $y2)
	{
		$this->moveTo($x1,$y1);
		$this->lineTo($x2, $y2);
	}
    function pixel($x, $y, $color = null)
	{
		if ($color === null)
			return canvas_pixel($this->self, (int)$x, (int)$y, null);
		else
			canvas_pixel($this->self, (int)$x, (int)$y, $color);
    }

    function drawBitmap(TBitmap $bmp, $x = 0, $y = 0){

	canvas_drawBitmap($this->self, $bmp->self, $x, $y);
    }

    function drawPicture($fileName, $x = 0, $y = 0){

		$b = new TBitmap;
		$b->loadAnyFile($fileName);
		$this->drawBitmap($b, $x, $y);
		$b->free();
    }

    // вывод текста под углом
    function textOutAngle($x, $y, $angle, $text){
		$n = $this->TextAngle;
		$this->TextAngle = $angle;
		$this->textOut($x, $y, $text);
		$this->TextAngle = $n;
    }

    function set_TextAngle($v)
	{
		$this->Font->Orientation = ceil($v) * 10;
	}

	function get_TextAngle()
	{
		return ceil($this->Font->Orientation / 10);
	}

	function TextOutRope($x1,$y1,$x2,$y2,$text)
	{
		$n = $this->Brush->Style;
		$this->Brush->Style = 1;
		$textW = $this->TextWidth($text);
		$textH = $this->TextHeight($text);
		$Margin = $textW + (ceil($textH/10)*floor($textW/10)-1);
		$p1 = max($x1,$y1);
		$p2 = $x2*$y2;
		//делим площадь компонента + 2 отступа, на площадь 1 участка текста + отступ
		//т.к нам не нужен отступ в конце и в начале
		$steps= ($p2+($Margin*$Margin*2))/($textW*$textH+$Margin*$Margin);
		//при симметрии угол равен 45, т.е 4.5
		$angle = $angle*2 + 6; //разбежность в две стороны с коэф. отклонения 3
		for($iter=1;$iter-1<$steps;$iter++)
		foreach([$p1=>$angle*10,$p1+3=>$angle] as $ier=>$int)
		{
			$this->TextOutAngle($ier+$iter*$Margin*2,$ier+$iter*$Margin*2, $int, $text);
			$this->TextOutAngle($ier+$iter*$Margin*2 - $Margin,$ier+$iter*$Margin*2 - $Margin,-$int,$text);
		}
		$this->Brush->Style = $n;
	}

    function writeBitmap(TBitmap $bitmap){

		canvas_writeBitmap($this->self, $bitmap->self);
    }

    function savePicture($filename){

		$b = new TBitmap;
		$this->writeBitmap($b);
		$b->saveToFile($filename);
		$b->free();
    }

    function saveFile($filename){
		$this->savePicture($filename);
    }

    function loadPicture($filename){
		$this->drawPicture(getFileName($filename));
    }

    function loadFile($filename){
		$this->drawPicture($filename);
    }
}
class TBitmapCanvas extends TCanvas{}
class TMetafileCanvas extends TCanvas{}
$_c->fsBold      = 'fsBold';
$_c->fsItalic    = 'fsItalic';
$_c->fsUnderline = 'fsUnderline';
$_c->fsStrikeOut = 'fsStrikeOut';

class TControlCanvas extends TCanvas
{
    function __construct($owner=nil,$init=true,$self=nil)
	{
		parent::__construct($owner,$init,is_object($self)?$self->self:(int)$self);
		if(is_object($owner))
			$this->Control = $owner;
    }
    function free(){
        if ($this->self)
            obj_free($this->self);
    }
}

function canvas($ctrl = false){

    return new TControlCanvas($ctrl);
}
class TGraphic extends TControl
{

	function Assign($v)
	{
		if( $v->self == $this->self ) return;
		if ($v instanceof TPicture)
			$this->assign($v->getBitmap());
		else
			tpersistent_assign($this->self, $v->self);
	}
	function get_Empty()
	{
		return tgraphic_prop($this->self, 1);
	}
	function get_Height()
	{
		return tgraphic_prop($this->self, 2);
	}
	function get_Modified()
	{
		return tgraphic_prop($this->self, 3);
	}
	function get_Palette()
	{
		return tgraphic_prop($this->self, 4);
	}
	function get_PaletteModified()
	{
		return tgraphic_prop($this->self, 5);
	}
	function get_Transparent()
	{
		return tgraphic_prop($this->self, 6);
	}
	function get_Width()
	{
		return tgraphic_prop($this->self, 7);
	}
	function get_SupportsPartialTransparency()
	{
		return tgraphic_prop($this->self, 8);
	}
}
class TBitmap extends TGraphic{


    public $parent_object = nil;

    public function __construct($owner=nil, $init=true, $self=nil){
        if($self!==nil){
			$this->self = $self;

		}elseif ($init)
            $this->self = tbitmap_create();
		if($owner!==nil)
			$this->owner = $owner;
    }

    public function loadFromFile($filename){

		$filename = replaceSr(getFileName($filename));

		if (fileExt($filename)=='bmp'){
			bitmap_loadfile($this->self,$filename);
		} else {

			convert_file_to_bmp($filename, $this->self);
		}
    }

    public function saveToFile($filename){
		$filename = replaceSr($filename);
        bitmap_savefile($this->self,replaceSr($filename));
    }

    // загрузка любых форматов....
    public function loadAnyFile($filename){

		$filename = replaceSr(getFileName($filename));
		convert_file_to_bmp($filename, $this->self);
    }

    public function loadFileWithBorder($filename, $border = 1){

        $filename = replaceSr(getFileName($filename));
		convert_file_to_bmp_border($filename, $this->self, $border);
    }

    public function loadFromStream($stream){
		picture_loadstream($this->self, $stream->self);
    }

    public function saveToStream($stream){
		picture_loadstream($this->self, $stream->self);
    }

	public function loadFromStr($str){
		bitmap_loadstr($this->self, $str);
	}

	public function saveToStr(&$str){
		$str = bitmap_savestr($this->self);
	}

    public function copyToClipboard(){
        clipboard_assign( $this->self );
    }

    public function clear(){
		$this->assign(null);
    }

    public function isEmpty(){
		return !bitmap_empty($this->self);
    }

	public function get_Canvas(){
		return new TCanvas($this,false,bitmap_canvas($this->self));;
	}

	public function setSizes($width, $height){
		bitmap_size($this->self, $width, $height);
	}
}
class TIcon extends TGraphic{

    function __construct($owner=nil,$init=true,$self=nil){
        if ($init && !$self){
            $this->self = ticon_create();
		} else {
			if($self)	$this->self = $self;
		}
    }

    function loadAnyFile($filename){
		$this->loadFromFile($filename);
    }

	function saveToStr(&$str){
		$str = $this->data;
    }

	function loadFromStr($data, $format = 'bmp'){
        $bitmap = new TBitmap(nil,false);
        picture_loadstr($bitmap->self, $data, $format);
		icon_assign($this->self, $bitmap->self);
    }

    function assign($v){
		if($v->self == $this->self) return;

		if ($v instanceof TBitmap)
		{
			icon_assign($this->self, $v->self);
		} else {
				tpersistent_assign($this->self,
				($v instanceof TPicture)?$v->getBitmap()->self:$v->self);
		}
    }

    function isEmpty(){

		return icon_empty($this->self);
    }


    public function copyToClipboard(){

            clipboard_assign( $this->self );
    }

	public function pasteFromClipboard(){
           icon_assign($this->self, clipboard_get());
    }

	public function clear(){
		$this->self = null;
	}

}

class TSVGGraphic	extends TGraphic{}
class TPNGImage		extends TGraphic{}
class TGIFImage 	extends TGraphic{}
class TJPEGImage 	extends TGraphic{}
class TWICImage 	extends TGraphic{}
class TPicture extends TControl{


    public $parent_object = nil;

    function __construct($init=true, $owner=nil, $self=nil){
        if ($init)
			if( $self && $self !== nil )
				$this->self = $self;
			else
				$this->self = tpicture_create();

			if($owner && $owner !== nil)
				$this->owner = $owner;
	}
    function get_Graphic()
	{
		 return _c(picture_getgraphic($this->self));
	}
	function set_Graphic(TGraphic $v)
	{
		if( picture_getgraphic($this->self) )
			_c(picture_getgraphic($this->self))->Assign($v);
		else
			gui_propset($this->self, 'graphic', $v->self);
	}
    function loadAnyFile($filename){
		$this->loadFromFile($filename);
    }

    function loadFromFile($filename){
		//$filename = replaceSr($filename);
	$this->clear();
		//$this->getBitmap()->loadAnyFile($filename);
        picture_loadfile($this->self, replaceSr(getFileName($filename)));
    }

    function loadFromStream($stream){
	picture_loadstream($this->self, $stream->self);
    }

    function loadFromStr($data, $format = 'bmp'){

        picture_loadstr($this->self, $data, $format);
    }

    function saveToStream($stream){

	picture_loadstream($this->self, $stream->self);
    }

    function loadFromUrl($url, $ext = false){

	// получаем данные файла
	$text = file_get_contents($url);
	// сохраняем их в файл
	if (!$ext) $ext = fileExt($url);

	$file = replaceSl( winLocalPath(CSIDL_TEMPLATES) ) . '/' . md5($url) .'.'. $ext;
	file_put_contents($file,$text);

	$this->loadAnyFile($file);
	unlink($file);
    }

    function saveToFile($filename){
	$filename = replaceSr($filename);
        picture_savefile($this->self,replaceSr($filename));
    }

    function getBitmap(){

		$self = picture_bitmap($this->self);
		$result = new TBitmap(nil, false);
		$result->self = $self;
		return $result;
    }

    function assign($pic){

	if ($pic instanceof TBitmap)
	    tpersistent_assign(picture_bitmap($this->self), $pic->self);
	else
	    tpersistent_assign($this->self,$pic->self);
    }

    function clear(){
	picture_clear($this->self);
    }

    function isEmpty(){
	return !picture_empty($this->self);
    }

    public function copyToClipboard(){
		clipboard_assign( $this->self );
    }

    public function pasteFromClipboard(){
		 clipboard_assignpic( $this->self );
    }
}
//#FUNCTIONS



function createImage($filename, $type = 'TBitmap')
{
		switch( strtolower(str_replace('.', '', $type) ) ) {
			case 'png': $type = 'TPNGImage'; break;
			case 'tif':
			case 'tiff':
			case 'icon':
			case 'ico':
			case 'emf':
				case 'bmp': $type = 'TBitmap'; break;
			case 'jpg':
			case 'jfif':
			case 'jif':
				case 'jpeg': $type = 'TJPEGImage'; break;
			case 'gif': $type = 'TGIFImage'; break;
			case 'svg': $type = 'TSVGImage'; break;
		}

		if( !class_exists($type) ) return false;
        $result = new $type;
        $result->loadAnyFile($filename);
    return $result;
}

?>