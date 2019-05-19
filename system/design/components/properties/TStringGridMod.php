<?

$result = [];

$result[] = array(
                  'CAPTION'=>t('Align'),
                  'TYPE'=>'combo',
                  'PROP'=>'align',
                  'VALUES'=>$GLOBALS['_c']->s('TAlign'),
                  );
_addfont($result);
$result[] = array(
                  'CAPTION'=>t('Border Style'),
                  'TYPE'=>'combo',
                  'PROP'=>'borderStyle',
                  'VALUES'=>array('bsNone', 'bsSingle'),
                  );
$result[] = array(
                  'CAPTION'=>t('Ctl3D'),
                  'TYPE'=>'check',
                  'PROP'=>'ctl3D',
                  );
$result[] = array(
                  'CAPTION'=>t('Col Count'),
                  'TYPE'=>'number',
                  'PROP'=>'colCount',
                  );
$result[] = array(
                  'CAPTION'=>t('Row Count'),
                  'TYPE'=>'number',
                  'PROP'=>'rowCount',
                  );

$result[] = array(
                  'CAPTION'=>t('Color'),
                  'TYPE'=>'color',
                  'PROP'=>'color',
                  );

$result[] = array(
                  'CAPTION'=>t('Default Col Width'),
                  'TYPE'=>'number',
                  'PROP'=>'defaultColWidth',
                  );

$result[] = array(
                  'CAPTION'=>t('Default Row Height'),
                  'TYPE'=>'number',
                  'PROP'=>'defaultRowHeight',
                  );

$result[] = array(
                  'CAPTION'=>t('Fixed Color'),
                  'TYPE'=>'color',
                  'PROP'=>'fixedColor',
                  );

$result[] = array(
                  'CAPTION'=>t('Fixed Cols'),
                  'TYPE'=>'number',
                  'PROP'=>'fixedCols',
                  );

$result[] = array(
                  'CAPTION'=>t('Fixed Rows'),
                  'TYPE'=>'number',
                  'PROP'=>'fixedRows',
                  );

$result[] = array(
                  'CAPTION'=>t('Grid Line Width'),
                  'TYPE'=>'number',
                  'PROP'=>'gridLineWidth',
                  );
$result[] = array(
                  'CAPTION'=>t('Scroll Bars'),
                  'TYPE'=>'combo',
                  'PROP'=>'scrollBars',
                  'VALUES'=>array('ssNone', 'ssHorizontal', 'ssVertical', 'ssBoth'),
                  );
$result[] = array(
                  'CAPTION'=>t('Row Select'),
                  'TYPE'=>'check',
                  'PROP'=>'rowSelect',
                  );
$result[] = array(
                  'CAPTION'=>t('Focus Selected'),
                  'TYPE'=>'check',
                  'PROP'=>'focusSelected',
                  );
$result[] = array(
                  'CAPTION'=>t('Editing'),
                  'TYPE'=>'check',
                  'PROP'=>'editing',
                  );
$result[] = array(
                  'CAPTION'=>t('Row Sizing'),
                  'TYPE'=>'check',
                  'PROP'=>'rowSizing',
                  );
$result[] = array(
                  'CAPTION'=>t('Col Sizing'),
                  'TYPE'=>'check',
                  'PROP'=>'colSizing',
                  );
$result[] = array(
                  'CAPTION'=>t('Row Moving'),
                  'TYPE'=>'check',
                  'PROP'=>'rowMoving',
                  );
$result[] = array(
                  'CAPTION'=>t('Col Moving'),
                  'TYPE'=>'check',
                  'PROP'=>'colMoving',
                  );
$result[] = array(
                  'CAPTION'=>t('Tabs'),
                  'TYPE'=>'check',
                  'PROP'=>'tabs',
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