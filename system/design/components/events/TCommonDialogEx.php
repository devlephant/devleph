<?

$result = array();


$result[] = array(
                  'CAPTION'=>t('On Show'),
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