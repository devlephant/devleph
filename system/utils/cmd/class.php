<?

// Author - Gignorie 

// Console Addon
//   Special
//     for
//    Dev-S
$parent = c('fmObjectInspector->TabSheet1');
$edit = new TEdit;
$edit->parent = $parent;
$edit->align = 'alTop';
$edit->bevelInner = bvRaised;
$edit->bevelOuter = bvLowered;
$edit->bevelKind = bkFlat;
$edit->borderStyle = bsNone;
$edit->marginLeft = 0;
$edit->name = 'debugEdit';
$edit->text = '';

$edit->onKeyUp = function($self, &$key, $shift){
	if( $key == VK_RETURN ){
		$text = _c($self)->text;
		$cmd_dir = __DIR__ . "/commands/";
		$files = findFiles($cmd_dir, "php");
		$cmd_info = [];
		foreach( $files as $file ){
			$cmd = include($cmd_dir.$file);

			if(!is_array($cmd))
				pre('[Error] This file is not correct!');
		
			$name = $cmd["NAME"];
			unset($cmd["NAME"]);
		
			$cmd_info[$name] = $cmd;
		
		}
		
		foreach($cmd_info as $name=>$cmd){
			if( strstr($text, '/'.$name) && $cmd["SLOTS"] == 0 ){
				eval($cmd["EVAL"]);
			} elseif( strstr($text, "/".$name) && $cmd["SLOTS"] > 0 ){
				$gets = '';
				for($i=0;$i<$cmd["SLOTS"];$i++){
					$gets .= " (.*)";
				}
				preg_match("/\/".$name.$gets."/i", $text, $slots);
				eval($cmd["EVAL"]);
			}
		}
	}
};