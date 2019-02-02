<?

/*
    SoulEngine actions

    Dim-S Software (c) 2009
*/

$n = array();
        
  $n['PREG'] = '%data::write\((.*)\)[\;]?%i';   
 
  $n['COMMAND'] = 'data::write';  
  
  $n['TEXT'] = 'Write data'; 
   
  $n['DESCRIPTION'] = 'To write any data in file'; 
   
  $n['INLINE'] = 'Write %pr1% data in %pr2% file'; 
   
  $n['SECTION'] = 'files';

  $n['SORT'] = 5010;
       
return $n;
