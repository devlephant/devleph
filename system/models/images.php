<?

class myImages {
    
    
    static function getImgID($name){
        global $allImages;
        
        return isset( $allImages[$name]['ID'] )? $allImages[$name]['ID'] : -1;
    }
    
    static function get32($name){
        $root1 = SYSTEM_DIR . '/design/32bit/';
		$root2 = dsThemeDesign::$dir . '/32bit/';
		
		if (file_exists( $root2 .$name.'.png'))
            return  $root2 .$name.'.png';
        if (file_exists( $root2 .$name.'.bmp'))
            return  $root2 .$name.'.bmp';
        if (file_exists( $root2 .$name.'.gif'))
            return  $root2 .$name.'.gif';
		
        if (file_exists( $root1 .$name.'.png'))
            return  $root1 .$name.'.png';
        if (file_exists( $root1 .$name.'.bmp'))
            return  $root1 .$name.'.bmp';
        if (file_exists( $root1 .$name.'.gif'))
            return  $root1 .$name.'.gif';
        
        return false;
    }
    
    static function get24($name){
        $root1 = SYSTEM_DIR . '/design/24bit/';
		$root2 = dsThemeDesign::$dir . '/24bit/';
		
		if (file_exists( $root2 .$name.'.png'))
            return $root2 .$name.'.png';
		
        if (file_exists( $root2 .$name.'.bmp'))
            return $root2 .$name.'.bmp';
		
        if (file_exists( $root2 .$name.'.gif'))
            return $root2 .$name.'.gif';
		
        if (file_exists( $root1 .$name.'.png'))
            return $root1 .$name.'.png';
		
        if (file_exists( $root1 .$name.'.bmp'))
            return $root1 .$name.'.bmp';
		
        if (file_exists( $root1 .$name.'.gif'))
            return $root1 .$name.'.gif';
        
        return false;
    }
}