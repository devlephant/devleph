<?

$result = [];



$result[] = array(
                  'CAPTION'=>t('Start download'),
                  'PROP'=>'start()',
                  'INLINE'=>'start ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('Stop download'),
                  'PROP'=>'stop()',
                  'INLINE'=>'stop ( void )',
                  );

return $result;