<?

$result = [];

$result[] = array(
                  'CAPTION'=>'FindWindow',
                  'PROP'=>'FindWindow()',
                  'INLINE'=>'FindWindow ( char WindowName ) - поиск окна по загаловку.',
                  );

$result[] = array(
                  'CAPTION'=>'AnimateWindow',
                  'PROP'=>'AnimateWindow()',
                  'INLINE'=>'AnimateWindow ( int hWnd, int dwTime, int dwFlags ) - Анимация Окна.',
                  );
				 
$result[] = array(
                  'CAPTION'=>'ArrangeIconicWindows',
                  'PROP'=>'ArrangeIconicWindows()',
                  'INLINE'=>'ArrangeIconicWindows ( int hWnd ) - упорядочивает все минимизированные (в виде иконок) окна указанного родительского окна.',
                  );
				  
$result[] = array(
                  'CAPTION'=>'BringWindowToTop',
                  'PROP'=>'BringWindowToTop()',
                  'INLINE'=>'BringWindowToTop ( int hWnd ) - перемещает окно на передний план и активизирует его',
                  );				  
				  
$result[] = array(
                  'CAPTION'=>'ChildWindowFromPoint',
                  'PROP'=>'ChildWindowFromPoint()',
                  'INLINE'=>'ChildWindowFromPoint ( int hWndParent, int X, int Y ) - определяет, какое из дочерних окон содержит указанные координаты.',
                  );	
				  
$result[] = array(
                  'CAPTION'=>'ChildWindowFromPointEx',
                  'PROP'=>'ChildWindowFromPointEx()',
                  'INLINE'=>'ChildWindowFromPointEx ( int hWndParent, int X, int Y [, int uFlags = CWP_ALL] ) - определяет, какое из дочерних окон содержит указанные координаты.',
                  );	

$result[] = array(
                  'CAPTION'=>'CloseWindow',
                  'PROP'=>'CloseWindow()',
                  'INLINE'=>'CloseWindow ( int hWnd ) - минимизирует указанное окно.',
                  );	

$result[] = array(
                  'CAPTION'=>'DestroyWindow',
                  'PROP'=>'DestroyWindow()',
                  'INLINE'=>'DestroyWindow ( int hWnd ) - разрушает указанное окно (но не завершает приложение.',
                  );
				  
$result[] = array(
                  'CAPTION'=>'EnableWindow',
                  'PROP'=>'EnableWindow()',
                  'INLINE'=>'EnableWindow ( int hWnd, bool bEnable ) - разрешает или блокирует ввод с мыши и с клавиатуры в окно.',
                  );	
				  
$result[] = array(
                  'CAPTION'=>'GetActiveWindow',
                  'PROP'=>'GetActiveWindow()',
                  'INLINE'=>'GetActiveWindow ( void ) - возвращает дескриптор активного окна.',
                  );

$result[] = array( 
                  'CAPTION'=>'GetAncestor',
                  'PROP'=>'GetAncestor()',
                  'INLINE'=>'GetAncestor ( int hWnd [, int gaFlags = GA_PARENT] ) - возвращает дескриптор родителя заданного окна.',
                  );

$result[] = array( 
                  'CAPTION'=>'SetWindowPos',
                  'PROP'=>'SetWindowPos()',
                  'INLINE'=>'SetWindowPos ( int hWnd, int hWndInsertAfter, int X, int Y, int W, int H, int uFlags ) - изменяет pазмеp, положение и поpядок окна.',
                  );				  

$result[] = array( 
                  'CAPTION'=>'GetDesktopWindow',
                  'PROP'=>'GetDesktopWindow()',
                  'INLINE'=>'GetDesktopWindow ( void ) - возвращает дескриптор рабочего стола.',
                  );	

$result[] = array( 
                  'CAPTION'=>'GetFocus',
                  'PROP'=>'GetFocus()',
                  'INLINE'=>'GetFocus ( void ) - дескриптор окна, на котором установлен фокус.',
                  );
				  
$result[] = array(
                  'CAPTION'=>'GetForegroundWindow',
                  'PROP'=>'GetForegroundWindow()',
                  'INLINE'=>'GetForegroundWindow ( void ) - дескриптор приоритетного окна',
                  );
				  
$result[] = array(
                  'CAPTION'=>'GetLastActivePopup',
                  'PROP'=>'GetLastActivePopup()',
                  'INLINE'=>'GetLastActivePopup ( int hWnd ) - возвращает дескриптор всплывающего окна, которое было активным последний раз, владельцем которого является указанное окно.',
                  );
				  
$result[] = array(
                  'CAPTION'=>'GetLayeredWindowAttributes',
                  'PROP'=>'GetLayeredWindowAttributes()',
                  'INLINE'=>'GetLayeredWindowAttributes ( int hWnd ) - возвращает атрибуты многослойного окна.',
                  );				  
				  
