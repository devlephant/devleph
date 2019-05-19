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
                  'VALUES'=>array('alNone', 'alTop', 'alBottom', 'alLeft', 'alRight', 'alClient', 'alCustom'),
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
                  'VALUES'=>array('bsSolid', 'bsClear', 'bsHorizontal', 'bsVertical','bsFDiagonal', 'bsBDiagonal', 'bsCross', 'bsDiagCross')
                  );	
$result[] = array(
                  'CAPTION'=>t('ThumbButton Shape Type'),
                  'TYPE'=>'combo',
                  'PROP'=>'ThumbShape',
                  'VALUES'=>array('stRectangle', 'stSquare', 'stRoundRect', 'stRoundSquare', 'stEllipse', 'stCircle', 'stRhombus', 'stDiamond','stEquilateralTriangle', 'stIsosceleTriangle', /*...*/ 'stSunPie'),
                  );				  
$result[] = array(
                  'CAPTION'=>t('Thumb Pen Mode'),
                  'TYPE'=>'combo',
                  'PROP'=>'ThumbPenMode',
                  'VALUES'=>array('pmBlack', 'pmWhite', 'pmNop', 'pmNot', 'pmCopy', 'pmNotCopy',
                                    'pmMergePenNot', 'pmMaskPenNot', 'pmMergeNotPen', 'pmMaskNotPen', 'pmMerge',
                                    'pmNotMerge', 'pmMask', 'pmNotMask', 'pmXor', 'pmNotXor')
                  );
$result[] = array(
                  'CAPTION'=>t('ThumbButton Pen Style'),
                  'TYPE'=>'combo',
                  'PROP'=>'ThumbPenStyle',
                  'VALUES'=>array('psSolid', 'psDash', 'psDot', 'psDashDot', 'psDashDotDot', 'psClear', 'psInsideFrame', 'psUserStyle', 'psAlternate'),
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