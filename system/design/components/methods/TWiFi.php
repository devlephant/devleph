<?

$result = array();



$result[] = array(
                  'CAPTION'=>t('getInformation'),
                  'PROP'=>'getInformation()',
                  'INLINE'=>'getInformation ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('networksList'),
                  'PROP'=>'networksList()',
                  'INLINE'=>'networksList ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('connectNetwork'),
                  'PROP'=>'connectNetwork()',
                  'INLINE'=>'connectNetwork ($name)',
                  );


$result[] = array(
                  'CAPTION'=>t('disconnect'),
                  'PROP'=>'disconnect()',
                  'INLINE'=>'disconnect ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('showInterface'),
                  'PROP'=>'showInterface()',
                  'INLINE'=>'showInterface ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('Connection'),
                  'PROP'=>'connection()',
                  'INLINE'=>'connection ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('State'),
                  'PROP'=>'state()',
                  'INLINE'=>'state ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('cipher'),
                  'PROP'=>'cipher',
                  'INLINE'=>'cipher ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('typeRadio'),
                  'PROP'=>'typeRadio',
                  'INLINE'=>'typeRadio ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('typeNetwork'),
                  'PROP'=>'typeNetwork',
                  'INLINE'=>'typeNetwork ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('receipt'),
                  'PROP'=>'receipt',
                  'INLINE'=>'receipt ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('speedR'),
                  'PROP'=>'speedR',
                  'INLINE'=>'speedR ( void )',
                  );
				  
$result[] = array(
                  'CAPTION'=>t('signal'),
                  'PROP'=>'signal',
                  'INLINE'=>'signal ( void )',
                  );
$result[] = array(
                  'CAPTION'=>t('Free'),
                  'PROP'=>'free()',
                  'INLINE'=>'free ( void )',
                  );
return $result;