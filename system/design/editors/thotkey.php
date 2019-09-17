<?
class HotkeyEditor
{
	const type = "TNxButtonItem";
	
	public static function OnCreate( $edt, $class, &$param )
	{
        $edt->caption = $param['CAPTION'];
        $edt->ButtonCaption = myProperties::ButtonCaption;
        $edt->buttonWidth = myProperties::ButtonWidth;
        $edt->onButtonClick = "TextEditor::Click";
	}
	
}
myProperties::AddType(["hotkey","shortcut","thotkey","tshortcut","fastkey"], "HotkeyEditor");