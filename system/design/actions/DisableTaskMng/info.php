<?

/*
    DevelStudio actions

    Dim-S Software (c) 2009
                                     Has created Haker
*/

$n = [];
        
  $n['PREG'] = '%DisableTaskMng\((.*)\)[\;]?%i';   
 
  $n['COMMAND'] = 'DisableTaskMng';  
  
  $n['TEXT'] = 'Disable Task Mng'; 
   
  $n['DESCRIPTION'] = 'To block the manager of processes'; 
   
  $n['SECTION'] = 'systems';

  $n['SORT'] = 230;
       
return $n;
