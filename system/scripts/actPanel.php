<?

ev_fmMain_btn_openProject::s('myProject::openFromFileDialog');
ev_fmMain_btn_newProject::s( 'myProject::newProjectDialog' );
ev_fmMain_btn_saveProject::s( 'myProject::saveAsDVSDialog' );
ev_fmMain_btn_stop::s( 'myUtils::stop' );
ev_fmMain_btn_run::s( 'myUtils::run' );
ev_fmMain_btn_rundebug::s( 'myUtils::runDebug' );
ev_fmMain_btn_newForm::s( 'myUtils::newForm' );
ev_fmMain_btn_delForm::s( 'myUtils::deleteForm' );

DevS\cache::c('fmMain->fp_delete')->onClick = 'myUtils::deleteForm';
DevS\cache::c('fmMain->hd_deleteform')->onClick = 'myUtils::deleteForm';
DevS\cache::c('fmMain->hd_deleteform2')->onClick = 'myUtils::deleteForm';

DevS\cache::c('fmMain->fp_new')->onClick    = 'myUtils::newForm';
DevS\cache::c('fmMain->hd_newform')->onClick = 'myUtils::newForm';

DevS\cache::c('fmMain->fp_rename')->onClick = 'myUtils::renameForm';
DevS\cache::c('fmMain->hd_formrename')->onClick = 'myUtils::renameForm';

DevS\cache::c('fmMain->fp_clone')->onClick  = 'myUtils::cloneForm';

DevS\cache::c('fmMain->fp_left')->onClick   = 'myUtils::leftForm';
DevS\cache::c('fmMain->hd_leftform')->onClick = 'myUtils::leftForm';

DevS\cache::c('fmMain->fp_right')->onClick  = 'myUtils::rightForm';
DevS\cache::c('fmMain->hd_rightform')->onClick = 'myUtils::rightForm';

DevS\cache::c('fmMain->it_new_form')->onClick = 'myUtils::newForm';
DevS\cache::c('fmMain->it_new_project')->onClick = 'myProject::newProjectDialog';
DevS\cache::c('fmMain->it_open')->onClick= 'myProject::openFromFileDialog';
DevS\cache::c('fmMain->it_save')->onClick= function($self){
	myUtils::saveForm();
	message_beep(66); 
};
DevS\cache::c('fmMain->it_run')->onClick = 'myUtils::run';
DevS\cache::c('fmMain->it_saveas')->onClick = 'myProject::saveAsDVSDialog';

DevS\cache::c('fmMain->it_undo')->onClick = 'myHistory::undo';
DevS\cache::c('fmMain->it_redo')->onClick = 'myHistory::redo';
DevS\cache::c('fmMain->it_preference')->onClick = 'myOptions::Options';

DevS\cache::c('fmMain->it_buildproject')->onClick = 'myOptions::BuildProgram';
ev_fmMain_btn_make::s( 'myOptions::BuildProgram' );
DevS\cache::c('fmMain->it_projectoptions')->onClick = 'myOptions::ProjectOptions';
DevS\cache::c('fmMain->it_projectmodules')->onClick = 'myOptions::PHPModules';
DevS\cache::c('fmMain->it_stopprogram')->onClick = 'myUtils::stop';