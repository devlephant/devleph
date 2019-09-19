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
		$param = $myProperties->elements[ $edt->self ];
		if ( isset($param['NO_CONST']) )
		{
			$value = ((bool)$param['NO_CONST'])? array_search($value,$param['VALUES']): constant($value);
        } else {
			$value = constant($value);
		}
		$targets = $_sc->targets_ex;
		$targets = count($targets)>0?$targets : [$fmEdit];
		myHistory::add($targets, $prop);
            
		foreach ($targets as $link=>$el)
		{
			_c(myDesign::noVisAlias($link))->$prop = $value;
		}
	}
	public static function Update( $edt, $value )
	{
		global $myProperties;
		$param = $myProperties->elements[ $edt->self ];
		if ( isset($param['NO_CONST']) )
		{
			$edt->value = ($param['NO_CONST'])? $param['VALUES'][(int)$value]: $value;
        } else {
			$edt->value = $value;
		}
	}
	public static function SaveValue( $prop, $value )
	{
		if ( isset($param['NO_CONST']) )
			return ($param['NO_CONST'])? array_search($value,$param['VALUES']): constant($value);
        return constant($value);
	}
}
myProperties::AddType(["combo","combobox","tkset","const","constlist"], "ComboboxEditor");