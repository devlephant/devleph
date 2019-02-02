<?

$result = array();


$result[] = array(
                  'CAPTION'=>t('File name'),
                  'TYPE'=>'text',
                  'PROP'=>'fileName',
                  );
$result[] = array(
                  'CAPTION'=>t('Filter'),
                  'TYPE'=>'text',
                  'PROP'=>'filter',
                  );
$result[] = array(
                  'CAPTION'=>t('Filter Index'),
                  'TYPE'=>'number',
                  'PROP'=>'filterIndex',
                  );
$result[] = array(
                  'CAPTION'=>t('Initial Dir'),
                  'TYPE'=>'text',
                  'PROP'=>'initialDir',
                  );
$result[] = array(
                  'CAPTION'=>t('Title'),
                  'TYPE'=>'text',
                  'PROP'=>'title',
                  );
$result[] = array(
                  'CAPTION'=>t('Small mode'),
                  'TYPE'=>'check',
                  'PROP'=>'smallMode',
                  );
return $result;