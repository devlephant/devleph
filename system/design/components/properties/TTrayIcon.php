<?

$result = [];


$result[] = array(
                  'CAPTION'=>t('Hint'),
                  'TYPE'=>'text',
                  'PROP'=>'ahint',
                  'REAL_PROP'=>'hint',
                  );
$result[] = array(
                  'CAPTION'=>t('Show Hint'),
                  'TYPE'=>'check',
                  'PROP'=>'ashowHint',
                  'REAL_PROP'=>'showHint',
                  );

$result[] = array(
                  'CAPTION'=>t('Icon file'),
                  'TYPE'=>'files',
                  'EXT'=>'ico',
                  'RECURSIVE'=>true,
                  'PROP'=>'aiconFile',
                  'REAL_PROP'=>'iconFile',
                  );

$result[] = array(
                  'CAPTION'=>t('Left Popup'),
                  'TYPE'=>'check',
                  'PROP'=>'aleftPopup',
                  'REAL_PROP'=>'leftPopup',
                  );

$result[] = array(
                  'CAPTION'=>t('Enabled'),
                  'TYPE'=>'check',
                  'PROP'=>'aenabled',
                  'REAL_PROP'=>'enabled',
                  );

$result[] = array(
                  'CAPTION'=>t('Icon Visible'),
                  'TYPE'=>'check',
                  'PROP'=>'aiconVisible',
                  'REAL_PROP'=>'iconVisible',
                  );

$result[] = array(
                  'CAPTION'=>t('Minimize to Tray'),
                  'TYPE'=>'check',
                  'PROP'=>'aminimizeToTray',
                  'REAL_PROP'=>'minimizeToTray',
                  );

$result[] = array(
                  'CAPTION'=>t('Title of Ballontip'),
                  'TYPE'=>'text',
                  'PROP'=>'title',
                  );
$result[] = array(
                  'CAPTION'=>t('Text of Ballontip'),
                  'TYPE'=>'text',
                  'PROP'=>'text',
                  );
$result[] = array(
                  'CAPTION'=>t('Type of Ballontip'),
                  'TYPE'=>'combo',
                  'PROP'=>'flag',
                  'VALUES'=>
                        array(0 => t('None'),
                              1 => t('Information'),
                              2 => t('Warning'),
                              3 => t('Error'),
                              4 => t('Last Icon'),
                              5 => t('Tray Icon')),
                  'NO_CONST'=>1,
                  );
$result[] = array(
                  'CAPTION'=>t('Timeout of Ballontip'),
                  'TYPE'=>'number',
                  'PROP'=>'timeout',
                  );


return $result;