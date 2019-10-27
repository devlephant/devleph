<?
function eventTabs_update(){
	global $myEvents, $_FORMS, $formSelected;
	eventEngine::setForm();
	$eventList = c('fmPropsAndEvents->eventList');
	$eventTabs = c('fmPHPEditor->eventTabs');
	$eventTabs->popupMenu = c('fmMain->edt_EventTypes->popupMenu');
	$php_memo = c('fmPHPEditor->memo');
	
	$name = $myEvents->selObj instanceof TForm ? '--fmedit' : $myEvents->selObj->name;
	$event  = $eventList->events[$eventList->itemIndex];
	$events = eventEngine::listEventsEx($name);
	$eventTabs->text = implode(PHP_EOL, $events);
	$eventTabs->addPage('+');
}

function eventTabs_show(){
		global $myEvents, $_FORMS, $formSelected;
		eventEngine::setForm();
		$eventList = c('fmPropsAndEvents->eventList');
		$eventTabs = c('fmPHPEditor->eventTabs');
		$eventTabs->popupMenu = c('fmMain->edt_EventTypes->popupMenu');
		$php_memo = c('fmPHPEditor->memo');
		
		$name = $myEvents->selObj instanceof TForm ? '--fmedit' : $myEvents->selObj->name;
		$event  = $eventList->events[$eventList->itemIndex];
		$events = eventEngine::listEventsEx($name);
		$eventTabs->text = implode(PHP_EOL, $events);
		$eventTabs->addPage('+');
		$eventTabs->last_index = $eventTabs->TabIndex = $eventList->itemIndex;
        
        $php_memo->text = eventEngine::getEvent($name, $event);
        $ltight = str_replace('{', '', str_ireplace('event ', '', CApi::getStringEventInfo($event, $myEvents->selObj->className) ) );
        $x_name = $myEvents->selObj->name == 'fmEdit' ? $_FORMS[$formSelected] : $myEvents->selObj->name;
        c('fmPHPEditor')->text = t('php_script_editor').' -> '.$x_name.'::'.$ltight;
}