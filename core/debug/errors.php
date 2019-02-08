<?

/*
 
    PHP Soul Engine Error Hooker
    
    2018.02 ver 0.3
    
    Main function:
        __error_hook(type, filename, line, msg)
       
    
*/
$GLOBALS['__error_types'] = array (
                0                 => "Fatal Error",
                E_ERROR           => "Error",
                E_WARNING         => "Warning",
                E_PARSE           => "Parsing Error",
                E_NOTICE          => "Notice",
                E_CORE_ERROR      => "Core Error",
                E_CORE_WARNING    => "Core Warning",
                E_COMPILE_ERROR   => "Compile Error",
                E_COMPILE_WARNING => "Compile Warning",
                E_USER_ERROR      => "User Error",
                E_USER_WARNING    => "User Warning",
                E_USER_NOTICE     => "User Notice",
                E_STRICT          => "Runtime Notice",
    );

function errors_init(){
    
    $GLOBALS['__show_errors'] = true;
	set_exception_handler("userExceptionHandler");
    $old_error_handler = set_error_handler("userErrorHandler");
    set_fatal_handler("userFatalHandler");
}

function userErrorHandler($errno = false, $errstr = '', $errfile='', $errline=0, $errcontext=false, $eventInfo=false)
{
	$rret = false;
	if($errno == E_DEPRECATED) return;
	if( file_exists('lookout_log.txt') && defined('DS_DEBUG_MODE') )
		if( constant('DS_DEBUG_MODE') ){
			file_put_contents('lookout_log.txt', print_r( array($errno, $errstr, $errfile, $errline), true)."\r\n", FILE_APPEND);
			$rret = true;
		}
	
	if($errstr=='Exception thrown without a stack frame' or $errstr=='Creating default object from empty value') return;
	
    if ($errno == E_NOTICE || $errno == E_DEPRECATED) return;
    if ($errno == 2048) return;
            
	if ( $eventInfo ){    
        $GLOBALS['__eventInfo'] = $eventInfo;
    }
	
	if (defined('ERROR_NO_WARNING'))
    if ( (bool) constant('ERROR_NO_WARNING')/* === true*/ ) {
        if ($errno == E_WARNING || $errno == E_CORE_WARNING || $errno == E_USER_WARNING) return;
    }
	
    if (defined('ERROR_NO_ERROR'))
    if ( (bool) constant('ERROR_NO_ERROR')/* === true*/ ){
        if ($errno == E_ERROR || $errno == E_CORE_ERROR || $errno == E_USER_ERROR) return;    
    }
    
    if ( $errno == E_USER_ERROR && !$eventInfo ){
        
        $info = debug_backtrace();
        next($info);
        $info = next($info);
        $errline = $info['line'];
    }
     
    // for threading...
	if(isset($GLOBALS['__show_errors'])){
	if(isset($GLOBALS['THREAD_SELF']))
    if ($GLOBALS['__show_errors'] && $GLOBALS['THREAD_SELF']){
        
        if (sync('userErrorHandler', array($errno, $errstr, $errfile, $errline, false, $GLOBALS['__eventInfo'])))
            return true;
    } }
	
    //pre($errstr);

    $GLOBALS['__error_last'] = array(
                                     'msg'=>$errstr,
                                     'file'=>$errfile,
                                     'line'=>$errline,
                                     'type'=>$errno,
                                     );
    
    if( $rret )  return;
	if(!isset($GLOBALS['__show_errors'])) {
		$GLOBALS['__show_errors'] = true;
		errors_init();
	}
	
		if (!$GLOBALS['__show_errors'] || v('is_showerror')) return;
    
    v('is_showerror', true);
    // 
    global $__eventInfo;
    if(!isset($GLOBALS['__error_types']))
		$GLOBALS['__error_types'] = array (
                0                 => "Fatal Error",
                E_ERROR           => "Error",
                E_WARNING         => "Warning",
                E_PARSE           => "Parsing Error",
                E_NOTICE          => "Notice",
                E_CORE_ERROR      => "Core Error",
                E_CORE_WARNING    => "Core Warning",
                E_COMPILE_ERROR   => "Compile Error",
                E_COMPILE_WARNING => "Compile Warning",
                E_USER_ERROR      => "User Error",
                E_USER_WARNING    => "User Warning",
                E_USER_NOTICE     => "User Notice",
                E_STRICT          => "Runtime Notice",
    );
    $type = isset($GLOBALS['__error_types'][$errno])?t($GLOBALS['__error_types'][$errno]): t("Unknown Error");
    
	$__search = 'Uncaught exception';
	if( substr($errstr, 0, strlen($__search)) == $__search ){
		if( !function_exists('userExceptionHandler') ) return;
		$__class = explode($__search, $errstr);
		$__class = substr($__class[ (count($__class) - 1) ], 2, strpos($__class[ (count($__class) - 1) ], "' with message")-2);
		$_errstr = explode("with message '", $errstr);
		$_errstr = explode( "' in ".$errfile.":".$errline, $_errstr[ (count($_errstr) - 1) ] );
		if( defined('DEBUG_OWNER_WINDOW') ) {
			$____e = new ErrorException($_errstr[0], $errno, 0, $errfile, $errline);
			$GLOBALS['__exception_last'] = $____e;
		} else {
			call_user_func_array(
				'userExceptionHandler',
				array(
					new ErrorException($_errstr[0], $errno, 0, $errfile, $errline),
					$__str,
					$__class,
					$errcontext
				)
			);
			return;
		}
	}
	
    if (defined('DEBUG_OWNER_WINDOW')){
        $result = array();        
        $result['type'] = 'error';
        $result['script'] = $errfile;
        $result['event']  = $__eventInfo['name'];
        $result['name'] =  __exEvents::getEventInfo($__eventInfo['self']);
        $result['msg']  = $errstr;
        $result['errno']= $errno;
        $result['errtype'] = $type;
        $result['line'] = $errline;
        
        if ( is_array($errcontext) )
            $result['vars'] = array_keys($errcontext);
        
        application_minimize();
        
        Receiver::send(DEBUG_OWNER_WINDOW, $result);
        
        application_restore();
        $GLOBALS['APPLICATION']->toFront();
        return;
    }
	
    $arr[]= '[ '.$type.' ]';
    $arr[]= t('Message').': "' . $errstr . '"';
    
    if (!file_exists($errfile)) $errfile =  EXE_NAME;
        $arr[]= ' ';
        
        if (defined('EXE_NAME'))
            $errfile = str_replace(replaceSr(dirname(replaceSl(EXE_NAME))),'',$errfile);
        
        $arr[] = t('File').': ' . $errfile;
        $arr[] = t('On Line').': ' . $errline;
    
    
    if ($__eventInfo){
        
        $arr[] = ' ';
        $arr[] = '[ '.t('EVENT').' ]';
        if ($__eventInfo['name'])
            $arr[] = t('Type').': '.$__eventInfo['name'];
            
        if ($__eventInfo['obj_name'])
            $arr[] = t('Object').': "' .$__eventInfo['obj_name'].'"';
    }
    
    $arr[] = ' ';
    $arr[] = '.:: '.t('To abort application?').' ::.';
    
    $str = implode(_BR_, $arr);
    
    message_beep(MB_ICONERROR);
    $old_error_handler = set_error_handler("userErrorHandler");
    
    switch (messageDlg($str, mtError, 1)){
        
        case mrCancel: return true; break;
        case mrOk:{ application_terminate(); return false; }break;
    }
    return;
}

