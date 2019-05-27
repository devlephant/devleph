<?


class TScrollProgress extends TProgressBar {

    public $class_name_ex = __CLASS__;
	
	 function __initComponentInfo(){
		 $this->fMouseUp  = event_get($this->self,'onMouseUp');
        event_set($this->self, 'onMouseUp', 'TScrollProgress::doMouseUp');
        
        $this->fMouseDown  = event_get($this->self,'onMouseDown');
        event_set($this->self, 'onMouseDown', 'TScrollProgress::doMouseDown');
		
		$this->fMouseMove  = event_get($this->self,'onMouseMove');
        event_set($this->self, 'onMouseMove', 'TScrollProgress::doMouseMove');
	 }
	
    function __construct($owner = nil, $init = true, $self = nil){
		parent::__construct($owner, $init, $self);
        if ( $init ){
			if ( !$GLOBALS['APP_DESIGN_MODE'] ){
			$this->__initComponentInfo();
			}
        }
    }
	
	function set_onMouseUp($v){
	
		event_set($this->self, 'onMouseUp', 'TScrollProgress::doMouseUp');
		$this->fMouseUp = $v;
    }
    
    function set_onMouseDown($v){
	
		event_set($this->self, 'onMouseDown', 'TScrollProgress::doMouseDown');
		$this->fMouseDown = $v;
    }
	
    function set_onMouseMove($v){
	
		event_set($this->self, 'onMouseMove', 'TScrollProgress::doMouseMove');
		$this->fMouseMove = $v;
    }
	
	static function doMouseDown($self, $button, $shift, $x, $y){
		
		c($self)->switchBtn = true;
		if ( c($self)->fMouseDown ){
			err_no();
            call_user_func(c($self)->fMouseDown, $self);
			err_yes();
        }
	}
		
	static function doMouseUp($self, $button, $shift, $x, $y){
			
		c($self)->switchBtn = false;
		if( c($self)->Orientation == "pbHorizontal" ){
			c($self)->position = round($x * c($self)->max / c($self)->w );
		} elseif( c($self)->Orientation == "pbVertical" ) {
			c($self)->position = c($self)->max - (round($y * c($self)->max / c($self)->h ));
		}
        if ( c($self)->fMouseUp ){
			err_no();
            call_user_func(c($self)->fMouseUp, $self);
			err_yes();
        }
	}
		
	static function doMouseMove($self, $shift, $x, $y){
			
		if( c($self)->switchBtn == true ){
			if( c($self)->Orientation == "pbHorizontal" ){
				c($self)->position = round($x * c($self)->max / c($self)->w );
			} elseif( c($self)->Orientation == "pbVertical" ) {
				c($self)->position = c($self)->max - (round($y * c($self)->max / c($self)->h ));
			}
		}
		if ( c($self)->fMouseMove ){
			err_no();
            call_user_func(c($self)->fMouseMove, $self);
			err_yes();
        }
	}
}