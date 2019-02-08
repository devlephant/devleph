<?

global $_c;

$_c->setConstList(array('apFirst', 'apLast'),0);

class TNextInspector extends TControl {
    
    public $class_name = 'TNextInspector';
    
    public function add(TNxPropertyItem $item, $caption = ''){
        
        return vs_inspector_add($this->self, $item->self, $item->class_name, $caption);
    }
    
    public function addFirst(TNxPropertyItem $item, $caption = ''){
        
        return vs_inspector_addFirst($this->self, $item->self, $item->class_name, $caption);
    }
    
    public function addItem($parent, $item, $pos = apLast){
        
        $p = is_object($parent) ? $parent->self : null;
        vs_inspector_addItem($this->self, $p, $item->self, $pos);
    }
    
    public function unFocus(){
	vs_inspector_unfocus($this->self);
    }
    
    public function get_selectedIndex(){
		return vs_inspector_selectedIndex($this->self,null);
    }
    
    public function set_selectedIndex($v){
		vs_inspector_selectedIndex($this->self,$v);
    }
    
    public function set_onVSChange($v){
        $this->onChange = $v;
    }
    
    public function set_onVSEdit($v){
        $this->onEdit = $v;
    }
    
    public function set_onVSToolbarClick($v){
	$this->onToolbarClick = $v;
    }
}

class TNxPropertyItem extends TControl {
    
    public $class_name = 'TNxPropertyItem';
    public $valueFont;
    
    public function font($prop, $value = null){
        
        return vs_item_font($this->self, $prop, $value, false);
    }
    
    public function valueFont($prop, $value = null){
	
        return vs_item_font($this->self, $prop, $value, true);
    }
    
    public function set_fontName($v){ $this->font('name',$v); }
    public function get_fontName(){ return $this->font('name'); }
}

class TNxToolbarItem extends TNxPropertyItem {
    
    public $class_name = 'TNxToolbarItem';
    
    public function addItem($class, $caption){
        
        //$class = str_ireplace('Nx','VS', $class);
        
        return  vs_item_add($this->self, $class, $caption);
    }
    
    public function add($item, $caption){
        
        return $this->addItem($item->class_name, $caption);
    }
}

class TNxButtonItem extends TNxPropertyItem {
    
    public $class_name = 'TNxButtonItem';
    #onButtonClick
    
    public $picture;
	
	public function __construct($onwer=nil, $init=true, $self=nil){
		parent::__construct($onwer,$init,$self);
		$this->picture = new TBitmap(false);
		$this->picture->self = __rtti_link($this->self,'Glyph');
		
		$this->picture->parent_object = $this->self;
		$this->__setAllPropEx();
	}
	
	public function loadPicture($file){
		
		$this->picture->loadAnyFile($file);
	}
	
	public function loadFromBitmap($bt){
		
		$this->picture->assign($bt);
	}
}

class TNxTextItem extends TNxPropertyItem {
    
    public $class_name = 'TNxTextItem';
}

class TNxPopupItem extends TNxPropertyItem {
    
    public $class_name = 'TNxPopupItem';
}

class TNxComboBoxItem extends TNxPropertyItem {
    
    public $class_name = 'TNxComboBoxItem';
    
    public function set_text($v){
        
        if (is_array($v)) $v = implode(_BR_, $v);
        
        vs_item_lines($this->self, $v);
    }
    
    public function get_text(){
        return vs_item_lines($this->self, null);
    }
}

class TNxCheckBoxItem extends TNxPropertyItem {
    
    public $class_name = 'TNxCheckBoxItem';
}

class TNxSpinItem extends TNxPropertyItem {
    
    public $class_name = 'TNxSpinItem';
}
//startmy
class TNxCalcEdit extends TControl
{	public $class_name = __CLASS__;
}
class TNxFolderEdit extends TControl
{	public $class_name = __CLASS__;
}
class TNxImagePathEdit extends TControl
{	public $class_name = __CLASS__;
}
class TNxCheckBox extends TControl
{	public $class_name = __CLASS__;
}
class TNxComboBox extends TControl
{	public $class_name = __CLASS__;
}
class TNxDatePicker extends TControl
{	public $class_name = __CLASS__;
}
class TNxFontComboBox extends TControl
{	public $class_name = __CLASS__;
}
class TNxSpinEdit extends TControl
{	public $class_name = __CLASS__;
}
class TNxEdit extends TControl
{	public $class_name = __CLASS__;
}
class TNxMemo extends TControl
{	public $class_name = __CLASS__;
}
class TNxMemoInplaceEdit extends TControl
{	public $class_name = __CLASS__;
}
class TNxNumberEdit extends TControl
{	public $class_name = __CLASS__;
}
class TNxRadioButton extends TControl
{	public $class_name = __CLASS__;
}
class TNxTimeEdit extends TControl
{	public $class_name = __CLASS__;
}
class TNxMonthCalendar extends TControl
{	public $class_name = __CLASS__;
}
class TNxTimePicker extends TControl
{	public $class_name = __CLASS__;
}
?>