$result[] = array(
                  'CAPTION'=>'GetShellWindow',
                  'PROP'=>'GetShellWindow()',
                  'INLINE'=>'GetShellWindow ( void ) - возвращает дескриптор оболочки Windows.',
                  );	

$result[] = array(
                  'CAPTION'=>'GetSysColor',
                  'PROP'=>'GetSysColor()',
                  'INLINE'=>'GetSysColor ( int nIndex ) - возвращает цвета элементов Windows.',
                  );

$result[] = array(
                  'CAPTION'=>'GetTopWindow',
                  'PROP'=>'GetTopWindow()',
                  'INLINE'=>'GetTopWindow ( int hWnd ) - возвращает дескриптор дочернего окна верхнего уровня, указанного окна.',
                  );

$result[] = array(
                  'CAPTION'=>'GetWindow',
                  'PROP'=>'GetWindow()',
                  'INLINE'=>'GetWindow ( int hWnd, int wCmd ) - возвращает дескриптор окна, которое имеет указанное отношение в указанном окне.',
                  );
				  
$result[] = array(
                  'CAPTION'=>'GetWindowLong',
                  'PROP'=>'GetWindowLong()',
                  'INLINE'=>'GetWindowLong ( int hWnd , int nIndex ) - возвращает определенную информацию об указанном окне.',
                  );

$result[] = array(
                  'CAPTION'=>'GetWindowRect',
                  'PROP'=>'GetWindowRect()',
                  'INLINE'=>'GetWindowRect ( int hWnd ) - возвращает размеры ограничивающего прямоугольника указанного окна.',
                  );
				  
$result[] = array(
                  'CAPTION'=>'GetClientRect',
                  'PROP'=>'GetClientRect()',
                  'INLINE'=>'GetClientRect ( int hWnd ) - возвращает координаты клиентской области окна.',
                  );				    
				  	   
$result[] = array(
                  'CAPTION'=>'SwitchToThisWindow',
                  'PROP'=>'SwitchToThisWindow()',
                  'INLINE'=>'SwitchToThisWindow ( int hWnd , int fAltTab ) - переключает фокус на указанное окно и переносит его на передний план.',
                  );				  
				  
$result[] = array(
                  'CAPTION'=>'IsChild',
                  'PROP'=>'IsChild()',
                  'INLINE'=>'IsChild ( int hWndParent, int hWnd ) - проверяет, является ли указанное окно hWnd дочерним окном для hWndParent.',
                  );
				  
$result[] = array(
                  'CAPTION'=>'IsGUIThread',
                  'PROP'=>'IsGUIThread()',
                  'INLINE'=>'IsGUIThread ( [int bConvert = false] ) - проверяет, является ли вызывающий поток потоком GUI.',
                  );					  
				  
$result[] = array(
                  'CAPTION'=>'IsHungAppWindow',
                  'PROP'=>'IsHungAppWindow()',
                  'INLINE'=>'IsHungAppWindow ( int hWnd ) - проверяет, считает ли система, что указанное окно не отвечает.',
                  );					  
				  				  
$result[] = array(
                  'CAPTION'=>'IsIconic',
                  'PROP'=>'IsIconic()',
                  'INLINE'=>'IsIconic ( int hWnd ) - проверяет, является ли указанное окно минимизированным.',
                  );								  
				  
$result[] = array(
                  'CAPTION'=>'IsWindow',
                  'PROP'=>'IsWindow()',
                  'INLINE'=>'IsWindow ( int hWnd ) - проверяет, существует ли окно с указанным дескриптор.',
                  );	
				  
$result[] = array(
                  'CAPTION'=>'IsWindowEnabled',
                  'PROP'=>'IsWindowEnabled()',
                  'INLINE'=>'IsWindowEnabled ( int hWnd ) - проверяет, является ли указанное окно доступным для ввода информации с мыши и клавиатуры.',
                  );		
				  
$result[] = array(
                  'CAPTION'=>'IsWindowUnicode',
                  'PROP'=>'IsWindowUnicode()',
                  'INLINE'=>'IsWindowUnicode ( int hWnd ) - проверяет, является ли указанное окно окном Unicode.',
                  );				  
				  
$result[] = array(
                  'CAPTION'=>'IsWindowVisible',
                  'PROP'=>'IsWindowVisible()',
                  'INLINE'=>'IsWindowVisible ( int hWnd ) - проверяет, является ли указанное окно видимым.',
                  );					  
				  
$result[] = array(
                  'CAPTION'=>'IsZoomed',
                  'PROP'=>'IsZoomed()',
                  'INLINE'=>'IsZoomed ( int hWnd ) - проверяет, максимизировано ли указанное окно.',
                  );					  
				  
$result[] = array(
                  'CAPTION'=>'LockSetForegroundWindow',
                  'PROP'=>'LockSetForegroundWindow()',
                  'INLINE'=>'LockSetForegroundWindow ( bool uLockCode ) - блокирует или разрешает вызов функции SetForegroundWindow( void ).',
                  );	
				  
