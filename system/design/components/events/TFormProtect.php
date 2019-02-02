<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('On Show'),
                  'EVENT'=>'onShow',
                  'INFO'=>'%func%($self)',
                  'ICON'=>'onshow',
                  );
$result[] = array(
                  'CAPTION'=>t('On Error'),
                  'EVENT'=>'onError',
                  'INFO'=>'%func%($self)',
                  'ICON'=>'onerror',
                  );
return $result;