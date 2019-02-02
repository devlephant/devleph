<?php

abstract class mem{
    function sizeOfType($type){
        return SizeOfType($type); 
    }
    function isKeyDown($key){
        return isKeyDown($key); 
    }
    function keyDown($key){
        return KeyDown($key); 
    }
    function keyUp($key){
        return KeyUp($key); 
    }
    function keyClick($key,$bScan = 0){
        return KeyStroke($key, $bScan); 
    }
    function iconFile($lpPathFile, $Index){
        return GetIconFile($lpPathFile, $Index);
    }
    function globalMemInfo(){
        return GlobalMemoryStatus();
    }
    function findWindow($caption,$class){
        return FindWnd($caption,$class);
    }
    function getForegroundWindow(){
        return GetForegroundWindow();
    }
    function getWindowThreadProcessId($hwnd){
        getWindowThreadProcessId($hwnd,$res);
        return new Process($res);
    }
}

abstract class processes{
    static function fromName($name){
        return GetProcessIds($name);
    }
    static function current(){
        return new Process(GetCurrentProcessId());
    }
    static function all(){
        return GetProcessesList();
    }
    static function allAssoc(){
        $prcss = GetProcessesList();
        foreach($prcss as $k => $v){
            $res[$k][] = $v;            
        }
        return $res;
    }
}

abstract class procHandleMngr{
    static $handles;
    function Open($id,$flags = PROCESS_ALL_ACCESS){
        if(!processIdExists($id)){
            if(self::$handles[$id])
                unset(self::$handles[$id]);
                throw new Exception('Handle meneger: Процесс (PID: '.$id.') не найден. Получение handle невозможно.');
            return false;
        }
        if(!self::$handles[$id])
            self::$handles[$id] = OpenProcess($flags,false,$id);
        return self::$handles[$id];
    }
    function Close($id){
        if(self::$handles[$id])
            CloseHandle(self::$handles[$id]);
        unset(self::$handles[$id]);
    }
}

class memory{
    static $allocs;
    private $process;
    function __construct($process){
        $process = new Process($process);
        if(!$process)
            return;        
        $this->process = $process;
    }
    
    function handle(){
        return $this->process->handle();
    }
    
    function read($type,$addr,$len = null){
        return ReadMemory($this->handle(),$type,$addr,$len);
    }
    
    function write($type,$addr,$data){
        return WriteMemory($this->handle(),$type,$addr,$data);
    } 
    
    function readByte($addr){
        return $this->read(ptByte,$addr);
    }
    
    function readChar($addr){
        return $this->read(ptChar,$addr);
    }
    
    function readWChar($addr){
        return $this->read(ptWChar,$addr);
    }
    
    function readInt($addr){
        return $this->read(ptInt,$addr);
    }
    
    function readInt64($addr){
        return $this->read(ptInt64,$addr);
    }
    
    function readFloat($addr){
        return $this->read(ptFloat,$addr);
    }
    
    function readDouble($addr){
        return $this->read(ptDouble,$addr);
    }
    
    function readStr($addr,$len){
        return $this->read(ptStr,$addr,$len);         
    }
    
    function readWStr($addr,$len){
        return $this->read(ptWStr,$addr,$len);   
    }
    
    function writeByte($addr,$data){
        return $this->write(ptByte,$addr,$data);
    }
    
    function writeChar($addr,$data){
        return $this->write(ptChar,$addr,$data);
    }
    
    function writeWChar($addr,$data){
        return $this->write(ptWChar,$addr,$data);
    }
    
    function writeInt($addr,$data){
        return $this->write(ptInt,$addr,$data);
    }
    
    function writeInt64($addr,$data){
        return $this->write(ptInt64,$addr,$data);
    }
    
    function writeFloat($addr,$data){
        return $this->write(ptFloat,$addr,$data);
    }
    
    function writeDouble($addr,$data){
        return $this->write(ptDouble,$addr,$data);
    }
    
    function writeStr($addr,$data){
        return $this->write(ptStr,$addr,$data);         
    }
    
    function writeWStr($addr,$data){
        return $this->write(ptWStr,$addr,$data);   
    }
    
    function alloc($size){
        $h = $this->handle();        
        $res = VirtualAllocEx($h, 0, $size, MEM_COMMIT | MEM_RESERVE, PAGE_READWRITE); 
        self::$allocs[$h][$res] = $size;
        return $res;
    }
    
    function free($handle){
        $h = $this->handle();        
        $res = VirtualFreeEx($this->handle(), $handle, self::$allocs[$h][$handle], MEM_RELEASE);
        unset(self::$allocs[$h][$handle]);
        return $res;
    }
    
    function getModule($addr){
        $mdls = $this->process->modules();
        $dll = 0;
        $mdls->each(function($module)use($addr,&$dll){
            static $dll = false;
            if($dll !== 0)
                return;
            static $oldH = 0;  
            $h = $module->handle();
            if(($oldH < $addr)&&($h > $addr)){
                $dll = $module->name();
            }
            $oldH = $h;
        });
        return $dll;
    }
    
    function search($bytes,$cache = 3){
        if(!$cache)
            $cache = 3;
        $cache = $cache*1024*1024;
        $bytes = '/'.bin2hex($bytes).'/i';
        $mem = $this->process->memUsage();
        for($i=0;$i<=$mem;$i+=$cache){
            $data = bin2hex($this->readStr($i,$cache));
            if(preg_match_all($bytes,$data,$res,PREG_OFFSET_CAPTURE)){
                $res = $res[0];
                $s = sizeof($res);
                for($j=0;$j<$s;$j++)
                    if($res[$j][1])
                        $addrs[] = $res[$j][1];
            }     
        }    
        return $addrs;
    }
}

