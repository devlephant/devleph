<?

class TFindDialogEx extends __TNoVisual {
    
    

    public function __construct($onwer=nil,$init=true,$self=nil){
        parent::__construct($onwer, $init, $self);
          
        if ($init){
            $this->findText = "";
        }
    }
    
    public function __initComponentInfo(){
        
        parent::__initComponentInfo();
        $md = new TFindDialog($this->parent);
        $md->findText      = $this->findText;
        
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