<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('Enable'),
                  'TYPE'=>'check',
                  'PROP'=>'enable',
                  );
$result[] = array(
                  'CAPTION'=>t('Interval (ms)'),
                  'TYPE'=>'number',
                  'PROP'=>'interval',
                  );
$result[] = array(
                  'CAPTION'=>t('Repeat'),
                  'TYPE'=>'check',
                  'PROP'=>'repeat',
                  );
$result[] = array(
                  'CAPTION'=>t('Work in background'),
                  'TYPE'=>'check',
                  'PROP'=>'workBackground',
                  );
$result[] = array(
                  'CAPTION'=>t('Priority'),
                  'TYPE'=>'combo',
                  'PROP'=>'priority',
                  'VALUES'=> array('tpIdle', 'tpLowest', 'tpLower', 'tpNormal', 'tpHigher', 'tpHighest',
                                    'tpTimeCritical'),
                  );
/*$result[] = array(
                  'CAPTION'=>t('Timer Function (optional)'),
                  'TYPE'=>'text',
                  'PROP'=>'funcName',
                  );*/


return $result;