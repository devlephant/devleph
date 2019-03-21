<?

/*
    DevelStudio actions

    Dim-S Software (c) 2009
*/

$n = [];
        
  $n['PREG'] = '%dir_create\((.*)\)[\;]?%i';   
 
  $n['COMMAND'] = 'dir_create';  
  
  $n['TEXT'] = 'Create directory'; 
   
  $n['DESCRIPTION'] = 'To create a directory'; 
   
  $n['INLINE'] = 'To create %pr1% directory'; 
   
  $n['SECTION'] = 'files';

  $n['SORT'] = 5070;
       
return $n;
