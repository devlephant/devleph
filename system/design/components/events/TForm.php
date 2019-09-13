<?

$result = [];

$result[] = array(
                  'CAPTION'=>t("onclick"),
                  'EVENT'=>'onClick',
                  'INFO'=>'%func%($self)',
                  'ICON'=>'onclick',
                  );

$result[] = array(
                  'CAPTION'=>t("ondblclick"),
                  'EVENT'=>'onDblClick',
                  'INFO'=>'%func%($self)',
                  'ICON'=>'ondblclick',
                  );

$result[] = array(
                  'CAPTION'=>t("onclose"),
                  'EVENT'=>'onClose',
                  'INFO'=>'%func%($self)',
                  'ICON'=>'onclose',
                  );

$result[] = array(
                  'CAPTION'=>t("onclosequery"),
                  'EVENT'=>'onCloseQuery',
                  'INFO'=>'%func%($self, $canClose)',
                  'ICON'=>'onclosequery',
                  );

$result[] = array(
                  'CAPTION'=>t("oncreate"),
                  'EVENT'=>'onCreate',
                  'INFO'=>'%func%($self)',
                  'ICON'=>'oncreate',
                  );

$result[] = array(
                  'CAPTION'=>t("onactivate"),
                  'EVENT'=>'onActivate',
                  'INFO'=>'%func%($self)',
                  'ICON'=>'onactive',
                  );
$result[] = array(
                  'CAPTION'=>t("ondeactivate"),
                  'EVENT'=>'onDeactivate',
                  'INFO'=>'%func%($self)',
                  'ICON'=>'ondeactive',
                  );

$result[] = array(
                  'CAPTION'=>t("onshow"),
                  'EVENT'=>'onShow',
                  'INFO'=>'%func%($self)',
                  'ICON'=>'onshow',
                  );

$result[] = array(
                  'CAPTION'=>t("onhide"),
                  'EVENT'=>'onHide',
                  'INFO'=>'%func%($self)',
                  'ICON'=>'onhide',
                  );
$result[] = array(
                  'CAPTION'=>t("onresize"),
                  'EVENT'=>'onResize',
                  'INFO'=>'%func%($self)',
                  'ICON'=>'onresize',
                  );
$result[] = array(
                  'CAPTION'=>t("onpaint"),
                  'EVENT'=>'onPaint',
                  'INFO'=>'%func%($self)',
                  'ICON'=>'onpaint',
                  );
$result[] = array(
                  'CAPTION'=>t("onkeyup"),
                  'EVENT'=>'onKeyUp',
                  'INFO'=>'%func%($self,$key,$shift)',
                  'ICON'=>'onkeyup',
                  );
$result[] = array(
                  'CAPTION'=>t("onkeypress"),
                  'EVENT'=>'onKeyPress',
                  'INFO'=>'%func%($self,$key,$shift)',
                  'ICON'=>'onkeypress',
                  );
$result[] = array(
                  'CAPTION'=>t("onkeydown"),
                  'EVENT'=>'onKeyDown',
                  'INFO'=>'%func%($self,$key,$shift)',
                  'ICON'=>'onkeydown',
                  );
$result[] = array(
                  'CAPTION'=>t("onmousedown"),
                  'EVENT'=>'onMouseDown',
                  'INFO'=>'%func%($self,$button,$shift,$x,$y)',
                  'ICON'=>'mousedown',
                  );
$result[] = array(
                  'CAPTION'=>t("onmousemove"),
                  'EVENT'=>'onMouseMove',
                  'INFO'=>'%func%($self,$button,$shift,$x,$y)',
                  'ICON'=>'mousemove',
                  );
$result[] = array(
                  'CAPTION'=>t("onmouseup"),
                  'EVENT'=>'onMouseUp',
                  'INFO'=>'%func%($self,$button,$shift,$x,$y)',
                  'ICON'=>'mouseup',
                  );

$result[] = array(
                  'CAPTION'=>t("onmouseenter"),
                  'EVENT'=>'onMouseEnter',
                  'INFO'=>'%func%($self)',
                  'ICON'=>'onmouseenter',
                  );

$result[] = array(
                  'CAPTION'=>t("onmouseleave"),
                  'EVENT'=>'onMouseLeave',
                  'INFO'=>'%func%($self)',
                  'ICON'=>'onmouseleave',
                  );
return $result;