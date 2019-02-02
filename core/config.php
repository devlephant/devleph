<?
/*
    SoulEngine Config library
    
    2009.04 v0.1
    
    Dim-S Software (c) 2009
    
    This code from Zend Framework and modifity
    * @category   Zend
    * @package    Zend_Config
    * @copyright  Copyright (c) 2005-2008 Zend Technologies USA Inc. (http://www.zend.com)
    * @license    http://framework.zend.com/license/new-bsd     New BSD License
*/


class TConfig{
    
    public $class_name = __CLASS__;
    protected $_data;
    
    
    public function __construct(array $data = array()){
        $this->_data = array();
        $this->setArray($data);   
    }
    
    public function setArray(array $data){
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $this->_data[$key] = new self($value);
            } else {
                $this->_data[$key] = $value;
            }
        }
    }
    
    public function get($name, $default = null){
        $result = $default;
        
        if (array_key_exists($name, $this->_data)) {
            $result = $this->_data[$name];
        }
		if( $result == null )
			$result = $this->_data[$name] = new self();
        return $result;
    }
    
    public function __get($name){
        return $this->get($name);
    }
    
    public function __set($name,$value){
		
        if (is_array($value)) {
            $this->_data[$name] = new self($value);
        } else {
            $this->_data[$name] = $value;
        }
    }
    
    public function toArray()
    {
        $array = array();
        foreach ($this->_data as $key => $value) {
            if ($value instanceof TConfig) {
                $array[$key] = $value->toArray();
            } else {
                $array[$key] = $value;
            }
        }
        return $array;
    }
    
    public function __isset($name)
    {
        return isset($this->_data[$name]);
    }
    
    public function __clone()
    {
      $array = array();
      foreach ($this->_data as $key => $value) {
          if ($value instanceof TConfig) {
              $array[$key] = clone $value;
          } else {
              $array[$key] = $value;
          }
      }
      $this->_data = $array;
    }
    
    public function loadFromFile($filename){}
    public function saveToFile($filename){}
}