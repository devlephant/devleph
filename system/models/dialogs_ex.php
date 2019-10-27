<?

// модуль нестандартных диалогов...

function __inputTextKeyDownEvent($self, $key, $shift){
    
    if ($key==VK_ESCAPE){
        c('edt_inputText')->close();
    } elseif ($key==VK_RETURN){
        c('edt_inputText')->close();
        c('edt_inputText')->modalResult = mrOk;
    }
}


function inputText($caption, $text, $value='', $xy = true){
    
    $frm = c('edt_inputText');
    $frm->onKeyDown = '__inputTextKeyDownEvent';
    c('edt_inputText->text')->onKeyDown = '__inputTextKeyDownEvent';
    c('edt_inputText->btn_ok')->onKeyDown = '__inputTextKeyDownEvent';
    c('edt_inputText->btn_cancel')->onKeyDown = '__inputTextKeyDownEvent';
    
    if ($xy){
        $frm->x = cursor_real_x($frm,10);
        $frm->y = cursor_real_y($frm,10);
    }
    
    $frm->caption = $caption;
    c('edt_inputText->e_label')->text = $text;
    c('edt_inputText->text')->text = $value;
    c('edt_inputText->text')->setFocus();
    
    $res = $frm->showModal()==mrOk/* || $GLOBALS['__inputtext_modalresult']==mrOk*/;
    
    if ($res){
        return c('edt_inputText->text')->text;
    } else
        return false;
}
//диалог выбора объекта...
class TObjectsDialog extends TPanel {
    
    
    
    function execute($classes=false, $status='', $fullpath = false){
        
        c('fmEasySelectDialog->tsVars')->tabVisible = false;
        c('fmEasySelectDialog->tsProps')->tabVisible = false;
        c('fmEasySelectDialog->tsFuncs')->tabVisible = false;
        c('fmEasySelectDialog->tsFiles')->tabVisible = false;
        c('fmEasySelectDialog->tsConsts')->tabVisible = false;
        c('fmEasySelectDialog->c_kav')->hide();
        c('fmEasySelectDialog->pages')->pageIndex    = 1;
        c('fmEasySelectDialog->l_status')->text = $status;
        
        $GLOBALS['OBJ_ISFUNC']  = true;
        $GLOBALS['OBJ_FULLPATH'] = $fullpath;
        $GLOBALS['OBJ_CLASSES'] = $classes;
        
        $r = c('fmEasySelectDialog',1)->showModal();
        
        c('fmEasySelectDialog->l_status')->text = '';
        
        $GLOBALS['OBJ_ISFUNC'] = false;
        $GLOBALS['OBJ_FULLPATH'] = false;
        
        c('fmEasySelectDialog->tsVars')->tabVisible = true;
        c('fmEasySelectDialog->tsConsts')->tabVisible = true;
        c('fmEasySelectDialog->tsProps')->tabVisible = true;
        c('fmEasySelectDialog->tsFuncs')->tabVisible = true;
        c('fmEasySelectDialog->tsFiles')->tabVisible = true;
        c('fmEasySelectDialog->c_kav')->show();
        
        return $r == mrOk;
    }
    
    function get_value(){
        
        return c('fmEasySelectDialog->line')->text;
    }
    
    function set_value($v){
        
        c('fmEasySelectDialog->line')->text = $v;
    }
}

?>