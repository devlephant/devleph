<?


class complete_Hints {
    
    /*
    function check($lineText){
        
        
    }*/
    
    
    // возвращаем список для инлайна
    function getList($lineText){
        
        global $_FORMS, $formSelected, $funcInfos, $addFuncs;
        
        $arr['item']   = '';
        $arr['insert'] = '';
            
        if (!$funcInfos){
            $funcInfos = complete_Funcs::getFunctions();
        }
        
        $funcs = &$funcInfos;
        $funcs = array_merge((array)$addFuncs, complete_Funcs::getFormFunctions(), $funcs);
        
        for($i=0;$i<strlen($lineText);$i++){
            
            if (stripos('qwertyuiopasdfghjklzxcvbnm1234567890_',$lineText[$i])!==false)
                $rStr .= $lineText[$i];
                
            if ($lineText[$i]=='(') break;
        }
        
        if (isset($funcs[$rStr])){
            
            $func = $funcs[$rStr];
            if ($func['INLINE']){
                $arr['item'] = $func['INLINE'];
                $arr['item'] = substr($arr['item'],strpos($arr['item'],' ')+1, strlen($arr['item']) - strpos($arr['item'],' '));
                $arr['item'] = str_replace(',',';', $arr['item']);
            }
            else
                $arr['item'] = $func['NAME'];
                
            if ($func['DESC'])
                $arr['item'] .= _BR_ .'- '. strip_tags($func['DESC']);
            
            if ($func['SEEALSO']){
                if (trim($func['SEEALSO'][0]))
                    $arr['item'] .= _BR_ .'-         '.t('seealso').' ' . implode('; ', $func['SEEALSO']);
            }
            
            return $arr;
        } else {
            
            return false;
        }
    }
}