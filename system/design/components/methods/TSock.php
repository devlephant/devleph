<?

$result = array();

$result[] = array(
                  'CAPTION'=>'Connect',
                  'PROP'=>'Connect()',
                  'INLINE'=>'void Connect( string IP, int PORT )',
                  );

$result[] = array(
                  'CAPTION'=>'Send',
                  'PROP'=>'Send()',
                  'INLINE'=>'void Send( int ID, mixed Data )',
                  );
				  
$result[] = array(
                  'CAPTION'=>'Broadcast',
                  'PROP'=>'Broadcast()',
                  'INLINE'=>'void Broadcast( mixed Data )',
                  );
				  
return $result;

?>