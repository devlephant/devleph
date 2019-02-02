<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('On Change'),
                  'EVENT'=>'onchange',
                  'INFO'=>'%func%($self)',
                  'ICON'=>'onchange',
                  );
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
                  'CAPTION'=>t('On Key Up'),
                  'EVENT'=>'onKeyUp',
                  'INFO'=>'%func%($self,$key,$shift)',
                  'ICON'=>'onkeyup',
                  );
$result[] = array(
                  'CAPTION'=>t('On Key Press'),
                  'EVENT'=>'onKeyPress',
                  'INFO'=>'%func%($self,$key,$shift)',
                  'ICON'=>'onkeypress',
                  );
$result[] = array(
                  'CAPTION'=>t('On Key Down'),
                  'EVENT'=>'onKeyDown',
                  'INFO'=>'%func%($self,$key,$shift)',
                  'ICON'=>'onkeydown',
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
return $result;