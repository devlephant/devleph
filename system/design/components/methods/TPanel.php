<?

$result = [];

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
                  'CAPTION'=>t('setFocus'),
                  'PROP'=>'setFocus()',
                  'INLINE'=>'setFocus ( void )',
                  );
$result[] = array(
                  'CAPTION'=>t('Manual Dock'),
                  'PROP'=>'manualDock', 
                  'INLINE'=>'manualDock ( TControl $obj, int $align = 0 )',
                  );
$result[] = array(
                  'CAPTION'=>t('Manual Float'),
                  'PROP'=>'manualFloat', 
                  'INLINE'=>'manualFloat ( int $left, int $top, int $right, int $bottom )',
                  );
$result[] = array(
                  'CAPTION'=>t('Dock'),
                  'PROP'=>'Dock', 
                  'INLINE'=>'dock ( TControl $obj, int $left, int $top, int $right, int $bottom )',
                  );
$result[] = array(
                  'CAPTION'=>t('Dock Client'),
                  'PROP'=>'dockClient', 
                  'INLINE'=>'dockClient ( int $index )',
                  );
$result[] = array(
                  'CAPTION'=>t('Dock Save To File'),
                  'PROP'=>'dockSaveToFile', 
                  'INLINE'=>'dockSaveToFile ( string $file )',
                  );
$result[] = array(
                  'CAPTION'=>t('Dock Load From File'),
                  'PROP'=>'dockLoadFromFile', 
                  'INLINE'=>'dockLoadFromFile ( string $file )',
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