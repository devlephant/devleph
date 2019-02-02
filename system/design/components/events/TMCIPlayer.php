<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('On Start Track'),
                  'EVENT'=>'onStartTrack',
                  'INFO'=>'%func%($self)',
                  'ICON'=>'onstarttrack',
                  );

$result[] = array(
                  'CAPTION'=>t('On End Track'),
                  'EVENT'=>'onEndTrack',
                  'INFO'=>'%func%($self)',
                  'ICON'=>'onendtrack',
                  );

return $result;
?>