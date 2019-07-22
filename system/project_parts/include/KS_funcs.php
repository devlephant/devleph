<?
			///////////////////////
			// Creator: Alex2003 //
			///////////////////////
	function image264($fileName){
		$imageSize = getimagesize($fileName);
		return "data:{$imageSize['mime']};base64,{".base64_encode(file_get_contents($fileName))."}";
	}
	
	function strins($string, $position, $content){
		return substr($string, 0, $position) . $content . substr($string, $position);
	}
			///////////////////////////
			// Creator: Andrew Zenin //
			///////////////////////////
function parent_get_prop_all($obj, $prop){
    $arr = [];
	while($obj->parent){
		$obj = $obj->parent;
		if($obj->$prop){	$arr[] = $obj->$prop;	}
	}
	return $arr;
}

function parent_set_prop_all($obj, $prop, $value, $bool=1, $res=false){
	if( !$res )
	{
		while($obj->parent){
			$obj = $obj->parent;
			if(isset($obj->$prop)){	$res = true; $obj->$prop = $value; }
		}
		return $res;
	}
    $arr = [];
	while($obj->parent){
		$obj = $obj->parent;
		if(isset($obj->$prop)){	$obj->$prop = $value; }
		$arr[] = 
			isset($obj->$prop)?
				($bool)?true:	$obj->name . '->' . $prop . " == " . $value:
				($bool)?false:	$obj->name . '->' . $prop . " != " . $value;
	}
	return $arr;
}
function str_rot($str){
	$str = str_split($str); 
	$arr = range(255,0);
	foreach($str as $lts){ 
		$res .= chr( $arr[ ord($lts)] ); 
	}
 
	return $res; 
} 
function sum( array $values ){
$res = 0;
foreach( $values as $value){
$res += $value;
}
return $res;
}
function get_w($obj){
return get_x($obj) + $obj->w;
}
function get_h($obj){
return get_y($obj) + $obj->h;
}
function get_x($obj){
    $res = $obj->x;
	while($obj->parent){
		$obj = $obj->parent;
		if($obj->x){	$res += $obj->x;	};
	}
	return $res;
}

function get_y($obj){
    $res = $obj->y;
	while($obj->parent){
		$obj = $obj->parent;
		if($obj->y){	$res += $obj->y;	};
	}
	return $res;
}

	function strend2($start,$end,$text){
	$res = [];
	foreach(explode($start, $text) as $rec){
	$res[] = strend($start,$end,$start.$rec);
	}
	return array_slice($res, 1);
	}

	Function strend($start,$end,$text){

		return str_replace(strstr(strstr($text,$start),$end),$end,strstr($text,$start));

	}

function print_out($var, $to = null, $n = null){
 $v = dvar($var);
	switch( true ){
		case is_file($to): file_put_contents($to, $v);
		case is_resource($to): fwrite($to, $v);
		case is_object($to): $to->$n = $var;
		case !$to: gui_message($v);
	}
}

function print_right($v){
	
	if ( sync(__FUNCTION__, func_get_args()) ) return;
	
	$s = print_r($v, true);
	$s = implode('', 
	str_replace(
		' ,',
		', ',
		array_reverse( str_split( $s ), true )
	) );
	
	gui_message($s);
}
 
 function char2hex($text){
	$text = unpack('H*', $text);
	return base_convert($text[1], 16, 16);
  }
if( !function_exists('hex2bin') ){
	function hex2bin($hex){ 
	   for($i=0;$i<strlen($hex);$i++) $bin .= str_pad( decbin(hexdec($hex{$i})), 4, '0', STR_PAD_LEFT ); 
		  return $bin; 
	}
}
function char2bin($str) {
    $i = 0;
    do {
        $bin .= chr(hexdec($str{$i}.$str{($i + 1)}));
        $i += 2;
    } while ($i < strlen($str));
    return $bin;
}
function bin2str($input){
  if (!is_string($input)) return null;
  return pack('H*', base_convert($input, 2, 16));
}
function str2bin($input){
  if (!is_string($input)) return null;
  $value = unpack('H*', $input);
  return base_convert($value[1], 16, 2);
}
function dvar($var){
	ob_start();
	var_dump($var);
	$data = ob_get_contents();
	ob_end_clean();
	return $data;
}

 
function eval2( $code, $quite ){
	$aerr = dsErrorDebug::ErrStatus();
	if($aerr and $quite){ dsErrorDebug::hide(); }; 
	if( is_array($code) ){
		foreach($code as $str){
		if(is_array($str) ){ eval2($str, $quite); }else if(is_string($str)){ eval($str); };
		}
	}else if(is_string($str)){ eval($str); };
	if($aerr and $quite){ dsErrorDebug::display(); };
}

