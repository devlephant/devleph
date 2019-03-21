<?

$result = [];

$result['GROUP']   = 'system';
$result['CLASS']   = basenameNoExt(__FILE__);
$result['CAPTION'] = t('TImageList_Caption');
$result['SORT']    = 700;
$result['NAME']    = 'imageList';

// создаем привязанный компонент
$result['NOVISUAL'] = true;

return $result;