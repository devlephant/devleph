<?
class ImageButtonEditor
{
	const type = "TNxButtonItem";
	public static function OnCreate( $edt, $class, &$prop)
	{
        $edt->ButtonCaption = myProperties::ButtonCaption;
        $edt->buttonWidth = myProperties::ButtonWidth;
        $edt->onButtonClick = __CLASS__ . "::Click";
	}
	public static function Click( $self )
	{
		global $myProperties, $_sc, $fmEdit, $toSetProp;
		if ($toSetProp) return;
        $prop  = $myProperties->elements[ $self ]['PROP'];
		if(count($_sc->targets_ex)==0) return;
		$ib = _c(myDesign::noVisAlias(current($_sc->targets_ex)->self));
		
		$prev = $ib->$prop;
		$prev2 = isset($ib->state)? $ib->state: null;
		if( master_TIB::execute( $ib ) )
		{
            myHistory::add($_sc->targets_ex, $prop);
            if( count($_sc->targets_ex) > 1 )
				foreach ($_sc->targets_ex as $link=>$el){
					$el = _c(myDesign::noVisAlias($el->self));
					if( isset($el->$prop) )
						$el->$prop = $ib->$prop;
					if( isset($el->state) )
						$el->state = $ib->state;
				}
		} else {
			$ib->$prop = $prev;
			if( $prev2!==null )
				$ib->state = $prev2;
		}
		$_sc->update();  // fix bug
		self::updateProps();	// fix bug
	}
	public static function Update( $edt, $value )
	{
		$cnt = str_split(count($value));
		$cnt = end($cnt);
		switch( $cnt )
		{
			case 1: {
				$cnt = $cnt . " " . t("img_cnt").t("2cnt_1");
			} break;
			case 2: case 3: case 4:
			{
				$cnt = $cnt . " " .  t("img_cnt").t("2cnt_234");
			} break;
			case 5: case 6: case 7: case 8: case 9: case 0:
			{
				$cnt = $cnt . " " .  t("img_cnt").t("2cnt_5_0");
			} break;
		}
		$edt->value = "[ " . $cnt . " ]";
	}
}

myProperties::AddType(["imbs","tib","imagebutton"], "ImageButtonEditor");