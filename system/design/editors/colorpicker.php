<?
class ColorPickerEditor
{
	const type = "TNxButtonItem";
	
	public static function OnCreate( $edt, $class, &$prop )
	{
        $edt->caption = $prop['CAPTION'];
        $edt->ButtonCaption = myProperties::ButtonCaption;
        $edt->buttonWidth = myProperties::ButtonWidth;
        $edt->onButtonClick = __CLASS__ . "::Click";
	}
	public static function Click($self)
	{
		global $myProperties, $_sc, $fmEdit;
        
        $param = $myProperties->elements[ $self ];
        $prop  = $param['PROP'];
		
        $dlg = new TDMSColorDialog;
        $dlg->color = $myProperties->selObj->$prop;
		
        $colors = myOptions::get('colors','in',null);
		if( $colors!==null )
		{
			list($dlg->MainColors->text, $dlg->CustomColors->text) = unserialize(base64_decode($colors));
		}
        $x = cursor_real_x($dlg->form,10);
        $y = cursor_real_y($dlg->form,10);
        
        if ($dlg->execute($x, $y)){
            
            $color  = $dlg->color;
			$targets = $_sc->targets_ex;
            $targets = count($targets)>0? $targets : [$fmEdit->self => $fmEdit];
            myHistory::add($targets, $prop);
			
			foreach ($targets as $link=>$el)
			{
				_c(myDesign::noVisAlias($link))->$prop = $color;
			}
			
            $_sc->update();  // fix bug
			myOptions::set('colors','in', base64_encode(serialize(array($dlg->MainColors->text, $dlg->CustomColors->text))));
        }
        $dlg->free();
		myProperties::updateProps();
	}
	public static function OnEdit( $edt, $prop, $value, &$upd )
	{
		global $_sc, $fmEdit;
		$color =  self::toColor($value);
		if($color===false)
		{
			$upd = true;
			return;
		}
		$targets = $_sc->targets_ex;
		$targets = count($targets)>0?$targets : [$fmEdit->self => $fmEdit];
		myHistory::add($targets, $prop);
		
		foreach ($targets as $link=>$el)
		{
			_c(myDesign::noVisAlias($link))->$prop = $color;
		}

	}
	public static function toColor($color)
	{
		$colorFormat = myOptions::get("prefs", "color_format", 0); //HEX
		// 0 - HEX
		// 1 - RGB
		// 2 - HSL
		// 3 - BGR
		// 4 - DELPHI
		// 5 - CMYK
		$check2 = substr($color,0,2);
		if($check2==="0x"||$check2==="\x")
			$color = "#".substr($color,2);
		$color = str_replace([" ", "\r", "\n", "\t"], "", $color);
		if(substr($color,0,1)==="#") //HEX
			return ($colorFormat==0)?hexdec(substr(TColor::DHEXtoHEX($color),1)): (int)substr($color,1);
			$check2 = substr_count($color, ",");
			
		if(  $check2 > 0 )
		{
			$color = explode(",",$color);
			if($color[1]=="")
				$color[1] = 0;
			if(!isset($color[2]) || $color[2]=="")
				$color[2] = 0;
			if((!isset($color[3]) || $color[3]=="") && $colorFormat==5)
				$color[3] = 0;
			$color = array_slice($color, 0, $colorFormat==5?4:3);
			if($colorFormat == 5) //CMYK
			{
				$color = TColor::CMYKtoRGB(...$color);
			}
			if($colorFormat == 3 ) //BGR
			{
				$dup = TColor::RGBtoBGR(...$color);
			} elseif($colorFormat == 2) //HSL
			{
				$color = TColor::hsltorgb(...$color);
			} elseif($colorFormat == 6)
			{
				$color = TColor::HSVtoRGB(...$color);
			}
			//RGB => do nothing
			return hexdec(substr(TColor::RGBtoDHEX(...$color),1));
		}
		if( is_numeric($color) )
			return (int) $color; //DELPHI
		return FALSE; //Deny//
	}
	public static function ToColorFormat($value)
	{
		$colorFormat = myOptions::get("prefs", "color_format", 0); //HEX
		
		if($colorFormat==0)
		{
			return TColor::DHEXtoHEX($value);
		}elseif($colorFormat==1)
		{
			return implode(",",TColor::DHexToRGB($value));
		}elseif($colorFormat==2)
		{
			return  implode(",",TColor::RGBtoHSL(TColor::DHexToRGB($value)));
		}elseif($colorFormat==3)
		{
			return implode(",",TColor::RGBtoBGR(TColor::DHEXtoHEX($value)));
		}elseif($colorFormat==4)
		{
			return "#".dechex($value);
		}elseif($colorFormat==5)
		{
			return implode(",",TColor::RGBtoCMYK(TColor::DHexToRGB($value)));
		} else {
			return implode(",",TColor::RGBtoHSV(TColor::DHexToRGB($value)));
		}
	}
	
	public static function Update($edt, $value)
	{
		$edt->value = self::ToColorFormat($value);
	}
}

MyProperties::AddType(["color","TColor"], "ColorPickerEditor");