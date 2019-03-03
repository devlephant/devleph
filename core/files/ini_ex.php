<?
/*
    DevelStudio ConfigIni library
    
    2009.04 v0.1
    
    Dim-S Software (c) 2009
*/

class TIniFileEx {
    
    public $filename;
    public $arr;
    
    function __construct($file = false){
        
        if ($file)
            $this->loadFromFile($file);
    }
    
    function initArray(){
        
        $this->arr = parse_ini_file($this->filename, true);
    }
    
    function loadFromFile($file){
        
        $result = true;
        $file = replaceSl($file);
        $this->filename = $file;
        if (file_exists($file) && is_readable($file)){
            $this->initArray();
        }
        else
            $result = false;
            
        return $result;
    }
    
    function read($section, $key, $def = ''){
        
        if (isset($this->arr[$section][$key])){
            
            return $this->arr[$section][$key];
        } else
            return $def;
    }
    
    function write($section, $key, $value){
        
        if (is_bool($value))
            $value = $value ? 1 : 0;
        
        $this->arr[$section][$key] = $value;
    }
    
    function eraseSection($section){
        
        if (isset($this->arr[$section]))
            unset($this->arr[$section]);
    }
    
    function deleteKey($section, $key){
        
        if (isset($this->arr[$section][$key]))
            unset($this->arr[$section][$key]);
    }
    
    function readSections(&$array){
        
        $array = array_keys($this->arr);
        return $array;
    }
    
    function readKeys($section, &$array){
        
        if (isset($this->arr[$section])){
            $array = array_keys($this->arr[$section]);
            return $array;
        }
        return array();
    }
    
    function updateFile(){
        
        $this->filename = replaceSl($this->filename);        
        $result = '';
        foreach ($this->arr as $sname=>$section){
            
            $result .= '[' . $sname . ']' . _BR_;
            foreach ($section as $key=>$value){
                $result .= $key .'='.$value . _BR_;    
            }
            
            $result .= _BR_;
        }
        
            file_p_contents($this->filename, $result);
            return true;
    }
    
    function __destruct(){
        
        //$this->updateFile();
    }
    
    
}
?>