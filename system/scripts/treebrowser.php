<?
c("fmMain->TreeProject")->onDblClick = create_function('$self', 'global $projectFile, $_FORMS, $formSelected, $_sc;
$self = c("fmMain->TreeProject");
switch( fileExt($self->itemSelected) )
{
	
	case "dfm":
		myUtils::loadForm( basenameNoExt($self->itemSelected));
	break;
	
	case "php":
		run(dirname($projectFile)."/scripts/".$self->itemSelected);
	break;
	
	case "dll":
	//null
	break;
	
}
$test = stristr($self->itemSelected,"(");
if(!empty($test))
{
	$test = str_ireplace("(", "", $test);
	$test = str_ireplace(")", "", $test);
	if(!is_object(c($test))) return;
	foreach( myUtils::$forms as $name=>$form ){
		if( $form->self == c($test)->owner ){
			if( strtolower($_FORMS[$formSelected]) == $name )
			{
				$_sc->clearTargets();
				$_sc->addTarget(c($test));
			} else {
				myUtils::loadForm($name);
				$_sc->clearTargets();
				$_sc->addTarget(c($test));
			}
		}
	}
}
');

treeBwr_add();