<?
class winRes {
	static function getmt() {
			$fdir = ( defined('SYSTEM_DIR') )? constant('SYSTEM_DIR') . 'blanks/manifest/' : DOC_ROOT . '/';
		if( is_file( realpath( $fdir .  'mt.exe' ) ) )
			return $fdir . 'mt.exe';
		
		if( is_file( realpath( $fdir . 'mt64.exe' ) ) )
			return $fdir . 'mt64.exe';
		
		return 'mt.exe';
	}
	
	static function getvp() {
			$fdir = ( defined('SYSTEM_DIR') )? constant('SYSTEM_DIR') . 'blanks/manifest/' : DOC_ROOT . '/';

		if( is_file( realpath( $fdir . 'verpatch.exe' ) ) )
			return str_replace(array("/"), array("\\"), $fdir . 'verpatch.exe');
		
		return 'verpatch.exe';
	}
	
	static function changeInfo($fileExe, $version, $name, $value) {
        exec(
		"\"" . self::getvp() . "\" \"" . (string)$fileExe . "\" \"" . $version. "\" /va /s " . (string)$name . " \"". (string)$value . "\""
		); 
    }
	static function getTest(){
		return "\"" . self::getvp() . "\" \"" . (string)c('fmBuildProgram->path',1)->text . "\" \"1.2.2.8\" /va /s Copyright \"TestCompanyName\"";
	}
	static function attachManifest($fileExe, $fileManifest) {
		exec(self::getmt() . " Рmanifest " . (string)$fileManifest . " -outputresource:" . (string)$fileExe . ";1");
	}
	
	static function changeCompanyName($fileExe, $companyName) {
        
        self::changeInfo($fileExe, "CompanyName", $companyName);
    }
    
    static function changeVersion($fileExe, $version) {
        exec(
		"\"" . self::getvp() . "\" \"" . (string)$fileExe . "\" \"" . $version. "\" /va"
		); 
    }
    
    static function changeFileVersion($fileExe, $fileVersion) {
        
        self::changeInfo($fileExe, 'FileVersion', $fileVersion);
    }
    
    static function changeFileDescription($fileExe, $desc) {
        
        self::changeInfo($fileExe, "FileDescription", $desc);
    }
    
    static function changeLegalCopyright($fileExe, $value) {
        
        self::changeInfo($fileExe, 'LegalCopyright', $value);
    }

	static function changeIconId($fileExe, $id, $fileIco){
        
        $fileExe = replaceSr($fileExe);
        $fileIco = replaceSr($fileIco);
        
        //winres_change_ico($fileExe, $fileIco);
        $hExe = winres_begin_update_resource($fileExe, false); // начинаю обновление иконки
        
        winres_load_icon_group_resource($hExe, 'MAINICON', $id, $fileIco); // Устанавливаю иконку
        winres_end_update_resource($hExe, false); // Обновление закончено
    }
	
    static function changeIcon($fileExe, $fileIco){
        //self::changeIconId($fileExe, 1, $fileIco);
		$fileExe = replaceSr($fileExe);
        $fileIco = replaceSr($fileIco);
        
        //winres_change_ico($fileExe, $fileIco);
        $hExe = winres_begin_update_resource($fileExe, false); // начинаю обновление иконки
		winres_load_icon_group_resource($hExe, 'MAINICON', 1033, $fileIco); // Устанавливаю иконку
        winres_end_update_resource($hExe, false); // Обновление закончено
        
	}
}
?>