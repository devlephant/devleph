<?
class TDirDialog extends __TNoVisual {
    
    
	
	function execute(){
		
                $result = '';
                $title  = $this->title ? $this->title : '';
                
                $root   = $this->root ? $this->root : '';
                
		if (selectDirectory($title, $root, $result)){
			
                        $result = replaceSr($result);
			$this->filename = $result;
			$this->result   = $result;
			return true;
		}
		return false;
        }

        public function __construct($onwer=nil,$self=nil){
            parent::__construct($onwer,$self);
            
            if ($self==nil){
                $this->title = '';
                $this->root  = '';
            }
        }
}
?>