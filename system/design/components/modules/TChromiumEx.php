<?
class TCefWindowParent extends TControl{}
class TChromiumEx extends TCefWindowParent {
    private static $init_self;
    
    #url;
    #html;
    #silent
	public function get_enabled(){return true;}
	public function set_enabled($v){return true;}
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
	
        if ($init)
		{
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
		if(!is_array(self::$init_self) || !in_array($this->self, self::$init_self))
		{
			self::$init_self[] = $this->self;
			TChromiumEx::__initXWB($this);
		}
    }
    static function __initXWB($actual)
	{
		$md = new TChromium($actual->parent);
		$md->parent = $actual->parent;
        $md->w = $actual->w;
        $md->h = $actual->h;    
        $md->x = $actual->x;
		$md->y = $actual->y;
		$md->align = $actual->align;
		$md->anchors = $actual->anchors;
		$tmp = $actual->name;
		$actual->name = $tmp.'_windowparent';
		$md->name = $tmp;
		$md = $md->self;
		$actual = $actual->self;
		$t = new TTimer();
		$t->Interval = 300;
		$t->OnTimer = Function($self) use($md, $actual)
		{
			if(chromium_acce($md, $actual))
			{
				_c($self)->Repeat = false;
				_c($self)->Enabled = false;
				TChromiumEx::clrtimer($self);
			}
		};
		
		$t->Enabled = $t->Repeat = true;
	}
	static function clrtimer($timer)
	{
		gui_safedestroy( $timer );
	}
	public function free()
	{
		if( is_array(self::$init_self) )
			unset( self::$init_self[ array_search($this->self, self::$init_self) ] );
	
	if( gui_isset($this->self) )
		gui_destroy($this->self);
	}
}