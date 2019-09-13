<?

class TReplaceDialogEx extends __TNoVisual {
    
    

    public function __construct($onwer=nil,$self=nil){
        parent::__construct($onwer,$self);
          
        if ($self==nil){
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