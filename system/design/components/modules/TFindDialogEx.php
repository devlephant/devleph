<?

class TFindDialogEx extends __TNoVisual {
    
    

    public function __construct($onwer=nil,$self=nil){
        parent::__construct($onwer,$self);
          
        if ($self==nil){
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