<?
global $_c;

  // default languages
  $_c->LANG_NEUTRAL                         = 0x00;
  $_c->LANG_AFRIKAANS                       = 0x36;
  $_c->LANG_ALBANIAN                        = 0x1c; 
  $_c->LANG_ARABIC                          = 0x01;  
  $_c->LANG_BASQUE                          = 0x2d;  
  $_c->LANG_BELARUSIAN                      = 0x23;  
  $_c->LANG_BULGARIAN                       = 0x02;  
  $_c->LANG_CATALAN                         = 0x03;  
  $_c->LANG_CHINESE                         = 0x04;  
  $_c->LANG_CROATIAN                        = 0x1a;  
  $_c->LANG_CZECH                           = 0x05;  
  $_c->LANG_DANISH                          = 0x06;  
  $_c->LANG_DUTCH                           = 0x13;  
  $_c->LANG_ENGLISH                         = 0x09;  
  $_c->LANG_ESTONIAN                        = 0x25;  
  $_c->LANG_FAEROESE                        = 0x38;  
  $_c->LANG_FARSI                           = 0x29;  
  $_c->LANG_FINNISH                         = 0x0b;  
  $_c->LANG_FRENCH                          = 0x0c;  
  $_c->LANG_GERMAN                          = 0x07;  
  $_c->LANG_GREEK                           = 0x08;  
  $_c->LANG_HEBREW                          = 0x0d;  
  $_c->LANG_HUNGARIAN                       = 0x0e;  
  $_c->LANG_ICELANDIC                       = 0x0f;  
  $_c->LANG_INDONESIAN                      = 0x21;  
  $_c->LANG_ITALIAN                         = 0x10;  
  $_c->LANG_JAPANESE                        = 0x11;  
  $_c->LANG_KOREAN                          = 0x12;  
  $_c->LANG_LATVIAN                         = 0x26;  
  $_c->LANG_LITHUANIAN                      = 0x27;  
  $_c->LANG_NORWEGIAN                       = 0x14;  
  $_c->LANG_POLISH                          = 0x15;  
  $_c->LANG_PORTUGUESE                      = 0x16;  
  $_c->LANG_ROMANIAN                        = 0x18;  
  $_c->LANG_RUSSIAN                         = 0x19;  
  $_c->LANG_SERBIAN                         = 0x1a;  
  $_c->LANG_SLOVAK                          = 0x1b;  
  $_c->LANG_SLOVENIAN                       = 0x24;  
  $_c->LANG_SPANISH                         = 0x0a;  
  $_c->LANG_SWEDISH                         = 0x1d; 
  $_c->LANG_THAI                            = 0x1e; 
  $_c->LANG_TURKISH                         = 0x1f;  
  $_c->LANG_UKRAINIAN                       = 0x22;  
  $_c->LANG_VIETNAMESE                      = 0x2a;
  
  // attributes
  $_c->FILE_SHARE_READ                     = 0x000001;
  $_c->FILE_SHARE_WRITE                    = 0x000002;
  $_c->FILE_SHARE_DELETE                   = 0x000004;
  $_c->FILE_ATTRIBUTE_READONLY             = 0x000001;  
  $_c->FILE_ATTRIBUTE_HIDDEN               = 0x000002;  
  $_c->FILE_ATTRIBUTE_SYSTEM               = 0x000004;  
  $_c->FILE_ATTRIBUTE_DIRECTORY            = 0x000010;  
  $_c->FILE_ATTRIBUTE_ARCHIVE              = 0x000020;  
  $_c->FILE_ATTRIBUTE_NORMAL               = 0x000080;  
  $_c->FILE_ATTRIBUTE_TEMPORARY            = 0x000100;  
  $_c->FILE_ATTRIBUTE_COMPRESSED           = 0x000800;  
  $_c->FILE_ATTRIBUTE_OFFLINE              = 0x001000;  
  $_c->FILE_NOTIFY_CHANGE_FILE_NAME        = 0x000001;  
  $_c->FILE_NOTIFY_CHANGE_DIR_NAME         = 0x000002;  
  $_c->FILE_NOTIFY_CHANGE_ATTRIBUTES       = 0x000004;  
  $_c->FILE_NOTIFY_CHANGE_SIZE             = 0x000008;  
  $_c->FILE_NOTIFY_CHANGE_LAST_WRITE       = 0x000010;  
  $_c->FILE_NOTIFY_CHANGE_LAST_ACCESS      = 0x000020;  
  $_c->FILE_NOTIFY_CHANGE_CREATION         = 0x000040;  
  $_c->FILE_NOTIFY_CHANGE_SECURITY         = 0x000100;  
  $_c->FILE_ACTION_ADDED                   = 0x000001;  
  $_c->FILE_ACTION_REMOVED                 = 0x000002;  
  $_c->FILE_ACTION_MODIFIED                = 0x000003;  
  $_c->FILE_ACTION_RENAMED_OLD_NAME        = 0x000004;  
  $_c->FILE_ACTION_RENAMED_NEW_NAME        = 0x000005;  
  $_c->MAILSLOT_NO_MESSAGE                 = -1;  
  $_c->MAILSLOT_WAIT_FOREVER               = -1;  
  $_c->FILE_CASE_SENSITIVE_SEARCH          = 0x000001;  
  $_c->FILE_CASE_PRESERVED_NAMES           = 0x000002;  
  $_c->FILE_UNICODE_ON_DISK                = 0x000004;  
  $_c->FILE_PERSISTENT_ACLS                = 0x000008;  
  $_c->FILE_FILE_COMPRESSION               = 0x000010;  
  $_c->FILE_VOLUME_IS_COMPRESSED           = 0x008000;
  
  // { The following are masks for the predefined standard access types }
  $_c->SYNCHRONIZE = 0x0100000;
  
  $_c->_DELETE                  = 0x010000; // Renamed from DELETE
  $_c->READ_CONTROL             = 0x020000; 
  $_c->WRITE_DAC                = 0x040000;  
  $_c->WRITE_OWNER              = 0x080000;  
  $_c->STANDARD_RIGHTS_READ     = READ_CONTROL;  
  $_c->STANDARD_RIGHTS_WRITE    = READ_CONTROL;  
  $_c->STANDARD_RIGHTS_EXECUTE  = READ_CONTROL;  
  $_c->STANDARD_RIGHTS_ALL      = 0x1F0000;  
  $_c->SPECIFIC_RIGHTS_ALL      = 0x00FFFF;  
  $_c->ACCESS_SYSTEM_SECURITY   = 0x1000000;  
  $_c->MAXIMUM_ALLOWED          = 0x2000000;  
  $_c->GENERIC_READ             = 0x80000000;  
  $_c->GENERIC_WRITE            = 0x40000000;  
  $_c->GENERIC_EXECUTE          = 0x20000000;
  $_c->GENERIC_ALL              = 0x10000000;
  
  // { Registry Specific Access Rights. }
  $_c->KEY_QUERY_VALUE    = 0x0001;
  $_c->KEY_SET_VALUE      = 0x0002;
  $_c->KEY_CREATE_SUB_KEY = 0x0004;
  $_c->KEY_ENUMERATE_SUB_KEYS = 0x0008;
  $_c->KEY_NOTIFY         = 0x0010;
  $_c->KEY_CREATE_LINK    = 0x0020;
  
  $_c->KEY_READ           = 131097;
  $_c->KEY_WRITE          = 131078;
  $_c->KEY_EXECUTE        = KEY_READ;
  $_c->KEY_ALL_ACCESS     = 983103;

  // { Scroll Bar Constants }
  $_c->SB_HORZ = 0;
  $_c->SB_VERT = 1;
  $_c->SB_CTL = 2;
  $_c->SB_BOTH = 3;

   // { Scroll Bar Commands }
  $_c->SB_LINEUP = 0;
  $_c->SB_LINELEFT = 0;
  $_c->SB_LINEDOWN = 1;
  $_c->SB_LINERIGHT = 1;
  $_c->SB_PAGEUP = 2;
  $_c->SB_PAGELEFT = 2;
  $_c->SB_PAGEDOWN = 3;
  $_c->SB_PAGERIGHT = 3;
  $_c->SB_THUMBPOSITION = 4;
  $_c->SB_THUMBTRACK = 5;
  $_c->SB_TOP = 6;
  $_c->SB_LEFT = 6;
  $_c->SB_BOTTOM = 7;
  $_c->SB_RIGHT = 7;
  $_c->SB_ENDSCROLL = 8;

  // ShowWindow() Commands  
  $_c->SW_HIDE = 0;
  $_c->SW_SHOWNORMAL = 1;
  $_c->SW_NORMAL = 1;
  $_c->SW_SHOWMINIMIZED = 2;
  $_c->SW_SHOWMAXIMIZED = 3;
  $_c->SW_MAXIMIZE = 3;
  $_c->SW_SHOWNOACTIVATE = 4;
  $_c->SW_SHOW = 5;
  $_c->SW_MINIMIZE = 6;
  $_c->SW_SHOWMINNOACTIVE = 7;
  $_c->SW_SHOWNA = 8;
  $_c->SW_RESTORE = 9;
  $_c->SW_SHOWDEFAULT = 10;
  $_c->SW_MAX = 10;
  
  // Identifiers for the WM_SHOWWINDOW message
  $_c->SW_PARENTCLOSING = 1;
  $_c->SW_OTHERZOOM = 2;
  $_c->SW_PARENTOPENING = 3;
  $_c->SW_OTHERUNZOOM = 4;
  
  $_c->AW_HOR_POSITIVE = 0x000001;
  $_c->AW_HOR_NEGATIVE = 0x000002;
  $_c->AW_VER_POSITIVE = 0x000004;
  $_c->AW_VER_NEGATIVE = 0x000008;
  $_c->AW_CENTER = 0x000010;
  $_c->AW_HIDE = 0x010000;
  $_c->AW_ACTIVATE = 0x020000;
  $_c->AW_SLIDE = 0x040000;
  $_c->AW_BLEND = 0x080000;
  
  // WM_KEYUPDOWNCHAR HiWord(lParam) flags 
  $_c->KF_EXTENDED = 0x100;
  $_c->KF_DLGMODE = 0x800;
  $_c->KF_MENUMODE = 0x1000;
  $_c->KF_ALTDOWN = 0x2000;
  $_c->KF_REPEAT = 0x4000;
  $_c->KF_UP = 0x8000;
  
  // Virtual Keys, Standard Set
  $_c->VK_LBUTTON = 1;  
  $_c->VK_RBUTTON = 2;  
  $_c->VK_CANCEL = 3; 
  $_c->VK_MBUTTON = 4;  // NOT contiguous with L & RBUTTON 
  $_c->VK_BACK = 8;  
  $_c->VK_TAB = 9; 
  $_c->VK_CLEAR = 12;  
  $_c->VK_RETURN = 13;
  $_c->VK_SHIFT = 0x10;  
  $_c->VK_CONTROL = 17;  
  $_c->VK_MENU = 18;
  $_c->VK_ALT  = 18;
  $_c->VK_PAUSE = 19;  
  $_c->VK_CAPITAL = 20;
  $_c->VK_KANA = 21;
  $_c->VK_HANGUL = 21;
  $_c->VK_JUNJA = 23;
  $_c->VK_FINAL = 24;
  $_c->VK_HANJA = 25;
  $_c->VK_KANJI = 25;
  $_c->VK_CONVERT = 28;
  $_c->VK_NONCONVERT = 29;
  $_c->VK_ACCEPT = 30;
  $_c->VK_MODECHANGE = 31;
  $_c->VK_ESCAPE = 27;
  $_c->VK_SPACE = 0x20;
  $_c->VK_PRIOR = 33;
  $_c->VK_NEXT = 34;
  $_c->VK_END = 35;
  $_c->VK_HOME = 36;
  $_c->VK_LEFT = 37;
  $_c->VK_UP = 38;
  $_c->VK_RIGHT = 39;
  $_c->VK_DOWN = 40;
  $_c->VK_SELECT = 41;
  $_c->VK_PRINT = 42;
  $_c->VK_EXECUTE = 43;
  $_c->VK_SNAPSHOT = 44;
  $_c->VK_INSERT = 45;
  $_c->VK_DELETE = 46;
  $_c->VK_HELP = 47;
