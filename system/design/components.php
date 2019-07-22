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
	
    //Files
	//Components !
	$localization = (bool)( (int)myOptions::get('prefs','translate_combos', "0") );//#ADDOPT;
	//Properties generation
	$GLOBALS['metatypes'] = [
	
		'Boolean'=>
			[
				'TYPE'=>'check'
			],
		/*Да, время настало, уже не 5.3 :)*/
		'Integer'=>
			[
				'TYPE'=>'number'
			],
		'NativeInt'=>
			[
				'TYPE'=>'number'
			],
		'SmallInt'=>
			[
				'TYPE'=>'number'
			],
		'BigInt'=>
			[
				'TYPE'=>'number'
			],
		'Double'=>
			[
				'TYPE'=>'number'
			],
		'Single'=>
			[
				'TYPE'=>'number'
			],
		'string'=>
			[
				'TYPE'=>'text'
			],
		'TCaption'=>
			[
				'TYPE'=>'text'
			],
		'TFont'=>
			[
				'TYPE'=>'font',
				'CLASS'=>'TFont'
			],
		'TBitmap'=>
			[
				'TYPE'=>'image',
				'CLASS'=>'TBitmap'
			],
		'TColor'=>
			[
				'TYPE'=>'color'
			],
		
			//SIZES AND POSITION//
		   //РАЗМЕРЫ И ПОЗИЦИЯ //
		'TSizeConstraints'=>
			[
				'TYPE'=>'sizes',
				'ADD_GROUP'=>true
			],
	];
	//CAPTION - указывать вручную придётся
	//'NO_CONST'=>true, - указывать придётся, если для константы используется перевод, вот так вот
	//PROP - зависит от случая
	
	function sort_props(&$props, $class, $typeC = [
				0=>'TCaption',
				1=>'string',
				2=>'TFont',
				3=>'TColor',
				4=>'TPicture',
				5=>'TBitMap',
				6=>'TPNGPicture',
				7=>'TPngGlyph',
				8=>'TGlyph',
				9=>'TButtonGlyph',
				10=>'TButtonLayout',
				11=>'TNumGlyphs',
			])
	{
		$sorted = $unsorted = [];
		foreach($props as $prop=>$type)
		{
			if( gui_class_prop_iswritable($class, $prop) )
				if( in_array($type, $typeC) ) {
					$sorted[ array_search($type, $typeC) ][$prop] = $type;
				} else {
					$unsorted[$prop] = $type;
				}
		}
		$props = [];
		if( !empty($sorted) )
		foreach( $sorted as $p )
		{
			foreach($p as $k=>$v)
				$props[$k] = $v;
		}
		if( !empty($unsorted) )
		foreach( $unsorted as $prop=>$type )
		{
			$props[$prop] = $type;
		}
	}
    //Delphi components properties
	function get_sorted_props($class)
	{
		$localization = (bool)( (int)myOptions::get('prefs','translate_combos', "0") );//#ADDOPT;
		$res	= [];
		$props	= gui_class_proparray($class);
		if( empty($props) ) return $res;
		sort_props($props, $class);
		foreach( $props as $prop=>$type )
		{

			if( substr($type, 0, 1) == 'T' && substr($type, strlen($type)-5) == 'Event' )
				continue;
			
			switch( $prop )
			{
				case 'HelpKeyword':{
				} break;
				case 'Left':{
				$res[] = [
					'CAPTION'=>t('p_Left'),
					'PROP'=>'x',
					'TYPE'=>'number',
					'ADD_GROUP'=>true
					];
				} break;
				case 'Top':{
				$res[] = [
					'CAPTION'=>t('p_Top'),
					'PROP'=>'y',
					'TYPE'=>'number',
					'ADD_GROUP'=>true
					];
				} break;
				case 'Width':{
				$res[] = [
					'CAPTION'=>t('Width'),
					'PROP'=>'w',
					'TYPE'=>'number',
					'ADD_GROUP'=>true
					];
				} break;
				case 'Height':{
				$res[] = [
					'CAPTION'=>t('Height'),
					'PROP'=>'h',
					'TYPE'=>'number',
					'ADD_GROUP'=>true
					];
				} break;
				default:{
					if( isset($GLOBALS['metatypes'][$type]) )
					{
						$res[] = $GLOBALS['metatypes'][$type];

						if(in_array($prop, array('DragKind', 'DragMode', 'Enabled', 'Visible')))
						{
							$res[count($res)-1]['PROP']		 = 'a'.$prop;
							$res[count($res)-1]['REAL_PROP'] = $prop;
							$res[count($res)-1]['ADD_GROUP'] = true;
						} else {
							if(in_array($prop, array( 'ClientHeight', 'ClientWidth', 'LRDockWidth', 'TBDockHeight', 'UndockWidth', 'UndockHeight', 'ComponentIndex', 'DesignInfo', 'Tag')))
								$res[count($res)-1]['ADD_GROUP'] = true;
							$res[count($res)-1]['PROP']		 = $prop;
						}
						
						$res[count($res)-1]['CAPTION']	= (t($prop . '_prop') === $prop . '_prop')? t($prop): t($prop . '_prop');
						
						if(	$localization && isset($res[count($res)-1]['VALUES']) )
						{
							$r = [];
							foreach( $res[count($res)-1]['VALUES'] as $v )
							{
								if( is_numeric($v) )
								{
									$r[$v] = t($v);
								} else {
									$r[ constant($v) ] = t($v);
								}
							}
							$res[count($res)-1]['VALUES']	= $r;
							$res[count($res)-1]['NO_CONST'] = true;
						}
					} else {
						$unexist[$class][] = $type;
					}
				} break;
			}
		}
	return $res;
	}
	//Properties generation end
	function sort_events(&$events, $typeC = [
				0=>'OnClick',
				1=>'OnDblClick',
				2=>'OnMouseActivate',
				3=>'OnMouseDown',
				4=>'OnMouseUp',
				5=>'OnMouseEnter',
				6=>'OnMouseLeave',
				7=>'OnMouseMove',
				8=>'OnMouseWheel',
				9=>'OnMouseWheelDown',
				10=>'OnMouseWheelUp',
				11=>'OnKey',
				15=>'OnFocus',
				16=>'OnBlur',
				17=>'OnCreate',
				18=>'OnClose',
				19=>'OnCloseQuery',
				20=>'OnActivate',
				21=>'OnDeactivate',
				22=>'OnShow',
				23=>'OnHide',
				24=>'OnResize',
				25=>'OnPaint',
			])
	{
		$sorted = $unsorted = [];
		foreach($events as $event=>$type)
		{
			if( in_array($event, $typeC) ) {
				$sorted[ array_search($event, $typeC) ][$event] = $type;
			} else {
				$unsorted[$event] = $type;
			}
		}
		$events = [];
		if(!empty($sorted))
		foreach( $sorted as $p )
		{
			foreach($p as $k=>$v)
				$events[$k] = $v;
		}
		if(!empty($unsorted));
		foreach( $unsorted as $prop=>$type )
		{
			$events[$prop] = $type;
		}
	}

	function get_sorted_events($class)
	{
		$props = $events = $res = [];
		$props	= gui_class_proparray($class);
		if( empty($props) ) return $res;
		
		foreach( $props as $prop=>$type )
		{

			if( substr($type, 0, 1) == 'T' && substr($type, strlen($type)-5) == 'Event' )
				$events[$prop] = $type;
		}
		sort_events($events);
		if( empty($events) ) return $res;
		foreach( $events as $prop=>$type )
		{
			$a = gui_get_event_paramss($class, $prop);
			if( $a !== '!' ) 
			{
				$res[strtolower($prop)] = [
                  'CAPTION'=> t($prop),
                  'EVENT'=> strtolower(substr($prop, 0, 1)) . substr($prop, 1),
                  'INFO'=>'%func%(' . $a . ')',
                  'ICON'=> strtolower($prop),
                  ];
			}
			
		}
		return $res;
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
		if(!gui_class_isset($class)) return include( dirname(__FILE__)."/components/methods/$class.php");
		$methods = gui_class_methodList($class);

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
	//gui_get_all_unitsclasses() as $classname
	/*foreach( get_declared_classes() as $classname )
	{
		if( !gui_class_isset($classname) ) continue;
		$p = get_sorted_props($classname);
		$e = get_sorted_events($classname);
		$p = get_sorted_props($classname);
		if( !empty($p) )
			$componentProps[$classname]		= $p;
		
		if( !empty($e) )
			$componentEvents[$classname]	= $e;
		
		
	}*/
	global $_c;
	foreach (findFiles($dir_n . '/components/properties/','php')as $file){
		$componentProps[basenameNoExt($file)] = include($dir_n . '/components/properties/' . $file);
	}
	
	foreach (findFiles($dir_n . '/components/events/','php') as $file){
		$componentEvents[basenameNoExt($file)] = include($dir_n . '/components/events/' . $file);
	}
	
    foreach (findFiles($dir_n . '/components/modifers/','php') as $file){
        require($dir_n . '/components/modifers/' . $file);
    }
	
    foreach (findFiles($dir_n . '/editor_types/','php') as $file)
        require $dir_n . '/editor_types/' . $file;
	
    ////// создаем панель компонентов ///////// 
	/*AZ: Вырезал этот код ещё давно, т.к хлам по сути, можно не создавать в этом месте, а из dfm грузить*/
    global $fmComponents;
    $cp = c('fmComponents->list');
	$theme = dsThemeDesign::$dir; //#ADDOPT;
	$cp->ExpandGlyph->loadFromFile("{$theme}/pc_collapsed.bmp");
	$cp->CollapseGlyph->loadFromFile("{$theme}/pc_expanded.bmp");
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
					$idx++;
				}
			}
		unset($od,$idx);
	} else 
		BlockData::sortList($_components, 'SORT');
	$_cComplist = $_components;
    global $_cComplist;
	//#LOADER;
        $_winControls = [];
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
                
            if (isset($c['WINCONTROL']) && $c['WINCONTROL'])
                $_winControls[] = $c['CLASS'];
            //$btn->picture->loadFromFile(myImages::get24($c['CLASS']));
        }
        
        $cp->onButtonClicked = 'myDesign::selectClass';
        // $cp->show();   
        unset($groups);
        myVars::set2($componentClasses, 'componentClasses');
        myVars::set2($cp,'_componentPanel');
        myVars::set2($componentProps,'componentProps');
        myVars::set2($componentEvents,'componentEvents');
        
        $_winControls[] = 'TTabSheet';
        myVars::set2($_winControls,'_winControls');
		fmLogoin::progress(1, "Components Loaded");