<?

class bapi {
	
	function get_active($obj, $event, $args, $code){
		$obj = toObject($obj);
		$bevent= 'b'.substr($event,2);
		$obj->{$bevent} = event_get($obj->self, $event);
		$code = $code . _BR_ . '$obj = _c('.$obj->self.');
		if ( $obj->'.$bevent.' ){
            call_user_func($obj->'.$bevent.', '.$args.');
        }'
		$func = create_function($args, $code);
        event_set($obj->self, $event, $func);
	}
	
	function reg_b($class){
		//TODO: Тут будет обработка класса поведения, и использования его функций как вторичных событий для объекта. 
	}

}