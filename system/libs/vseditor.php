<?

global $_c;

$_c->setConstList(array('apFirst', 'apLast'),0);

class TNextInspector extends TControl {
    
    public function add(TNxPropertyItem $item, $caption = ''){
        
        return vs_inspector_add($this->self, $item->self, get_class($item), $caption);
    }
    
    public function addFirst(TNxPropertyItem $item, $caption = ''){
        
        return vs_inspector_addFirst($this->self, $item->self, get_class($item), $caption);
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
    
    public function addItem($class, $caption){
        
        //$class = str_ireplace('Nx','VS', $class);
        
        return  vs_item_add($this->self, $class, $caption);
    }
    
    public function add($item, $caption){
        
        return $this->addItem(get_class($item), $caption);
    }
}

class TNxButtonItem extends TNxPropertyItem {
    #onButtonClick
    
    public $picture;
	
	public function __construct($onwer=nil, $init=true, $self=nil){
		parent::__construct($onwer,$init,$self);
		$this->picture = new TBitmap(nil,false);
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

class TNxTextItem extends TNxPropertyItem {}

class TNxPopupItem extends TNxPropertyItem {}

class TNxComboBoxItem extends TNxPropertyItem {
    public function set_text($v){
        
        if (is_array($v)) $v = implode(_BR_, $v);
        
        vs_item_lines($this->self, $v);
    }
    
    public function get_text(){
        return vs_item_lines($this->self, null);
    }
}

class TNxCheckBoxItem extends TNxPropertyItem {}

class TNxSpinItem extends TNxPropertyItem {}
//startmy
class TNxCalcEdit extends TControl
{	
}
class TNxFolderEdit extends TControl
{	
}
class TNxImagePathEdit extends TControl
{	
}
class TNxCheckBox extends TControl
{	
}
class TNxComboBox extends TControl
{	
}
class TNxDatePicker extends TControl
{	
}
class TNxFontComboBox extends TControl
{	
}
class TNxSpinEdit extends TControl
{	
}
class TNxEdit extends TControl
{	
}
class TNxMemo extends TControl
{	
}
class TNxMemoInplaceEdit extends TControl
{	
}
class TNxNumberEdit extends TControl
{	
}
class TNxRadioButton extends TControl
{	
}
class TNxTimeEdit extends TControl
{	
}
class TNxMonthCalendar extends TControl
{	
}
class TNxTimePicker extends TControl
{	
}
?>