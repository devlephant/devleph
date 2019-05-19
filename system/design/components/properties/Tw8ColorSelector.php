<?

$result = [];
				  
$result[] = array(
                  'CAPTION'=>t('Color'),
                  'TYPE'=>'Color',
                  'PROP'=>'Color',
                  );
$result[] = array(
                  'CAPTION'=>t('Tracking Animation'),
                  'TYPE'=>'check',
                  'PROP'=>'trackAnim',
                   'ADD_GROUP'=>true
                  );
$result[] = array(
                  'CAPTION'=>t('Dragg-ling Animation'),
                  'TYPE'=>'check',
                  'PROP'=>'dragAnim',
                   'ADD_GROUP'=>true
                  );
$result[] = array(
                  'CAPTION'=>t('Align'),
                  'TYPE'=>'combo',
                  'PROP'=>'align',
                  'VALUES'=>$GLOBALS['_c']->getSet('TAlign'),
                   'ADD_GROUP'=>true
                  );
$result[] = array(
                  'CAPTION'=>t('Page'),
                  'TYPE'=>'number',
                  'PROP'=>'main',
                  );
				  
$result[] = array(
                  'CAPTION'=>t('Column'),
                  'TYPE'=>'number',
                  'PROP'=>'sub',
                  );
		
$result[] = array(
                  'CAPTION'=>t('ThumbButton Color'),
                  'TYPE'=>'Color',
                  'PROP'=>'ThumbColor',
                  );

$result[] = array(
                  'CAPTION'=>t('ThumbButton Brush Style'),
                  'TYPE'=>'combo',
                  'PROP'=>'ThumbShapeStyle',
                  'VALUES'=>$GLOBALS['_c']->getSet('TBrushStyle')
                  );	
$result[] = array(
                  'CAPTION'=>t('ThumbButton Shape Type'),
                  'TYPE'=>'combo',
                  'PROP'=>'ThumbShape',
                  'VALUES'=>$GLOBALS['_c']->getSet('TShapeType'),
                  );				  
$result[] = array(
                  'CAPTION'=>t('Thumb Pen Mode'),
                  'TYPE'=>'combo',
                  'PROP'=>'ThumbPenMode',
                  'VALUES'=>$GLOBALS['_c']->getSet('TPenMode')
                  );
$result[] = array(
                  'CAPTION'=>t('ThumbButton Pen Style'),
                  'TYPE'=>'combo',
                  'PROP'=>'ThumbPenStyle',
                  'VALUES'=>$GLOBALS['_c']->getSet('TPenStyle')
                  );
$result[] = array(
                  'CAPTION'=>t('Pen Width'),
                  'TYPE'=>'number',
                  'PROP'=>'ThumbPenWidth',
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

$result[] = array('CAPTION'=>t('p_Left'), 'PROP'=>'x','TYPE'=>'number','ADD_GROUP'=>1);
$result[] = array('CAPTION'=>t('p_Top'), 'PROP'=>'y','TYPE'=>'number','ADD_GROUP'=>1);
$result[] = array('CAPTION'=>t('Width'), 'PROP'=>'w','TYPE'=>'number','ADD_GROUP'=>1);
$result[] = array('CAPTION'=>t('Height'), 'PROP'=>'h','TYPE'=>'number','ADD_GROUP'=>1);
return $result;