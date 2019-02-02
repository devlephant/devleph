<?$r = array(); 
$r[] = array(
             'TYPE'=>'COMBO',
             'CAPTION'=>t('Section'),             
             'VALUES'=>array('HKEY_CLASSES_ROOT',
                            'HKEY_CURRENT_USER',
                            'HKEY_LOCAL_MACHINE',
                            'HKEY_USERS',
                            'HKEY_PERFORMANCE_DATA',
                            'HKEY_CURRENT_CONFIG',
                            'HKEY_DYN_DATA '),
             );
$r[] = array(
             'TYPE'=>'INPUT_DLG',
             'CAPTION'=>t('Path'),
             'USE_QUOTE'=>true,
             );
$r[] = array(
             'TYPE'=>'INPUT_DLG',
             'CAPTION'=>t('Variable'),
             'USE_QUOTE'=>false,
             );
$r[] = array(
             'TYPE'=>'COMBO',
             'CAPTION'=>t('Type'),
             'VALUES'=>array('STRING',
                            'DATE_TIME',
                            'BOOL',
                            'DWORD',
                            'CURRENCY'),
             );
return $r;
