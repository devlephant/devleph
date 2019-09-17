<?

$result = [];


$result[] = array(
                  'CAPTION'=>t('Align'),
                  'TYPE'=>'combo',
                  'PROP'=>'align',
                  'VALUES'=>$_c->s('TAlign'),
                   'ADD_GROUP'=>true
                  );

$result[] = array(
                  'CAPTION'=>t('Picture'),
                  'TYPE'=>'image',
                  'PROP'=>'picture',
                  'CLASS'=>'TPicture',
                  );
$result[] = array(
                  'CAPTION'=>t('Auto Size'),
                  'TYPE'=>'check',
                  'PROP'=>'autoSize',
                  );
$result[] = array(
                  'CAPTION'=>t('Center'),
                  'TYPE'=>'check',
                  'PROP'=>'center',
                  );
$result[] = array(
                  'CAPTION'=>t('Mosaic'),
                  'TYPE'=>'check',
                  'PROP'=>'mosaic',
                  );
$result[] = array(
                  'CAPTION'=>t('Proportional'),
                  'TYPE'=>'check',
                  'PROP'=>'proportional',
                  );
$result[] = array(
                  'CAPTION'=>t('Stretch'),
                  'TYPE'=>'check',
                  'PROP'=>'stretch',
                  );
$result[] = array(
                  'CAPTION'=>t('transparent'),
                  'TYPE'=>'check',
                  'PROP'=>'transparent',
                  );

$result[] = array(
                  'CAPTION'=>t('Hint'),
                  'TYPE'=>'text',
                  'PROP'=>'hint',
                  );

$result[] = array(
                  'CAPTION'=>t('Cursor'),
                  'TYPE'=>'combo',
                  'PROP'=>'cursor',
                  'VALUES'=>$GLOBALS['cursors_meta'],
				  'NO_CONST'=>true,
                  'ADD_GROUP'=>true,
                  );

$result[] = array(
                  'CAPTION'=>t('Sizes and position'),
                  'TYPE'=>'sizes',
                  'PROP'=>'',
                  'ADD_GROUP'=>true,
                  );

$result[] = array(
                  'CAPTION'=>t('Enabled'),
                  'TYPE'=>'check',
                  'PROP'=>'aenabled',
                  'REAL_PROP'=>'enabled',
                  'ADD_GROUP'=>true,
                  );

$result[] = array(
                  'CAPTION'=>t('visible'),
                  'TYPE'=>'check',
                  'PROP'=>'avisible',
                  'REAL_PROP'=>'visible',
                  'ADD_GROUP'=>true,
                  );


return $result;