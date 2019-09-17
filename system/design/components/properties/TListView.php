<?
global $_c;
$_c->setConstList(array('vsIcon', 'vsSmallIcon', 'vsList', 'vsReport'),0);
$_c->setConstList(array('bkNone', 'bkTile', 'bkSoft', 'bkFlat'),0);
    
$result = [];

$result[] = array(
                  'CAPTION'=>t('Align'),
                  'TYPE'=>'combo',
                  'PROP'=>'align',
                  'VALUES'=>$_c->s('TAlign'),
  				  'ADD_GROUP'=>true
				  );
				  
$result[] = array(
                  'CAPTION'=>t('Action'),
                  'TYPE'=>'',
                  'PROP'=>'Action',
				  );

_addfont($result);

$result[] = array(
                  'CAPTION'=>t('Color'),
                  'TYPE'=>'color',
                  'PROP'=>'color',
                  );

$result[] = array(
                  'CAPTION'=>t('Ctl3D'),
                  'TYPE'=>'check',
                  'PROP'=>'ctl3D',
                  );

$result[] = array(
                  'CAPTION'=>t('Bevel Inner'),
                  'TYPE'=>'combo',
                  'PROP'=>'bevelInner',
                  'VALUES'=>array('bvNone', 'bvLowered', 'bvRaised', 'bvSpace'),
                  );
$result[] = array(
                  'CAPTION'=>t('Bevel Kind'),
                  'TYPE'=>'combo',
                  'PROP'=>'bevelKind',
                  'VALUES'=>array('bkNone', 'bkTile', 'bkSoft', 'bkFlat'),
                  );

$result[] = array(
                  'CAPTION'=>t('Bevel Outer'),
                  'TYPE'=>'combo',
                  'PROP'=>'bevelOuter',
                  'VALUES'=>array('bvNone', 'bvLowered', 'bvRaised', 'bvSpace'),
                  );
$result[] = array(
                  'CAPTION'=>t('Border Style'),
                  'TYPE'=>'combo',
                  'PROP'=>'borderStyle',
                  'VALUES'=>array('bsNone', 'bsSingle'),
                  );
$result[] = array(
                  'CAPTION'=>t('Bevel Width'),
                  'TYPE'=>'number',
                  'PROP'=>'bevelWidth',
                  );
$result[] = array(
                  'CAPTION'=>t('Color'),
                  'TYPE'=>'color',
                  'PROP'=>'color',
                  );
$result[] = array(
                  'CAPTION'=>t('Column Click'),
                  'TYPE'=>'check',
                  'PROP'=>'columnClick',
                  );
$result[] = array(
                  'CAPTION'=>t('Columns'),
                  'TYPE'=>'list_columns',
                  'PROP'=>'columns',
                  );

$result[] = array(
                  'CAPTION'=>t('Check Boxes'),
                  'TYPE'=>'check',
                  'PROP'=>'checkBoxes',
                  );

$result[] = array(
                  'CAPTION'=>t('Flat Scroll Bars'),
                  'TYPE'=>'check',
                  'PROP'=>'flatScrollBars',
                  );
$result[] = array(
                  'CAPTION'=>t('FullDrag'),
                  'TYPE'=>'check',
                  'PROP'=>'fullDrag',
                  );
$result[] = array(
                  'CAPTION'=>t('Grid Lines'),
                  'TYPE'=>'check',
                  'PROP'=>'gridLines',
                  );
$result[] = array(
                  'CAPTION'=>t('Hide Selection'),
                  'TYPE'=>'check',
                  'PROP'=>'hideSelection',
                  );
$result[] = array(
                  'CAPTION'=>t('Hot Track'),
                  'TYPE'=>'check',
                  'PROP'=>'hotTrack',
                  );
$result[] = array(
                  'CAPTION'=>t('Hot Track Styles'),
                  'TYPE'=>'text',
                  'PROP'=>'hotTrackStyles',
                  );
$result[] = array(
                  'CAPTION'=>t('Hover Time'),
                  'TYPE'=>'number',
                  'PROP'=>'hoverTime',
                  );
$result[] = array(
                  'CAPTION'=>t('Icon Arrangament'),
                  'TYPE'=>'combo',
                  'PROP'=>'iar',
				  'VALUES'=>$_c->s('TIconArrangement'),
                  );
$result[] = array(
                  'CAPTION'=>t('Text Wrap'),
                  'TYPE'=>'check',
                  'PROP'=>'textwrap',
                  );
$result[] = array('CAPTION'=>t('Items'), 'TYPE'=>'list_items', 'PROP'=>'Items');
$result[] = array('CAPTION'=>t('Large images'), 'TYPE'=>'', 'PROP'=>'LargeImages');
$result[] = array(
                  'CAPTION'=>t('Owner Data'),
                  'TYPE'=>'check',
                  'PROP'=>'ownerData',
                  );
$result[] = array(
                  'CAPTION'=>t('Owner Draw'),
                  'TYPE'=>'check',
                  'PROP'=>'ownerDraw',
                  );
$result[] = array(
                  'CAPTION'=>t('Icon Auto Arrange'),
                  'TYPE'=>'check',
                  'PROP'=>'autoar',
                  );
$result[] = array(
                  'CAPTION'=>t('Multi Select'),
                  'TYPE'=>'check',
                  'PROP'=>'multiSelect',
                  );
$result[] = array(
                  'CAPTION'=>t('Parent Color'),
                  'TYPE'=>'check',
                  'PROP'=>'parentColor',
                  );
$result[] = array(
                  'CAPTION'=>t('Parent Font'),
                  'TYPE'=>'check',
                  'PROP'=>'parentFont',
                  );
$result[] = array(
                  'CAPTION'=>t('Read Only'),
                  'TYPE'=>'check',
                  'PROP'=>'readOnly',
                  );
$result[] = array(
                  'CAPTION'=>t('Row Select'),
                  'TYPE'=>'check',
                  'PROP'=>'rowSelect',
                  );
$result[] = array(
                  'CAPTION'=>t('Show Column Headers'),
                  'TYPE'=>'check',
                  'PROP'=>'showColumnHeaders',
                  );
$result[] = array(
                  'CAPTION'=>t('Show Work Areas'),
                  'TYPE'=>'check',
                  'PROP'=>'showWorkAreas',
                  );
$result[] = array('CAPTION'=>t('Small Images'), 'TYPE'=>'', 'PROP'=>'smallImages');
$result[] = array(
                  'CAPTION'=>t('Sort Type'),
                  'TYPE'=>'combo',
                  'PROP'=>'sortType',
				  'VALUES'=>array('stBoth', 'stData', 'stNone', 'stText'),
                  );
$result[] = array('CAPTION'=>t('State Images'), 'TYPE'=>'', 'PROP'=>'stateImages');
$result[] = array(
                  'CAPTION'=>t('View Style'),
                  'TYPE'=>'combo',
                  'PROP'=>'viewStyle',
                  'VALUES'=>array('vsIcon', 'vsSmallIcon', 'vsList', 'vsReport'),
                  );
$result[] = array(
                  'CAPTION'=>t('Parent Show Hint'),
                  'TYPE'=>'check',
                  'PROP'=>'parentShowHint',
                  );
$result[] = array(
                  'CAPTION'=>t('Show Hint'),
                  'TYPE'=>'check',
                  'PROP'=>'showHint',
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