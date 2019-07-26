<?


/*
 
    Dev-S WindowsRegistry
    
    2009.10 ver 1.0   
    
*/

global $_c;


// Reserved Key Handles. 

  $_c->HKEY_CLASSES_ROOT     = 0x80000000;
  $_c->HKEY_CURRENT_USER     = 0x80000001;
  $_c->HKEY_LOCAL_MACHINE    = 0x80000002;
  $_c->HKEY_USERS            = 0x80000003;
  $_c->HKEY_PERFORMANCE_DATA = 0x80000004;
  $_c->HKEY_CURRENT_CONFIG   = 0x80000005;
  $_c->HKEY_DYN_DATA         = 0x80000006;
  
  $_c->reg_STRING    = 0;
  $_c->reg_DATE_TIME = 1;
  $_c->reg_BOOL      = 2;
  $_c->reg_DWORD     = 3;
  $_c->reg_CURRENCY  = 4;

class TRegistry {
    
    public $self;
    
    function __construct(){
        
        $this->self = registry_create();
    }
    
    function __call($name, $args){
        
        $name = strtolower(str_replace('_','',$name));
        
        if (!isset($args[0])) $args[0] = '';
        if (!isset($args[1])) $args[1] = '';
        if (!isset($args[2])) $args[2] = '';
        
        return registry_command($this->self, $name, $args[0], $args[1], $args[2]);
    }
    
    function __destruct(){
        $this->free();
    }
    
    function free(){
        if ($this->self){
            obj_free($this->self);
            $this->self = false;
        }
    }
    
    function writeKeyEx($root, $path, $value = '', $type = reg_STRING){
        
        $this->rootKey($root);
        $path = replaceSr($path);
        $key = substr($path, 0, strrpos($path, '\\')+1);
        $p   = substr($path, strrpos($path, '\\')+1, strlen($path) - strrpos($path, '\\'));
        
        
        $p = $p=='*' ? '' : $p;
        
        if (!$this->openKey($key, true));
        
        switch ($type){
            
            case reg_STRING: $this->writeString($p, $value); break;
            case reg_BOOL  : $this->writeBool($p, $value); break;
            case reg_DWORD : $this->writeFloat($p, $value); break;
            case reg_DATE_TIME: $this->writeDate($p, $value); break;
            default: $this->writeString($p, $value); break;
        }
    }
    
    function readKeyEx($root, $path, $type = reg_STRING){
        
        $this->rootKey($root);
        $path = replaceSr($path);
        $key = substr($path, 0, strrpos($path, "\\")+1);
        $p   = substr($path, strrpos($path, "\\")+1, strlen($path) - strrpos($path, '\\'));
        
        $p = $p=='*' ? '' : $p;
        
        $this->openKey($key, true);
        
        switch ($type){
            
            case reg_STRING: return $this->readString($p); break;
            case reg_BOOL  : return $this->readBool($p); break;
            case reg_DWORD : return $this->readFloat($p); break;
            case reg_DATE_TIME: return $this->readDate($p); break;
            default: return $this->readString($p); break;
        }
    }
}

// регистрация ассоциации расширения с программой
function registerFileType($prefix, $exe)
{

    $exe = replaceSr($exe);  
    
    $r = new TRegistry;
    $r->RootKey(HKEY_CLASSES_ROOT);
    $r->OpenKey('.'.$prefix, true);
    $r->WriteString('',$prefix . 'file');
    $r->CloseKey();
    
    $r->CreateKey($prefix . 'file');
    $r->OpenKey($prefix . 'file\DefaultIcon', true);
    $r->WriteString('',$exe . ',0');
    $r->CloseKey();
    
    $r->OpenKey($prefix . 'file\shell\open\command', true);
    $r->WriteString('',$exe . ' "%1"');
    $r->CloseKey();
    $r->Free();
}

function registerEnvPath($dirname, $alias)
{
	$dirname = str_replace('/', DIRECTORY_SEPARATOR, realpath($dirname));
	if( is_dir($dirname) )
		writeRegKey(HKEY_LOCAL_MACHINE, "SYSTEM\\CurrentControlSet\\Control\\Session Manager\\Environment\\{$alias}", $dirname, 0);
}
/*
function registerSearchPath($dirname)
{
	$dirname = str_replace('/', DIRECTORY_SEPARATOR, realpath($dirname));
	if( !is_dir($dirname) ) 
		return false;
	$paths = getSearchPaths();
	if( in_array($dirname, $paths) )
		return true;
	$paths[] = $dirname;
	writeregkey(HKEY_LOCAL_MACHINE, "SYSTEM\\CurrentControlSet\\Control\\Session Manager\\Environment\\Path", implode(';', $paths), 0);
	return true;
}

function getSearchPaths()
{
	return explode(';', readRegKey(HKEY_LOCAL_MACHINE, "SYSTEM\\CurrentControlSet\\Control\\Session Manager\\Environment\\Path",0));
}*/
?>