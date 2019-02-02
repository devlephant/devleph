<?

$result = array();



$result[] = array(
                  'CAPTION'=>t('addSection'),
                  'PROP'=>'addSection',
                  'INLINE'=>'addSection ( $group, $caption )',
                  );

$result[] = array(
                  'CAPTION'=>t('addButton'),
                  'PROP'=>'addButton',
                  'INLINE'=>'addButton ( $group )',
                  );

$result[] = array(
                  'CAPTION'=>t('unSelect'),
                  'PROP'=>'unSelect()',
                  'INLINE'=>'unSelect ( void )',
                  );
$result[] = array(
                  'CAPTION'=>t('set_smallIcons'),
                  'PROP'=>'set_smallIcons()',
                  'INLINE'=>'set_smallIcons($enabled)',
                  );

return $result;