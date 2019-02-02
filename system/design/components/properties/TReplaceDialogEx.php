<?

$result = array();
$result[] = array(
                  'CAPTION'=>t('Parent'),
                  'TYPE'=>'components',
                  'PROP'=>'setParent',
                  'ONE_FORM'=>0,
                  );
$result[] = array(
                  'CAPTION'=>t('Text To Find'),
                  'TYPE'=>'components',
                  'PROP'=>'findText',
                  'ONE_FORM'=>0,
                  );
$result[] = array(
                  'CAPTION'=>t('Replace on:'),
                  'TYPE'=>'components',
                  'PROP'=>'replaceText',
                  'ONE_FORM'=>0,
                  );
return $result;