<?

// модуль нестандартных диалогов...

function __inputTextKeyDownEvent($self, $key, $shift){
    
    if ($key==VK_ESCAPE){
        DevS\cache::c('edt_inputText')->close();
    } elseif ($key==VK_RETURN){
        DevS\cache::c('edt_inputText')->close();
        DevS\cache::c('edt_inputText')->modalResult = mrOk;
    }
}


function inputText($caption, $text, $value='', $xy = true){
    
    $frm = c('edt_inputText');
    $frm->onKeyDown = '__inputTextKeyDownEvent';
    DevS\cache::c('edt_inputText->text')->onKeyDown = '__inputTextKeyDownEvent';
    DevS\cache::c('edt_inputText->btn_ok')->onKeyDown = '__inputTextKeyDownEvent';
    DevS\cache::c('edt_inputText->btn_cancel')->onKeyDown = '__inputTextKeyDownEvent';
    
    if ($xy){
        $frm->x = cursor_real_x($frm,10);
        $frm->y = cursor_real_y($frm,10);
    }
    
    $frm->caption = $caption;
    DevS\cache::c('edt_inputText->e_label')->text = $text;
    DevS\cache::c('edt_inputText->text')->text = $value;
    DevS\cache::c('edt_inputText->text')->setFocus();
    
    $res = $frm->showModal()==mrOk/* || $GLOBALS['__inputtext_modalresult']==mrOk*/;
    
    if ($res){
        return c('edt_inputText->text')->text;
    } else
        return false;
}
//диалог выбора объекта...
class TObjectsDialog extends TPanel {
    
    
    
    function execute($classes=false, $status='', $fullpath = false){
        
        DevS\cache::c('fmEasySelectDialog->tsVars')->tabVisible = false;
        DevS\cache::c('fmEasySelectDialog->tsProps')->tabVisible = false;
        DevS\cache::c('fmEasySelectDialog->tsFuncs')->tabVisible = false;
        DevS\cache::c('fmEasySelectDialog->tsFiles')->tabVisible = false;
        DevS\cache::c('fmEasySelectDialog->tsConsts')->tabVisible = false;
        DevS\cache::c('fmEasySelectDialog->c_kav')->hide();
        DevS\cache::c('fmEasySelectDialog->pages')->pageIndex    = 1;
        DevS\cache::c('fmEasySelectDialog->l_status')->text = $status;
        
        $GLOBALS['OBJ_ISFUNC']  = true;
        $GLOBALS['OBJ_FULLPATH'] = $fullpath;
        $GLOBALS['OBJ_CLASSES'] = $classes;
        
        $r = DevS\cache::c('fmEasySelectDialog',1)->showModal();
        
        DevS\cache::c('fmEasySelectDialog->l_status')->text = '';
        
        $GLOBALS['OBJ_ISFUNC'] = false;
        $GLOBALS['OBJ_FULLPATH'] = false;
        
        DevS\cache::c('fmEasySelectDialog->tsVars')->tabVisible = true;
        DevS\cache::c('fmEasySelectDialog->tsConsts')->tabVisible = true;
        DevS\cache::c('fmEasySelectDialog->tsProps')->tabVisible = true;
        DevS\cache::c('fmEasySelectDialog->tsFuncs')->tabVisible = true;
        DevS\cache::c('fmEasySelectDialog->tsFiles')->tabVisible = true;
        DevS\cache::c('fmEasySelectDialog->c_kav')->show();
        
        return $r == mrOk;
    }
    
    function get_value(){
        
        return DevS\cache::c('fmEasySelectDialog->line')->text;
    }
    
    function set_value($v){
        
        DevS\cache::c('fmEasySelectDialog->line')->text = $v;
    }
}

?>