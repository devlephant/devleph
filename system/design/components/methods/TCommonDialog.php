<?

$result = array();



$result[] = array(
                  'CAPTION'=>t('execute'),
                  'PROP'=>'execute()',
                  'INLINE'=>'boolean execute( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('close'),
                  'PROP'=>'close()',
                  'INLINE'=>'close( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('show'),
                  'PROP'=>'show()',
                  'INLINE'=>'show( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('showModal'),
                  'PROP'=>'showModal()',
                  'INLINE'=>'showModal( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('get_files'),
                  'PROP'=>'get_files()',
                  'INLINE'=>'get_files( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('setOption'),
                  'PROP'=>'setOption()',
                  'INLINE'=>'setOption($name, $value, $ex)',
                  );

$result[] = array(
                  'CAPTION'=>t('getOption'),
                  'PROP'=>'getOption()',
                  'INLINE'=>'getOption($name, $ex)',
                  );

return $result;