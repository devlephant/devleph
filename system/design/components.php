<?
// инициализация всех компонентов, которые можно добавлять на форму

global $_c;
$_c->gdHorizontal	= 0;
$_c->gdVertical		= 1;

$_components = array();
$componentProps   = array();
$componentEvents  = array();
$files = (defined('DS_DEBUG_MODE') && constant('DS_DEBUG_MODE'))? array_merge(findFiles(dirname(__FILE__) . '/components/','php',0,1), findFiles(dirname(__FILE__) . '/components/dev/','php',0,1)) :findFiles(dirname(__FILE__) . '/components/','php',0,1);
$dir_n  = dirname(__FILE__);
foreach ($files as $file){
    
    $base_n = basenameNoExt($file);
    if (!EMULATE_DVS_EXE){
        Localization::incXml('/design/components/lang/'.$base_n.'/');    
        $_components[] = include($file);
    }
    
    $file_m = $dir_n.'/components/modules/'.$base_n;
    
    if (file_exists($file_m.'.php')){    
        loader::inc($file_m.'.php');
    }
    
    if (file_exists($file_m.'.phpe')){
        loader::inc($file_m.'.phpe');
    }
    
    if (file_exists($file_m.'.phpe2')){
        loader::inc($file_m.'.phpe2');
    }
}

