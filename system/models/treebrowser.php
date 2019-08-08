<?
function treeBwr_add()
{	
	global $projectFile;
	
	$dir = dirname($projectFile);
	$tree = c('fmMain->TreeProject');
	
	$tree->items->BeginUpdate();
	$tree->text = "";
	$Forms = "";
	$text = "";
	$dirs = findFiles($dir, "dfm");
	$imgindex[] = myImages::getImgID('forms');
	$cindex = 0;
	foreach( (array)$dirs as $dfm )
	{
		$Forms .= '	' . $dfm . PHP_EOL;
		$imgindex[] = myImages::getImgID('form');
		++$cindex;
		$form = (object)myUtils::$forms[strtolower(basenameNoExt($dfm))];
		$comList = $form->componentList;
		foreach( (array)$comList as $obj )
		{
			if($obj->self	!==	$GLOBALS['_sc']->self&&$obj->name !== '')
			{
				$imgindex[] = myImages::getImgID(get_class($obj));
				++$cindex;
				$arr_self[$cindex] = $obj->self;
				$Forms .= "		".$obj->name._BR_;
			}
		}
		$tree->__arrObjSelf = $arr_self;
	}
	unset($form, $comList);
	
	if( $Forms !== "" )
	{
		$text .= t("Forms")._BR_;
		$text .= $Forms;
	}
		
	$Scripts = findFiles($dir."/scripts/", "php");
	if( !empty((array)$Scripts) )
	{
		$text .= t("Scripts")._BR_;
		$imgindex[] = myImages::getImgID('scripts');
		foreach($Scripts as $file){
			$text .= "	".$file._BR_;
			$imgindex[] = myImages::getImgID('script');
		}
	}	
	$Modules = $GLOBALS['myProject']->config['modules'];
	if( !empty((array)$Modules) )
	{
		$text .= t("Exts")._BR_;
		$imgindex[] = myImages::getImgID('exts');
		foreach($Modules as $file ){
			$text.= "	".$file._BR_;
			$imgindex[] = myImages::getImgID('ext');
		}
	}
	
	$tree->text = $text;
	$no_multi_call = $tree->items->item;
	foreach($no_multi_call as $i=>$item){
		$item->imageIndex = $imgindex[$i];
		$item->SelectedIndex = $imgindex[$i];
	}
	$tree->Images = c('MainImages24');
	$tree->fullExpand();
	$tree->items->EndUpdate();
	unset($tree, $dir, $dirs, $Forms, $Scripts, $Modules, $imglist, $no_multi_call);
}

dsApi::addProjectChangeCallback('treeBwr_add');
