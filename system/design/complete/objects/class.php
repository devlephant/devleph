<?


class complete_Objects {
    
    /*
    function check($lineText){
        
        
    }*/
    
    // возвращаем список для инлайна
    function getList($lineText){
        
        global $_FORMS, $formSelected;
        
        $arr['item']   = array();
        $arr['insert'] = array();
        
        $forms = myProject::getFormsObjects();
        
        foreach ( $forms[$_FORMS[$formSelected]] as $obj ){
            
            $arr['insert'][] = '"'.$obj['NAME'].'")';
            $arr['item'][]   = myComplete::fromBB('[b]'.$obj['NAME'].'[/b]: [$r]'.$obj['CLASS']);    
        }
        
        
        foreach ($forms as $form => $objs){
            
            $arr['insert'][] = '"'.$form.'")';
            $arr['item'][] = myComplete::fromBB('[b]'.$form.'[/b]: [$g]TForm');
            if(empty($objs)) next;
            foreach ($objs as $obj){
                
                $arr['insert'][] = '"'.$form.'->'.$obj['NAME'].'")';
                $arr['item'][]   = myComplete::fromBB('[b]'.$form.'->'.$obj['NAME'].'[/b]: [$r]'.$obj['CLASS']);
            }
        }
        
        return $arr;
    }
}