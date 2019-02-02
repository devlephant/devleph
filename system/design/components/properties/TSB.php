<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('Align'),
                  'TYPE'=>'combo',
                  'PROP'=>'align',
                  'VALUES'=>array('alNone', 'alTop', 'alBottom', 'alLeft', 'alRight', 'alClient', 'alCustom'),
                   'ADD_GROUP'=>true
                  );
$result[] = array(
                  'CAPTION'=>t('Text'),
                  'TYPE'=>'text',
                  'PROP'=>'caption',
                  'UPDATE_DSGN'=>1
                  );
$result[] = array(
                  'CAPTION'=>t('font'),
                  'TYPE'=>'stfont',
                  'PROP'=>'font',
                  'CLASS'=>'TFont',
                  'UPDATE_DSGN'=>1
                  );
$result[] = array('CAPTION'=>t('Font Color'), 'TYPE'=>'color', 'PROP'=>'OneFColor');
$result[] = array(
                  'CAPTION'=>t('TwoFColor'),
                  'TYPE'=>'color',
                  'PROP'=>'TwoFColor'
                  );
$result[] = array(
                  'CAPTION'=>t('ThreeFColor'),
                  'TYPE'=>'color',
                  'PROP'=>'ThreeFColor'
                  );
	$result[] = array('CAPTION'=>t('Font Size'), 'PROP'=>'font->size');
	$result[] = array('CAPTION'=>t('Font Height'), 'PROP'=>'font->height');
	$result[] = array('CAPTION'=>t('Font Pitch'), 'PROP'=>'font->pitch');
	$result[] = array('CAPTION'=>t('Font Orientation'), 'PROP'=>'font->orientation');
	$result[] = array('CAPTION'=>t('Font Style'), 'PROP'=>'font->style');


$result[] = array(
                  'CAPTION'=>t('Color'),
                  'TYPE'=>'color',
                  'PROP'=>'OneColor'
                  );
$result[] = array('CAPTION'=>t('TwoC_'),
                  'TYPE'=>'color',
                  'PROP'=>'TwoColor');
$result[] = array('CAPTION'=>t('ThreeC_'),
                  'TYPE'=>'color',
                  'PROP'=>'ThreeColor');				
$result[] = array(
                  'CAPTION'=>t('Auto Size'),
                  'TYPE'=>'check',
                  'PROP'=>'autoSize',
		  'ADD_GROUP'=>true,
                  'UPDATE_DSGN'=>1
                  );
$result[] = array(
                  'CAPTION'=>t('Layout'),
                  'TYPE'=>'combo',
                  'PROP'=>'layout',
                  'VALUES'=>array('tlTop', 'tlCenter', 'tlBottom'),
                   'ADD_GROUP'=>true
                  );
$result[] = array(
                  'CAPTION'=>t('Alignment'),
                  'TYPE'=>'combo',
                  'PROP'=>'alignment',
                  'VALUES'=>array('taLeftJustify', 'taRightJustify','taCenter'),
				  'ADD_GROUP'=>true
                  );
$result[] = array(
                  'CAPTION'=>t('Transparent'),
                  'TYPE'=>'check',
                  'PROP'=>'transparent',
				  'ADD_GROUP'=>true
                  );
$result[] = array(
                  'CAPTION'=>t('Word Wrap'),
                  'TYPE'=>'check',
                  'PROP'=>'wordWrap',
				  'ADD_GROUP'=>true
                  );

$result[] = array(
                  'CAPTION'=>t('Hint'),
                  'TYPE'=>'text',
                  'PROP'=>'hint'
                  );

$result[] = array(
                  'CAPTION'=>t('Cursor'),
                  'TYPE'=>'combo',
                  'PROP'=>'cursor',
                  'VALUES'=>$GLOBALS['cursors_meta'],
                  'ADD_GROUP'=>true
                  );

$result[] = array(
                  'CAPTION'=>t('Sizes and position'),
                  'TYPE'=>'sizes',
                  'PROP'=>'',
                  'ADD_GROUP'=>true
                  );
$result[] = array(
                  'CAPTION'=>t('Enabled'),
                  'TYPE'=>'check',
                  'PROP'=>'enabled',
                  'ADD_GROUP'=>true
                  );

$result[] = array(
                  'CAPTION'=>t('visible'),
                  'TYPE'=>'check',
                  'PROP'=>'avisible',
                  'REAL_PROP'=>'visible',
                  'ADD_GROUP'=>true,
				  'UPDATE_DSGN'=>1
                  );

$result[] = array('CAPTION'=>t('p_Left'), 'PROP'=>'x','TYPE'=>'number','ADD_GROUP'=>1,'UPDATE_DSGN'=>1);
$result[] = array('CAPTION'=>t('p_Top'), 'PROP'=>'y','TYPE'=>'number','ADD_GROUP'=>1,'UPDATE_DSGN'=>1);
$result[] = array('CAPTION'=>t('Width'), 'PROP'=>'w','TYPE'=>'number','ADD_GROUP'=>1,'UPDATE_DSGN'=>1);
$result[] = array('CAPTION'=>t('Height'), 'PROP'=>'h','TYPE'=>'number','ADD_GROUP'=>1,'UPDATE_DSGN'=>1);

return $result;