<?

$r = [];

$r[] =	[
			'TYPE'=>'INPUT_DLG',
			'CAPTION'=>t('Text message'),
			'USE_QUOTE'=>true,
		];
$r[] =	[
			'TYPE'=>'COMBO',
			'CAPTION'=>t('Dialog type'),             
			'VALUES'=>['mtWarning', 'mtError', 'mtInformation', 'mtConfirmation', 'mtCustom'],
		];
$r[] =	[
			'TYPE'=>'COMBO',
			'CAPTION'=>t('Buttons'),             
			'VALUES'=>['MB_OK', 'MB_OKCANCEL', 'MB_ABORTRETRYIGNORE', 'MB_YESNOCANCEL', 'MB_YESNO', 'MB_RETRYCANCEL', 'MB_ICONHAND', 'MB_ICONQUESTION', 'MB_ICONEXCLAMATION', 'MB_ICONASTERISK', 'MB_USERICON', 'MB_ICONWARNING','MB_ICONERROR','MB_ICONINFORMATION', 'MB_ICONSTOP', 'MB_APPLMODAL', 'MB_SYSTEMMODAL', 'MB_TASKMODAL', 'MB_HELP'],
		];
return $r;
