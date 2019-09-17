<?
class CheckBoxEditor
{
	const type = "TNxCheckBoxItem";
	
	public static function OnCreate( $edt, $class, &$prop )
	{
        $edt->caption = $prop['CAPTION'];
        $edt->showText = true;
        $edt->TextKind = "tkCustom";
        $edt->TrueText = t("Yes");
        $edt->FalseText = t("No");
	}
	public static function Update( $edt, $value )
	{
		$edt->value = $value?t("Yes"):t("No");
	}
}

MyProperties::AddType(["check","checkbox","tick","bool"], "CheckBoxEditor");