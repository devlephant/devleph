<?

class ev_fmRunDebug {
    
    static function onShow(){
        
        $debug_vars = (array)myProject::cfg('debug_vars');
        foreach ($debug_vars as $var)
            myDebug::sendMsg(array('action'=>'add','name'=>$var,'type'=>'glVars'));
    }
    
    static function onClose(){
        
        myUtils::stop();
    }
}

class ev_fmRunDebug_btn_add {
    
    static function onClick(){
        
        $arr['type'] = 'glVars';
        c('edt_inputText')->formStyle = fsStayOnTop;
        $res = inputText('Новая переменная', 'Введите имя глобальной переменной');
        c('edt_inputText')->formStyle = fsNormal;
        $res = str_replace('$','',$res);
        if ($res){
            $arr['name'] = $res;
            $arr['action'] = 'add';
            myDebug::sendMsg($arr);
        }
    }
}


class ev_fmRunDebug_btn_del {
    
    static function onClick(){
        
        $arr['type'] = 'glVars';
        $res = c('fmRunDebug->varList')->inText;
        $res = str_replace('$','',$res);
        if ($res){
        
            $arr['name'] = $res;
            $arr['action'] = 'del';
            myDebug::sendMsg($arr);
        }
    }
}


class ev_fmRunDebug_btn_edit {
    
    static function onClick(){
        
        $arr['type'] = 'glVars';
        $res = c('fmRunDebug->varList')->inText;
        $res = str_replace('$','',$res);
        
        c('edt_inputText')->formStyle = fsStayOnTop;
        $res = inputText('Переименнование', 'Введите новое имя переменной');
        c('edt_inputText')->formStyle = fsNormal;
        
        
        if ($res){
        
            $arr['name'] = $res;
            $arr['action'] = 'del';
            myDebug::sendMsg($arr);
        }
    }
}

class ev_fmRunDebug_varList {
    
    static function onClick($self){
        
        $var = c($self)->items->selected;
        global $__DEBUG_GLVARS;
        
        c('fmRunDebug->mResult')->text = $__DEBUG_GLVARS[$var];
    }
}