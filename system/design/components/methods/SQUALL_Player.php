<?

$result = array();



$result[] = array(
                  'CAPTION'=>t('play'),
                  'PROP'=>'play()',
                  'INLINE'=>'play ( void )',
                  );
$result[] = array(
                  'CAPTION'=>t('pause'),
                  'PROP'=>'pause()',
                  'INLINE'=>'pause ( void )',
                  );
$result[] = array(
                  'CAPTION'=>t('stop'),
                  'PROP'=>'stop()',
                  'INLINE'=>'stop ( void )',
                  );
$result[] = array(
                  'CAPTION'=>t('open'),
                  'PROP'=>'open',
                  'INLINE'=>'open ( string fileName )',
                  );

$result[] = array(
                  'CAPTION'=>t('isPlay'),
                  'PROP'=>'isPlay()',
                  'INLINE'=>'boolean isPlay ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('isPause'),
                  'PROP'=>'isPause()',
                  'INLINE'=>'boolean isPause ( void )',
                  );

return $result;