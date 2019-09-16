<?
     if( DS_DEBUG_MODE ){
		pre($argv);
		$tt = microtime(1);
	}else{
		dsErrorDebug::ErrStatus(false); // отключение вывода ошибок
    }    
	
	
	if (!EMULATE_DVS_EXE){
		define('DS_USERDIR',winLocalPath(CSIDL_PERSONAL).'/Dev-S/' );
		$ini = new TIniFileEx(DS_USERDIR.'allconfig.ini');
		$GLOBALS['ALL_CONFIG'] = $ini->arr;
		define('DV_YEAR',		2019, 	 false );
		define('DV_VERSION',	'3.0.4.1', false );
		define('DV_PREFIX',		'Indev', false );
    }
	
    require 'libs/mvc.php';
     
	if (!EMULATE_DVS_EXE){
        loader::lib('data');
        loader::model('options');

        $lang			= myOptions::get('main','lang', substr(strtolower(osinfo_syslang()), 0, 2));
        $lang_charset	= myOptions::get('main','lang_charset', 'DEFAULT_CHARSET');
		
        define_ex('LANG_CHARSET', constant($lang_charset));
        define_ex('LANG_ID', $lang);
        Localization::setLocale($lang);
    }

    if (!EMULATE_DVS_EXE){
		loader::model('compile');
		loader::model('prover');
	}
    loader::modules('project_parts/include');
	if (!EMULATE_DVS_EXE){
	loader::lib('(debug)studio-only');
    loader::lib('syntax');
    loader::lib('zip');
    loader::lib('vseditor');
    loader::lib('synedit');
    loader::lib('docking');
    loader::lib('catbuttons');
	}
    
    if (!EMULATE_DVS_EXE){
        
        loader::model('codegen');
        loader::model('syntaxCheck');
        loader::model('design');
        loader::model('copyer');
        loader::model('properties');
        loader::model('images');
   
        loader::model('events');
        
    
        loader::model('inspector');
		loader::model('treebrowser');
        loader::model('project');
		loader::model('themes');
        //loader::model('options');
        loader::model('modules');
        loader::model('novisual');
        loader::model('winres');
        loader::model('upx');
        loader::model('history');
        loader::model('debug');
        loader::model('masters');
        loader::model('complete');
        loader::model('build');
        
        loader::model('utils');
    }
    
    loader::model('evalproject');
    
    if (!EMULATE_DVS_EXE){
        loader::model('dialogs_ex');
        loader::model('dsapi');
    }
	