<?

$result = [];

$result[] = array(
                  'CAPTION'=>t('Height'),
                  'TYPE'=>'text',
                  'PROP'=>'xheight',
                  );
$result[] = array(
                  'CAPTION'=>t('Width'),
                  'TYPE'=>'text',
                  'PROP'=>'xwidth',
                  );

$result[] = array(
                  'CAPTION'=>t('Masked'),
                  'TYPE'=>'check',
                  'PROP'=>'masked',
                  );

$result[] = array(
                  'CAPTION'=>t('Share Images'),
                  'TYPE'=>'check',
                  'PROP'=>'shareImages',
                  );

$result[] = array(
                  'CAPTION'=>t('Images'),
                  'TYPE'=>'images',
                  'PROP'=>'',
                  );

return $result;