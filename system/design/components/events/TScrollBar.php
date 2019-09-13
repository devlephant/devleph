<?

$result = [];

$result[] = array(
                  'CAPTION'=>t("onchange"),
                  'EVENT'=>'onchange',
                  'INFO'=>'%func%($self)',
                  'ICON'=>'onchange',
                  );
$result[] = array(
                  'CAPTION'=>t("onscroll"),
                  'EVENT'=>'onscroll',
                  'INFO'=>'%func%($self,$type,$scrollPos)',
                  'ICON'=>'onscroll',
                  );
$result[] = array(
                  'CAPTION'=>t("onkeyup"),
                  'EVENT'=>'onKeyUp',
                  'INFO'=>'%func%($self,$key,$shift)',
                  'ICON'=>'onkeyup',
                  );
$result[] = array(
                  'CAPTION'=>t("onkeypress"),
                  'EVENT'=>'onKeyPress',
                  'INFO'=>'%func%($self,$key,$shift)',
                  'ICON'=>'onkeypress',
                  );
$result[] = array(
                  'CAPTION'=>t("onkeydown"),
                  'EVENT'=>'onKeyDown',
                  'INFO'=>'%func%($self,$key,$shift)',
                  'ICON'=>'onkeydown',
                  );

$result[] = array(
                  'CAPTION'=>t("onmouseenter"),
                  'EVENT'=>'onMouseEnter',
                  'INFO'=>'%func%($self)',
                  'ICON'=>'onmouseenter',
                  );

$result[] = array(
                  'CAPTION'=>t("onmouseleave"),
                  'EVENT'=>'onMouseLeave',
                  'INFO'=>'%func%($self)',
                  'ICON'=>'onmouseleave',
                  );
return $result;