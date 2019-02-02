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
                  'CAPTION'=>t('Change Delay'),
                  'TYPE'=>'number',
                  'PROP'=>'changeDelay',
                  );
$result[] = array(
                  'CAPTION'=>t('Text'),
                  'TYPE'=>'text',
                  'PROP'=>'text',
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
                  'CAPTION'=>t('Auto Expand'),
                  'TYPE'=>'check',
                  'PROP'=>'autoExpand',
                  );
$result[] = array(
                  'CAPTION'=>t('Hide Selection'),
                  'TYPE'=>'check',
                  'PROP'=>'hideSelection',
                  );
$result[] = array('CAPTION'=>t('Images'), 'TYPE'=>'', 'PROP'=>'Images');
$result[] = array(
                  'CAPTION'=>t('Indent'),
                  'TYPE'=>'number',
                  'PROP'=>'Indent',
                  );
$result[] = array(
                  'CAPTION'=>t('Items'),
                  'TYPE'=>'tree_nodes',
                  'PROP'=>'Items',
                  );
$result[] = array(
                  'CAPTION'=>t('Multi Select'),
                  'TYPE'=>'check',
                  'PROP'=>'multiSelect',
                  );
$result[] = array(
                  'CAPTION'=>t('Multi Select Style'),
                  'TYPE'=>'text',
                  'PROP'=>'multiSelectStyle',
                  );
$result[] = array(
                  'CAPTION'=>t('Hot Track'),
                  'TYPE'=>'check',
                  'PROP'=>'hotTrack',
                  );
$result[] = array(
                  'CAPTION'=>t('Right Click Select'),
                  'TYPE'=>'check',
                  'PROP'=>'rightClickSelect',
                  );
$result[] = array(
                  'CAPTION'=>t('Row Select'),
                  'TYPE'=>'check',
                  'PROP'=>'rowSelect',
                  );
$result[] = array(
                  'CAPTION'=>t('Read Only'),
                  'TYPE'=>'check',
                  'PROP'=>'readOnly',
                  );
$result[] = array(
                  'CAPTION'=>t('Show Buttons'),
                  'TYPE'=>'check',
                  'PROP'=>'showButtons',
                  );
$result[] = array(
                  'CAPTION'=>t('Show Hint'),
                  'TYPE'=>'check',
                  'PROP'=>'showHint',
                  );
$result[] = array(
                  'CAPTION'=>t('Show Lines'),
                  'TYPE'=>'check',
                  'PROP'=>'showLines',
                  );
$result[] = array(
                  'CAPTION'=>t('Show Root'),
                  'TYPE'=>'check',
                  'PROP'=>'showRoot',
                  );
$result[] = array(
                  'CAPTION'=>t('Sort Type'),
                  'TYPE'=>'combo',
                  'PROP'=>'sortType',
				  'VALUES'=>array('stBoth', 'stData', 'stNone', 'stText'),
                  );
$result[] = array('CAPTION'=>t('StateImages'), 'TYPE'=>'', 'PROP'=>'StateImages');
$result[] = array(
                  'CAPTION'=>t('Tooltips'),
                  'TYPE'=>'check',
                  'PROP'=>'toolTips',
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

$result[] = array(
                  'CAPTION'=>t('Item Selected'),
                  'TYPE'=>'',
                  'PROP'=>'itemSelected',
                  );

$result[] = array(
                  'CAPTION'=>t('Absolute Index'),
                  'TYPE'=>'',
                  'PROP'=>'absIndex',
                  );
return $result;