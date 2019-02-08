<?

/*
    ByteCode Module
		* with bcompiler
*/

// Fix for load from String Bcompiler

class ByteCode {
	
	static $handle = null;

	static function load( $str ){
	
		$fh = fopen("php://memory", "w+");
		fwrite($fh, $str);
		fseek($fh, 0); 

		bcompiler_read($fh);
		
		fclose($fh);
	}
	
	static function loadGz( $str ){
		self::load( gzuncompress( $str ) );
	}
	
	static function loadFile( $file ){
		
		$fh = fopen($file, "r");
		bcompiler_read($fh);
		fclose($fh);
	}
	
	static function compileStart( ){
		self::$handle = fopen('php://memory', 'w');
		bcompiler_write_header( self::$handle );
	}
	
	static function compileFunc($name){
		bcompiler_write_function( self::$handle, $name );
	}
	
	static function compileClass($name){
		bcompiler_write_class( self::$handle, $name );
	}
	
	static function compileConst($name){
		bcompiler_write_const( self::$handle, $name );
	}
	
	static function compileFile($file){
		bcompiler_write_file( self::$handle, $file );
	}
	
	static function compileFinish( ){
		bcompiler_write_footer( self::$handle );
		
		$result = '';
		while (!feof(self::$handle)) {
		  $result .= fread(self::$handle, 8192);
		}
		fclose(self::$handle);
		return $result;
	}
}
?>