<?


class CHECK_editor {
    
    public $obj;
    
    public $use_quote;
    public $to_quote;
    
    function create($form, $action, $editor, $y){
        
        $obj = new TCheckBox($form);
        $obj->parent = $form;
        $obj->caption = $editor['CAPTION'];
        $obj->x = 10;
        $obj->y = $y;
        $obj->w = $form->w - 25;
        $obj->onKeyDown = 'CHECK_editor::enterKeyDown';
        
        $this->obj = $obj;
        
        return 5;
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
        
        switch (strtolower($value)){
            
            case 'true':
            case 1: $this->obj->checked = true; return;
        }
        
        $this->obj->checked = false;
    }
    
    function getValue(){
        
        return $this->obj->checked ? 'true' : 'false';
    }
}