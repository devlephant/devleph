<?

$result = [];

$result[] = array(
                  'CAPTION'=>t('URL Address'),
                  'PROP'=>'getAddress()',
                  'INLINE'=>'string getAddress ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('goBack'),
                  'PROP'=>'goBack()',
                  'INLINE'=>'goBack ( void )',
                  );
$result[] = array(
                  'CAPTION'=>t('canGoBack'),
                  'PROP'=>'canGoBack()',
                  'INLINE'=>'bool canGoBack ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('goForward'),
                  'PROP'=>'goForward()',
                  'INLINE'=>'goForward ( void )',
                  );
$result[] = array(
                  'CAPTION'=>t('canGoForward'),
                  'PROP'=>'canGoForward()',
                  'INLINE'=>'bool canGoForward ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('clearHistory'),
                  'PROP'=>'clearHistory()',
                  'INLINE'=>'clearHistory ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('hidePopup'),
                  'PROP'=>'hidePopup()',
                  'INLINE'=>'hidePopup ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('setFocus'),
                  'PROP'=>'setFocus',
                  'INLINE'=>'setFocus ( [bool enable = false] )',
                  );
                  
$result[] = array(
                  'CAPTION'=>t('stopLoad'),
                  'PROP'=>'stopLoad()',
                  'INLINE'=>'stopLoad ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('reload'),
                  'PROP'=>'reload()',
                  'INLINE'=>'reload ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('reloadIgnoreCache'),
                  'PROP'=>'reloadIgnoreCache()',
                  'INLINE'=>'reloadIgnoreCache ( void )',
                  );
                  

$result[] = array(
                  'CAPTION'=>t('showPrint'),
                  'PROP'=>'showPrint()',
                  'INLINE'=>'showPrint ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('load'),
                  'PROP'=>'load',
                  'INLINE'=>'load ( string url )',
                  );


$result[] = array(
                  'CAPTION'=>t('loadString'),
                  'PROP'=>'loadString',
                  'INLINE'=>'loadString ( string str, [string url = "auto:blank"] )',
                  );

$result[] = array(
                  'CAPTION'=>t('loadFile'),
                  'PROP'=>'loadFile',
                  'INLINE'=>'loadFile ( string fileName, [string url = "auto:blank"] )',
                  );

$result[] = array(
                  'CAPTION'=>t('executeJs'),
                  'PROP'=>'executeJs',
                  'INLINE'=>'executeJs ( string code, [string url = "auto:blank"] )',
                  );   
                  
                  
$result[] = array(
                  'CAPTION'=>t('sendFocusEvent'),
                  'PROP'=>'sendFocusEvent',
                  'INLINE'=>'sendFocusEvent ( int event )',
                  );

$result[] = array(
                  'CAPTION'=>t('sendKeyEvent'),
                  'PROP'=>'sendKeyEvent',
                  'INLINE'=>'sendKeyEvent ( int type, int key, int modifers, int sysChar, int imeChar )',
                  );     
                  
$result[] = array(
                  'CAPTION'=>t('sendMouseClickEvent'),
                  'PROP'=>'sendMouseClickEvent',
                  'INLINE'=>'sendMouseClickEvent ( int x, int y, int type, int mouseUp, int clickCnt )',
                  );

$result[] = array(
                  'CAPTION'=>t('scrollBy'),
                  'PROP'=>'scrollBy',
                  'INLINE'=>'scrollBy ( int x, int y )',
                  );

$result[] = array(
                  'CAPTION'=>t('undo'),
                  'PROP'=>'undo()',
                  'INLINE'=>'undo ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('redo'),
                  'PROP'=>'redo()',
                  'INLINE'=>'redo ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('cut'),
                  'PROP'=>'cut()',
                  'INLINE'=>'cut ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('copy'),
                  'PROP'=>'copy()',
                  'INLINE'=>'copy ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('paste'),
                  'PROP'=>'paste()',
                  'INLINE'=>'paste ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('del'),
                  'PROP'=>'del()',
                  'INLINE'=>'del ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('selectAll'),
                  'PROP'=>'selectAll()',
                  'INLINE'=>'selectAll ( void )',
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