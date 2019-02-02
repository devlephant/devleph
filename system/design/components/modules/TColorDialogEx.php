<?

class TColorDialogEx extends __TNoVisual {
    
    public $class_name_ex = __CLASS__;

    public function __construct($onwer=nil,$init=true,$self=nil){
        parent::__construct($onwer, $init, $self);
          
        if ($init){
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