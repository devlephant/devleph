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
