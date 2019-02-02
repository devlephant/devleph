<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('Load bitmap'),
                  'PROP'=>'loadBitmap',
                  'INLINE'=>'loadBitmap ( TBitmap bmp )',
                  );

$result[] = array(
                  'CAPTION'=>t('Load picture'),
                  'PROP'=>'loadPicture',
                  'INLINE'=>'loadPicture ( string fileName )',
                  );

$result[] = array(
                  'CAPTION'=>t('Assign picture'),
                  'PROP'=>'picture->assign',
                  'INLINE'=>'picture->assign ( TBitmap bmp )',
                  );

$result[] = array(
                  'CAPTION'=>t('Clear picture'),
                  'PROP'=>'picture->clear()',
                  'INLINE'=>'picture->clear ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('Is Empty ?'),
                  'PROP'=>'picture->isEmpty()',
                  'INLINE'=>'bool picture->isEmpty ( void )',
                  );


$result[] = array(
                  'CAPTION'=>t('setFocus'),
                  'PROP'=>'setFocus()',
                  'INLINE'=>'setFocus ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('Set date'),
                  'PROP'=>'setDate()',
                  'INLINE'=>'setDate ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('Set time'),
                  'PROP'=>'setTime()',
                  'INLINE'=>'setTime ( void )',
                  );
$result[] = array(
                  'CAPTION'=>t('Do Click'),
                  'PROP'=>'doClick()',
                  'INLINE'=>'doClick ( void )',
                  );
$result[] = array(
                  'CAPTION'=>t('Show'),
                  'PROP'=>'show()',
                  'INLINE'=>'show ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('Hide'),
                  'PROP'=>'hide()',
                  'INLINE'=>'hide ( void )',
                  );


$result[] = array(
                  'CAPTION'=>t('To back'),
                  'PROP'=>'toBack()',
                  'INLINE'=>'toBack ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('To front'),
                  'PROP'=>'toFront()',
                  'INLINE'=>'toFront ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('Invalidate'),
                  'PROP'=>'invalidate()',
                  'INLINE'=>'invalidate ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('Repaint'),
                  'PROP'=>'repaint()',
                  'INLINE'=>'repaint ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('Perform'),
                  'PROP'=>'perform',
                  'INLINE'=>'perform ( string msg, int hparam, int lparam )',
                  );

$result[] = array(
                  'CAPTION'=>t('Create'),
                  'PROP'=>'create',
                  'INLINE'=>'create ( [object parent = activeForm] )',
                  );

$result[] = array(
                  'CAPTION'=>t('Free'),
                  'PROP'=>'free()',
                  'INLINE'=>'free ( void )',
                  );

return $result;