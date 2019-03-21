<?$r = []; 
$r[] =	[
			'TYPE'=>'INPUT_DLG',
			'CAPTION'=>t('Form'),
			'USE_QUOTE'=>false,
		];
$r[] =	[
			'TYPE'=>'COMBO',
			'CAPTION'=>t('Mode'),
			'VALUES'=>['LD_NONE',
						'LD_XY',
						'LD_XYWH'],
			'QUOTE_PARAMS'=>false,
		];
return $r;
