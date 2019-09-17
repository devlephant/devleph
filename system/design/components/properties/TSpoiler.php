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
                  'CAPTION'=>t('Text'),
                  'TYPE'=>'text',
                  'PROP'=>'text',
                  );
$result[] = array(
                  'CAPTION'=>t('Wa Close'),
                  'TYPE'=>'text',
                  'PROP'=>'wClose',
                  );
$result[] = array(
                  'CAPTION'=>t('ha Close'),
                  'TYPE'=>'text',
                  'PROP'=>'hClose',
                  );
$result[] = array(
                  'CAPTION'=>t('Wa Open'),
                  'TYPE'=>'text',
                  'PROP'=>'wOpen',
                  );
$result[] = array(
                  'CAPTION'=>t('ha Open'),
                  'TYPE'=>'text',
                  'PROP'=>'hOpen',
                  );
_addfont($result);


$result[] = array(
                  'CAPTION'=>t('Color'),
                  'TYPE'=>'color',
                  'PROP'=>'color',
                  );
$result[] = array(
                  'CAPTION'=>t('Auto Size'),
                  'TYPE'=>'check',
                  'PROP'=>'autoSize',
                  );
$result[] = array(
                  'CAPTION'=>t('Align'),
                  'TYPE'=>'combo',
                  'PROP'=>'align',
                  'VALUES'=>$_c->s('TAlign'),
                  );
$result[] = array(
                  'CAPTION'=>t('Alignment').' 2',
                  'TYPE'=>'combo',
                  'PROP'=>'alignment',
                  'VALUES'=>array('taLeftJustify', 'taRightJustify', 'taCenter'),
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
                  'CAPTION'=>t('Border Style'),
                  'TYPE'=>'combo',
                  'PROP'=>'borderStyle',
                  'VALUES'=>array('bsNone', 'bsSingle'),
                  );
$result[] = array(
                  'CAPTION'=>t('Border Width'),
                  'TYPE'=>'number',
                  'PROP'=>'borderWidth',
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