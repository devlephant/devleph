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
        return [];
    }
	private static function arrtotex($name, $arr)
	{
		$res = [];
		foreach($arr as $key=>$value)
		{
				$res[] = is_array($value)?
						self::arrtotex("{$name}[{$key}]",$value):
						"{$name}[{$key}]=" . self::toinivalue($value);
		}
		return implode(_BR_,$res);
	}
    private static function toinivalue($v,$k)
	{
		switch( gettype($v) )
		{
			case "boolean":
			return $v?"yes":"no";
			case "string":
			return "\"{$v}\"";
			case "array":
			return self::arrtotex($k,$v);
			case "object":
			return "";
			return '"' . serialize($v) . '"';
			default:
			return $v;
		}
	}
    function updateFile(){
        
        $this->filename = replaceSl($this->filename);        
        $result = '';
        foreach ($this->arr as $sname=>$section){
            
            $result .= '[' . $sname . ']' . _BR_;
            foreach ($section as $key=>$value){
				$result .= is_array($value)?"":"{$key}=";
                $result .=  self::toinivalue($value,$key). _BR_;    
            }
            
            $result .= _BR_;
        }
        
            file_p_contents($this->filename, $result);
            return true;
    }    
}
class TIniFileExObject implements Countable, Iterator {
	protected $____parent;
	protected $____data;
	protected $____cnt;
    protected $____idx;
    public function __construct($data,$parent=false) {
		$this->____parent = $parent;
        if (sizeof($data) > 0) {
            foreach($data as $key=>$value) {
                if (is_array($value)) {
                    $this->____data[$key] = new self($value,$this);
                } else {
                    $this->____data[$key] = $value;
                }
            }
        }
        $this->____cnt = count($this->____data);
    }
	function Updated()
	{
		if( is_object($this->____parent) )
			if( $this->____parent instanceof TIniFileExObject )
			{
				$this->____parent->Updated();
			} else {
				$this->____parent->arr = $this->toArray();
			}
	}
    public function get($name) {
        return array_key_exists($name, $this->____data) ? $this->____data[$name] : null;
    }
    public function __get($name)
	{
        return $this->get($name);
    }
    public function __set($name, $value) 
	{
		$this->____data[$name] = is_array($value)?(new self($value,$this)):$value;
        $this->____cnt = count($this->____data);
		$this->Updated();
    }
    public function __clone()
	{
        $array = array();
        foreach($this->____data as $key=>$value)
		{
			$array[$key] = ($value instanceof TIniFileEx)?clone $value:$value;
        }
        $this->____data = $array;
    }
    public function toArray()
	{
        $array = [];
        $data = $this->____data;
        foreach($data as $key=>$value)
		{
			$array[$key] = ($value instanceof TIniFileExObject)?$value->toArray():$value;
        }
        return $array;
    }
    public function __isset($name)
	{
        return isset($this->____data[$name]);
    }
    public function __unset($name)
	{
        unset($this->____data[$name]);
        $this->____cnt = count($this->____data);
		$this->Updated();
    }
    public function count()
	{
        return $this->____cnt;
    }

    function rewind()
	{
        reset($this->____data);
        $this->____idx = 0;
    }

    function current()
	{
        return current($this->____data);
    }

    function key()
	{
        return key($this->____data);
    }

    function next()
	{
        next($this->____data);
        ++$this->____idx;
    }

    function valid()
	{
        return $this->____idx < $this->____cnt;
    }
}
?>