//{ $_c->VK_0 thru $_c->VK_9 are the same as ASCII '0' thru '9' ($30 - $39) }
//{ $_c->VK_A thru $_c->VK_Z are the same as ASCII 'A' thru 'Z' ($41 - $5A) }
  
  $_c->VK_LWIN = 91;
  $_c->VK_RWIN = 92;
  $_c->VK_APPS = 93;
  $_c->VK_NUMPAD0 = 96;
  $_c->VK_NUMPAD1 = 97;
  $_c->VK_NUMPAD2 = 98;
  $_c->VK_NUMPAD3 = 99;
  $_c->VK_NUMPAD4 = 100;
  $_c->VK_NUMPAD5 = 101;
  $_c->VK_NUMPAD6 = 102;
  $_c->VK_NUMPAD7 = 103;
  $_c->VK_NUMPAD8 = 104;
  $_c->VK_NUMPAD9 = 105;
  $_c->VK_MULTIPLY = 106;
  $_c->VK_ADD = 107;
  $_c->VK_SEPARATOR = 108;
  $_c->VK_SUBTRACT = 109;
  $_c->VK_DECIMAL = 110;
  $_c->VK_DIVIDE = 111;
  $_c->VK_F1 = 112;
  $_c->VK_F2 = 113;
  $_c->VK_F3 = 114;
  $_c->VK_F4 = 115;
  $_c->VK_F5 = 116;
  $_c->VK_F6 = 117;
  $_c->VK_F7 = 118;
  $_c->VK_F8 = 119;
  $_c->VK_F9 = 120;
  $_c->VK_F10 = 121;
  $_c->VK_F11 = 122;
  $_c->VK_F12 = 123;
  $_c->VK_F13 = 124;
  $_c->VK_F14 = 125;
  $_c->VK_F15 = 126;
  $_c->VK_F16 = 127;
  $_c->VK_F17 = 128;
  $_c->VK_F18 = 129;
  $_c->VK_F19 = 130;
  $_c->VK_F20 = 131;
  $_c->VK_F21 = 132;
  $_c->VK_F22 = 133;
  $_c->VK_F23 = 134;
  $_c->VK_F24 = 135;
  $_c->VK_NUMLOCK = 144;
  $_c->VK_SCROLL = 145;
