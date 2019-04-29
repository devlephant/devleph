<?


class OBJECTS_editor {
    
    public $obj;
    
    public $classes;
    public $use_quote;
    public $to_quote;

    static function btnSelect($self, $exObj = false, $classes = false){
        
        if ($exObj)
            $obj = $exObj;
        else {
            $obj = _c(_c($self)->owner);
            $action = myActions::getActionByCODE($obj->code);
        }
        
        c('fmEasySelectDialog->tsProps')->tabVisible = false;
        c('fmEasySelectDialog->tsFuncs')->tabVisible = false;
        c('fmEasySelectDialog->tsFiles')->tabVisible = false;
        c('fmEasySelectDialog->tsConsts')->tabVisible = false;
        c('fmEasySelectDialog->pages')->pageIndex    = 1;
        
        if (!$exObj)
            $GLOBALS['OBJ_CLASSES'] = $obj->editor['CLASSES'];
        else
            $GLOBALS['OBJ_CLASSES'] = $classes;
            
        if (c('fmEasySelectDialog')->showModal() == mrOk){
            
            $obj->text = c('fmEasySelectDialog->line')->text;
        }
        
        c('fmEasySelectDialog->tsConsts')->tabVisible = true;
        c('fmEasySelectDialog->tsProps')->tabVisible = true;
        c('fmEasySelectDialog->tsFuncs')->tabVisible = true;
        c('fmEasySelectDialog->tsFiles')->tabVisible = true;
    }
    
    function create($form, $action, $editor, $y){
        
        $label = new TLabel($form);
        $label->parent = $form;
        $label->caption = $editor['CAPTION'] . ':';
        $label->x = 10;
        $label->y = $y;
        
        $obj = new TEditBtn($form);
        $obj->parent = $form;
        $obj->w = $form->w - 20;
        $obj->x = 10;
        $obj->y = $y + $label->h + 5;
        $obj->onKeyDown = 'INPUT_DLG_editor::enterKeyDown';
        
        $this->use_quote = $editor['USE_QUOTE'];
        $this->classes   = $editor['CLASSES'];
        
        $obj->editor = $editor;
        $obj->code = $action['CODE'];
        $obj->onSelectClick = 'OBJECTS_editor::btnSelect';
        
        $this->obj = $obj;
        
        return $obj->h + 5 + $label+h;
    }
    
    
    function enterKeyDown($self, $key){
        $form = _c(_c(_c(_c($self)->owner)->owner)->owner);
        if ($key==VK_RETURN){
            
           $form->close();
           $form->modalResult = mrOk;
           
        } elseif ($key==VK_ESCAPE)
            $form->close();
    }
    
    function setValue($value){
        
        $this->obj->text = $value;
    }
    
    function getValue(){
        
        return $this->obj->text;
    }
}