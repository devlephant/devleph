<?

$result = [];


$result[] = array(
                  'CAPTION'=>t('Device'),
                  'TYPE'=>'combo',
                  'PROP'=>'device',
                  'VALUES'=>array('fdScreen', 'fdPrinter', 'fdBoth'),
                  );
_addfont($result);
$result[] = array(
                  'CAPTION'=>t('Min Font size'),
                  'TYPE'=>'number',
                  'PROP'=>'minFontSize',
                  );
$result[] = array(
                  'CAPTION'=>t('Max Font size'),
                  'TYPE'=>'number',
                  'PROP'=>'maxFontSize',
                  );
return $result;