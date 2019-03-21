<?

$result = [];



$result[] = array(
                  'CAPTION'=>t('Submit'),
                  'PROP'=>'submit()',
                  'INLINE'=>'submit ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('Stop request'),
                  'PROP'=>'stop()',
                  'INLINE'=>'stop ( void )',
                  );


$result[] = array(
                  'CAPTION'=>t('Clear data'),
                  'PROP'=>'clear()',
                  'INLINE'=>'clear ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('Add data for request'),
                  'PROP'=>'setData',
                  'INLINE'=>'setData ( string name, string value )',
                  );


$result[] = array(
                  'CAPTION'=>t('Get data for request'),
                  'PROP'=>'getData',
                  'INLINE'=>'string getData ( string name )',
                  );

$result[] = array(
                  'CAPTION'=>t('Add file for request'),
                  'PROP'=>'setFile',
                  'INLINE'=>'setFile ( string name, string fileName )',
                  );

$result[] = array(
                  'CAPTION'=>t('Get file for request'),
                  'PROP'=>'getFile',
                  'INLINE'=>'string getFile ( string name )',
                  );

return $result;