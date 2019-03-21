<?

$result = [];


$result[] = array(
                  'CAPTION'=>t('clear'),
                  'PROP'=>'clear()',
                  'INLINE'=>'clear ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('setString'),
                  'PROP'=>'setString',
                  'INLINE'=>'setString ( string text [, boolean head = true] )',
                  );
$result[] = array(
                  'CAPTION'=>t('getString'),
                  'PROP'=>'getString',
                  'INLINE'=>'setString ( [boolean head = true] )',
                  );
$result[] = array(
                  'CAPTION'=>t('loadFile'),
                  'PROP'=>'loadFile',
                  'INLINE'=>'loadFile ( string fileName )',
                  );
$result[] = array(
                  'CAPTION'=>t('saveFile'),
                  'PROP'=>'saveFile',
                  'INLINE'=>'saveFile ( string fileName )',
                  );
$result[] = array(
                  'CAPTION'=>t('setArray'),
                  'PROP'=>'setArray',
                  'INLINE'=>'setArray ( array data [, boolean head = true] )',
                  );
$result[] = array(
                  'CAPTION'=>t('getArray'),
                  'PROP'=>'getArray',
                  'INLINE'=>'getArray ( [boolean head = true] )',
                  );
$result[] = array(
                  'CAPTION'=>t('cells'),
                  'PROP'=>'cells',
                  'INLINE'=>'string cells ( int x, int y [, string value = null] )',
                  );
$result[] = array(
                  'CAPTION'=>t('rows'),
                  'PROP'=>'rows',
                  'INLINE'=>'array rows ( int y [, array data = null] )',
                  );
$result[] = array(
                  'CAPTION'=>t('cols'),
                  'PROP'=>'cols',
                  'INLINE'=>'array cols ( int x [, array data = null] )',
                  );
$result[] = array(
                  'CAPTION'=>t('mouseCoord'),
                  'PROP'=>'mouseCoord',
                  'INLINE'=>'array mouseCoord ( int x, int y )',
                  );
$result[] = array(
                  'CAPTION'=>t('mouseToCell'),
                  'PROP'=>'mouseToCell',
                  'INLINE'=>'array mouseToCell ( int x, int y )',
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