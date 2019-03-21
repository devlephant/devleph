<?

$result = [];


$result[] = array(
                  'CAPTION'=>t('On Before Browse'),
                  'EVENT'=>'onbeforebrowse',
                  'INFO'=>'%func%($self, $url, $method, $type, $redirect, &$continue)',
                  'ICON'=>'onbeforebrowse',
                  );

return $result;