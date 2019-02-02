<?

class TReplaceDialogEx extends __TNoVisual {
    
    public $class_name_ex = __CLASS__;

    public function __construct($onwer=nil,$init=true,$self=nil){
        parent::__construct($onwer, $init, $self);
          
        if ($init){
            $this->findText = "";
			$this->replaceText = "";
        }
    }
    
    public function __initComponentInfo(){
        
        parent::__initComponentInfo();
        $md = new TReplaceDialog($this->parent);
        $md->findText      = $this->findText;
		$md->replaceText   = $this->ReplaceText;
        
        $tmp = $this->name;
        $this->name = '';
        $md->name = $tmp;
        eventEngine::updateIndex($md);
    }
	
	function setParent($obj){
	$this->parent = $obj->self;
	}
}
?>