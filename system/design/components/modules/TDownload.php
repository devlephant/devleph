<?

DSApi::reg_eventType('oncomplete','TDownload::callComplete',['self','html'],'TDownload');
DSApi::reg_eventType('onerror','TDownload::callError',['self','error'],'TDownload');
DSApi::reg_eventType('ondownload','TDownload::callDownload',['self','pos','max'],'TDownload');


class TDownload extends __TNoVisual {
    
    #url
    #path
    #athread
    #id_Var
    #buffer
    
    public function __construct($onwer=nil,$self=nil){
	parent::__construct($onwer,$self);
  
        if ($self==nil){
			$this->priority = tpIdle;
			$this->buffer   = 4096;
		}
    }
    
    static function callComplete($self, $html){
	
        DSApi::callEvent($self, ['html'=>$html], 'OnComplete');
    }
    
    static function callError($self, $err){
        DSApi::callEvent($self, ['error'=>$err], 'OnError');
    }
    
    static function callDownload($self, $pos, $max){
        DSApi::callEvent($self, ['pos'=>$pos,'max'=>$max], 'OnDownload');
    }
    
    static function fileInfo($fp){
        $inf = stream_get_meta_data($fp);
           
        $result = [];
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
	    sync('TDownload::loadForObject', [$self, $filename, $to_del]);
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
	    sync('TDownload::loadForProgress', [$self, $progress, $pos, $max]);
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
    
    static function _start($self = false, $props = [], $th = false){
        
        $st_err = dsErrorDebug::ErrStatus(false);
        
        $obj = c($self,0);
        $url = $props['url'];	
        $path     = $props['path'];
        $buffer   = $props['buffer'];
	
	
	if (!trim($path)){
	    $path = DOC_ROOT . '/download/';
	}
        
        $url = trim($url);	
	$fh = fopen($url, "r");
	
	if (dsErrorDebug::getLastMsg()){
            
            if ($props['onerror']){
                $err = dsErrorDebug::getLastMsg();
		syncEx($props['onerror'], [$self, $err]);
            }
            
            dsErrorDebug::ErrStatus($st_err);
	    syncEx('TDownload::_endDownload', [$self]);
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
	
        while(($str = fread($fh, (int)$buffer)) !== null){
            
            $pos += strlen($str);
            
            if ($pos>$info['size']){
                $pos = $info['size'];
            }    
            
	    TDownload::loadForProgress($self, $props['setprogress'], $pos, $info['size'], $th);
	    
            if ($props['ondownload'])
		syncEx($props['ondownload'], [$self, $pos, $info['size']]);
		
            if ($obj->isStop){
                break;
            }
            
            fwrite($fs, $str);
        }
    
	dsErrorDebug::ErrStatus($st_err);
	   
        if (dsErrorDebug::getLastMsg() || ($pos!==$info['size'] && !$obj->isStop)){
            
            if ($props['onerror'])
		syncEx($props['onerror'], [$self, dsErrorDebug::getLastMsg() ? dsErrorDebug::getLastMsg() : 'error donwload']);
	    
        } else {
	    
            $st_err = dsErrorDebug::ErrStatus(false);
            fclose($fs);            
            dsErrorDebug::ErrStatus($st_err);
            
	    TDownload::loadForObject($self, $filename, !trim($props['path']), $th);
	    
	    if ($props['oncomplete'] && !$obj->isStop && $pos>=$info['size'])
		syncEx($props['oncomplete'], [$self, file_get_contents($filename)]);
        }
	
	syncEx('TDownload::_endDownload', [$self]);
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