<?

global $_c;

  $_c->ANSI_CHARSET = 0;
  $_c->DEFAULT_CHARSET = 1;
  $_c->SYMBOL_CHARSET = 2;
  $_c->SHIFTJIS_CHARSET = 0x80;
  $_c->HANGEUL_CHARSET = 129;
  $_c->GB2312_CHARSET = 134;
  $_c->CHINESEBIG5_CHARSET = 136;
  $_c->OEM_CHARSET = 255;
  $_c->JOHAB_CHARSET = 130;
  $_c->HEBREW_CHARSET = 177;
  $_c->ARABIC_CHARSET = 178;
  $_c->GREEK_CHARSET = 161;
  $_c->TURKISH_CHARSET = 162;
  $_c->VIETNAMESE_CHARSET = 163;
  $_c->THAI_CHARSET = 222;
  $_c->EASTEUROPE_CHARSET = 238;
  $_c->RUSSIAN_CHARSET = 204;

  $_c->MAC_CHARSET = 77;
  $_c->BALTIC_CHARSET = 186;

  $_c->EWX_LOGOFF      = 0;
  $_c->EWX_SHUTDOWN    = 1;
  $_c->EWX_REBOOT      = 2;
  $_c->EWX_FORCE       = 4;
  $_c->EWX_POWEROFF    = 8;
  $_c->EWX_FORCEIFHUNG = 0x10;


  $_c->CSIDL_DESKTOP                       = 0x0000;
  $_c->CSIDL_INTERNET                      = 0x0001;
  $_c->CSIDL_PROGRAMS                      = 0x0002;
  $_c->CSIDL_CONTROLS                      = 0x0003;
  $_c->CSIDL_PRINTERS                      = 0x0004;
  $_c->CSIDL_PERSONAL                      = 0x0005;
  $_c->CSIDL_FAVORITES                     = 0x0006;
  $_c->CSIDL_STARTUP                       = 0x0007;
  $_c->CSIDL_RECENT                        = 0x0008;
  $_c->CSIDL_SENDTO                        = 0x0009;
  $_c->CSIDL_BITBUCKET                     = 0x000a;
  $_c->CSIDL_STARTMENU                     = 0x000b;
  $_c->CSIDL_DESKTOPDIRECTORY              = 0x0010;
  $_c->CSIDL_DRIVES                        = 0x0011;
  $_c->CSIDL_NETWORK                       = 0x0012;
  $_c->CSIDL_NETHOOD                       = 0x0013;
  $_c->CSIDL_FONTS                         = 0x0014;
  $_c->CSIDL_TEMPLATES                     = 0x0015;
  $_c->CSIDL_COMMON_STARTMENU              = 0x0016;
  $_c->CSIDL_COMMON_PROGRAMS               = 0x0017;
  $_c->CSIDL_COMMON_STARTUP                = 0x0018;
  $_c->CSIDL_COMMON_DESKTOPDIRECTORY       = 0x0019;
  $_c->CSIDL_APPDATA                       = 0x001a;
  $_c->CSIDL_PRINTHOOD                     = 0x001b;
  $_c->CSIDL_ALTSTARTUP                = 0x001d;         // DBCS
  $_c->CSIDL_COMMON_ALTSTARTUP         = 0x001e;         // DBCS
  $_c->CSIDL_COMMON_FAVORITES          = 0x001f;
  $_c->CSIDL_INTERNET_CACHE            = 0x0020;
  $_c->CSIDL_COOKIES                   = 0x0021;
  $_c->CSIDL_HISTORY                   = 0x0022;
  
  $_c->CSIDL_WINDOWS                   = 0x0024;
  $_c->CSIDL_ADMINTOOLS = 0x30;
  $_c->CSIDL_CDBURN_AREA = 0x3b;
  $_c->CSIDL_COMMON_ADMINTOOLS = 0x2f;
  $_c->CSIDL_COMMON_APPDATA = 0x23;
  $_c->CSIDL_COMMON_DOCUMENTS = 0x2e;
  $_c->CSIDL_COMMON_TEMPLATES = 0x2d;
  $_c->CSIDL_COMPUTERSNEARME = 0x3d;
  $_c->CSIDL_CONNECTIONS = 0x31;
  $_c->CSIDL_MYDOCUMENTS = 0x0c;
  $_c->CSIDL_PROGRAM_FILES = 0x26;
  $_c->CSIDL_PROGRAM_FILESX86 = 0x2a;

 //{ GetSystemMetrics() codes }
   $_c->SM_CXSCREEN = 0;
   $_c->SM_CYSCREEN = 1;
   $_c->SM_CXVSCROLL = 2;
  $_c->SM_CYHSCROLL = 3;
  $_c->SM_CYCAPTION = 4;
  $_c->SM_CXBORDER = 5;
  $_c->SM_CYBORDER = 6;
  $_c->SM_CXDLGFRAME = 7;
  $_c->SM_CYDLGFRAME = 8;
  $_c->SM_CYVTHUMB = 9;
  $_c->SM_CXHTHUMB = 10;
  $_c->SM_CXICON = 11;
  $_c->SM_CYICON = 12;
  $_c->SM_CXCURSOR = 13;
  $_c->SM_CYCURSOR = 14;
  $_c->SM_CYMENU = 15;
  $_c->SM_CXFULLSCREEN = 0x10;
  $_c->SM_CYFULLSCREEN = 17;
  $_c->SM_CYKANJIWINDOW = 18;
  $_c->SM_MOUSEPRESENT = 19;
  $_c->SM_CYVSCROLL = 20;
  $_c->SM_CXHSCROLL = 21;
  $_c->SM_DEBUG = 22;
  $_c->SM_SWAPBUTTON = 23;
  $_c->SM_RESERVED1 = 24;
  $_c->SM_RESERVED2 = 25;
  $_c->SM_RESERVED3 = 26;
  $_c->SM_RESERVED4 = 27;
  $_c->SM_CXMIN = 28;
  $_c->SM_CYMIN = 29;
  $_c->SM_CXSIZE = 30;
  $_c->SM_CYSIZE = 31;
  $_c->SM_CXFRAME = 0x20;
  $_c->SM_CYFRAME = 33;
  $_c->SM_CXMINTRACK = 34;
  $_c->SM_CYMINTRACK = 35;
  $_c->SM_CXDOUBLECLK = 36;
  $_c->SM_CYDOUBLECLK = 37;
  $_c->SM_CXICONSPACING = 38;
  $_c->SM_CYICONSPACING = 39;
  $_c->SM_MENUDROPALIGNMENT = 40;
  $_c->SM_PENWINDOWS = 41;
  $_c->SM_DBCSENABLED = 42;
  $_c->SM_CMOUSEBUTTONS = 43;

  $_c->SM_SECURE = 44;
  $_c->SM_CXEDGE = 45;
  $_c->SM_CYEDGE = 46;
  $_c->SM_CXMINSPACING = 47;
  $_c->SM_CYMINSPACING = 48;
  $_c->SM_CXSMICON = 49;
  $_c->SM_CYSMICON = 50;
  $_c->SM_CYSMCAPTION = 51;
  $_c->SM_CXSMSIZE = 52;
  $_c->SM_CYSMSIZE = 53;
  $_c->SM_CXMENUSIZE = 54;
  $_c->SM_CYMENUSIZE = 55;
  $_c->SM_ARRANGE = 56;
  $_c->SM_CXMINIMIZED = 57;
  $_c->SM_CYMINIMIZED = 58;
  $_c->SM_CXMAXTRACK = 59;
  $_c->SM_CYMAXTRACK = 60;
  $_c->SM_CXMAXIMIZED = 61;
  $_c->SM_CYMAXIMIZED = 62;
  $_c->SM_NETWORK = 63;
  $_c->SM_CLEANBOOT = 67;
  $_c->SM_CXDRAG = 68;
  $_c->SM_CYDRAG = 69;
  $_c->SM_SHOWSOUNDS = 70;
  $_c->SM_CXMENUCHECK = 71;     //{ Use instead of GetMenuCheckMarkDimensions()! }
  $_c->SM_CYMENUCHECK = 72;
  $_c->SM_SLOWMACHINE = 73;
  $_c->SM_MIDEASTENABLED = 74;
  $_c->SM_MOUSEWHEELPRESENT = 75;
  $_c->SM_CMETRICS = 76;
  $_c->SM_XVIRTUALSCREEN = 76;
  $_c->SM_YVIRTUALSCREEN = 77;
  $_c->SM_CXVIRTUALSCREEN = 78;
  $_c->SM_CYVIRTUALSCREEN = 79;
  $_c->SM_CMONITORS = 80;
  $_c->SM_SAMEDISPLAYFORMAT = 81;
  $_c->SM_IMMENABLED = 82;
  $_c->SM_CXFOCUSBORDER = 83;
  $_c->SM_CYFOCUSBORDER = 84;


  $_c->MOUSEEVENTF_MOVE            = 0x01;
  $_c->MOUSEEVENTF_LEFTDOWN        = 0x02;
  $_c->MOUSEEVENTF_LEFTUP          = 0x04;
  $_c->MOUSEEVENTF_RIGHTDOWN       = 0x08;
  $_c->MOUSEEVENTF_RIGHTUP         = 0x10;
  $_c->MOUSEEVENTF_MIDDLEDOWN      = 0x20;
  $_c->MOUSEEVENTF_MIDDLEUP        = 0x40;
  $_c->MOUSEEVENTF_WHEEL           = 0x0800;
  $_c->MOUSEEVENTF_ABSOLUTE        = 0x8000;
  
  

