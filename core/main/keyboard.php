<?
/*
  PHP4Delphi key functions library
  
  2019 ver 2.1
*/
global $_c;

  $_c->MOD_ALT = 1;
  $_c->MOD_CONTROL = 2;
  $_c->MOD_SHIFT = 4;
  $_c->MOD_WIN = 8;

class HotKey {
	/*
	const FUNC = 0;
	const MODIFER = 1;
	const KEY = 2;
    */
	private static $fncs = array();
    static function event($modifer, $key){
        
        if(!empty(self::$fncs))
        foreach ((array)self::$fncs as $el){
            if (!($el[1]==$modifer && $el[2]==$key)) continue;
            
            $func = call_user_func($el[0]);
        }
    }
    
    static function add($modifer, $key, $func_name){
        
		foreach(self::$fncs as $i=>$e)
				if($e[0] == $func_name && $e[1] == $modifer && $e[2] == $key) return;
		
        reg_hot_key(rand(),$modifer, $key);
        
       self::$fncs[] = array($func_name, $modifer, $key);
    }
	static function remove($modifer, $key, $func_name = false){

		if( $func )
		{	
			foreach(self::$fncs as $i=>$e)
				if($e[0] == $func_name && $e[1] == $modifer && $e[2] == $key) unset( self::$fncs[$i] );
		} else {
			foreach(self::$fncs as $i=>$e)
				if($e[1] == $modifer && $e[2] == $key) unset( self::$fncs[$i] );
		}
	}
	static function imitate($modifer, $key)
	{
		self::event($modifer, $key);
	}
	static function getEvents($func_name)
	{
		$res = array();
		foreach(self::$fncs as $i=>$e)
				if($e[0]==$func_name) $res[] = array($e[1], $e[2]);
		return $res;
	}
	static function getFuncs($modifer, $key)
	{
		$res = array();
		foreach(self::$fncs as $i=>$e)
				if($e[1]==$modifer&&$e[2]==$key) $res[] = $e[0];
		return $res;
	}
}
?>