<?

class ini {
    
    
    static function iniG($link = null){
        
        if ($link == null)
            return $GLOBALS['__INIFILE'];
        else
            return $link;
    }
    
    static function open($fileName){
        
        $fileName = getFileName($fileName);
        $result   = new TIniFileEx;
        $result->loadFromFile($fileName);
        $GLOBALS['__INIFILE'] =& $result;
        
        return $result;
    }
    
    static function read($section, $key, &$buff, $link = null){
        
        $buff = self::iniG($link)->read($section, $key, null);
    }
    
    static function write($section, $key, $value, $update = true, $link = null){
        
        self::iniG($link)->write($section, $key, $value);
        if ($update)
            self::iniG($link)->updateFile();
    }
    
    static function deleteSection($section, $update = true, $link = null){
        
        self::iniG($link)->eraseSection($section);
        if ($update)
            self::iniG($link)->updateFile();
    }
    
    static function deleteKey($section, $key, $update = true, $link = null){
        
        self::iniG($link)->deleteKey($section, $key);
        if ($update)
            self::iniG($link)->updateFile();
    }
    
    static function readSections(&$buff, $link = null){
        
        self::iniG($link)->readSections($buff);
    }
    
    static function readKeys($section, &$buff, $link = null){
        
        self::iniG($link)->readKeys($section, $buff);
    }
    
    static function update($link = null){
        
        self::iniG($link)->updateFile();
    }
}
?>