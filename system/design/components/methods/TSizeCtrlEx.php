<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('addTarget'),
                  'PROP'=>'addTarget',
                  'INLINE'=>'addTarget ( object target [, init = true] )',
                  );

$result[] = array(
                  'CAPTION'=>t('deleteTarget'),
                  'PROP'=>'deleteTarget',
                  'INLINE'=>'deleteTarget ( object target )',
                  );

$result[] = array(
                  'CAPTION'=>t('indexOf'),
                  'PROP'=>'indexOf',
                  'INLINE'=>'int indexOf ( object target )',
                  );


$result[] = array(
                  'CAPTION'=>t('registerTarget'),
                  'PROP'=>'registerTarget',
                  'INLINE'=>'registerTarget ( object target )',
                  );

$result[] = array(
                  'CAPTION'=>t('unRegisterTarget'),
                  'PROP'=>'unRegisterTarget',
                  'INLINE'=>'unRegisterTarget ( object target )',
                  );

$result[] = array(
                  'CAPTION'=>t('clearTargets'),
                  'PROP'=>'clearTargets()',
                  'INLINE'=>'clearTargets ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('unRegisterAll'),
                  'PROP'=>'unRegisterAll()',
                  'INLINE'=>'unRegisterAll ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('update'),
                  'PROP'=>'update()',
                  'INLINE'=>'update ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('Free'),
                  'PROP'=>'free()',
                  'INLINE'=>'free ( void )',
                  );


return $result;