function winExit($flag){
    
    win_set_privilege('SeShutdownPrivilege',true);
    win_exit_windows($flag,0);
}

function winShutdown(){
    winExit(EWX_SHUTDOWN,0);
}

function winRestart(){
    winExit(EWX_REBOOT);
}

function winLogoff(){
    winExit(EWX_LOGOFF);
}

function winSleep(){
    win_sleep();
}


function winLocalPath($type){
    
    return replaceSl( trim(__winLocalPath($type)) );
}

function selectDirectory($caption, $root, &$buff){
    
    $res = select_directory($caption, replaceSr($root));
    
    if ($res<>null){
        $res  = replaceSl($res);
        $buff = $res;
    }
    return $res <> null;
}

$GLOBALS['Fonts']  = winLocalPath(CSIDL_FONTS);
$GLOBALS['Desktop']= winLocalPath(CSIDL_DESKTOP);
$GLOBALS['StartUp']= winLocalPath(CSIDL_STARTMENU);

define('EXE_NAME',replaceSl(param_str(0)),false);
define('TEMP_DIR',replaceSl(win_tempdir()), false);
define('DESKTOP_DIR', replaceSl($GLOBALS['Desktop']));

for ($i=0;$i<=param_count();$i++)
{
	$GLOBALS['_PARAMS'][] = param_str($i);
}

