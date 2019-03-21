<?
$r = [];
$r[] =	[
			'TYPE'=>'VARS',
			'CAPTION'=>t('Buffer var'),
			'USE_QUOTE'=>false,
		];
$r[] =	[
			'TYPE'=>'OBJECTS',
			'CAPTION'=>t('Dialog object'),
			'USE_QUOTE'=>false,
			'CLASSES'=>['TOpenDialogEx','TSaveDialogEx','TDirDialog','TFontDialogEx','TColorDialogEx']
		];
return $r;
