<?
class FilePickerEditor
{
	const type = "TNxComboBoxItem";
	public static function OnCreate( $edt, $class, &$prop)
	{
        $edt->caption = $prop['CAPTION'];
	}
	public static function Update( $edt, $value )
	{	
		global $projectFile;
		$param = $myProperties->elements[ $edt->self ];
		$items = [];
		foreach (findFiles(dirname($projectFile), $param['EXT'], $param['RECURSIVE'], true) as $file){
			$file = str_replace(array(dirname($projectFile),'//'),array('','//'), $file);
			if ($file[0]=='/')
				$file[0] = ' '; $file = ltrim($file);
			
			if (!in_array($file, $items))
				$items[] = $file;
		}
		
		$edt->text  = $items;
		$edt->value = $value;
	}
	public static function OnEdit( $edt, $value, $prop, &$upd)
	{
		self::Update( $edt, $value );
	}
}
myProperties::AddType("files", "FilePickerEditor");