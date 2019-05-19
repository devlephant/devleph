<?

$result = [];



$result[] = array(
                  'CAPTION'=>t('Align'),
                  'TYPE'=>'combo',
                  'PROP'=>'align',
                  'VALUES'=>$GLOBALS['_c']->getSet('TAlign'),
                   'ADD_GROUP'=>true
                  );

$result[] = array(
                  'CAPTION'=>t('Color'),
                  'TYPE'=>'color',
                  'PROP'=>'brushColor',
                  );

$result[] = array(
                  'CAPTION'=>t('Brush Style'),
                  'TYPE'=>'combo',
                  'PROP'=>'brushStyle',
                  'VALUES'=>$GLOBALS['_c']->getSet('TBrushStyle')
                  );
$result[] = array(
                  'CAPTION'=>t('Pen Color'),
                  'TYPE'=>'color',
                  'PROP'=>'penColor',
                  );
$result[] = array(
                  'CAPTION'=>t('Pen Mode'),
                  'TYPE'=>'combo',
                  'PROP'=>'penMode',
                  'VALUES'=>$GLOBALS['_c']->getSet('TPenMode'),
                  );
$result[] = array(
                  'CAPTION'=>t('Pen Style'),
                  'TYPE'=>'combo',
                  'PROP'=>'penStyle',
                  'VALUES'=>$GLOBALS['_c']->getSet('TPenStyle'),
                  );
$result[] = array(
                  'CAPTION'=>t('Pen Width'),
                  'TYPE'=>'number',
                  'PROP'=>'penWidth',
                  );
$result[] = array(
                  'CAPTION'=>t('Shape'),
                  'TYPE'=>'combo',
                  'PROP'=>'shape',
                  'VALUES'=>$GLOBALS['_c']->getSet('TShapeType'),
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