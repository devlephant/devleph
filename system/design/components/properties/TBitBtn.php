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
                  'CLASS'=>'TBitmap',
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
                  'CAPTION'=>t('Focused'),
                  'TYPE'=>'check',
                  'PROP'=>'Default',
                  );
$result[] = array(
                  'CAPTION'=>t('Use as').' "'.t('Cancel').'"',
                  'TYPE'=>'check',
                  'PROP'=>'cancel',
                  );
$result[] = array(
                  'CAPTION'=>t('modal_result'),
                  'TYPE'=>'combo',
                  'PROP'=>'modalResult',
                  'VALUES'=>array(
                                  mrNone=>'mrNone',
                                  mrOk=>'mrOk',
                                  mrCancel=>'mrCancel',
                                  mrAbort=>'mrAbort',
                                  mrRetry=>'mrRetry',
                                  mrIgnore=>'mrIgnore',
                                  mrYes=>'mrYes',
                                  mrNo=>'mrNo',
                                  mrAll=>'mrAll',
                                  mrNoToAll=>'mrNoToAll',
                                  mrYesToAll=>'mrYesToAll'
                                  ),
                  );
$result[] = array(
                  'CAPTION'=>t('Kind'),
                  'TYPE'=>'combo',
                  'PROP'=>'kind',
                  'VALUES'=>array('bkCustom', 'bkOK', 'bkCancel', 'bkHelp',
									'bkYes', 'bkNo', 'bkClose', 'bkAbort',
									'bkRetry', 'bkIgnore', 'bkAll'),
                  );
$result[] = array(
                  'CAPTION'=>t('Word Wrap'),
                  'TYPE'=>'check',
                  'PROP'=>'wordWrap',
                  );
$result[] = array(
                  'CAPTION'=>t('Double Buffered'),
                  'TYPE'=>'check',
                  'PROP'=>'doubleBuffered',
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
                  'CAPTION'=>t('Parent Double Buffered'),
                  'TYPE'=>'check',
                  'PROP'=>'parentDoubleBuffered',
                  );
$result[] = array(
                  'CAPTION'=>t('Parent Font'),
                  'TYPE'=>'check',
                  'PROP'=>'parentFont',
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