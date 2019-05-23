<?
global $SCREEN, $fmEdit, $fmComponents, $fmMain, $fmObjInspect;

if (!EMULATE_DVS_EXE){  
        c('fmLogoin->label5')->caption = 'Initializing... 5%';
		    c('fmLogoin->label5')->show();
$fmComponents->caption = t('components');

$aw = getSystemMetrics(SM_CXFULLSCREEN);
$ah = getSystemMetrics(SM_CYFULLSCREEN);

$cfg_array = array(
    'main' => array (
        'gridSize' => 8,
        'BtnColor' => clBlue,
		'DisabledBtnColor' => clGray,
        'showGrid' => false,
        'lastVer'  => '',
    ),
    
    'fmMain' => array (
        'x' => 0,
        'y' => 0,
        'w' => 800,
        'h' => 800,
        'wS' => 'wsMaximized',
    ),

    'fmPHPEditor' => array ('x'=>false,'y'=>0,'w'=>719,'h'=>563,'panelH'=>0,'wS'=>'wsNormal'),
    
    'newProjectDialog' => array(
        'startup' => true,
    ),
);


$dsg_cfg = new TConfigIni($cfg_array);
$dsg_cfg->loadFromFile(DS_USERDIR .'config.ini');
myVars::set($dsg_cfg, 'dsg_cfg');

    require 'design/dialogs.php';
}


require 'design/components.php';


if (!EMULATE_DVS_EXE){  
    c('fmLogoin->label5')->caption = 'Initializing... 15%';
    require 'design/events.php';    


    $GLOBALS['APPLICATION']->processMessages();    

    $_sc = new TSizeCtrl($fmEdit);
    $_sc->gridSize = $dsg_cfg->main->gridSize;
	$_sc->MovePanelCanvas->brush->color = (int)$dsg_cfg->main->SizerInnerColor;
	$_sc->MovePanelCanvas->pen->color = (int)$dsg_cfg->main->SizerOuterColor;
	$_sc->MovePanelCanvas->pen->style = (int)$dsg_cfg->main->SizerPenStyle;
    $_sc->BtnColor = (int)$dsg_cfg->main->BtnColor;
	$_sc->DisabledBtnColor = (int)$dsg_cfg->main->DisabledBtnColor;
	
    $_sc->showGrid = (int)$dsg_cfg->main->showGrid;
    $_sc->enable   = true;
    $_sc->popupMenu= c('fmMain->editorPopup');
    $_sc->onStartSizeMove = 'myDesign::startSizeMove';
    $_sc->OnDuringSizeMove = 'myDesign::duringSizeMove';
	c('fmLogoin->label5')->caption = 'Initializing... 35%';
    $myProperties = new myProperties;

    c('fmNewProject->startup')->checked = (int)$dsg_cfg->newProjectDialog->startup;

    $fmMain->left = $dsg_cfg->fmMain->x;
    $fmMain->top  = $dsg_cfg->fmMain->y;
    $fmMain->width= $dsg_cfg->fmMain->w;
    $fmMain->height=$dsg_cfg->fmMain->h;
    $fmMain->windowState = $dsg_cfg->fmMain->wS;
	c('fmLogoin->label5')->caption = 'Initializing... 65%';
    if ($dsg_cfg->fmPHPEditor->x){
        
        c('fmPHPEditor',1)->position = poDesigned;
        c('fmPHPEditor',1)->x = $dsg_cfg->fmPHPEditor->x;
        c('fmPHPEditor',1)->y = $dsg_cfg->fmPHPEditor->y;
        c('fmPHPEditor',1)->w = $dsg_cfg->fmPHPEditor->w;
        c('fmPHPEditor',1)->h = $dsg_cfg->fmPHPEditor->h;
        c('fmPHPEditor',1)->windowState = $dsg_cfg->fmPHPEditor->wS;
    }
    c('fmLogoin->label5')->caption = 'Initializing... 78%';
    $fmMain->caption = 'Devel Studio KE'. DV_YEAR;
    
    $fmMain->popupMenu = c('fmMain->editorPopup');
    $fmEdit->popupMenu = c('fmMain->editorPopup');
    $_sc->popupMenu    = c('fmMain->editorPopup');

    global $inspectList;
    $inspectList->popupMenu    = c('fmMain->editorPopup');
    $GLOBALS['dsg_cfg'] =& $dsg_cfg;
    $GLOBALS['_sc']     =& $_sc;
    $GLOBALS['myProperties'] =& $myProperties;
    $GLOBALS['myEvents'] = new myEvents;
   	c('fmLogoin->label5')->caption = 'Initializing... 80%';
    c('fmPropsAndEvents->btn_addEvent')->onClick = 'myEvents::clickAddEvent';
    myComplete::init();
	
	setTimeout(5000, 'myBackup::updateSettings()');
}