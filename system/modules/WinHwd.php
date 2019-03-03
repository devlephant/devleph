<?
function SendMessageW($hWnd,$Msg,$wParam,$lParam){
	static $FFI;
	if(!isset($FFI)){
    $FFI = new ffi("
        [lib='user32.dll']
        int SendMessageW( int hWnd, int Msg, int wParam, char *lParam );
    ");
	}
	return $FFI->SendMessageW($hWnd,$Msg,$wParam,$lParam);
}

function SendMessageA($hWnd,$Msg,$wParam,$lParam){
	static $FFI;
	if(!isset($FFI)){
    $FFI = new ffi("
        [lib='user32.dll']
        int SendMessageA( int hWnd, int Msg, int wParam, char *lParam );
    ");
	}
	return $FFI->SendMessageA($hWnd,$Msg,$wParam,$lParam);
}

function FindWindowA($lpClassName,$lpWindowName){
	static $FFI;
	if(!isset($FFI)){
    $FFI = new ffi("
        [lib='user32.dll']
        int FindWindowA( char *lpClassName, char *lpWindowName );
    ");
	}
	return $FFI->FindWindowA($lpClassName,$lpWindowName);
}
?>