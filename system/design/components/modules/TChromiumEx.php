<?

class TChromiumEx extends TScrollBox {
    
    public $class_name_ex = __CLASS__;
    #url;
    #html;
    #silent
    
    public function initLabel(){
        
        $label = new TLabel($this);
        $label->font->style = 'fsBold';
		$label->font->color = clLtGray;
        $label->caption = t('Chromium Browser');
        $label->x = 0;
        $label->y = 0;
        $label->autoSize = false;
        $label->w = $this->w;
        $label->h = $this->h;
        $label->anchors = 'akLeft, akTop, akRight, akBottom';
        $label->alignment= taCenter;
        $label->layout   =  tlCenter;
        $label->parent = $this;
    }
    
    public function __construct($onwer=nil,$init=true,$self=nil){
        parent::__construct($onwer, $init, $self);
        
	/*if ( !$GLOBALS['APP_DESIGN_MODE'] ){
	    message_error('Use TChromium Class!');
	    return;
	}*/
	
        if ($init){
            $this->borderStyle = bsNone;
            $this->bevelKind   = bkFlat;
            $this->parentColor = false;
            $this->color       = clWhite;
            $this->autoScroll  = false;
            $this->initLabel();
        }
    }
    
    public function __loadDesign(){
        $this->initLabel();
    }
    
    public function __initComponentInfo(){
        
        $this->visible = false;
	$self = $this->self;
	TChromiumEx::__initXWB($self);
    }
    
    static function __initXWB($self){
	
	$self = c($self);
	$form = _c($self->owner);
	
        $md = new TChromium($form);
        $md->parent = $self->parent;
		
        $md->w = $self->w;
        $md->h = $self->h;
        
        $md->x = $self->x;
        $md->y = $self->y;
        $md->align = $self->align;
        $md->anchors = $self->anchors;
       
        $tmp = $self->name;
        $self->name = '';
        $self->free();
        $md->name = $tmp;
	
        //eventEngine::updateIndex($md);
    }
}