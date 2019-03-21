<?

$result = [];

$result[] = array(
                  'CAPTION'=>t('On Click'),
                  'EVENT'=>'onClick',
                  'INFO'=>'%func%($self)',
                  'ICON'=>'onclick',
                  );

$result[] = array(
                  'CAPTION'=>t('On DblClick'),
                  'EVENT'=>'onDblClick',
                  'INFO'=>'%func%($self)',
                  'ICON'=>'ondblclick',
                  );

$result[] = array(
                  'CAPTION'=>t('On Resize'),
                  'EVENT'=>'onResize',
                  'INFO'=>'%func%($self)',
                  'ICON'=>'onresize',
                  );
$result[] = array(
                  'CAPTION'=>t('On Mouse Down'),
                  'EVENT'=>'onMouseDown',
                  'INFO'=>'%func%($self,$button,$shift,$x,$y)',
                  'ICON'=>'mousedown',
                  );
$result[] = array(
                  'CAPTION'=>t('On Mouse Move'),
                  'EVENT'=>'onMouseMove',
                  'INFO'=>'%func%($self,$button,$shift,$x,$y)',
                  'ICON'=>'mousemove',
                  );
$result[] = array(
                  'CAPTION'=>t('On Mouse Up'),
                  'EVENT'=>'onMouseUp',
                  'INFO'=>'%func%($self,$button,$shift,$x,$y)',
                  'ICON'=>'mouseup',
                  );

$result[] = array(
                  'CAPTION'=>t('On Mouse Enter'),
                  'EVENT'=>'onMouseEnter',
                  'INFO'=>'%func%($self)',
                  'ICON'=>'onmouseenter',
                  );

$result[] = array(
                  'CAPTION'=>t('On Mouse Leave'),
                  'EVENT'=>'onMouseLeave',
                  'INFO'=>'%func%($self)',
                  'ICON'=>'onmouseleave',
                  );
$result[] = array(
                  'CAPTION'=>t('On Drop Files'),
                  'EVENT'=>'onDropFiles',
                  'INFO'=>'%func%($self,$files)',
                  'ICON'=>'ondropfiles',
                  );
$result[] = array(
                  'CAPTION'=>t('On Change'),
                  'EVENT'=>'onChange',
                  'INFO'=>'%func%($self,$files)',
                  'ICON'=>'onChange',
                  );
return $result;