<?


class LIST_editor {
    
    public $obj;
    
    public $use_quote;
    public $quote_params;
    public $to_quote;
    
    function create($form, $action, $editor, $y){
        
        $label = new TLabel($form);
        $label->parent = $form;
        $label->caption = $editor['CAPTION'] . ':';
        $label->x = 10;
        $label->y = $y;
        
        $obj = new TListBox($form);
        $obj->parent = $form;
        
        $obj->w = $form->w - 20;
        $obj->x = 10;
        $obj->y = $y + $label->h + 5;
        
        $obj->h = $editor['H'] ? $editor['H'] : 100;
        $obj->onKeyDown = 'LIST_editor::enterKeyDown';
        
        $obj->multiSelect = true;
        if ($editor['NO_MULTI'])
            $obj->multiSelect = false;
        
        $obj->items->setArray($editor['VALUES']);
        $obj->itemIndex = $editor['ITEM_INDEX'] ? $editor['ITEM_INDEX'] : 0;
        
        $this->use_quote = $editor['USE_QUOTE'];
        $this->quote_params = $editor['QUOTE_PARAMS'];
        
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
        
        $value = preg_replace('#array\((.*)\)#','$1',$value);
        $arr = explode(',', $value);
        
        foreach ($arr as $i=>$el){
            $arr[$i] = trim($el);
            if ($this->quote_params)
                $arr[$i] = action_Simple::trimQuote($el);
        }
            
        
        $this->obj->setSelected($arr);
    }
    
    function getValue(){
        
        $arr = $this->obj->getSelected();
        if ($this->quote_params)
            $result = 'array("' . implode('", "', $arr) . '")';
        else
            $result = 'array(' . implode(', ', $arr) . ')';
        
        return $result;
    }
}