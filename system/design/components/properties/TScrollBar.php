<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('Align'),
                  'TYPE'=>'combo',
                  'PROP'=>'align',
                  'VALUES'=>array('alNone', 'alTop', 'alBottom', 'alLeft', 'alRight', 'alClient', 'alCustom'),
                   'ADD_GROUP'=>true
                  );

$result[] = array(
                  'CAPTION'=>t('Ctl3D'),
                  'TYPE'=>'check',
                  'PROP'=>'ctl3D',
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
                  'CAPTION'=>t('Page Size'),
                  'TYPE'=>'number',
                  'PROP'=>'pageSize',
                  );
$result[] = array(
                  'CAPTION'=>t('Small Change'),
                  'TYPE'=>'number',
                  'PROP'=>'smallChange',
                  );
$result[] = array(
                  'CAPTION'=>t('Kind'),
                  'TYPE'=>'combo',
                  'PROP'=>'kind',
                  'VALUES'=>array('sbHorizontal', 'sbVertical'),
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

$result[] = array('CAPTION'=>t('p_Left'), 'PROP'=>'x','TYPE'=>'number','ADD_GROUP'=>true);
$result[] = array('CAPTION'=>t('p_Top'), 'PROP'=>'y','TYPE'=>'number','ADD_GROUP'=>true);
$result[] = array('CAPTION'=>t('Width'), 'PROP'=>'w','TYPE'=>'number','ADD_GROUP'=>true);
$result[] = array('CAPTION'=>t('Height'), 'PROP'=>'h','TYPE'=>'number','ADD_GROUP'=>true);
return $result;