$GLOBALS['argv'] =& $GLOBALS['_PARAMS'];




class DynLib {

    public $libpath = '';
    public $functions = array();
    public $ffi;
    
    public function __construct($libpath){
        $this->libpath = $libpath;
    }
    
    static function typeFix($type){
        
        $arr = array(
            'bool ' => 'sint8 ',
            'DWORD ' => 'uint32 ',
            'byte ' => 'sint8 ',
            'integer ' => 'int ',
            'string ' => 'char *',
            'uint ' => 'uint32 ',
            'cardinal ' => 'uint32 ',
            'boolean ' => 'sint8 ',
            'short ' => 'sint8 ',
            'LPSTR ' => 'char *',
            'LPCSTR ' => 'char *',
            'LPCTSTR ' => 'char *',
            'LCID ' => 'uint32 ',
            'HWND ' => 'int '
        );
        
        return str_ireplace(array_keys($arr), array_values($arr), $type);
    }
    
    public function func($line){
        
        if ( func_num_args() > 1 ){
            foreach(func_get_args() as $value)
                $this->func($value);
        } else
            $this->functions[] = DynLib::typeFix($line);
    }
    
    public function reg(){
        
        $lib = '';
        foreach($this->functions as $line){
            $lib .= '[lib=\'user32.dll\'] ' . $line . ";\n";
        }
        
        $ffi = new FFI($lib);
        $this->ffi = $ffi;
        return $ffi;
    }
    
    public function __call($name, $args){
        
        return call_user_func_array(array($this->ffi, $name), $args);
    }
}
?>