<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('On Complete'),
                  'EVENT'=>'onComplete',
                  'INFO'=>'%func%($self, $html)',
                  'ICON'=>'oncomplete',
                  );

$result[] = array(
                  'CAPTION'=>t('On Error'),
                  'EVENT'=>'onError',
                  'INFO'=>'%func%($self, $error)',
                  'ICON'=>'onerror',
                  );

return $result;