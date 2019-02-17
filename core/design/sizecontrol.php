<?
/*
  
  SoulEngine Run-Time Design Library
  
  2009.04 ver 0.2
  
  Dim-S Software (c) 2009
  
  Описание:
    Библиотека для создания визуального редактора.
    
  TSizeCtrl - основной класс для работы с редактором.
  Он поможет изменять размеры и позиции компонентов на форме.
  
  Неописанные свойства:
    MoveOnly: True/False - только для перемещения
    BtnColor: цвет - точек редактирования
    BtnColorDisabled: цвет - точек редактирования, которые неактивны
    GridSize: 1..100 - размер сетки для пермещения и изменения размеров
    MultiTargetResize: True/False - разрешить изменение размеров сразу нескольких компонентов
    
  События:
    OnDuringSizeMove (self, dx, dy, state: TSCState);
    OnStartSizeMove  (self, state: TSCState);
    OnEndSizeMove    (self, state: TSCState);
    OnSizeMouseDown (self, target, x, y)
*/


global $_c;

// TSCState = (scsReady, scsMoving, scsSizing);
$_c->setConstList('scsReady', 'scsMoving', 'scsSizing', 0);

class TSizeCtrl extends TControl{
    
    
    public $targets = array();
    //public $targets_ex = array();
    
    public function set_enable($b){ sizectrl_enable($this->self, $b); }
    public function get_enable()  { return sizectrl_enable($this->self, null); }
    
    public function set_popupMenu($menu){
        $men = is_numeric($menu)? $menu: (is_object($menu)? $menu->self: -222);
		if($men === -222) return;
	    popup_set($men, $this->self);
    }
    
    public function indexOf($target){        
        $result = 0;
        $self   = $target->self;
        $c      = count($this->targets);
        for($i=0;$i<$c;$i++){
            
            if ($this->targets[$i]->self == $self)
                return $i;
        }
        
        return -1;
    
        foreach ($this->targets as $obj){
            if ($obj->self == $target->self)
                return $result;
            
            $result++;
        }
        return -1;
    }
    
    public function addTarget($target, $init = true){
        
        $this->targets[] = $target;
        
        if ($init)
        return sizectrl_add_target($this->self, $target->self);
    }
    
    public function deleteTarget($target){
        sizectrl_delete_target($this->self, $target->self);
    }
    
    public function unRegisterTarget($target){
        
        
        //unset($this->targets_ex[$target->self]);
        sizectrl_unregister($this->self, $target->self);
    }
    
    public function registerTarget($target){
        
        sizectrl_register($this->self, $target->self);
    }
    
    public function clearTargets(){
        
        sizectrl_clear_targets($this->self);
        $this->targets = array();
        //$this->targets_ex = array();
    }
    
    public function unRegisterAll(){
        sizectrl_unregister_all($this->self);
        $this->targets = array();
        //$this->targets_ex = array();
    }
    
    public function update(){
        sizectrl_update($this->self);
        $this->targets_ex = array();
    }
    
    public function updateBtns(){
        sizectrl_updateBtns($this->self);
    }
    
    public function getSelected(){
        
        return sizectrl_selected($this->self);
    }
    
    public function get_targets_ex(){
        
        $result = array();
            $tmp = $this->getSelected();
            foreach ($tmp as $link)
                $result[$link] = _c($link);
                
        return $result;
    }
    
    public function set_onSizeMouseDown($value){
        $this->onMouseDown = $value;
    }
    
}
?>