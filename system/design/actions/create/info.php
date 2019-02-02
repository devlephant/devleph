<?


$n = array();

    
    $n['PREG'] = '%(.*)=([ ]*)objCreate\((.*)\)%i';
    $n['COMMAND'] = 'create';
    $n['TEXT'] = 'Create copy of object';
    $n['INLINE'] = 'To create copy of %pr2% object and write to %pr1%';
    $n['SECTION'] = 'objects';
    $n['SORT'] = 4140;
    
    
return $n;