$result[] = array(
                  'CAPTION'=>'MoveWindow',
                  'PROP'=>'MoveWindow()',
                  'INLINE'=>'MoveWindow ( int hWnd, int X, int Y, int W, int H [, bool bRepaint = true] ) - изменяет положение и размеры указанного окна.',
                  );
				  
$result[] = array(
                  'CAPTION'=>'OpenIcon',
                  'PROP'=>'OpenIcon()',
                  'INLINE'=>'OpenIcon ( int hWnd ) - восстанавливает минимизированное окно к его предыдущим размерам и положению, затем активизирует его.',
                  );				  
				  
$result[] = array(
                  'CAPTION'=>'SetActiveWindow',
                  'PROP'=>'SetActiveWindow()',
                  'INLINE'=>'SetActiveWindow ( int hWnd ) - активизирует указанное окно.',
                  );					  
				  
$result[] = array(
                  'CAPTION'=>'SetFocus',
                  'PROP'=>'SetFocus()',
                  'INLINE'=>'SetFocus ( int hWnd ) - устанавливает фокус клавиатуры в указанном окне.',
                  );					  
				  
$result[] = array(
                  'CAPTION'=>'SetForegroundWindow',
                  'PROP'=>'SetForegroundWindow()',
                  'INLINE'=>'SetForegroundWindow ( int hWnd ) - омещает поток, создавший указанное окно, на передний план и активизирует окно.',
                  );					  
				  
$result[] = array(
                  'CAPTION'=>'SetLayeredWindowAttributes',
                  'PROP'=>'SetLayeredWindowAttributes()',
                  'INLINE'=>'SetLayeredWindowAttributes ( int hWnd, int crKey, int bAlpha, int dwFlags ) - устанавливает атрибуты многослойного окна.',
                  );					  
				  
$result[] = array(
                  'CAPTION'=>'SetParent',
                  'PROP'=>'SetParent()',
                  'INLINE'=>'SetParent ( int hWndChild, int hWndNewParent ) - меняет родительское окно указанного дочернего окна.',
                  );	
				  
$result[] = array(
                  'CAPTION'=>'SetSysColors',
                  'PROP'=>'SetSysColors()',
                  'INLINE'=>'SetSysColors ( int cElements, array lpaElements, array lpaRgbValues ) - устанавливает цвета для одного или нескольких элементов управления.',
                  );				  
				  
$result[] = array(
                  'CAPTION'=>'SetWindowLong',
                  'PROP'=>'SetWindowLong()',
                  'INLINE'=>'SetWindowLong ( int hWnd, int dwNewLong [, int nIndex = GWL_EXSTYLE] ) - устанавливает определенный атрибут для указанного окна.',
                  );				  
				  
$result[] = array(
                  'CAPTION'=>'SetWindowText',
                  'PROP'=>'SetWindowText()',
                  'INLINE'=>'SetWindowText ( int hWnd, str lpString ) -["БАГНУТЫЙ"] изменяет заголовок указанного окна или текст оpгана упpавления.',
                  );				  
				  
$result[] = array(
                  'CAPTION'=>'ShowOwnedPopups',
                  'PROP'=>'ShowOwnedPopups()',
                  'INLINE'=>'ShowOwnedPopups ( int hWnd [, fShow = true] ) - отображает или скрывает все всплывающие окна, которыми владеет указанное окно.',
                  );
				  
$result[] = array(
                  'CAPTION'=>'ShowWindow',
                  'PROP'=>'ShowWindow()',
                  'INLINE'=>'ShowWindow ( int hWnd [, int nCmdShow = SW_SHOW] ) - отображает заданное окно в указанном режиме.',
                  );					  
				  
$result[] = array(
                  'CAPTION'=>'ShowWindowAsync',
                  'PROP'=>'ShowWindowAsync()',
                  'INLINE'=>'ShowWindowAsync ( int hWnd [, int nCmdShow = SW_SHOW] ) - отображает заданное окно в указанном режиме, созданное другим потоком.',
                  );					  
				  
$result[] = array(
                  'CAPTION'=>'WindowFromCursor',
                  'PROP'=>'WindowFromCursor()',
                  'INLINE'=>'WindowFromCursor ( void ) - определяет, какое из окон содержит координаты курсора.',
                  );					  
				  
$result[] = array(
                  'CAPTION'=>'WindowFromPoint',
                  'PROP'=>'WindowFromPoint()',
                  'INLINE'=>'WindowFromPoint ( int X, int Y ) - определяет, какое из окон содержит указанные координаты.',
                  );				  
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////				  
$result[] = array(
                  'CAPTION'=>'Write',
                  'PROP'=>'Write()',
                  'INLINE'=>'Write ( int hWnd, char Text ) - активизирует окно и пишет указанный текст.',
                  );















				  

				  

return $result;