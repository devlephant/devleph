<?

/*
    SoulEngine actions

    Dim-S Software (c) 2009
                                     Has created Haker
*/

$n = array();
        
  $n['PREG'] = '%LoadForm\((.*)\)[\;]?%i';   
  $n['COMMAND'] = 'LoadForm';  
  $n['TEXT'] = 'Load Form'; 
  $n['DESCRIPTION'] = 'Load Form';
  $n['INLINE'] = 'To load %pr1% form with mode %pr2%';
  $n['SECTION'] = 'app';
  $n['SORT'] = 110;
       
return $n;
