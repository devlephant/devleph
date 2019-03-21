<?

$result = [];

$result[] = array(
                  'CAPTION'=>t('play'),
                  'PROP'=>'play()',
                  'INLINE'=>'play( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('stop'),
                  'PROP'=>'stop()',
                  'INLINE'=>'stop( void )',
                  );
				  
$result[] = array(
                  'CAPTION'=>t('resume'),
                  'PROP'=>'resume()',
                  'INLINE'=>'resume( void )',
                  );	

$result[] = array(
                  'CAPTION'=>t('pause'),
                  'PROP'=>'pause()',
                  'INLINE'=>'pause( void )',
                  );				  
				  
$result[] = array(
                  'CAPTION'=>t('status'),
                  'PROP'=>'status()',
                  'INLINE'=>'status( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('vol'),
                  'PROP'=>'vol',
                  'INLINE'=>'vol( $volume )',
                  );

return $result;

?>