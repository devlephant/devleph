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

'DLLS' => array('avcodec-57.dll', 'avformat-57.dll', 'avutil-55.dll', 'avdevice-57.dll', 'icudt.dll', 
	    'libcef.dll', 'chrome.pak', 'locales'),
);