<?
/* hunting kashket */
/* TIB v1.5*/
global $_c;
//replacement for "autostate" property
$_c->tbsCustom	= 0; //for custom gif/image iteration only		= custom [X-states]
//a.k.a autostate = false (in the past)
$_c->tbsButton	= 1; //active, hover, press, inactive			= square [3 upto 4 states]
$_c->tbsThumb	= 2; //up, down, inactive {up, down}			= square [2 upto 3 states]
//a.k.a Thumbler, activates "down" property
$_c->tbsSwitch	= 3; //{up, down} active, hover, press, inactive= square [8 states required]
//a.k.a ThumbButton, activates "down" property
$_c->tbsPad		= 4; //{active, hover, press, inactive}
					 //360x rotation angles/1x point			= circle
					 //combos: 364, 5, 6, 1480, 365, 724, 725, 1080, 1084, 1085 states
//a.k.a circular thumb, activates "position" property
$_c->tbsGIF		= 5; //stepping state (thread playing)			= polygon
//a.k.a walking image (animated) - activates "onStep" event
$_c->tbsCursor	= 6; //requires full stack of cursor states		= triangle
//a.k.a custom cursor, activates "cursor" property
$_c->tbsItem	= 7; ///active, hover, press, checked, inactive	= rectangle
//just for drawing, caption is placed in the right or left after the icon,
//activates 'Resolution' (default 16x16), 'MaxWidth', 'MinWidth' properties
$_c->tbsMulti	= 8; //Виртуализированные объекты, не нативный метод создавать кастом компоненты
//a.k.a multidimensional states (will be created asap)
$_c->tbsCircularPicker	= 9; //
							 // Color Pickers
$_c->tbsSquarePicker	= 10;//

$_c->tbsCircularGauge	= 11;//
							 // Adjustable gauges
$_c->tbsSquareGauge		= 12;//

$_c->tbsTrackbar		= 13;//
							 // Trackable bars*(thumbs)
$_c->tbsScrollbar		= 14;//
					#READY#
/*
					0, 1, 2
*/
#ALL#
// tib styling types
$_c->tissImage			= 0;//Default image type
$_c->tissCollection		= 1;//Default type for objects, just image list
$_c->tissNinePatch		= 2;//9-patch styled element
$_c->tissGIF			= 3;//For animateable parts
$_c->tissPDF			= 4;//For particle interaction
$_c->tissPSD			= 5;//For vector images, normal svg is stored just as a common image
$_c->tissFivePart		= 6;//For vector-like image sizing...
#GAUGES#
// Gauges types
$_c->tbsgmProgress		= 0;//example [ ][ ][ ], ===, ###
$_c->tbsgmTracker		= 1;//example [ ][ ][ || ][ ][ ], ==#== , [##||##]
$_c->tbsgmStepper		= 2;//example [ ][ ][ ][||] , ===# , [###||  ]
$_c->tbsgmPointer		= 3;//example  [][||][] , [  =#=  ], [  #||# ]
$_c->tbsgmDot			= 4;//example     ||    , [   #   ], [   ||  ]
#BARS#
// Shrinker types
$_c->tbshrNone			= 0;
$_c->tbshrLeft			= 1;
$_c->tbshrRight			= 2;
$_c->tbshrTop			= 3;
$_c->tbshrBottom		= 4;
$_c->tbshrLR			= 5;
$_c->tbshrTB			= 6;
#COLOR PICKERS#
// PickerCrossing
$_c->tbspcsSector		= 0;
$_c->tbspcsMask			= 1;
$_c->tbspcsPoint		= 2;
$_c->tbspcsSelector		= 3;
#BUTTONS, MENUES#
// Dropdown style
$_c->tbdpsNone			= 0;
$_c->tbdpsCustom		= 1;
$_c->tbdpsChildren		= 2;
$_c->tbdpsChildrenList	= 3;
// Dropdown button viewing type
$_c->tbdpbNone			= 0;
$_c->tbdpbSingle		= 1;
$_c->tbdpbMerged		= 2;
$_c->tbdpbBoth			= 3;
$_c->tbdHovered			= 4;
					#OTHER#
//Add  the end-list images is used as a borders feature (9-patch technique)
// DO NOT, better:
// Add the custom image storage class for image precision >.END

//Add image_cointainer/imagelist property f memory optimization (custom styling,etc.)
//maybe just patch it to work with	TImageList, TPngImageList, etc.
//in future, it's better to add Font property
//and Caption, of course

//#Interfaces
interface ITIBImageData
{
	public function get($w, $h);
	public function getInterval();
	public function getType();
}
interface ITIBImage
{
	public function beginAnimate($a);
	public function clearTimer($GUIId);
	public function get($parent, $a=0);
	public function getInterval($a);
	public function getWH($w, $h, $a=0);
}
//#Classes
// класс для хранения изображения
class TIBImageData implements ITIBImageData
{
	protected $stype;
	protected $data;
	public $interval;
	public function __construct($type, ...$data)
	{
		$this->data		= $data;
		$this->stype	= $type;
		$this->interval	= 0;
	}
	
