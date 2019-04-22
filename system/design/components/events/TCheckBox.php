<?

$result = [];

$result[] =	[
				'CAPTION'=>t('On Click'),
				'EVENT'=>'onClick',
				'INFO'=>'%func%($self)',
				'ICON'=>'onclick',
			];
$result[] =	[
				'CAPTION'=>t('On Focus'),
				'EVENT'=>'onfocus',
				'INFO'=>'%func%($self)',
				'ICON'=>'onfocus',
			];
$result[] =	[
				'CAPTION'=>t('On Blur'),
				'EVENT'=>'onblur',
				'INFO'=>'%func%($self)',
				'ICON'=>'onblur',
			];
$result[] = [
				'CAPTION'=>t('On Key Up'),
				'EVENT'=>'onKeyUp',
				'INFO'=>'%func%($self,$key,$shift)',
				'ICON'=>'onkeyup',
			];
$result[] =	[
				'CAPTION'=>t('On Key Press'),
				'EVENT'=>'onKeyPress',
				'INFO'=>'%func%($self,$key,$shift)',
				'ICON'=>'onkeypress',
			];
$result[] =	[
				'CAPTION'=>t('On Key Down'),
				'EVENT'=>'onKeyDown',
				'INFO'=>'%func%($self,$key,$shift)',
				'ICON'=>'onkeydown',
			];
$result[] =	[
				'CAPTION'=>t('On Mouse Down'),
				'EVENT'=>'onMouseDown',
				'INFO'=>'%func%($self,$button,$shift,$x,$y)',
				'ICON'=>'mousedown',
			];
$result[] =	[
				'CAPTION'=>t('On Mouse Move'),
				'EVENT'=>'onMouseMove',
				'INFO'=>'%func%($self,$button,$shift,$x,$y)',
				'ICON'=>'mousemove',
			];
$result[] =	[
				'CAPTION'=>t('On Mouse Up'),
				'EVENT'=>'onMouseUp',
				'INFO'=>'%func%($self,$button,$shift,$x,$y)',
				'ICON'=>'mouseup',
			];
$result[] =	[
				'CAPTION'=>t('On Mouse Enter'),
				'EVENT'=>'onMouseEnter',
				'INFO'=>'%func%($self)',
				'ICON'=>'onmouseenter',
			];
$result[] =	[
				'CAPTION'=>t('On Mouse Leave'),
				'EVENT'=>'onMouseLeave',
				'INFO'=>'%func%($self)',
				'ICON'=>'onmouseleave',
			];
return $result;