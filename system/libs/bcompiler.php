<?


class DS_bCompiler {
    
    static $classes;
    static $functions;
    static $constants;
    
    function __construct(){
        
        //self::clear();
    }
    
    function addConst($name){ self::$constants[] = trim($name); }
    function addFunc($name){ self::$functions[]  = trim($name); }
    function addClass($name){ self::$classes[]   = trim($name); }
    
    function clear(){
        
        self::$constants = array();
        self::$functions = array();
        self::$classes   = array();
        
    }
    
    // добавляет классы и функции из файла
    function addFromFile($file){
        
        $result = PHPSyntax::analiz($file);
        
        foreach ($result['functions'] as $name=>$params)
            self::addFunc($name);
            
        foreach ($result['classes'] as $name=>$params)
            self::addClass($name);
    }
    
    function addFromBC($file){
        
        $lines = file($file);
        foreach ($lines as $line){
            
            $line = trim($line);
            $tmp  = explode(':',$line);
            $type = strtolower(trim($tmp[0]));
            $names= explode(',',$tmp[1]);
            array_map('trim', $names);
            
            if ($type=='classes')
                $method = 'addClass';
            elseif ($type=='functions')
                $method = 'addFunc';
            elseif ($type=='constants')
                $method = 'addConst';
            else
                continue;
                
            
            $tmp = new DS_bCompiler;
            foreach ($names as $name){
                $tmp->$method($name);
            }
                
            unset($tmp);
            
            
        }
    }
    
    function getParams(){
        
        $result = array('constants'=>self::$constants, 'functions'=>self::$functions, 'classes'=>self::$classes);
        
        return base64_encode(serialize($result));
    }
    
    // компиляция файла
    // $file - оригинальный пхп файл
    // $cfile - файл для сохранения байт кода
    function compile($file, $cfile){
        
        $err_log = TEMP_DIR.'dsbcompiler_errors.log';
        if( is_file($err_log) )
			unlink($err_log);
        
        
        kill_task('phpUtils.exe');
        
        $xfile   = SYSTEM_DIR . '/../phpUtils.exe';
        $params  = '"bcompiler" "'.$file.'" "'.$cfile.'" "'.self::getParams().'" "'.$err_log.'"';
        //$command = replaceSr(SYSTEM_DIR . '/../phpUtils.exe "bcompiler" "'.$file.'" "'.$cfile.'" "'.self::getParams().'" "'.$err_log.'");');
        
        shell_execute_wait2($xfile, $params, 'open', SW_HIDE);
        //shell_execute_wait($command, false, SW_SHOW);
        
        if ( file_exists($err_log) )
            $result = file_get_contents($err_log);
        else {
            $result = '';
        }
        if( is_file($err_log) )
			unlink($err_log);
        return $result;
    }
}