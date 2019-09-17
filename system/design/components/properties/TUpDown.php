<?

$result = [];

$result[] = array(
                  'CAPTION'=>t('Associate'),
                  'TYPE'=>'',
                  'PROP'=>'Associate',
                  );

$result[] = array(
                  'CAPTION'=>t('Arrow Keys'),
                  'TYPE'=>'check',
                  'PROP'=>'ArrowKeys',
                  );

$result[] = array(
                  'CAPTION'=>t('Orientation'),
                  'TYPE'=>'combo',
                  'PROP'=>'orientation',
                  'VALUES'=>array('udHorizontal', 'udVertical'),
                  );
				  
$result[] = array(
                  'CAPTION'=>t('Ctl3D'),
                  'TYPE'=>'check',
                  'PROP'=>'ctl3D',
                  );
$result[] = array(
                  'CAPTION'=>t('Increment'),
                  'TYPE'=>'number',
                  'PROP'=>'Increment',
                  );
$result[] = array(
                  'CAPTION'=>t('Minimum'),
                  'TYPE'=>'number',
                  'PROP'=>'min',
                  );

$result[] = array(
                  'CAPTION'=>t('Maximum'),
                  'TYPE'=>'number',
                  'PROP'=>'max',
                  );

$result[] = array(
                  'CAPTION'=>t('Position'),
                  'TYPE'=>'number',
                  'PROP'=>'position',
                  );
$result[] = array(
                  'CAPTION'=>t('Thousands'),
                  'TYPE'=>'check',
                  'PROP'=>'Thousands',
                  );
$result[] = array(
                  'CAPTION'=>t('Wrap'),
                  'TYPE'=>'check',
                  'PROP'=>'Wrap',
                  );

$result[] = array(
                  'CAPTION'=>t('Hint'),
                  'TYPE'=>'text',
                  'PROP'=>'hint',
                  );
$result[] = array(
                  'CAPTION'=>t('Tab Order'),
                  'TYPE'=>'number',
                  'PROP'=>'tabOrder',
                  );
$result[] = array(
                  'CAPTION'=>t('Tab Stop'),
                  'TYPE'=>'check',
                  'PROP'=>'tabStop',
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