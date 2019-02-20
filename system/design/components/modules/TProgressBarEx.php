<?

//**************************************************//
//********************ProgressBarEx2.3**************//
//********************By Roman**********************//
//**************************************************//
//Current version  by L.-Andrew Zenin

class TProgressBarEx extends TScrollBox{

	
	private static $init_self;
	
   function __construct($owner=nil,$init=true,$self=nil){
    parent::__construct($owner,$init,$self);
	$this->_cup = true;
	$sl = true;
	if( !empty( TProgressBarEx::$init_self ) )
			if( in_array($this->self, TProgressBarEx::$init_self) ) $sl = false;
	
		if ($init){
			$this->ProgressColor = clGreen;//{$position}/{$max}
			$this->_caption = '{$position}%';
			$this->_stretch = $this->_transparent = $this->_solidmosaic = false;
			$this->_mosaic	= true;
			$this->max = 100;
			$this->_position = 0;
		}
		
		if( $sl )
		{
			TProgressBarEx::$init_self[] = $this->self;
			$this->_picture = new TImage();
			if(strlen(trim($this->adata))>0)
			{
				gui_ReadStr($this->_picture->self, $this->adata);
			}
			//$this->_picture->parent_object = $this->self;
			//$this->_picture->owner = $this->self;
			$this->setdsgn();
			$this->_cup = false;
			$this->set_position($this->_position);
		}else $this->_cup = false;
		
	}
	public function UpdateDes()
	{
		if( $this->_cup ) return;
		if( !is_object($this) ) return;
		if( !is_object($this->_image) ) {
			$this->setdsgn();
		}	elseif( !($this->_image instanceof TMImage) && !($this->_image instanceof TShape) ) {
			$this->setdsgn();
		}
		
	 $this->_label->font->name = $this->font->name;
	 $this->_label->font->color = $this->font->color;
	 $this->_label->font->style = $this->font->style;
	 $this->_label->font->size = $this->font->size;
	 $this->_label->font->pitch = $this->font->pitch;
	 $this->_label->font->quality = $this->font->quality;
	 $this->_image->h = $this->h + 1;
	 $this->_image->w = 0;
	 $this->_image->y = 0;
	 if($this->picture->isEmpty())
		 $this->_image->brushColor = $this->ProgressColor;
	 $this->position = $this->_position;
	}
	private function setdsgn(){
		if( !is_object($this) ) return;
		//$this->picture = new TPicture($this);
	  $this->borderStyle = bsNone;
	  $this->autoScroll = false;
	  $this->autosize = false;
	  $this->DoubleBuffered = true;
	  $this->ShowCaption = false;
	  //$this->caption = '';
	 if (!$this->picture->isEmpty()){ 
	 $i = new TMImage;
	 $i->parent = $this;
	 $this->_image = $i;
	 $this->_image->h = $this->h + 1;
	 $this->_image->w = 0;
	 $this->_image->y = 0;
	 $this->_image->autoSize = false;
	 $this->_image->mosaic = $this->_mosaic;
	 $this->_image->proportional = false;
	 $this->_image->transparent = $this->_transparent;
	 $this->_image->stretch = $this->_stretch;
	 }else{
	 $i = new TShape;
	 $i->parent = $this;
	 $this->_image = $i;
	 $this->_image->h = $this->h + 1;
	 $this->_image->w = 0;
	 $this->_image->x = 0;
	 $this->_image->y = 0;
     $this->_image->brushColor = $this->ProgressColor;
	 $this->_image->penStyle = psClear;
	 }
	 $l = new TLabel;
	 $l->parent = $this;
	 $this->_label = $l;
	 if (strlen(trim($this->_caption))>0){
     $this->_label->caption = TProgressBarEx::formatResult($this->_caption, $pr, $this->max);
	 } else $this->_label->caption = '';
	 $this->_label->align = alClient;
	 $this->_label->alignment = taCenter;
	 $this->_label->layout = tlCenter;
	 $this->_label->font->name = $this->font->name;
	 $this->_label->font->color = $this->font->color;
	 $this->_label->font->style = $this->font->style;
	 $this->_label->font->size = $this->font->size;
	 $this->_label->font->pitch = $this->font->pitch;
	 $this->_label->font->quality = $this->font->quality;
	 $this->_label->transparent = true;
	 }
    public function load_image( $file ){
		if( file_exists($file) )
			if( in_array(fileExt($file), array('png', 'jpg', 'jpeg', 'emf', 'wmf', 'tiff', 'tif', 'gif', 'ico', 'bmp', 'svg') ) ) {
				$this->_file = $file;
				return true;
			}
	  return false;
	}
    public function set_position($pos){
		if( $this->_cup ) return;
		$this->_image->h = gui_propGet($this->self, 'height') + 1;
		$this->repaint();
		$this->_label->repaint();
		$this->_image->repaint();
		if($pos<=$this->max)
			$this->_position = $pos;
	 $pr = floor($pos/($this->max/100));
	 $pr = ($pr > $this->max)? $this->max: $pr;
	 if (!$this->picture->isEmpty()){
	 $this->_image->picture->Assign( $this->picture );
	 }
		$this->_image->w =  ($this->_solidmosaic && $this->_image instanceof TMImage)? ((int)(($this->w*$pr/100) / $this->_image->picture->graphic->width))*$this->_image->picture->graphic->width:  $this->w*$pr/100;
	 if ($this->end == true){
	   if ($this->max == $pos){
	 $this->_image->w = 0;
	 }
	 }
	 if (strlen(trim($this->_caption))>0){
     $this->_label->caption = TProgressBarEx::formatResult($this->_caption, $pr, $this->max);
	 if ($this->max == $pos){
		if ($this->end)
		{
		$this->_label->caption = TProgressBarEx::formatResult($this->_caption, 0, $this->max);
		}
	 }
	 }else $this->_label->caption = '';
		$this->_image->h = gui_propGet($this->self, 'height') + 1;
		$this->repaint();
	 	$this->_label->repaint();
		$this->_image->repaint();
    }
	
