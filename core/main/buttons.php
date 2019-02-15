<?
/*
  
  SoulEngine Buttons Library
  
  2009 ver 0.1
  
  Dim-S Software (c) 2009
  
*/

global $_c;

$_c->setConstList(array('blGlyphLeft', 'blGlyphRight', 'blGlyphTop', 'blGlyphBottom'),0);

class TButton extends TControl {
	
}

class TBitBtn extends TControl {
	
	protected $_picture;
	
	public function get_picture(){
		
		if (!isset($this->_picture)){
			$this->_picture = new TBitmap(nil,false);
			$this->_picture->self = gui_propGet($this->self,'Glyph');
			$this->_picture->parent_object = $this->self;
		}
		
		return $this->_picture;
	}
	
	public function doClick(){
		
		call_user_func(event_get($this->self, 'onClick'), $this->self);
	}
	
	public function loadPicture($file){
		$this->picture->loadAnyFile($file);
	}
	
	public function loadFromBitmap($bt){
		$this->picture->assign($bt);
	}
}

class TSpeedButton extends TBitBtn {
	
}

class TPNGGlyph {
	
	public $self;
	
	public function __construct($self){
		$this->self = $self;	
	}
	
	public function assign($pic){
		
		if ( !gui_btnPNGAssign($this->self, $pic->self) ){
			_c($this->self)->picture->assign($pic);
		}
	}
	
	public function loadFromFile($file){
		
		if ( fileExt($file) == 'png' )
			_c($this->self)->loadPNGFile($file);
		else
			_c($this->self)->picture->loadFromFile($file);
	}
	
	public function loadAnyFile($filename){
		$this->loadFromFile($filename);
    }
	
	public function loadPNGStr($str){
		_c($this->self)->loadPNGFile($str);
	}
	
	public function isEmpty(){
		return gui_btnPngIsEmpty($this->self) && _c($this->self)->picture->isEmpty();
	}
}

class TPNGSpeedButton extends TBitBtn {
	
	
	protected $_pngpicture;
	
	function __construct($onwer=nil,$init=true,$self=nil){
		parent::__construct($onwer,$init,$self);
		
		if ($init){
			$this->Spacing = 12;
		}
	}
	
	public function get_pngpicture(){
		
		if (!isset($this->_pngpicture))
			$this->_pngpicture = new TPNGGlyph($this->self);
		
		return $this->_pngpicture;
	}
	
	public function loadPNGStr( $data ){
		gui_btnPNGLoadStr($this->self, $data);
	}
	
	public function loadPNGFile( $file ){
		gui_btnPNGLoadFile($this->self, $file);
	}
	
	public function getPNGStr(){
		return gui_btnPNGGetStr($this->self);
	}
}

class TPNGBitBtn extends TPNGSpeedButton {
	
	

}

?>