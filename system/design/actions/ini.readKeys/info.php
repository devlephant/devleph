<?

/*
    Dev-S Actions

    Dim-S Software (c) 2009
                                     Has created Haker
*/

$n = [];

    
    $n['PREG'] = '%ini::readKeys\((.*)\)%i';
    $n['COMMAND'] = 'ini::readKeys';
    $n['TEXT'] = 'Read ini file keys';
    $n['DESCRIPTION'] = 'Read keys from ini file';
    $n['INLINE'] = 'Read keys from %pr1% section and write result in %pr2% variable';
    $n['SECTION'] = 'ini';
    $n['SORT'] = 2070;
    
    
return $n;
