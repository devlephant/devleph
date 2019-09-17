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
                  'CAPTION'=>t('Minimal size'),
                  'TYPE'=>'number',
                  'PROP'=>'minsize',
                  );

$result[] = array(
                  'CAPTION'=>t('Bevel Show'),
                  'TYPE'=>'check',
                  'PROP'=>'beveled',
                  );

$result[] = array(
                  'CAPTION'=>t('Auto Snap'),
                  'TYPE'=>'check',
                  'PROP'=>'autoSnap',
                  );

$result[] = array(
                  'CAPTION'=>t('Color'),
                  'TYPE'=>'color',
                  'PROP'=>'color',
                  );

$result[] = array(
                  'CAPTION'=>t('Parent Color'),
                  'TYPE'=>'check',
                  'PROP'=>'parentColor',
                  );

$result[] = array(
                  'CAPTION'=>t('Resize Style'),
                  'TYPE'=>'combo',
                  'PROP'=>'resizeStyle',
                  'VALUES'=>array('rsLine', 'rsNone', 'rsPattern', 'rsUpdate'),
                  'ADD_GROUP'=>true,
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
                  'CAPTION'=>t('Hint'),
                  'TYPE'=>'text',
                  'PROP'=>'hint',
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