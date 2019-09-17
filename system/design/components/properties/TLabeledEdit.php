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
                  'CAPTION'=>t('Text'),
                  'TYPE'=>'text',
                  'PROP'=>'text',
                  );
$result[] = array(
                  'CAPTION'=>t('Text Hint'),
                  'TYPE'=>'text',
                  'PROP'=>'textHint',
                  );
$result[] = array(
                  'CAPTION'=>t('Align'),
                  'TYPE'=>'combo',
                  'PROP'=>'alignment',
                  'VALUES'=>array('taLeftJustify', 'taRightJustify', 'taCenter'),
                  );
$result[] = array(
                  'CAPTION'=>t('Margin Left'),
                  'TYPE'=>'number',
                  'PROP'=>'marginLeft'
                  );
$result[] = array(
                  'CAPTION'=>t('Margin Right'),
                  'TYPE'=>'number',
                  'PROP'=>'marginRight'
                  );
_addfont($result);

foreach( explode(_BR_, gui_class_propList('TLabeledEdit', 18)) as $prop ) {
if(trim($prop) and $prop!=='Name' and $prop!=='HelpKeyword')
$result[] = array(
                  'CAPTION'=>t($prop.'_caption'),
                  'TYPE'=>'text',
                  'PROP'=>$prop,
                  );
}
$result[] = array(
                  'CAPTION'=>t('Color'),
                  'TYPE'=>'color',
                  'PROP'=>'color',
                  );
$result[] = array(
                  'CAPTION'=>t('Color On Enter'),
                  'TYPE'=>'color',
                  'PROP'=>'colorOnEnter',
                  );

$result[] = array(
                  'CAPTION'=>t('Font Color On Enter'),
                  'TYPE'=>'color',
                  'PROP'=>'fontColorOnEnter',
                  );

$result[] = array(
                  'CAPTION'=>t('Char Case'),
                  'TYPE'=>'combo',
                  'PROP'=>'charCase',
                  'VALUES'=>array('ecNormal', 'ecUpperCase', 'ecLowerCase'),
                  );
$result[] = array(
                  'CAPTION'=>t('Tab Enter'),
                  'TYPE'=>'check',
                  'PROP'=>'tabOnEnter',
                  );
$result[] = array(
                  'CAPTION'=>t('Ctl3D'),
                  'TYPE'=>'check',
                  'PROP'=>'ctl3D',
                  );
$result[] = array(
                  'CAPTION'=>t('Auto Size'),
                  'TYPE'=>'check',
                  'PROP'=>'autoSize',
                  );
$result[] = array(
                  'CAPTION'=>t('Auto Select'),
                  'TYPE'=>'check',
                  'PROP'=>'autoSelect',
                  );
$result[] = array(
                  'CAPTION'=>t('Read Only'),
                  'TYPE'=>'check',
                  'PROP'=>'readOnly',
                  );

$result[] = array(
                  'CAPTION'=>t('Max Length'),
                  'TYPE'=>'number',
                  'PROP'=>'maxLength',
                  );
$result[] = array(
                  'CAPTION'=>t('Password Char'),
                  'TYPE'=>'text',
                  'PROP'=>'passwordChar',
                  );
$result[] = array(
                  'CAPTION'=>t('Parent Color'),
                  'TYPE'=>'check',
                  'PROP'=>'parentColor',
                  );
$result[] = array(
                  'CAPTION'=>t('Bevel Inner'),
                  'TYPE'=>'combo',
                  'PROP'=>'bevelInner',
                  'VALUES'=>array('bvNone', 'bvLowered', 'bvRaised', 'bvSpace'),
                  );
$result[] = array(
                  'CAPTION'=>t('Bevel Kind'),
                  'TYPE'=>'combo',
                  'PROP'=>'bevelKind',
                  'VALUES'=>array('bkNone', 'bkTile', 'bkSoft', 'bkFlat'),
                  );
$result[] = array(
                  'CAPTION'=>t('Bevel Outer'),
                  'TYPE'=>'combo',
                  'PROP'=>'bevelOuter',
                  'VALUES'=>array('bvNone', 'bvLowered', 'bvRaised', 'bvSpace'),
                  );

$result[] = array(
                  'CAPTION'=>t('Border Style'),
                  'TYPE'=>'combo',
                  'PROP'=>'borderStyle',
                  'VALUES'=>array('bsNone', 'bsSingle'),
                  );
$result[] = array(
                  'CAPTION'=>t('Hint'),
                  'TYPE'=>'text',
                  'PROP'=>'hint',
                  );
$result[] = array(
                  'CAPTION'=>t('Tab Order'),
                  'TYPE'=>'number',
                  'PROP'=>'tabOrder',
                  );
$result[] = array(
                  'CAPTION'=>t('Tab Stop'),
                  'TYPE'=>'check',
                  'PROP'=>'tabStop',
                  );
$result[] = array(
                  'CAPTION'=>t('OEM Convert'),
                  'TYPE'=>'check',
                  'PROP'=>'OEMConvert',
                  );
				  
$result[] = array('CAPTION'=>t('selStart'), 'PROP'=>'selStart');
$result[] = array('CAPTION'=>t('selLength'), 'PROP'=>'selLength');
$result[] = array('CAPTION'=>t('selText'), 'PROP'=>'selText');

$result[] = array(
                  'CAPTION'=>t('Cursor'),
                  'TYPE'=>'combo',
                  'PROP'=>'cursor',
                  'VALUES'=>$GLOBALS['cursors_meta'],
				  'NO_CONST'=>true,
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

return $result;