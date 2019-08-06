<?


class complete_Props {
    
    /*
    function check($lineText){
        
        
    }*/
    static $forms;
    
    static function getClass($obj_name){
        
        $arr   = explode('->', $obj_name);
        
        if (!self::$forms)
            self::$forms = myProject::getFormsObjects();
        
        $class = false;
        
        if (count($arr)==1){
            
            global $_FORMS, $formSelected;
            foreach (self::$forms as $form => $objs){
                
                if (strtolower($form)==strtolower($arr[0])){
                    $class = 'TForm';
                    break;
                }
            }
            
            foreach (self::$forms as $form => $objs){
                
                foreach ($objs as $obj){
                    if (strtolower($obj['NAME'])==strtolower($arr[0])){
                        $class = $obj['CLASS'];
                        break;
                    }
                }
            }
        } else {
            
            foreach ((array)self::$forms[$arr[0]] as $obj)
                if (strtolower($obj['NAME'])==strtolower($arr[1])){
                    $class = $obj['CLASS'];
                    break;
                }
        }
        
        return $class;
    }
    
    
    function _getList($class, $add='->'){
        
        $arr['insert'] = [];
        $arr['item']   = [];
        
        
        $events = myEvents::getEventsInfo($class);
        $props  = myProperties::getPropertiesInfo($class);
        $methods= myProperties::getMethodsInfo($class);
        
        $methods= array_merge(self::getDynMethodsInfo($class),$methods);
        $props  = array_merge(self::getDynPropsInfo($class), $props);
        
        foreach ((array)$props as $prop){
            
            $arr['insert'][] = $add.$prop['PROP'];
            $arr['item'][]   = myComplete::fromBB('->[$g][b]'.$prop['PROP'].'[/b] - [$s]'.$prop['CAPTION']);
        }
        
        foreach ((array)$events as $event){
            
            $arr['insert'][] = $add.$event['EVENT'];
            $arr['item'][]   = myComplete::fromBB('->[$bl][b]'.$event['EVENT'].'[/b] - [$s]'.$event['CAPTION']);
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
            
            $arr['insert'][] = $add.$method['PROP'];
            $arr['item'][]   = myComplete::fromBB('->'.$text);
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
                
                
                $methods = $class['info']['methods'];
                
                foreach($methods as $method){
                    
                    $prefix = strtolower(substr($method['name'],0,4));
                    if (($prefix!=='set_' && $prefix!='get_') && in_array($method['type'],['','public'])){
                        
                        
                        $inline = $method['name'].' ( '. complete_Funcs::getInline($method['params'],$method['defaults']) .' )';
                        if (count($method['params'])==0) $method['name'] .= '()';
                        $result[] = ['PROP'=>$method['name'],'INLINE'=>$inline];
                    }
                }
                
                break;
            }
        }
        
        return $result;
    }
    
    
    function getDynPropsInfo($x_class){
        
        $result = [];
        $x_class  = strtolower($x_class);
        $info   = complete_Funcs::getFormFunctions();
        
        $tmp_exists = [];
        
        foreach ($info as $class){
            
            if (!$class['info']) continue;
            if (strtolower($class['NAME'])==$x_class){
                
                $props = $class['info']['properties'];
                foreach($props as $prop){
                    
                    if ($prop['type'] == 'public'){
                        
                        $inline = $prop['name'];
                        $result[] = ['PROP'=>$prop['name'],'CAPTION'=>' public property'];
                    }
                    
                } 
                
                $methods = $class['info']['methods'];
                
                foreach($methods as $method){
                    
                    $prefix = strtolower(substr($method['name'],0,4));
                    $prop = str_ireplace($prefix,'',$method['name']);
                        
                    if (($prefix=='set_' || $prefix=='get_') && in_array($method['type'],['','public']) && !in_array($prop, $tmp_exists)){
                        
                        $tmp_exists[] = $prop;
                        $inline = $method['name'].' ( '. complete_Funcs::getInline($method['params'],$method['defaults']) .' )';
                        $result[] = ['PROP'=>$prop,'CAPTION'=>$inline];
                    }
                }
                
                break;
            }
        }
        
        return $result;
    }
    
    
    // возвращаем список для инлайна
    function getList($lineText){
        
        
        preg_match_all('%c\(\"([a-z0-9\_\-\>]+)\"\)%i', $lineText, $arr);
        $class = self::getClass($arr[1][0]);
           
        return self::_getList($class);
    }
}