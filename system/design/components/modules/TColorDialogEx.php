<?

class TColorDialogEx extends __TNoVisual {
    
    

    public function __construct($onwer=nil,$self=nil){
        parent::__construct($onwer,$self);
          
        if ($self==nil){
            $this->color = 0x0;
        }
    }
    
    public function __initComponentInfo(){
        
        parent::__initComponentInfo();
        $md = new TColorDialog($this->parent);
        $md->color = $this->color;
        $md->smallMode = $this->smallMode;
        
        $tmp = $this->name;
        $this->name = '';
        $md->name = $tmp;
        eventEngine::updateIndex($md);
    }
}
?>