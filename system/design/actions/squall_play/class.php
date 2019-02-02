<?


class action_squall_play extends action_Simple {
    
    
    static function getLineParams($line, $action = false){
        
        $k = strrpos($line,'->');
        
        $pr1 = substr($line, 0, $k);
        
        return array($pr1);
    }
    
    static function getResult($command, $params_str, $action){
        
        return trim($params_str[0]) . '->play();';
    }
}