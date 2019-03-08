<?

function php_strip_whitespace_ex($source){
        $tokens = token_get_all($source);
        // Init
        $source = '';
        $was_ws = false;
        // Process
        foreach ($tokens as $token) {
            if (is_string($token)) {
                // Single character tokens
                $source .= $token;
            } else {
                list($id, $text) = $token;
                switch ($id) {
                    // Skip all comments
                    case T_COMMENT:
                    //case T_ML_COMMENT:
                    case T_DOC_COMMENT:
                        break;
                    // Remove whitespace
                    case T_WHITESPACE:
                        // We don't want more than one whitespace in a row replaced
                        if ($was_ws !== true) {
                            $source .= ' ';
                        }
                        $was_ws = true;
                        break;
                    default:
                        $was_ws = false;
                        $source .= $text;
                        break;
                }
            }
        }
        
        return $source;
}


class DS_BuildSoulEngine {

	public $modules;
	public $core;
	public $core_dir;
	
	public function __construct( $core_dir ){
		
		$this->core_dir = $core_dir;
		$file = file_get_contents( $core_dir . '/include.php' );
		$data = explode('/* %START_MODULES% */', $file);
		$this->parseModules( $data[1] );
		$this->core = $data[0];
	}
	
	public function parseModules($data){
		
		$lines = explode(chr(13), $data);
		$lines = array_map('trim', $lines);
		
		foreach($lines as $line){
			
			if ( strpos($line, 'include_lib(\'') === 0 ){
				
				$line = str_ireplace(array('include_lib(\'', "');"), '', $line);
				$tmp = array_map('trim', explode("','", $line));
				
				$this->modules[] = $tmp;
			}
		}
		
	}
	
	public function SaveToFile( $file = false ){
		/*
		if ( file_exists($file) )
		*/
		$str = $this->core;
		
		foreach( $this->modules as $module ){
				
			$x_file = str_replace("//", "/", $this->core_dir . '/' . $module[0] . '/' . $module[1] . '.php' );
			$code = trim( file_get_contents( $x_file ) );
			if ( strpos($code, '<?') === 0 )
				$code = substr($code, 2);
			
			if ( substr($code,-2) === '?>' )
				$code = substr($code, 0, -2);
				
			$str .= ';' . $code;
		}
		
		/*****/
		if ( strpos($str, '<?') === 0 )
			$str = substr($str, 2);
			
		if ( substr($code, -2) === '?>' )
			$str = substr($str, 0, -2);
		/*****/
			
		$str = base64_encode( php_strip_whitespace_ex($str) );

		if (!$file)
			return $str;
			
		if ( !file_exists($file) )
			file_put_contents($file, $str);
		else {
			$md5 = md5($str);
	
			if ( md5_file($file) !== $md5 )
				file_put_contents($file, $str);
		}
		
		return $str;
	}
}