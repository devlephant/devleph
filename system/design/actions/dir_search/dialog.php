<?
$r = array();
$r[] = array(
             'TYPE'=>'INPUT_DLG',
             'CAPTION'=>t('Directiry'),
             'USE_QUOTE'=>true,
             );

$r[] = array(
             'TYPE'=>'VARS',
             'CAPTION'=>t('Buffer - variable'),
             'USE_QUOTE'=>false,
             );

$r[] = array(
             'TYPE'=>'INPUT_DLG',
             'CAPTION'=>t('Extensions'),
             'USE_QUOTE'=>true,
             );

$r[] = array(
             'TYPE'=>'CHECK',
             'CAPTION'=>t('Recursive'),
             'USE_QUOTE'=>false,
             );

$r[] = array(
             'TYPE'=>'CHECK',
             'CAPTION'=>t('File names with dir name'),
             'USE_QUOTE'=>false,
             );

return $r;
