<?

/*
    SoulEngine actions

    Dim-S Software (c) 2009
                                     Has created Haker
*/

$n = array();

    
    $n['PREG'] = '%\$([a-z]{1})([a-z0-9\_]*)([ ]+)=(.*)%i';
    $n['COMMAND'] = '';
    $n['TEXT'] = 'Set value of variable';
    $n['INLINE'] = 'Variable %pr1% = %pr2%';
    $n['SECTION'] = 'script';
    $n['SORT'] = 199.80;
    
    
return $n;
