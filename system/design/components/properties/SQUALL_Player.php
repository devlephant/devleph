<?

$result = [];

$result[] = array(
                  'CAPTION'=>t('File name'),
                  'TYPE'=>'files',
                  'EXT'=>array('wav','mp3','mp2','ogg','wave'),
                  'RECURSIVE'=>true,
                  'PROP'=>'fileName',
                  );
$result[] = array(
                  'CAPTION'=>t('Volume').' (0-100%)',
                  'TYPE'=>'number',
                  'PROP'=>'volume',
                  );
$result[] = array(
                  'CAPTION'=>t('Loop'),
                  'TYPE'=>'check',
                  'PROP'=>'loop',
                  );
$result[] = array(
                  'CAPTION'=>t('Panorama'). ' (0-100)',
                  'TYPE'=>'number',
                  'PROP'=>'pan',
                  );
$result[] = array(
                  'CAPTION'=>t('Frequency').' (0, 100-100000)',
                  'TYPE'=>'number',
                  'PROP'=>'frequency',
                  );

$result[] = array(
                  'CAPTION'=>t('Position').' (0-100%)',
                  'TYPE'=>'number',
                  'PROP'=>'positionPr',
                  );

$result[] = array(
                  'CAPTION'=>t('Pause'),
                  'TYPE'=>'',
                  'PROP'=>'pause',
                  );

$result[] = array(
                  'CAPTION'=>t('Length'),
                  'TYPE'=>'',
                  'PROP'=>'length',
                  );

$result[] = array(
                  'CAPTION'=>t('Length (Milliseconds)'),
                  'TYPE'=>'',
                  'PROP'=>'lengthMs',
                  );
$result[] = array(
                  'CAPTION'=>t('Position'),
                  'TYPE'=>'',
                  'PROP'=>'position',
                  );

$result[] = array(
                  'CAPTION'=>t('Position (Milliseconds)'),
                  'TYPE'=>'',
                  'PROP'=>'positionMs',
                  );

$result[] = array(
                  'CAPTION'=>t('Status'),
                  'TYPE'=>'',
                  'PROP'=>'status',
                  );

$result[] = array(
                  'CAPTION'=>t('Fragment'). ' (array[start,end])',
                  'TYPE'=>'',
                  'PROP'=>'fragment',
                  );

$result[] = array(
                  'CAPTION'=>t('Fragment (Milliseconds)'). ' (array[start,end])',
                  'TYPE'=>'',
                  'PROP'=>'fragmentMs',
                  );

$result[] = array(
                  'CAPTION'=>t('Play on start'),
                  'TYPE'=>'check',
                  'PROP'=>'playOnStart',
                  );


return $result;