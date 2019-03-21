<?

$r = [];

$r[] = array(
             'TYPE'=>'INPUT_DLG',
             'CAPTION'=>('Текст сообщения'),
             'USE_QUOTE'=>true,
            );
$r[] = array(
             'TYPE'=>'INPUT_DLG',
             'CAPTION'=>t('Заголовок'), 
             'USE_QUOTE'=>true,
             );

return $r;
