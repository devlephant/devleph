<?

$result = [];

$result[] =	[
				'CAPTION'=>t("onclick"),
				'EVENT'=>'onClick',
				'INFO'=>'%func%($self)',
				'ICON'=>'onclick',
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
return $result;