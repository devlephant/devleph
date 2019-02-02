<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('LoadFromArray'),
                  'PROP'=>'LoadFromArray',
                  'INLINE'=>'LoadFromArray ( array $arr )',
                  );

$result[] = array(
                  'CAPTION'=>t('LoadFromFile'),
                  'PROP'=>'LoadFromFile',
                  'INLINE'=>'LoadFromFile ( string $file )',
                  );

$result[] = array(
                  'CAPTION'=>t('saveToFile'),
                  'PROP'=>'saveToFile',
                  'INLINE'=>'saveToFile ( string $file )',
                  );

return $result;