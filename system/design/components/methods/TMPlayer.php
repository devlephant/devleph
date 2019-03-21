<?

$result = [];


$result[] = array(
                  'CAPTION'=>t('get_filename'),
                  'PROP'=>'get_filename()',
                  'INLINE'=>'get_filename ( void )',
                  );
$result[] = array(
                  'CAPTION'=>t('set_filename'),
                  'PROP'=>'set_filename()',
                  'INLINE'=>'set_filename ( $v )',
                  );
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
                  'INLINE'=>'open ( void )',
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
$result[] = array(
                  'CAPTION'=>t('isStop'),
                  'PROP'=>'isStop()',
                  'INLINE'=>'boolean isStop ( void )',
                  );
$result[] = array(
                  'CAPTION'=>t('get_position'),
                  'PROP'=>'get_position()',
                  'INLINE'=>'get_position ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('set_position'),
                  'PROP'=>'set_position()',
                  'INLINE'=>'set_position ($v)',
                  );

$result[] = array(
                  'CAPTION'=>t('get_length'),
                  'PROP'=>'get_length()',
                  'INLINE'=>'get_length ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('get_start'),
                  'PROP'=>'get_start()',
                  'INLINE'=>'get_start ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('get_startpos'),
                  'PROP'=>'get_startpos()',
                  'INLINE'=>'get_startpos ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('get_endpos'),
                  'PROP'=>'get_endpos()',
                  'INLINE'=>'get_endpos ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('eject'),
                  'PROP'=>'eject()',
                  'INLINE'=>'eject ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('get_enable'),
                  'PROP'=>'get_enable()',
                  'INLINE'=>'get_enable ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('set_enable'),
                  'PROP'=>'set_enable()',
                  'INLINE'=>'set_enable ( $v )',
                  );

$result[] = array(
                  'CAPTION'=>t('set_autoopen'),
                  'PROP'=>'set_autoopen()',
                  'INLINE'=>'set_autoopen ( $v )',
                  );

$result[] = array(
                  'CAPTION'=>t('set_autorewind'),
                  'PROP'=>'set_autorewind()',
                  'INLINE'=>'set_autorewind ( $v )',
                  );

$result[] = array(
                  'CAPTION'=>t('set_autoenable'),
                  'PROP'=>'set_autoenable()',
                  'INLINE'=>'set_autoenable ( $v )',
                  );

$result[] = array(
                  'CAPTION'=>t('set_shareable'),
                  'PROP'=>'set_shareable()',
                  'INLINE'=>'set_shareable ( $v )',
                  );

return $result;