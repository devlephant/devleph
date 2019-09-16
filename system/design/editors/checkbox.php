<?php
class CheckBoxEditor
{
	const type = "TNxCheckBoxItem";
	public static function OnCreate( $edt, $class, &$prop )
	{   
        $edt->showText = true;
        $edt->TextKind = 'tkCustom';
        $edt->TrueText = t('Yes');
        $edt->FalseText = t('No');
	}
}