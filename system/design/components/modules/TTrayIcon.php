<?
global $_c;
$_c->trfNone	= 0;
$_c->trfInfo	= 1;
$_c->trfWarning	= 2;
$_c->trfError	= 3;
$_c->trfLastIcon= 4;
$_c->trfTrayIcon= 5;

class TTrayIcon extends __TNoVisual {
    
    
    public $picture;
    
    public function __construct($onwer=nil,$self=nil){
        parent::__construct($onwer,$self);
        
        if ($self==nil){
            
            $this->aiconFile = 'tray.ico';
            $this->aleftPopup = false;
            $this->aminimizeToTray = false;
            $this->ashowHint = true;
            $this->aiconVisible = true;
            $this->ahint = '';
            $this->timeout = 10;
            $this->flag = 1;
            $this->title = $GLOBALS['APPLICATION']->title;
        }        
    }
    
      
    public function __initComponentInfo(){
        
        parent::__initComponentInfo();
        $tray = new TCoolTrayIcon(_c($this->owner));
        
        $tray->iconFile = $this->aiconFile;
        $tray->iconVisible = $this->aiconVisible;
        $tray->showHint = $this->ashowHint;
        $tray->hint = $this->ahint;
        $tray->minimizeToTray = $this->aminimizeToTray;
        $tray->leftPopup = $this->aleftPopup;
        $tray->enabled = $this->aenabled;
        $tray->title = $this->title;
        $tray->text  = $this->text;
        $tray->flag  = $this->flag;
        $tray->timeout = $this->timeout;
        
        $tmp = $this->name;
        $this->name = '';
        $tray->name = $tmp;
    }
}

?>