<?


class master_scriptsMaster {
    
    static function open(){
        
        $project = evalProject::open(dirname(__FILE__).'/scriptsMaster.dvs');
        $project->showModal();
    }
}
$file = file_exists(DOC_ROOT . 'images/btns/' . myOptions::get('prefs','studio_theme', 'light') . '/icon_scriptsMaster.bmp')? DOC_ROOT . 'images/btns/' . myOptions::get('prefs','studio_theme', 'light') . '/icon_scriptsMaster.bmp': dirname(__FILE__).'/icon.bmp'; //#ADDOPT;
// добавляем пункт меню
c('fmMain->itProject')->insertAfter( c('fmMain->it_buildproject'),
            menuItem(t('Scripts of project'), false, 'itScriptsMaster','master_scriptsMaster::open',
                     false, $file)
            );