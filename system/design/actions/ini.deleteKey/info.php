<?

/*
    Development Studio Actions

    Dim-S Software (c) 2009
                                     Has created Haker
*/

$n = [];

    
    $n['PREG'] = '%ini::deleteKey\((.*)\)%i';
    $n['COMMAND'] = 'ini::deleteKey';
    $n['TEXT'] = 'Delete ini key';
    $n['DESCRIPTION'] = 'Delete key from ini';
    $n['INLINE'] = 'Delete %pr2% key of %pr1% section';
    $n['SECTION'] = 'ini';
    $n['SORT'] = 2040;
    
    
return $n;
