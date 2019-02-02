<?

/*
    SoulEngine actions

    Dim-S Software (c) 2009
*/

$n = array();
        
  $n['PREG'] = '%data::read\((.*)\)[\;]?%i';   
 
  $n['COMMAND'] = 'data::read';  
  
  $n['TEXT'] = 'Read data'; 
   
  $n['DESCRIPTION'] = 'To read any data from file'; 
   
  $n['INLINE'] = 'Read data from %pr1% file and write result to %pr2%'; 
   
  $n['SECTION'] = 'files';

  $n['SORT'] = 5020;
       
return $n;
