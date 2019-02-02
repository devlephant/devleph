<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('On Change'),
                  'EVENT'=>'onchange',
                  'INFO'=>'%func%($self)',
                  'ICON'=>'onchange',
                  );
$result[] = array(
                  'CAPTION'=>t('On Key Up'),
                  'EVENT'=>'onKeyUp',
                  'INFO'=>'%func%($self,$key,$shift)',
                  'ICON'=>'onkeyup',
                  );
$result[] = array(
                  'CAPTION'=>t('On Key Press'),
                  'EVENT'=>'onKeyPress',
                  'INFO'=>'%func%($self,$key,$shift)',
                  'ICON'=>'onkeypress',
                  );
$result[] = array(
                  'CAPTION'=>t('On Key Down'),
                  'EVENT'=>'onKeyDown',
                  'INFO'=>'%func%($self,$key,$shift)',
                  'ICON'=>'onkeydown',
                  );
return $result;