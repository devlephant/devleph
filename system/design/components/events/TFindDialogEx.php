<?

$result = [];


$result[] = array(
                  'CAPTION'=>t("onshow"),
                  'EVENT'=>'onShow',
                  'INFO'=>'%func%($self)',
                  'ICON'=>'onshow',
                  );
$result[] = array(
                  'CAPTION'=>t("onclose"),
                  'EVENT'=>'onClose',
                  'INFO'=>'%func%($self)',
                  'ICON'=>'onclose',
                  );
$result[] = array(
                  'CAPTION'=>t("onfind"),
                  'EVENT'=>'onFind',
                  'INFO'=>'%func%($self)',
                  'ICON'=>'onfind',
                  );
return $result;