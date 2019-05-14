<?
return array(
'GROUP'   => 'Buttons',
'CLASS'   => basenameNoExt(__FILE__),
'CAPTION' => t('TSBC_'),
'SORT'    => 3,
'NAME'    => 'Sbt',
'PROPS' => array('alignment'=>'taCenter', 'layout'=>'tlCenter'),
'REPLACE' => ['TFlatButton', 'TMultiButton', 'TSB', 'TAnButton'],
'REPLACE_RULE' =>
['tanbutton'=>
	[
		'props'=>
		['ColorOne'=>'OneColor','ColorTwo'=>'TwoColor','ColorThree'=>'ThreeColor'],
	],
'tsb'=>
	[
		'props'=>
		['ColorOne'=>'OneColor','ColorTwo'=>'TwoColor','ColorThree'=>'ThreeColor'],
	],
'tflatbutton'=>
	[
		'props'=>
		['ColorOne'=>'color', 'ColorTwo'=>'color', 'ColorThree'=>'newColor'],
	],
'tmultibutton'=>
	[
		'props'=>
		['ColorThree'=>'ColorTwo'],
	],
],
'W' => 20,
'H' => 5,
'penStyle' => psSolid,
);