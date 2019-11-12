<?
return [
'NAME'=>'pform',
'SLOTS'=>0,
'EVAL'=>'global $fmEdit;
if( $fmEdit->borderStyle != "bsSizeable" ){
	global $vshape;
	$vshape = "false";
	$fmEdit->y = 0;
    $fmEdit->x = 0;
	c("fmMain->shapeSize")->visible = false;
	$fmEdit->borderStyle = "bsSizeable";
} else {
	global $vshape;
	$vshape = "true";
	c("fmMain->shapeSize")->visible = true;
	$fmEdit->y = 10;
    $fmEdit->x = 10;
	$fmEdit->borderStyle = "bsNone";
}'];