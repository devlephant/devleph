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
                  'CAPTION'=>t('Tabs'),
                  'TYPE'=>'text',
                  'PROP'=>'pagesList',
                  );
_addfont($result);
$result[] = array(
                  'CAPTION'=>t('Tab Position'),
                  'TYPE'=>'combo',
                  'PROP'=>'TabPosition',
                  'VALUES'=>array('tpTop', 'tpBottom'),
                   'ADD_GROUP'=>true
                  );

$result[] = array(
                  'CAPTION'=>t('Active Page'),
                  'TYPE'=>'',
                  'PROP'=>'activePage',
                  'CLASS'=>'TTabSheet',
                  );

$result[] = array(
                  'CAPTION'=>t('Page Index'),
                  'TYPE'=>'number',
                  'PROP'=>'pageIndex',
                  );
$result[] = array(
                  'CAPTION'=>t('Tab width'),
                  'TYPE'=>'number',
                  'PROP'=>'tabWidth',
                  );
$result[] = array(
                  'CAPTION'=>t('Tab height'),
                  'TYPE'=>'number',
                  'PROP'=>'tabHeight',
                  );
$result[] = array(
                  'CAPTION'=>t('Hot Track'),
                  'TYPE'=>'check',
                  'PROP'=>'hotTrack',
                  );
$result[] = array(
                  'CAPTION'=>t('MultiLine'),
                  'TYPE'=>'check',
                  'PROP'=>'MultiLine',
                  );
$result[] = array(
                  'CAPTION'=>t('Owner Draw'),
                  'TYPE'=>'check',
                  'PROP'=>'OwnerDraw',
                  );
$result[] = array(
                  'CAPTION'=>t('Ragged Right'),
                  'TYPE'=>'check',
                  'PROP'=>'RaggedRight',
                  );
$result[] = array(
                  'CAPTION'=>t('Scroll Opposite'),
                  'TYPE'=>'check',
                  'PROP'=>'ScrollOpposite',
                  );
$result[] = array(
                  'CAPTION'=>t('Style'),
                  'TYPE'=>'combo',
                  'PROP'=>'style',
                  'VALUES'=>array('tsTabs', 'tsButtons', 'tsFlatButtons'),
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

$result[] = array('CAPTION'=>t('p_Left'), 'PROP'=>'x','TYPE'=>'number','ADD_GROUP'=>1,'UPDATE_DSGN'=>1);
$result[] = array('CAPTION'=>t('p_Top'), 'PROP'=>'y','TYPE'=>'number','ADD_GROUP'=>1,'UPDATE_DSGN'=>1);
$result[] = array('CAPTION'=>t('Width'), 'PROP'=>'w','TYPE'=>'number','ADD_GROUP'=>1,'UPDATE_DSGN'=>1);
$result[] = array('CAPTION'=>t('Height'), 'PROP'=>'h','TYPE'=>'number','ADD_GROUP'=>1,'UPDATE_DSGN'=>1);
return $result;