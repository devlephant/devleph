<?

$result = [];

$result[] = array(
                  'CAPTION'=>t('On Chromium Lib Load'),
                  'EVENT'=>'onchromiumlibload',
                  'INFO'=>'%func%($self)',
                  'ICON'=>'onchromiumlibload',
                  );

$result[] = array(
                  'CAPTION'=>t('On Before Browse'),
                  'EVENT'=>'onbeforebrowse',
                  'INFO'=>'%func%($self, $url, $method, $type, $redirect, &$continue)',
                  'ICON'=>'onbeforebrowse',
                  );

$result[] = array(
                  'CAPTION'=>t('On Before Popup'),
                  'EVENT'=>'onbeforepopup',
                  'INFO'=>'%func%()',
                  'ICON'=>'onbeforepopup',
                  );

$result[] = array(
                  'CAPTION'=>t('On Before Menu'),
                  'EVENT'=>'onbeforemenu',
                  'INFO'=>'%func%()',
                  'ICON'=>'onbeforemenu',
                  );

$result[] = array(
                  'CAPTION'=>t('On Auth Credentials'),
                  'EVENT'=>'onauthcredentials',
                  'INFO'=>'%func%()',
                  'ICON'=>'onauthcredentials',
                  );

$result[] = array(
                  'CAPTION'=>t('On Get Download Handler'),
                  'EVENT'=>'ongetdownloadhandler',
                  'INFO'=>'%func%()',
                  'ICON'=>'ongetdownloadhandler',
                  );

$result[] = array(
                  'CAPTION'=>t('On Console Message'),
                  'EVENT'=>'onconsolemessage',
                  'INFO'=>'%func%()',
                  'ICON'=>'onconsolemessage',
                  );

$result[] = array(
                  'CAPTION'=>t('On Load Start'),
                  'EVENT'=>'onloadstart',
                  'INFO'=>'%func%()',
                  'ICON'=>'onloadstart',
                  );

$result[] = array(
                  'CAPTION'=>t('On Load End'),
                  'EVENT'=>'onloadend',
                  'INFO'=>'%func%()',
                  'ICON'=>'onloadend',
                  );

$result[] = array(
                  'CAPTION'=>t('On Load Error'),
                  'EVENT'=>'onloaderror',
                  'INFO'=>'%func%()',
                  'ICON'=>'onloaderror',
                  );

$result[] = array(
                  'CAPTION'=>t('On Status Message'),
                  'EVENT'=>'onstatusmessage',
                  'INFO'=>'%func%()',
                  'ICON'=>'onstatusmessage',
                  );

$result[] = array(
                  'CAPTION'=>t('On Address Change'),
                  'EVENT'=>'onaddresschange',
                  'INFO'=>'%func%()',
                  'ICON'=>'onaddresschange',
                  );

$result[] = array(
                  'CAPTION'=>t('On Title Change'),
                  'EVENT'=>'ontitlechange',
                  'INFO'=>'%func%()',
                  'ICON'=>'ontitlechange',
                  );
$result[] = array(
                  'CAPTION'=>t('On Tooltip'),
                  'EVENT'=>'ontooltip',
                  'INFO'=>'%func%()',
                  'ICON'=>'ontooltip',
                  );
return $result;