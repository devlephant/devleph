<?

/*
 
	DevelStudio Error Hooker
    
    2019.02 ver 1.4
    Main Class:
		dsErrorDebug
		
    Main Handlers:
        userErrorHandler, userFatalHandler, userExceptionHandler
		
	Main functions:
		Error status:	msg,
		Errors:			hide, display, ErrStatus, getLastMsg, getLast, clearErr
		Exceptions:		getLastExcept, getLastExceptMsg, clearExcept
    
*/
class dsErrorDebug
{
	PUBLIC STATIC $ErrorTypes =
									[
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
									];
	PUBLIC STATIC $fShowError = 'dsErrorDebug::defShow';
	PRIVATE STATIC $__show;
	PRIVATE STATIC $__error;
	PRIVATE STATIC $__exception;
	
	public static final function init(){
		
		self::$__show = true;
		set_exception_handler(__CLASS__ . "::userExceptionHandler");
		set_error_handler(__CLASS__ . "::userErrorHandler");
		set_fatal_handler(__CLASS__ . "::userFatalHandler");
	}
	
	public static function defShow($str)
	{
		return messageDlg($str, mtError, 1);
	}
	
	public static final function userErrorHandler($errno = false, $errstr = '', $errfile='', $errline=0, $errcontext=false, $eventInfo=false)
	{
		$rret = false;
		if($errno == E_DEPRECATED) return;
		if( file_exists('lookout_log.txt') && defined('DS_DEBUG_MODE') )
			if( constant('DS_DEBUG_MODE') ){
				file_put_contents('lookout_log.txt', print_r( [$errno, $errstr, $errfile, $errline], true)."\r\n", FILE_APPEND);
				$rret = true;
			}
		
		if($errstr=='Exception thrown without a stack frame' or $errstr=='Creating default object from empty value') return;
		
		if ($errno == E_NOTICE || $errno == E_DEPRECATED) return;
		if ($errno == 2048) return;
				
		if ( $eventInfo ){    
			$GLOBALS['__eventInfo'] = $eventInfo;
		}
		
		if (defined('ERROR_NO_WARNING'))
		if ( (bool) constant('ERROR_NO_WARNING') ) {
			if ($errno == E_WARNING || $errno == E_CORE_WARNING || $errno == E_USER_WARNING) return;
		}
		
		if (defined('ERROR_NO_ERROR'))
		if ( (bool) constant('ERROR_NO_ERROR')){
			if ($errno == E_ERROR || $errno == E_CORE_ERROR || $errno == E_USER_ERROR) return;    
		}
		
		if ( $errno == E_USER_ERROR && !$eventInfo ){
			
			$info = debug_backtrace();
			next($info);
			$info = next($info);
			$errline = $info['line'];
		}
		 
		// for threading...
		if(isset(self::$__show)){
		if(isset($GLOBALS['THREAD_SELF']))
		if (self::$__show && $GLOBALS['THREAD_SELF']){
			
			if (sync(__FUNCTION__, [$errno, $errstr, $errfile, $errline, false, $GLOBALS['__eventInfo']]))
				return true;
		} }
		
		self::$__error = [
										 'msg'=>$errstr,
										 'file'=>$errfile,
										 'line'=>$errline,
										 'type'=>$errno,
										 ];
		
		if( $rret )  return;
		if(!isset(self::$__show)) {
			self::$__show = true;
			dsErrorDebug::init();
		}
		
			if (!self::$__show || v('is_showerror')) return;
		
		v('is_showerror', true);
		// 
		global $__eventInfo;
		$type = isset(self::$ErrorTypes[$errno])?t(self::$ErrorTypes[$errno]): t("Unknown Error");
		
		$__search = 'Uncaught exception';
		if( substr($errstr, 0, strlen($__search)) == $__search ){
			if( !method_exists(__CLASS__, 'userExceptionHandler') ) return;
			$__class = explode($__search, $errstr);
			$__class = substr($__class[ (count($__class) - 1) ], 2, strpos($__class[ (count($__class) - 1) ], "' with message")-2);
			$_errstr = explode("with message '", $errstr);
			$_errstr = explode( "' in ".$errfile.":".$errline, $_errstr[ (count($_errstr) - 1) ] );
			if( defined('DEBUG_OWNER_WINDOW') ) {
				$____e = new ErrorException($_errstr[0], $errno, 0, $errfile, $errline);
				self::$__exception = $____e;
			} else {
				
				self::userExceptionHandler(
					new ErrorException($_errstr[0], $errno, 0, $errfile, $errline),
					$__str,
					$__class,
					$errcontext
				);
				return;
			}
		}
		
		if (defined('DEBUG_OWNER_WINDOW')){
			$result = [];        
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
		set_error_handler(__CLASS__ . "::userErrorHandler");
		
		switch (call_user_func( self::$fShowError, ($str)))
		{	
			case mrCancel: return true; break;
			case mrOk:{ application_terminate(); die(); return false; }break;
		}
		return;
	}

	public static final function userFatalHandler($errno = false, $errstr = '', $errfile='', $errline=0)
	{
		
		self::userErrorHandler($errno, $errstr, $errfile, $errline);
	}

	public static final function userExceptionHandler($e, $_tc=false, $_class=false, $errcontext=false)
	{
		if(	!is_object($e) && !is_subclass_of($e, 'Exception') ) return;
		$type = [ t(($_class)? $_class: get_class($e)), MB_ICONINFORMATION ];
		$errname = $e->getCode();
		$msg = $e->getMessage();
		$errfile = $e->getFile();
		$line = $e->getLine();
		
		if (defined('ERROR_NO_WARNING') && (bool) constant('ERROR_NO_WARNING')){
			if ($errname == E_WARNING || $errname == E_CORE_WARNING || $errname == E_USER_WARNING) return;
		}
		
		if (defined('ERROR_NO_ERROR') && (bool) constant('ERROR_NO_ERROR')){
			if ($errname == E_ERROR || $errname == E_CORE_ERROR || $errname == E_USER_ERROR) return;    
		}
		if( !isset(self::$__show) ) {
			self::$__show = true;
			dsErrorDebug::init();
		}
		
		if (!self::$__show) return;
		
		if(isset($GLOBALS['THREAD_SELF'])) if (self::$__show && $GLOBALS['THREAD_SELF'])
			if (sync(__FUNCTION__, [$e, $_tc, $_class]))
				return;
		
		self::$__exception = $e;
		$arr[] = '[ ' . $type[0] . ' ]';
		$arr[] = t('Message').': "'  . $msg . '"';
		$arr[]= ' ';
			
			if (defined('EXE_NAME'))
				$errfile = str_replace(replaceSr(dirname(replaceSl(constant('EXE_NAME')))),'', $errfile );
			
			$arr[] = t('File').': ' . $errfile;
			$arr[] = t('On Line').': ' . $line;
		
		$arr[] = t('Code') . ': ' . _BR_ . ($_tc)? $_tc: (strlen( $e->getTraceAsString() ) <= 3 )? '[ Information about the code cannot be gathered ]' : $e->getTraceAsString();
		
		message_beep($type[1]);
		messageBox( implode(_BR_, $arr), appTitle() . ': Exception', $type[1]);
	}

	public static final function msg($t)
	{
	   self::userErrorHandler(E_USER_ERROR, $t, EXE_NAME);
	}

	public static final function checkFile($errfile)
	{
		$errfile = str_replace('//','/',replaceSl($errfile));
		
		if (!file_exists(DOC_ROOT . $errfile) && !file_exists($errfile)){
			self::msg("'{$errfile}' is not exists!");
			die();
		}
	}

	public static final function hide()
	{
		self::$__show = false;
		self::$__error  = false;
	}

	public static final function ErrStatus($value = null)
	{
		
		self::$__error  = self::$__exception =  false;
		if ($value===null) {
			return self::$__show;
		} else{
			$res = self::$__show;
			self::$__show = $value;
			return $res;
		}
	}

	public static final function display()
	{
		self::$__show = true;
		self::$__error  = self::$__exception = false;
	}

	public static final function getLastMsg()
	{
		return self::$__error['msg'];
	}

	public static final function getLast()
	{
		return isset(self::$__error)? self::$__error: false;
	}
	
	public static final function clearErr()
	{
		self::$__error = ['msg'=>false];
	}
	public static final function getLastExcept(){
		if( isset(self::$__exception) )
			return self::$__exception;
	}

	public static final function getLastExceptMsg(){
		if( isset(self::$__exception) )
			return self::$__exception->getMessage();
	}

	public static final function clearExcept()
	{
		if( isset(self::$__exception) )
			unset(self::$__exception);
	}
}

class dsErrorClassUndefined
{
	public final function __construct(...$args)
	{
		$class = get_class($this);
		trigger_error("Unable to create Class \"{$class}, because class Does Not Exist". 
		"\"\nInfo:\n\tParams:\n" . print_r($args) . "\n\tClass name:{$class}\nClass Does Not Exist!", E_USER_ERROR);
	}
	
