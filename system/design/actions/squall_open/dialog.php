<?

$r = array();

$r[] = array(
             'TYPE'=>'OBJECTS',
             'CAPTION'=>t('SQUALL Player'),
             'CLASSES'=>array('TSQUALLPlayer'),
             'USE_QUOTE'=>false,
             );

$r[] = array(
             'TYPE'=>'INPUT_DLG',
             'CAPTION'=>t('File name'),
             'USE_QUOTE'=>true,
             );


return $r;
