<?
return array(
'GROUP'   =>'internet',
'CLASS'   =>basenameNoExt(__FILE__),
'CAPTION' =>t('TChromium_Caption'),
'SORT'    =>54,
'NAME'    =>'chromium',
'W' =>40,
'H' =>30,
'USE_SKIN' =>true,

'DLLS' => array('icudt.dll', 'libcef.dll', 'chrome.pak', 'locales'),
);