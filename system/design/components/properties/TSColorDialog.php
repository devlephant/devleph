<?

$result = [];


$result[] = array(
                  'CAPTION'=>t('Color'),
                  'TYPE'=>'color',
                  'PROP'=>'color',
                  );
				  
$result[] = array(
                  'CAPTION'=>t('Use Alpha'),
                  'TYPE'=>'check',
                  'PROP'=>'UseAlpha',
                  );
				  
$result[] = array(
                  'CAPTION'=>t('Standart look'),
                  'TYPE'=>'check',
                  'PROP'=>'standartDialog',
                  );
				  //Options = cdFullOpen, cdPreventFullOpen, cdShowHelp,
    //cdSolidColor, cdAnyColor
$result[] = array(
                  'CAPTION'=>t('Ctl3d'),
                  'TYPE'=>'check',
                  'PROP'=>'Ctl3d',
                  );

return $result;