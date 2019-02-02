//<?php
$e = function($name) { //safe execution
if( function_exists($name) )
return call_user_func_array($name, array_slice(func_get_args(), 1, func_num_args()-1));

switch( strtolower($name) )
{
case 'gui_class_proparray': return array(); break;
case 'gui_proparray': return array(); break;
case 'gui_methodlist': return array(); break;
default: return false; break;
}
};
$form = new TForm();
$form->caption = 'Test Form';
$btn = new TButton($form);
$btn->parent = $form->self;
$btn->caption = 'Random Method()';
$btn->width = 120;
$label = new TLabel($form);
$label->parent = $form->self;
$label->y = $btn->y + $btn->h + 2;
$label->x = $btn->x = 2;
$label->caption = "TForm Methods:\r\n	"
 .implode("\r\n	", $e('gui_methodList', $form->self) );
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
$arr = $e('gui_methodList', $form->self);
$method = $arr[array_rand($arr)];
if( $e('gui_methodExists', $form->self, $method) ) {
	pre("Executing TForm.{$method}()...");
	$s = $e('gui_methodCall', $form->self,  $method);
	$s = ($s == true)? "{$method}: True":
	 ($s == false)? "{$method}: False": $s; 
pre("TForm.{$method} result:\r\n" . print_r($s, true));
} else {
	pre("Error, method {$method} does not exist!");
}
};
if( $e('gui_methodExists', $form->self, 'Show') ) {
	$form->caption = 'Method Exist Passed :)';
	$e('gui_methodCall', $form->self, 'Show');
} else {
	$form->caption = 'Method Exist Failed!';
	$btn->enabled = false;
	$form->show();
}