<?

$result = [];



$result[] = array(
                  'CAPTION'=>t('get_text'),
                  'PROP'=>'get_text()',
                  'INLINE'=>'get_text ( void )',
                  );
$result[] = array(
                  'CAPTION'=>t('set_text'),
                  'PROP'=>'set_text()',
                  'INLINE'=>'set_text ( $text )',
                  );
$result[] = array(
                  'CAPTION'=>t('get_itemIndex'),
                  'PROP'=>'get_itemIndex()',
                  'INLINE'=>'get_itemIndex ( void )',
                  );
$result[] = array(
                  'CAPTION'=>t('set_itemIndex'),
                  'PROP'=>'set_itemIndex()',
                  'INLINE'=>'set_itemIndex ( $n )',
                  );
$result[] = array(
                  'CAPTION'=>t('get_count'),
                  'PROP'=>'get_count()',
                  'INLINE'=>'get_count ( void )',
                  );
$result[] = array(
                  'CAPTION'=>t('loadFromFile'),
                  'PROP'=>'loadFromFile()',
                  'INLINE'=>'loadFromFile ( $filename )',
                  );
$result[] = array(
                  'CAPTION'=>t('saveToFile'),
                  'PROP'=>'saveToFile()',
                  'INLINE'=>'saveToFile ( $filename )',
                  );
$result[] = array(
                  'CAPTION'=>t('assign'),
                  'PROP'=>'assign()',
                  'INLINE'=>'assign (object $strings)',
                  );
$result[] = array(
                  'CAPTION'=>t('addStrings'),
                  'PROP'=>'addStrings()',
                  'INLINE'=>'addStrings (object $strings)',
                  );
$result[] = array(
                  'CAPTION'=>t('append'),
                  'PROP'=>'append()',
                  'INLINE'=>'append ($new)',
                  );
$result[] = array(
                  'CAPTION'=>t('add'),
                  'PROP'=>'add()',
                  'INLINE'=>'add ($new)',
                  );
$result[] = array(
                  'CAPTION'=>t('delete'),
                  'PROP'=>'delete()',
                  'INLINE'=>'delete ($index)',
                  );
$result[] = array(
                  'CAPTION'=>t('exchange'),
                  'PROP'=>'exchange()',
                  'INLINE'=>'exchange ($index, $index2)',
                  );
$result[] = array(
                  'CAPTION'=>t('clear'),
                  'PROP'=>'clear()',
                  'INLINE'=>'clear ( void )',
                  );
$result[] = array(
                  'CAPTION'=>t('free'),
                  'PROP'=>'free()',
                  'INLINE'=>'free ( void )',
                  );
$result[] = array(
                  'CAPTION'=>t('get_lines'),
                  'PROP'=>'get_lines()',
                  'INLINE'=>'get_lines ( void )',
                  );
$result[] = array(
                  'CAPTION'=>t('get_strings'),
                  'PROP'=>'get_strings()',
                  'INLINE'=>'get_strings ( void )',
                  );
$result[] = array(
                  'CAPTION'=>t('setLine'),
                  'PROP'=>'setLine()',
                  'INLINE'=>'setLine ($index, $name)',
                  );

$result[] = array(
                  'CAPTION'=>t('setLine'),
                  'PROP'=>'setLine()',
                  'INLINE'=>'setLine ($index, $name)',
                  );
$result[] = array(
                  'CAPTION'=>t('getLine'),
                  'PROP'=>'getLine()',
                  'INLINE'=>'getLine ($index)',
                  );
$result[] = array(
                  'CAPTION'=>t('setArray'),
                  'PROP'=>'set[]',
                  'INLINE'=>'setArray ($array)',
                  );
$result[] = array(
                  'CAPTION'=>t('get_selected'),
                  'PROP'=>'get_selected()',
                  'INLINE'=>'get_selected ( void )',
                  );
$result[] = array(
                  'CAPTION'=>t('set_selected'),
                  'PROP'=>'set_selected()',
                  'INLINE'=>'set_selected ($v)',
                  );
$result[] = array(
                  'CAPTION'=>t('indexOf'),
                  'PROP'=>'indexOf()',
                  'INLINE'=>'indexOf ($value)',
                  );
return $result;