<?


class TSQUALLPlayer extends __TNoVisual {
    
    public $class_name_ex = __CLASS__;
    
    public function __construct($onwer=nil,$init=true,$self=nil){
        parent::__construct($onwer, $init, $self);
                
        if ($init){
            $this->pan = 50;
            $this->volume = 100;
            $this->frequency = 0;
            $this->loop = true;
            $this->priority = 255;
            $this->positionPr = 0;
            $this->playOnStart = true;
        }
    }
    
    public function __initComponentInfo(){
        
        parent::__initComponentInfo();
        
        $md = new SQUALL_Player($this->parent);
        
        $md->apan       = $this->pan;
        $md->avolume    = $this->volume;
        $md->afrequency = $this->frequency;
        $md->aloop      = $this->loop;
        $md->fileName   = $this->fileName;
        $md->apositionPr = $this->positionPr;
        $md->onEndTrack = $this->onEndTrack;
        $md->onStartTrack = $this->onStartTrack;
        
        
        
        if ($this->playOnStart)
            $md->play();
        
        $tmp = $this->name;
        $this->name = '';
        $md->name = $tmp;
        eventEngine::updateIndex($md);
    }
}

?>