<?


class modifer_TFunction {
    
    /*function listEvent(){
        
        return array();
    }*/
    
    function toResult($form_name, $name, $info, $eventList){
	
	$code = TFunction::__register($form_name, $name, $info, $eventList);
        myCompile::addCompileCode($code);
    }
}