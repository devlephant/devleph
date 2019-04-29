<?


class INPUT_DLG_editor {
    
    public $obj;
    
    public $use_quote;
    public $to_quote;
    
    static function getLocalVars(){
        
        $str = c('fmPHPEditor.memo')->text;
        $str = str_replace('$',_BR_.'$',$str);
        $arr = [];
        preg_match_all('#(.*)(\$[a-z\_]{1}[a-zA-Z0-9\_]{0,60})(.*)#', $str, $arr);
        
        sort($arr[2]);
        return array_unique($arr[2]);
    }
    
    static function btnSelect($self){
        
        $obj = _c(_c($self)->owner);
        
        $vars = self::getLocalVars();
        c('fmEasySelectDialog->localVars')->items->setArray($vars);
        c('fmEasySelectDialog->line')->text = $obj->text;
        $GLOBALS['OBJ_CLASSES'] = false;
        if (c('fmEasySelectDialog')->showModal() == mrOk){
            
            $obj->text = c('fmEasySelectDialog->line')->text;
        }
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
        
        $obj->onSelectClick = 'INPUT_DLG_editor::btnSelect';
        
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