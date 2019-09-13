<?
class TFontDialogEx extends __TNoVisual {
    
    

    public function __construct($onwer=nil,$self=nil){
        parent::__construct($onwer,$self);
          
        if ($self==nil){
            $this->maxFontSize = 0;
            $this->minFontSize = 0;
            $this->device = fdScreen;
        }
    }
    
    public function __initComponentInfo(){
        
        parent::__initComponentInfo();
        $md = new TFontDialog($this->parent);
        $md->minFontSize = $this->minFontSize;
        $md->maxFontSize = $this->maxFontSize;
        $md->device      = $this->device;
        
        $tmp = $this->name;
        $this->name = '';
        $md->name = $tmp;
        eventEngine::updateIndex($md);
    }
}
?>