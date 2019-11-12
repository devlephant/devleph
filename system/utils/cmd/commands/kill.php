<?
return [
'NAME'=>'kill',
'SLOTS'=>1,
'EVAL'=>'$task = $slots[1];
if( exists_task($task) ){ 
	kill_task($task);
	myCompile::setStatus(\'Info\', \'Killed \'.$task.\'...\');
}'];