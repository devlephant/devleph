<?


class complete_Static_Props {
    
    /*
    function check($lineText){
        
        
    }*/
    
        
    function _getList($class, $add='->'){
        
        $arr['insert'] = [];
        $arr['item']   = [];
        
        
        //$events = myEvents::getEventsInfo($class);
        //$props  = myProperties::getPropertiesInfo($class);
        
        $methods = self::getDynMethodsInfo($class);
        
        foreach ((array)$props as $prop){
            
            $arr['insert'][] = $add.$prop['PROP'];
            $arr['item'][]   = myComplete::fromBB('::[b]'.$prop['PROP'].'[/b] - [$s]'.$prop['CAPTION']);
        }
        
        foreach ((array)$events as $event){
            
            $arr['insert'][] = $add.$event['EVENT'];
            $arr['item'][]   = myComplete::fromBB('::[b]'.$event['EVENT'].'[/b] - [$s]'.$event['CAPTION']);
        }
        
        foreach ((array)$methods as $method){
            
            $func = str_replace('()','',$method['PROP']);
            $text = $method['INLINE'];
            
            $text = str_replace($func.' ', '[b]'.$func.'[/b] ', $text);
            $text = str_replace('nubmer ', '[$r]number[$b] ',$text);
            $text = str_replace('float ', '[$r]float[$b] ', $text);
            $text = str_replace('mixed ', '[$r]mixed[$b] ', $text);
            $text = str_replace('string ', '[$r]string[$b] ', $text);
            $text = str_replace('array ', '[$r]array [$b]', $text);
            $text = str_replace('bool ', '[$r]bool[$b] ', $text);
            $text = str_replace('void ', '[$r]void[$b] ', $text);
            $text = str_replace('int ', '[$r]int[$b] ', $text);
            $text = str_replace('resource ', '[$r]resource[$b] ', $text);
            $text = str_replace('object ', '[$r]object[$b] ', $text);
            
            if ($method['ONE'])
                $arr['insert'][] = $add.$method['PROP'].'()';
            else
                $arr['insert'][] = $add.$method['PROP'];
            
            $arr['item'][]   = myComplete::fromBB('::'.$text);
        }
        
        return $arr;
    }
    
    /*
    function getDefinedClasses($class){
        
        
    }*/
    
    function getDynMethodsInfo($x_class){
        
        $result = [];
        $x_class  = strtolower($x_class);
        $info   = complete_Funcs::getFormFunctions();
        
        foreach ($info as $class){
            
            if (!$class['info']) continue;
            
            
            if (strtolower($class['NAME'])==$x_class){
                 
                $props = $class['info']['properties'];
                foreach($props as $prop){
                    
                    if ($prop['type'] == 'static'){
                        
                        $inline = $prop['name'];
                        if ($prop['name'][0]=='$')
                            $inline = '[b][$g]'.$inline.'[/b]';
                        else
                            $inline = '[$r]'.$inline.'';
                            
                        $result[] = array('PROP'=>$prop['name'],'INLINE'=>myComplete::fromBB($inline));
                    }
                    
                } 
                 
                $methods = $class['info']['methods'];
                foreach($methods as $method){
                    
                    
                    if (in_array($method['type'],array('','static'))){
                        
                        $inline = $method['name'].' ( '. complete_Funcs::getInline($method['params'],$method['defaults']) .' )';
                        $result[] = array('PROP'=>$method['name'],'INLINE'=>$inline,'ONE'=>count($method['params'])===0);
                    }
                }
                
                break;
            }
        }
        
        return $result;
    }
    
    // возвращаем список для инлайна
    function getList($lineText){
        
        preg_match_all('%([a-z0-9\_\-]+)::%i', $lineText, $arr);
        $class = trim($arr[1][0]);
           
        return self::_getList($class,$class.'::');
    }
}