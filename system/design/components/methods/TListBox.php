<?

$result = [];



$result[] = array(
                  'CAPTION'=>t('getFont'),
                  'PROP'=>'getFont',
                  'INLINE'=>'TFont getFont ( int index )',
                  );

$result[] = array(
                  'CAPTION'=>t('clearFont'),
                  'PROP'=>'clearFont',
                  'INLINE'=>'clearFont ( int index )',
                  );

$result[] = array(
                  'CAPTION'=>t('getItemColor'),
                  'PROP'=>'getItemColor',
                  'INLINE'=>'int getItemColor ( int index )',
                  );

$result[] = array(
                  'CAPTION'=>t('setItemColor'),
                  'PROP'=>'setItemColor',
                  'INLINE'=>'setItemColor ( int index, int color )',
                  );

$result[] = array(
                  'CAPTION'=>t('clearItemColor'),
                  'PROP'=>'clearItemColor',
                  'INLINE'=>'clearItemColor ( int index )',
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