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
    $_sc->popupMenu= DevS\cache::c('fmMain->editorPopup');
    $_sc->onStartSizeMove = 'myDesign::startSizeMove';
    $_sc->OnDuringSizeMove = 'myDesign::duringSizeMove';
    $myProperties = new myProperties;

    DevS\cache::c('fmNewProject->startup')->checked = (bool)myOptions::get('newProjectDialog', 'startup', true);
	myOptions::getXYWH('fmMain', $fmMain, ['x' => 0, 'y' => 0, 'w' => 800, 'h' => 800]); 
    $fmMain->windowState = myOptions::get('fmMain', 's', wsMaximized);
	DevS\cache::c('fmPHPEditor')->position = poDesigned;
	myOptions::getXYWH('fmPHPEditor', DevS\cache::c('fmPHPEditor'), ['x'=>0,'y'=>0,'w'=>719,'h'=>563]);
	DevS\cache::c('fmPHPEditor')->windowState = myOptions::get('fmPHPEditor', 's', wsNormal);
    $fmMain->caption = 'Dev-S'. DV_YEAR;
    
    $fmMain->popupMenu = DevS\cache::c('fmMain->editorPopup');
    $fmEdit->popupMenu = DevS\cache::c('fmMain->editorPopup');
    $_sc->popupMenu    = DevS\cache::c('fmMain->editorPopup');

    global $inspectList;
    $inspectList->popupMenu    = DevS\cache::c('fmMain->editorPopup');
    $GLOBALS['_sc']     =& $_sc;
    $GLOBALS['myProperties'] =& $myProperties;
    $GLOBALS['myEvents'] = new myEvents;
    DevS\cache::c('fmPropsAndEvents->btn_addEvent')->onClick = 'myEvents::clickAddEvent';
	fmLogoIn::Progress(2, "Inspector Loaded");
    myComplete::init();
	
	setTimeout(5000, 'myBackup::updateSettings()');
}