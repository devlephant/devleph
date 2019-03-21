<?

$r = [];

$r[] =	[
			'TYPE'=>'INPUT_DLG',
			'CAPTION'=>t('Section'),
			'USE_QUOTE'=>true,
		];
$r[] =	[
			'TYPE'=>'INPUT_DLG',
			'CAPTION'=>t('Key'),
			'USE_QUOTE'=>true,
		];
$r[] =	[
			'TYPE'=>'VARS',
			'CAPTION'=>t('Variable'),
			'USE_QUOTE'=>false,
		];
return $r;
