<?

$result = [];

$result[] = [
				'CAPTION'=>t('On Start Track'),
				'EVENT'=>'onStartTrack',
				'INFO'=>'%func%($self)',
				'ICON'=>'onstarttrack',
			];

$result[] =	[
				'CAPTION'=>t('On End Track'),
				'EVENT'=>'onEndTrack',
				'INFO'=>'%func%($self)',
				'ICON'=>'onendtrack',
			];

return $result;