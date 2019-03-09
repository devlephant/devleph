<?

class DebugClassException extends Exception {}


class DebugClass {
	
	public $self = 0;
	public $nameParam = '';
	
	public function __construct($name){
		if ( is_numeric($name) )
			$this->nameParam = syncEx('gui_propGet', [$name, 'name']);
		else
			$this->nameParam = $name;
	}
	
	public function __set($name, $value){
		trigger_error(t('Component "%s" not found for set "%s" property', $this->nameParam, $name), E_USER_ERROR);
	}
	
	public function __get($name){
		
		trigger_error(t('Component "%s" not found for get "%s" property', $this->nameParam, $name), E_USER_ERROR);
	}
	
	public function __call($name, $args){
		
		trigger_error(t('Component "%s" not found for call "%s" method', $this->nameParam, $name), E_USER_ERROR);
	}
	
	public function valid(){
		return false;
	}
}

class ThreadDebugClass extends DebugClass {
	
	public function __set($name, $value){
		throw new DebugClassException(t('Change the GUI in the thread forbidden - SET "%s"->"%s" = "%s".'."\r\n".'.:: Please, use \'c()\' function ::.', $this->nameParam, $name, $value), E_USER_ERROR);
	}
	
	public function __get($name){
		throw new DebugClassException(t('Access GUI in the thread forbidden - GET "%s"->"%s"'."\r\n".'.:: Please, use \'c()\' function ::.', $this->nameParam, $name), E_USER_ERROR);
	}
	
	public function __call($name, $args){
		throw new DebugClassException(t('Access the GUI in the thread forbidden - CALL "%s"->"%s()"'."\r\n".'.:: Please, use \'c()\' function ::.', $this->nameParam, $name), E_USER_ERROR);
	}
	
	public function __toString(){
		throw new DebugClassException(t('Access the GUI in the thread forbidden -  CONVERT (string) "%s"'."\r\n".'.:: Please, use \'c()\' function ::.', $this->nameParam), E_USER_ERROR);
	}
	public function valid(){
		return false;
	}
}

class ThreadObjectReceiver
{
	private static $block = [];
	private $name;
	public function __construct($name)
	{
		$this->name = $name;
	}


	public static function c($name, $block = false)
	{
		if ($key = $GLOBALS['THREAD_SELF']) {
			if ($block) {
				$block = ($block < 10 ? 10 : $block) * 1000;
				while(SyncEx('ThreadObjectReceiver::block', [$name, $key]) !== 'true') {
				//while(self::block($name, $key) !== 'true') {
					usleep($block);
				}
			}
			if( isset($GLOBALS['___t_self'][$name]) ) {
				if (empty($GLOBALS['___t_self'][$name]) ) {
					$GLOBALS['___t_self'][$name] = new ThreadObjectReceiver($name);
				}
			} else {
					$GLOBALS['___t_self'][$name] = new ThreadObjectReceiver($name);
			}
			return $GLOBALS['___t_self'][$name];
		} else {
			if (!isset($GLOBALS['___t_objects'][$name])) {
				$GLOBALS['___t_objects'][$name] = __call_component($name);
			}
			return $GLOBALS['___t_objects'][$name];
		}
	}


	public static function unBlock($name)
	{
#		if($GLOBALS['THREAD_SELF']) {
#			Sync('ThreadObjectReceiver::unBlock', array($name));
#		} else {
			self::$block[$name] = null;
#		}
	}


	public static function block($name, $id)
	{
		if (!empty(self::$block[$name]) && self::$block[$name] !== $id) {
			return 'false';
		}
		self::$block[$name] = $id;
		return 'true';
	}


	public function __get($name)
	{
		return SyncEx('ThreadObjectReceiver::get', [$this->name, $name]);
	}


	public static function get($name, $property)
	{
		if (!isset($GLOBALS['___t_objects'][$name])) {
			$GLOBALS['___t_objects'][$name] = __call_component($name);
		}
		$GLOBALS['APPLICATION']->ProcessMessages();
		return $GLOBALS['___t_objects'][$name]->$property;
	}


	public function __set($name, $value)
	{
		Sync('ThreadObjectReceiver::set', [$this->name, $name, $value]);
	}


	public static function set($name, $property, $value)
	{
		if (!isset($GLOBALS['___t_objects'][$name])) {
			$GLOBALS['___t_objects'][$name] = __call_component($name);
		}
		if( is_object($value) ) {
			$GLOBALS['___t_objects'][$name]->$property = ($value instanceof ThreadObjectReceiver)? $value->__get_self(): $value;
		} else {
			$GLOBALS['___t_objects'][$name]->$property = $value;
		}
		$GLOBALS['APPLICATION']->ProcessMessages();
	}


	public function __call($name, $args)
	{
		return SyncEx('ThreadObjectReceiver::call', [$this->name, $name, $args]);
	}


	public static function call($name, $method, $args)
	{
		if (!isset($GLOBALS['___t_objects'][$name])) {
			$GLOBALS['___t_objects'][$name] = __call_component($name);
		}
		$res = call_user_func_array([$GLOBALS['___t_objects'][$name], $method], $args);
		$GLOBALS['APPLICATION']->ProcessMessages();
		return $res;
	}
	
	public function __toString(){
		return SyncEx('ThreadObjectReceiver::toString', [$this->name]);
	}
	
	public static function toString($name){
		if (!isset($GLOBALS['___t_objects'][$name])) {
			$GLOBALS['___t_objects'][$name] = __call_component($name);
		}
		
		return method_exists($GLOBALS['___t_objects'][$name], '__toString()')? call_user_func_array([$GLOBALS['___t_objects'][$name], $method], []) :print_r($GLOBALS['___t_objects'][$name], true);
	}
	
	public function __get_self(){
		return __call_component($this->name);
	}
	
	public function valid(){
		return true;
	}
}

?>