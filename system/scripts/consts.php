<?
      
    myVars::set( c('fmMain->MainImages16'), '_IMAGES16' );
    myVars::set( c('fmMain->MainImages24'), '_IMAGES24' ); 
    myVars::set( c('fmMain->MainImages32'), '_IMAGES32' );
    
    /* menus */
	
    myVars::set( c('fmMain->editorPopup'), 'editorPopup' );
	myVars::set( c('fmMain->editorPopup'), 'editorPopup' );
    myVars::set( c('fmMain->formsPopur'), 'formsPopur');
    myVars::set( c('fmMain->MainMenu'), '_MENU' );
   
    global $_MENU; $_MENU->images = c('fmMain->MainImages16');
    
    
	
    myVars::set( c('fmMain->formsPopur'), 'formsPopur');
    
    myVars::set( c('fmPHPEditor'), 'fmPHPEditor');
    myVars::set( c('fmFormList'), 'fmFormList');

    myVars::set( c('fmObjectInspector->list'), 'inspectList');
    global $inspectList, $_IMAGES24;
    $inspectList->images = $_IMAGES24;
    c('fmEasySelectDialog->objs_list')->images   = $_IMAGES24;
    c('fmEasySelectDialog->lst_objects')->images = $_IMAGES24;
    
    $projectFile = DS_USERDIR . 'Project/Project.msppr';

    if (file_exists(DS_USERDIR . 'last.lst')){
        $lastFiles = unserialize(file_get_contents(DS_USERDIR . 'last.lst'));
    } else
        $lastFiles = array(DS_USERDIR . 'Project/Project.msppr');
    
    
    if (! file_exists($projectFile) ){
        if (file_exists(dirname($projectFile).'/'.basenameNoExt($projectFile).'.inf')){
            unlink(dirname($projectFile).'/'.basenameNoExt($projectFile).'.inf');
        }
        myUtils::createForm('Form1');
    }
        
    myVars::set(0, '_designSel');
    if(isset($_FORMS)) myVars::set($_FORMS, '_FORMS');
    myVars::set($projectFile, 'projectFile');
    myVars::set(0, 'formSelected');
    
        
    myProject::initLastFiles();
    myMasters::generate();
    
    myVars::set($lastFiles, 'lastFiles');