<?


class TLocalization extends __TNoVisual {
    
    
    
    public function __construct($onwer=nil,$init=true,$self=nil){
        parent::__construct($onwer, $init, $self);
                
        if ($init){
            
        }
    }
    
    public function __initComponentInfo(){
        
        $this->hide();
        
        if ($this->aenable)
            $GLOBALS['___startFunctions'][] = 'TLocalization::initLang('.$this->self.')';
    }
    
    public function set_enable($v){
        if ($v && !$GLOBALS['APP_DESIGN_MODE']){
            $this->init();
            $this->locale();
        }
        
        $this->aenable = $v;
    }
    
    static function initLang($self){
        
        c($self)->enable = c($self)->aenable;
    }
    
    public function get_enable(){
        
        return $this->aenable;
    }
    
    public function init(){
        
        $dir  = $this->langDir;
        $lang = $this->lang;

        Localization::incXml($dir, $lang);
    }
    
    public function locale(){
        
        $forms = explode(_BR_, $this->localeForms);
        
        if ($this->localeAll){
            
            Localization::localApplication();
            
        } elseif ($forms){
            array_map('trim',$forms);
            
            foreach ($forms as $form){
            
            if ($form)
                $x_form = c($form);
                if ($x_form)
                    Localization::localForm( $x_form );
                else
                    error_msg("Form '$form' is not loading...");
            }
            
        }
    }
}

?>