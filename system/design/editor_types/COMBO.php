<?


class COMBO_editor {
    
    public $obj;
    
    public $use_quote;
    public $to_quote;
    
    function create($form, $action, $editor, $y){
        
        $label = new TLabel($form);
        $label->parent = $form;
        $label->caption = $editor['CAPTION'] . 'sass:';
        $label->x = 10;
        $label->y = $y;
        
        $obj = new TComboBox($form);
        $obj->parent = $form;
        
        $obj->w = $form->w - 20;
        $obj->x = 10;
        $obj->y = $y + $label->h + 5;
        $obj->onKeyDown = 'COMBO_editor::enterKeyDown';
        //if(current($editor['VALUES'])
        $obj->items->setArray($editor['VALUES']);
        $obj->itemIndex = $editor['ITEM_INDEX'] ? $editor['ITEM_INDEX'] : 0;
        
        $this->use_quote = $editor['USE_QUOTE'];
        
        $this->obj = $obj;
        
        
        return $obj->h + 5 + $label+h;
    }
    
    function enterKeyDown($self, $key){
        
        // x_x
        $form = _c(_c(_c($self)->owner)->owner);
        if ($key==VK_RETURN){
            
           $form->close();
           $form->modalResult = mrOk;
           
        } elseif ($key==VK_ESCAPE)
            $form->close();
    }
    
    function setValue($value){
        
        $this->obj->inText = $value;
        $this->obj->items->selected = $value;
    }
    
    function getValue(){
        
        return $this->obj->inText;
        return $this->obj->items->selected;
    }
}