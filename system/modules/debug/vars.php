<?

DSApi::reg_startFunc('__startDebugGlobalVars();');

function __startDebugGlobalVars(){
    
    Timer::setInterval('__doDebugGlobalVars', 500);
    Receiver::send(DEBUG_OWNER_WINDOW, array('RECEIVER_HANDLE'=>receiver_handle()));
}

function __doDebugGlobalVars(){
    
    global $__DEBUG_GLVARS, $APPLICATION;
    
    $result['type'] = 'glVars';
    $result['glVars'] = array();
    
    foreach ((array)$__DEBUG_GLVARS as $name){
        
        $text = print_r($GLOBALS[$name], true);
        $result['glVars'][$name] = $text;
    }
    
    if (DEBUG_OWNER_WINDOW){
        Receiver::send(DEBUG_OWNER_WINDOW, $result);
    }
}



function __uploadGlVars($handle, $arr){
    
    
    if ($arr['type']=='glVars'){
        global $__DEBUG_GLVARS;
        
        $k = array_search($arr['name'],(array)$__DEBUG_GLVARS);
    
        switch($arr['action']){
            
            case 'del':  unset($__DEBUG_GLVARS[$k]); break;
            case 'edit': unset($__DEBUG_GLVARS[$k]);
                         $__DEBUG_GLVARS[] = $arr['new_name'];
                         break;
            case 'add': $__DEBUG_GLVARS[] = $arr['name']; break;
        }
    }
}

Receiver::add('__uploadGlVars');