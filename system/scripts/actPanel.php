<?

ev_fmMain_btn_openProject::s('myProject::openFromFileDialog');
ev_fmMain_btn_newProject::s( 'myProject::newProjectDialog' );
ev_fmMain_btn_saveProject::s( 'myProject::saveAsDVSDialog' );
ev_fmMain_btn_stop::s( 'myUtils::stop' );
ev_fmMain_btn_run::s( 'myUtils::run' );
ev_fmMain_btn_rundebug::s( 'myUtils::runDebug' );
ev_fmMain_btn_newForm::s( 'myUtils::newForm' );
ev_fmMain_btn_delForm::s( 'myUtils::deleteForm' );

c('fmMain->fp_delete')->onClick = 'myUtils::deleteForm';
c('fmMain->hd_deleteform')->onClick = 'myUtils::deleteForm';
c('fmMain->hd_deleteform2')->onClick = 'myUtils::deleteForm';

c('fmMain->fp_new')->onClick    = 'myUtils::newForm';
c('fmMain->hd_newform')->onClick = 'myUtils::newForm';

c('fmMain->fp_rename')->onClick = 'myUtils::renameForm';
c('fmMain->hd_formrename')->onClick = 'myUtils::renameForm';

c('fmMain->fp_clone')->onClick  = 'myUtils::cloneForm';

c('fmMain->fp_left')->onClick   = 'myUtils::leftForm';
c('fmMain->hd_leftform')->onClick = 'myUtils::leftForm';

c('fmMain->fp_right')->onClick  = 'myUtils::rightForm';
c('fmMain->hd_rightform')->onClick = 'myUtils::rightForm';

c('fmMain->it_new_form')->onClick = 'myUtils::newForm';
c('fmMain->it_new_project')->onClick = 'myProject::newProjectDialog';
c('fmMain->it_open')->onClick= 'myProject::openFromFileDialog';
c('fmMain->it_save')->onClick= function($self){
	myUtils::saveForm();
	message_beep(66); 
};
c('fmMain->it_run')->onClick = 'myUtils::run';
c('fmMain->it_saveas')->onClick = 'myProject::saveAsDVSDialog';

c('fmMain->it_undo')->onClick = 'myHistory::undo';
c('fmMain->it_redo')->onClick = 'myHistory::redo';
c('fmMain->it_preference')->onClick = 'myOptions::Options';

c('fmMain->it_buildproject')->onClick = 'myOptions::BuildProgram';
ev_fmMain_btn_make::s( 'myOptions::BuildProgram' );
c('fmMain->it_projectoptions')->onClick = 'myOptions::ProjectOptions';
c('fmMain->it_projectmodules')->onClick = 'myOptions::PHPModules';
c('fmMain->it_stopprogram')->onClick = 'myUtils::stop';