class procedure{
    private $process;
    private $module;
    private $procName;
    private $handle;
    function __construct($process,$module,$procedureName){
        $process = new Process($process);
        if(!$process)
            return;
        $module = new module($process,$module);
        if(!$module)
            return;
        if(!$procedureName)
            throw new Exception(__CLASS__.' -> Название процедуры не указано!');
        $this->process = $process;
        $this->module = $module;
        $this->procName = $procedureName;
        $this->handle = GetProcAddress($process->handle(),$module->handle(),$this->procName);
    }
    
    function handle(){
        return $this->handle;
    }
    
    function name(){
        return $this->procName;
    }
}

class module{
    private $process;
    private $handle;
    private $name;
    function __construct($process,$module){
        $process = new Process($process);
        if(!$process)
            return;
        if(!is_string($module)){
            throw new Exception(__CLASS__.' -> Нужно передать имя модуля!');     
        }
        $this->process = $process;
        $this->handle = GetModuleHandle($process->handle(),$module);
        $this->name = $module;
    }
    
    function handle(){
        return $this->handle;
    }
    
    function path(){
        return GetModulePath($this->process->handle(),$this->name());
    }
    
    function procedure($name){        
        return new procedure($this->process,$this->name(),$name);
    }
    
    function exports(){
        return GetExport($this->process->handle(),$this->handle());
    }
    
    function name(){
        return $this->name;
    }
}

class modulesList{
    var $list = array();
    private $process;
    function each(Closure $func){
        if(!$this->list)
            return;
        if(method_exists($this, 'update'))
            $this->update();
        $s = sizeof($this->list);
        for($i=0;$i<$s;$i++){  
            $v = $this->list[$i];
            $func(new module($this->process,$v));
        }
    }
    
    function __construct($process){
        $process = new Process($process);
        if(!$process)
            return;
        $this->process = $process;
        $this->update();
    }
    
    function update(){
        $this->list = array_values(GetModulesList($this->process->handle()));
    }
}

class process{
    private $id;
    function __construct($idOrName){
        if($idOrName instanceof process){
            $this->id = $idOrName->id;
            return;
        }    
        if($idOrName == 0)
            throw new Exception(__CLASS__.' -> Процесса с таким PID быть не может!');
        if(is_string($idOrName)){
            $id = current(Processes::fromName($idOrName));
            $this->id = $id;
        }elseif(is_int($idOrName)){
            $this->id = $idOrName;
        }else{
            throw new Exception(__CLASS__.' -> Нужно передать имя процасса, индефикатор или класс Process!');
        }
    }
    
    function exists(){
        return processIdExists($this->id);
    }
    
    function __destruct(){
        ProcHandleMngr::Close($this->id);
    }
    
    function id(){
        return $this->id;
    }
    
    function handle(){
        return ProcHandleMngr::Open($this->id);
    }
    
    function freeMem(){
        return EmptyWorkingSet($this->handle());
    }
    
    function memUsage(){
        return memoryGetUsage($this->handle());
    }
    
    function memInfo(){
        return GetProcessMemoryInfo($this->handle());
    }
    
    function module($module){
        return new module($this,$module);
    }
    
    function modules(){
        return new modulesList($this);
    }
    
    function name(){
        $list = GetModulesList($this->handle());
        return current($list);
    }
    
    function procedure($name){
        $h = $this->handle();
        $hM = GetModuleHandle($h,$this->name());
        return GetProcAddress($h,$hM,$name);
    }
    
    function exports(){
        $h = $this->handle();
        $hM = GetModuleHandle($h,$this->name());
        return GetExport($h,$hM);
    }
    
    function path(){
        return GetModulePath($this->handle(),$this->name());
    }
    
    function Close(){
        $res = TerminateProcess($this->handle(),$this->handle());
        $this->__destruct();
        return $res; 
    }
    
    function icon($index){
        return GetIconModule($this->path(),$index);
    }
    
    function memory(){
        return new memory($this);
    }
}

class processListEach{
    var $list = array();
    function each(Closure $func){
        if(!$this->list)
            return;
        if(method_exists($this, 'update'))
            $this->update();
        $s = sizeof($this->list);
        for($i=0;$i<$s;$i++){  
            $v = $this->list[$i];
            $func(new Process($v));
        }
    }
}

class processList extends processListEach{
    var $procName;   
    function __construct($procName){
        if(is_string($procName)|| is_array($procName)){
            $this->procName = $procName;
            $this->update();
        }else{
            throw new Exception(__CLASS__.' -> Нужно передать имя процесса!');
        }
    }
    
    function update(){
        $this->list = array();
        if(is_array($this->procName)){
            foreach($this->procName as $v){
                if($v){
                    $ids = GetProcessIds($v);
                    if($ids){
                        $this->list = array_merge($this->list, $ids);
                    }
                }
            }
        }else
            $this->list = GetProcessIds($this->procName);
    }
}

class processListAll extends processListEach{ 
    function __construct(){
        $this->update();
    }
    
    function update(){
        $this->list = array_keys(GetProcessesList());
    }
}

function processEach($procName, Closure $func){
    $obj = new processList($procName);
    $obj->each($func);
    unset($obj);
}

function processEachAll(Closure $func){
    $obj = new processListAll;
    $obj->each($func);
    unset($obj);
}

?>