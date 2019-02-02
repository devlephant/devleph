<?
class winapi {
	function findwindow($Caption){
		$FFI = new FFI("[lib='user32.dll'] int FindWindowA(char *lpClassName, char *lpWindowName);");
		return $FFI->FindWindowA(NULL,$Caption);
		$FFI->free();
	}
	function AnimateWindow($Handle, $Time, $Flags){
		$FFI = new FFI("[lib='user32.dll'] int AnimateWindow(int hWnd, int dwTime, int dwFlags); ");
		return $FFI->AnimateWindow($Handle,$Time,$Flags);
		$FFI->free();
	}
	function ArrangeIconicWindows($Handle){
		$FFI = new FFI("[lib='user32.dll'] int ArrangeIconicWindows(int hWnd); ");
		return $FFI->ArrangeIconicWindows($Handle);
		$FFI->free();
	}
	function BringWindowToTop($Handle){
		$FFI = new FFI("[lib='user32.dll'] int BringWindowToTop(int hWnd); ");
		return $FFI->BringWindowToTop($Handle);
		$FFI->free();
	}
	function ChildWindowFromPoint($Handle , $x,$y){
		$FFI = new FFI("[lib='user32.dll'] int ChildWindowFromPoint(int hWndParent, int X, int Y); ");
		return $FFI->ChildWindowFromPoint($Handle , $x , $y);
		$FFI->free();
	}
	function ChildWindowFromPointEx($Handle, $x, $y){
		$FFI = new FFI("[lib='user32.dll'] int ChildWindowFromPoint(int hWndParent, int X, int Y [, int uFlags = CWP_ALL]); ");
		return $FFI->ChildWindowFromPointEx($Handle , $x , $y);
		$FFI->free();
	}

	function CloseWindow($Handle){
		$FFI = new FFI("[lib='user32.dll'] int CloseWindow(int hWndParent); ");
		return $FFI->CloseWindow($Handle);
		$FFI->free();
	}

	function EnableWindow($Handle , $Enable){
		$FFI = new FFI("[lib='user32.dll'] int EnableWindow(int hWnd, bool bEnable); ");
		return $FFI->EnableWindow($Handle , $Enable);
		$FFI->free();
	}

	function DestroyWindow($Handle){
		$FFI = new FFI("[lib='user32.dll'] int DestroyWindow(int hWnd); ");
		return $FFI->DestroyWindow($Handle);
		$FFI->free();
	}

	function GetActiveWindow (){
		$FFI = new FFI("[lib='user32.dll'] int GetActiveWindow (); ");
		return $FFI->GetActiveWindow ();
		$FFI->free();
	}

	function GetAncestor($Handle , $Flag = GA_PARENT){
		$FFI = new FFI("[lib='user32.dll'] int GetAncestor(int hWnd [, int gaFlags = GA_PARENT]); ");
		return $FFI->GetAncestor ($Handle,$Flag);
		$FFI->free();
	}

	function SetWindowPos($Handle , $HIA , $x , $y , $w , $h , $Flag){
		$FFI = new FFI("[lib='user32.dll'] int SetWindowPos(int hWnd, int hWndInsertAfter, int X, int Y, int W, int H, int uFlags); ");
		return $FFI->SetWindowPos ($Handle,$HIA,$x,$y,$w,$h,$Flag);
		$FFI->free();
	}

	function GetDesktopWindow (){
		$FFI = new FFI("[lib='user32.dll'] int GetDesktopWindow (); ");
		return $FFI->GetDesktopWindow ();
		$FFI->free();
	}

	function GetFocus (){
		$FFI = new FFI("[lib='user32.dll'] int GetFocus (); ");
		return $FFI->GetFocus ();
		$FFI->free();
	}

	function GetForegroundWindow(){
		$FFI = new FFI("[lib='user32.dll'] int GetForegroundWindow(); ");
		return $FFI->GetForegroundWindow();
		$FFI->free();
	}

	function GetLastActivePopup( $Handle){
		$FFI = new FFI("[lib='user32.dll'] int GetLastActivePopup(int hWnd); ");
		return $FFI->GetLastActivePopup($Handle);
		$FFI->free();
	}

	function GetLayeredWindowAttributes( $Handle){
		$FFI = new FFI("[lib='user32.dll'] int GetLayeredWindowAttributes(int hWnd); ");
		return $FFI->GetLayeredWindowAttributes($Handle);
		$FFI->free();
	}

	function GetShellWindow(){
		$FFI = new FFI("[lib='user32.dll'] int GetShellWindow (); ");
		return $FFI->GetShellWindow();
		$FFI->free();
	}

