<?

/*
    DevelStudio actions

    Dim-S Software (c) 2009
                                     Has created Haker
*/

$n = array();

    
    $n['PREG'] = '%ini::readSections\((.*)\)%i';
    $n['COMMAND'] = 'ini::readSections';
    $n['TEXT'] = 'Read ini file sections';
    $n['DESCRIPTION'] = 'Read sections from ini file';
    $n['INLINE'] = 'Read sections and write to %pr1% variable';
    $n['SECTION'] = 'ini';
    $n['SORT'] = 2060;
    
    
return $n;
