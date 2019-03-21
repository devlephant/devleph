<?

/*
    DevelStudio actions

    Dim-S Software (c) 2009
                                     Has created Haker
*/

$n = [];

    
    $n['PREG'] = '%ini::read\((.*)\)[\;]?%i';
    $n['COMMAND'] = 'ini::read';
    $n['TEXT'] = 'Read value from ini';
    $n['DESCRIPTION'] = 'To read value of a key from ini file';
    $n['INLINE'] = 'To read value of key and write result in %pr1% variable';
    $n['SECTION'] = 'ini';
    $n['SORT'] = 2010;
    
    
return $n;