if (EMULATE_DVS_EXE) return;
	
    //Files
	//Components !
	$localization = (bool)( (int)myOptions::get('prefs','translate_combos', "0") );//#ADDOPT;
	//Properties generation
	/*Delphi Objects Align*/
	$GLOBALS['align_meta'] = array('alNone', 'alTop', 'alBottom', 'alLeft', 'alRight', 'alClient', 'alCustom');
	/*Button Layout*/
	$GLOBALS['btnly_meta'] = array('blGlyphLeft', 'blGlyphRight', 'blGlyphTop', 'blGlyphBottom');
	/*Button Kind*/
	$GLOBALS['btnkn_meta'] = array('bkCustom', 'bkOK', 'bkCancel', 'bkHelp',
									'bkYes', 'bkNo', 'bkClose', 'bkAbort',
									'bkRetry', 'bkIgnore', 'bkAll');
	/*Modal Results*/
	$GLOBALS['mores_meta'] = array('mrNone', 'mrOk', 'mrCancel', 'mrAbort', 'mrRetry', 'mrIgnore', 'mrYes', 'mrNo',
						'mrAll', 'mrNoToAll', 'mrYesToAll');
	/*Bevel Shape*/
	$GLOBALS['bvshp_meta'] = array('bsBox', 'bsFrame', 'bsTopLine', 'bsBottomLine', 'bsLeftLine',
                                'bsRightLine', 'bsSpacer');
	/*Bevel Style*/
	$GLOBALS['bvstl_meta'] = array('bsLowered', 'bsRaised');
	/*Category Buttons Gradient Direction*/
	$GLOBALS['gradd_meta'] = array('gdHorizontal', 'gdVertical');
	/*Delphi Object Bevel Dimensions Styles*/
	$GLOBALS['bvdim_meta'] = array('bvNone', 'bvLowered', 'bvRaised', 'bvSpace');
	/*Delphi Object Bevel Overall Kind*/
	$GLOBALS['bvkid_meta'] = array('bkNone', 'bkTile', 'bkSoft', 'bkFlat');
	/*Delphi Object Border Style*/
	$GLOBALS['bsstl_meta'] = array('bsNone', 'bsSingle');
	/*Delphi Text Alignment*/
	$GLOBALS['txtal_meta'] = array('taLeftJustify', 'taRightJustify', 'taCenter');
	/*Text Vertical Alignment*/
	$GLOBALS['txval_meta'] = array('tlTop', 'tlCenter', 'tlBottom');
	/*Delphi Combobox States*/
	$GLOBALS['cbsts_meta'] = array('cbUnchecked', 'cbChecked', 'cbGrayed');
	/*Delphi ListBox Styles*/
	$GLOBALS['lbstl_meta'] = array('lbStandard', 'lbOwnerDrawFixed', 'lbOwnerDrawVariable', 'lbVirtual', 'lbVirtualOwnerDraw');
	/*Delphi Colors Meta (Standart)*/
	$GLOBALS['colrs_meta'] = array(
    							  'clBlack', 'clMaroon', 'clGreen', 'clOlive',
    							  'clNavy', 'clPurple', 'clTeal', 'clGray',
    							  'clSilver', 'clRed', 'clLime', 'clYellow',
    						      'clBlue', 'clFuchsia', 'clAqua', 'clWhite',
    						      'clMoneyGreen', 'clSkyBlue', 'clCream', 'clMedGray',
    						      'clActiveBorder', 'clActiveCaption', 'clAppWorkSpace', 'clBackground',
    						      'clBtnFace', 'clBtnHighlight', 'clBtnShadow', 'clBtnText',
    							  'clCaptionText', 'clDefault', 'clGradientActiveCaption', 'clGradientInactiveCaption',
    							  'clGrayText', 'clHighlight', 'clHighlightText', 'clHotLight',
    							  'clInactiveBorder', 'clInactiveCaption', 'clInactiveCaptionText', 'clInfoBk',
    							  'clInfoText', 'clMenu', 'clMenuBar', 'clMenuHighlight',
    							  'clMenuText', 'clNone', 'clScrollBar', 'cl3DDkShadow',
    							  'cl3DLight', 'clWindow', 'clWindowFrame', 'clWindowText',
    							  );
	/*Delphi Brush Styles*/
	$GLOBALS['brush_meta'] = array('bsSolid', 'bsClear', 'bsHorizontal', 'bsVertical','bsFDiagonal', 'bsBDiagonal', 'bsCross', 'bsDiagCross');
	/*Delphi Shape Types*/
	$GLOBALS['spstl_meta'] = array('stRectangle', 'stSquare', 'stRoundRect', 'stRoundSquare', 'stEllipse', 'stCircle');
	/*Delphi Pen Styles*/
	$GLOBALS['penst_meta'] = array('psSolid', 'psDash', 'psDot', 'psDashDot', 'psDashDotDot', 'psClear', 'psInsideFrame', 'psUserStyle', 'psAlternate');
	/*Delphi Pen Modes*/
	$GLOBALS['penms_meta'] = array('pmBlack', 'pmWhite', 'pmNop', 'pmNot', 'pmCopy', 'pmNotCopy',
                                    'pmMergePenNot', 'pmMaskPenNot', 'pmMergeNotPen', 'pmMaskNotPen', 'pmMerge',
                                    'pmNotMerge', 'pmMask', 'pmNotMask', 'pmXor', 'pmNotXor');
	/*Delphi Combobox Styles*/
	$GLOBALS['cbstl_meta'] = array('csDropDown', 'csSimple', 'csDropDownList', 'csOwnerDrawFixed','csOwnerDrawVariable');
	/*Delphi Edit CharCases*/
	$GLOBALS['edtcc_meta'] = array('ecLowerCase', 'ecNormal', 'ecUpperCase');
	/*Delphi Dragging Modes*/
	$GLOBALS['drgmd_meta'] = array('dmManual', 'dmAutomatic');
	/*Delphi Dragging Kinds*/
	$GLOBALS['drgkd_meta'] = array('dkDock', 'dkDrag');
	/*Delphi VCL Date Format*/
	$GLOBALS['datef_meta'] = array('dfShort','dfLong');
	/*Date Modes*/
	$GLOBALS['datem_meta'] = array('dmComboBox','dmUpDown');
	/*DateTimeKinds*/
	$GLOBALS['dtkkd_meta'] = array('dtkDate','dtkTime');
	/*Font Devices*/
	$GLOBALS['fntde_meta'] = array('fdScreen', 'fdPrinter', 'fdBoth');
	/*Forms Border Styles*/
	$GLOBALS['frmbds_meta'] = array('bsNone', 'bsSingle', 'bsSizeable', 'bsDialog', 'bsToolWindow', 'bsSizeToolWin');
	/*Default Monitors*/
	$GLOBALS['defmns_meta'] = array('dmActiveForm', 'dmDesktop', 'dmMainForm', 'dmPrimary');
	/*Print Scale Options*/
	$GLOBALS['prsopt_meta'] = array('poNone', 'poPrintToFit', 'poProportional');
	/*Thread Priorities*/
	$GLOBALS['thpriors_meta'] = array('tpIdle', 'tpLowest', 'tpLower', 'tpNormal', 'tpHigher', 'tpHighest',
                                    'tpTimeCritical');
	/*Icon Arrangement*/
	$GLOBALS['iar_meta'] = array('iaLeft', 'iaTop');
	/*ListView Sort Types*/
	$GLOBALS['lstsort_meta'] = array('stBoth', 'stData', 'stNone', 'stText');
	/*ListView View Styles*/
	$GLOBALS['lstvst_meta'] = array('vsIcon', 'vsSmallIcon', 'vsList', 'vsReport');
	/*Scrollbars Styles*/
	$GLOBALS['memscrst_meta'] = array('ssNone', 'ssHorizontal', 'ssVertical', 'ssBoth');
	/*PageControl Thumb Styles*/
	$GLOBALS['pthbstl_meta'] = array('tsTabs', 'tsButtons', 'tsFlatButtons');
	/*Progressbar Orientation*/
	$GLOBALS['prorients_meta'] = array('pbHorizontal', 'pbVertical');
	/*Scrollbar Styles*/
	$GLOBALS['sbposts_meta'] = array('sbHorizontal', 'sbVertical');
	/*Splitter Resize Style*/
	$GLOBALS['rsstyles_meta'] = array('rsLine', 'rsNone', 'rsPattern', 'rsUpdate');
	/*Static Border Styles*/
	$GLOBALS['sbstyles_meta'] = array('sbsNone', 'sbsSingle', 'sbsSunken');
	/*TrackBar Orientation*/
	$GLOBALS['trorients_meta'] = array('trHorizontal', 'trVertical');
	/*TrackBar Tooltip Positions*/
	$GLOBALS['trtpposts_meta'] = array('ptBottom', 'ptLeft', 'ptNone', 'ptRight', 'ptTop');
	/*TrackBar TickMarks*/
	$GLOBALS['tckmrks_meta'] = array('tmBottomRight', 'tmTopLeft', 'tmBoth');
	/*TrackBar Ticks Styles*/
	$GLOBALS['tckstls_meta'] = array('tsNone', 'tsAuto', 'tsManual');
	/*TUpDown Orientations*/
	$GLOBALS['tupsoris_meta'] = array('udHorizontal', 'udVertical');

	/*TTrayIcon BallonHint Types/Flags*/
	$GLOBALS['ttrbls_types_meta'] = ($localization)? 
							array(0 => t('None'),
							  1 => t('Information'),
							  2 => t('Warning'),
							  3 => t('Error'),
							  4 => t('Last Icon'),
							  5 => t('Tray Icon')): 
							array('trfNone', 'trfInfo', 'trfWarning', 'trfError', 'trfLastIcon', 'trfTrayIcon');
	
	$GLOBALS['metatypes'] = array(
	
		'Boolean'=>
			array(
				'TYPE'=>'check',
				'UPDATE_DSGN'=>1
			),
		/*на php 5.3 это никак не сократить :-( печалька*/
		'Integer'=>
			array(
				'TYPE'=>'number',
				'UPDATE_DSGN'=>1
			),
		'NativeInt'=>
			array(
				'TYPE'=>'number',
				'UPDATE_DSGN'=>1
			),
		'SmallInt'=>
			array(
				'TYPE'=>'number',
				'UPDATE_DSGN'=>1
			),
		'BigInt'=>
			array(
				'TYPE'=>'number',
				'UPDATE_DSGN'=>1
			),
		'Double'=>
			array(
				'TYPE'=>'number',
				'UPDATE_DSGN'=>1
			),
		'Single'=>
			array(
				'TYPE'=>'number',
				'UPDATE_DSGN'=>1
			),
		'string'=>
			array(
				'TYPE'=>'text',
				'UPDATE_DSGN'=>1
			),
		'TCaption'=>
			array(
				'TYPE'=>'text'
			),
		'TFont'=>
			array(
				'TYPE'=>'font',
				'CLASS'=>'TFont',
				'UPDATE_DSGN'=>true
			),
		'TAlign'=>
			array(
				'TYPE'=>'combo',
				'VALUES'=>$GLOBALS['align_meta'], //оптимизация
				'ADD_GROUP'=>true
			),
		'TBitmap'=>
			array(
				'TYPE'=>'image',
				'CLASS'=>'TBitmap',
				'UPDATE_DSGN'=>1
			),
		'TButtonLayout'=>
			array(
				'TYPE'=>'combo',
				'VALUES'=>$GLOBALS['btnly_meta'], //оптимизация
				'NO_CONST'=>1,
				'UPDATE_DSGN'=>1
			),
		'TModalResult'=>
			array(
				'TYPE'=>'combo',
				'VALUES'=>$GLOBALS['mores_meta'] //оптимизация
			),
		'TButtonKind'=>
			array(
				'TYPE'=>'combo',
				'VALUES'=>$GLOBALS['btnkn_meta'],
				'UPDATE_DSGN'=>1
			),
		'TBevelShape'=>
			array(
				'TYPE'=>'combo',
				'VALUES'=>$GLOBALS['bvshp_meta']
			),
		'TBevelStyle'=>
			array(
				'TYPE'=>'combo',
				'VALUES'=>$GLOBALS['bvstl_meta']
			),
		'TBevelCut'=>
			array(
				'TYPE'=>'combo',
				'VALUES'=>$GLOBALS['bvdim_meta'],
				'NO_CONST'=>true,
			),
		'TBevelKind'=>
			array(
				'TYPE'=>'combo',
				'VALUES'=>$GLOBALS['bvkid_meta'],
				'NO_CONST'=>true,
			),
		'TGradientDirection'=>
			array(
				'TYPE'=>'combo',
				'VALUES'=>$GLOBALS['gradd_meta'],
				'NO_CONST'=>true,
			),
		'TColor'=>
			array(
				'TYPE'=>'color'
			),
		
			//SIZES AND POSITION//
		   //РАЗМЕРЫ И ПОЗИЦИЯ //
		'TSizeConstraints'=>
			array(
				'TYPE'=>'sizes',
				'ADD_GROUP'=>true,
				'UPDATE_DSGN'=>1
			),
	);
	//CAPTION - указывать вручную придётся
	//'NO_CONST'=>true, - указывать придётся, если для константы используется перевод, вот так вот
	//PROP - зависит от случая
	
	function sort_props(&$props, $class, $typeC = array(
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
			))
	{
		$sorted = $unsorted = array();
		foreach($props as $prop=>$type)
		{
			if( gui_class_prop_iswritable($class, $prop) )
				if( in_array($type, $typeC) ) {
					$sorted[ array_search($type, $typeC) ][$prop] = $type;
				} else {
					$unsorted[$prop] = $type;
				}
		}
		$props = array();
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
		$res	= array();
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
				$res[] = array(
					'CAPTION'=>t('p_Left'),
					'PROP'=>'x',
					'TYPE'=>'number',
					'ADD_GROUP'=>true,
					'UPDATE_DSGN'=>1
					);
				} break;
				case 'Top':{
				$res[] = array(
					'CAPTION'=>t('p_Top'),
					'PROP'=>'y',
					'TYPE'=>'number',
					'ADD_GROUP'=>true,
					'UPDATE_DSGN'=>1
					);
				} break;
				case 'Width':{
				$res[] = array(
					'CAPTION'=>t('Width'),
					'PROP'=>'w',
					'TYPE'=>'number',
					'ADD_GROUP'=>true,
					'UPDATE_DSGN'=>1
					);
				} break;
				case 'Height':{
				$res[] = array(
					'CAPTION'=>t('Height'),
					'PROP'=>'h',
					'TYPE'=>'number',
					'ADD_GROUP'=>true,
					'UPDATE_DSGN'=>1
					);
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
							$r = array();
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
	function sort_events(&$events, $typeC = array(
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
			))
	{
		$sorted = $unsorted = array();
		foreach($events as $event=>$type)
		{
			if( in_array($event, $typeC) ) {
				$sorted[ array_search($event, $typeC) ][$event] = $type;
			} else {
				$unsorted[$event] = $type;
			}
		}
		$events = array();
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
		$props = $events = $res = array();
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
				$res[strtolower($prop)] = array(
                  'CAPTION'=> t($prop),
                  'EVENT'=> strtolower(substr($prop, 0, 1)) . substr($prop, 1),
                  'INFO'=>'%func%(' . $a . ')',
                  'ICON'=> strtolower($prop),
                  );
			}
			
		}
		return $res;
	}
	
	function get_sorted_methods($class)
	{
		$res = array();
		$methods = gui_class_methodList($class);
		if( empty($methods) ) return $res;
		foreach( $methods as $method_name=>$parameters )
		{
			$res[] = array(
					  'CAPTION'=> t($method_name),
					  'PROP'=> strtolower(substr($method_name, 0, 1)) . substr($method_name, 1),
					  'INLINE'=> $method_name . ' ' . str_replace(array('Integer', 'Boolean'), array('Int', 'Bool'),  $parameters),
					  );
		}
		return $res;
	}
	
	foreach( get_declared_classes()/*gui_get_all_unitsclasses()*/ as $classname )
	{
		if( !gui_class_isset($classname) ) continue;
		$p = get_sorted_props($classname);
		$e = get_sorted_events($classname);
		//$m = get_sorted_methods($classname);
		if( !empty($p) )
			$componentProps[$classname]		= $p;
		//*/
		if( !empty($e) )
			$componentEvents[$classname]	= $e;
		/*
		if( !empty($m) )
			$componentMethods[$classname]	= $m;
		*/
	}
	
	
	$files = findFiles($dir_n . '/components/properties/','php');
	foreach ($files as $file){
		$componentProps[basenameNoExt($file)] = include($dir_n . '/components/properties/' . $file);
	}
		
	$files = findFiles($dir_n . '/components/events/','php');
	foreach ($files as $file){
		$componentEvents[basenameNoExt($file)] = include($dir_n . '/components/events/' . $file);
	}
	
	$files = findFiles($dir_n . '/components/methods/','php');
	foreach ($files as $file){
		$componentMethods[basenameNoExt($file)] = include($dir_n . '/components/methods/' . $file);
	}
	
    $files = findFiles($dir_n . '/components/modifers/','php');
    foreach ($files as $file){
        require($dir_n . '/components/modifers/' . $file);
    }
	
    BlockData::sortList($_components, 'SORT');
    
    
    $files = findFiles($dir_n . '/editor_types/','php');
    foreach ($files as $file)
        require $dir_n . '/editor_types/' . $file;
	
    ////// создаем панель компонентов ///////// 
	/*AZ: Вырезал этот код ещё давно, т.к хлам по сути, можно не создавать в этом месте, а из dfm грузить*/
    global $fmComponents;
    /*$cp = new TComponentPanel($fmComponents);
    
    $cp->parent = c('fmComponents');*/
    //$cp->hide();
    //$cp->name = 'list';
    //$cp->text = '';
    //$cp->align  = 'alClient';
    $cp = c('fmComponents->list');
    global $_cComplist;
	//#LOADER;
	foreach( $_components as $ikey=>$info )
	{
		if( !class_exists($info['CLASS']) )
		{
			unset( $_components[$ikey] );
		}
	}
	$_cComplist = $_components;
        $_winControls = array();
        $componentClasses = array();
        $groups = array();
        foreach ($_components as $c){
            
			if(isset($c['MODULES']))
            foreach ((array)$c['MODULES'] as $mod){
                
                if ( ! extension_loaded(str_ireplace('php_','',basenameNoExt($mod))) ){
					gui_Message(t('Пропишите %s модуль в /core/php.ini в секцию extensions', $mod));
					/*AZ:Нужно бы функцию dl() портировать, кстати, тут ещё нужна проверка на то, есть ли эта строка в php.ini
						т.к бывают ошибки с загрузкой расширений, а не их отсутствие в загр. секции, что не есть хорошо*/
					//dl($mod);
                }
            }
            
			if(isset($c['USE_SKIN']))
            if ($c['USE_SKIN'])
                myModules::$skinClasses[] = $c['CLASS'];
            
            if (!in_array($c['GROUP'], $groups)){
                $cp->addSection($c['GROUP'],t('gr_'.$c['GROUP']));
                $groups[] = $c['GROUP'];
            }
    
            $btn = $cp->addButton($c['GROUP']);
           // $btn->onClick = 'myDesign::selectClass(0, _c('.$btn->self.')); _empty';
            
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
        myVars::set2($componentMethods,'componentMethods');
        
        $_winControls[] = 'TTabSheet';
        myVars::set2($_winControls,'_winControls');