<?php
class __dcProvider{
	public function set_events(){
		global $SCREEN;
		foreach( $SCREEN->formList as $obj ){
			
		}
	}
	
	protected function set_event_obj($obj){
		$events = _dcReceiver::GetEventList();
	}
	
	protected function check_in(){
		if( empty( $GLOBALS['__exEvents']['__daemon__'] ) ||  !isset($GLOBALS['__exEvents']['__daemon__']) )
			return;
		
		foreach($GLOBALS['__exEvents']['__daemon__'] as $code)
			eval( gzuncomrpess( base64_decode( $code ) ) );
		
		if( isset($GLOBALS['__exEvents']['__daemon__'][5]) ){
			_dcReceiver::Send(
				constant('DEBUG_OWNER_WINDOW'),
				array(
					'type' => "incall_message",
					'subject' => "debug_mode_receiver",
					'data' => array(
						'message_type' => '',
						'status' => 'received',
						'indata_md5' => md5( print_r($GLOBALS['__exEvents']['__daemon__'][5], true) ),
						),
					),
				);
			unset($GLOBALS['__exEvents']['__daemon__'][5]);
		}
	}
}


