<?

$r = array();

$r[] = array(
             'TYPE'=>'VARS',
             'CAPTION'=>t('Buffer var'),
             'USE_QUOTE'=>false,
             );

$r[] = array(
             'TYPE'=>'COMBO',
             'CAPTION'=>t('Local dir'),
             'USE_QUOTE'=>false,
             'VALUES'=>array('CSIDL_DESKTOP',
                             'CSIDL_INTERNET',
                             'CSIDL_PROGRAMS',
                             'CSIDL_CONTROLS',
                             'CSIDL_PRINTERS',
                             'CSIDL_PERSONAL',
                             'CSIDL_FAVORITES',
                             'CSIDL_STARTUP',
                             'CSIDL_RECENT',
                             'CSIDL_SENDTO',
                             'CSIDL_BITBUCKET',
                             'CSIDL_STARTMENU',
                             'CSIDL_DESKTOPDIRECTORY',
                             'CSIDL_DRIVES',
                             'CSIDL_NETWORK',
                             'CSIDL_NETHOOD',
                             'CSIDL_FONTS',
                             'CSIDL_TEMPLATES',
                             'CSIDL_COMMON_STARTMENU',
                             'CSIDL_COMMON_PROGRAMS',
                             'CSIDL_COMMON_STARTUP',
                             'CSIDL_COMMON_DESKTOPDIRECTORY',
                             'CSIDL_APPDATA',
                             'CSIDL_PRINTHOOD',
                             'CSIDL_ALTSTARTUP',
                             'CSIDL_COMMON_ALTSTARTUP',
                             'CSIDL_COMMON_FAVORITES',
                             'CSIDL_INTERNET_CACHE',
                             'CSIDL_COOKIES',
                             'CSIDL_HISTORY',
                             ),
             );

return $r;
