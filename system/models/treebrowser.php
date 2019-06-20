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
		foreach( $form->componentList as $obj )
		{
			if(!is_a($obj,"TSizeCtrl"))
			{
				$Forms .= "		".$obj->name."({$obj->self})"._BR_;
			}
		}
	}
	
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
	if( !empty($GLOBALS['myProject']->config['modules']) )
	{
		$text .= t("Exts")._BR_;
		foreach( $GLOBALS['myProject']->config['modules'] as $file )
			$text.= "	".$file._BR_;
	}
	
	$tree->text = $text;
	$tree->fullExpand();
}

dsApi::addProjectChangeCallback('treeBwr_add');
