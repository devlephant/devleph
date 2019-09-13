<?
class TOpenDialogEx extends __TNoVisual {
    
    
    
    public function __construct($onwer=nil,$self=nil){
        parent::__construct($onwer,$self);
                
        if ($self==nil){
            $this->filter = 'All files (*.*)|*.*';
            $this->filterIndex = 1;
        }
    }

    public function __initComponentInfo(){
        
        parent::__initComponentInfo();
        $md = new TOpenDialog($this->parent);
        $md->filter   = str_replace(_BR_,'|',$this->filter);
        $md->defaultExt = $this->defaultExt;
        $md->fileName = $this->fileName;
        $md->filterIndex = $this->filterIndex;
        $md->initialDir = $this->initialDir;
        $md->title = $this->title;
        $md->smallMode = $this->smallMode;
        $md->multiSelect = $this->multiSelect;
        $tmp = $this->name;
        $this->name = '';
        $md->name = $tmp;
        eventEngine::updateIndex($md);
    }

}
?>