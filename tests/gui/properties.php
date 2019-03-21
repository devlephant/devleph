<?php
$e = function($name) { //safe execution
if( function_exists($name) )
return call_user_func_array($name, array_slice(func_get_args(), 1, func_num_args()-1));

switch( strtolower($name) )
{
case 'gui_class_proparray': return []; break;
case 'gui_proparray': return []; break;
case 'gui_methodlist': return []; break;
default: return false; break;
}
};

$f = function($array){ //property proper array displayment
foreach( $array as $key=>$value )
$result .= "\r\n  {$key} :{$value}";

return $result;
};
$form = new TForm();
$form->caption = 'Test Form';
$btn = new TButton($form);
$btn->parent = $form->self;
$btn->caption = 'Random Prop';
$btn->width = 120;
$label = new TLabel($form);
$label->parent = $form->self;
$label->y = $btn->y + $btn->h + 2;
$label->x = $btn->x = 2;
$label->caption = "TForm Properties:"
 . $f($e('gui_class_propArray', 'TForm'));
$label->autosize = $form->autoscroll = true;
$form->VertScrollBar->Smooth = true;
$form->VertScrollBar->Tracking = true;
$form->VertScrollBar->Style = 'ssHotTrack';
$form->HorzScrollBar->Smooth = true;
$form->HorzScrollBar->Tracking = true;
$form->HorzScrollBar->Style = 'ssHotTrack';
$form->HorzScrollBar->Increment = 1;
$form->VertScrollBar->Increment = 1;
$btn->onClick = function($self) use($form, $e){
$arr = $e('gui_propArray', 'TForm');
$prop = $arr[array_rand($arr)];
if( $e('gui_propExists', $form->self, $prop) ) {
	pre("Getting TForm->{$prop}...");
	$s = $e('gui_propGet', $form->self,  $prop);
	$s = ($s == true)? "{$prop}: True":
	 ($s == false)? "{$prop}: False": $s; 
pre("TForm->{$prop} :\r\n" . print_r($s, true));
} else {
	pre("Error, property {$$prop} does not exist!");
}
};
if( $e('gui_propExists', $form->self, 'Name') ) {
	$form->caption = 'Property Exist Passed :)';
} else {
	$form->caption = 'Property Exist Failed!';
	$btn->enabled = false;
}
$form->show();