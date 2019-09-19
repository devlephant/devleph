<?
class ComponentPickerEditor
{
	const type = "TNxButtonItem";
	public static function OnCreate( $edt, $class, &$prop)
	{
        $edt->buttonWidth = myProperties::ButtonWidth;
        $edt->ButtonCaption = myProperties::ButtonCaption;
        $edt->caption = $prop['CAPTION'];
        $edt->onButtonClick = __CLASS__ . "::Click";
    }
	public static function OnClick( $self )
	{
		global $myProperties, $_sc, $fmEdit;
        $prop = $myProperties->elements[ $self ]['PROP'];
        $dlg = new TObjectsDialog;
        if ($dlg->execute(false,'',true)){
            
            $obj = _c($self);
            $value = $dlg->value;
			$targets = $_sc->targets_ex;
			$targets = count($targets)>0?$targets : [$fmEdit];
            myHistory::add($targets, $prop);
            foreach ($targets as $link=>$el)
			{
				_c(myDesign::noVisAlias($link))->$prop = $value;
			}
            $obj->value = $value;
        }
        
        $dlg->free();
        myProperties::updateProps();
	}
}
myProperties::AddType("components", "ComponentPickerEditor");