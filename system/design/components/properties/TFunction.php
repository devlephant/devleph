<?

$result = [];

$result[] = array(
                  'CAPTION'=>t('Parameters'),
                  'TYPE'=>'text',
                  'PROP'=>'parameters',
                  );
$result[] = array(
                  'CAPTION'=>t('Description'),
                  'TYPE'=>'text',
                  'PROP'=>'description',
                  );
$result[] = array(
                  'CAPTION'=>t('Register as PHP Func'),
                  'TYPE'=>'check',
                  'PROP'=>'toRegister',
                  );

$result[] = array(
                  'CAPTION'=>t('Synchronization'),
                  'TYPE'=>'check',
                  'PROP'=>'isSync',
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

return $result;