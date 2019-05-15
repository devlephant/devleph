<?
function treeBwr_add()
{	
	global $projectFile;
	
	$dir = dirname($projectFile);
	$tree = c('fmMain->TreeProject');
	
	$tree->text = "";
	
	$files = findFiles($dir."/scripts/", "php");
	foreach( $files as $file ){$Scripts .= "	".$file._BR_;}
	
	$dirs = findFiles($dir, "dfm");
	foreach( $dirs as $dfm ){$Forms .= "	".$dfm._BR_;}
	
	$extdir = findFiles($dir."/ext/", "dll");
	foreach( $extdir as $ext ){$Exts .= "	".$ext._BR_;}
	
	if( $Forms != null )
		{
			$text .= t("Forms")._BR_;
			$text .= $Forms;
		}
	if( $Scripts != null )
		{
			$text .= t("Scripts")._BR_;
			$text .= $Scripts;
		}	
	if( $Exts != null )
		{
			$text .= t("Exts")._BR_;
			$text .= $Exts;
		}
	
	$tree->text = $text;
	$tree->fullExpand();
}

dsApi::addProjectChangeCallback('treeBwr_add');