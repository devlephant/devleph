<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('Get Lower String'),
                  'PROP'=>'toLower()',
                  'INLINE'=>'string toLower ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('Get Upper String'),
                  'PROP'=>'toUpper()',
                  'INLINE'=>'string toUpper ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('Get MD5 Hash'),
                  'PROP'=>'md5()',
                  'INLINE'=>'string md5 ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('Get CRC32 Hash'),
                  'PROP'=>'crc32()',
                  'INLINE'=>'string crc32 ( void )',
                  );

return $result;