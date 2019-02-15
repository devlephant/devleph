<?


class myUPX {
    
    const L_NONE = 0;
    const L_MIN  = 1;
    const L_MIDDLE = 2;
    const L_MAX  = 3;
    const L_SUPERMAX = 4;
    
    const TP_COMPRESS = '"%s" -%s "%s" --compress-icons=0';
    
    static function upxFile(){
        
        return replaceSr(SYSTEM_DIR . '/blanks/upx.exe');
    }
    
    static function compress($file, $level = self::L_MIDDLE){
    
        if ($level == L_NONE) return true;
        
        if (!file_exists($file))
            return false;
        
        switch ($level){
            
            case self::L_MIN: $level = 1; break;
            case self::L_MIDDLE: $level = 4; break;
            case self::L_MAX: $level = 7; break;
            case self::L_SUPERMAX: $level = 9; break;
        }
        
        $file    = replaceSr($file);
        $command = vsprintf(self::TP_COMPRESS, array(self::upxFile(),$level, $file));
        
        shell_execute_wait($command, false, SW_SHOW);
        sleep(1);
        return true;
    }
}