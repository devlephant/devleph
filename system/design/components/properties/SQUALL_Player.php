<?

$result = [];

$result[] = [
                  'CAPTION'=>t('File name'),
                  'TYPE'=>'files',
                  'EXT'=>['wav','mp3','mp2','ogg','wave'],
                  'RECURSIVE'=>true,
                  'PROP'=>'fileName',
			];
$result[] = [
                  'CAPTION'=>t('Volume').' (0-100%)',
                  'TYPE'=>'number',
                  'PROP'=>'volume',
            ];
$result[] = [
                  'CAPTION'=>t('Loop'),
                  'TYPE'=>'check',
                  'PROP'=>'loop',
			];
$result[] = [
                  'CAPTION'=>t('Panorama'). ' (0-100)',
                  'TYPE'=>'number',
                  'PROP'=>'pan',
            ];
$result[] =	[
                  'CAPTION'=>t('Frequency').' (0, 100-100000)',
                  'TYPE'=>'number',
                  'PROP'=>'frequency',
            ];

$result[] = [
                  'CAPTION'=>t('Position').' (0-100%)',
                  'TYPE'=>'number',
                  'PROP'=>'positionPr',
            ];

$result[] =	[
                  'CAPTION'=>t('Pause'),
                  'TYPE'=>'',
                  'PROP'=>'pause',
            ];

$result[] = [
                  'CAPTION'=>t('Length'),
                  'TYPE'=>'',
                  'PROP'=>'length',
            ];

$result[] = [
                  'CAPTION'=>t('Length (Milliseconds)'),
                  'TYPE'=>'',
                  'PROP'=>'lengthMs',
            ];
$result[] =	[
                  'CAPTION'=>t('Position'),
                  'TYPE'=>'',
                  'PROP'=>'position',
            ];

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