<?


class complete_Var_Props {
    
    /*
    function check($lineText){
        
        
    }*/
    
    static function getClass($code, $var){
        
            $str = $code;
            $str = str_replace('$',_BR_.'$',$str);
            $arr = [];
            preg_match_all('#(.*)'.str_replace('$','\\$',$var).'([ ]*)=([ ]*)new([ ]+)([a-z0-9\_]+)(.*)#i', $str, $arr);
            
            $class = trim($arr[5][count($arr[5])-1]);
            if (!$class){
                
                preg_match_all('#(.*)'.str_replace('$','\\$',$var).'([ ]*)=([ ]*)c\(\"([a-z\_0-9\-\>]+)\"\)(.*)#i', $str, $arr); 
                $class = complete_Props::getClass( trim($arr[4][count($arr[4])-1]) );
            }
        
        return $class;
    }
    
    static function saveCode($code){
        
        $tmp = str_replace(_BR_,' ', $code);
        preg_match_all('%global[ ]+(\$[a-z\_]{1}[a-zA-Z0-9\_\, \$]*)%i', $tmp, $arr);
        
        $info = myProject::cfg('globals');
        
        foreach ((array)$arr[1] as $var){
            
            $var = trim($var);
            $class = self::getClass($code, $var);
            if ($class)
            $info[$var] = $class;
        }
        
        myProject::cfg('globals', $info);
    }

    function getVarClass($var){
        
        if ($var == '$APPLICATION')
            $class = 'TApplication';
        elseif ($var == '$_c')
            $class = 'TConstantList';
        elseif ($var == '$SCREEN')
            $class = 'TScreen';
        elseif ($var == '$self'){
            global $myEvents;
            $class = $myEvents->selObj->className;
            
        } else {
            
            $info = myProject::cfg('globals');
        
            global $phpMemo;
            $str = $phpMemo->text;
            $str = str_replace('$',_BR_.'$',$str);
            $arr = [];
            preg_match_all('#(.*)'.str_replace('$','\\$',$var).'([ ]*)=([ ]*)new([ ]+)([a-z0-9\_]+)(.*)#i', $str, $arr);
            
            $class = trim($arr[5][count($arr[5])-1]);
            if (!$class){
                
                preg_match_all('#(.*)'.str_replace('$','\\$',$var).'([ ]*)=([ ]*)c\(\"([a-z\_0-9\-\>]+)\"\)(.*)#i', $str, $arr);
                preg_match_all('#(.*)'.str_replace('$','\\$',$var).'([ ]*)=([ ]*)c\(\\\'([a-z\_0-9\-\>]+)\\\'\)(.*)#i', $str, $arr2);
                $arr[4] = array_merge((array)$arr[4], (array)$arr2[4]);
                
                $class = complete_Props::getClass( trim($arr[4][count($arr[4])-1]) );
            }
            
            if (!$class)
                $class = $info[$var];
                
        }
        
        return $class;
    }
    
    // возвращаем список для инлайна
    function getList($lineText){
        
        preg_match_all('%(\$[a-z\_]{1}[a-zA-Z0-9\_]{0,60})(.*)%i', $lineText, $var);
        $var = $var[1][0];
        
        $class = complete_Var_Props::getVarClass($var);
        
        if (!$class) return false;
        
        return complete_Props::_getList($class,$var.'->');
    }
}