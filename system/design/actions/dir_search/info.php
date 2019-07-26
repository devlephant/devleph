<?

/*
    Development Studio Actions

    Dim-S Software (c) 2009
*/

$n = [];
        
  $n['PREG'] = '%dir_search\((.*)\)[\;]?%i';   
 
  $n['COMMAND'] = 'dir_search';  
  
  $n['TEXT'] = 'Search files'; 
    
  $n['INLINE'] = 'To search files in %pr1% and write result to %pr2% variable'; 
   
  $n['SECTION'] = 'files';

  $n['SORT'] = 5120;
       
return $n;
