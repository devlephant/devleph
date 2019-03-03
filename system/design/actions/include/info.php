<?

/*
    DevelStudio actions

    Dim-S Software (c) 2009
                                     Has created Haker
*/

$n = array();
    

    $n['PREG'] = '%include([ ]+)(.*)%i';
    $n['COMMAND'] = 'include';
    $n['TEXT'] = 'Inclusions of files in a code of script PHP';
    $n['DESCRIPTION'] = 'Inclusions of files in a code of script PHP';
    $n['INLINE'] = 'Include %pr1% php script';
    $n['SECTION'] = 'script';
    $n['NO_BRACKETS'] = true;
    $n['SORT'] = 199.10;
    

return $n;
