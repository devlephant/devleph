<?
class TMover extends __TNoVisual {

	public $class_name_ex = __CLASS__;

	function __setC($objcont){
	$objcont->fMouseDown  = event_get($objcont->self,'onMouseDown');
        event_set($objcont->self, 'onMouseDown', 'TMover::doMouseDown');

	$objcont->fMouseUp  = event_get($objcont->self,'onMouseUp');
        event_set($objcont->self, 'onMouseUp', 'TMover::doMouseUp');
	}
    public function __construct($onwer=nil,$init=false,$self=nil){
        parent::__construct($onwer, $init, $self);
        if ($init){
	  	
		if ( !$GLOBALS['APP_DESIGN_MODE'] ){ //Debug
		if( $this->cobj <= ''){
		$this->__setC($this->parent);
		}else{
		$this->__setC( _c($this->cobj) );
		}
	    	}
	
	}
	}
	function set_onMouseUp($v){
		if( $this->cobj <= ''){
		$this->cobj = $this->parent->name;
		}
		$cobj = _c($this->cobj);
	event_set($cobj->self, 'onMouseUp', 'TMover::doMouseUp');
	$this->fMouseUp = $v;
    	}
    
    function set_onMouseDown($v){
		if( $this->cobj <= ''){
		$this->cobj = $this->parent->name;
		}
		$cobj = _c($this->cobj);
	event_set($cobj->self, 'onMouseDown', 'TMover::doMouseDown');
	$this->fMouseDown = $v;
    	}

	static function doMouseDown($self){
		$obj = c($this->cobj);$obj->i = 0;
		$this->cursorx = cursor_pos_x();
		$this->cursory = cursor_pos_y();
		$this->objx = c($this->crobj)->x;
		$this->objy = c($this->crobj)->y;
		if ( $obj->fMouseDown ){
            call_user_func($obj->fMouseDown, $self);
        }
    }
    
    static function doMouseUp($self){
		$obj = c($this->cobj);$obj->i = 0;
		if ( $obj->fMouseUp ){
            call_user_func($obj->fMouseUp, $self);
        }
    }

}