	public final function __destruct()
	{
		$class = get_class($this);
		trigger_error("Cannot destruct instance of \"{$class}\", because class Does Not Exist". 
		"\"\nInfo:\n\tClass name:{$class}\nClass Does Not Exist!", E_USER_ERROR);
	}
	
	public final function __get($name)
	{
		$class = get_class($this);
		trigger_error(
		"Unable to get property \"{$name}\", because class \"{$class}\" Does Not Exist!" .
		"\nInfo:n\tProperty: {$class}::{$name}\n\tClass name:{$class}", E_USER_ERROR);
		return NULL;
	}
	
	public final function __isset($name)
	{
		$class = get_class($this);
		trigger_error(
		"Property does not exist because of non-existant class \"{$class}\"".
		"\nInfo:n\tProperty: {$class}::{$name}\n\tClass name:{$class}", E_USER_ERROR);
		return FALSE;
	}
	
	public final function __unset($name)
	{
		$class = get_class($this);
		trigger_error(
		"Cannot unset property \"{$name}\", because class \"{$class}\" Does Not Exist!".
		"\nInfo:n\tProperty: {$class}::{$name}\n\tClass name:{$class}", E_USER_ERROR);
	}
	
	public final function __set($name, $value)
	{
		$class = get_class($this);
		trigger_error(
		"Unable to set property \"{$name}\", because class \"{$class}\" Does Not Exist!" .
		"\nInfo:\n\tProperty:{$class}::{$name}\n\tValue:\n".print_r($value,true)."\nClass name:{$class}", E_USER_ERROR);
		return FALSE;
	}
	
