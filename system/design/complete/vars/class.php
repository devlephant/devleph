<?


class complete_Vars {
    
    /*
    function check($lineText){
        
        
    }*/
    
    function getFormVars(){
        
        $result = [];
        $forms  = myProject::getFormsObjects();
      
        foreach($forms as $form)
            foreach($form as $obj)
                if ($obj['CLASS']=='TDataVar'){
                    
                    if ($obj['varName']){
                        $result[] = '$'.$obj['varName'];
                    }
                    
                }
        
        return $result;
    }
    
    // возвращаем список для инлайна
    function getList($lineText){
        
        
        $gl_vars = (array)myProject::cfg('globals');
        
        $vars = INPUT_DLG_editor::getLocalVars();
        $vars = array_merge($vars, array_keys($gl_vars), self::getFormVars());
        
        global $myEvents;
        $obj = $myEvents->selObj;
        if ($obj instanceof TFunction ){
            
            $prms = $obj->parameters;
            $prms = str_replace(' ','', $prms);
            if (strpos($prms,',')===false){
                $prms = explode(_BR_, $prms);
            } else {
                $prms = explode(',', $prms);
            }
            
            foreach ($prms as $i=>$line){
                $tmp  = explode('=',$line);
                $prms[$i] = trim($tmp[0]);
            }
        }
        
        $vars[] = '$self';
        $vars[] = '$x';
        $vars[] = '$y';
        $vars[] = '$_c';
        $vars[] = '$APPLICATION';
        $vars[] = '$SCREEN';
        $vars[] = '$_PARAMS';
        $vars[] = '$argv';
        $vars[] = '$canClose';
        $vars[] = '$key';
        $vars[] = '$button';
        $vars[] = '$shift';
        $vars[] = '$GLOBALS';
        $vars[] = '$_ENV';
        
        if ($prms)
            $vars = array_merge($prms, $vars);
        
        
        $vars = array_unique($vars);
        sort($vars);
        
        $arr['item']   = [];
        $arr['insert'] = [];
        
        if (!count($vars)) return false;
        
        foreach ($vars as $var){
            
            $arr['insert'][] = $var;
            $arr['item'][]   = myComplete::fromBB('[$g][b]'.$var.'[/b]');
        }
        
        if (count($vars)==1 && $vars[0]==$lineText) return false;
        
        return $arr;
    }
}