<?

$r = array();

$r[] = array(
             'TYPE'=>'VARS',
             'CAPTION'=>t('Buffer var'),
             'USE_QUOTE'=>false,
             );

$r[] = array(
             'TYPE'=>'OBJECTS',
             'CAPTION'=>t('Dialog object'),
             'USE_QUOTE'=>false,
             'CLASSES'=>array('TOpenDialogEx','TSaveDialogEx','TDirDialog','TFontDialogEx','TColorDialogEx')
             );

return $r;
