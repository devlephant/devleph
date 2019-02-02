<?


class action_execute extends action_Simple {
    
    
    static function getLineParams($line, $action = false){
        
        $tmp = explode('=',$line);
        $result[0] = trim($tmp[0]);
        
        $k = strrpos(trim($tmp[1]),'->');
        
        $result[1] = substr(trim($tmp[1]), 0, $k);
        
        return $result;
    }
    
    static function getResult($command, $params_str, $action){
        
        return $params_str[0] . ' = ' . trim($params_str[1]) . '->execute();';
    }
}