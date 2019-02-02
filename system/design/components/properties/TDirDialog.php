<?

$result = array();


$result[] = array(
                  'CAPTION'=>t('File name'),
                  'TYPE'=>'text',
                  'PROP'=>'fileName',
                  );
$result[] = array(
                  'CAPTION'=>t('Caption'),
                  'TYPE'=>'text',
                  'PROP'=>'title',
                  );
$result[] = array(
                  'CAPTION'=>t('Root'),
                  'TYPE'=>'text',
                  'PROP'=>'root',
                  );

return $result;