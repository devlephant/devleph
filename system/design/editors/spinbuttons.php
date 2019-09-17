<?
class SpinButtonsEditor
{
	const type ="TNxSpinItem";
	public static function OnCreate( $edt, $class, &$prop )
	{
        if ($class == "TForm")
		{
            if ($prop['PROP']=='w')
                $GLOBALS["propFormW"] = $edt;
            if ($prop['PROP']=='h')
                $GLOBALS["propFormH"] = $edt;
        }
	}
}

MyProperties::AddType(["int","integer","single","num","number"], "SpinButtonsEditor");