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
	$icons_remover = ["onmousedown"=>"mousedown",
	"onmousemove"=>"mousemove",
	"onmouseup"=>"mouseup"];
	$dirs = findFiles($dir, "dfm");
	$imgindex[] = myImages::getImgID('forms');
	$cindex = 0;
	foreach( (array)$dirs as $dfm )
	{
		$Forms .= '	' . $dfm . PHP_EOL;
		$imgindex[] = myImages::getImgID('form');
		$expand[] = true;
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
				$events = eventEngine::listEventsEx($obj->name);
				$events_icon = eventEngine::listEvents($obj->name);
				$Forms .= "		".$obj->name._BR_;
				foreach($events as $i=>$event){
					$icon = strtolower($events_icon[$i]);
					$icon = !empty($icons_remover[$icon])?$icons_remover[$icon]: $icon;
					$icon = empty($icon)?"empty":$icon;
					$imgindex[] = myImages::getImgID( $icon );
					++$cindex;
					$arr_self[$cindex] = ["self"=>$obj->self, "event"=>$event, "event_index"=>$i];
					$Forms .= "			".$event._BR_;
				}
			}
		}
	}
	$name = "--fmedit";
	$events = eventEngine::listEventsEx($name);
	$events_icon = eventEngine::listEvents($name);
	if(!empty($events[0])){
		$imgindex[] = myImages::getImgID( "enter" );
		$expand[] = true;
		++$cindex;
		$Forms .= "	".t("Form Events")._BR_;
		foreach($events as $i=>$event){
			$icon = strtolower($events_icon[$i]);
			$icon = !empty($icons_remover[$icon])?$icons_remover[$icon]: $icon;
			$icon = empty($icon)?"empty":$icon;
			$imgindex[] = myImages::getImgID( $icon );
			++$cindex;
			$arr_self[$cindex] = ["self"=>c("fmEdit")->self, "event"=>$event, "event_index"=>$i];
			$Forms .= "		".$event._BR_;
		}
	}
	$tree->__arrObjSelf = $arr_self;
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
		$expand[] = true;
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
		$expand[] = true;
		foreach($Modules as $file ){
			$text.= "	".$file._BR_;
			$imgindex[] = myImages::getImgID('ext');
		}
	}
	
	$tree->text = $text;
	foreach($tree->items as $i=>$item){
		$item->Expanded = $expand[$i];
		$item->imageIndex = $imgindex[$i];
		$item->SelectedIndex = $imgindex[$i];
	}
	$tree->Images = c('MainImages24');
	$tree->items->EndUpdate();
	unset($tree, $dir, $dirs, $Forms, $Scripts, $Modules, $imglist, $no_multi_call);
}

dsApi::addProjectChangeCallback('treeBwr_add');
