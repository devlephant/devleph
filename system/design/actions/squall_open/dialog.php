<?

$r = [];

$r[] =	[
			'TYPE'=>'OBJECTS',
			'CAPTION'=>t('SQUALL Player'),
			'CLASSES'=>['TSQUALLPlayer'],
			'USE_QUOTE'=>false,
		];
$r[] =	[
			'TYPE'=>'INPUT_DLG',
			'CAPTION'=>t('File name'),
			'USE_QUOTE'=>true,
		];
return $r;