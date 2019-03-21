<?
$result = []; //Объявляем переменную для свойств
$result[] = array( 
				'CAPTION'=>t('Color'),
				'TYPE'=>'color',
				'PROP'=>'Color',
				);
$result[] = array( 
				'CAPTION'=>t('FixedColor'),
				'TYPE'=>'color',
				'PROP'=>'FixedColor',
				);

$result[] = array(
                  'CAPTION'=>t('Text'),
                  'TYPE'=>'text',
                  'PROP'=>'atext',
                  );

_addfont($result);

$result[] = array( 
				'CAPTION'=>t('BorderStyle'),
				'TYPE'=>'combo',
				'VALUES'=>array('bsNone', 'bsSingle'),
				'PROP'=>'borderStyle',
				);
$result[] = array(
                  'CAPTION'=>t('Scroll Bars'),
                  'TYPE'=>'combo',
                  'PROP'=>'scrollBars',
                  'VALUES'=>array('ssNone', 'ssHorizontal', 'ssVertical', 'ssBoth'),
                  );
$result[] = array( 
				'CAPTION'=>t('Ctl3D'),
				'TYPE'=>'check',
				'PROP'=>'ctl3D',
				);
$result[] = array( 
				'CAPTION'=>t('DefaultColWidth'),
				'TYPE'=>'number',
				'PROP'=>'DefaultColWidth',
				);
$result[] = array( 
				'CAPTION'=>t('DefaultRowHeight'),
				'TYPE'=>'number',
				'PROP'=>'DefaultRowHeight',
				);
$result[] = array( 
				'CAPTION'=>t('DefaultDrawing'),
				'TYPE'=>'check',
				'PROP'=>'DefaultDrawing',
				
				);
$result[] = array( 
				'CAPTION'=>t('DoColumnTitles'),
				'TYPE'=>'check',
				'PROP'=>'DisplayOptions->DoColumnTitles',
				);
$result[] = array( 
				'CAPTION'=>t('DoAutoColResize'),
				'TYPE'=>'check',
				'PROP'=>'DisplayOptions->doAutoColResize',
				);
$result[] = array( 
				'CAPTION'=>t('DoKeyColFixed'),
				'TYPE'=>'check',
				'PROP'=>'DisplayOptions->doKeyColFixed',
				);
$result[] = array( 
				'CAPTION'=>t('DropDownRows'),
				'TYPE'=>'number',
				'PROP'=>'DropDownRows',
				);
				
$result[] = array( 
				'CAPTION'=>t('FixedColumns'),
				'TYPE'=>'number',
				'PROP'=>'FixedCols',
				);
$result[] = array( 
				'CAPTION'=>t('GridLineWidth'),
				'TYPE'=>'number',
				'PROP'=>'GridLineWidth',
				);
$result[] = array( 
				'CAPTION'=>t('KeyEdit'),
				'TYPE'=>'check',
				'PROP'=>'KeyOptions->KeyEdit',
				);
$result[] = array( 
				'CAPTION'=>t('KeyAdd'),
				'TYPE'=>'check',
				'PROP'=>'KeyOptions->KeyAdd',
				);
$result[] = array( 
				'CAPTION'=>t('KeyDelete'),
				'TYPE'=>'check',
				'PROP'=>'KeyOptions->KeyDelete',
				);
$result[] = array( 
				'CAPTION'=>t('KeyUnique'),
				'TYPE'=>'check',
				'PROP'=>'KeyOptions->KeyUnique',
				);
$result[] = array( 
				'CAPTION'=>t('GoFixedVertLine'),
				'TYPE'=>'check',
				'PROP'=>'Options->GoFixedVertLine',
				);
$result[] = array( 
				'CAPTION'=>t('GoFixedHorzLine'),
				'TYPE'=>'check',
				'PROP'=>'Options->GoFixedHorzLine',
				);
