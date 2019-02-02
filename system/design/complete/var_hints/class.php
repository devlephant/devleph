<?


class complete_var_Hints {
    
    
    // возвращаем список для инлайна
    function getList($lineText){
        
        global $_FORMS, $formSelected, $funcInfos, $addFuncs;
        
        $arr['item']   = '';
        $arr['insert'] = '';
        $info = myProject::cfg('globals');
            
        $exText = trim(preg_replace('#^(\$[a-z\_]{1}[a-zA-Z0-9\_]{0,60})->#i','',$lineText));
        $var    = substr($lineText,0, strlen($lineText)-strlen($exText)-2); // "->" -2
        $method = substr($exText, 0, strlen($method)-1); // убираем скобку в конце
        
        $class = complete_Var_Props::getVarClass($var);
        
        if (!$class) return;
        
        $methods = array_merge( myProperties::getMethodsInfo($class), complete_Props::getDynMethodsInfo($class));
        foreach ($methods as $func){
            
            if ($func['PROP']==$method){
                
                if ($func['INLINE']){
                    $arr['item'] = '->'.$func['INLINE'];
                    $arr['item'] = str_replace(',',';', $arr['item']);
                }
                else
                    $arr['item'] = $func['PROP'];
                    
                if ($func['DESC'])
                    $arr['item'] .= _BR_ .'- '. strip_tags($func['DESC']);
                else
                    $arr['item'] .= _BR_ . _BR_.'- '.$class;
                    
                
                return $arr;
            }
        }
        
            return false;
    }
}