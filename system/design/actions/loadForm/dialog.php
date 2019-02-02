<?$r = array(); 
$r[] = array(
             'TYPE'=>'INPUT_DLG',
             'CAPTION'=>t('Form'),
             'USE_QUOTE'=>false,
             );
$r[] = array(
             'TYPE'=>'COMBO',
             'CAPTION'=>t('Mode'),
             'VALUES'=>array('LD_NONE',
                            'LD_XY',
                            'LD_XYWH'),
             'QUOTE_PARAMS'=>false,
             );
return $r;
