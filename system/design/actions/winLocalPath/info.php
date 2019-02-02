<?


$n = array();

    
    $n['PREG'] = '%\$(.*)=([ ]*)winLocalPath\((.*)\)%i';
    $n['COMMAND'] = 'winLocalPath';
    $n['TEXT'] = 'Get Window local path';
    $n['INLINE'] = 'Get window local path from %pr2% and write to %pr1%';
    $n['SECTION'] = 'systems';
    $n['SORT'] = 285;
    
    
return $n;
