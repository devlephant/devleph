<?
class TSampleDialog extends __TNoVisual {
    
    
    #title
    #buttons
	
    static function doButtonClick($self){
	
	$obj = _c($self);
	
	if (c($obj->link)->resultAsText)
	    c($obj->frm)->result = $obj->caption;
	else
	    c($obj->frm)->result = $obj->id;
	
	c($obj->frm)->close();
    }
    
    static function doKeyUp($self, $key){
	
	$obj = _c($self);
	
	if ( $key == VK_ESCAPE ){
	    
	    c($obj->frm)->result = false;
	    c($obj->frm)->close();
	}
	
	if ( c($obj->link)->useHotKey ){
	    
	    $buttons = c($obj->link)->buttons;
	    if (!is_array($buttons))
		$buttons = explode(_BR_, $buttons);
		    
	    $id = (int)chr($key)-1;
	    
	    if ( $buttons[$id] ){
		if (c($obj->link)->resultAsText)
		    c($obj->frm)->result = $buttons[$id];
		else
		    c($obj->frm)->result = $id;
		
		c($obj->frm)->close();
	    }
	}
    }
    
    function selectDialog($title, $buttons, &$result){
	
	if (!is_array($buttons))
	    $buttons = explode(_BR_, $buttons);
	    
	    
	$frm = new TForm;
	$frm->caption = t($this->formCaption);
	$frm->borderIcons = 'biSystemMenu';
	
	if ( $this->formColor )
	    $frm->color = $this->formColor;
	    
	$frm->w = 300;
	$frm->position = poScreenCenter;
	$frm->borderStyle = bsDialog;
	$frm->result = $result;
	
	$label = new TLabel($frm);
	$label->x = 10;
	$label->y = 10;
	$label->parent = $frm;
	$label->alignment = taCenter;
	$label->font->assign($this->font);
	$label->caption = $title;
	
	$x = 10;
	$y = $label->h + $label->y + 5;
	$fW = $label->w + 25;
	
	$aW = ($this->buttonsWidth+10) * count($buttons) - 14;
	if ( $fW < $aW ){
	    $fW = $aW + 25;    
	}
	
	$frm->w = $fW;
	$label->x = round(($fW/2)-($label->w/2));
	
	$x  = round(($fW / 2) - ($aW / 2));
	
	foreach ($buttons as $id=>$btn){
	   
	    $b = new TBitBtn($frm);
	    $b->parent = $frm;
	    $b->w = $this->buttonsWidth;
	    $b->h = $this->buttonsHeight;
	    $b->x = $x;
	    $b->y = $y + 10;
	    $x += $b->w + 5;
	    
	    $b->id = $id;
	    
	    if (is_string($this->cursorDialog))
		$b->cursor = constant($this->cursorDialog);
	    else {
		$b->cursor = $this->cursorDialog;
	    }
	    
	    $b->frm = $frm->self;
	    $b->caption = t($btn);
	    $b->onClick = 'TSampleDialog::doButtonClick';
	    $b->onKeyUp = 'TSampleDialog::doKeyUp';
	    $b->font->name = $label->font->name;
	    $b->font->size = $this->buttonFSize;
	    $b->font->color= $this->buttonFColor;
	    
	    $b->link = $this->self;
	    if ($id == $this->buttonFocus)
		$b->setFocus();
	}
	
	$frm->h = $b->y + $b->h + 45;
	   
	$frm->showModal();
	$result = $frm->result;
	$frm->free();
	if ($result===false)
	    return false;
	else
	    return true;
    }
    
    function __construct($onwer=nil,$init=true,$self=nil){
	parent::__construct($onwer,$init,$self);
    	
        if ($init){
	    
	    $props = array('cursorDialog'=>crHandPoint, 'buttonsWidth'=>80, 'buttonsHeight'=>25,
                         'buttonFocus'=>0,'formColor'=>0xE6E6E6,'useHotKey'=>true,
                         'buttonFSize'=>8,'buttonFColor'=>clBlack);
	    
	    foreach ($props as $prop=>$val)
		$this->$prop = $val;
        }
    }
    
    function execute(){
		
		if ($this->resultAsText)
		    $result = false;
		else    
		    $result = -1;
		    
                $title  = $this->title ? $this->title : '';
                
		if ($this->selectDialog($this->title, $this->buttons, $result)){
			
			if ($result!==-1){
			$this->filename = $result;
			$this->result   = $result;
			
			if($this->onSelect){
			    eval($this->onSelect.'('.$this->self.');');
			}
			
			return $result;
			}
		}
		
	if ($this->resultAsText)
	    return false;
	else
	    return -1;
    }

}
?>