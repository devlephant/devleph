<?

##############################
#######CLICESS BY QWERT#######
##############################

Class QClicess {

    Public Function Mouse_C($button, $method, $invisible, $x, $y){
    $mthdOPR = array(
        'MOUSEEVENTF_LEFTDOWN' => 2,
        'MOUSEEVENTF_LEFTUP' => 4,
        'MOUSEEVENTF_RIGHTDOWN' => 8,
        'MOUSEEVENTF_RIGHTUP' => 16,
        'MOUSEEVENTF_MIDDLEDOWN' => 32,
        'MOUSEEVENTF_MIDDLEUP' => 64,
    );
        if($invisible=='true'){
        $xcurs = cursor_pos_x();
        $ycurs = cursor_pos_y();
        }
        SetCursorPos($x, $y);
            if($method!='CLICK'){
            $mthd = MOUSEEVENTF_.$button.$method;
            Mouse_Event($mthdOPR[$mthd], $x, $y, 0, 0);
            }
            else{
            $mthd = 'MOUSEEVENTF_'.$button.'DOWN';
            Mouse_Event($mthdOPR[$mthd], $x, $y, 0, 0);
            Mouse_Event($mthdOPR[$mthd]*2, $x, $y, 0, 0);
            }
            if($invisible=='true'){
            SetCursorPos($xcurs, $ycurs);
            }
	}

    Public Function Mouse_M($x, $y){
    SetCursorPos($x,$y);
    }
	
	Public Function Get($coordinates){
	$coordinates = 'cursor_pos_'.$coordinates;
    return $coordinates();
	}
	
    Public Function Press($key){
    $WshShell = new COM('WScript.Shell');  
    $WshShell->SendKeys($key);
    }
}

?>