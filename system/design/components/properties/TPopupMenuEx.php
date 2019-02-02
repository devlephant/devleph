<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('Menu Items'),
                  'TYPE'=>'menu',
                  'PROP'=>'data',
                  );
$result[] = array(
                  'CAPTION'=>t('Objects'),
                  'TYPE'=>'components',
                  'PROP'=>'objects',
                  );

$result[] = array(
                  'CAPTION'=>t('Styled'),
                  'TYPE'=>'check',
                  'PROP'=>'styled',
                  );


return $result;