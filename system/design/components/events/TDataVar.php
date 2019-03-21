<?

$result = [];

$result[] = array(
                  'CAPTION'=>t('On Start Change'),
                  'EVENT'=>'onStartChange',
                  'INFO'=>'%func%($self)',
                  'ICON'=>'onchange',
                  );


$result[] = array(
                  'CAPTION'=>t('On Change'),
                  'EVENT'=>'onChange',
                  'INFO'=>'%func%($self)',
                  'ICON'=>'onchange',
                  );

return $result;