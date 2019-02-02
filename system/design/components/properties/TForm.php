<?

$result = array();


$result[] = array('CAPTION'=>t('p_Left'), 'PROP'=>'x');
$result[] = array('CAPTION'=>t('p_Top'), 'PROP'=>'y');

$result[] = array(
                  'CAPTION'=>t('caption'),
                  'TYPE'=>'text',
                  'PROP'=>'caption',
                  );

$result[] = array(
                  'CAPTION'=>t('Hint'),
                  'TYPE'=>'text',
                  'PROP'=>'hint',
                  );

_addfont($result);

$result[] = array(
                  'CAPTION'=>t('Auto Scroll'),
                  'TYPE'=>'check',
                  'PROP'=>'autoScroll',
                  );
$result[] = array(
                  'CAPTION'=>t('Auto Size'),
                  'TYPE'=>'check',
                  'PROP'=>'autoSize',
                  );
$result[] = array(
                  'CAPTION'=>t('Active Control'),
                  'TYPE'=>'',
                  'PROP'=>'ActiveControl',
                  );
$result[] = array(
                  'CAPTION'=>t('Alpha Blend'),
                  'TYPE'=>'check',
                  'PROP'=>'alphaBlend',
                  );
$result[] = array(
                  'CAPTION'=>t('Alpha Blend Value'),
                  'TYPE'=>'number',
                  'PROP'=>'alphaBlendValue',
                  );
$result[] = array(
                  'CAPTION'=>t('Border Style'),
                  'TYPE'=>'',
                  'PROP'=>'borderStyle',
                  'VALUES'=>array('bsNone', 'bsSingle', 'bsSizeable', 'bsDialog', 'bsToolWindow', 'bsSizeToolWin'),
                  'UPDATE'=>true,
                  );
$result[] = array(
                  'CAPTION'=>t('Border Width'),
                  'TYPE'=>'number',
                  'PROP'=>'borderWidth',
                  );
$result[] = array(
                  'CAPTION'=>t('Color'),
                  'TYPE'=>'color',
                  'PROP'=>'color',
                  );

$result[] = array(
                  'CAPTION'=>t('Screen Snap'),
                  'TYPE'=>'check',
                  'PROP'=>'screenSnap',
                  );
$result[] = array(
                  'CAPTION'=>t('Snap Buffer'),
                  'TYPE'=>'number',
                  'PROP'=>'snapBuffer',
                  );
$result[] = array(
                  'CAPTION'=>t('Cursor'),
                  'TYPE'=>'combo',
                  'PROP'=>'cursor',
                  'VALUES'=>$GLOBALS['cursors_meta'],
                  'ADD_GROUP'=>true,
                  );
$result[] = array(
                  'CAPTION'=>t('Enabled'),
                  'TYPE'=>'',
                  'PROP'=>'aenabled',
                  'REAL_PROP'=>'enabled',
                  'ADD_GROUP'=>true,
                  );

$result[] = array(
                  'CAPTION'=>t('Transparent Color'),
                  'TYPE'=>'check',
                  'PROP'=>'transparentColor',
                  'ADD_GROUP'=>true,
                  );
$result[] = array(
                  'CAPTION'=>t('Transparent Color Value'),
                  'TYPE'=>'color',
                  'PROP'=>'transparentColorValue',
                  'ADD_GROUP'=>true,
                  );
$result[] = array(
                  'CAPTION'=>t('DockSite'),
                  'TYPE'=>'check',
                  'PROP'=>'docksite',
                  'ADD_GROUP'=>true,
                  );
$result[] = array(
                  'CAPTION'=>t('DefaultMonitor'),
                  'TYPE'=>'combo',
                  'PROP'=>'DefaultMonitor',
				  'VALUES'=>array('dmActiveForm', 'dmDesktop', 'dmMainForm', 'dmPrimary'),
                  'ADD_GROUP'=>true,
                  );
$result[] = array(
                  'CAPTION'=>t('Double Buffered'),
                  'TYPE'=>'check',
                  'PROP'=>'doubleBuffered',
                  );
$result[] = array(
                  'CAPTION'=>t('Ctl3D'),
                  'TYPE'=>'check',
                  'PROP'=>'Ctl3D',
                  'ADD_GROUP'=>true,
                  );

$result[] = array(
                  'CAPTION'=>t('Align'),
                  'TYPE'=>'combo',
                  'PROP'=>'align',
                  'VALUES'=>array('alNone', 'alTop', 'alBottom', 'alLeft', 'alRight', 'alClient', 'alCustom'),
                   'ADD_GROUP'=>true
                  );
$result[] = array(
                  'CAPTION'=>t('DragKind'),
                  'TYPE'=>'combo',
                  'PROP'=>'DragKind',
                  'VALUES'=>array('dkDock', 'dkDrag'),
                  );

$result[] = array(
                  'CAPTION'=>t('PixelsPerInch'),
                  'TYPE'=>'number',
                  'PROP'=>'PixelsPerInch',
                  );	  
$result[] = array(
                  'CAPTION'=>t('Scale for pixels'),
                  'TYPE'=>'check',
                  'PROP'=>'Scaled',
                  );
$result[] = array(
                  'CAPTION'=>t('ShowHint'),
                  'TYPE'=>'check',
                  'PROP'=>'ShowHint',
                  );
$result[] = array(
                  'CAPTION'=>t('DragMode'),
                  'TYPE'=>'combo',
                  'PROP'=>'DragMode',
                  'VALUES'=>array('dmManual', 'dmAutomatic'),
                  );				  
$result[] = array('CAPTION'=>t('Width'), 'PROP'=>'clientWidth','TYPE'=>'number','ADD_GROUP'=>true);
$result[] = array('CAPTION'=>t('Height'), 'PROP'=>'clientHeight','TYPE'=>'number','ADD_GROUP'=>true);

$result[] = array('CAPTION'=>t('Real Width'), 'PROP'=>'w','TYPE'=>'','ADD_GROUP'=>true);
$result[] = array('CAPTION'=>t('Real Height'), 'PROP'=>'h','TYPE'=>'','ADD_GROUP'=>true);
$result[] = array(
                  'CAPTION'=>t('PrintScale'),
                  'TYPE'=>'combo',
                  'PROP'=>'PrintScale',
				  'VALUES'=>array('poNone', 'poPrintToFit', 'poProportional'),
                  'ADD_GROUP'=>true,
                  );
$result[] = array(
                  'CAPTION'=>t('Form Style'),
                  'TYPE'=>'',
                  'PROP'=>'formStyle',
                  );
$result[] = array(
                  'CAPTION'=>t('Position'),
                  'TYPE'=>'',
                  'PROP'=>'position',
                  );
$result[] = array(
                  'CAPTION'=>t('Window State'),
                  'TYPE'=>'',
                  'PROP'=>'windowState',
                  );
$result[] = array(
                  'CAPTION'=>t('Properties'),
                  'TYPE'=>'form',
                  'PROP'=>'fmFormProperties',
                  'ADD_GROUP'=>true,
                  );
$result[] = array(
                  'CAPTION'=>t('Icon'),
                  'TYPE'=>'icon',
                  'PROP'=>'Icon',
                  'CLASS'=>'TIcon',
                  );
$result[] = array(
                  'CAPTION'=>t('Modal result'),
                  'TYPE'=>'',
                  'PROP'=>'modalResult',
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
                  'CAPTION'=>t('Double Buffered'),
                  'TYPE'=>'',
                  'PROP'=>'doubleBuffered',
                  );

return $result;