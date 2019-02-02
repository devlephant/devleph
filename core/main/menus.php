<?
/*
  
  SoulEngine Menu Library
  
  2016 ver 1.2
  
  Kashaket Company (c) 2016
  
*/


class styleMenu {
	
	// add to style menu main or popup
	static function add($menu){
		stylemenu_command($menu->self, 'add', null);
	}
	
	static function addItem($item){
		stylemenu_command($item->self, 'additem', null);
	}
	
	static function param($name,$value = false){
		if ($value)
			stylemenu_command(0, $name, $color);
		else
			return stylemenu_command(0, $name, null);
	}
	
	static function selectedColor($color = false){ return self::param('selectedcolor',$color); }
	static function menuColor($color = false){ return self::param('menucolor',$color); }
	static function gutterColor($color = false) { return self::param('guttercolor', $color); }
	static function minHeight($v = false){ return self::param('minheight',$v); }
	static function minWidth($v = false) { return self::param('minwidth', $v); }
}


function menuDinamicSetText($menu, $text){
	
	$arr = explode($text);
	
	foreach ($arr as $el){
		
		$item = explode('|', $el);
		$caption = $item[0];
		$x = new TMenuItem($menu);
		$x->caption = $caption;
		if ($item[1]){
			$x->loadPicture($item[1]);
		}
		if ($item[2]){
			$x->onClick = $item[2];
		}
		$menu->addItem($x);
	}
}

class TMainMenu extends TControl {
	public $class_name = __CLASS__;	
	
	function set_images(TImageList $il){
		//rtti_set($this, 'Images', $il->self);
	}
	
	function get_images(){
		
		//return _c(rtti_get($this, 'Images'));
	}
	
	function get_items(){
		
		return _c( rtti_get($this, 'Items') );
	}
	
	function addItem(TMenuItem $item, $parent_item = false){
		
		if ($parent_item)
			$parent_item->addItem($item);
		else
			mainmenu_additem($this->self, $item->self);
	}
}

function menuItem($caption, $styled = false, $name = '', $onClick = '', $sc = false, $img = false){
	
	$result = new TMenuItem;
	if ($name)
		$result->name = $name;
	
	if ($onClick)
		$result->onClick = $onClick;
	
	$result->caption = $caption;
	if ($sc)
		$result->shortCut = $sc;
	if ($img){
		
		if (file_exists( replaceSl($img) ))
			$result->picture->loadFromFile( replaceSr($img) );
		else
			if (file_exists( replaceSl(DOC_ROOT.'/'.$img) ))	
			$result->picture->loadFromFile( replaceSr(DOC_ROOT.'/'.$img) );
	}
		
	if ($styled)
		styleMenu::addItem($result);
		
	return $result;
}

class TMenuItem extends TControl {
	public $class_name = __CLASS__;
	public $picture;
	
	public function __construct($onwer=nil, $init=true, $self=nil){
		parent::__construct($onwer,$init,$self);
		$this->picture = new TBitmap(false);
		$this->picture->self = __rtti_link($this->self,'Bitmap');
		
		$this->picture->parent_object = $this->self;
	}
	
	public function loadPicture($file){
		
		$this->picture->loadAnyFile($file);
	}
	
	
	function set_visible($v){
		$this->set_prop('visible', (bool)$v);
	}
	
	function get_visible(){
		
		return $this->get_prop('visible');
	}
	
	function set_enabled($v){
		$this->set_prop('enabled', (bool)$v);
	}
	
	function get_enabled(){
		
		return $this->get_prop('enabled');
	}
	
	public function set_shortCut($sc){
		
		if (!is_numeric($sc))
			$sc = text_to_shortcut(strtoupper($sc));
		$this->set_prop('shortCut',$sc);
	}
	
	public function get_shortCut(){
		
		$result = $this->get_prop('shortCut');
		return shortCut_to_text($result);
	}
	
	public function addItem(TMenuItem $item){
		
		popup_additemex($this->self, $item->self);
	}
	
	public function clear(){
		menuitem_clear($this->self);
	}
	
	public function delete($index){
		menuitem_delete($this->self, $index);
	}
	
	public function insert($index, TMenuItem $item){
		menu_insert($this->self, (int)$index, $item->self);
	}
	
	public function insertAfter(TMenuItem $after, TMenuItem $item){
		
		$index = $this->indexOf($after);
		
		if ($index >= 0){
			$this->insert($index+1, $item);
		}
	}
	
	public function insertBefore(TMenuItem $after, TMenuItem $item){
		
		$index = $this->indexOf($after);
		
		if ($index >= 0)
			$this->insert($index, $item);
	}
	
	public function find($caption){
		return _c( menu_find($this->self, (string)$caption) );
	}
	
	public function get_index(){
		return menu_index($this->self);
	}
	
	public function indexOf(TMenuItem $item){
		
		return menu_indexOf($this->self, $item->self);
	}
	
	public function get_parent(){
		
		return _c(menu_parent($this->self));
	}
}

class TMenu extends TControl {
	public $class_name = __CLASS__;
	
	function set_images(TImageList $images){
		imagelist_set_images($this->self, $images->self);
	}
}

class TPopupMenu extends TControl {
	public $class_name = __CLASS__;
	

	function popup($x,$y){
		
		popup_popup($this->self, (int)$x, (int)$y);
	}
	
	function addItem(TMenuItem $item, $parent_item = false){
		
		if ($parent_item)
			$parent_item->addItem($item);
		else
			popup_additem($this->self, $item->self);
	}
	
	function set_images(TImageList $images){
		imagelist_set_images($this->self, $images->self);
	}
	
	function get_items(){
		$result = array();
		for ($i=0;$i<popup_item_count($this->self)-1;$i++){
			$result[] = _c(popup_item_id($this->self, $i));
		}
		
		return $result;
	}
	
	function isShow(){
		
		return popup_isshow($this->self);
	}
}

?>