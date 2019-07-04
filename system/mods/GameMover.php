<?
/* Example:
$btns = array("w","s","a","d");
$coord = array(
array(0,-5),
array(0,5),
array(-5,0),
array(5,0),
);
*/
function movPlayer($obj, $btns, $coord){
	$obj = toObject($obj);
	if(!is_array($btns) or !is_array($coord)) return false;
	for($i=0;$i<count($btns);$i++){
		if(get_key_state(ord(strtoupper($btns[$i])))<0 and is_object($obj)){
			$obj->x += $coord[$i][0];
			$obj->y += $coord[$i][1];
		}
	}
	return true;
} ?>