/*
 { $_c->VK_L & $_c->VK_R - left and right Alt, Ctrl and Shift virtual keys.
  Used only as parameters to GetAsyncKeyState() and GetKeyState().
  No other API or message will distinguish left and right keys in this way. }
*/
  $_c->VK_LSHIFT = 160;
  $_c->VK_RSHIFT = 161;
  $_c->VK_LCONTROL = 162;
  $_c->VK_RCONTROL = 163;
  $_c->VK_LMENU = 164;
  $_c->VK_RMENU = 165;
  $_c->VK_PROCESSKEY = 229;
  $_c->VK_ATTN = 246;
  $_c->VK_CRSEL = 247;
  $_c->VK_EXSEL = 248;
  $_c->VK_EREOF = 249;
  $_c->VK_PLAY = 250;
  $_c->VK_ZOOM = 251;
  $_c->VK_NONAME = 252;
  $_c->VK_PA1 = 253;
  $_c->VK_OEM_CLEAR = 254;
  
//TUpDown commands//
  $_c->udVertical = 0;
  $_c->udHorizontal = 1;
function findWindow($class,$name){
    return find_window($class);
}

function showWindow($handle,$mode = SW_SHOW){
    return show_window($handle,$mode);
}


class Receiver {
    
    
    static function add($function){
        
        $GLOBALS['__' . __CLASS__][] = $function;
    }
    
    static function event($handle, $msg){
        
        $arr = unserialize(base64_decode($msg));
        
        $array = (array)$GLOBALS['__' . __CLASS__];
        foreach ($array as $func){
            
            eval($func . '($handle, $arr);');
        }
    }
    
    static function send($handle, $arr){
        
        receiver_send($handle, base64_encode(serialize($arr)));
    }
}


class TDropFilesTarget extends TControl{
	
   
}

?>