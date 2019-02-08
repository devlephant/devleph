<?

class TDockTabSet extends TControl {
    public $class_name = __CLASS__;
}

class TDock extends TForm{
	
	public $class_name = __CLASS__;
	public function __construct($onwer=nil, $init=true, $self=nil){
		parent::__construct($onwer,$init,$self);
		if ($init){
			$this->dragKind = dkDock;
			$this->dragMode = dmAutomatic;
		}
	}
}

class Docking {
    
    static function saveFile($panel, $file){
        
        $panel->dockSaveToFile($file);
    }
    
    static function loadFile($panel, $file){
        
        $panel->dockLoadFromFile($file);
    }
}
?>