<?

$result = [];

$result[] = array(
                  'CAPTION'=>t("onduringsizemove"),
                  'EVENT'=>'onDuringSizeMove',
                  'INFO'=>'%func%($self, $dx, $dy, $state)',
                  'ICON'=>'mousemove',
                  );
$result[] = array(
                  'CAPTION'=>t("onstartsizemove"),
                  'EVENT'=>'OnStartSizeMove',
                  'INFO'=>'%func%($self, $state)',
                  'ICON'=>'mousedown',
                  );
$result[] = array(
                  'CAPTION'=>t("onendsizemove"),
                  'EVENT'=>'OnEndSizeMove',
                  'INFO'=>'%func%($self, $state)',
                  'ICON'=>'mouseup',
                  );
$result[] = array(
    'CAPTION'=>'-',
);             
$result[] = array(
                  'CAPTION'=>t("onmousedown"),
                  'EVENT'=>'onMouseDown',
                  'INFO'=>'%func%($self,$button,$shift,$x,$y)',
                  'ICON'=>'onclick',
                  );
return $result;