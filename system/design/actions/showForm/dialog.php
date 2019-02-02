<?$r = array(); 
$r[] = array(
             'TYPE'=>'INPUT_DLG',
             'CAPTION'=>t('Form'),
             'USE_QUOTE'=>false,
             );
$r[] = array(
             'TYPE'=>'COMBO',
             'CAPTION'=>t('Mode'),
             'VALUES'=>array('SW_SHOW',
                            'SW_SHOWMODAL'),
             );
return $r;