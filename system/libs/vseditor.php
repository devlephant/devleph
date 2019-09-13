<?

global $_c;

$_c->setConstList(array('apFirst', 'apLast'),0);
class TNxPropertyItems extends TControl {}
class TNextInspector extends TControl
{    
    public function add(TNxPropertyItem $item, $caption = '')
	{
        return $this->items->AddChild($item, get_class($item), $caption);
    }
    public function addFirst(TNxPropertyItem $item, $caption = '')
	{    
        return $this->items->AddChildFirst($item, get_class($item), $caption);
    }
    public function addItem($parent, $item, $pos = apLast)
	{
        vs_inspector_addItem($this->self, is_object($parent)?$parent->self:null, $item->self, $pos);
    }
    public function unFocus()
	{
		$this->SelectedIndex = 0;
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

class TNxPropertyItem extends TControl{}
class TNxToolbarItem extends TNxPropertyItem 
{
    public function addItem($class, $caption)
	{
	   return $this->AddChild($class, $caption);
    }    
    public function add($item, $caption){
		
        return $this->addItem(get_class($item), $caption);
    }
}
class TNxButtonItem extends TNxPropertyItem {
    #onButtonClick
    
    public $picture;
	
	public function __construct($onwer=nil,$self=nil){
		parent::__construct($onwer,$self);
		$this->picture = new TBitmap(nil,gui_propGet($this->self,'Glyph'));
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
class TNxComboBoxItem extends TNxPropertyItem
{
    public function set_text($v)
	{        
        $this->lines->text = is_array($v)?implode(_BR_,$v):$v;
    }
    
    public function get_text(){
        return $this->lines->text;
    }
}

class TNxCheckBoxItem extends TNxPropertyItem{	}
class TNxSpinItem extends TNxPropertyItem{	}
class TNxCalcEdit extends TControl{	}
class TNxFolderEdit extends TControl{	}
class TNxImagePathEdit extends TControl{	}
class TNxCheckBox extends TControl{	}
class TNxComboBox extends TControl{	}
class TNxDatePicker extends TControl{	}
class TNxFontComboBox extends TControl{	}
class TNxSpinEdit extends TControl{	}
class TNxEdit extends TControl{	}
class TNxMemo extends TControl{	}
class TNxMemoInplaceEdit extends TControl{	}
class TNxNumberEdit extends TControl{	}
class TNxRadioButton extends TControl{	}
class TNxTimeEdit extends TControl{	}
class TNxMonthCalendar extends TControl{	}
class TNxTimePicker extends TControl{	}
?>