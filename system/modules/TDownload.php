<?

DSApi::reg_eventType('oncomplete','TDownload::callComplete',array('self','html'),'TDownload');
DSApi::reg_eventType('onerror','TDownload::callError',array('self','error'),'TDownload');
DSApi::reg_eventType('ondownload','TDownload::callDownload',array('self','pos','max'),'TDownload');


class TDownload extends __TNoVisual {
    
    public $class_name_ex = __CLASS__;
    
    #url
    #path
    #athread
    #id_Var
    #buffer
    
    public function __construct($onwer=nil,$init=true,$self=nil){
	parent::__construct($onwer, $init, $self);
  
        if ($init){
	    $this->priority = tpIdle;
            $this->buffer   = 4096;
	}
    }
    
    static function callComplete($self, $html){
	
        DSApi::callEvent($self, array('html'=>$html), 'OnComplete');
    }
    
    static function callError($self, $err){
        DSApi::callEvent($self, array('error'=>$err), 'OnError');
    }
    
    static function callDownload($self, $pos, $max){
        DSApi::callEvent($self, array('pos'=>$pos,'max'=>$max), 'OnDownload');
    }
    
    static function fileInfo($fp){
        //$fp = fopen($path,"r");
        $inf = stream_get_meta_data($fp);
           
        $result = array();
        foreach($inf["wrapper_data"] as $i=>$v){
            $v = explode(":",$v);
            array_map('trim', $v);
            $v[0] = strtolower($v[0]);
            
            if ($v[0]=="location"){
                
                $result['location'] = trim(str_ireplace('location:','',$inf["wrapper_data"][$i]));
            }
            if ($v[0]=="content-length"){
                $result['size'] = $v[1];
            }
        }
        
        if (!$result['location'])
            $result['location'] = $inf['uri'];
                
        return $result;
    }

    static function loadForObject($self, $filename, $to_del = false, $th = false){
	
	if ( $th ){
	    sync('TDownload::loadForObject', array($self, $filename, $to_del));
	    return;
	}
	
	$self = c($self);
	$obj = $self->setObject;
	if ($obj){
	    $obj = c($obj);
	    if ($obj instanceof TImage){
		$obj->picture->loadFromFile($filename);
	    } else {
		if ($obj instanceof TDataVar)
		    $obj->value = $data;
		else
		    $obj->text = $data;
	    }
	}
    }

    static function loadForProgress($self, $progress, $pos, $max, $th = false){
	
	
	if (!$progress) return;
	
        
	if ( $th ){
	    sync('TDownload::loadForProgress', array($self, $progress, $pos, $max));
	    //return $th->syncFull('', $self, $progress, $pos, $max);
            return;
	}

	$self = _c($self);
	
	if (function_exists($progress))
	    ;
	else
	    $progress = c($progress, 1);
	    
	if (is_object($progress)){
	    $progress->max      = $max;
	    $progress->position = $pos;
	} elseif (function_exists($progress)){
	    
	    $progress($pos, $max, $self);
	}
    }
    
    static function _endDownload($self){
	
	$obj = c($self);
	$obj->isStop = false;
	$obj->isBusy = false;
    }
    
    static function _start($self = false, $props = array(), $th = false){
        
        $st_err = err_status(false);
        
        $obj = c($self,0);
        $url = $props['url'];	
        $path     = $props['path'];
        $buffer   = $props['buffer'];
	
	
	if (!trim($path)){
	    $path = TEMP_DIR.'/devels/';
	}
        
        $url = trim($url);	
	$fh = fopen($url, "r");
	
	if (err_last()){
            
            if ($props['onerror']){
                $err = err_msg();
		syncEx($props['onerror'], array($self, $err));
            }
            
            err_status($st_err);
	    syncEx('TDownload::_endDownload', array($self));
            return;
        }
        
	$info = self::fileInfo($fh);        
        
        if (!$info['location']) $info['location'] = basename($url);
        
        $filename = replaceSl( $path . basename($info['location']) );
        
        if (!is_dir(dirname($filename)))
            mkdir( dirname($filename), 0777, true );
	    
	$obj->fileName = $filename;
        
        $fs = fopen( trim($filename), "w");
        $pos = 0;	
	
        while(($str = fread($fh, (int)$buffer)) != null){
            
            $pos += strlen($str);
            
            if ($pos>$info['size']){
                $pos = $info['size'];
            }    
            
	    TDownload::loadForProgress($self, $props['setprogress'], $pos, $info['size'], $th);
	    
            if ($props['ondownload'])
		syncEx($props['ondownload'], array($self, $pos, $info['size']));
		
            if ($obj->isStop){
                break;
            }
            
            fwrite($fs, $str);
        }
    
	err_status($st_err);
	   
        if (err_msg() || ($pos!=$info['size'] && !$obj->isStop)){
            
            if ($props['onerror'])
		syncEx($props['onerror'], array($self, err_msg() ? err_msg() : 'error donwload'));
	    
        } else {
	    
            $st_err = err_status(false);
            fclose($fs);            
            err_status($st_err);
            
	    TDownload::loadForObject($self, $filename, !trim($props['path']), $th);
	    
	    if ($props['oncomplete'] && !$obj->isStop && $pos>=$info['size'])
		syncEx($props['oncomplete'], array($self, file_get_contents($filename)));
        }
	
	syncEx('TDownload::_endDownload', array($self));
    }
    
    static function _startThread($self){
	
	$th = TThread::get($self);
	TDownload::_start($th->realSelf, $th->myprops, $th);
    }
    
    function start(){
        
	if ( $this->isBusy )
	    return;
	
	$this->isStop = false;
	$this->isBusy = true;
        if ($this->thread){
            
	    $th = new TThread('TDownload::_startThread');
	    $this->thread = $th->self;
	    
	    $th->realSelf = $this->self;
	    $th->myprops    = TComponent::__getPropExArray($this->self);
	    
	    $th->resume();         
            
        } else {
            TDownload::_start($this->self, TComponent::__getPropExArray($this->self));
        }
    }
    
    function stop(){
	if ($this->isBusy)
	    $this->isStop = true;
    }
}
?>