<?

$result = [];

$result[] = array(
                  'CAPTION'=>t("onstartchange"),
                  'EVENT'=>'onStartChange',
                  'INFO'=>'%func%($self)',
                  'ICON'=>'onchange',
                  );


$result[] = array(
                  'CAPTION'=>t("onchange"),
                  'EVENT'=>'onChange',
                  'INFO'=>'%func%($self)',
                  'ICON'=>'onchange',
                  );

return $result;