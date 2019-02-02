<?

class act_Panel_Ev{
    
    static function btn_new($self){
        
    }
    
    static function btn_open($self){
        $dlg = new TOpenDialog;
        $dlg->filter = DLG_FILTER_PROJECT;
        if ($dlg->show()){
            
        }
    }
}