<?

$result = [];

$result[] = array(
                  'CAPTION'=>t('File Url'),
                  'TYPE'=>'text',
                  'PROP'=>'url',
                  );


$result[] = array(
                  'CAPTION'=>t('Volume').' (0-500)',
                  'TYPE'=>'text',
                  'PROP'=>'volume',
                  );
$result[] = array(
                  'CAPTION'=>t('Repeat'),
                  'TYPE'=>'check',
                  'PROP'=>'repeat',
                  );				  

$result[] = array(
                  'CAPTION'=>t('Play On Start'),
                  'TYPE'=>'check',
                  'PROP'=>'PlayOnStart',
                  );


$result[] = array(
                  'CAPTION'=>t('Priority'),
                  'TYPE'=>'combo',
                  'PROP'=>'priority',
                  'VALUES'=> array('tpIdle', 'tpLowest', 'tpLower', 'tpNormal', 'tpHigher', 'tpHighest',
                                    'tpTimeCritical'),
                  );

return $result;

?>