<?

$result = [];

$result[] = array(
                  'CAPTION'=>t('Align'),
                  'TYPE'=>'combo',
                  'PROP'=>'align',
                  'VALUES'=>$_c->s('TAlign'),
                   'ADD_GROUP'=>true
                  );

$result[] = array(
                  'CAPTION'=>t('caption'),
                  'TYPE'=>'text',
                  'PROP'=>'caption',
                  );
_addfont($result);


$result[] = array(
                  'CAPTION'=>t('Picture'),
                  'TYPE'=>'image',
                  'PROP'=>'picture',
                  );
$result[] = array(
                  'CAPTION'=>t('Picture Layout'),
                  'TYPE'=>'combo',
                  'PROP'=>'layout',
                  'NO_CONST'=>1,
                  'VALUES'=>array('blGlyphLeft', 'blGlyphRight', 'blGlyphTop', 'blGlyphBottom'),
                  );
$result[] = array(
                  'CAPTION'=>t('Pictures count'),
                  'TYPE'=>'number',
                  'PROP'=>'NumGlyphs'
                  );
$result[] = array(
                  'CAPTION'=>t('Spacing'),
                  'TYPE'=>'number',
                  'PROP'=>'spacing',
                  );
$result[] = array(
                  'CAPTION'=>t('Margin'),
                  'TYPE'=>'number',
                  'PROP'=>'margin',
                  );
$result[] = array(
                  'CAPTION'=>t('Group Index'),
                  'TYPE'=>'number',
                  'PROP'=>'groupIndex',
                  );
$result[] = array(
                  'CAPTION'=>t('Down Status'),
                  'TYPE'=>'check',
                  'PROP'=>'down',
                  );

$result[] = array(
                  'CAPTION'=>t('flat'),
                  'TYPE'=>'check',
                  'PROP'=>'flat',
                  );
$result[] = array(
                  'CAPTION'=>t('transparent'),
                  'TYPE'=>'check',
                  'PROP'=>'transparent',
                  );
$result[] = array(
                  'CAPTION'=>t('Allow_All_Up_'),
                  'TYPE'=>'check',
                  'PROP'=>'allowAllUp',
                  );
$result[] = array(
                  'CAPTION'=>t('Hint'),
                  'TYPE'=>'text',
                  'PROP'=>'hint',
                  );
$result[] = array(
                  'CAPTION'=>t('Show Hint'),
                  'TYPE'=>'check',
                  'PROP'=>'showHint',
                  );
				  
$result[] = array(
                  'CAPTION'=>t('Parent Hint'),
                  'TYPE'=>'check',
                  'PROP'=>'parentCustomHint',
                  );
$result[] = array(
                  'CAPTION'=>t('Parent Show Hint'),
                  'TYPE'=>'check',
                  'PROP'=>'parentShowHint',
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

$result[] = array(
                  'CAPTION'=>t('Enabled'),
                  'TYPE'=>'check',
                  'PROP'=>'aenabled',
                  'REAL_PROP'=>'enabled',
                  'ADD_GROUP'=>true,
                  );

$result[] = array(
                  'CAPTION'=>t('visible'),
                  'TYPE'=>'check',
                  'PROP'=>'avisible',
                  'REAL_PROP'=>'visible',
                  'ADD_GROUP'=>true,
                  );

$result[] = array('CAPTION'=>t('p_Left'), 'PROP'=>'x','TYPE'=>'number','ADD_GROUP'=>true);
$result[] = array('CAPTION'=>t('p_Top'), 'PROP'=>'y','TYPE'=>'number','ADD_GROUP'=>true);
$result[] = array('CAPTION'=>t('Width'), 'PROP'=>'w','TYPE'=>'number','ADD_GROUP'=>true);
$result[] = array('CAPTION'=>t('Height'), 'PROP'=>'h','TYPE'=>'number','ADD_GROUP'=>true);

return $result;