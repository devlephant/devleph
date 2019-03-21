<?

$result = [];


$result[] = array(
                  'CAPTION'=>t('lineTo'),
                  'PROP'=>'lineTo',
                  'INLINE'=>'lineTo ( int x, int y )',
                  );

$result[] = array(
                  'CAPTION'=>t('moveTo'),
                  'PROP'=>'moveTo',
                  'INLINE'=>'moveTo ( int x, int y )',
                  );

$result[] = array(
                  'CAPTION'=>t('textHeight'),
                  'PROP'=>'textHeight',
                  'INLINE'=>'textHeight ( string text )',
                  );

$result[] = array(
                  'CAPTION'=>t('textWidth'),
                  'PROP'=>'textWidth',
                  'INLINE'=>'textWidth ( string text )',
                  );

$result[] = array(
                  'CAPTION'=>t('refresh'),
                  'PROP'=>'refresh()',
                  'INLINE'=>'refresh ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('pixel'),
                  'PROP'=>'pixel',
                  'INLINE'=>'int pixel ( int x, int y [, int color = NULL] )',
                  );

$result[] = array(
                  'CAPTION'=>t('textOut'),
                  'PROP'=>'textOut',
                  'INLINE'=>'textOut ( int x, int y, string text )',
                  );

$result[] = array(
                  'CAPTION'=>t('rectangle'),
                  'PROP'=>'rectangle',
                  'INLINE'=>'rectangle ( int x1, int y1, int x2, int y2 )',
                  );


$result[] = array(
                  'CAPTION'=>t('ellipse'),
                  'PROP'=>'ellipse',
                  'INLINE'=>'ellipse ( int x1, int y1, int x2, int y2 )',
                  );

$result[] = array(
                  'CAPTION'=>t('lock'),
                  'PROP'=>'lock()',
                  'INLINE'=>'lock ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('unlock'),
                  'PROP'=>'unlock()',
                  'INLINE'=>'unlock ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('drawBitmap'),
                  'PROP'=>'drawBitmap',
                  'INLINE'=>'drawBitmap ( TBitmap bmp [, int x = 0, int y = 0 ] )',
                  );

$result[] = array(
                  'CAPTION'=>t('drawPicture'),
                  'PROP'=>'drawPicture',
                  'INLINE'=>'drawPicture ( string fileName [, int x = 0, int y = 0 ] )',
                  );

$result[] = array(
                  'CAPTION'=>t('clear'),
                  'PROP'=>'clear()',
                  'INLINE'=>'clear ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('textOutAngle'),
                  'PROP'=>'textOutAngle',
                  'INLINE'=>'textOutAngle ( int x, int y, int angle, string text )',
                  );

$result[] = array(
                  'CAPTION'=>t('writeBitmap'),
                  'PROP'=>'writeBitmap',
                  'INLINE'=>'writeBitmap ( TBitmap &bmp )',
                  );

$result[] = array(
                  'CAPTION'=>t('savePicture'),
                  'PROP'=>'savePicture',
                  'INLINE'=>'savePicture ( string fileName )',
                  );

$result[] = array(
                  'CAPTION'=>t('loadPicture'),
                  'PROP'=>'loadPicture',
                  'INLINE'=>'loadPicture ( string fileName )',
                  );

$result[] = array(
                  'CAPTION'=>t('free'),
                  'PROP'=>'free()',
                  'INLINE'=>'free ( void )',
                  );

return $result;