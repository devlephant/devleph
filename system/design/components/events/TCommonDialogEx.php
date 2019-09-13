<?

$result = [];


$result[] = array(
                  'CAPTION'=>t("onshow"),
                  'EVENT'=>'onShow',
                  'INFO'=>'%func%($self)',
                  'ICON'=>'onshow',
                  );
$result[] = array(
                  'CAPTION'=>t('Select'),
                  'EVENT'=>'onSelectDialog',
                  'INFO'=>'%func%($self)',
                  'ICON'=>'onSelectDialog',
                  );
return $result;