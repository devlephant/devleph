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
                  'CAPTION'=>t('Checked Items'),
                  'TYPE'=>'',
                  'PROP'=>'checkedItems',
                  );

$result[] = array(
                  'CAPTION'=>t('List'),
                  'TYPE'=>'text',
                  'PROP'=>'text',
                  );
_addfont($result);


$result[] = array(
                  'CAPTION'=>t('Auto Complete'),
                  'TYPE'=>'check',
                  'PROP'=>'autoComplete',
                  );
$result[] = array(
                  'CAPTION'=>t('Ctl3D'),
                  'TYPE'=>'check',
                  'PROP'=>'ctl3D',
                  );
$result[] = array(
                  'CAPTION'=>t('Flat'),
                  'TYPE'=>'check',
                  'PROP'=>'flat',
                  );
$result[] = array(
                  'CAPTION'=>t('Item Index'),
                  'TYPE'=>'number',
                  'PROP'=>'itemIndex',
                  );
$result[] = array(
                  'CAPTION'=>t('Item Height'),
                  'TYPE'=>'number',
                  'PROP'=>'itemHeight',
                  );
$result[] = array(
                  'CAPTION'=>t('Color'),
                  'TYPE'=>'color',
                  'PROP'=>'color',
                  );
$result[] = array(
                  'CAPTION'=>t('Parent Background'),
                  'TYPE'=>'check',
                  'PROP'=>'ParentBackground',
                  );
$result[] = array(
                  'CAPTION'=>t('Parent Font'),
                  'TYPE'=>'check',
                  'PROP'=>'ParentFont',
                  );
$result[] = array(
                  'CAPTION'=>t('Parent Color'),
                  'TYPE'=>'check',
                  'PROP'=>'ParentColor',
                  );
$result[] = array(
                  'CAPTION'=>t('Parent Show Hint'),
                  'TYPE'=>'check',
                  'PROP'=>'ParentShowHint',
                  );
$result[] = array(
                  'CAPTION'=>t('Columns'),
                  'TYPE'=>'number',
                  'PROP'=>'columns',
                  );
$result[] = array(
                  'CAPTION'=>t('Hint'),
                  'TYPE'=>'text',
                  'PROP'=>'hint',
                  );
$result[] = array(
                  'CAPTION'=>t('Show Hint'),
                  'TYPE'=>'check',
                  'PROP'=>'ShowHint',
                  );

$result[] = array(
                  'CAPTION'=>t('Style'),
                  'TYPE'=>'combo',
                  'PROP'=>'style',
                  'VALUES'=>array('lbStandard', 'lbOwnerDrawFixed', 'lbOwnerDrawVariable', 'lbVirtual', 'lbVirtualOwnerDraw'),
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
                  'CAPTION'=>t('Bevel Kind'),
                  'TYPE'=>'combo',
                  'PROP'=>'bevelKind',
                  'VALUES'=>array('bkNone', 'bkTile', 'bkSoft', 'bkFlat'),
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
                  'CAPTION'=>t('Scroll Width'),
                  'TYPE'=>'number',
                  'PROP'=>'scrollWidth',
                  );
$result[] = array(
                  'CAPTION'=>t('Sorted'),
                  'TYPE'=>'check',
                  'PROP'=>'sorted',
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