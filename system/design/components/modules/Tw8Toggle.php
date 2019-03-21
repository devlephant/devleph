<?

class Tw8Toggle extends TShape {
	
	private static $init_self;
	
	public function __initComponentInfo(){
		
		if( !empty( self::$init_self ) )
			if( in_array($this->self, self::$init_self) ) return;
		
		self::$init_self[] = $this->self;
		$Thumb = new TShape($this->parent);
		$Thumb->parent = $this->parent;
		$Thumb->y = $this->y;
		if ($this->switched)
		{
			$Thumb->x = $this->x + $this->w / 2;
			$Thumb->brush->Color = $this->enabledColor;
		} else {
			$Thumb->x = $this->x;
			$Thumb->brush->Color = $this->disabledColor;
		}
		$Thumb->w = $this->w / 2;
		$Thumb->h = $this->h;
		
		$Thumb->pen->Color = 15329769;
		$border = &$this;
	if( !$GLOBALS['APP_DESIGN_MODE'] )
	{
		/// OnMouseUp HOOK \\\
		$f = 	function($self) use($border, $Thumb)
		{		
			if ($border->smoothness){
				if (!class_exists("resize")){
					$border->smoothness = false;
					alert("Для плавного переключения необходимо подключить класс Resizer.");
					
					if ($border->switched){
						$Thumb->x = $border->x;
						$Thumb->brush->Color = $border->disabledColor;
						$border->switched = false;
					} else {
						$Thumb->x = $border->x + $Thumb->w;
						$Thumb->brush->Color = $border->enabledColor;
						$border->switched = true;
					}
				} else {
					if ($border->switched){
						resize::resize_object($Thumb, array("x" => $border->x));
						$Thumb->brush->Color = $border->disabledColor;
						$border->switched = false;
					} else {
						resize::resize_object($Thumb, array("x" => $border->x + $Thumb->w));
						$Thumb->brush->Color = $border->enabledColor;
						$border->switched = true;
					}
				}
			
			} else {
				if ($border->switched){
					$Thumb->x = $border->x;
					$Thumb->brush->Color = $border->disabledColor;
					$border->switched = false;
				} else {
					$Thumb->x = $border->x + $Thumb->w;
					$Thumb->brush->Color = $border->enabledColor;
					$border->switched = true;
				}
				
			}
			
		};
		
		event_set(
			$this->self, 
			'onMouseUp', 
			$f
		);
		event_set(
			$Thumb->self,
			'onMouseUp',
			$f
		);
	}
		event_set(
			$this->self,
			'onResize',
			function($self) use($border, $Thumb)
			{
				gui_message('something');
				$Thumb->y = $border->y;
				$Thumb->x = ($border->switched)? $border->x + $border->w / 2: $border->x;
				$Thumb->w = $border->w / 2;
				$Thumb->h = $border->h;
			}
		);
		
		if ($this->smoothness){
			if (!class_exists("resize")){
				$this->smoothness = false;
				alert("Для плавного переключения необходимо подключить класс Resizer.");
			}
		}
		
	}
	
	public function __construct($owner = nil, $init = true, $self = nil){
		parent::__construct($owner, $init, $self);
		
		if ($init){
			$this->brushColor = 16777215;
			$this->penColor = 15329769;
			$this->enabledColor = 7457838;
			$this->disabledColor = 3951847;
		}
		$this->__initComponentInfo();
	}
	public function free()
	{
		gui_message('freed');
	}
}

class ozSwitch extends Tw8Toggle {}