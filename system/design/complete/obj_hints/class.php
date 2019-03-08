<?


class complete_obj_Hints {
    
    
    // возвращаем список для инлайна
    function getList($lineText){
        
        global $_FORMS, $formSelected, $funcInfos, $addFuncs;
        
        $arr['item']   = '';
        $arr['insert'] = '';
            
        
        $method = '';
        $object = '';
        
        $exText = trim(preg_replace('#^c\(\"([a-z0-9\_\>\-]*)\"\)->#i','',$lineText));
        $object = substr($lineText,0, strlen($lineText)-strlen($exText)-2); // "->" -2
        $method = substr($exText, 0, strlen($method)-1); // убираем скобку в конце
        
        
        preg_match_all('%c\(\"([a-z0-9\_\-\>]+)\"\)%i', $object, $arrx);
        $class = complete_Props::getClass($arrx[1][0]);
        
        $methods =  myProperties::getMethodsInfo($class);
        
        foreach ($methods as $func){
            
            if ($func['PROP']==$method){
                
                if ($func['INLINE']){
                    $arr['item'] = '->'.$func['INLINE'];
                    //$arr['item'] = substr($arr['item'],strpos($arr['item'],' ')+1, strlen($arr['item']) - strpos($arr['item'],' '));
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