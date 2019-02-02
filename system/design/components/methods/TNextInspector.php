<?

$result = array();



$result[] = array(
                  'CAPTION'=>t('addItem'),
                  'PROP'=>'addItem',
                  'INLINE'=>'addItem($parent, $item, $pos = apLast)',
                  );

$result[] = array(
                  'CAPTION'=>t('add'),
                  'PROP'=>'add',
                  'INLINE'=>'add(TNxPropertyItem $item, $caption = \'\')',
                  );
                  
$result[] = array(
                  'CAPTION'=>t('get_selectedIndex'),
                  'PROP'=>'get_selectedIndex',
                  'INLINE'=>'get_selectedIndex()',
                  );                  
$result[] = array(
                  'CAPTION'=>t('unFocus'),
                  'PROP'=>'unFocus()',
                  'INLINE'=>'unFocus()',
                  );


return $result;