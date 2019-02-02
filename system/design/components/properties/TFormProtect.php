<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('Active'),
                  'TYPE'=>'check',
                  'PROP'=>'active',
                  );
				  
$result[] = array(
                  'CAPTION'=>t('Auth Form'),
                  'TYPE'=>'components',
                  'PROP'=>'form',
                  'ONE_FORM'=>0
                  );
				  
$result[] = array(
                  'CAPTION'=>t('Error Form'),
                  'TYPE'=>'components',
                  'PROP'=>'errForm',
                  'ONE_FORM'=>0
                  );

$result[] = array(
                  'CAPTION'=>t('Key'),
                  'TYPE'=>'text',
                  'PROP'=>'key',
                  );

$result[] = array(
                  'CAPTION'=>t('Input Key'),
                  'TYPE'=>'components',
                  'PROP'=>'inputKey',
				  'ONE_FORM'=>0
                  );
				  
$result[] = array(
                  'CAPTION'=>t('Trial Time (sec)'),
                  'TYPE'=>'number',
                  'PROP'=>'trialTime',
                  );
				  
return $result;