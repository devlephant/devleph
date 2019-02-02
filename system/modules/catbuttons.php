<?

class TCategoryButtons extends TControl {
    
    public $class_name = __CLASS__;
    private $_categories = 0;
    #groups
    
    public function get_categories(){
        if (!$this->_categories)
            $this->_categories = _c(categorybtns_categories($this->self));
        
        return $this->_categories;
    }
    
    public function set_images($il){
        
        categorybtns_images($this->self, $il->self);
    }
    
    // TButtonItem
    public function get_selectedItem(){
        return _c(categorybtns_selected($this->self));
    }
    
    public function addSection($group,$caption,$color=clWhite){
        
        $sec = $this->categories->add();
        $sec->caption = $caption;
        $sec->color   = $color;
        
        $groups = $this->groups;
        $groups[$group] = $sec->self;
        
        $this->groups = $groups;
    }
    
    // TButtonItem
    public function addButton($group){
        
        $groups = $this->groups;
        $sec = _c($groups[$group]);
		$arr = $this->items;
		$btn = $sec->addButton();
        $arr[$group][] = $btn->self;
		$this->items = $arr;
        return $btn;
    }
    public function set_selected($group){
        
        $groups = $this->groups;
        $sec = _c($groups[$group]);
        
        foreach ($groups as $tmp=>$self)
            _c($self)->collapsed = true;
            
        $sec->collapsed = false;
    }
    
    public function get_selected(){
        
        $groups = $this->groups;
        
        foreach ($groups as $tmp=>$self)
            if (!_c($self)->collapsed)
                return $tmp;
            
        return false;
    }
    
    public function set_selectedList($arr){
        
        $groups = $this->groups;
        //$sec = _c($groups[$group]);
        
        foreach ($groups as $name=>$self){
            
            if (in_array($name, $arr))
                _c($self)->collapsed = false;
            else
                _c($self)->collapsed = true;
        }
    }
    
    public function get_selectedList(){
        
        $groups = $this->groups;
        $result = array();
        
        foreach ($groups as $tmp=>$self)
            if (!_c($self)->collapsed)
                $result[] = $tmp;
            
        return $result;
    }
    
    public function set_smallIcons($v){
        if ($v){
            $this->buttonOptions = 'boGradientFill,boBoldCaptions,boUsePlusMinus,boCaptionOnlyBorder';
        } else {
            $this->buttonOptions = 'boShowCaptions,boFullSize,boGradientFill,boBoldCaptions,boUsePlusMinus,boCaptionOnlyBorder';
        }
    }
    
    public function get_smallIcons(){	
        
        return stripos($this->buttonOptions,'boShowCaptions')===false;
    }
    
    public function unSelect(){
        
        categorybtns_unselect($this->self);
    }

}

class TButtonCategories extends TControl {
    
    public $class_name = __CLASS__;
    
    // return TButtonCategory
    public function add(){
        return _c(btncatigories_add($this->self));
    }
    
    // return TButtonCategory
    public function insert($index){
        
        return _c(btncatigories_insert($this->self, $index));
    }
}

class TButtonCategory extends TControl {
    
    public $class_name = __CLASS__;
	public $class_name_ex = __CLASS__;
    #collapsed
    public function addButton(){
		return _c(btncatigories_addbutton($this->self));
    }
}

class TButtonItem extends TControl {
    
    public $class_name = __CLASS__;
}