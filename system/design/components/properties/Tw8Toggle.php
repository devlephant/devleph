<?

$result = [];

$result[] = array(
                  'CAPTION'=>t('Enabled Color'),
                  'TYPE'=>'color',
                  'PROP'=>'enabledColor',
                  );
				  
$result[] = array(
                  'CAPTION'=>t('Disabled Color'),
                  'TYPE'=>'color',
                  'PROP'=>'disabledColor',
                  );
				  
$result[] = array(
                  'CAPTION'=>t('Switched'),
                  'TYPE'=>'check',
                  'PROP'=>'switched',
                  );
				  
$result[] = array(
                  'CAPTION'=>t('Smoothness'),
                  'TYPE'=>'check',
                  'PROP'=>'smoothness',
                  );
$result[] = array(
				'CAPTION'=>t('Change Color At End'),
				'TYPE'=>'check',
				'PROP'=>'changeColorAtEnd',
				);
$result[] = array(
				'CAPTION'=>t('Change Color Smoothly'),
				'TYPE'=>'check',
				'PROP'=>'changeColorSmoothly',
				);
$result[] = array(
                  'CAPTION'=>t('Align'),
                  'TYPE'=>'combo',
                  'PROP'=>'align',
                  'VALUES'=>$_c->s('TAlign'),
                   'ADD_GROUP'=>true
                  );

$result[] = array(
                  'CAPTION'=>t('Hint'),
                  'TYPE'=>'text',
                  'PROP'=>'hint',
                  );

$result[] = array(
                  'CAPTION'=>t('Cursor'),
                  'TYPE'=>'combo',
                  'PROP'=>'cursor',
                  'VALUES'=>$GLOBALS['cursors_meta'],
                  'ADD_GROUP'=>true,
                  );

$result[] = array(
                  'CAPTION'=>t('Sizes and position'),
                  'TYPE'=>'sizes',
                  'PROP'=>'',
                  'ADD_GROUP'=>true,
                  );
return $result;