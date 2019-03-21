<?$r = []; 
$r[] =	[
			'TYPE'=>'COMBO',
			'CAPTION'=>t('Section'),             
			'VALUES'=>
					[
						'HKEY_CLASSES_ROOT',
						'HKEY_CURRENT_USER',
						'HKEY_LOCAL_MACHINE',
						'HKEY_USERS',
						'HKEY_PERFORMANCE_DATA',
						'HKEY_CURRENT_CONFIG',
						'HKEY_DYN_DATA ',
					]
		];
$r[] =	[
			'TYPE'=>'INPUT_DLG',
			'CAPTION'=>t('Path'),
			'USE_QUOTE'=>true,
		];
$r[] =	[
			'TYPE'=>'INPUT_DLG',
			'CAPTION'=>t('Value'),
			'USE_QUOTE'=>true,
		];
$r[] =	[
			'TYPE'=>'COMBO',
			'CAPTION'=>t('Type'),
			'VALUES'=>
					[
						'STRING',
						'DATE_TIME',
						'BOOL',
						'DWORD',
						'CURRENCY'
					]
		];
return $r;