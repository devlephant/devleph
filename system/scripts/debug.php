<?


function childSendMessage($handle, $arr){
    
    myDebug::onExcept($handle, $arr);
}

Receiver::add('childSendMessage');