<?
return [
'NAME' => 'dir',
'SLOTS'=> 1,
'EVAL' => '$dir = strtolower($slots[1]);
$paths = [\'system\'=> DOC_ROOT , \'open\'=>dirname(DOC_ROOT), \'forms\'=>DOC_ROOT . \'design/forms\', \'cmd\'=>__DIR__];
if(!empty($dir))
	run($paths[$dir]);'
];