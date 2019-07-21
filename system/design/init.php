<?
global $SCREEN, $fmEdit, $fmComponents, $fmMain, $fmObjInspect;

if (!EMULATE_DVS_EXE){  
$fmComponents->caption = t('components');

$aw = getSystemMetrics(SM_CXFULLSCREEN);
$ah = getSystemMetrics(SM_CYFULLSCREEN);
    require 'design/dialogs.php';
}


require 'design/components.php';


if (!EMULATE_DVS_EXE){  
    
    require 'design/events.php';    


    $GLOBALS['APPLICATION']->processMessages();    
    $_sc = new TSizeCtrl($fmEdit);
    $_sc->gridSize = (int)myOptions::get('sc', 'gridSize', 8);
	$_sc->MovePanelCanvas->brush->color = (int)myOptions::get('sc','SizerInnerColor', 12632256);
	$_sc->MovePanelCanvas->pen->color = (int)myOptions::get('sc','SizerOuterColor', clBlack);
	$_sc->MovePanelCanvas->pen->style = (int)myOptions::get('sc','SizerPenStyle',2);
    $_sc->BtnColor = (int)myOptions::get('sc','BtnColor',clBlue);
	$_sc->DisabledBtnColor = (int)myOptions::get('sc','DisabledBtnColor', clGray);
	
    $_sc->showGrid = (bool)myOptions::get('sc','showGrid',false);
    $_sc->enable   = true;
    $_sc->popupMenu= c('fmMain->editorPopup');
    $_sc->onStartSizeMove = 'myDesign::startSizeMove';
    $_sc->OnDuringSizeMove = 'myDesign::duringSizeMove';
	//c('fmLogoin->label5')->caption = 'Initializing... 35%';
	//c('fmLogoin->loadbar')->w = c('fmLogoin->loadbar')->sw / 100 * (int)str_ireplace("%","",stristr(c('fmLogoin->label5')->caption, ' ') );
    $myProperties = new myProperties;

    c('fmNewProject->startup')->checked = (bool)myOptions::get('newProjectDialog', 'startup', true);
	myOptions::getXYWH('fmMain', $fmMain, ['x' => 0, 'y' => 0, 'w' => 800, 'h' => 800]); 
    $fmMain->windowState = (int)myOptions::get('fmMain', 's', 'wsMaximized');
	//c('fmLogoin->label5')->caption = 'Initializing... 65%';
	//c('fmLogoin->loadbar')->w = c('fmLogoin->loadbar')->sw / 100 * (int)str_ireplace("%","",stristr(c('fmLogoin->label5')->caption, ' ') );
	c('fmPHPEditor',1)->position = poDesigned;
	myOptions::getXYWH('fmPHPEditor', c('fmPHPEditor',1), ['x'=>0,'y'=>0,'w'=>719,'h'=>563]);
	c('fmPHPEditor',1)->windowState = (int)myOptions::get('fmPHPEditor', 's', 'wsNormal');
    //c('fmLogoin->label5')->caption = 'Initializing... 78%';
	//c('fmLogoin->loadbar')->w = c('fmLogoin->loadbar')->sw / 100 * (int)str_ireplace("%","",stristr(c('fmLogoin->label5')->caption, ' ') );
    $fmMain->caption = 'Devel Studio KE'. DV_YEAR;
    
    $fmMain->popupMenu = c('fmMain->editorPopup');
    $fmEdit->popupMenu = c('fmMain->editorPopup');
    $_sc->popupMenu    = c('fmMain->editorPopup');

    global $inspectList;
    $inspectList->popupMenu    = c('fmMain->editorPopup');
    $GLOBALS['_sc']     =& $_sc;
    $GLOBALS['myProperties'] =& $myProperties;
    $GLOBALS['myEvents'] = new myEvents;
   	//c('fmLogoin->label5')->caption = 'Initializing... 80%';
	//c('fmLogoin->loadbar')->w = c('fmLogoin->loadbar')->sw / 100 * (int)str_ireplace("%","",stristr(c('fmLogoin->label5')->caption, ' ') );
    c('fmPropsAndEvents->btn_addEvent')->onClick = 'myEvents::clickAddEvent';
	fmLogoIn::Progress(2, "Inspector Loaded");
    myComplete::init();
	
	setTimeout(5000, 'myBackup::updateSettings()');
}