	public final function __invoke(...$args)
	{
		$class = get_class($this);
		trigger_error("Cannot invoke Class \"{$class}, because class Does Not Exist". 
		"\"\nInfo:\n\tParams:\n" . print_r($args) . "\n\tClass name:{$class}\nClass Does Not Exist!", E_USER_ERROR);
		return NULL;
	}
	
	public final function __call($name, $args)
	{
		$class = get_class($this);
		trigger_error("Unable to call dynamic method \"{$name}\", because class \"{$class}\" Does Not Exist!" .
		"\nInfo:\n\tMethod name: {$class}::{$name}\n\tParams:\n" . print_r($args,true) . "\n\tClass name:{$class}", E_USER_ERROR);
		return NULL;
	}
	
	public static final function  __callStatic($name, $args)
	{
		$class = get_class($this);
		trigger_error("Unable to call static method \"{$name}\", because class \"{$class}\" Does Not Exist!" .
		"\nInfo:\n\tMethod name: {$class}::{$name}\n\tParams:\n" . print_r($args,true) . "\n\tClass name:{$class}", E_USER_ERROR);
		return NULL;
	}
	
	public static final function __set_state($a)
	{
		$class = get_class($this);
		trigger_error("Cannot import instace of \"{$class}\", because class Does Not Exist". 
		"\"\nInfo:\n\tClass name:{$class}\n\tInput:\n".print_r($a,true)."\nClass Does Not Exist!", E_USER_ERROR); 
	}
	
	public final function __toString()
	{
		$class = get_class($this);
		trigger_error("Cannot convert instance of \"{$class}\" to string, because class Does Not Exist". 
		"\"\nInfo:\n\tClass name:{$class}\nClass Does Not Exist!", E_USER_ERROR);
		return "Class \"{$class}\" Does Not Exist!";
	}
	
	public final function __debuginfo()
	{
		return ["Error"=>"Class \"{$class}\" Does Not Exist!"];
	}
	
	public final function __sleep()
	{
		$class = get_class($this);
		trigger_error("Cannot serialize instance of \"{$class}\", because class Does Not Exist". 
		"\"\nInfo:\n\tClass name:{$class}\nClass Does Not Exist!", E_USER_ERROR);
		return [];
	}
	
	public final function __wakeup()
	{
		$class = get_class($this);
		trigger_error("Cannot unserialize instance of \"{$class}\", because class Does Not Exist". 
		"\"\nInfo:\n\tClass name:{$class}\nClass Does Not Exist!", E_USER_ERROR);
	}
}
dsErrorDebug::init();

dsErrorDebug::hide();
    date_default_timezone_set(date_default_timezone_get());
    ini_set('date.timezone', date_default_timezone_get());
dsErrorDebug::display();

?>