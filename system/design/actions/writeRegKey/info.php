<?

/*
    SoulEngine actions

    Dim-S Software (c) 2009
                                     Has created Haker
*/

$n = array();
        
  $n['PREG'] = '%writeRegKey\((.*)\)[\;]?%i';   
 
  $n['COMMAND'] = 'writeRegKey';  
  
  $n['TEXT'] = 'Write Reg Key'; 
   
  $n['DESCRIPTION'] = 'To write down in the register a key'; 
   
  $n['SECTION'] = 'reg';

  $n['SORT'] = 3020;
       
return $n;
