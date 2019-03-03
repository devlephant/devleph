<?

/*
    DevelStudio actions

    Dim-S Software (c) 2009
                                     Has created Haker
*/

$n = array();

    
    $n['PREG'] = '%if([ ]*)\((.*)\)[\{]?%i';
    $n['COMMAND'] = 'if ';
    $n['TEXT'] = 'If then ...';
    $n['DESCRIPTION'] = 'If then begin...';
    $n['INLINE'] = 'If ( %pr1% ) then ...';
    $n['SECTION'] = 'script';
    $n['NO_TSZ'] = true;
    $n['SORT'] = 199.30;
    
    
return $n;
