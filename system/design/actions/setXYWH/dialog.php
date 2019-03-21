<?

$r = [];

$r[] =	[
			'TYPE'=>'INPUT_DLG',
			'CAPTION'=>t('Object'),
			'USE_QUOTE'=>false,
		];

$r[] =	[
			'TYPE'=>'COMBO',
			'CAPTION'=>t('Parameter'),
			'USE_QUOTE'=>true,
			'VALUES'=>['X','Y','W','H'],
		];

$r[] =	[
			'TYPE'=>'INPUT_DLG',
			'CAPTION'=>t('Value'),
			'USE_QUOTE'=>false,
		];

return $r;