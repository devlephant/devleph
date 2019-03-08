<?


class complete_static_Hints {
    
    
    // возвращаем список для инлайна
    function getList($lineText){
        
        global $_FORMS, $formSelected, $funcInfos, $addFuncs;
        
        $arr['item']   = '';
        $arr['insert'] = '';
            
        
        $method = '';
        $class = '';
        
        list($class, $method) = explode('::', $lineText);
        $method = substr($method, 0, strlen($method)-1); // убираем скобку в конце
        $class = trim($class);
        $methods = array_merge( myProperties::getMethodsInfo($class), complete_Static_Props::getDynMethodsInfo($class));
        
        foreach ($methods as $func){
            
            
            if ($func['PROP']==$method){
                
                if ($func['INLINE']){
                    $arr['item'] = '::'.$func['INLINE'];
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