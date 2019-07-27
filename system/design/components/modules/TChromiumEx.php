<?
class TCefWindowParent extends TControl{}
class TChromiumEx extends TCefWindowParent {
    private static $init_self;
    public $__events = [];

	function set_onchromiumlibload($v)
	{
		pre($v);
		$this->__events["onchromiumlibload"] = $v;
	}
	function set_onbeforebrowse($v)
	{
		pre($v);
		$this->__events["onbeforebrowse"] = $v;
	}
	function set_onbeforepopup($v)
	{
		pre(['EventSet',$v]);
		$this->__events["onbeforepopup"] = $v;
	}
	function set_onbeforemenu($v)
	{
		pre(['EventSet',$v]);
		$this->__events["onbeforemenu"] = $v;
	}
	function set_onauthcredentials($v)
	{
		pre(['EventSet',$v]);
		$this->__events["onauthcredentials"] = $v;
	}
	function set_ongetdownloadhandler($v)
	{
		pre(['EventSet',$v]);
		$this->__events["ongetdownloadhandler"] = $v;
	}
	function set_onconsolemessage($v)
	{
		pre(['EventSet',$v]);
		$this->__events["onconsolemessage"] = $v;
	}
	function set_onloadstart($v)
	{
		pre(['EventSet',$v]);
		$this->__events["onloadstart"] = $v;
	}
	function set_onloadend($v)
	{
		pre(['EventSet',$v]);
		$this->__events["onloadend"] = $v;
	}
	function set_onloaderror($v)
	{
		$this->__events["onloaderror"] = $v;
	}
	function set_onstatusmessage($v)
	{
		$this->__events["onstatusmessage"] = $v;
	}
	function set_onaddresschange($v)
	{
		$this->__events["onaddresschange"] = $v;
	}
	function set_ontitlechange($v)
	{
		$this->__events["ontitlechange"] = $v;
	}
	function set_ontooltip($v)
	{
		$this->__events["ontooltip"] = $v;
	}
	
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
        
		if ( !$GLOBALS['APP_DESIGN_MODE'] )
			$this->__initComponentInfo();
		
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
		$title = $GLOBALS['APPLICATION']->title;
		$t = new TTimer();
		$t->Interval = 300;
		$t->OnTimer = Function($self) use($md, $actual, $title)
		{
			if(chromium_acce($md, $actual->self, $title))
			{
				_c($self)->Repeat = false;
				_c($self)->Enabled = false;
				TChromiumEx::clrtimer($actual,$md, $self);
			}
		};
		
		$t->Enabled = $t->Repeat = true;
	}
	public static function clrtimer($self, $newSelf, $timer)
	{
		
		if( isset($self->__events['onchromiumlibload']) )
		{
			call_user_func_array($self->__events['onchromiumlibload'], $newSelf);
			unset($self->__events['onchromiumlibload']);
		}
		if(!empty($self->__events))
			foreach($self->__events as $eventName=>$event)
				event_set($newSelf, $eventName, $event);
		setTimeout(1, "gui_safedestroy( $timer )");
	}
	public function free()
	{
		if( is_array(self::$init_self) )
			unset( self::$init_self[ array_search($this->self, self::$init_self) ] );
	
	if( gui_isset($this->self) )
		gui_destroy($this->self);
	}
	public static function __clearInits()
	{
		self::$init_self = [];
	}
}
dsAPI::addProjectChangeCallback(function($s){ TChromiumEx::__clearInits(); });