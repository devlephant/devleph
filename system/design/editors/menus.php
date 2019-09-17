<?
class MenusEditor
{
	const type = "TNxButtonItem";
	public static function OnCreate( $edt, $class, &$prop )
	{
        $edt->ButtonCaption = myProperties::ButtonCaption;
        $edt->buttonWidth = myProperties::ButtonWidth;
        $edt->onButtonClick = __CLASS__ . "::Click";
	}
	public static function Click( $self )
	{
		global $myProperties, $toSetProp, $_sc;
        if ($toSetProp) return;
        
        $prop = $myProperties->elements[ $self ]['PROP'];
        $dlg = new TMenuDialog;
        $dlg->value = $myProperties->selObj->$prop;
        
        if ($dlg->execute()){
            
            $value = $dlg->value;
            c($self)->value = $value;
            
            $targets = count($_sc->targets_ex) ? $_sc->targets_ex : [$fmEdit];
            myHistory::add($targets, $prop);
            
                foreach ($targets as $self=>$el){
                    _c(myDesign::noVisAlias($el->self))->$prop = $value;
                }
                
            $_sc->update();  // fix bug
        }
        
        $dlg->free(); 
		myProperties::updateProps();
	}
	public static function Update( $edt, $value )
	{
		$cnt = str_split(count(explode(_BR_, $value)));
		$cnt = end($cnt);
		switch( $cnt )
		{
			case 1: {
				$cnt = $cnt . " " . t("Item").t("0cnt_1");
			} break;
			case 2: case 3: case 4:
			{
				$cnt = $cnt . " " .  t("Item").t("0cnt_234");
			} break;
			case 5: case 6: case 7: case 8: case 9: case 0:
			{
				$cnt = ($cnt>0?$cnt:"0") . " " .  t("Item").t("0cnt_5_0");
			} break;
		}
		$edt->value = "[ " . $cnt . " ]";
	}
}

myProperties::AddType(["menu","TMainMenu","TPopupMenu","menues"], "MenusEditor");