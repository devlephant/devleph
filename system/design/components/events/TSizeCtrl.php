<?

$result = [];

$result[] = array(
                  'CAPTION'=>t("onduringsizemove"),
                  'EVENT'=>'onDuringSizeMove',
                  'INFO'=>'%func%($self, $dx, $dy, $state)',
                  'ICON'=>'onduringsizeMove',
                  );
$result[] = array(
                  'CAPTION'=>t("onstartsizemove"),
                  'EVENT'=>'OnStartSizeMove',
                  'INFO'=>'%func%($self, $state)',
                  'ICON'=>'onstartsizeMove',
                  );
$result[] = array(
                  'CAPTION'=>t("onendsizemove"),
                  'EVENT'=>'OnEndSizeMove',
                  'INFO'=>'%func%($self, $state)',
                  'ICON'=>'OnEndSizeMove',
                  );
$result[] = array(
                  'CAPTION'=>t("onmousedown"),
                  'EVENT'=>'onMouseDown',
                  'INFO'=>'%func%($self,$button,$shift,$x,$y)',
                  'ICON'=>'mousedown',
                  );
return $result;