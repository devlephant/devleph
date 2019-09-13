<?

$result = [];

$result[] = array(
                  'CAPTION'=>t("oncomplete"),
                  'EVENT'=>'onComplete',
                  'INFO'=>'%func%($self, $html)',
                  'ICON'=>'oncomplete',
                  );

$result[] = array(
                  'CAPTION'=>t("onerror"),
                  'EVENT'=>'onError',
                  'INFO'=>'%func%($self, $error)',
                  'ICON'=>'onerror',
                  );

return $result;