<?php
Class TWinAPI Extends __TNoVisual{
public $class_name_ex = __CLASS__;



//////////////////////////////////////////////////////////////////////////////////
Function FindWindow( $Caption ){
$FFI = new FFI(
 "[lib='user32.dll'] int FindWindowA ( char *lpClassName, char *lpWindowName ); ");
 Return $FFI->FindWindowA(NULL,$Caption);
 $FFI->Free();
}
//////////////////////////////////////////////////////////////////////////////////
Function AnimateWindow ( $Handle, $Time, $Flags ){
$FFI = new FFI("[lib='user32.dll'] int AnimateWindow ( int hWnd, int dwTime, int dwFlags ); ");
 Return $FFI->AnimateWindow($Handle,$Time,$Flags);
 $FFI->Free();
}
//////////////////////////////////////////////////////////////////////////////////
Function ArrangeIconicWindows ( $Handle ){
$FFI = new FFI("[lib='user32.dll'] int ArrangeIconicWindows ( int hWnd ); ");
 Return $FFI->ArrangeIconicWindows ( $Handle );
 $FFI->Free();
}
//////////////////////////////////////////////////////////////////////////////////
Function BringWindowToTop ( $Handle ){
 $FFI = new FFI("[lib='user32.dll'] int BringWindowToTop ( int hWnd ); ");
 Return $FFI->BringWindowToTop ( $Handle );
 $FFI->Free();
}
//////////////////////////////////////////////////////////////////////////////////
Function ChildWindowFromPoint ( $Handle , $x,$y ){
$FFI = new FFI("[lib='user32.dll'] int ChildWindowFromPoint ( int hWndParent, int X, int Y ); ");
 Return $FFI->ChildWindowFromPoint ( $Handle , $x , $y);
 $FFI->Free();
}
//////////////////////////////////////////////////////////////////////////////////
Function ChildWindowFromPointEx ( $Handle , $x,$y ){
$FFI = new FFI("[lib='user32.dll'] int ChildWindowFromPoint ( int hWndParent, int X, int Y [, int uFlags = CWP_ALL] ); ");
 Return $FFI->ChildWindowFromPointEx ( $Handle , $x , $y);
 $FFI->Free();
}
//////////////////////////////////////////////////////////////////////////////////
Function CloseWindow ( $Handle ){
$FFI = new FFI("[lib='user32.dll'] int CloseWindow ( int hWndParent ); ");
 Return $FFI->CloseWindow ( $Handle );
 $FFI->Free();
}
//////////////////////////////////////////////////////////////////////////////////
Function EnableWindow ( $Handle , $Enable){
$FFI = new FFI("[lib='user32.dll'] int EnableWindow ( int hWnd, bool bEnable ); ");
 Return $FFI->EnableWindow ( $Handle , $Enable);
 $FFI->Free();
}
//////////////////////////////////////////////////////////////////////////////////
Function DestroyWindow ( $Handle ){
$FFI = new FFI("[lib='user32.dll'] int DestroyWindow ( int hWnd ); ");
 Return $FFI->DestroyWindow ( $Handle );
 $FFI->Free();
}
//////////////////////////////////////////////////////////////////////////////////
Function GetActiveWindow (){
$FFI = new FFI("[lib='user32.dll'] int GetActiveWindow (); ");
 Return $FFI->GetActiveWindow ();
 $FFI->Free();
}
//////////////////////////////////////////////////////////////////////////////////
Function GetAncestor ( $Handle , $Flag = GA_PARENT){
$FFI = new FFI("[lib='user32.dll'] int GetAncestor ( int hWnd [, int gaFlags = GA_PARENT] ); ");
 Return $FFI->GetAncestor ($Handle,$Flag);
 $FFI->Free();
}
//////////////////////////////////////////////////////////////////////////////////
Function SetWindowPos ( $Handle , $HIA , $x , $y , $w , $h , $Flag ){
$FFI = new FFI("[lib='user32.dll'] int SetWindowPos ( int hWnd, int hWndInsertAfter, int X, int Y, int W, int H, int uFlags ); ");
 Return $FFI->SetWindowPos ($Handle,$HIA,$x,$y,$w,$h,$Flag);
 $FFI->Free();
}
//////////////////////////////////////////////////////////////////////////////////
Function GetDesktopWindow (){
$FFI = new FFI("[lib='user32.dll'] int GetDesktopWindow (); ");
 Return $FFI->GetDesktopWindow ();
 $FFI->Free();
}
//////////////////////////////////////////////////////////////////////////////////
Function GetFocus (){
$FFI = new FFI("[lib='user32.dll'] int GetFocus (); ");
 Return $FFI->GetFocus ();
 $FFI->Free();
}
//////////////////////////////////////////////////////////////////////////////////
Function GetForegroundWindow(){
 $FFI = new FFI("[lib='user32.dll'] int GetForegroundWindow(); ");
 Return $FFI->GetForegroundWindow();
 $FFI->Free();
}
//////////////////////////////////////////////////////////////////////////////////
Function GetLastActivePopup( $Handle ){
 $FFI = new FFI("[lib='user32.dll'] int GetLastActivePopup ( int hWnd ); ");
 Return $FFI->GetLastActivePopup($Handle);
 $FFI->Free();
}
//////////////////////////////////////////////////////////////////////////////////
Function GetLayeredWindowAttributes( $Handle ){
 $FFI = new FFI("[lib='user32.dll'] int GetLayeredWindowAttributes ( int hWnd ); ");
 Return $FFI->GetLayeredWindowAttributes($Handle);
 $FFI->Free();
}
//////////////////////////////////////////////////////////////////////////////////
Function GetShellWindow(){
 $FFI = new FFI("[lib='user32.dll'] int GetShellWindow (); ");
 Return $FFI->GetShellWindow();
 $FFI->Free();
}
//////////////////////////////////////////////////////////////////////////////////
Function GetSysColor( $Index ){
 $FFI = new FFI("[lib='user32.dll'] int GetSysColor ( int nIndex ); ");
 Return $FFI->GetSysColor($Index);
 $FFI->Free();
}
//////////////////////////////////////////////////////////////////////////////////
Function GetTopWindow( $Handle ){
 $FFI = new FFI("[lib='user32.dll'] int GetTopWindow ( int hWnd ); ");
 Return $FFI->GetTopWindow($Handle);
 $FFI->Free();
}
//////////////////////////////////////////////////////////////////////////////////
Function GetWindow( $Handle ){
 $FFI = new FFI("[lib='user32.dll'] int GetWindow( int hWnd, int wCmd ); ");
 Return $FFI->GetWindow($Handle);
 $FFI->Free();
}
//////////////////////////////////////////////////////////////////////////////////
Function GetWindowLong( $Handle , $Index){
 $FFI = new FFI("[lib='user32.dll'] int GetWindowLongA ( int hWnd , int nIndex ); ");
 Return $FFI->GetWindowLongA($Handle,$Index);
 $FFI->Free();
}
//////////////////////////////////////////////////////////////////////////////////
Function GetClientRect( $Handle ){
$FFI = new FFI("
    struct RECT {
        long left;
        long top;
        long right;
        long bottom;
    };
    [lib='user32.dll'] int GetClientRect ( int hWnd , struct RECT *lpRect );
");
$recet = new FFIStruct($FFI, "RECT");
$FFI->GetClientRect( $Handle, $recet);

$Rect['Width'] = $recet->right;
$Rect['Height'] = $recet->bottom;
    
Return $Rect;
$FFI->Free();
}
//////////////////////////////////////////////////////////////////////////////////
Function GetWindowRect( $Handle ){
$FFI = new FFI("
    struct RECT {
        long left;
        long top;
        long right;
        long bottom;
    };
    [lib='user32.dll'] int GetWindowRect ( int hWnd , struct RECT *lpRect );
");
$recet = new FFIStruct($FFI, "RECT");
$FFI->GetWindowRect( $Handle, $recet);
$Rect['X'] = $recet->left;
$Rect['Y'] = $recet->top;
$Rect['Width'] = $recet->right;
$Rect['Height'] = $recet->bottom;
    
Return $Rect;
$FFI->Free();
}
//////////////////////////////////////////////////////////////////////////////////
Function SwitchToThisWindow( $Handle , $Alt = false ){
 $FFI = new FFI( "[lib='user32.dll'] int SwitchToThisWindow ( int hWnd , int fAltTab ); ");
 Return $FFI->SwitchToThisWindow  ( $Handle , false );
 $FFI->Free();
}
//////////////////////////////////////////////////////////////////////////////////
Function IsChild ( $Handle1 , $Handle2 ){
 $FFI = new FFI( "[lib='user32.dll'] int IsChild ( int hWndParent, int hWnd ); ");
 Return $FFI->IsChild ( $Handle1 , $Handle2 );
 $FFI->Free();
}
//////////////////////////////////////////////////////////////////////////////////
Function IsGUIThread( $convert = false ){
 $FFI = new FFI( "[lib='user32.dll'] int IsGUIThread ( int bconvert ); ");
 Return $FFI->IsGUIThread ( $convert );
 $FFI->Free();
}
//////////////////////////////////////////////////////////////////////////////////
Function IsHungAppWindow( $Handle ){
 $FFI = new FFI( "[lib='user32.dll'] int IsHungAppWindow ( int hWnd ); ");
 Return $FFI->IsHungAppWindow ( $Handle );
 $FFI->Free();
}
//////////////////////////////////////////////////////////////////////////////////
Function IsIconic( $Handle ){
 $FFI = new FFI( "[lib='user32.dll'] int IsIconic ( int hWnd ); ");
 Return $FFI->IsIconic ( $Handle );
 $FFI->Free();
}
//////////////////////////////////////////////////////////////////////////////////
Function IsWindow( $Handle ){
 $FFI = new FFI( "[lib='user32.dll'] int IsWindow ( int hWnd ); ");
 Return $FFI->IsWindow( $Handle );
 $FFI->Free();
}
//////////////////////////////////////////////////////////////////////////////////
Function IsWindowEnabled( $Handle ){
 $FFI = new FFI( "[lib='user32.dll'] int IsWindowEnabled ( int hWnd ); ");
 Return $FFI->IsWindowEnabled( $Handle );
 $FFI->Free();
}
//////////////////////////////////////////////////////////////////////////////////
Function IsWindowUnicode( $Handle ){
 $FFI = new FFI( "[lib='user32.dll'] int IsWindowUnicode ( int hWnd ); ");
 Return $FFI->IsWindowUnicode( $Handle );
 $FFI->Free();
}
//////////////////////////////////////////////////////////////////////////////////
Function IsWindowVisible( $Handle ){
 $FFI = new FFI( "[lib='user32.dll'] int IsWindowVisible ( int hWnd ); ");
 Return $FFI->IsWindowVisible( $Handle );
 $FFI->Free();
}
//////////////////////////////////////////////////////////////////////////////////
Function IsZoomed( $Handle ){
 $FFI = new FFI( "[lib='user32.dll'] uint32 IsZoomed( uint32 hWnd ); ");
 Return $FFI->IsZoomed( $Handle );
 $FFI->Free();
}
//////////////////////////////////////////////////////////////////////////////////
Function LockSetForegroundWindow( $Block ){
 $FFI = new FFI( "[lib='user32.dll'] int LockSetForegroundWindow( int uLockCode ); ");
 Return $FFI->LockSetForegroundWindow( $Block );
 $FFI->Free();
}
//////////////////////////////////////////////////////////////////////////////////
Function MoveWindow( $Handle , $x , $y , $w , $h , $Repaint = true ){
 $FFI = new FFI( "[lib='user32.dll'] int MoveWindow( int hWnd, int X, int Y, int W, int H , int bRepaint ); ");
 Return $FFI->MoveWindow( $Handle , $x , $y , $w , $h , $Repaint );
 $FFI->Free();
}
//////////////////////////////////////////////////////////////////////////////////
Function OpenIcon( $Handle ){
 $FFI = new FFI( "[lib='user32.dll'] int OpenIcon( int hWnd ); ");
 Return $FFI->OpenIcon( $Handle );
 $FFI->Free();
}
//////////////////////////////////////////////////////////////////////////////////
Function SetActiveWindow( $Handle ){
 $FFI = new FFI( "[lib='user32.dll'] int SetActiveWindow( int hWnd ); ");
 Return $FFI->SetActiveWindow( $Handle );
 $FFI->Free();
}
//////////////////////////////////////////////////////////////////////////////////
Function SetFocusAt( $Handle ){
 $FFI = new FFI( "[lib='user32.dll'] int SetFocus( int hWnd ); ");
 Return $FFI->SetFocus( $Handle );
 $FFI->Free();
}
//////////////////////////////////////////////////////////////////////////////////
Function SetForegroundWindow( $Handle ){
 $FFI = new FFI( "[lib='user32.dll'] int SetForegroundWindow( int hWnd ); ");
 Return $FFI->SetForegroundWindow( $Handle );
 $FFI->Free();
}
//////////////////////////////////////////////////////////////////////////////////
Function SetLayeredWindowAttributes( $Handle , $key , $Alpha , $Flags ){
 $FFI = new FFI( "[lib='user32.dll'] int SetLayeredWindowAttributes( int hWnd, int crKey, int bAlpha, int dwFlags ); ");
 Return $FFI->SetLayeredWindowAttributes( $Handle , $key , $Alpha , $Flags );
 $FFI->Free();
}
//////////////////////////////////////////////////////////////////////////////////
Function SetParent( $Child , $NewParent ){
 $FFI = new FFI( "[lib='user32.dll'] int SetParent( int hWndChild, int hWndNewParent ); ");
 Return $FFI->SetParent( $Child , $NewParent );
 $FFI->Free();
}
//////////////////////////////////////////////////////////////////////////////////
Function SetSysColors( $Value , $Elements , $ElementValue ){
 $FFI = new FFI( "[lib='user32.dll'] int SetSysColors( int cElements, array lpaElements, int lpaRgbValues ); ");
 Return $FFI->SetSysColors( $Value , $Elements , $ElementValue );
 $FFI->Free();
}
//////////////////////////////////////////////////////////////////////////////////
Function SetWindowLong( $Handle , $NewLong , $Index = GWL_EXSTYLE ){
 $FFI = new FFI( "[lib='user32.dll'] int SetWindowLong( int hWnd, int dwNewLong , int nIndex ); ");
 Return $FFI->SetWindowLong( $Handle , $NewLong , $Index );
 $FFI->Free();
}
//////////////////////////////////////////////////////////////////////////////////
Function SetWindowText ( $Handle , $Text ){
 $FFI = new FFI( "[lib='user32.dll'] int SetWindowTextA( int hWnd, char *lpString ); ");
 Return $FFI->SetWindowTextA( $Handle , $Text );
 $FFI->Free();
}
//////////////////////////////////////////////////////////////////////////////////
Function ShowOwnedPopups ( $Handle , $Show = true ){
 $FFI = new FFI( "[lib='user32.dll'] int ShowOwnedPopups( int hWnd , int fShow ); ");
 Return $FFI->ShowOwnedPopups( $Handle , $Show);
 $FFI->Free();
}
//////////////////////////////////////////////////////////////////////////////////
Function ShowWindow ( $Handle , $CmdShow = SW_SHOW ){
 $FFI = new FFI( "[lib='user32.dll'] int ShowWindow( int hWnd , int nCmdShow ); ");
 Return $FFI->ShowWindow( $Handle , $CmdShow);
 $FFI->Free();
}
//////////////////////////////////////////////////////////////////////////////////
Function ShowWindowAsync ( $Handle , $CmdShow = SW_SHOW ){
 $FFI = new FFI( "[lib='user32.dll'] int ShowWindowAsync( int hWnd , int nCmdShow ); ");
 Return $FFI->ShowWindowAsync( $Handle , $CmdShow);
 $FFI->Free();
}
//////////////////////////////////////////////////////////////////////////////////
Function WindowFromCursor (){
 $FFI = new FFI( "[lib='user32.dll'] int WindowFromCursor(); ");
 Return $FFI->WindowFromCursor();
 $FFI->Free();
}
//////////////////////////////////////////////////////////////////////////////////
Function WindowFromPoint ( $x , $y ){
 $FFI = new FFI( "[lib='user32.dll'] int WindowFromPoint( int X, int Y ); ");
 Return $FFI->WindowFromPoint( $x , $y );
 $FFI->Free();
}

//////////////////////////////////////////////////////////////////////////////////
Function Write( $Handle , $Text ){
 $FFI = new FFI(
 "[lib='user32.dll'] int SwitchToThisWindow ( int hWnd , int fAltTab ); ");
$FFI->SwitchToThisWindow($Handle,false); 

 $COM = new COM("Wscript.shell");
 Return $COM->SendKeys($Text);
}



Public Function __construct($owner=nil,$init=true,$self=nil){
        parent::__construct($owner,$init,$self); }


}