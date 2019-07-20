<?
function treeBwr_add()
{	
	global $projectFile;
	
	$dir = dirname($projectFile);
	$tree = c('fmMain->TreeProject');
	
	$tree->text = "";
	
	$dirs = findFiles($dir, "dfm");
	foreach( $dirs as $dfm )
	{
		$Forms .= "	".$dfm._BR_;
		$dfm = basenameNoExt($dfm);
		$form = myUtils::$forms[strtolower($dfm)];
		$comList = $form->componentList;
		foreach( (array)$comList as $obj )
		{
			if(!is_a($obj,"TSizeCtrl"))
			{
				$Forms .= "		".$obj->name."({$obj->self})"._BR_;
			}
		}
	}
	unset($dfm, $form, $comList);
	
	if( $Forms !== null )
	{
		$text .= t("Forms")._BR_;
		$text .= $Forms;
	}
		
	$Scripts = findFiles($dir."/scripts/", "php");
	if( !empty($Scripts) )
	{
		$text .= t("Scripts")._BR_;
		foreach($Scripts as $file)
			$text .= "	".$file._BR_;
	}	
	$Modules = $GLOBALS['myProject']->config['modules'];
	if( !empty($Modules) )
	{
		$text .= t("Exts")._BR_;
		foreach( $Modules as $file )
			$text.= "	".$file._BR_;
	}
	
	$tree->text = $text;
	$tree->fullExpand();
	unset($tree, $dir, $dirs, $Forms, $Scripts, $Modules);
}

dsApi::addProjectChangeCallback('treeBwr_add');
