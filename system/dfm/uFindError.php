<?


class ev_btn_showeditor {
    
    static function onClick($self){
        
        c('fmPHPEditor')->formStyle = fsNormal;
        myEvents::editorShow(0,0,0,0);
        c('fmPHPEditor')->formStyle = fsStayOnTop;
    }
}