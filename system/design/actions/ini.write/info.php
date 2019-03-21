<?

/*
    DevelStudio actions

    Dim-S Software (c) 2009
                                     Has created Haker
*/

$n = [];

    
    $n['PREG'] = '%ini::write\((.*)\)%i';
    $n['COMMAND'] = 'ini::write';
    $n['TEXT'] = 'Write value to ini';
    $n['DESCRIPTION'] = 'To write key value in ini file';
    $n['INLINE'] = 'To write %pr3% value to %pr2% key from %pr1% section';
    $n['SECTION'] = 'ini';
    $n['SORT'] = 2020;
    
    
return $n;
