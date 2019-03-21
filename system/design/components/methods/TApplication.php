<?

$result = [];

$result[] = array(
                  'CAPTION'=>t('terminate'),
                  'PROP'=>'terminate()',
                  'INLINE'=>'terminate ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('minimize'),
                  'PROP'=>'minimize()',
                  'INLINE'=>'minimize ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('processMessages'),
                  'PROP'=>'processMessages()',
                  'INLINE'=>'processMessages ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('restore'),
                  'PROP'=>'restore()',
                  'INLINE'=>'restore ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('findComponent'),
                  'PROP'=>'findComponent',
                  'INLINE'=>'findComponent ( string name )',
                  );

$result[] = array(
                  'CAPTION'=>t('toFront'),
                  'PROP'=>'toFront()',
                  'INLINE'=>'toFront ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('addTermFunc'),
                  'PROP'=>'addTermFunc',
                  'INLINE'=>'addTermFunc ( string evalCode )',
                  );

return $result;