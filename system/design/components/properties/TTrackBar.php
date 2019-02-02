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
                  'CAPTION'=>t('Frequency'),
                  'TYPE'=>'number',
                  'PROP'=>'frequency',
                  );

$result[] = array(
                  'CAPTION'=>t('Line Size'),
                  'TYPE'=>'number',
                  'PROP'=>'lineSize',
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
                  'CAPTION'=>t('Orientation'),
                  'TYPE'=>'combo',
                  'PROP'=>'Orientation',
                  'VALUES'=>array('trHorizontal', 'trVertical'),
                  );

$result[] = array(
                  'CAPTION'=>t('Sel Start'),
                  'TYPE'=>'',
                  'PROP'=>'selStart',
                  );

$result[] = array(
                  'CAPTION'=>t('Sel End'),
                  'TYPE'=>'',
                  'PROP'=>'selEnd',
                  );

$result[] = array(
                  'CAPTION'=>t('Slider Visible'),
                  'TYPE'=>'check',
                  'PROP'=>'sliderVisible',
                  );
				  
$result[] = array(
                  'CAPTION'=>t('Show Select Range'),
                  'TYPE'=>'check',
                  'PROP'=>'showSelRange',
                  );
				  
$result[] = array(
                  'CAPTION'=>t('ToolTip Position'),
                  'TYPE'=>'combo',
                  'PROP'=>'positionToolTip',
				  'VALUES'=>array('ptBottom', 'ptLeft', 'ptNone', 'ptRight', 'ptTop'),
                  );
				  
$result[] = array(
                  'CAPTION'=>t('Thumb Length'),
                  'TYPE'=>'number',
                  'PROP'=>'thumbLength',
                  );
$result[] = array(
                  'CAPTION'=>t('Tick Marks'),
                  'TYPE'=>'combo',
                  'PROP'=>'tickMarks',
                  'VALUES'=>array('tmBottomRight', 'tmTopLeft', 'tmBoth'),
                  );
$result[] = array(
                  'CAPTION'=>t('Ticks Style'),
                  'TYPE'=>'combo',
                  'PROP'=>'tickStyle',
                  'VALUES'=>array('tsNone', 'tsAuto', 'tsManual'),
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