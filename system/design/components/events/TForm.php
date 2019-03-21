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
                  'CAPTION'=>t('On Close'),
                  'EVENT'=>'onClose',
                  'INFO'=>'%func%($self)',
                  'ICON'=>'onclose',
                  );

$result[] = array(
                  'CAPTION'=>t('On Close Query'),
                  'EVENT'=>'onCloseQuery',
                  'INFO'=>'%func%($self, $canClose)',
                  'ICON'=>'onclosequery',
                  );

$result[] = array(
                  'CAPTION'=>t('On Create'),
                  'EVENT'=>'onCreate',
                  'INFO'=>'%func%($self)',
                  'ICON'=>'oncreate',
                  );

$result[] = array(
                  'CAPTION'=>t('On Activate'),
                  'EVENT'=>'onActivate',
                  'INFO'=>'%func%($self)',
                  'ICON'=>'onactive',
                  );
$result[] = array(
                  'CAPTION'=>t('On Deactivate'),
                  'EVENT'=>'onDeactivate',
                  'INFO'=>'%func%($self)',
                  'ICON'=>'ondeactive',
                  );

$result[] = array(
                  'CAPTION'=>t('On Show'),
                  'EVENT'=>'onShow',
                  'INFO'=>'%func%($self)',
                  'ICON'=>'onshow',
                  );

$result[] = array(
                  'CAPTION'=>t('On Hide'),
                  'EVENT'=>'onHide',
                  'INFO'=>'%func%($self)',
                  'ICON'=>'onhide',
                  );
$result[] = array(
                  'CAPTION'=>t('On Resize'),
                  'EVENT'=>'onResize',
                  'INFO'=>'%func%($self)',
                  'ICON'=>'onresize',
                  );
$result[] = array(
                  'CAPTION'=>t('On Paint'),
                  'EVENT'=>'onPaint',
                  'INFO'=>'%func%($self)',
                  'ICON'=>'onpaint',
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