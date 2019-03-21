<?

/*
    DevelStudio actions

    Dim-S Software (c) 2009
*/

$n = [];
        
  $n['PREG'] = '%file_copy\((.*)\)[\;]?%i';   
 
  $n['COMMAND'] = 'file_copy';  
  
  $n['TEXT'] = 'Copy file'; 
   
  $n['INLINE'] = 'To copy %pr1% file to %pr2%'; 
   
  $n['SECTION'] = 'files';

  $n['SORT'] = 5040;
       
return $n;
