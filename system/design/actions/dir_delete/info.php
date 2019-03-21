<?

/*
    DevelStudio actions

    Dim-S Software (c) 2009
*/

$n = [];
        
  $n['PREG'] = '%dir_delete\((.*)\)[\;]?%i';   
 
  $n['COMMAND'] = 'dir_delete';  
  
  $n['TEXT'] = 'Delete directory'; 
    
  $n['INLINE'] = 'To delete %pr1% directory'; 
   
  $n['SECTION'] = 'files';

  $n['SORT'] = 5080;
       
return $n;
