<?
return [
'NAME' => 'restart',
'SLOTS'=>0,
'EVAL' => 'global $projectFile;
if (fileExt($projectFile)=="msppr"){
	evfmMain::saveMainConfig();
	shell_exec("cd ".dirname(EXE_NAME));
	shell_exec(\'Launcher.exe "\'.$projectFile.\'"\');
	app::close();
}'
];