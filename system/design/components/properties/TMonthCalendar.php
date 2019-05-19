<?

$result = [];
$result[] = array(
                  'CAPTION'=>t('Align'),
                  'TYPE'=>'combo',
                  'PROP'=>'align',
                  'VALUES'=>$GLOBALS['_c']->s('TAlign'),
                  );
$result[] = array(
                  'CAPTION'=>t('Auto Size'),
                  'TYPE'=>'check',
                  'PROP'=>'autoSize',
                  );
$result[] = array(
                  'CAPTION'=>t('Date'),
                  'TYPE'=>'date',
                  'PROP'=>'date',
                  );
$result[] = array(
                  'CAPTION'=>t('End Date'),
                  'TYPE'=>'date',
                  'PROP'=>'endDate',
                  );
$result[] = array(
                  'CAPTION'=>t('Max Date'),
                  'TYPE'=>'date',
                  'PROP'=>'maxDate',
                  );
$result[] = array(
                  'CAPTION'=>t('Min Date'),
                  'TYPE'=>'date',
                  'PROP'=>'minDate',
                  );
$result[] = array(
                  'CAPTION'=>t('Max Select Range'),
                  'TYPE'=>'number',
                  'PROP'=>'maxSelectRange',
                  );
$result[] = array(
                  'CAPTION'=>t('Multi Select'),
                  'TYPE'=>'check',
                  'PROP'=>'multiSelect',
                  );
$result[] = array(
                  'CAPTION'=>t('Show Today'),
                  'TYPE'=>'check',
                  'PROP'=>'showtoday',
                  );
$result[] = array(
                  'CAPTION'=>t('Show Today Circle'),
                  'TYPE'=>'check',
                  'PROP'=>'showtodaycircle',
                  );
$result[] = array(
                  'CAPTION'=>t('Week Numbers'),
                  'TYPE'=>'check',
                  'PROP'=>'WeekNumbers',
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