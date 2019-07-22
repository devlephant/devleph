<?php
class dsThemeDesign
{
	private static $rfuncs;
	static $rpfunc;
	public	static $ini;
	public	static $dir;
	
	public function RegisterRFunc(...$vars)
	{
		foreach($vars as $var)
			self::$rfuncs[] = $var;
	}
	public function RegisterProgressFunc($func)
	{
		self::$rpfunc = $func;
	}
	public function Change($theme)
	{
		$theme_dir = DOC_ROOT . "design/theme/{$theme}";
		if( !file_exists("{$theme_dir}/config.ini") ) return;
		self::$dir = $theme_dir;
		self::$ini = parse_ini_file("{$theme_dir}/config.ini",true);
		myOptions::set('prefs','studio_theme', $theme);
		$count = count(self::$rfuncs);
		
		foreach( self::$rfuncs as $ReloadFunc )
		{
			call_user_func($ReloadFunc, $theme_dir);
			$func = self::$rpfunc; //Andrewz: удивительно, но это решение... No comments...
				$func($count);
		}
	}
	public function Load()
	{
		self::$dir = DOC_ROOT . 'design/theme/' . myOptions::get('prefs','studio_theme','light');
		self::$ini = parse_ini_file( self::$dir . "/config.ini", true );
		self::$rpfunc = function($s){ return false; };
	}
}