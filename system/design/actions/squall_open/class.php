<?


class action_squall_open extends action_Simple {
    
    
    static function getLineParams($line, $action = false){
        
        $tmp = explode('->open',$line);
        $result[0] = trim($tmp[0]);
        
        $prs = parent::getLineParams(trim($tmp[1]));
        
        return array_merge($result, $prs);
    }
    
    static function getResult($command, $params_str, $action){
        
        return $params_str[0] . '->open(' . trim($params_str[1]) . ');';
    }
}