<?

Class Tw8Toggle Extends TScrollBox {
	
	private static $init_self;
	private static $notified = false;
	
	public function __initComponentInfo()
	{
			if( !empty( Tw8Toggle::$init_self ) )
				if( in_array($this->self, Tw8Toggle::$init_self) ) return;
				Tw8Toggle::$init_self[] = $this->self;
		
		$border = new TShape($this);
		$border->parent = $this;
		$border->align = alClient;
		$border->brushColor	= $this->brushColor;
		$border->penColor	= $this->penColor;
		
		$Thumb = new TShape($this);
		$Thumb->parent = $this;
		$Thumb->align = alNone;
		$this->_toDelete = [$border->self , $Thumb->self];

		$Thumb->y = 0;
		if ($this->switched)
		{
			$Thumb->x = $this->w / 2;
			$Thumb->brush->Color = $this->enabledColor;
		} else {
			$Thumb->x = 0;
			$Thumb->brush->Color = $this->disabledColor;
		}
		$Thumb->w = $this->w / 2;
		$Thumb->h = $this->h;
		
		$Thumb->pen->Color = 15329769;
		$box = $this;
		event_set(
			$this->self,
			'onResize',
			function(...$__arfs) use($box, $Thumb)
			{
				$Thumb->x = ($box->switched)? $box->w / 2: 0;
				$Thumb->w = $box->w / 2;
				$Thumb->h = $box->h;
			}
		);
	if( !$GLOBALS['APP_DESIGN_MODE'] )
	{
		/// OnMouseUp HOOK \\\
		$f = 	function($self) use($box)
		{		
			$box->switched = !$box->switched;
		};
		event_set(
			$this->self, 
			'onMouseUp', 
			$f
		);
		event_set(
			$border->self, 
			'onMouseUp', 
			$f
		);
		event_set(
			$Thumb->self,
			'onMouseUp',
			$f
		);
	}
		
		if ($this->smoothness){
			if (!class_exists("resize")){
				$this->smoothness = false;
				alert("For smooth switching \"Resizer\" class is required.");
			}
		}
		
	}
	Private function getColors($switched)
	{
		//start color
		return (new TColor(($switched? $this->enabledColor: $this->disabledColor)))->gradient(
				//end color
				(($switched? $this->disabledColor: $this->enabledColor)),
				//gradient steps(levels)
				5
			);
	}
	Public Function set_switched($v)
	{
		$this->_switched = $v;
		if ( !Tw8Toggle::$notified && $this->smoothness && !class_exists("resize") )
		{
			$this->smoothness = false;
			Tw8Toggle::$notified = true;
			alert("Для плавного переключения необходимо подключить класс Resizer.");	
		}
		$Thumb = c($this->_toDelete[1]);
		$p = $v? $this->w/2: 0;
		$c = $this->_colours[(int)$v];
						if( $this->smoothness  )
						{
							resize::resize_object($Thumb, 
							$this->changeColorAtEnd? ["x"=> $p, "func"=>function($self)use($Thumb,$c){$Thumb->brush->color = $c;}]:["x" => $p]);
						} else
							$Thumb->x = $p;
						if(!$this->changeColorAtEnd) $Thumb->brush->Color = $c;
	}
	Public Function set_enabledColor($v)
	{
		$this->_colours = [$this->_colours[0], $v];
		if( $this->_switched )
			c($this->_toDelete[1])->brush->color = $v;
	}
	Public Function set_disabledColor($v)
	{
		$this->_colours = [$v, $this->_colours[1]];
		if( !$this->_switched )
			c($this->_toDelete[1])->brush->color = $v;
	}
	Public Function get_enabledColor(){ return $this->_colours[1]; }
	Public Function get_disabledColor(){ return $this->_colours[0]; }
	Public Function get_switched()
	{
		return $this->_switched;
	}
	Public Function __construct($owner=nil,$init=true,$self=nil)
	{
        parent::__construct($owner,$init,$self);  
		
		IF($init)
		{
			$this->_colours = [3951847, 7457838];
			$this->brushColor = 16777215;
			$this->penColor = 15329769;
			$this->bevelInner = bvNone;
			$this->bevelOuter = bvNone;
			$this->borderStyle = bsNone;
			$this->autosize = false;
			$this->autoscroll = false;
			$this->_switched = false;
			$this->changeColorAtEnd = false;
		}
		
		$this->__initComponentInfo();
	}
	function free()
	{
		if( is_array(Tw8Toggle::$init_self) )
		if( array_search($this->self, Tw8Toggle::$init_self) )
			unset( Tw8Toggle::$init_self[array_search($this->self, Tw8Toggle::$init_self)] );
		
		if( is_array($this->_toDelete) )
			foreach($this->_toDelete as $chc)
				gui_destroy($chc);
				
		if (class_exists('animate'))
			animate::objectFree($this->self);
		
		gui_destroy($this->self);
    }
	public static function __clearInits()
	{
		Tw8Toggle::$init_self = [];
	}
}

class ozSwitch extends Tw8Toggle {}
dsAPI::addProjectChangeCallback(function($s){ Tw8Toggle::__clearInits(); });