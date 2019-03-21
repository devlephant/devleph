<?
$act_panel = c('fmMain->action_panel');

class design_Reader{
    
    public $controls = [];
    
    public function loadConfig($dir){
        $dir = replaceSl($dir);
        
        $arr = file(DOC_ROOT . $dir.basename($dir).'.cfg');
        
        foreach ($arr as $value){
            $tmp = explode(':',$value);
            
            if (count($tmp)>1){
                $this->controls[] = array(
                                    'type'=>trim($tmp[0]),
                                    'name'=>trim($tmp[1])
                                    );
            } else
                $this->controls[] = array('type'=>trim($tmp[0]));
        }
    }
}

class design_Act_Panel{
    
    public $ACT_DIR = '/design/data/act_panel/';
    public $BEGIN_LEFT = 4;
    public $BTN_WIDTH = 25;
    public $BTN_HEIGHT = 25;
    public $BTN_INTERVAL = 3;
    
    public $BTN_TOP;
    
    public $count_btn = 0;
    public $panel_h;
    public $panel_w;
    
    public function __construct(){
        global $act_panel;
        $this->panel_h = $act_panel->height;
        $this->panel_w = $act_panel->width;
        
        $this->BTN_TOP = round(($this->panel_h / 2) - ($this->BTN_HEIGHT / 2));
    }
    
    protected function getNextLeft(){
        $result = $this->BEGIN_LEFT;
        
        $result += $this->count_btn * $this->BTN_WIDTH;
        $result += $this->count_btn * $this->BTN_INTERVAL;
        
        return $result;
    }
    
    public function createMyButton($name){
        global $act_panel;
        $btn = new TSpeedButton($act_panel);
        $btn->name = $name;
        $btn->parent = $act_panel;
        $btn->width  = $this->BTN_WIDTH;
        $btn->height = $this->BTN_HEIGHT;
        $btn->top    = $this->BTN_TOP;
        $btn->left   = $this->getNextLeft();
        $btn->flat   = true;
        
        $btn->picture->loadFromFile(progDir . replaceSr($this->ACT_DIR).$name.'.bmp');
        
        $btn->onClick = 'act_Panel_Ev::'.$name;
        
        $this->count_btn += 1;
    }
    
    public function createMyPanel(){
        global $act_panel;
        $pn = new TPanel($act_panel);
        $pn->parent = $act_panel;
        $pn->width  = round($this->BTN_WIDTH / 2);
        $pn->height = $this->BTN_HEIGHT;
        $pn->top    = $this->BTN_TOP;
        $pn->left   = $this->getNextLeft() + round($this->BTN_WIDTH / 4);
        
        $this->count_btn += 1;
    }
    
    public function createAllPanel(){
        
        require DOC_ROOT . $this->ACT_DIR . basename($this->ACT_DIR) . '.php';
        
        $cfg = new design_Reader();
        $cfg->loadConfig($this->ACT_DIR);
        
        foreach ($cfg->controls as $value){
            
            switch ($value['type']){
                case 'btn': $this->createMyButton($value['name']); break;
                case 'pn': $this->createMyPanel(); break;
            }
        }
    }
}

$design_AP = new design_Act_Panel;
$design_AP->createAllPanel();