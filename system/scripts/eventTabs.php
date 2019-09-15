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