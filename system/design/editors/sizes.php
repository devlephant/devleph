<?
class SizesEditor
{
	const type = "TNxButtonItem";
	const caption = "Sizes & Position";
    public static function OnCreate( $edt, $class, &$prop )
	{
        $edt->ButtonCaption = myProperties::ButtonCaption;
        $edt->buttonWidth = myProperties::ButtonWidth;
        $edt->onButtonClick = __CLASS__ . "::Click";
	}
	public static function Click( $self )
	{
		global $myProperties, $_sc, $fmEdit;
        $prop = $myProperties->elements[ $self ]['PROP'];
		
        $dlg = new TSizesDialog;
        $dlg->setSizeControl( '_sc' );
        $dlg->setObject( $myProperties->selObj );
        if ($dlg->execute())
		{
			$_sc->update();  // fix bug
		}
        $dlg->free();
		myProperties::updateProps();
	}
}
myProperties::AddType(["sizes"], "SizesEditor");