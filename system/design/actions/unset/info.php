<?

/*
    SoulEngine actions

    Dim-S Software (c) 2009
                                     Has created Haker
*/

$n = array();

    
    $n['PREG'] = '%unset([ ]*)\((.*)\)?%i';
    $n['COMMAND'] = 'unset';
    $n['TEXT'] = 'Unset var';
    $n['DESCRIPTION'] = 'Unset var';
    $n['INLINE'] = 'Unset var with name = %pr1%';
    $n['SECTION'] = 'script';
    $n['SORT'] = 199.75;
    
    
return $n;
