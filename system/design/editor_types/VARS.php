<?


class VARS_editor {
    
    public $obj;
    
    public $use_quote;
    public $to_quote;
    
    function create($form, $action, $editor, $y){
        
        $label = new TLabel($form);
        $label->parent = $form;
        $label->caption = $editor['CAPTION'] . ':';
        $label->x = 10;
        $label->y = $y;
        
        $obj = new TComboBox($form);
        $obj->parent = $form;
        
        $obj->w = $form->w - 20;
        $obj->x = 10;
        $obj->y = $y + $label->h + 5;
        $obj->onKeyDown = 'VARS_editor::enterKeyDown';
        
        $obj->font->color = clGreen;
        $obj->font->style = 'fsBold';
        $obj->font->size  = 9;
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
    
    function openDialog(){
        
        $vars = INPUT_DLG_editor::getLocalVars();
        $this->obj->items->setArray($vars);
    }
    
    function setValue($value){
        
        $this->obj->inText = $value;
        $this->obj->items->selected = $value;
    }
    
    function getValue(){
        
        $text = $this->obj->inText;
        
        $tmp = '';
        for($i=0;$i<strlen($text);$i++){
            if (strpos('qwertyuiopasdfghjklzxcvbnm0123456789_$',$text[$i])!==false)
                $tmp .= $text[$i];
        }
        
        if (strlen($tmp)==0) $tmp = '$x';
        elseif ($tmp[0]!=='$') $tmp = '$'.$tmp;
        
        return $tmp;
    }
}