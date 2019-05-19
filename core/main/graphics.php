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

$_c->setConstList(['stRectangle', 'stSquare', 'stRoundRect', 'stRoundSquare', 'stEllipse', 'stCircle', 'stRhombus', 'stDiamond','stEquilateralTriangle', 'stIsosceleTriangle', 'stRightTriangle', 'stScaleneTriangle', 'stSunPie'],'TShapeType');


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
class TPoint{
    
    public $x;
    public $y;
    
    function __construct($x,$y){
        $this->x = (integer)$x;
        $this->y = (integer)$y;
    }
}

///////////////////////////////////////////////////////////////////////////////
///                             TRect                                       ///
///	Rectangle data storage - position and sizes (height, width)				///
///	Used both by WinAPI and VCL framework									///
///////////////////////////////////////////////////////////////////////////////
class TRect{
    
    public $left;
    public $top;
    public $right;
    public $bottom;
    
    function __construct($left,$top,$right,$bottom){
        $this->left   = (integer)$left;
        $this->top    = (integer)$top;
        $this->right  = (integer)$right;
        $this->bottom = (integer)$bottom;
    }
}

function rect($left,$top,$right,$bottom){
    return new TRect($left,$top,$right,$bottom);
}

function point($x,$y){
    return new TPoint($x,$y);
}


///////////////////////////////////////////////////////////////////////////////
///                             TPen, TBrush                                ///
///	I do not really want to explain you thia things							///
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
class TCanvas extends TControl{
    
    function lineTo($x, $y){
	
	canvas_lineto($this->self,$x,$y);
    }
    
    function moveTo($x, $y){
	
	canvas_moveto($this->self,$x,$y);
    }
    
    function textHeight($text){
	
	return canvas_textHeight($this->self, $text);
    }
    
    function textWidth($text){
	
	return canvas_textWidth($this->self, $text);
    }
    
    function refresh(){
	
	canvas_refresh($this->self);
    }
    
    function pixel($x, $y, $color = null){
	
	if ($color === null)
	    return canvas_pixel($this->self, (int)$x, (int)$y, null);
	else
	    canvas_pixel($this->self, (int)$x, (int)$y, $color);
    }
    
    function textOut($x, $y, $text){
	
	canvas_textout($this->self, $x, $y, $text);
    }
    
    function rectangle($x1, $y1, $x2, $y2){
	
	canvas_rectangle($this->self, $x1, $y1, $x2, $y2);
    }
    	
    function ellipse($x1, $y1, $x2, $y2){
	
		canvas_ellipse($this->self, $x1, $y1, $x2, $y2);
    }
    
    function lock(){
		canvas_lock($this->self);
    }
    
    function unlock(){
		canvas_unlock($this->self);
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
    
    function clear(){
		canvas_clear($this->self);
    }
    
    // вывод текста под углом
    function textOutAngle($x, $y, $angle, $text){
		$n = canvas_angle($this->self,null);
		canvas_angle($this->self,$angle);
		$this->textOut($x, $y, $text);
		canvas_angle($this->self,$n);
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
$_c->fsBold      = 'fsBold';
$_c->fsItalic    = 'fsItalic';
$_c->fsUnderline = 'fsUnderline';
$_c->fsStrikeOut = 'fsStrikeOut';

class TCanvasFont extends TFont {
    
    
    function prop($prop){
	
	return rtti_get($this, $prop);
    }
	
	function set_name($name){rtti_set($this,'name',$name);}
	function set_size($size){rtti_set($this,'size',$size);}
	function set_color($color){rtti_set($this,'color',$color);}
	function set_charset($charset){rtti_set($this,'charset',$charset);}
	function set_style($style){
	    
	    if (is_array($style)) $style = implode(',', $style);
	    rtti_set($this,'style',$style);
	}
	
	function get_name(){	return $this->prop('name'); }
	function get_color(){	return $this->prop('color'); }
	function get_size(){	return $this->prop('size'); }
	function get_charset(){	return $this->prop('charset'); }
	function get_style(){
	    
	    $result = $this->prop('style');
	    $result = explode(',',$result);
	    foreach ($result as $x=>$e)
		$result[$x] = trim($e);
	    return $result;
	}
}

class TControlCanvas extends TCanvas {
    
    
    
    function __construct($owner=nil,$init=true,$self=nil)
	{
		$self = is_object($self)?$self->self:(int)$self;
		parent::__construct($owner,$init,((gui_is($self,'TCanvas') && gui_is($self, 'TControlCanvas'))? component_canvas($self): $self));
    }
    
    function get_control(){
		return _c(canvas_control($this->self, null));
    }
    
    function set_control($v){
	
		
		if (method_exists($v,'getCanvas')){
			$this->self = $v->getCanvas()->self;
		} else {
			canvas_control($this->self, $v->self);
		}
    }
    function set_angle($v){
		canvas_angle($this->self, $v);
	}
    function free(){
        if ($this->self)
            obj_free($this->self);
    }
}

function canvas($ctrl = false){
    
    return new TControlCanvas($ctrl);
}
class TGraphic extends TControl{
	
	function Assign(TGraphic $v)
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
    
    function assign(TGraphic $v){
	
		if ($v instanceof TBitmap){
			icon_assign($this->self, $v->self);
		} else {
			tpersistent_assign($this->self, $v->self);
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

class TSVGGraphic extends TGraphic{  }
class TPNGImage extends TGraphic{  }
class TGIFImage extends TGraphic{  }
class TJPEGImage extends TGraphic{  }

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