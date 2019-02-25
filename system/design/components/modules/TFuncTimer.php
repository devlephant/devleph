<?

class TFuncTimer extends __TNoVisual {
    
    
    #public $icon = 'T';    
    
     
    public static function doTimer($self){
	$obj = _c(_c($self)->owner);
	//pre($obj);
	if ($obj->onTimer){
		if( is_string($obj->onTimer) )
		{
			
			if( function_exists($obj->onTimer) )
			{
				call_user_func($obj->onTimer, $obj->self);
			} else if( method_exists($obj, $obj->onTimer) ) {
				call_user_func([$obj, $obj->onTimer], $obj->self);
			} else if( class_exists($obj->onTimer) ) if( method_exists($obj->onTimer, 'onTimer') )
				call_user_func([$obj->onTimer,'onTimer'], $obj->self);
				
		}else if( is_callable($obj->onTimer))
		{
			call_user_func($obj->onTimer, $obj->self);
		} else if( is_object($obj->onTimer) )
			if( method_exists($obj->onTimer, 'onTimer') )
				call_user_func([$obj->onTimer, 'onTimer'], $obj->self);
	}
    }
    
    function __initComponentInfo($init = true){
	
	parent::__initComponentInfo($init);
	$props = TComponent::__getPropExArray($this->self);
	
	$timer = new TTimerEx(_c($this->owner));
	$timer->interval = $props['interval'];
	$timer->enabled  = $props['enable'];
	
	$timer->repeat   = $props['repeat'];
	$timer->workbackground = $props['workbackground'];
	$timer->priority = $props['priority'];
	//$timer->onTimer = TFuncTimer::onTimer;
	//pre($this->background);
	$timer->onTimer  = $props['onTimer'];
	
	$tmp = $this->name;
	//$this->free();
	$this->name = '';
	$timer->name = $tmp;
	eventEngine::updateIndex($timer);
    }
    
    public function __construct($onwer=nil,$init=true,$self=nil){
	parent::__construct($onwer, $init, $self);
  
        if ($init){
            //$this->color = 0x0;
	    $this->background = 0;
	    $this->priority   = tpNormal;
	    $this->interval = 1000;
	    $this->enable   = false;
	}
	$this->__setAllPropEx($init);
    } 
    
}
?>