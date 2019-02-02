<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('Http url'),
                  'TYPE'=>'text',
                  'PROP'=>'url',
                  );
$result[] = array(
                  'CAPTION'=>t('Send method'),
                  'TYPE'=>'text',
                  'PROP'=>'method',
                  );

$result[] = array(
                  'CAPTION'=>t('Encoding'),
                  'TYPE'=>'text',
                  'PROP'=>'encoding',
                  );

$result[] = array(
                  'CAPTION'=>t('Redirect'),
                  'TYPE'=>'check',
                  'PROP'=>'redirect',
                  );

$result[] = array(
                  'CAPTION'=>t('Proxy').' (ip:port)',
                  'TYPE'=>'text',
                  'PROP'=>'proxyAddr',
                  );

$result[] = array(
                  'CAPTION'=>t('Time out (sec)'),
                  'TYPE'=>'number',
                  'PROP'=>'timeOut',
                  );

$result[] = array(
                  'CAPTION'=>t('Theater Mode'),
                  'TYPE'=>'check',
                  'PROP'=>'thread',
                  );

$result[] = array(
                  'CAPTION'=>t('Priority'),
                  'TYPE'=>'combo',
                  'PROP'=>'priority',
                  'VALUES'=> array('tpIdle', 'tpLowest', 'tpLower', 'tpNormal', 'tpHigher', 'tpHighest',
                                    'tpTimeCritical'),
                  );

return $result;