	public function get_position()
	{
		return $this->_position;
	}
	
	public function set_w($v)
	{
		gui_propSet($this->self, 'width', $v);
			$this->set_position($this->_position);
			$this->UpdateDes();
	}
	
	public function get_w()
	{
		$this->set_position($this->_position);
		return gui_propGet($this->self, 'width');
	}
	
	public function set_h($v)
	{
		gui_propSet($this->self, 'height', $v);
		$this->set_position($this->_position);
		$this->UpdateDes();
	}
	
	public function get_h()
	{
		$this->set_position($this->_position);
		return gui_propGet($this->self, 'height');
	}
	
	public function free()
	{
		if( array_search($this->self, TProgressBarEx::$init_self) )
			unset( TProgressBarEx::$init_self[array_search($this->self, TProgressBarEx::$init_self)] );
		
		if( is_array($this->_toDelete) )
			foreach($this->_toDelete as $chc)
				gui_destroy($chc);
				
		if (class_exists('animate'))
			animate::objectFree($this->self);
		
		gui_destroy($this->self);
    }
	public function set_caption($v)
	{
		$this->_caption = $v;
		$pr = floor($this->_position/($this->max/100));
		$pr = ($pr > $this->max)? $this->max: $pr;
		if (strlen(trim($this->_caption))>0){
			$this->_label->caption = TProgressBarEx::formatResult($this->_caption, $pr, $this->max);
			if ($this->max == $pos){
				if ($this->end)
				{
					$this->_label->caption = TProgressBarEx::formatResult($this->_caption, 0, $this->max);
				}
			}
		}
	}
	public function get_picture()
	{
		return $this->_picture->picture;
	}
	public function set_picture($v)
	{
		if( is_string($v) ) return;
		$this->adata = gui_writeStr($this->_picture->self);

		if( $this->_image instanceof TShape && !$this->_picture->picture->isEmpty() )
		{
			$this->_image->free();
			$i = new TMImage;
			$i->parent = $this;
			$this->_image = $i;
			$this->_image->h = $this->h + 1;
			$this->_image->w = 0;
			$this->_image->y = 0;
			$this->_image->autoSize = false;
			$this->_image->proportional = false;
			$this->_image->transparent = $this->_transparent;
			$this->_image->stretch = $this->_stretch;
			$this->_image->mosaic  = $this->_mosaic;
			$this->_label->toFront();
		} elseif ($this->_image instanceof TMImage && $this->_picture->picture->isEmpty())
		{
			$this->_image->free();
			 $i = new TShape;
			$i->parent = $this;
			$this->_image = $i;
			$this->_image->h = $this->h + 1;
			$this->_image->w = 0;
			$this->_image->x = 0;
			$this->_image->y = 0;
			$this->_image->brushColor = $this->ProgressColor;
			$this->_image->penStyle = psClear;
			$this->_label->toFront();
		}
		$this->set_position ( $this->_position );
	}
	public function get_caption()
	{
		return $this->_caption;
	}
	public function get_transparent()
	{
		return $this->_transparent;
	}
	public function set_transparent($v)
	{
		$this->_transparent = $v;
		if($this->_image instanceof TMIMage)
			$this->_image->transparent = $this->_transparent;
	}
	public function get_stretch()
	{
		return $this->_stretch;
	}
	public function set_stretch($v)
	{
		$this->_stretch = $v;
		if($this->_image instanceof TMIMage)
		{
			$this->_image->stretch = $this->_stretch;
			$this->_image->update();
		}
	}
	public function get_mosaic()
	{
		return $this->_mosaic;
	}
	public function set_mosaic($v)
	{
		$this->_mosaic = $v;
		if($this->_image instanceof TMIMage)
		{
			$this->_image->mosaic = $this->_mosaic;
			$this->set_position ($this->_position);
		}
	}
	public function get_solidmosaic()
	{
		return $this->_solidmosaic;
	}
	public function set_solidmosaic($v)
	{
		$this->_solidmosaic = $v;
		$this->set_position ($this->_position);
	}
	private static function formatResult($str, $pos, $max)
	{
		$str = str_replace( array('{$pos}', '{pos}', '{$position}', '{position}', '$pos', '%pos','$position','%position', '%s1', '%i1', '%d2'), $pos, $str);
		return str_replace( array('{$max}', '{max}', '{$maximum}', '{maximum}', '$max', '%max', '$maximum', '%maximum', '%s2', '%i2', '%d2'), $max, $str);
	}
}