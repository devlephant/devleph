<?

/*
    Development Studio Actions

    Dim-S Software (c) 2009
*/

$n = [];
        
  $n['PREG'] = '%dir_rename\((.*)\)[\;]?%i';   
 
  $n['COMMAND'] = 'dir_rename';  
  
  $n['TEXT'] = 'Rename directory'; 
    
  $n['INLINE'] = 'To rename %pr1% directory to %pr2%'; 
   
  $n['SECTION'] = 'files';

  $n['SORT'] = 5110;
       
return $n;
