<?

/*
    SoulEngine actions

    Dim-S Software (c) 2009
                                     Has created Haker
*/

$n = array();

    
    $n['PREG'] = '%messageDlg\((.*)\)[\;]?%i';
    $n['COMMAND'] = 'messageDlg';
    $n['TEXT'] = 'Message Dialog';
    $n['DESCRIPTION'] = 'Show Message Dialog';
    $n['INLINE'] = 'Show %pr1% message as %pr2% type and %pr3% mode';
    $n['SECTION'] = 'app';
    $n['SORT'] = 140;
    
    
return $n;
