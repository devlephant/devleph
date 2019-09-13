<?

$result = [];

$result[] =	[
				'CAPTION'=>t("onclick"),
				'EVENT'=>'onClick',
				'INFO'=>'%func%($self)',
				'ICON'=>'onclick',
			];
$result[] =	[
				'CAPTION'=>t("onfocus"),
				'EVENT'=>'onfocus',
				'INFO'=>'%func%($self)',
				'ICON'=>'onfocus',
			];
$result[] =	[
				'CAPTION'=>t("onblur"),
				'EVENT'=>'onblur',
				'INFO'=>'%func%($self)',
				'ICON'=>'onblur',
			];
$result[] = [
				'CAPTION'=>t("onkeyup"),
				'EVENT'=>'onKeyUp',
				'INFO'=>'%func%($self,$key,$shift)',
				'ICON'=>'onkeyup',
			];
$result[] =	[
				'CAPTION'=>t("onkeypress"),
				'EVENT'=>'onKeyPress',
				'INFO'=>'%func%($self,$key,$shift)',
				'ICON'=>'onkeypress',
			];
$result[] =	[
				'CAPTION'=>t("onkeydown"),
				'EVENT'=>'onKeyDown',
				'INFO'=>'%func%($self,$key,$shift)',
				'ICON'=>'onkeydown',
			];
$result[] =	[
				'CAPTION'=>t("onmousedown"),
				'EVENT'=>'onMouseDown',
				'INFO'=>'%func%($self,$button,$shift,$x,$y)',
				'ICON'=>'mousedown',
			];
$result[] =	[
				'CAPTION'=>t("onmousemove"),
				'EVENT'=>'onMouseMove',
				'INFO'=>'%func%($self,$button,$shift,$x,$y)',
				'ICON'=>'mousemove',
			];
$result[] =	[
				'CAPTION'=>t("onmouseup"),
				'EVENT'=>'onMouseUp',
				'INFO'=>'%func%($self,$button,$shift,$x,$y)',
				'ICON'=>'mouseup',
			];
$result[] =	[
				'CAPTION'=>t("onmouseenter"),
				'EVENT'=>'onMouseEnter',
				'INFO'=>'%func%($self)',
				'ICON'=>'onmouseenter',
			];
$result[] =	[
				'CAPTION'=>t("onmouseleave"),
				'EVENT'=>'onMouseLeave',
				'INFO'=>'%func%($self)',
				'ICON'=>'onmouseleave',
			];
return $result;