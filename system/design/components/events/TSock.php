<?

$result = array();

$result[] = array(
                  'CAPTION'=>'Получение информации',
                  'EVENT'=>'OnData',
                  'INFO'=>'%func%($self, $connectionId, $Data, $Type)',
                  'ICON'=>'TSock_Data',
                  );

$result[] = array(
                  'CAPTION'=>'Подключение клиента',
                  'EVENT'=>'OnConnect',
                  'INFO'=>'%func%($self, $connectionId)',
                  'ICON'=>'TSock_Connect',
                  );

$result[] = array(
                  'CAPTION'=>'Отключение клиента',
                  'EVENT'=>'OnDisconnect',
                  'INFO'=>'%func%($self, $connectionId)',
                  'ICON'=>'TSock_Disconnect',
                  );



return $result;

?>