function userFatalHandler($errno = false, $errstr = '', $errfile='', $errline=0){
    
    userErrorHandler($errno, $errstr, $errfile, $errline);
}

function userExceptionHandler($e, $_tc=false, $_class=false, $errcontext=false){
	if(	!is_object($e) && !is_subclass_of($e, 'Exception') ) return;
	$class = ($_class)? $_class: get_class($e);
	$type = array( t($class), MB_ICONINFORMATION);
	$errname = $e->getCode();
	$msg = $e->getMessage();
	$errfile = $e->getFile();
	$line = $e->getLine();

	$tc = ($_tc)? $_tc: (strlen( $e->getTraceAsString() ) <= 3 )? '[ Information about the code cannot be gathered ]' : $e->getTraceAsString();
	
	if (defined('ERROR_NO_WARNING') && (bool) constant('ERROR_NO_WARNING')){
        if ($errname == E_WARNING || $errname == E_CORE_WARNING || $errname == E_USER_WARNING) return;
    }
    
    if (defined('ERROR_NO_ERROR') && (bool) constant('ERROR_NO_ERROR')){
        if ($errname == E_ERROR || $errname == E_CORE_ERROR || $errname == E_USER_ERROR) return;    
    }
	if( !isset($GLOBALS['__show_errors']) ) {
		$GLOBALS['__show_errors'] = true;
		errors_init();
	}
	
	if (!$GLOBALS['__show_errors']) return;
	
	if(isset($GLOBALS['THREAD_SELF'])) if ($GLOBALS['__show_errors'] && $GLOBALS['THREAD_SELF'])
        if (sync(__FUNCTION__, array($e, $_tc, $_class)))
            return;
	
	$GLOBALS['__exception_last'] = $e;
	$arr[] = '[ ' . $type[0] . ' ]';
    $arr[] = t('Message').': "'  . $msg . '"';
    $arr[]= ' ';
        
        if (defined('EXE_NAME'))
            $errfile = str_replace(replaceSr(dirname(replaceSl(constant('EXE_NAME')))),'', $errfile );
        
        $arr[] = t('File').': ' . $errfile;
        $arr[] = t('On Line').': ' . $line;
    
	$arr[] = t('Code').': '._BR_.$tc;
	
	message_beep($type[1]);
	messageBox( implode(_BR_, $arr), appTitle() . ': Exception', $type[1]);
}

