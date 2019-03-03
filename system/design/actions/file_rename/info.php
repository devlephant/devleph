<?

/*
    DevelStudio actions

    Dim-S Software (c) 2009
*/

$n = array();
        
  $n['PREG'] = '%file_rename\((.*)\)[\;]?%i';   
 
  $n['COMMAND'] = 'file_rename';  
  
  $n['TEXT'] = 'Rename file'; 
   
  $n['INLINE'] = 'To rename %pr1% file to %pr2%'; 
   
  $n['SECTION'] = 'files';

  $n['SORT'] = 5060;
       
return $n;
