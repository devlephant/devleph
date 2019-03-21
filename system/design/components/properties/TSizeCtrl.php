<?

$result = [];


$result[] = array(
                  'CAPTION'=>t('MoveOnly'),
                  'TYPE'=>'check',
                  'PROP'=>'moveOnly',
                  );
$result[] = array(
                  'CAPTION'=>t('BtnColor'),
                  'TYPE'=>'color',
                  'PROP'=>'btnColor',
                  );
$result[] = array(
                  'CAPTION'=>t('BtnColorDisabled'),
                  'TYPE'=>'color',
                  'PROP'=>'btnColorDisabled',
                  );

$result[] = array(
                  'CAPTION'=>t('GridSize'),
                  'TYPE'=>'number',
                  'PROP'=>'gridSize',
                  );
$result[] = array(
                  'CAPTION'=>t('MultiTargetResize'),
                  'TYPE'=>'check',
                  'PROP'=>'multiTargetResize',
                  );
$result[] = array(
                  'CAPTION'=>t('ShowGrid'),
                  'TYPE'=>'check',
                  'PROP'=>'showGrid',
                 );

$result[] = array(
                  'CAPTION'=>t('Enabled'),
                  'TYPE'=>'check',
                  'PROP'=>'enable',
                  );
$result[] = array(
                  'CAPTION'=>t('Targets'),
                  'TYPE'=>'',
                  'PROP'=>'targets',
                  );
$result[] = array(
                  'CAPTION'=>t('TargetsEx'),
                  'TYPE'=>'',
                  'PROP'=>'targets_ex',
                  );
$result[] = array(
                  'CAPTION'=>t('PopupMenu'),
                  'TYPE'=>'',
                  'PROP'=>'popupMenu',
                  );
$result[] = array(
                  'CAPTION'=>t('PopupMenu'),
                  'TYPE'=>'',
                  'PROP'=>'popupMenu',
                  );

return $result;