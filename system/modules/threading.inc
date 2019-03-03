<?
/*
 
    Class for real MultiThreading for PHP
    
    from DevelStudio 3.0
    
    
    Note:
        It is not recommended at the same time create more than 500 threads
        
    #importGlobals = true
    #importClasses = true
    #importConstants = true
*/

function safe($code, $func){
    
    $p = TThread::$_criticals[ $code ];
    if ( $p ){
        gui_criticalEnter($p);
        call_user_func($func);
        gui_criticalLeave($p);
    }
}

function sync($function_name, $args = array()){
    
    //pre($function_name);
	if ( isset($GLOBALS['THREAD_SELF']) ) return false;
    if ( $GLOBALS['THREAD_SELF'] ){
       
        $th = TThread::get($GLOBALS['THREAD_SELF']);
        array_unshift($args, $function_name);
        
        call_user_func_array(array($th, 'syncFull'), $args);
        return true;
    
    } else
        return false;
	
}

function syncEx($function_name, $args){
    if ( !isset($GLOBALS['THREAD_SELF']) ) return call_user_func_array($function_name, $args);
    if ( $GLOBALS['THREAD_SELF'] ){
       
        $th = TThread::get($GLOBALS['THREAD_SELF']);
        array_unshift($args, $function_name);
        
        return call_user_func_array(array($th, 'syncFull'), $args);
    } else
        return call_user_func_array($function_name, $args);
}

function critical($code){
    
    if (!TThread::$_criticals[ $code ]){
        TThread::$_criticals[ $code ] = gui_criticalCreate();
    }
}


class TThread extends _Object {
    
    static $_criticals = array();
    public $self;    
     
    static function get($self){
        
        return new TThread(false, $self);
    }
     
    public function __construct($func_name = false, $self = false){
        
        if (!$self)
            $this->self = gui_threadCreate();
        else
            $this->self = (int)$self;
        
        if ( $func_name )
            $this->set_onExecute($func_name);
    }
    
    public function set_onExecute($func){
        
        if ( $this->self && is_callable($func) && is_string($func) )
            event_set($this->self, 'onExecute', $func);
    }
    
    public function get_priority(){
        return gui_threadPriority($this->self);
    }
    
    public function set_priority($v){
        return gui_threadPriority($this->self, $v);
    }
    
    public function resume(){
        if ( $this->self )
            return gui_threadResume($this->self);
    }
    
    public function suspend(){
        if ( $this->self )
            return gui_threadSuspend($this->self);
    }
    
    public function terminate(){
        
        if ( $this->self ){
            gui_threadTerminate($this->self);
            $this->self = false;
        }
    }
    
    public function sync($func, $addData = ''){
        
        if ( $this->self && is_string($func) )
            gui_threadSync($this->self, $func, $addData);
    }
    
    static function __syncFull($self, $addData){
        
        $th = TThread::get($self);
        $args = igbinary_unserialize($addData);
        $th->result = call_user_func_array( $th->callback, $args );
    }
    
    public function syncFull($func){
        
        if ( $this->self && is_string($func) ){
            
            $this->callback = $func;
            $args = func_get_args();
            unset($args[0]);
            
            $this->sync('TThread::__syncFull', igbinary_serialize(array_values($args)));
            return $this->result;
        }
    }
    
    public function synchronize($func){
        $this->sync($func);
    }
    
    public function free(){
        
        gui_threadFree($this->self);
        $this->self = false;
    }
    
    public function __get($name){
        
        if ( method_exists($this, 'get_' . $name) )
            return call_user_func(array($this, 'get_'.$name));
            
        $result = igbinary_unserialize(gui_threadData($this->self, $name));
	return $result;
    }
    
    public function __set($name, $value){

        if ( method_exists($this, 'set_' . $name) )
            return call_user_func(array($this, 'set_'.$name), $value);
        
        gui_threadData($this->self, $name, igbinary_serialize($value));
    }
    
    public function __isset($name){
        
        return gui_threadDataIsset($this->self, $name);
    }
    
    public function __unset($name){
        
        gui_threadDataUnset($this->self, $name);
    }
    
    // call when run thread
    static function __init(){
        errors_init();
    }
}