	public function get($w, $h)
	//получение изображения, подогнанного под размер (нужно для nine-patch, five-part, etc)
	{
	}
	
	public function getInterval()
	{
		return $this->interval;
	}
	
	public function getType()
	{
		return $this->stype;
	}
}
// класс для хранения изображений
class TCiControl implements ITIBImage
{
	protected $images;
	
	//FOR GIF ONLY
	protected $timers;
	public $replay;
	//
	public final function __construct(...$data)
	//for image construction, eh
	{
		$this->images	= $data;
		$this->replay	= false;
	}
	public function beginAnimate($a)
	{
		$count = count( $this->images );
		if( $count <= 1 ) return;
		if( !in_array($a->self, array_keys($this->timers)) )
		{
			
			$timer =  gui_create('TTimer', null);
			$obj = &$this;
			gui_propset($timer, 'interval', $this->getInterval(0));
			gui_propset($timer, 'repeat', true);
			$this->timers[$a->self] = $timer;
			$iter = 1;
			event_set($timer, 'onTimer', function() use($obj, $a, $timer, $count, &$iter){
					$a->state_renew( $iter );
					if( $iter == $count )
					{
						if( $obj->replay )
							$iter = 0;
						else
							$obj->ClearTimer( $a->self );
					} 
					else
					{
						$iter++;
						gui_propset($timer, 'interval', $obj->getInterval($iter));
					}
				});
			gui_propset($timer, 'enabled', true);
		}
	}
	public function ClearTimer( $GUIId )
	{
		Timer::ClearTimer( $GUIId );
	}
	/*
	public function changeAnimation(TIBStyle $a)
	{
	}
	*/
	public function get($parent, $a=0)
	{
		if( isset($this->images[$a]) )
			return $this->images[$a]->get($parent->w, $parent->h);
		ob_start();
		imagepng( imagecreatetruecolor($paren->w, $parent->h) );
		return [ob_get_clean(), 'PNG'];
	}
	public function getInterval($a)
	{
		if( isset($this->images[$a]) )
			return $this->images[$a]->getInterval();
	}
	public function getWH($w, $h, $a=0)
	{
		if( isset($this->images[$a]) )
			return $this->images[$a]->get($w, $h);
		ob_start();
		imagepng( imagecreatetruecolor($w, $h) );
		return [ob_get_clean(), 'PNG'];
	}
}

class TIB extends TMImage{

   public final function __construct($onwer=nil,$init=true,$self=nil){
    parent::__construct($onwer,$init,$self);
    if($init)
	{
     $this->center	= true;
	 $this->down	= false;
     $this->autoState = 1;
    }
   }
	public function state_renew($asId)
	{
		 $img = $this->images[$this->index]->get($this, $asId);
		 $this->picture->clear();
		 $this->picture->loadFromStr( $img[0], $img[1] );
	}
   public final function get_state(){
    return $this->index;
   }

   public final function set_state($index=0){
    if( isset($this->images[$index]) && is_array($this->images[$index]) )
	{
     $img = $this->images[$index]->get($this);
	 $this->picture->clear();
     $this->picture->loadFromStr( $img[0], $img[1] );
     $this->index = $index;
	}
   }

   public function replace($index=false, $file=false){
    if($index!==false and $file!==false){
     if( is_file($file) ){
      $arr = $this->images;
      $arr[$index] = [ file_get_contents($file), strtoupper(fileExt($file)) ];
      $this->images = $arr;
     } elseif( is_array($file) )
	 {
		$arr = $this->images;
		$arr[$index] = $file;
		$this->images = $arr;
	 }
    }
   }

   public function add($file=false){
    if($file!==false){
     if( is_file($file) ){
      $this->images[] = [ file_get_contents($file), strtoupper(fileExt($file)) ];
      return count($arr)-1;
     } elseif( is_array($file) )
	 {
      $this->images[] = $file;
      return count($this->images)-1;
	 }
    }
   }

