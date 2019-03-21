<?

$r = [];

$r[] = array(
             'TYPE'=>'INPUT_DLG',
             'CAPTION'=>t('Object'),
             'USE_QUOTE'=>false,
             );

$r[] = array(
             'TYPE'=>'COMBO',
             'CAPTION'=>t('Parameter'),
             'USE_QUOTE'=>true,
             'VALUES'=>array('X','Y','W','H'),
             );

$r[] = array(
             'TYPE'=>'INPUT_DLG',
             'CAPTION'=>t('Value'),
             'USE_QUOTE'=>false,
             );


return $r;
