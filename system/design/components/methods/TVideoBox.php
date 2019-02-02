<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('Load'),
                  'PROP'=>'Load()',
                  'INLINE'=>'Load( string file, bool $bool_, string caption)',
                  );

$result[] = array(
                  'CAPTION'=>t('Close'),
                  'PROP'=>'Close()',
                  'INLINE'=>'Close( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('Play'),
                  'PROP'=>'Play()',
                  'INLINE'=>'Play( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('Stop'),
                  'PROP'=>'Stop()',
                  'INLINE'=>'Stop( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('Pause'),
                  'PROP'=>'Pause()',
                  'INLINE'=>'Pause( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('Resume'),
                  'PROP'=>'Resume()',
                  'INLINE'=>'Resume( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('GetSeek'),
                  'PROP'=>'GetSeek()',
                  'INLINE'=>'GetSeek( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('Seek'),
                  'PROP'=>'Seek()',
                  'INLINE'=>'Seek( mixed SeekPosition )',
                  );

$result[] = array(
                  'CAPTION'=>t('GetVolume'),
                  'PROP'=>'GetVolume()',
                  'INLINE'=>'GetVolume( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('SetVolume'),
                  'PROP'=>'SetVolume()',
                  'INLINE'=>'SetVolume( int volume )',
                  );

$result[] = array(
                  'CAPTION'=>t('GetLength'),
                  'PROP'=>'GetLength()',
                  'INLINE'=>'GetLength( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('GetZoom'),
                  'PROP'=>'GetZoom()',
                  'INLINE'=>'GetZoom( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('SetZoom'),
                  'PROP'=>'SetZoom()',
                  'INLINE'=>'SetZoom( mixed Zoom )',
                  );

$result[] = array(
                  'CAPTION'=>t('GetSize'),
                  'PROP'=>'GetSize()',
                  'INLINE'=>'GetSize( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('SetSize'),
                  'PROP'=>'SetSize',
                  'INLINE'=>'SetSize( int w, int h)',
                  );

$result[] = array(
                  'CAPTION'=>t('GetPosition'),
                  'PROP'=>'GetPosition()',
                  'INLINE'=>'GetPosition( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('SetPosition'),
                  'PROP'=>'SetPosition()',
                  'INLINE'=>'SetPosition( mixed coordinate )',
                  );

$result[] = array(
                  'CAPTION'=>t('GetRepeat'),
                  'PROP'=>'GetRepeat()',
                  'INLINE'=>'GetRepeat( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('SetRepeat'),
                  'PROP'=>'SetRepeat()',
                  'INLINE'=>'SetRepeat( bool repeat )',
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