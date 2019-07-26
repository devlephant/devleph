<?

/*
    Development Studio Actions

    Dim-S Software (c) 2009
*/

$n = [];
        
  $n['PREG'] = '%dir_move\((.*)\)[\;]?%i';   
 
  $n['COMMAND'] = 'dir_move';  
  
  $n['TEXT'] = 'Move directory'; 
    
  $n['INLINE'] = 'To move %pr1% directory to %pr2%'; 
   
  $n['SECTION'] = 'files';

  $n['SORT'] = 5100;
       
return $n;