   public function delete($index=false){
    if($index!==false){
     $arr = $this->images;
     if( is_array($arr) and $arr[$index] ){
      unset($arr[$index]);
     }
     $this->images = array_values($arr);
    }
   }
	public function clear()
	{
		$this->images = [];
		$this->picture->clear();
	}
	public function get_stateCount()
	{
		if(!isset($this->images)) return 0;
		return count($this->images);
	}
   function set_onMouseMove($v) { event_set($this->self, 'onMouseMove', __CLASS__.'::doMouseMove');   $this->fMouseMove= $v;   }
   function set_onMouseEnter($v){ event_set($this->self, 'onMouseEnter', __CLASS__.'::doMouseEnter'); $this->fMouseEnter = $v; }
   function set_onMouseLeave($v){ event_set($this->self, 'onMouseLeave', __CLASS__.'::doMouseLeave'); $this->fMouseLeave = $v; }
   function set_onMouseDown($v) { event_set($this->self, 'onMouseDown', __CLASS__.'::doMouseDown');   $this->fMouseDown = $v;  }
   function set_onMouseUp($v)   { event_set($this->self, 'onMouseUp', __CLASS__.'::doMouseUp');       $this->fMouseUp = $v;    }
   function set_onClick($v)     { event_set($this->self, 'onClick', __CLASS__.'::doClick');           $this->fClick = $v;      }
   function set_onDblClick($v)  { event_set($this->self, 'onDblClick', __CLASS__.'::doDblClick');     $this->fDblClick = $v;   }

   function __initComponentInfo(){
	  $this->visible = $this->avisible;
	  $this->enabled = $this->aenabled;
   	  
      $this->fMouseMove   = event_get($this->self,'onMouseMove');
      $this->fMouseEnter  = event_get($this->self,'onMouseEnter');
      $this->fMouseLeave  = event_get($this->self,'onMouseLeave');
      $this->fMouseDown   = event_get($this->self,'onMouseDown');
      $this->fMouseUp     = event_get($this->self,'onMouseUp');
      $this->fClick       = event_get($this->self,'onClick');
      $this->fDblClick    = event_get($this->self,'onDblClick');

      event_set($this->self, 'onMouseMove', __CLASS__.'::doMouseMove');
      event_set($this->self, 'onMouseEnter', __CLASS__.'::doMouseEnter');      
      event_set($this->self, 'onMouseLeave', __CLASS__.'::doMouseLeave');
      event_set($this->self, 'onMouseDown', __CLASS__.'::doMouseDown');
      event_set($this->self, 'onMouseUp', __CLASS__.'::doMouseUp');
      event_set($this->self, 'onClick', __CLASS__.'::doClick');
      event_set($this->self, 'onDblClick', __CLASS__.'::doDblClick');
   }

   static function doClick($self){
    $self = c($self);
    if($self->enabled){
   	 $name = 'f'.substr(__FUNCTION__,2);		
     if($self->$name)
      call_user_func_array($self->$name, func_get_args());
    }
   }
   static function doDblClick($self){
    $self = c($self);
    if($self->enabled){
     $name = 'f'.substr(__FUNCTION__,2);		
     if($self->$name)
      call_user_func_array($self->$name, func_get_args());
    }
   }
   static function doMouseMove($self,$shift,$x,$y){
    $self = c($self);
    if($self->enabled){
     $name = 'f'.substr(__FUNCTION__,2);		
     if($self->$name)
      call_user_func_array($self->$name, func_get_args());
    }
   }
   static function doMouseDown($self,$btn,$shift,$x,$y){
    $self = c($self);
    if($self->enabled){
     switch($self->autoState)
	 {
		case tbsButton:
		case tbsSwitch:
		$self->state = 2; break;
     }
   	 $name = 'f'.substr(__FUNCTION__,2);		
     if($self->$name)
      call_user_func_array($self->$name, func_get_args());
    }
   }
   static function doMouseUp($self,$btn,$shift,$x,$y){
    $self = c($self);
    if($self->enabled){
     switch($self->autoState)
	 {
		case tbsButton:
		case tbsSwitch:
		$self->state = 1; break;
		case tbsThumb:
		$self->state = ($self->state==1)?0:1; break;
     }
   	 $name = 'f'.substr(__FUNCTION__,2);		
     if($self->$name)
      call_user_func_array($self->$name, func_get_args());
    }
   }
   static function doMouseEnter($self){
    $self = c($self);
    if($self->enabled){
	 switch($self->autoState)
	 {
		case tbsButton:
		case tbsSwitch:
		$self->state = 1; break;
     }
   	 $name = 'f'.substr(__FUNCTION__,2);		
     if($self->$name)
      call_user_func_array($self->$name, func_get_args());
    }
   }
   static function doMouseLeave($self){
    $self = c($self);
    if($self->enabled){
     switch($self->autoState)
	 {
		case tbsButton:
		case tbsSwitch:
		$self->state = 0; break;
     }
   	 $name = 'f'.substr(__FUNCTION__,2);		
     if($self->$name)
      call_user_func_array($self->$name, func_get_args());
    }
   }
   public function get_enabled()
   {
	   return gui_propget($this->self, "enabled");
   }
   public function set_enabled($v)
   {
		switch( $this->autoState)
		{
			case tbsButton:
				$this->state = ($v)? 0: 3;
			break;
			case tbsThumb:
			{
				$this->state = ($v)?
				(	($this->down)? 1: 0 ):
				(	(count($this->stateCount)>=4)?
					( ($this->down)? 3: 2 ): 2 );
			}break;
		}
		gui_propset($this->self, "enabled", $v);
   }

}