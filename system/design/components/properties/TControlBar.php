<?

$result = array();
$result[] = array(
                  'CAPTION'=>t('Ctl3D'),
                  'TYPE'=>'check',
                  'PROP'=>'Ctl3D',
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
                  'CAPTION'=>t('DockSite'),
                  'TYPE'=>'check',
                  'PROP'=>'dockSite',
                  );
$result[] = array(
                  'CAPTION'=>t('AutoDock'),
                  'TYPE'=>'check',
                  'PROP'=>'autoDock',
                  );
$result[] = array(
                  'CAPTION'=>t('DragMode'),
                  'TYPE'=>'combo',
                  'PROP'=>'DragMode',
                  'VALUES'=>array('dmManual', 'dmAutomatic'),
                  );	
$result[] = array(
                  'CAPTION'=>t('DragKind'),
                  'TYPE'=>'combo',
                  'PROP'=>'DragKind',
                  'VALUES'=>array('dkDock', 'dkDrag'),
                  );
$result[] = array(
                  'CAPTION'=>t('Align'),
                  'TYPE'=>'combo',
                  'PROP'=>'align',
                  'VALUES'=>array('alNone', 'alTop', 'alBottom', 'alLeft', 'alRight', 'alClient', 'alCustom'),
                   'ADD_GROUP'=>true
                  );	 
$result[] = array(
                  'CAPTION'=>t('Alignment').' 2',
                  'TYPE'=>'combo',
                  'PROP'=>'alignment',
                  'VALUES'=>array('taLeftJustify', 'taRightJustify', 'taCenter'),
                  );
$result[] = array(
                  'CAPTION'=>t('Parent Color'),
                  'TYPE'=>'check',
                  'PROP'=>'parentColor',
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
                  'CAPTION'=>t('Border Style'),
                  'TYPE'=>'combo',
                  'PROP'=>'borderStyle',
                  'VALUES'=>array('bsNone', 'bsSingle'),
                  );
$result[] = array(
                  'CAPTION'=>t('Auto Scroll'),
                  'TYPE'=>'check',
                  'PROP'=>'autoScroll',
                  );
$result[] = array(
                  'CAPTION'=>t('Handle'),
                  'TYPE'=>'',
                  'PROP'=>'handle',
                  );

$result[] = array(
                  'CAPTION'=>t('Component List'),
                  'TYPE'=>'',
                  'PROP'=>'componentList',
                  );
$result[] = array(
                  'CAPTION'=>t('Component Count'),
                  'TYPE'=>'',
                  'PROP'=>'componentCount',
                  );			  
$result[] = array(
                  'CAPTION'=>t('Border Width'),
                  'TYPE'=>'number',
                  'PROP'=>'borderWidth',
                  );
$result[] = array(
                  'CAPTION'=>t('Parent Color'),
                  'TYPE'=>'check',
                  'PROP'=>'parentColor',
                  );
$result[] = array(
                  'CAPTION'=>t('Parent Background'),
                  'TYPE'=>'check',
                  'PROP'=>'parentBackground',
                  );
$result[] = array(
                  'CAPTION'=>t('Row Size'),
                  'TYPE'=>'number',
                  'PROP'=>'RowSize',
                  );
$result[] = array(
                  'CAPTION'=>t('Row Snap'),
                  'TYPE'=>'check',
                  'PROP'=>'RowSnap',
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