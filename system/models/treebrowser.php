<?
function treeBwr_add()
{	
	global $projectFile;
	
	$dir = dirname($projectFile);
	$tree = c('fmMain->TreeProject');
	
	$imglist = new TImageList;
	$tree->text = "";
	$Forms = "";
	$text = "";
	gui_propSet($tree->self, 'Images', null);
	$dirs = findFiles($dir, "dfm");
	//$imglist->addFromFile(DOC_ROOT . '/design/24bit/formlist.bmp');
	foreach( (array)$dirs as $dfm )
	{
		$Forms .= '	' . $dfm . PHP_EOL;
		//$imglist->addFromFile(DOC_ROOT . '/design/24bit/form.bmp');
		$form = (object)myUtils::$forms[strtolower(basenameNoExt($dfm))];
		$comList = $form->componentList;
		foreach( (array)$comList as $obj )
		{
			if(!is_a($obj,"TSizeCtrl"))
			{
				$imglist->addFromFile(DOC_ROOT . '/design/24bit/' . get_class($obj) . '.bmp');
				$Forms .= "		".$obj->name."(".get_class($obj).")"._BR_;
			}
		}
	}
	unset($form, $comList);
	
	if( $Forms !== "" )
	{
		$text .= t("Forms")._BR_;
		$text .= $Forms;
	}
		
	$Scripts = findFiles($dir."/scripts/", "php");
	if( !empty($Scripts) )
	{
		$text .= t("Scripts")._BR_;
		foreach((array)$Scripts as $file)
			$text .= "	".$file._BR_;
	}	
	$Modules = $GLOBALS['myProject']->config['modules'];
	if( !empty($Modules) )
	{
		$text .= t("Exts")._BR_;
		foreach( (array)$Modules as $file )
			$text.= "	".$file._BR_;
	}
	
	$tree->text = $text;
	$tree->Images = $imglist;
	$tree->fullExpand();
	unset($tree, $dir, $dirs, $Forms, $Scripts, $Modules, $imglist);
}

dsApi::addProjectChangeCallback('treeBwr_add');
