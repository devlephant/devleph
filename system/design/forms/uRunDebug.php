<?

class ev_fmRunDebug {
    
    static function onShow($self)
	{    
        $debug_vars = (array)myProject::cfg('debug_vars');
        foreach ($debug_vars as $var)
            myDebug::sendMsg(array('action'=>'add','name'=>$var,'type'=>'glVars'));
    }
    
    static function onClose($self)
	{    
        myUtils::stop();
    }
}

class ev_fmRunDebug_btn_add {
    
    static function onClick($self)
	{    
        $arr['type'] = 'glVars';
        DevS\cache::c('edt_inputText')->formStyle = fsStayOnTop;
        $res = inputText('Новая переменная', 'Введите имя глобальной переменной');
        DevS\cache::c('edt_inputText')->formStyle = fsNormal;
        $res = str_replace('$','',$res);
        if ($res){
            $arr['name'] = $res;
            $arr['action'] = 'add';
            myDebug::sendMsg($arr);
        }
    }
}


class ev_fmRunDebug_btn_del {
    
    static function onClick($self)
	{    
        $arr['type'] = 'glVars';
        $res = DevS\cache::c('fmRunDebug->varList')->inText;
        $res = str_replace('$','',$res);
        if ($res){
        
            $arr['name'] = $res;
            $arr['action'] = 'del';
            myDebug::sendMsg($arr);
        }
    }
}


class ev_fmRunDebug_btn_edit {
    
    static function onClick($self)
	{    
        $arr['type'] = 'glVars';
        $res = DevS\cache::c('fmRunDebug->varList')->inText;
        $res = str_replace('$','',$res);
        
        DevS\cache::c('edt_inputText')->formStyle = fsStayOnTop;
        $res = inputText('Переименнование', 'Введите новое имя переменной');
        DevS\cache::c('edt_inputText')->formStyle = fsNormal;
        
        
        if ($res){
        
            $arr['name'] = $res;
            $arr['action'] = 'del';
            myDebug::sendMsg($arr);
        }
    }
}

class ev_fmRunDebug_varList {
    
    static function onClick($self)
	{
        global $__DEBUG_GLVARS;
        DevS\cache::c('fmRunDebug->mResult')->text = $__DEBUG_GLVARS[DevS\cache::c($self)->items->selected];
    }
}