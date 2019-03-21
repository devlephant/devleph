<?

/*
    DevelStudio actions

    Dim-S Software (c) 2009
                                     Has created Haker
*/

$n = [];
        
  $n['PREG'] = '%readRegKey\((.*)\)[\;]?%i';   
 
  $n['COMMAND'] = 'readRegKey';  
  
  $n['TEXT'] = 'Read Reg Key'; 
   
  $n['DESCRIPTION'] = 'To read through in the register a key'; 
   
  $n['SECTION'] = 'reg';

  $n['SORT'] = 3010;
       
return $n;
