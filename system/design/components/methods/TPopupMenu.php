<?

$result = [];



$result[] = array(
                  'CAPTION'=>t('addItem'),
                  'PROP'=>'addItem',
                  'INLINE'=>'addItem( TMenuItem item )',
                  );

$result[] = array(
                  'CAPTION'=>t('popup'),
                  'PROP'=>'popup',
                  'INLINE'=>'popup( int x, int y )',
                  );

return $result;