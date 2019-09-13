<?

$result = [];

$result[] = array(
                  'CAPTION'=>t("onclick"),
                  'EVENT'=>'onClick',
                  'INFO'=>'%func%($self)',
                  'ICON'=>'onclick',
                  );
$result[] = array(
    'CAPTION'=>'-',
);
$result[] = array(
                  'CAPTION'=>t("onmouseactivate"),
                  'EVENT'=>'onMouseActivate',
                  'INFO'=>'%func%($self,$button,$shift,$x,$y,$HitTest,&$MouseActivate)',
                  'ICON'=>'mouseactivate',
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
    'CAPTION'=>'-',
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
$result[] = array(
    'CAPTION'=>'-',
);
$result[] = array(
                  'CAPTION'=>t("onfocus"),
                  'EVENT'=>'onfocus',
                  'INFO'=>'%func%($self)',
                  'ICON'=>'onfocus',
                  );
$result[] = array(
                  'CAPTION'=>t("onblur"),
                  'EVENT'=>'onblur',
                  'INFO'=>'%func%($self)',
                  'ICON'=>'onblur',
                  );


return $result;