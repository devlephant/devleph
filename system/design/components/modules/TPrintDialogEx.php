<?

class TPrintDialogEx extends __TNoVisual {

	

	public function __initComponentInfo(){
		parent::__initComponentInfo();
		
		$dlg = new TPrintDialog($this->parent);
		$dlg->fromPage = $this->fromPage;
		$dlg->toPage = $this->toPage;
		$dlg->printToFile = $this->printToFile;
		$dlg->copies = $this->copies;
		$dlg->collate = $this->collate;
		
		$tmp = $this->name;
        $this->name = '';
        $dlg->name = $tmp;
        eventEngine::updateIndex($dlg);
	}
	
	public function __construct($owner = nil,$self = nil){
		parent::__construct($owner,$self);
		
		if ( $self==nil ){
		
			$this->fromPage = 0;
			$this->toPage = 0;
			$this->printToFile = false;
			$this->copies = 1;
			$this->collate = false;
		
		}
	}
}