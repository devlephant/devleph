<?
$result = [];
$result[] = array(
'CAPTION'=>t('Caption'),
'TYPE'=>'text',
'PROP'=>'caption'
);

_addfont($result);

$result[] = array(
'CAPTION'=>t('Highlighted'),
'TYPE'=>'check',
'PROP'=>'highlighted'
);
$result[] = array(
'CAPTION'=>t('Page Index'),
'TYPE'=>'number',
'PROP'=>'PageIndex'
);
$result[] = array(
'CAPTION'=>t('Image Index'),
'TYPE'=>'number',
'PROP'=>'ImageIndex'
);
$result[] = array(
                  'CAPTION'=>t('Tab is visible'),
                  'TYPE'=>'check',
                  'PROP'=>'atabvisible',
                  'REAL_PROP'=>'tabvisible',
                  'ADD_GROUP'=>true,
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
                  'CAPTION'=>t('Cursor'),
                  'TYPE'=>'combo',
                  'PROP'=>'cursor',
                  'VALUES'=>$GLOBALS['cursors_meta'],
                  'ADD_GROUP'=>true,
                  );
$result[] = array(
                  'CAPTION'=>t('Border Width'),
                  'TYPE'=>'number',
                  'PROP'=>'BorderWidth'
                  );
$result[] = array(
                  'CAPTION'=>t('Double Buffered'),
                  'TYPE'=>'check',
                  'PROP'=>'DoubleBuffered',
                  );
$result[] = array(
                  'CAPTION'=>t('Dock Site'),
                  'TYPE'=>'check',
                  'PROP'=>'DockSite',
                  );
$result[] = array(
                  'CAPTION'=>t('Use Dock Manager'),
                  'TYPE'=>'check',
                  'PROP'=>'UseDockManager',
                  );

$result[] = array(
                  'CAPTION'=>t('Parent Font'),
                  'TYPE'=>'check',
                  'PROP'=>'parentFont',
                  );
$result[] = array(
                  'CAPTION'=>t('Parent Double Buffered'),
                  'TYPE'=>'check',
                  'PROP'=>'parentDoubleBuffered',
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
                  'CAPTION'=>t('Sizes and position'),
                  'TYPE'=>'sizes',
                  'PROP'=>'',
                  'ADD_GROUP'=>true,
                  );
$result[] = array(
                  'CAPTION'=>t('Align'),
                  'TYPE'=>'combo',
                  'PROP'=>'align',
                  'VALUES'=>$_c->s('TAlign'),
                   'ADD_GROUP'=>true
                  );
$result[] = array(
                  'CAPTION'=>t('DragMode'),
                  'TYPE'=>'combo',
                  'PROP'=>'DragMode',
                  'VALUES'=>array('dmManual', 'dmAutomatic'),
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
				  
$result[] = array('CAPTION'=>t('Left'), 'PROP'=>'x','TYPE'=>'number','ADD_GROUP'=>true);
$result[] = array('CAPTION'=>t('Top'), 'PROP'=>'y','TYPE'=>'number','ADD_GROUP'=>true);
$result[] = array('CAPTION'=>t('Width'), 'PROP'=>'clientWidth','TYPE'=>'number','ADD_GROUP'=>true);
$result[] = array('CAPTION'=>t('Height'), 'PROP'=>'clientHeight','TYPE'=>'number','ADD_GROUP'=>true);
$result[] = array('CAPTION'=>t('Real Width'), 'PROP'=>'w','TYPE'=>'');
$result[] = array('CAPTION'=>t('Real Height'), 'PROP'=>'h','TYPE'=>'');
return $result;