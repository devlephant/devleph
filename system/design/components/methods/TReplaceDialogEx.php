<?

$result = [];

$result[] = array(
                  'CAPTION'=>t('execute'),
                  'PROP'=>'execute()',
                  'INLINE'=>'boolean execute( void )',
                  );
$result[] = array(
                  'CAPTION'=>t('get_isMatchCase'),
                  'PROP'=>'get_isMatchCase()',
                  'INLINE'=>'get_isMatchCase( void )',
                  );
$result[] = array(
                  'CAPTION'=>t('get_isMatchCase'),
                  'PROP'=>'set_isMatchCase()',
                  'INLINE'=>'set_isMatchCase( $v )',
                  );

return $result;