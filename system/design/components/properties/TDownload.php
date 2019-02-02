<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('File for download'),
                  'TYPE'=>'text',
                  'PROP'=>'url',
                  );

$result[] = array(
                  'CAPTION'=>t('Path for save'),
                  'TYPE'=>'text',
                  'PROP'=>'path',
                  );

$result[] = array(
                  'CAPTION'=>t('File name'),
                  'TYPE'=>'',
                  'PROP'=>'fileName',
                  );

$result[] = array(
                  'CAPTION'=>t('Theater Mode'),
                  'TYPE'=>'check',
                  'PROP'=>'thread',
                  );

$result[] = array(
                  'CAPTION'=>t('Priority'),
                  'TYPE'=>'combo',
                  'PROP'=>'priority',
                  'VALUES'=> array('tpIdle', 'tpLowest', 'tpLower', 'tpNormal', 'tpHigher', 'tpHighest',
                                    'tpTimeCritical'),
                  );

$result[] = array(
                  'CAPTION'=>t('Buffer size (bytes)'),
                  'TYPE'=>'number',
                  'PROP'=>'buffer',
                  );

$result[] = array(
                  'CAPTION'=>t('Position'),
                  'TYPE'=>'',
                  'PROP'=>'pos',
                  );

$result[] = array(
                  'CAPTION'=>t('Maximum'),
                  'TYPE'=>'',
                  'PROP'=>'max',
                  );

$result[] = array(
                  'CAPTION'=>t('Error'),
                  'TYPE'=>'',
                  'PROP'=>'error',
                  );

$result[] = array(
                  'CAPTION'=>t('Set value of object'),
                  'TYPE'=>'components',
                  'PROP'=>'setObject',
                  'ONE_FORM'=>0,
                  );

$result[] = array(
                  'CAPTION'=>t('Progress bar'),
                  'TYPE'=>'components',
                  'PROP'=>'setProgress',
                  'ONE_FORM'=>0,
                  );
return $result;