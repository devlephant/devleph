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
                  'CAPTION'=>t('Auto Size'),
                  'TYPE'=>'check',
                  'PROP'=>'autoSize',
                  );
$result[] = array(
                  'CAPTION'=>t('Locked'),
                  'TYPE'=>'check',
                  'PROP'=>'Locked',
                  );
$result[] = array(
                  'CAPTION'=>t('Focused'),
                  'TYPE'=>'check',
                  'PROP'=>'Focused',
                  );
$result[] = array(
                  'CAPTION'=>t('Dock Site'),
                  'TYPE'=>'check',
                  'PROP'=>'dockSite',
                  );
$result[] = array(
                  'CAPTION'=>t('Full Repaint'),
                  'TYPE'=>'check',
                  'PROP'=>'fullRepaint',
                  );
				  
$result[] = array(
                  'CAPTION'=>t('Hint'),
                  'TYPE'=>'text',
                  'PROP'=>'hint',
                  );
$result[] = array(
                  'CAPTION'=>t('Show Hint'),
                  'TYPE'=>'check',
                  'PROP'=>'showHint',
                  );
				  
$result[] = array(
                  'CAPTION'=>t('Parent Hint'),
                  'TYPE'=>'check',
                  'PROP'=>'parentCustomHint',
                  );
$result[] = array(
                  'CAPTION'=>t('Parent Show Hint'),
                  'TYPE'=>'check',
                  'PROP'=>'parentShowHint',
                  );
$result[] = array(
                  'CAPTION'=>t('Parent Font'),
                  'TYPE'=>'check',
                  'PROP'=>'parentFont',
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

$result[] = array('CAPTION'=>t('Dock  List'), 'PROP'=>'dockList');
$result[] = array('CAPTION'=>t('Dock  Client Count'), 'PROP'=>'dockClientCount');
$result[] = array('CAPTION'=>t('Dock  Orientation'), 'PROP'=>'dockOrientation');
return $result;