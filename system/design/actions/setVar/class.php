<?


class action_setVar extends action_Simple {
    
    
    static function getLineParams($line, $action = false){
        
        $k = strpos($line,'=');
        
        $pr1 = substr($line, 0, $k-1);
        $pr2 = substr($line, $k+1, strlen($line)-strlen($pr1)-2);
        
        
        return array(trim($pr1), trim($pr2));
    }
    
    static function getResult($command, $params_str, $action){
        
        return trim($params_str[0]) . ' = ' . trim($params_str[1]) . ';';
    }
}