<?

$result = array();


$result[] = array('CAPTION'=>t('Width'), 'PROP'=>'width');
$result[] = array('CAPTION'=>t('Height'), 'PROP'=>'height');

$result[] = array(
                  'CAPTION'=>t('activeForm'),
                  'TYPE'=>'',
                  'PROP'=>'activeForm',
                  );

$result[] = array(
                  'CAPTION'=>t('formCount'),
                  'TYPE'=>'',
                  'PROP'=>'formCount',
                  );
return $result;