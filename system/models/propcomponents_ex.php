<?

class TEditTextDialog extends TEditDialog {
    
    
    
    function __construct($onwer=nil,$init=true,$self=nil){
        $this->dlg_type = 'TTextDialog';
       
        parent::__construct($onwer,$init,$self);
    }
    
    function selectDialog($self){
        
        $obj = _c(_c($self)->owner);
        
        $obj->dlg->value = $obj->value;
        if ($obj->dlg->execute()){
            $obj->value = $obj->dlg->value;
            if ($obj->onSelect){
                $v = $obj->dlg->value;
                eval($obj->onSelect . '(' . $obj->self . ',$v);');
            }
        } 
    }
    
    function set_value($v){
        $this->edit->text = $v;
    }
    
    function get_value(){
        return $this->edit->text;
    }
}

class TEditImageDialog extends TEditDialog {
    
    
    #public imagelist
    
    function __construct($onwer=nil,$init=true,$self=nil){
        $this->dlg_type = 'TImageDialog';
       
        parent::__construct($onwer,$init,$self);
    }
    
    function selectDialog($self){
        
        $obj = _c(_c($self)->owner);
        
        //$obj->dlg->value = $obj->value;
        if ($obj->dlg->execute($obj->imagelist)){
            //$obj->value = $obj->dlg->value;
            if ($obj->onSelect){
                $v = $obj->value;
                eval($obj->onSelect . '(' . $obj->self . ',$v);');
            }
        } 
    }
    
    function set_value($v){
        $this->dlg->value = $v;
    }
    
    function get_value(){
        return $this->dlg->value;
    }
}


class TEditSizesDialog extends TEditDialog {
    
    
    
    function __construct($onwer=nil,$init=true,$self=nil){
        $this->dlg_type = 'TSizesDialog';
       
        parent::__construct($onwer,$init,$self);
        $this->readOnly = true;
        $this->text     = '('.t('Sizes & Position').')';
    }
    
    function setObject($obj){
        $this->dlg->setObject($obj);
    }
    
    function getObject(){
        return $this->dlg->getObject();
    }
}


class TEditFormDialog extends TEditDialog {
    
    
    
    function __construct($onwer=nil,$init=true,$self=nil){
        //$this->dlg_type = 'TImageDialog';
       
        parent::__construct($onwer,$init,$self);
        $this->readOnly = true;
    }
    
    function selectDialog($self){
        
        $obj = _c(_c($self)->owner);
        $form = c($obj->formName);
        
        if ($obj->onFormShow){
            eval($obj->onFormShow . '(' . $obj->self . ',$form);');
        }
        
        if ($form->showModal()==mrOk){
            if ($obj->onSelect){
                eval($obj->onSelect . '(' . $obj->self . ',$form);');
            }
        } 
    }
    
    function set_value($v){
        $this->edit->text = $v;
    }
    
    function get_value(){
        return $this->edit->text;
    }
}



class TEditMenuDialog extends TEditDialog {
    
    
    
    function __construct($onwer=nil,$init=true,$self=nil){
        $this->dlg_type = 'TMenuDialog';
       
        parent::__construct($onwer,$init,$self);
        //$this->readOnly = true;
    }
    
    
    function selectDialog($self){
        
        $obj = _c(_c($self)->owner);
        $obj->dlg->value = $obj->edit->text;
        
        if ($obj->dlg->execute()){
            if ($obj->onSelect){
                $v = $obj->value;
                $obj->edit->text = $v;
                eval($obj->onSelect . '(' . $obj->self . ',$v);');
            }
        } 
    }
    
    function set_value($v){
        $this->edit->text  = $v;
        $this->dlg->value = $v;
    }
    
    function get_value(){
        return $this->dlg->value;
    }
}


?>