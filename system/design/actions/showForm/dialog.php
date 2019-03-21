<?$r = []; 
$r[] =	[
			'TYPE'=>'INPUT_DLG',
			'CAPTION'=>t('Form'),
			'USE_QUOTE'=>false,
		];
$r[] =	[
			'TYPE'=>'COMBO',
			'CAPTION'=>t('Mode'),
			'VALUES'=>
					[
						'SW_SHOW',
						'SW_SHOWMODAL'
					],
		];
return $r;