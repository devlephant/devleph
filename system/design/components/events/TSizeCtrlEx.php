<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('On During SizeMove'),
                  'EVENT'=>'onDuringSizeMove',
                  'INFO'=>'%func%($self, $dx, $dy, $state)',
                  'ICON'=>'mousemove',
                  );
$result[] = array(
                  'CAPTION'=>t('On Start Size Move'),
                  'EVENT'=>'OnStartSizeMove',
                  'INFO'=>'%func%($self, $state)',
                  'ICON'=>'mousedown',
                  );
$result[] = array(
                  'CAPTION'=>t('On End Size Move'),
                  'EVENT'=>'OnEndSizeMove',
                  'INFO'=>'%func%($self, $state)',
                  'ICON'=>'mouseup',
                  );
$result[] = array(
    'CAPTION'=>'-',
);             
$result[] = array(
                  'CAPTION'=>t('On Mouse Down'),
                  'EVENT'=>'onMouseDown',
                  'INFO'=>'%func%($self,$button,$shift,$x,$y)',
                  'ICON'=>'onclick',
                  );
return $result;