<?

$r = [];

$r[] = array(
             'TYPE'=>'INPUT_DLG',
             'CAPTION'=>t('Path to file, folder or command'),
             'USE_QUOTE'=>true,
             );

$r[] = array(
             'TYPE'=>'CHECK',
             'CAPTION'=>t('Wait for closing'),
             );


return $r;