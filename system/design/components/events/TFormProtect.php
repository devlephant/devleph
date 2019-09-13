<?

$result = [];

$result[] = array(
                  'CAPTION'=>t("onshow"),
                  'EVENT'=>'onShow',
                  'INFO'=>'%func%($self)',
                  'ICON'=>'onshow',
                  );
$result[] = array(
                  'CAPTION'=>t("onerror"),
                  'EVENT'=>'onError',
                  'INFO'=>'%func%($self)',
                  'ICON'=>'onerror',
                  );
return $result;