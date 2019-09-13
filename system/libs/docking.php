<?

class TDockTabSet extends TControl {
    
}

class TDock extends TForm{
	
	
	public function __construct($onwer=nil,$self=nil){
		parent::__construct($onwer,$self);
		if ($self==nil){
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