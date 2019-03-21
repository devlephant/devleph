<?

$result = [];

$result[] = array(
                  'CAPTION'=>'IP',
                  'TYPE'=>'text',
                  'PROP'=>'IP',
                  );

$result[] = array(
                  'CAPTION'=>'Port',
                  'TYPE'=>'number',
                  'PROP'=>'Port',
                  );
				  
$result[] = array(
                  'CAPTION'=>'ID',
                  'TYPE'=>'text',
                  'PROP'=>'ID'
                  );	
				  
$result[] = array(
                  'CAPTION'=>'IsConnected',
                  'TYPE'=>'check',
                  'PROP'=>'IsConnected',
				  'VALUE'=>false
                  );
				  
return $result;

?>