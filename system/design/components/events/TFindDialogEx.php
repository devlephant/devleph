<?

$result = array();


$result[] = array(
                  'CAPTION'=>t('On Show'),
                  'EVENT'=>'onShow',
                  'INFO'=>'%func%($self)',
                  'ICON'=>'onshow',
                  );
$result[] = array(
                  'CAPTION'=>t('On Close'),
                  'EVENT'=>'onClose',
                  'INFO'=>'%func%($self)',
                  'ICON'=>'onclose',
                  );
$result[] = array(
                  'CAPTION'=>t('On Find'),
                  'EVENT'=>'onFind',
                  'INFO'=>'%func%($self)',
                  'ICON'=>'onfind',
                  );
return $result;