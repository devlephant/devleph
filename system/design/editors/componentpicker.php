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
            $targets = count($_sc->targets_ex) ? $_sc->targets_ex : [$fmEdit];
            
            foreach ($targets as $el)
			{
				$el = _c(myDesign::noVisAlias($el->self));
				$el->$prop = $value;
			}
            $obj->value = $value;
        }
        
        $dlg->free();
        myProperties::updateProps();
	}
}
myProperties::AddType("components", "ComponentPickerEditor");