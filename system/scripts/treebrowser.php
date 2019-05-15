<?
c("fmMain->TreeProject")->onDblClick = create_function('$self', 'global $projectFile;
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
');

treeBwr_add();
