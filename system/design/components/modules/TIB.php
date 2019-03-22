<?

/* xsnakes */
/* TIB v1.3*/

class TIB extends TMImage{

   

   function __construct($onwer=nil,$init=true,$self=nil){
    parent::__construct($onwer,$init,$self);
    if($init){
     $this->center = true;
     $this->autoState = true;
    }
   }

   public function get_state(){
    return $this->index;
   }

   public function set_state($index=0){
    $arr = $this->images;
    if( $arr[$index] ){
     $img = $arr[$index];
	 $this->picture->clear();
     $this->picture->loadFromStr( $img[0], $img[1]);
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
      $this->images[] = array( file_get_contents($file), strtoupper(fileExt($file)) );
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

   public function clear(){
     $this->images = [];
     $this->picture->clear();
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
     if($self->autoState){
      $self->state = 2;
     }
   	 $name = 'f'.substr(__FUNCTION__,2);		
     if($self->$name)
      call_user_func_array($self->$name, func_get_args());
    }
   }
   static function doMouseUp($self,$btn,$shift,$x,$y){
    $self = c($self);
    if($self->enabled){
     if($self->autoState){
      $self->state = 1;
     }
   	 $name = 'f'.substr(__FUNCTION__,2);		
     if($self->$name)
      call_user_func_array($self->$name, func_get_args());
    }
   }
   static function doMouseEnter($self){
    $self = c($self);
    if($self->enabled){
     if($self->autoState){
      $self->state = 1;
     }
   	 $name = 'f'.substr(__FUNCTION__,2);		
     if($self->$name)
      call_user_func_array($self->$name, func_get_args());
    }
   }
   static function doMouseLeave($self){
    $self = c($self);
    if($self->enabled){
     if($self->autoState){
      $self->state = 0;
     }
   	 $name = 'f'.substr(__FUNCTION__,2);		
     if($self->$name)
      call_user_func_array($self->$name, func_get_args());
    }
   }
   public function get_enabled() {
	   return gui_propget($this->self, "enabled");
   }
   public function set_enabled($v){
	   $arr = $this->images;
	   if($v && $this->autoState) {
		   $index = 0;
	   }else if($this->autoState) {
		   $index = 3;
	   }
		if( $arr[$index] and $this->autoState  ){
			$img = $arr[$index];
			$this->picture->loadFromStr( $img[0], $img[1]);
			$this->index = $index;
		}
		gui_propset($this->self, "enabled", $v);
   }

}