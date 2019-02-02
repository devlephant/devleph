<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('clearEx'),
                  'PROP'=>'clearEx()',
                  'INLINE'=>'clearEx( [boolean fixed = true] )',
                  );

$result[] = array(
                  'CAPTION'=>t('addRow'),
                  'PROP'=>'addRow()',
                  'INLINE'=>'addRow( [int index = "END(HOME,PREV,NEXT,END)"] )',
                  );

$result[] = array(
                  'CAPTION'=>t('addCol'),
                  'PROP'=>'addCol()',
                  'INLINE'=>'addCol( [int index = "END(HOME,PREV,NEXT,END)"] )',
                  );

$result[] = array(
                  'CAPTION'=>t('deleteRow'),
                  'PROP'=>'deleteRow()',
                  'INLINE'=>'deleteRow( [int index = -1 [, boolean fixed = true] ] )',
                  );

$result[] = array(
                  'CAPTION'=>t('deleteCol'),
                  'PROP'=>'deleteCol()',
                  'INLINE'=>'deleteCol( [int index = -1 [, boolean fixed = true] ] )',
                  );

$result[] = array(
                  'CAPTION'=>t('rowH'),
                  'PROP'=>'rowH()',
                  'INLINE'=>'rowH( int index [, int h] )',
                  );

$result[] = array(
                  'CAPTION'=>t('colW'),
                  'PROP'=>'colW()',
                  'INLINE'=>'colW( int index [, int w] )',
                  );

$result[] = array(
                  'CAPTION'=>t('rowHeight'),
                  'PROP'=>'rowHeight()',
                  'INLINE'=>'rowHeight( int index [, int h] )',
                  );

$result[] = array(
                  'CAPTION'=>t('colWidth'),
                  'PROP'=>'colWidth()',
                  'INLINE'=>'colWidth( int index [, int w] )',
                  );

$result[] = array(
                  'CAPTION'=>t('get_rowsHeight'),
                  'PROP'=>'get_rowsHeight()',
                  'INLINE'=>'get_rowsHeight( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('set_rowsHeight'),
                  'PROP'=>'set_rowsHeight()',
                  'INLINE'=>'set_rowsHeight( array )',
                  );

$result[] = array(
                  'CAPTION'=>t('get_colsWidth'),
                  'PROP'=>'get_colsWidth()',
                  'INLINE'=>'get_colsWidth( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('set_colsWidth'),
                  'PROP'=>'set_colsWidth()',
                  'INLINE'=>'set_colsWidth( array data )',
                  );

$result[] = array(
                  'CAPTION'=>t('get_rowsText'),
                  'PROP'=>'get_rowsText()',
                  'INLINE'=>'get_rowsText( [, boolean fixed = true] )',
                  );

$result[] = array(
                  'CAPTION'=>t('set_rowsText'),
                  'PROP'=>'set_rowsText()',
                  'INLINE'=>'set_rowsText( array data [, boolean fixed = true [, boolean cfr = true [, boolean cfc = true] ] ] )',
                  );

$result[] = array(
                  'CAPTION'=>t('get_colsText'),
                  'PROP'=>'get_colsText()',
                  'INLINE'=>'get_colsText( [, boolean fixed = true] )',
                  );

$result[] = array(
                  'CAPTION'=>t('set_colsText'),
                  'PROP'=>'set_colsText()',
                  'INLINE'=>'set_colsText( array data [, boolean fixed = true [, boolean cfr = true [, boolean cfc = true] ] ] )',
                  );

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