<?


class action_comment extends action_Simple {
    
    
    static function getLineParams($line, $action = false){
        
        $k = strpos($line,'//');
        
        $pr1 = substr($line, 0, $k+2);
        $pr2 = substr($line, $k+2, strlen($line)-strlen($pr1));
        
        return array(trim($pr2));
    }
    
    static function getResult($command, $params_str, $action){
        
        return '// ' . trim($params_str[0]);
    }
}