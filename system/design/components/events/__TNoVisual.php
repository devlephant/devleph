<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('On Click'),
                  'EVENT'=>'onClick',
                  'INFO'=>'%func%($self)',
                  'ICON'=>'onclick',
                  );

$result[] = array(
                  'CAPTION'=>t('onDblClick'),
                  'EVENT'=>'onDblClick',
                  'INFO'=>'%func%($self)',
                  'ICON'=>'onDblClick',
                  );

$result[] = array(
                  'CAPTION'=>t('On Mouse Move'),
                  'EVENT'=>'onMouseMove',
                  'INFO'=>'%func%($self,$button,$shift,$x,$y)',
                  'ICON'=>'mousemove',
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