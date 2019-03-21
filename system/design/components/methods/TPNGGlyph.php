<?

$result = [];


$result[] = array(
                  'CAPTION'=>t('loadFromFile'),
                  'PROP'=>'loadFromFile',
                  'INLINE'=>'loadFromFile ( string fileName )',
                  );
$result[] = array(
                  'CAPTION'=>t('loadFromBitmap'),
                  'PROP'=>'loadFromBitmap',
                  'INLINE'=>'loadFromBitmap ( TBitmap bmp )',
                  );
$result[] = array(
                  'CAPTION'=>t('loadFromUrl'),
                  'PROP'=>'loadFromUrl',
                  'INLINE'=>'loadFromUrl ( string url )',
                  );

$result[] = array(
                  'CAPTION'=>t('saveToFile'),
                  'PROP'=>'saveToFile',
                  'INLINE'=>'saveToFile ( string fileName )',
                  );
				  
				  
$result[] = array(
                  'CAPTION'=>t('loadFromStr'),
                  'PROP'=>'picture->loadFromStr',
                  'INLINE'=>'picture->loadFromStr ( string binData, [string format = bmp])',
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
                  'CAPTION'=>t('Copy To Clipboard'),
                  'PROP'=>'picture->copyToClipboard()',
                  'INLINE'=>'picture->copyToClipboard ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('Paste from Clipboard'),
                  'PROP'=>'picture->pasteFromClipboard()',
                  'INLINE'=>'picture->pasteFromClipboard ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('Return TBitmap object'),
                  'PROP'=>'picture->getBitmap()',
                  'INLINE'=>'TBitmap picture->getBitmap ( void )',
                  );



$result[] = array(
                  'CAPTION'=>t('setFocus'),
                  'PROP'=>'setFocus()',
                  'INLINE'=>'setFocus ( void )',
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