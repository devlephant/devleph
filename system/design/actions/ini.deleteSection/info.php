<?

/*
    SoulEngine actions

    Dim-S Software (c) 2009
                                     Has created Haker
*/

$n = array();

    
    $n['PREG'] = '%ini::deleteSection\((.*)\)?%i';
    $n['COMMAND'] = 'ini::deleteSection';
    $n['TEXT'] = 'Delete ini file section';
    $n['DESCRIPTION'] = 'To delete section from ini file';
    $n['INLINE'] = 'To delete %pr1% from ini file';
    $n['SECTION'] = 'ini';
    $n['SORT'] = 2030;
    
    
return $n;
