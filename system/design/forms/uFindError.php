<?


class ev_btn_showeditor {
    
    static function onClick($self){
        
        DevS\cache::c('fmPHPEditor')->formStyle = fsNormal;
        myEvents::editorShow(0,0,0,0);
        DevS\cache::c('fmPHPEditor')->formStyle = fsStayOnTop;
    }
}