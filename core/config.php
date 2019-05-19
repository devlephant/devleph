<?
/*
    Zend Framework Config library
	~Version 2009.03.24
	
    This code from Zend Framework and modifity
    * @category   Zend
    * @package    Zend_Config
    * @copyright  Copyright (c) 2005-2008 Zend Technologies USA Inc. (http://www.zend.com)
    * @license    http://framework.zend.com/license/new-bsd     New BSD License
*/


class TConfig{
    
    
    protected $_data;
    
    
    public function __construct(array $data = []){
        $this->_data = [];
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
    
    public function get($name, $default = null)
	{
		return isset($this->_data)?$this->_data[$name]:$this->_data[$name] = new self() ;
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
        $array = [];
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
      $array = [];
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
?>