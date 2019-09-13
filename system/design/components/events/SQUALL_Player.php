<?

$result = [];

$result[] = [
				'CAPTION'=>t("onstarttrack"),
				'EVENT'=>'onStartTrack',
				'INFO'=>'%func%($self)',
				'ICON'=>'onstarttrack',
			];

$result[] =	[
				'CAPTION'=>t("onendtrack"),
				'EVENT'=>'onEndTrack',
				'INFO'=>'%func%($self)',
				'ICON'=>'onendtrack',
			];

return $result;