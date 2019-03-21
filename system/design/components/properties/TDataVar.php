<?

$result = [];

$result[] = array(
                  'CAPTION'=>t('Value'),
                  'TYPE'=>'text',
                  'PROP'=>'value',
                  );

$result[] = array(
                  'CAPTION'=>t('File name for save'),
                  'TYPE'=>'text',
                  'PROP'=>'fileName',
                  );

$result[] = array(
                  'CAPTION'=>t('Update file on change value'),
                  'TYPE'=>'check',
                  'PROP'=>'updateChange',
                  );

$result[] = array(
                  'CAPTION'=>t('Serialize value'),
                  'TYPE'=>'check',
                  'PROP'=>'serialize',
                  );

$result[] = array(
                  'CAPTION'=>t('Name of global var'),
                  'TYPE'=>'text',
                  'PROP'=>'varName',
                  );
$result[] = array(
                  'CAPTION'=>t('Set value of object'),
                  'TYPE'=>'components',
                  'PROP'=>'setObject',
                  'ONE_FORM'=>0,
                  );

return $result;