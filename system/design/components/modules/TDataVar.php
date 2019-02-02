<?

$GLOBALS['__EVENTS_API']['onstartchange'] = 'TDataVar::callStartChange';

class TDataVar extends __TNoVisual {
    
    public $class_name_ex = __CLASS__;
    #public $icon = 'F';
    #value
    #fileName
    
    static function callStartChange($self){
        
        __exEvents::callEventEx($self, array(), 'OnStartChange');
    }
    
    public function __inspectProperties(){
	
	return array('varName');
    }
    
    public function __initComponentInfo(){
	
	parent::__initComponentInfo();
	$this->value = $this->avalue;
	
	if ($this->varName){
	    __exEvents::addGlobalVar($this->varName);
	}
    }
    
    public function __construct($onwer=nil,$init=true,$self=nil){
	parent::__construct($onwer, $init, $self);
	
	if ($init){
	    $this->serialize = true;
	}
    }
    
    public function md5(){
	return md5($this->value);
    }
    
    public function toLower(){
	return strtolower($this->value); 
    }
    
    public function toUpper(){
	return strtoupper($this->value);
    }
    
    public function trim(){
	return trim($this->value);
    }
    
    public function crc32(){
	return crc32($this->value);
    }
    
    public function load(){
	
	$file = getFileName($this->fileName);
	if (file_exists($file)){
	    if ($this->serialize)
		$this->value = unserialize( file_get_contents($file) );
	    else
		$this->value = file_get_contents($file);
	}
    }
    
    public function save(){
	
	if ($this->fileName){
	    if ($this->serialize)
		file_p_contents($this->fileName, serialize($this->value) );
	    else
		file_p_contents($this->fileName, ($this->value) );
	}
    }
    
    public function get_value(){
	
	if (!$GLOBALS['APP_DESIGN_MODE'] && $this->varName){
	    return $GLOBALS[$this->varName];
	}
	
	return $this->avalue;
    }
    
    public function set_value($v){
	
	if ($this->onStartChange){
	    eval($this->onStartChange.'('.$this->self.');');    
	}
	
	$this->avalue = $v;
	
	if (!$GLOBALS['APP_DESIGN_MODE'] && $this->varName){
	    $GLOBALS[$this->varName] = $v;
	}
	
	if ($this->setObject){
	    val($this->setObject, $v);
	}
	
	if ($this->onChange){
	    eval($this->onChange.'('.$this->self.');');
	}
	
	if ($this->updateChange)
	    $this->save();
    }
}
?>