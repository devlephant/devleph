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
                  'VALUES'=>$_c->s('TAlign'),
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
                  'VALUES'=>$_c->s('TBrushStyle')
                  );	
$result[] = array(
                  'CAPTION'=>t('ThumbButton Shape Type'),
                  'TYPE'=>'combo',
                  'PROP'=>'ThumbShape',
                  'VALUES'=>$_c->s('TShapeType'),
                  );				  
$result[] = array(
                  'CAPTION'=>t('ThumbButton Pen Mode'),
                  'TYPE'=>'combo',
                  'PROP'=>'ThumbPenMode',
                  'VALUES'=>$_c->s('TPenMode')
                  );
$result[] = array(
                  'CAPTION'=>t('ThumbButton Pen Style'),
                  'TYPE'=>'combo',
                  'PROP'=>'ThumbPenStyle',
                  'VALUES'=>$_c->s('TPenStyle')
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
				  'NO_CONST'=>true,
                  'ADD_GROUP'=>true,
                  );

$result[] = array(
                  'CAPTION'=>t('Sizes and position'),
                  'TYPE'=>'sizes',
                  'PROP'=>'',
                  'ADD_GROUP'=>true,
                  );

return $result;