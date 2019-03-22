<?

$result = [];

$result['GROUP']   = 'internet';
$result['CLASS']   = basenameNoExt(__FILE__);
$result['CAPTION'] = t('THttpClient_Caption');
$result['SORT']    = 2010;
$result['NAME']    = 'httpClient';
$result['MODULES'] = ['php_curl.dll'];

return $result;