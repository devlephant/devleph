<?

$r = [];

$r[] = array(
             'TYPE'=>'INPUT_DLG',
             'CAPTION'=>t('Section'),
             'USE_QUOTE'=>true,
             );
$r[] = array(
             'TYPE'=>'INPUT_DLG',
             'CAPTION'=>t('Key'),
             'USE_QUOTE'=>true,
             );
$r[] = array(
             'TYPE'=>'VARS',
             'CAPTION'=>t('Variable'),
             'USE_QUOTE'=>false,
             );
return $r;
