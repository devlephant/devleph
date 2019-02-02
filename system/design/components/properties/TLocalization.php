<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('Enable'),
                  'TYPE'=>'check',
                  'PROP'=>'enable',
                  );
$result[] = array(
                  'CAPTION'=>t('Language'),
                  'TYPE'=>'text',
                  'PROP'=>'lang',
                  'VALUE'=>'en',
                  );
$result[] = array(
                  'CAPTION'=>t('Lang dir'),
                  'TYPE'=>'text',
                  'PROP'=>'langDir',
                  );
$result[] = array(
                  'CAPTION'=>t('Locale all forms'),
                  'TYPE'=>'check',
                  'PROP'=>'localeAll',
                  );
$result[] = array(
                  'CAPTION'=>t('Forms (names) for locale'),
                  'TYPE'=>'text',
                  'PROP'=>'localeForms',
                  );
/*$result[] = array(
                  'CAPTION'=>t('Save lang in register'),
                  'TYPE'=>'check',
                  'PROP'=>'saveToRegister',
                  );
*/
return $result;