	function GetSysColor( $Index){
		$FFI = new FFI("[lib='user32.dll'] int GetSysColor(int nIndex); ");
		return $FFI->GetSysColor($Index);
		$FFI->free();
	}

	function GetTopWindow( $Handle){
		$FFI = new FFI("[lib='user32.dll'] int GetTopWindow(int hWnd); ");
		return $FFI->GetTopWindow($Handle);
		$FFI->free();
	}

	function GetWindow( $Handle){
		$FFI = new FFI("[lib='user32.dll'] int GetWindow( int hWnd, int wCmd); ");
		return $FFI->GetWindow($Handle);
		$FFI->free();
	}

	function GetWindowLong( $Handle , $Index){
		$FFI = new FFI("[lib='user32.dll'] int GetWindowLongA(int hWnd , int nIndex); ");
		return $FFI->GetWindowLongA($Handle,$Index);
		$FFI->free();
	}

	function GetClientRect( $Handle){
		$FFI = new FFI("
			struct RECT {
				long left;
				long top;
				long right;
				long bottom;
			};
			[lib='user32.dll'] int GetClientRect(int hWnd , struct RECT *lpRect);
		");
		$recet = new FFIStruct($FFI, "RECT");
		$FFI->GetClientRect( $Handle, $recet);

		$Rect['Width'] = $recet->right;
		$Rect['Height'] = $recet->bottom;
		
		return $Rect;
		$FFI->free();
	}

	function GetWindowRect( $Handle){
		$FFI = new FFI("
			struct RECT {
				long left;
				long top;
				long right;
				long bottom;
			};
			[lib='user32.dll'] int GetWindowRect(int hWnd , struct RECT *lpRect);
		");
		$recet = new FFIStruct($FFI, "RECT");
		$FFI->GetWindowRect( $Handle, $recet);
		$Rect['X'] = $recet->left;
		$Rect['Y'] = $recet->top;
		$Rect['Width'] = $recet->right;
		$Rect['Height'] = $recet->bottom;
		
		return $Rect;
		$FFI->free();
	}

	function SwitchToThisWindow( $Handle , $Alt = false){
		$FFI = new FFI( "[lib='user32.dll'] int SwitchToThisWindow(int hWnd , int fAltTab); ");
		return $FFI->SwitchToThisWindow ($Handle , false);
		$FFI->free();
	}

	function IsChild($Handle1 , $Handle2){
		$FFI = new FFI( "[lib='user32.dll'] int IsChild(int hWndParent, int hWnd); ");
		return $FFI->IsChild($Handle1 , $Handle2);
		$FFI->free();
	}

	function IsGUIThread( $convert = false){
		$FFI = new FFI( "[lib='user32.dll'] int IsGUIThread(int bconvert); ");
		return $FFI->IsGUIThread($convert);
		$FFI->free();
	}

	function IsHungAppWindow( $Handle){
		$FFI = new FFI( "[lib='user32.dll'] int IsHungAppWindow(int hWnd); ");
		return $FFI->IsHungAppWindow($Handle);
		$FFI->free();
	}

	function IsIconic( $Handle){
		$FFI = new FFI( "[lib='user32.dll'] int IsIconic(int hWnd); ");
		return $FFI->IsIconic($Handle);
		$FFI->free();
	}

	function IsWindow( $Handle){
		$FFI = new FFI( "[lib='user32.dll'] int IsWindow(int hWnd); ");
		return $FFI->IsWindow( $Handle);
		$FFI->free();
	}

	function IsWindowEnabled( $Handle){
		$FFI = new FFI( "[lib='user32.dll'] int IsWindowEnabled(int hWnd); ");
		return $FFI->IsWindowEnabled( $Handle);
		$FFI->free();
	}

	function IsWindowUnicode( $Handle){
		$FFI = new FFI( "[lib='user32.dll'] int IsWindowUnicode(int hWnd); ");
		return $FFI->IsWindowUnicode( $Handle);
		$FFI->free();
	}

	function IsWindowVisible( $Handle){
		$FFI = new FFI( "[lib='user32.dll'] int IsWindowVisible(int hWnd); ");
		return $FFI->IsWindowVisible( $Handle);
		$FFI->free();
	}

	function IsZoomed( $Handle){
		$FFI = new FFI( "[lib='user32.dll'] uint32 IsZoomed( uint32 hWnd); ");
		return $FFI->IsZoomed( $Handle);
		$FFI->free();
	}

	function LockSetForegroundWindow( $Block){
		$FFI = new FFI( "[lib='user32.dll'] int LockSetForegroundWindow( int uLockCode); ");
		return $FFI->LockSetForegroundWindow( $Block);
		$FFI->free();
	}

	function MoveWindow( $Handle , $x , $y , $w , $h , $Repaint = true){
		$FFI = new FFI( "[lib='user32.dll'] int MoveWindow( int hWnd, int X, int Y, int W, int H , int bRepaint); ");
		return $FFI->MoveWindow( $Handle , $x , $y , $w , $h , $Repaint);
		$FFI->free();
	}

	function OpenIcon( $Handle){
		$FFI = new FFI( "[lib='user32.dll'] int OpenIcon( int hWnd); ");
		return $FFI->OpenIcon( $Handle);
		$FFI->free();
	}

	function SetActiveWindow( $Handle){
		$FFI = new FFI( "[lib='user32.dll'] int SetActiveWindow( int hWnd); ");
		return $FFI->SetActiveWindow( $Handle);
		$FFI->free();
	}

	function SetFocus( $Handle){
		$FFI = new FFI( "[lib='user32.dll'] int SetFocus( int hWnd); ");
		return $FFI->SetFocus( $Handle);
		$FFI->free();
	}

	function SetForegroundWindow( $Handle){
		$FFI = new FFI( "[lib='user32.dll'] int SetForegroundWindow( int hWnd); ");
		return $FFI->SetForegroundWindow( $Handle);
		$FFI->free();
	}

	function SetLayeredWindowAttributes( $Handle , $key , $Alpha , $Flags){
		$FFI = new FFI( "[lib='user32.dll'] int SetLayeredWindowAttributes( int hWnd, int crKey, int bAlpha, int dwFlags); ");
		return $FFI->SetLayeredWindowAttributes( $Handle , $key , $Alpha , $Flags);
		$FFI->free();
	}

	function SetParent( $Child , $NewParent){
		$FFI = new FFI( "[lib='user32.dll'] int SetParent( int hWndChild, int hWndNewParent); ");
		return $FFI->SetParent( $Child , $NewParent);
		$FFI->free();
	}

	function SetSysColors( $Value , $Elements , $ElementValue){
		$FFI = new FFI( "[lib='user32.dll'] int SetSysColors( int cElements, array lpaElements, int lpaRgbValues); ");
		return $FFI->SetSysColors( $Value , $Elements , $ElementValue);
		$FFI->free();
	}

	function SetWindowLong( $Handle , $NewLong , $Index = GWL_EXSTYLE){
		$FFI = new FFI( "[lib='user32.dll'] int SetWindowLong( int hWnd, int dwNewLong , int nIndex); ");
		return $FFI->SetWindowLong( $Handle , $NewLong , $Index);
		$FFI->free();
	}

	function SetWindowText($Handle , $Text){
		$FFI = new FFI( "[lib='user32.dll'] int SetWindowTextA( int hWnd, char *lpString); ");
		return $FFI->SetWindowTextA( $Handle , $Text);
		$FFI->free();
	}

	function ShowOwnedPopups($Handle , $Show = true){
		$FFI = new FFI( "[lib='user32.dll'] int ShowOwnedPopups( int hWnd , int fShow); ");
		return $FFI->ShowOwnedPopups( $Handle , $Show);
		$FFI->free();
	}

	function ShowWindow($Handle , $CmdShow = SW_SHOW){
		$FFI = new FFI( "[lib='user32.dll'] int ShowWindow( int hWnd , int nCmdShow); ");
		return $FFI->ShowWindow( $Handle , $CmdShow);
		$FFI->free();
	}

	function ShowWindowAsync($Handle , $CmdShow = SW_SHOW){
		$FFI = new FFI( "[lib='user32.dll'] int ShowWindowAsync( int hWnd , int nCmdShow); ");
		return $FFI->ShowWindowAsync( $Handle , $CmdShow);
		$FFI->free();
	}

	function WindowFromCursor (){
		$FFI = new FFI( "[lib='user32.dll'] int WindowFromCursor(); ");
		return $FFI->WindowFromCursor();
		$FFI->free();
	}

	function WindowFromPoint($x , $y){
		$FFI = new FFI( "[lib='user32.dll'] int WindowFromPoint( int X, int Y); ");
		return $FFI->WindowFromPoint( $x , $y);
		$FFI->free();
	}


	function Write( $Handle , $Text){
		$FFI = new FFI(
		"[lib='user32.dll'] int SwitchToThisWindow(int hWnd , int fAltTab); ");
		$FFI->SwitchToThisWindow($Handle,false); 

		$COM = new COM("Wscript.shell");
		return $COM->SendKeys($Text);
	}
}