$result[] = array( 
				'CAPTION'=>t('GoVertLine'),
				'TYPE'=>'check',
				'PROP'=>'Options->GoVertLine',
				);
$result[] = array( 
				'CAPTION'=>t('GoHorzLine'),
				'TYPE'=>'check',
				'PROP'=>'Options->GoHorzLine',
				);
$result[] = array( 
				'CAPTION'=>t('GoRangeSelect'),
				'TYPE'=>'check',
				'PROP'=>'Options->GoRangeSelect',
				);
$result[] = array( 
				'CAPTION'=>t('GoDrawFocusSelected'),
				'TYPE'=>'check',
				'PROP'=>'Options->GoDrawFocusSelected',
				);
$result[] = array( 
				'CAPTION'=>t('GoRowSizing'),
				'TYPE'=>'check',
				'PROP'=>'Options->GoRowSizing',
				);
$result[] = array( 
				'CAPTION'=>t('GoColSizing'),
				'TYPE'=>'check',
				'PROP'=>'Options->GoColSizing',
				);
$result[] = array( 
				'CAPTION'=>t('GoRowMoving'),
				'TYPE'=>'check',
				'PROP'=>'Options->GoRowMoving',
				);
$result[] = array( 
				'CAPTION'=>t('GoColMoving'),
				'TYPE'=>'check',
				'PROP'=>'Options->GoColMoving',
				);
$result[] = array( 
				'CAPTION'=>t('GoEditing'),
				'TYPE'=>'check',
				'PROP'=>'Options->GoEditing',
				);
$result[] = array( 
				'CAPTION'=>t('GoTabs'),
				'TYPE'=>'check',
				'PROP'=>'Options->GoTabs',
				);
$result[] = array( 
				'CAPTION'=>t('GoRowSelect'),
				'TYPE'=>'check',
				'PROP'=>'Options->GoRowSelect',
				);
$result[] = array( 
				'CAPTION'=>t('GoAlwaysShowEditor'),
				'TYPE'=>'check',
				'PROP'=>'Options->GoAlwaysShowEditor',
				);
$result[] = array( 
				'CAPTION'=>t('GoThumbTracking'),
				'TYPE'=>'check',
				'PROP'=>'Options->GoThumbTracking',
				);
$result[] = array(
                  'CAPTION'=>t('Hint'),
                  'TYPE'=>'text',
                  'PROP'=>'hint',
                  );				
$result[] = array(
                  'CAPTION'=>t('TabOrder'),
                  'TYPE'=>'number',
                  'PROP'=>'TabOrder',
				  'ADD_GROUP'=>1,
                  );				
$result[] = array(
                  'CAPTION'=>t('TabStop'),
                  'TYPE'=>'check',
                  'PROP'=>'TabStop',
				  'ADD_GROUP'=>1,
                  );							
$result[] = array(
                  'CAPTION'=>t('DragKind'),
                  'TYPE'=>'combo',
                  'PROP'=>'DragKind',
                  'VALUES'=>array('dkDock', 'dkDrag'),
                  );
$result[] = array(
                  'CAPTION'=>t('DragMode'),
                  'TYPE'=>'combo',
                  'PROP'=>'DragMode',
                  'VALUES'=>array('dmManual', 'dmAutomatic'),
                  );		
$result[] = array(
                  'CAPTION'=>t('Cursor'),
                  'TYPE'=>'combo',
                  'PROP'=>'cursor',
                  'VALUES'=>$GLOBALS['cursors_meta'],
                  'ADD_GROUP'=>true,
                  );
$result[] = array(
                  'CAPTION'=>t('Align'),
                  'TYPE'=>'combo',
                  'PROP'=>'align',
                  'VALUES'=>array('alNone', 'alTop', 'alBottom', 'alLeft', 'alRight', 'alClient', 'alCustom'),
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
return $result; //возвращаем результат
//Сейчас главное - сохранить файл в соответствии с именем компонента...