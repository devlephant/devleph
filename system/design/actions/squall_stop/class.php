<?


class action_squall_stop extends action_Simple {
    
    
    static function getLineParams($line, $action = false)
	{
        return [substr($line, 0, strrpos($line,'->'))];
    }
    
    static function getResult($command, $params_str, $action){
        
        return trim($params_str[0]) . '->stop();';
    }
}