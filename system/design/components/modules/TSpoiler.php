
<?
class TSpoiler Extends TPanel{
	private $opened;
	public $_btn;
	public $_cap;
	
	
	public function __construct($owner=nil, $init=true, $self=nil){
		parent::__construct($owner,$init,$self);
	
		if($init){
			$this->wClose = 40;
			$this->hClose = 20;
			$this->wOpen = 120;
			$this->hOpen = 240;
			$this->opened = false;
		}
	$this->get_btn();
	//$this->get_cap();
	
	}
	public function get_btn(){
		if (!isset($this->_btn)){
			$this->_btn = new TBitBtn(false);
			$this->_btn->parent = $this->self;
			$this->_btn->h = 12;
			$this->_btn->x = 4;
			$this->_btn->y = 1;
			$this->_btn->caption = '+';
			$this->_btn->anchors = 'akLeft, akTop';
			event_set($this->self->_btn, 'onMouseDown', 'TSpoiler::doSwitch');
			$this->_btn->self =  gui_propGet($this->self,'btn');
			
		} return $this->_btn;
	}
	public function get_cap(){
		if(!isset($this->_cap)){
			$this->_cap = new TLabel(false);
			$this->_cap->parent_object = $this->self;
			$this->_cap->h = $this->h;
			$bn = $this->get_btn();
			$this->_cap->w = $this->w - $bn->w;
			$this->_cap->x = $bn->x = $this->_cap->w;
			$this->_cap->anchors = 'akRight, akTop';
			$this->_cap->self = gui_propGet($this->self,'cap');
		} return $this->_cap;
	}
	protected function open(){
		$bn = $this->get_btn();
		$this->h = $this->hOpen;
		$this->w = $this->wOpen;
		$bn->caption = '-';
	} protected function close(){
		$bn = $this->get_btn;
		$this->h = $this->hClose;
		$this->w = $this->wClose;
		$bn->caption = '+';
	}
	public function doSwitch(){
		if( $this->h !== $this->hOpen && $this->w !== $this->wOpen ){
			$this->open();
		}elseIf( $this->h !== $this->hClose && $this->w !== $this->wClose ){ $this->close(); }
	}
	public function getOpened(){
		return $this->opened;
	}
	public function setOpened( $v ){
		if($v==1){ $this->open(); }else{ $this->close(); }
	}
}