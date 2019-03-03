<?

/*
    DevelStudio actions

    Dim-S Software (c) 2009
*/

$n = array();
        
  $n['PREG'] = '%file_move\((.*)\)[\;]?%i';   
 
  $n['COMMAND'] = 'file_move';  
  
  $n['TEXT'] = 'Move file'; 
   
  $n['INLINE'] = 'To move %pr1% file to %pr2%'; 
   
  $n['SECTION'] = 'files';

  $n['SORT'] = 5050;
       
return $n;
