<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('showModal'),
                  'PROP'=>'showModal()',
                  'INLINE'=>'showModal ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('close'),
                  'PROP'=>'close()',
                  'INLINE'=>'close ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('setFocus'),
                  'PROP'=>'setFocus()',
                  'INLINE'=>'setFocus ( void )',
                  );


$result[] = array(
                  'CAPTION'=>t('Load icon file'),
                  'INLINE'=>'icon->loadFromFile ( string fileName )',
                  'PROP'=>'icon->loadFromFile',
                  );
				  
$result[] = array(
                  'CAPTION'=>t('Save to file'),
                  'INLINE'=>'icon->saveToFile ( string fileName )',
                  'PROP'=>'icon->saveToFile',
                  );
				  
$result[] = array(
                  'CAPTION'=>t('Load any file'),
                  'INLINE'=>'icon->loadAnyFile ( string fileName )',
                  'PROP'=>'icon->loadAnyFile',
                  );

$result[] = array(
                  'CAPTION'=>t('Load from stream'),
                  'INLINE'=>'icon->loadFromStream ( TStream stream )',
                  'PROP'=>'icon->loadFromStream',
                  );				  
				  
$result[] = array(
                  'CAPTION'=>t('Save to stream'),
                  'INLINE'=>'icon->saveToStream ( TStream stream )',
                  'PROP'=>'icon->saveToStream',
                  );			
			
$result[] = array(
                  'CAPTION'=>t('Load icon from string'),
                  'INLINE'=>'icon->loadFromStr ( string data, string format = \'bmp\' )',
                  'PROP'=>'icon->loadFromStr',
                  );		

$result[] = array(
                  'CAPTION'=>t('Save icon to string'),
                  'INLINE'=>'icon->saveToStr ( string $str )',
                  'PROP'=>'icon->saveToStr',
                  );
				  		
$result[] = array(
                  'CAPTION'=>t('Assign'),
                  'INLINE'=>'icon->assign ( TBitmap bitmap )',
                  'PROP'=>'icon->assign',
                  );		

$result[] = array(
                  'CAPTION'=>t('Is empty?'),
                  'INLINE'=>'icon->isEmpty ( void )',
                  'PROP'=>'icon->isEmpty',
                  );					  

$result[] = array(
                  'CAPTION'=>t('Copy to clipboard'),
                  'INLINE'=>'icon->copyToClipboard ( void )',
                  'PROP'=>'icon->copyToClipboard',
                  );			
				  
$result[] = array(
                  'CAPTION'=>t('Paste from clipboard'),
                  'INLINE'=>'icon->pasteFromClipboard ( void )',
                  'PROP'=>'icon->pasteFromClipboard',
                  );
				  
$result[] = array(
                  'CAPTION'=>t('Clear image'),
                  'INLINE'=>'icon->clear ( void )',
                  'PROP'=>'icon->clear',
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
                  'CAPTION'=>t('Show'),
                  'PROP'=>'show()',
                  'INLINE'=>'show ( int mode )',
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