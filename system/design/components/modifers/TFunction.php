<?


class modifer_TFunction {
    
    /*function listEvent(){
        
        return [];
    }*/
    
    function toResult($form_name, $name, $info, $eventList){
	
	$code = TFunction::__register($form_name, $name, $info, $eventList);
        myCompile::addCompileCode($code);
    }
}