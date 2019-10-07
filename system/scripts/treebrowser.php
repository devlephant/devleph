<?
DevS\cache::c("fmMain->TreeProject")->onDblClick = create_function('$self', 'global $projectFile;
$self = DevS\cache::c("fmMain->TreeProject");
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

DevS\cache::c("fmMain->TreeProject")->onClick = create_function('$self','global $_FORMS, $formSelected, $_sc;
$self = DevS\cache::c("fmMain->TreeProject");
$arr_self = $self->__arrObjSelf;
$obj_self = $arr_self[$self->absIndex];
if(!empty($obj_self))
{
	if( is_array($obj_self) or !is_object(c($obj_self))){
		if(!empty($obj_self["self"])){
			global $myEvents;
			$_sc->clearTargets();
			$_sc->addTarget(c($obj_self["self"]));
			$myEvents->_generate(c($obj_self["self"]));
			DevS\cache::c("fmPropsAndEvents->eventList")->itemIndex = $obj_self["event_index"];
			myEvents::phpEditorShow(nil);
			return;
		}
		return;
	}
	foreach( myUtils::$forms as $name=>$form ){
		if( $form->self == c($obj_self)->owner ){
			if( strtolower($_FORMS[$formSelected]) == $name )
			{
				$_sc->clearTargets();
				$_sc->addTarget(c($obj_self));
			} else {
				myUtils::loadForm($name);
				$_sc->clearTargets();
				$_sc->addTarget(c($obj_self));
			}
		}
	}
}');