<?
	$GLOBALS["__chromium_allowedcall_push"] = array();
	
	function chromium_allowedcall_push($func){
		if(is_callable($func)){
			array_push($GLOBALS["__chromium_allowedcall_push"], $func);
			chromium_allowedcall($GLOBALS["__chromium_allowedcall_push"]);
		}
	}
	chromium_allowedcall_push("V8JS::CallVirtual");
?>