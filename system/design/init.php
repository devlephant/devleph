<?
global $SCREEN, $fmEdit, $fmMain;

if (!EMULATE_DVS_EXE)
{  
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
    $myProperties = new myProperties;
	$myBehaviours = new myBehaviours;

    c('fmNewProject->startup')->checked = (bool)myOptions::get('newProjectDialog', 'startup', true);
	myOptions::getXYWH('fmMain', $fmMain, ['x' => 0, 'y' => 0, 'w' => 800, 'h' => 800]); 
    $fmMain->windowState = myOptions::get('fmMain', 's', wsMaximized);
	c('fmPHPEditor',1)->position = poDesigned;
	myOptions::getXYWH('fmPHPEditor', c('fmPHPEditor',1), ['x'=>0,'y'=>0,'w'=>719,'h'=>563]);
	c('fmPHPEditor',1)->windowState = myOptions::get('fmPHPEditor', 's', wsNormal);
    $fmMain->caption = 'Dev-S'. DV_YEAR;
    
    $fmMain->popupMenu = c('fmMain->editorPopup');
    $fmEdit->popupMenu = c('fmMain->editorPopup');
    $_sc->popupMenu    = c('fmMain->editorPopup');

    global $inspectList;
    $inspectList->popupMenu    = c('fmMain->editorPopup');
    $GLOBALS['_sc']     =& $_sc;
    $GLOBALS['myProperties'] =& $myProperties;
	$GLOBALS['myBehaviours'] =& $myBehaviours;
    $GLOBALS['myEvents'] = new myEvents;
    c('fmPropsAndEvents->btn_addEvent')->onClick = 'myEvents::clickAddEvent';
	fmLogoIn::Progress(2, "Inspector Loaded");
    myComplete::init();
	
	setTimeout(5000, 'myBackup::updateSettings()');
}