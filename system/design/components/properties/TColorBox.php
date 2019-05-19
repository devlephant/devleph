<?

$result = [];

$result[] = array(
                  'CAPTION'=>t('Align'),
                  'TYPE'=>'combo',
                  'PROP'=>'align',
                  'VALUES'=>$GLOBALS['_c']->s('TAlign'),
                   'ADD_GROUP'=>true
                  );
$result[] = array(
                  'CAPTION'=>t('Auto Complete'),
                  'TYPE'=>'check',
                  'PROP'=>'autoComplete',
                  );
$result[] = array(
                  'CAPTION'=>t('Auto Drop Down'),
                  'TYPE'=>'check',
                  'PROP'=>'autoDropDown',
                  );
$result[] = array(
                  'CAPTION'=>t('selected'),
                  'TYPE'=>'combo',
                  'PROP'=>'selected',
                  'VALUES'=>array(
    							  'clBlack', 'clMaroon', 'clGreen', 'clOlive',
    							  'clNavy', 'clPurple', 'clTeal', 'clGray',
    							  'clSilver', 'clRed', 'clLime', 'clYellow',
    						      'clBlue', 'clFuchsia', 'clAqua', 'clWhite',
    						      'clMoneyGreen', 'clSkyBlue', 'clCream', 'clMedGray',
    						      'clActiveBorder', 'clActiveCaption', 'clAppWorkSpace', 'clBackground',
    						      'clBtnFace', 'clBtnHighlight', 'clBtnShadow', 'clBtnText',
    							  'clCaptionText', 'clDefault', 'clGradientActiveCaption', 'clGradientInactiveCaption',
    							  'clGrayText', 'clHighlight', 'clHighlightText', 'clHotLight',
    							  'clInactiveBorder', 'clInactiveCaption', 'clInactiveCaptionText', 'clInfoBk',
    							  'clInfoText', 'clMenu', 'clMenuBar', 'clMenuHighlight',
    							  'clMenuText', 'clNone', 'clScrollBar', 'cl3DDkShadow',
    							  'cl3DLight', 'clWindow', 'clWindowFrame', 'clWindowText',
    							  ),
                  );
$result[] = array(
                  'CAPTION'=>t('NoneColorColor'),
                  'TYPE'=>'combo',
                  'PROP'=>'noneColorColor',
                  'VALUES'=>array(
    							  'clBlack', 'clMaroon', 'clGreen', 'clOlive',
    							  'clNavy', 'clPurple', 'clTeal', 'clGray',
    							  'clSilver', 'clRed', 'clLime', 'clYellow',
    						      'clBlue', 'clFuchsia', 'clAqua', 'clWhite',
    						      'clMoneyGreen', 'clSkyBlue', 'clCream', 'clMedGray',
    						      'clActiveBorder', 'clActiveCaption', 'clAppWorkSpace', 'clBackground',
    						      'clBtnFace', 'clBtnHighlight', 'clBtnShadow', 'clBtnText',
    							  'clCaptionText', 'clDefault', 'clGradientActiveCaption', 'clGradientInactiveCaption',
    							  'clGrayText', 'clHighlight', 'clHighlightText', 'clHotLight',
    							  'clInactiveBorder', 'clInactiveCaption', 'clInactiveCaptionText', 'clInfoBk',
    							  'clInfoText', 'clMenu', 'clMenuBar', 'clMenuHighlight',
    							  'clMenuText', 'clNone', 'clScrollBar', 'cl3DDkShadow',
    							  'cl3DLight', 'clWindow', 'clWindowFrame', 'clWindowText',
    							  ),
                  );
$result[] = array(
                  'CAPTION'=>t('DefaultColorColor'),
                  'TYPE'=>'combo',
                  'PROP'=>'defaultColorColor',
                  'VALUES'=>array(
    							  'clBlack', 'clMaroon', 'clGreen', 'clOlive',
    							  'clNavy', 'clPurple', 'clTeal', 'clGray',
    							  'clSilver', 'clRed', 'clLime', 'clYellow',
    						      'clBlue', 'clFuchsia', 'clAqua', 'clWhite',
    						      'clMoneyGreen', 'clSkyBlue', 'clCream', 'clMedGray',
    						      'clActiveBorder', 'clActiveCaption', 'clAppWorkSpace', 'clBackground',
    						      'clBtnFace', 'clBtnHighlight', 'clBtnShadow', 'clBtnText',
    							  'clCaptionText', 'clDefault', 'clGradientActiveCaption', 'clGradientInactiveCaption',
    							  'clGrayText', 'clHighlight', 'clHighlightText', 'clHotLight',
    							  'clInactiveBorder', 'clInactiveCaption', 'clInactiveCaptionText', 'clInfoBk',
    							  'clInfoText', 'clMenu', 'clMenuBar', 'clMenuHighlight',
    							  'clMenuText', 'clNone', 'clScrollBar', 'cl3DDkShadow',
    							  'cl3DLight', 'clWindow', 'clWindowFrame', 'clWindowText',
    							  ),
                  );
_addfont($result);

$result[] = array(
                  'CAPTION'=>t('Drop Down Count'),
                  'TYPE'=>'number',
                  'PROP'=>'dropDownCount',
                  );

$result[] = array(
                  'CAPTION'=>t('Item Height'),
                  'TYPE'=>'number',
                  'PROP'=>'itemHeight',
                  );

$result[] = array(
                  'CAPTION'=>t('Color'),
                  'TYPE'=>'color',
                  'PROP'=>'color',
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
                  'CAPTION'=>t('Bevel Width'),
                  'TYPE'=>'number',
                  'PROP'=>'bevelWidth',
                  );
$result[] = array(
                  'CAPTION'=>t('Ctl3D'),
                  'TYPE'=>'check',
                  'PROP'=>'ctl3D',
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

$result[] = array('CAPTION'=>t('p_Left'), 'PROP'=>'x','TYPE'=>'number','ADD_GROUP'=>1);
$result[] = array('CAPTION'=>t('p_Top'), 'PROP'=>'y','TYPE'=>'number','ADD_GROUP'=>1);
$result[] = array('CAPTION'=>t('Width'), 'PROP'=>'w','TYPE'=>'number','ADD_GROUP'=>1);
$result[] = array('CAPTION'=>t('Height'), 'PROP'=>'h','TYPE'=>'number','ADD_GROUP'=>1);
return $result;