function is_on_obj($obj2, $obj1){
$x1 = get_x($obj1); $x2 = get_x($obj2);
$y1 = get_y($obj1); $y2  = get_y($obj2);
$mx = $x1 + $obj1->w; $my = $y1 + $obj1->h;
if($x2<=$mx and $x2>=$x1 and $y2<=$my and $y2>=$y1){ return True; }else{ return False; };
}
//Функция для получения цвета пикселя с экрана
function GetPixel($x=false, $y=false, $frame=false){
	
		if(!$frame){
			if(!$x){$x = cursor_pos_x();};	if(!$y){$y = cursor_pos_y();};
			$im = imagegrabscreen();
		}else{
			if(!$x){$x = cursor_pos_x() - $frame->x;};	if(!$y){$y = cursor_pos_y() - $frame->y;};
			$im = imagegrabwindow($frame->handle);
		}
		
		$col = imagecolorat($im, $x, $y);
		$icol = imagecolorexact($im, $col & 0xFF, ($col >> 8) & 0xFF, ($col >> 16) & 0xFF);
	return $icol;
}





function arr_gd($length, $color_1='', $color_2=''){
    if(!empty($color_1) && !empty($color_2)){
	$color_1 = dechex($color_1); $color_2 = dechex($color_2);
        $color_2   = hexdec($color_2[0].$color_2[1]).",".hexdec($color_2[2].$color_2[3]).",".hexdec($color_2[4].$color_2[5]);
        $color_1 = hexdec($color_1[0].$color_1[1]).",".hexdec($color_1[2].$color_1[3]).",".hexdec($color_1[4].$color_1[5]);
    }
    if(empty($color_1)){ $color_1 = [0,0,255]; }else{ $color_1 = explode(",", $color_1); };
    if(empty($color_2)){ $color_2 = [255,0,0]; }else{ $color_2 = explode(",", $color_2); };
        $res = [];

        for ($i=1;$i<=$length;$i++){
                for ($ii=0;$ii<4;$ii++){

            $tmp[$ii] = $color_1[$ii] - $color_2[$ii];
                        $tmp[$ii] = floor($tmp[$ii] / $length);
                        $rgb[$ii] = $color_1[$ii] -($tmp[$ii] * $i);
                        if($rgb[$ii] > 255){ $rgb[$ii] = 255; };
                        $rgb[$ii] = dechex($rgb[$ii]);
                        $rgb[$ii] = strtoupper($rgb[$ii]);
                        if(strlen($rgb[$ii]) < 2){ $rgb[$ii] = "0$rgb[$ii]"; };
                }
            $res[] = hexdec($rgb[0].$rgb[1].$rgb[2]);
        }
        return $res;
}

function create_gradient($obj, TCanvas $canv, $col1 = clWhite, $col2 = clLtGray, $hz=false, $both=false){
	if(!$canv){
		$canv = $obj->canvas;
	}

	if(!$hz){
		$ch = $obj->h;
		$cm = $obj->w;
	}else{
		$ch = $obj->w;
		$cm = $obj->h;
	}
	if($both){
	$arr = arr_gd( $ch/2, $col1, $col2);
	$arr = array_merge(array_reverse($arr), $arr);
	}else{
		if($ch>=254){
			$arr = range(min($col1, $col2), max($col1, $col2));
		}else{
			$arr = arr_gd($ch, $col1, $col2);
		}
	}
	$ly=0;
	foreach( $arr as $cl ){
		$canv->pen->color = $canv->brush->color = $cl;
		if(!$hz){
		$canv->moveTo( 0, $ly, $cl );
		$canv->lineTo( $cm, $ly, $cl );
		}else{
		$canv->moveTo( $ly, 0, $cl );
		$canv->lineTo( $ly, $cm, $cl );
		}
	++$ly;
	}
	$canv->lock();
}


function __c($obj){ 
if($obj->self){ 
return c($obj->self); 
}else{ 
if(is_numeric($obj)){ if(is_link($obj)) return _c($obj,1)->self; else return _c($obj,0); } 
if(is_string($obj)) return c($obj);
if(is_object($obj)) return $obj; 
if( is_resource($name) ) return __c(object_resource2text($name)); 
}
return;
}

function center( $obj ){
	$r['x'] = $obj->x + round($obj->w/2);
	$r['y'] = $obj->y + round($obj->h/2);
return $r;
}
function create_lnk($file, $link, $comand, $icon=false, $decription='', $WindowStyle=1){
if(!$file) return;
$Shell = new com("WScript.Shell");
$_Link = $Shell->CreateShortcut($link);
$_Link->TargetPath = $comand;
if($WindowStyle) $_Link->WindowStyle = $WindowStyle;
if($icon&&file_exists($icon)) $_Link->IconLocation = $icon;
$_Link->Description = $decription;
$_Link->WorkingDirectory = dirname($file);
$_Link->Save();
unset($Shell, $_Link);
}
?>