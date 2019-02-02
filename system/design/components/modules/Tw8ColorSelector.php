<?

Class Tw8ColorSelector Extends TScrollBox{
 Public $class_name_ex = __CLASS__;
 Private static $init_self;
 Private $_toDelete;
 
 Public Function __initComponentInfo()
 {
      $thi = &$this;
	 
      $this->w = 270;
      $this->h = 123;  
	  $this->borderStyle = bsNone;
	  $this->autoScroll = false;
	  $this->autosize = false;
	  $this->DoubleBuffered = true;
	 
	  $BG = new TShape; $BG->Parent = $this; $BG->w = 270; $BG->h = 123; $BG->PenColor = clWhite;

	  if( !$GLOBALS['APP_DESIGN_MODE'] ) {
		$M = new TTImer; $M->Enabled = False; $M->Repeat = True; 
		$M->Interval = ($this->dragAnim)? 30: 15;
		$this->_timer_m = $M;
		$S = new TTImer; $S->Enabled = False; $S->Repeat = True; $S->Interval = 1;
		$BA = new TTimer; $BA->Enabled = False; $BA->Repeat = True; $BA->Interval = 30;
	  }
      $P = new TShape;
	  $I = new TImage; 
		
		
        For($i=1;$i<7;$i++) // y = 0
                {
                 $c[$i] = new TShape;
				 $c[$i]->Parent = $this;
				 $c[$i]->x = $x[1];  $c[$i]->w = 45;
				 $c[$i]->y = 0;  $c[$i]->h = 45;
				 //Верхняя часть набора цвета
                 //$c[$i]->PenColor = $c[$i]->BrushColor = $color['Main'][$i-1];
				 if( !$GLOBALS['APP_DESIGN_MODE'] ) {
                  $c[$i]->OnMouseEnter = Function($self){ c($self)->PenColor = clBlack; c($self)->penWidth = 2; };
				  $c[$i]->OnMouseLeave = Function($self){ c($self)->PenColor = c($self)->BrushColor; c($self)->penWidth = 2; };
				  $c[$i]->OnMouseDown = Function($self) use ($thi,$I) {
					  $thi->sub = (c($self)->x / 45 ) + 1;
					  };   
				 }
				  $x[1] +=45;
                }	
 
        For($i=7;$i<13;$i++) // y = 45
                {
                 $c[$i] = new TShape;
				 $c[$i]->Parent = $this;
				 $c[$i]->x = $x[2];  $c[$i]->w = 45;
				 $c[$i]->y = 45;  $c[$i]->h = 45;
				 //Нижняя часть набора цвета
                // $c[$i]->PenColor = $c[$i]->BrushColor = $color['Main'][$i-1];
				if( !$GLOBALS['APP_DESIGN_MODE'] ) {
                  $c[$i]->OnMouseEnter = Function($self){ c($self)->PenColor = clBlack; c($self)->penWidth = 2; };
				  $c[$i]->OnMouseLeave = Function($self){ c($self)->PenColor = c($self)->BrushColor; c($self)->penWidth = 2; };
				  $c[$i]->OnMouseDown = Function($self) use ($thi,$I) {
					  $thi->sub = (c($self)->x / 45 ) + 7;
					  };  
				}
				  $x[2] +=45;
                } 
				
	  $I->Parent = $this;
      $I->x = 225;
      $I->y = 0;
      $I->w = 45;
      $I->h = 45;
	  $Image = Base64_Decode('iVBORw0KGgoAAAANSUhEUgAAAC0AAAAtCAYAAAA6GuKaAAAACXBIWXMAAAsTAAALEwEAmpwYAAABNmlDQ1BQaG90b3Nob3AgSUNDIHByb2ZpbGUAAHjarY6xSsNQFEDPi6LiUCsEcXB4kygotupgxqQtRRCs1SHJ1qShSmkSXl7VfoSjWwcXd7/AyVFwUPwC/0Bx6uAQIYODCJ7p3MPlcsGo2HWnYZRhEGvVbjrS9Xw5+8QMUwDQCbPUbrUOAOIkjvjB5ysC4HnTrjsN/sZ8mCoNTIDtbpSFICpA/0KnGsQYMIN+qkHcAaY6addAPAClXu4vQCnI/Q0oKdfzQXwAZs/1fDDmADPIfQUwdXSpAWpJOlJnvVMtq5ZlSbubBJE8HmU6GmRyPw4TlSaqo6MukP8HwGK+2G46cq1qWXvr/DOu58vc3o8QgFh6LFpBOFTn3yqMnd/n4sZ4GQ5vYXpStN0ruNmAheuirVahvAX34y/Axk/96FpPYgAAACBjSFJNAAB6JQAAgIMAAPn/AACA6AAAUggAARVYAAA6lwAAF2/XWh+QAAACsklEQVR42uzXPWsUQRgH8P/MOtldb7I3l+Qih6kECwVNwCIBY2fhS2FhF18wpPEL+AnsBJsoQjBg6wcIiIoYQfBEEQQrRSwk2bvzLs7txvN2dmfHwjNEQdQml+A89cD+Ztjn+c8QYwx2WlHswNqR6F1b+bFqtQrXdZGmKTzPg+/7AIA0TSGlBCFkYy0hBL7vjxeLxYt5ntfr9fo1SikmJye3Fv0vZYzxPc+bFkKczPO8mSTJmyiKHgDItiU6z3MEQXB8dHT0ghDigNZapWk6G0XR8rZAG2PAGEOlUvneZJRCKXU0CII5zvlE71ehAIjpjbp+oTkAA+ArgPyXTewTQswEQXCMMeYaY3Ip5ZNarXYTQNoXtDFmeHBw8LTrur4x5nGWZW97DUgAlBljc5zzM67rDgGAlPJZGIY3kiRZ7sv0AEA55zOVSuUyIcRdW1srJkmyAKANoEQpnS2VSuc9z9sLAFEUvW42m/NKqaXNk2VL0YQQTwhxgnN+kBCCLMvOpmn6USlVJYRMCSHmfN8fI4Sg0+l8CMNwYX19fYkxprMs6xuadDqdV0qpI67r7gmC4JDWeq7dbk8UCoXxYrG4HwCUUlGtVrsdx/Fdx3E6fQ0XAF0p5TxjbHe5XL40MDAwJISYLhQKhx3H4b2gSVZWVq63Wq07WZZ93nzC/UJrSumnOI5vMcb48PDwOcdxCo7jlHvg7urq6qJSaoFSWt8WMb7RjZS+b7fbi5TSsZGRkVM98Hqr1XrUaDSuZlnWIIT8FOt9RSuloJSC1vpFmqbzjLGAcz4lpXwahuEVrXXzd9i+nvSP5Ot2u88bjcZCHMcvpZT3ALwjhOBPd/wtRTuO89MtzhjzJYqi+1LKh1rr+l9PIftysWiLtmiLtmiLtmiLtmiLtmiLtmiLtmiLtuj/D/1tAGQFL9gFgYwLAAAAAElFTkSuQmCC');
      $I->Picture->LoadFromStr($Image,'png');
	  $I->Enabled = false;
	  $this->_selector = $I;   
 
        For($i=1;$i<19;$i++)
				{
				  $p[$i] = new TShape;
				  $p[$i]->Parent = $this;
				  $p[$i]->x = $x[3];  $p[$i]->w = 15;
				  $p[$i]->y = 92; $p[$i]->h = 20;
				  //Панель цвета / hue trackbar
				  $p[$i]->PenColor = $p[$i]->BrushColor = $color['bar'][$i-1];
				  if( !$GLOBALS['APP_DESIGN_MODE'] ) {
				  $p[$i]->OnMouseDown = Function($self) use ($P,$S,$i,$thi){ 
				  $S->Enabled = true; $thi->__prevb = $thi->_main; $thi->__Index = $i; /**/ $P->x = c($self)->x - 2; /**/ $P->BrushColor = c($self)->BrushColor;
				  $thi->_sbmove = true;
				  }; 
				  $p[$i]->OnMouseUp = Function($self) use($S){ 
				   $S->Enabled = false;  
				   $thi->_sbmove = false; };
				  }
				  $x[3] +=15;
				}
				
		$this->_panels = $p;
		$this->_shapes = $c;
		 
					$P->Parent = $this;
					$P->w = 17;
					$P->y = 90;  $P->h = 32;
					$P->PenColor	= $this->_pc;
					$P->PenWidth	= $this->_tpw;
					$P->PenMode		= $this->_tpm;
					$P->PenStyle	= $this->_tp;
					$P->Shape		= $this->_ts;
					$P->BrushStyle	= $this->_tss;
		$this->_trackselector = $P;
			if( !$GLOBALS['APP_DESIGN_MODE'] ) {
					$P->OnMouseDown = Function($self) use ($M) {
				       Global $sx,$fx;
                       $sx = cursor_pos_x();
                       $fx = c($self)->x;
                       $M->Enabled = true; };
				    //////////
				    $P->OnMouseUp = Function($self) use ($M,$S) { 
				       Global $px;
				       c($self)->x = $px;
				       $M->Enabled = false; 
					   $S->Enabled = false; };
			}
 $this->UpdateDsgn();
if( !$GLOBALS['APP_DESIGN_MODE'] ) {
 $Index = $this->_main;
 $M->OnTimer = Function($self) use($thi,$P,$c,$p,$S)
			{ $S->Enabled = true;
                  Global $sx,$fx,$px,$Index;
                  $P->x = $fx - ($sx - cursor_pos_x());
				  
				  $x = $P->x + $P->w / 2;
				  
				  For($i=1;$i<19;$i++)
				  {
				    IF($x > $p[$i]->x && $x < $p[$i]->x + 15)
				    {
				     $px = $p[$i]->x - 2;
				     $P->BrushColor = $p[$i]->BrushColor;
					  $thi->__prevb = $thi->_main;
					  $thi->__Index = $i;
					 
				    }
				  }
            };
  $color = $this->colors;
   $BA->OnTimer = Function($self) use($thi){
	$thi->bargradientstep();
 };
 $this->_bartimer = $BA;
 $S->OnTimer = Function($self) use($thi,$P,$p,$c,$color)
		    {
				$thi->_moving = true;
				if( !$thi->trackAnim ) {
					$P->BrushColor = $p[$thi->__Index]->BrushColor;
				} else {
					$thi->_bartimer->Enabled = True;
				}
				$thi->main =  $thi->__Index;
  	        };
}
$this->_toDelete = $GLOBALS['APP_DESIGN_MODE']? array($M->self, $S->self, $BA->self): null;
 }
 
 private function UpdateDsgn ()
 { 
	$value	= $this->toVal($this->_main, 18);
	$valueb	= $this->toVal($this->_sub, 12);
	$minv	= min(array_keys($this->colors['M'])) - 1;
		For($i=1;$i<7;$i++) // y = 0
                {
					$obj = $this->_shapes[$i];
					if( $obj instanceof TShape )
						$obj->PenColor = $obj->BrushColor = $this->colors['M'][$value - $minv][$i-1];
                }
				
		For($i=7;$i<=12;$i++) // y = 45
				{
					$obj = $this->_shapes[$i];
					if( $obj instanceof TShape )
						$obj->PenColor = $obj->BrushColor = $this->colors['M'][$value - $minv][$i-1];
                }
		  For($i=1;$i<19;$i++)
				{
				  //Панель цвета / hue trackbar
				  $obj = $this->_panels[$i];
					if( $obj instanceof TShape )
						$obj->PenColor = $obj->BrushColor = $this->colors['bar'][$i-1];
				}
		if( !$this->_moving ) {
			$this->_trackselector->BrushColor = $this->colors['bar'][($value-min(array_keys($this->colors['M'])))]; 
		}			
		if( ($this->dragAnim && $this->_sbmove) || !$this->_moving )
		{
			
			$this->_trackselector->x = 15 * ($value - 1);
			
		}		
		
		if( $this->_sub > 6 ) {
			$this->_selector->x = 45 * ($valueb - 7);
			$this->_selector->y = 45;
		} else {
			$this->_selector->x = 45 * ($valueb - 1);
			$this->_selector->y = 0;
		}
		$this->_moving = $this->_sbmove = false;
}
 private function toVal($value, $max)
 {
	if( $value == 0 /* $max = 18 */ )
		return 1;
	
		if( $value > $max || $value < -$max )
			return $value - ($max * floor($value/$max));
		
		if( $value < 0 )
			return $value + $max;
		
	return $value;
 }
 public function panelanimstep()
 {
	/* Prop: Animation = {tcaAnimation(Combo)}, AnimationGradient = check, InheritGradient = check */
	$value	= $this->toVal($this->_main, 18);
	$valueb	= $this->toVal($this->_prevb, 18);
	$minv	= min(array_keys($this->colors['M'])) - 1;
	 switch( $this->Animation )
	 {
		 /* None */
		 case 0:
		 {
			$this->UpdateDsgn ();
		 }break;
		 /* LtoR */
		 case 1:
		 {
			if( !$this->_iter ) $this->_iter = 1;
			
			if( $this->AnimationGradient ) {
				if( $this->InheritGradient )
				{
					
				} else {
					
				}
			} else {
				if( $this->_iter == 6 ) {
					$this->_timereol->Enabled = False;
					$this->_iter = false;
				} else {
				//y = 0
				$obj = $this->_shapes[$this->_iter];
				if( $obj instanceof TShape )
					$obj->PenColor = $obj->BrushColor = $this->colors['M'][$value - $minv][$this->_iter-1];
			
				//y = 45
				$obj = $this->_shapes[$this->_iter+6];
				if( $obj instanceof TShape )
					$obj->PenColor = $obj->BrushColor = $this->colors['M'][$value - $minv][$this->_iter+5];
				
				$this->_iter++;
				}
			}
		 }break;
		 /* RtoL */
		 case 2:
		 {
		 }break;
		 /* UtoD */
		 case 3:
		 {
		 }break; 
		 /* DtoU */
		 case 4:
		 {
		 }break;
		 /* LtoRA */
		 case 5:
		 {
		 }break;
		 /* RtoLA */
		 case 6:
		 {
		 }break;
		 /* UtoDA */
		 case 7:
		 {
		 }break;
		 /* DtoUA */
		 case 8:
		 {
		 }break;
		 /* LtoRL */
		 case 9:
		 {
		 }break;
		 /* RtoLL */
		 case 10:
		 {
		 }break;
		 /* UtoDL */
		 case 11: 
		 {
		 }break;
		 /* DtoUL */
		 case 12:
		 {
		 }break;
		 /* LtoRLA */
		 case 13:
		 {
		 }break;
		 /* RtoLLA */
		 case 14:
		 {
		 }break;
		 /* UtoDLA */
		 case 15:
		 {
		 }break;
		 /* DtoULA */
		 case 16:
		 {
		 }break;
		 /* DiagRL */
		 case 17:
		 {
		 }break;
		 /* DiagUD */
		 case 18:
		 {
		 }break;
		 /* Full */
		 case 19:
		 {
		 }break;
	 }
 }
 public function bargradientstep()
 {
	$valueb	= $this->toVal($this->__prevb, 18);
	$value	= $this->toVal($this->__Index, 18);
	$minv	= min(array_keys($this->colors['bar'])) + 1;
	if ( $valueb !== $value ) {
		if( $this->__baricount < 1 ) 
		{
			///if( $this->colors['bar'][$this->__prevb-1] < $this->colors['bar'][$this->__Index-1] )
			//{
				$tc	= new TColor($this->colors['bar'][$valueb-$minv]);
				$this->__baricolours = $tc->gradient( $this->colors['bar'][$value-$minv], 28 );
			/*} else {
				$tc	= new TColor($this->colors['bar'][$this->__Index-1]);
				$this->__baricolours = array_reverse($tc->gradient( $this->colors['bar'][$this->__prevb-1], 20 ));
			}*/
			$this->__baricount = 1;
		}
		if( $this->__baricount < count($this->__baricolours) )
		{
			$this->_trackselector->BrushColor = $this->__baricolours[ $this->__baricount-1 ]->color;
		} else {
			$this->__prevb = $this->__Index;
		}
		$this->__baricount++;
	} else {
		$this->_trackselector->BrushColor = $this->colors['bar'][$this->__Index-1];
		$this->__baricount = 0;
		$this->_bartimer->Enabled = false;
	}
 }

 public function set_Main($value)
 {
	$this->_main = ($value < 0)? 1: $value;
	$this->UpdateDsgn();
 }
 
 public function get_Main()
 {
	return $this->_main;
 }
 
 public function set_Sub($value)
 {
	$this->_sub = ($value < 0)? 1: $value;
	$this->UpdateDsgn();
 } 
 
 public function get_Sub()
 {
	return $this->_sub;
 }
 
 public function get_Color ()
 {
	$value	= $this->_main;
	$valueb	= $this->_sub;
	if( $this->_main > 18 ) 
		$value = $this->_main - 18;
	if( $this->_main <= 0 )
		$value = 1;
	if( $this->_sub > 12 ) 
		$valueb = $this->_sub - 12;
	if( $this->_sub <= 0 )
		$valueb = 1;
	$miv = min(array_keys($this->colors['M'])) - 1;
		if( isset($this->colors['M'][$value-$miv][$valueb-1]) )
			return  toHTMLColor($this->colors['M'][$value-$miv][$valueb-1]);
		
		return  toHTMLColor(clWhite);
 }
 
 public function set_Color($value)
 {
	 foreach($this->colors['M'] as $key=>$colors)
	 {
		if( in_array($value, $colors) ) {
			$this->main = $key;
			$this->sub = array_search($value, $colors) + 1;
			return;
		}
	 }
	 
	 if( in_array($value, $this->colors['bar']) ){
		$this->main = array_search($value, $this->colors['bar']) + 1;
	 }
 }
 
 public function get_ThumbColor()
 {
	 if( !isset($this->_pc) )
		 $this->_pc = $this->_trackselector->PenColor;
	 return toHTMLColor($this->_pc);
 }
 
 public function set_ThumbColor ($v)
 {
	 $this->_pc = $v;
	 $this->_trackselector->PenColor = $this->_pc;
 }
	public function get_ThumbShape()
	{
		if( !isset($this->_ts) )
		 $this->_ts = $this->_trackselector->Shape;
		return 	$this->_ts;
	}
	
	public function set_ThumbShape($v)
	{
		$this->_ts = $v;
		$this->_trackselector->Shape = $v;
	}
	public function get_ThumbShapeStyle()
	{
		if( !isset($this->_tss) )
		 $this->_tss = $this->_trackselector->BrushStyle;
		return 	$this->_tss;
	}
	
	public function set_ThumbShapeStyle($v)
	{
		$this->_tss = $v;
		$this->_trackselector->brushStyle = $v;
	}
	
	public function get_ThumbPenStyle()
	{
		if( !isset($this->_tp) )
		 $this->_tp = $this->_trackselector->PenStyle;
		return 	$this->_tp;
	}
	
	public function set_ThumbPenStyle ($v)
	{
		$this->_tp = $v;
		$this->_trackselector->penStyle = $v;
	}
	
	public function get_ThumbPenMode()
	{
		if( !isset($this->_tpm) )
		 $this->_tpm = $this->_trackselector->PenMode;
		return 	$this->_tpm;
	}
	
	public function set_ThumbPenMode($v)
	{
		$this->_tpm = $v;
		$this->_trackselector->penMode = $v;
	}
	
	public function get_ThumbPenWidth()
	{
		if( !isset($this->_tpw) )
		 $this->_tpw = $this->_trackselector->PenWidth;
		return 	$this->_tpw;
	}
	
	public function set_ThumbPenWidth($v)
	{
		$this->_tpw = $v;
		$this->_trackselector->penWidth = $v;
	}
	
	public function set_dragAnim($v)
	{
		$this->_timer_m->Interval = ($this->dragAnim)? 30: 15;
	}
	
 Public Function __construct($owner=nil,$init=true,$self=nil){
	 
        parent::__construct($owner,$init,$self);  
		
		IF($init)	{
			if( !$this->_main )
				$this->_main	= 1;
			
			if( !$this->_sub )
				$this->_sub		= 1;
			
			if( !isset($this->_pc) )
				$this->_pc = clWhite;
			
			if( !isset($this->_ts) )
				$this->_ts = stRectangle;
			
			if( !isset($this->_tss) )
				$this->_tss = bsSolid;
			
			if( !isset($this->_tp) )
				$this->_tp = psSolid;
			
			if( !isset($this->_tpm) )
				$this->_tpm = pmCopy;
			
			if( !isset($this->_tpw) )
				$this->_tpw = 2;
			
			if( !isset($this->_moving) )
				$this->_moving = false;
			
			if( !isset($this->__baricount) ) {
				$this->__baricount = 0;
				$this->__prevb = 1;
				$this->__Index = $this->_main;
			}
			
			if( !isset($this->dragAnim ) )
				$this->dragAnim = False;
			
			if( !isset($this->trackAnim) )
				$this->trackAnim = False;
			
			if( !$this->colors )
			{#4500dd
				$color['bar'] = Array(0x00303030,0x00777777,0x00DD003F,0x00FF2390,0x00C23EFF,0x006B0BFE,0x004435C0,0x00031CFE,0x000036F7,
				                       0x00056CFD,0x0007ABFE,0x001EC9FF,0x0000A25D,0x0000A730,0x0062AB00,0x00A9A800,0x00F09B00,0x00FE6A00);
				$color['M'][1] = Array(0x00353325,0x004B493B,0x00636152,0x007D7B6B,0x00969484,0x00B1AF9F,0x00303030,0x00464646,0x005E5E5E,0x00777777,0x00919191,0x00ACACAC);
				$color['M'][2] = Array(0x00303030,0x00464646,0x005E5E5E,0x00777777,0x00919191,0x00ACACAC,0x00303030,0x00464646,0x005E5E5E,0x00777777,0x00919191,0x00ACACAC);
				$color['M'][3] = Array(0x00A3002E,0x00B41746,0x00CE2F60,0x00E44277,0x00FB568E,0x00FF6AA4,0x00791B39,0x00892A4B,0x00A13F61,0x00B65176,0x00CC648B,0x00E177A0);
				$color['M'][4] = Array(0x009D0058,0x00B30068,0x00D50094,0x00ED28A5,0x00FF46C0,0x00FF64DF,0x0077004D,0x00920069,0x00AD1B84,0x00C93BA1,0x00E556BD,0x00FF72DB);
				$color['M'][5] = Array(0x004200AD,0x005900CD,0x007200EE,0x008B27FF,0x00A552FF,0x00C072FF,0x00430091,0x005A20AF,0x007342CE,0x008C5EEB,0x00A77AFF,0x00C196FF);
				$color['M'][6] = Array(0x007100BB,0x008B00DA,0x00A500F9,0x00C13AFF,0x00DC5FFF,0x00F981FF,0x00510086,0x006900A2,0x008328C0,0x009C48DD,0x00B866FC,0x00D382FF);
				$color['M'][7] = Array(0x0016007D,0x0019009E,0x002100BE,0x002400E0,0x002A00FF,0x004341FF,0x00210065,0x002A0083,0x00380DA1,0x004234C1,0x004F4FDE,0x00696DFF);
				$color['M'][8] = Array(0x0003007C,0x0000009C,0x000000BC,0x000000DE,0x000017FF,0x002046FF,0x00000062, clMaroon ,0x00081D9E,0x00203CBD,0x003757DB,0x004F73FB);
				$color['M'][9] = Array(0x00000094,0x000000B5,0x000000D5,0x000034F7,0x001A55FF,0x003674FF,0x0000007E,0x0000219D,0x00173EBB,0x002F5ADA,0x004774F9,0x006090FF);
				$color['M'][10] = Array(0x000012A2,0x000036C2,0x000052E2,0x00006BFF,0x002B89FF,0x0048A6FF,0x00001973,0x0000338F,0x00104CAD,0x002A65CB,0x00407DE6,0x005B9AFF);
				$color['M'][11] = Array(0x00004080,0x0000599E,0x000071BC,0x00008BDB,0x0000AAFF,0x002CC1FF,0x00002F5D,0x00004578,0x00005E95,0x000A76B1,0x002C90CF,0x0047AAED);
				$color['M'][12] = Array(0x00004873,0x00006091,0x000079AE,0x000093CC,0x0000ADEA,0x001AC9FF,0x00003554,0x00004B6F,0x0000638B,0x00007BA7,0x002496C4,0x0040B0E1);
				$color['M'][13] = Array(0x00004900,0x00006105,0x00007B31,0x0000944F,0x0000B06D,0x0000CB8A,0x0000451B,0x00005C36,0x00007650,0x00008F6A,0x0029AA85,0x0045C5A0);
				$color['M'][14] = Array(0x00004C00,0x00006400,0x00007F00,0x00009916,0x0000B543,0x0000D163,0x00004800,0x00005F1C,0x0000793A,0x00079355,0x002DAE70,0x0049C98B);
				$color['M'][15] = Array(0x00224D00,0x00376700,0x004F8200,0x00549D00,0x0057BA00,0x005BD500,0x002B4900,0x00416200,0x00597C00,0x00659610,0x0071B23E,0x007DCC58);
				$color['M'][16] = Array(0x00514C00,0x00696500,0x00827F00,0x009C9A00,0x00B7B600,0x00D2D100,0x00494800,0x00616000,0x007A7A00,0x0093930A,0x00AEAF3B,0x00C9CA5A);
				$color['M'][17] = Array(0x008F4500,0x00A95C00,0x00C67500,0x00E18E00,0x00FFAB00,0x00FFC341,0x00754200,0x008E5900,0x00AA7219,0x00C48B3F,0x00E3A761,0x00FDC07B);
				$color['M'][18] = Array(0x00A12300,0x00BE3700,0x00DA4D00,0x00F86400,0x00FF7C3B,0x00FF9664,0x007A2200,0x00953800,0x00B04E26,0x00CC6649,0x00E87E66,0x00FF9884);
			$this->colors = $color; 
			}
		}
		$sl = true;
		if( !empty( Tw8ColorSelector::$init_self ) )
			if( in_array($this->self, Tw8ColorSelector::$init_self) ) $sl = false;
		
		if( $sl )
		{
			Tw8ColorSelector::$init_self[] = $this->self;
			$this->__initComponentInfo();
		}
		
		IF($init){	
			/*$this->autosize = True;*/
			$this->bevelInner = bsNone;
			$this->autosize = true;
		}
		return;
	}

	function free()
	{
		if( array_search($this->self, Tw8ColorSelector::$init_self) )
			unset( Tw8ColorSelector::$init_self[array_search($this->self, Tw8ColorSelector::$init_self)] );
		
		if( is_array($this->_toDelete) )
			foreach($this->_toDelete as $chc)
				gui_destroy($chc);
				
		if (class_exists('animate'))
			animate::objectFree($this->self);
		
		gui_destroy($this->self);
    }
 
}