<?
/*
 
    Class for real MultiThreading for PHP
    
    2015 ver 2.3
    
    
    Note:
        It is not recommended at the same time create more than 500 threads
        
    #importGlobals = true
    #importClasses = true
    #importConstants = true
*/

global $_c;
$_c->setConstList(['tpIdle', 'tpLowest', 'tpLower', 'tpNormal', 'tpHigher', 'tpHighest',
    'tpTimeCritical']);


function safe($code, $func){
    
    $p = TThread::$_criticals[ $code ];
    if ( $p ){
        gui_criticalEnter($p);
        call_user_func($func);
        gui_criticalLeave($p);
    }
}

function sync($function_name){
    
	if ( !isset($GLOBALS['THREAD_SELF']) ) return false;
    if ( !$GLOBALS['THREAD_SELF'] ) return false;
        
        //$th = TThread::get($GLOBALS['THREAD_SELF']);
        
        if ( func_num_args() == 1 ){
            gui_threadSync($GLOBALS['THREAD_SELF'], 'TThread::__syncFull', igbinary_serialize(['___callback'=>$function_name]));
        } else {
            
            $args = func_get_arg(1);
            if ( is_array($args) ){
                $args['___callback'] = $function_name;
                gui_threadSync($GLOBALS['THREAD_SELF'], 'TThread::__syncFull', igbinary_serialize($args)); 
            } else {
                trigger_error('sync() expects parameter 2 to be a array', E_USER_ERROR);
            }
        }
        
        return true;
}

function syncEx($function_name, $args){
    
    if ( !isset($GLOBALS['THREAD_SELF']) ) return call_user_func_array($function_name, $args);
    if ( !$GLOBALS['THREAD_SELF'] ) return call_user_func_array($function_name, $args);
       
        $args['___callback'] = $function_name;
        gui_threadSync($GLOBALS['THREAD_SELF'], 'TThread::__syncFull', igbinary_serialize($args));
        
        return igbinary_unserialize(gui_threadData($GLOBALS['THREAD_SELF'], 'result'));
        
        //return $th->syncFull($function_name, $args);
}

function critical($code){
    
    if (!TThread::$_criticals[ $code ]){
        TThread::$_criticals[ $code ] = gui_criticalCreate();
    }
}


function thread_inPool($func, $callback = null){
    
    if ( thread_count() < thread_max() ){
        if ( $callback )
            $callback(new TThread($func));
        else {
            $th = new TThread($func);
            $th->resume();
        }
    } else {
        TThread::$pool[] = [$func, $callback];    
    }
}


class TThread {
    
    //static $_criticals;
    public $self;
    static $pool;
     
    static function get($self){
        
        return new TThread(false, $self);
    }
    
    static function checkPool($self)
	{
        
        if ( sizeof(self::$pool) < 1 ) return;
        
        $can = thread_max() - thread_count() - 2;
        reset(self::$pool);        
        
        for($i=0;$i<$can;$i++){
            
            $item = current(self::$pool);
            
            $th = new TThread($item[0]);
            $callback = $item[1];
            if ( $callback )
                $callback($th);
            else
                $th->resume();
            
            self::$pool[ key(self::$pool) ] = null;
            next(self::$pool);
        }
        
        foreach(self::$pool as $key=>$item){
            if ($item == null)
                unset(self::$pool[$key]);
            else
                break;
        }
    }
    
    public function __construct($func_name = false, $self = false){
        $this->self = ($self==false||$self==nil)?gui_threadCreate():$self;
        
        if ( $func_name )
            $this->set_onExecute($func_name);
		
		return c($this->self);//ЧТО ЭТО ВООБЩЕ ЗА КОСТЫЛЬ???
    }
    
    public function set_onExecute($func){
        
        if ( $this->self && is_callable($func) && is_string($func) )
            event_set($this->self, 'onExecute', $func);
    }
    
    public function set_importClasses($val){
        gui_propSet($this->self, 'importClasses', (bool)$val);
    }
    
    public function set_importGlobals($val){
        gui_propSet($this->self, 'importGlobals', (bool)$val);
    }
    
    public function set_importConstants($val){
        gui_propSet($this->self, 'importConstants', (bool)$val);
    }
    
    public function get_importClasses($val){
        return gui_propGet($this->self, 'importClasses');
    }
    
    public function get_importGlobals($val){
        return gui_propGet($this->self, 'importGlobals');
    }
    
    public function get_importConstants($val){
        return gui_propGet($this->self, 'importConstants');
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
        $callback = $args['___callback'];
        unset($args['___callback']);
        $th->result = call_user_func_array( $callback, $args );
    }
    
    public function syncFull($func, $args){
        
        if ( $this->self && is_string($func) ){
            
            //$this->callback = $func;
            $args = array_values($args);
            $args['___callback'] = $func;
            
            $this->sync('TThread::__syncFull', igbinary_serialize($args));
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
            return call_user_func([$this, 'get_'.$name]);
            
        $result = igbinary_unserialize(gui_threadData($this->self, $name));
	return $result;
    }
    
    public function __set($name, $value){

        if ( method_exists($this, 'set_' . $name) )
            return call_user_func([$this, 'set_'.$name], $value);
        
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
        dsErrorDebug::init();
        if ( class_exists('DS_Loader',false) )
              DS_Loader::InitLoader(true);
    }
}

Timer::setInterval('TThread::checkPool', 1000);


function v($name, $value = null){
    
    return enc_v($name, $value);
}

function enc_v($name, $value = null){
    
    if ($value === null)
        return enc_getValue( $name );
    else
        enc_setValue( $name, urlencode(serialize($value)) );
}

function define_ex($name, $value){
    
    define($name, $value, false);
}
?>