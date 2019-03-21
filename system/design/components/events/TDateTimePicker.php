<?

$result = [];

$result[] = array(
                  'CAPTION'=>t('On Change'),
                  'EVENT'=>'onchange',
                  'INFO'=>'%func%($self)',
                  'ICON'=>'onchange',
                  );
$result[] = array(
                  'CAPTION'=>t('On Click'),
                  'EVENT'=>'onClick',
                  'INFO'=>'%func%($self)',
                  'ICON'=>'onclick',
                  );
$result[] = array(
                  'CAPTION'=>t('On DblClick'),
                  'EVENT'=>'onDblClick',
                  'INFO'=>'%func%($self)',
                  'ICON'=>'ondblclick',
                  );
$result[] = array(
                  'CAPTION'=>t('On Key Up'),
                  'EVENT'=>'onKeyUp',
                  'INFO'=>'%func%($self,$key,$shift)',
                  'ICON'=>'onkeyup',
                  );
$result[] = array(
                  'CAPTION'=>t('On Key Press'),
                  'EVENT'=>'onKeyPress',
                  'INFO'=>'%func%($self,$key,$shift)',
                  'ICON'=>'onkeypress',
                  );
$result[] = array(
                  'CAPTION'=>t('On Key Down'),
                  'EVENT'=>'onKeyDown',
                  'INFO'=>'%func%($self,$key,$shift)',
                  'ICON'=>'onkeydown',
                  );

$result[] = array(
                  'CAPTION'=>t('On Mouse Enter'),
                  'EVENT'=>'onMouseEnter',
                  'INFO'=>'%func%($self)',
                  'ICON'=>'onmouseenter',
                  );

$result[] = array(
                  'CAPTION'=>t('On Mouse Leave'),
                  'EVENT'=>'onMouseLeave',
                  'INFO'=>'%func%($self)',
                  'ICON'=>'onmouseleave',
                  );
return $result;