<?
// инициализация всех компонентов, которые можно добавлять на форму

global $_c;
$_c->gdHorizontal	= 0;
$_c->gdVertical		= 1;

$_components = [];
$componentProps   = [];
$componentEvents  = [];
$files = (defined('DS_DEBUG_MODE') && constant('DS_DEBUG_MODE'))? array_merge(findFiles(dirname(__FILE__) . '/components/','php',0,1), findFiles(dirname(__FILE__) . '/components/dev/','php',0,1)) :findFiles(dirname(__FILE__) . '/components/','php',0,1);
$dir_n  = dirname(__FILE__);

foreach ($files as $file){
    
    $base_n = basenameNoExt($file);
    if (!EMULATE_DVS_EXE){
        Localization::incXml('/design/components/lang/'.$base_n.'/');    
        $_components[] = include($file);
    }
    
    $file_m = $dir_n.'/components/modules/'.$base_n;
    $loaded = false;
    if (file_exists($file_m.'.php')){    
        loader::inc($file_m.'.php');
		dsAPI::afterClassLoaded( $base_n );
    }
    
}

if (EMULATE_DVS_EXE) return;

	global $_c;
	foreach (findFiles($dir_n . '/editors/','php',false,true) as $file)
        require $file;
	foreach (findFiles($dir_n . '/components/properties/','php')as $file){
		$componentProps[basenameNoExt($file)] = include($dir_n . '/components/properties/' . $file);
	}
	
	foreach (findFiles($dir_n . '/components/events/','php') as $file){
		$componentEvents[basenameNoExt($file)] = include($dir_n . '/components/events/' . $file);
	}
	
    foreach (findFiles($dir_n . '/components/modifers/','php',false,true) as $file){
        require $file;
    }
	
	function convertReturnType($class, $method, $type)
	{
		$res = '';
		switch($type)
		{
			case -1:
			{	$res = 'void'; 	}
			break;
			case tkUnknown: 
			{	$res = 'void';	}
			break;
			case tkInteger:
			case tkInt64:
			{	$res='Integer';	}
			break;
			case tkChar:
			case tkWChar:
			case tkString:
			case tkLString:
			case tkWString:
			case tkUstring:
			{	$res='String';	}
			break;
			case tkFloat:
			{	$res = 'Float';	}
			break;
			case tkPointer:
			{	$res = 'Pointer';	}
			break;
			case tkClass:
			{	$res = gui_methodrtype($class, $method, true); }
			break;
			DEFAULT:
			{	return 'void ';	}
			break;
		}
					//required further information
			/*
			  tkClass
			  tkClassRef
			  
			  tkSet
			  tkEnumeration:
			  tkMethod
			  tkArray
			  tkRecord
			  tkInterface
			  
			  tkProcedure
			*/
		return $res . ' ';
	}
	function get_sorted_methods($class)
	{
		global $_c;
		$res = [];
		$alt = dirname(__FILE__)."/components/methods/$class.php";
		if(!gui_class_isset($class) && is_file($alt)) return include( $alt );
		$methods = gui_class_methodList($class);
		if( is_file($alt) ) include( $alt );
		if( empty($methods) ) return $res;
		foreach( $methods as $method_name=>$parameters )
		{
			//if( empty($parameters) ) continue;
			$res[] = [
					  'CAPTION'=> t($method_name),
					  'PROP'=> strtolower(substr($method_name, 0, 1)) . substr($method_name, 1),
					  'INLINE'=> convertReturnType($class, $method_name, gui_methodrtype($class, $method_name)). $method_name . ' ' . str_replace(array('Boolean'), array('Bool'),  $parameters),
					  ];
		}
		return $res;
	}
	
    ////// создаем панель компонентов ///////// 
	/*AZ: Вырезал этот код ещё давно, т.к хлам по сути, можно не создавать в этом месте, а из dfm грузить*/
    $cp = c('fmComponents->list');
	$rfc = function($theme)
	{
		$cp = c('fmComponents->list');
		$pp = c('fmMain->NXGlyphos');
		$cp->ExpandGlyph->loadFromFile("{$theme}/pc_collapsed.bmp");
		$cp->CollapseGlyph->loadFromFile("{$theme}/pc_expanded.bmp");
		$pp->clear();
		$pp->addFromFile("{$theme}/pp_collapsed.bmp");
		$pp->addFromFile("{$theme}/pp_expanded.bmp");
	};
	$rfc(dsThemeDesign::$dir);
	dsThemeDesign::RegisterRFunc($rfc);
	$customGroup = myOptions::get('prefs','cgroups',false);
	if($customGroup)
	{
		$customGroups = json_decode(SYSTEM_DIR . '/desing/CG/' . $customGroup);
		$od = $_components;
		$_components = [];
		$idx = 0;
			foreach( $customGroups as $group)
			{
				foreach( $group[1] as $c1 )
				{
					$_components[$i] = $c1;
					$_components[$i]['GROUP'] = $group[0];
					++$idx;
				}
			}
		unset($od,$idx);
	} else 
		BlockData::sortList($_components, 'SORT');
	$_cComplist = $_components;
    global $_cComplist;
	//#LOADER;
        $componentClasses = [];
        $groups = [];
		$ccount = count($_components);
        foreach ($_components as $ikey=>$c){
			fmLogoIn::Progress2(30,$ccount);
            if( !class_exists($c['CLASS']) || is_subclass_of ($c['CLASS'], 'dsErrorClassUndefined') )
			{
				unset( $_components[$ikey] );
				continue;
			}
			if(isset($c['MODULES']))
            foreach ((array)$c['MODULES'] as $mod){
                
                if ( ! extension_loaded(substr(basenameNoExt($mod),4)) && basenameNoExt($mod) !== 'php_squall' ){
					gui_Message(t("Please, add module \"%s\" to the /core/php.ini in \"extensions\" section", $mod));
					/*AZ:Нужно бы функцию dl() портировать, кстати, тут ещё нужна проверка на то, есть ли эта строка в php.ini
						т.к бывают ошибки с загрузкой расширений, а не их отсутствие в загр. секции, что не есть хорошо*/
					//dl($mod);
                }
            }
            
			if(isset($c['USE_SKIN']))
            if ($c['USE_SKIN'])
                myModules::$skinClasses[] = $c['CLASS'];
            
			if(isset($c['REPLACE']))
			{
				if( is_array($c['REPLACE']) )
				{
					foreach($c['REPLACE'] as $reps)
						myProject::addReplaceable($reps, $c['CLASS']);
				} else
					myProject::addReplaceable($c['REPLACE'], $c['CLASS']);
				if( isset($c['REPLACE_RULE']) )
					myProject::AddReplaceRule($c['CLASS'], $c['REPLACE_RULE']);
			}

			if (!in_array($c['GROUP'], $groups)){
                $cp->addSection($c['GROUP'],$customGroup?$c['GROUP']:t('gr_'.$c['GROUP']));
                $groups[] = $c['GROUP'];
            }
            $btn = $cp->addButton($c['GROUP']);
            
            $componentClasses[$btn->self] = $c;
           
            $btn->caption    = $c['CAPTION'];
            $btn->hint       = $c['CAPTION'] .' - '.$c['CLASS'];
            $btn->imageIndex = myImages::getImgID($c['CLASS']);
            if ($btn->imageIndex == -1)
                $btn->imageIndex = myImages::getImgID('component');
            //$btn->picture->loadFromFile(myImages::get24($c['CLASS']));
        }
        
        $cp->onButtonClicked = 'myDesign::selectClass';
        // $cp->show();   
        unset($groups,$ikey,$c);
        myVars::set2($componentClasses, 'componentClasses');
        myVars::set2($cp,'_componentPanel');
        myVars::set2($componentProps,'componentProps');
        myVars::set2($componentEvents,'componentEvents');
		fmLogoin::progress(1, "Components Loaded");