function error_message($msg){
   userErrorHandler(E_USER_ERROR, $msg, EXE_NAME);
}

function error_msg($msg){
	userErrorHandler(E_USER_ERROR, $msg, EXE_NAME); 
}

function __error_hook($type, $errfile, $line, $msg){
	userErrorHandler($type, $msg, $errfile, $line); 
}

function checkFile($errfile){
    $errfile = str_replace('//','/',replaceSl($errfile));
    
    if (!file_exists(DOC_ROOT . $errfile) && !file_exists($errfile)){
        error_message("'$errfile' is not exists!");
        die();
    }
}

function err_no(){
    $GLOBALS['__show_errors'] = false;
    $GLOBALS['__error_last']  = false;
}

function err_status($value = null){
    
    $GLOBALS['__error_last']  = $GLOBALS['__exception_last'] =  false;
    if ($value===null) {
        return $GLOBALS['__show_errors'];
    } else{
        $res = $GLOBALS['__show_errors'];
        $GLOBALS['__show_errors'] = $value;
        return $res;
    }
}

function err_yes(){
    $GLOBALS['__show_errors'] = true;
    $GLOBALS['__error_last']  = $GLOBALS['__exception_last'] = false;
}

function err_msg(){
    return $GLOBALS['__error_last']['msg'];
}

function err_last(){
    return $GLOBALS['__error_last'];
}

function except_last(){
	if( isset($GLOBALS['__exception_last']) )
		return $GLOBALS['__exception_last'];
}

function except_msg(){
	if( isset($GLOBALS['__exception_last']) )
		return $GLOBALS['__exception_last']->getMessage();
}

errors_init();

/* fix errors */
err_no();
    date_default_timezone_set(date_default_timezone_get());
    ini_set('date.timezone', date_default_timezone_get());
err_yes();
?>