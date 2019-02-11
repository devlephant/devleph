$res = array();
foreach( get_declared_classes() as $class )
{
if( gui_class_isset($class) )
	$res[$class] = gui_class_proparray($class);
	//$res[] = $class;
}
file_put_contents('res.txt', print_r($res, true));