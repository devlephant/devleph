<?

$result = [];


$result[] = array(
                  'CAPTION'=>t('Caption'),
                  'TYPE'=>'text',
                  'PROP'=>'formCaption',
                  );
$result[] = array(
                  'CAPTION'=>t('Text'),
                  'TYPE'=>'text',
                  'PROP'=>'title',
                  );
$result[] = array(
                  'CAPTION'=>t('Buttons'),
                  'TYPE'=>'text',
                  'PROP'=>'buttons',
                  );
$result[] = array(
                  'CAPTION'=>t('Buttons Width'),
                  'TYPE'=>'number',
                  'PROP'=>'buttonsWidth',
                  );
$result[] = array(
                  'CAPTION'=>t('Buttons Height'),
                  'TYPE'=>'number',
                  'PROP'=>'buttonsHeight',
                  );
$result[] = array(
                  'CAPTION'=>t('Button Focus'),
                  'TYPE'=>'number',
                  'PROP'=>'buttonFocus',
                  );
$result[] = array(
                  'CAPTION'=>t('Result as text'),
                  'TYPE'=>'check',
                  'PROP'=>'resultAsText',
                  );
$result[] = array(
                  'CAPTION'=>t('Use Hot Key'),
                  'TYPE'=>'check',
                  'PROP'=>'useHotKey',
                  );
$result[] = array(
                  'CAPTION'=>t('Color'),
                  'TYPE'=>'color',
                  'PROP'=>'formColor',
                  );
$result[] = array(
                  'CAPTION'=>t('Button Font Size'),
                  'TYPE'=>'number',
                  'PROP'=>'buttonFSize',
                  );
$result[] = array(
                  'CAPTION'=>t('Button Font Color'),
                  'TYPE'=>'color',
                  'PROP'=>'buttonFColor',
                  );
_addfont($result);


$result[] = array(
                  'CAPTION'=>t('Result'),
                  'TYPE'=>'',
                  'PROP'=>'result',
                  );

$result[] = array(
                  'CAPTION'=>t('Cursor'),
                  'TYPE'=>'combo',
                  'PROP'=>'cursorDialog',
                  'VALUES'=>$GLOBALS['cursors_meta'],
				  'NO_CONST'=>true,
                  'ADD_GROUP'=>true,
                  );


return $result;