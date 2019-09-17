<?

$result = [];

$result[] = array(
                  'CAPTION'=>t('Align'),
                  'TYPE'=>'combo',
                  'PROP'=>'align',
                  'VALUES'=>$_c->s('TAlign'),
                   'ADD_GROUP'=>true
                  );

_addfont($result);

$result[] = array(
                  'CAPTION'=>t('Color'),
                  'TYPE'=>'color',
                  'PROP'=>'color',
                  );
$result[] = array(
                  'CAPTION'=>t('Background Color'),
                  'TYPE'=>'color',
                  'PROP'=>'MonthBackColor',
                  );
$result[] = array(
                  'CAPTION'=>t('Text Color'),
                  'TYPE'=>'color',
                  'PROP'=>'TextColor',
                  );
$result[] = array(
                  'CAPTION'=>t('Title Background Color'),
                  'TYPE'=>'color',
                  'PROP'=>'TitleBackColor',
                  );	
$result[] = array(
                  'CAPTION'=>t('Title Text Color'),
                  'TYPE'=>'color',
                  'PROP'=>'TitleTextColor',
                  );
$result[] = array(
                  'CAPTION'=>t('Trailing Text Color'),
                  'TYPE'=>'color',
                  'PROP'=>'TrailingTextColor',
                  );				  
$result[] = array(
                  'CAPTION'=>t('Date'),
                  'TYPE'=>'text',
                  'PROP'=>'date',
                  );


$result[] = array(
                  'CAPTION'=>t('Date Format'),
                  'TYPE'=>'combo',
                  'PROP'=>'dateFormat',
                  'VALUES'=>array('dfShort','dfLong'),
                  );
$result[] = array(
                  'CAPTION'=>t('Date Mode'),
                  'TYPE'=>'combo',
                  'PROP'=>'dateMode',
                  'VALUES'=>array('dmComboBox','dmUpDown'),
                  );

$result[] = array(
                  'CAPTION'=>t('Format'),
                  'TYPE'=>'text',
                  'PROP'=>'format',
                  );
$result[] = array(
                  'CAPTION'=>t('Bevel Kind'),
                  'TYPE'=>'combo',
                  'PROP'=>'bevelKind',
                  'VALUES'=>array('bkNone', 'bkTile', 'bkSoft', 'bkFlat'),
                  );
$result[] = array(
                  'CAPTION'=>t('Bevel Inner'),
                  'TYPE'=>'combo',
                  'PROP'=>'bevelInner',
                  'VALUES'=>array('bvNone', 'bvLowered', 'bvRaised', 'bvSpace'),
                  );


$result[] = array(
                  'CAPTION'=>t('Bevel Outer'),
                  'TYPE'=>'combo',
                  'PROP'=>'bevelOuter',
                  'VALUES'=>array('bvNone', 'bvLowered', 'bvRaised', 'bvSpace'),
                  );
$result[] = array(
                  'CAPTION'=>t('Bevel Width'),
                  'TYPE'=>'number',
                  'PROP'=>'bevelWidth',
                  );
$result[] = array(
                  'CAPTION'=>t('Kind'),
                  'TYPE'=>'combo',
                  'PROP'=>'kind',
                  'VALUES'=>array('dtkDate','dtkTime'),
                  );
$result[] = array(
                  'CAPTION'=>t('Max Date'),
                  'TYPE'=>'text',
                  'PROP'=>'maxDate',
                  );
$result[] = array(
                  'CAPTION'=>t('Min Date'),
                  'TYPE'=>'text',
                  'PROP'=>'minDate',
                  );
$result[] = array(
                  'CAPTION'=>t('Show Checkbox'),
                  'TYPE'=>'check',
                  'PROP'=>'showCheckbox',
                  );
$result[] = array(
                  'CAPTION'=>t('Checked'),
                  'TYPE'=>'check',
                  'PROP'=>'Checked',
                  );
$result[] = array(
                  'CAPTION'=>t('Time'),
                  'TYPE'=>'text',
                  'PROP'=>'time',
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