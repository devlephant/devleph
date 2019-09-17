<?
class ComboboxEditor
{
	const type = "TNxComboBoxItem";
	public static function OnCreate( $edt, $class, &$prop )
	{
        $edt->caption = $prop['CAPTION'];
        if (count($prop['VALUES'])>0)
            $edt->text = $prop['VALUES'];
    }
	public static function OnEdit( $edt, $prop, $value, &$upd )
	{
		global $myProperties, $_sc, $fmEdit;
		$param = $myProperties->elements[ $self ];
		if ( isset($param['NO_CONST']) )
		{
			$value = ((bool)$param['NO_CONST'])? array_search($value,$param['VALUES']): constant($value);
        } else {
			$value = constant($value);
		}
		$targets = count($_sc->targets_ex) ? $_sc->targets_ex : [$fmEdit];
		myHistory::add($targets, $prop);
            
		foreach ($targets as $link=>$el)
		{
			_c(myDesign::noVisAlias($el->self))->$prop = $value;
		}
	}
}
myProperties::AddType(["combo","combobox","tkset","const","constlist"], "ComboboxEditor");