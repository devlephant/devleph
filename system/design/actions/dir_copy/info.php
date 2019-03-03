<?

/*
    DevelStudio actions

    Dim-S Software (c) 2009
*/

$n = array();
        
  $n['PREG'] = '%dir_copy\((.*)\)[\;]?%i';   
 
  $n['COMMAND'] = 'dir_copy';  
  
  $n['TEXT'] = 'Copy directory'; 
    
  $n['INLINE'] = 'To copy %pr1% directory to %pr2%'; 
   
  $n['SECTION'] = 'files';

  $n['SORT'] = 5090;
       
return $n;
