<?

$result = [];

$result[] = array(
                  'CAPTION'=>t('On During SizeMove'),
                  'EVENT'=>'onDuringSizeMove',
                  'INFO'=>'%func%($self, $dx, $dy, $state)',
                  'ICON'=>'onduringsizeMove',
                  );
$result[] = array(
                  'CAPTION'=>t('On Start Size Move'),
                  'EVENT'=>'OnStartSizeMove',
                  'INFO'=>'%func%($self, $state)',
                  'ICON'=>'onstartsizeMove',
                  );
$result[] = array(
                  'CAPTION'=>t('On End Size Move'),
                  'EVENT'=>'OnEndSizeMove',
                  'INFO'=>'%func%($self, $state)',
                  'ICON'=>'OnEndSizeMove',
                  );
$result[] = array(
                  'CAPTION'=>t('On Mouse Down'),
                  'EVENT'=>'onMouseDown',
                  'INFO'=>'%func%($self,$button,$shift,$x,$y)',
                  'ICON'=>'mousedown',
                  );
return $result;