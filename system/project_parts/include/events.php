<?

class TEvents extends TComponent {
    
    
    
    #list[event_name] = script
    #component_link = <number link>
    
    public function get_text(){ return tevent_text($this->self, null); }
    public function set_text($v){ tevent_text($this->self, $v); }
    
    function get_list(){ return unserialize(base64_decode($this->get_text()));}
    function set_list($arr){ $this->set_text ( base64_encode(serialize($arr)) ); }
    
    function getEvent($name){
        $name = strtolower($name);
        $arr = $this->list;
        return $arr[$name];
    }
    function eventList(){
        $arr = $this->list;
        return array_keys((array)$arr);
    }  
    static function listEvents($obj, $form){
        $event = self::searchEvent($obj, $form);
        $arr = $event->list;
        return array_keys((array)$arr);
    }
}

class eventEngine {
    
    static $DATA;
    static $form;
    
    static function dataToLower(){
        
        foreach (self::$DATA as $form=>$obj){
            
            if (strtolower($form)!==$form){
                
                self::$DATA[strtolower($form)] = self::$DATA[$form];
                unset(self::$DATA[$form]);
            }
        }
        
        foreach (self::$DATA as $form=>$objs){
            
            foreach ($objs as $obj=>$list){
                
                if (strtolower($obj)!==$obj){

                    self::$DATA[$form][strtolower($obj)] = self::$DATA[$form][$obj];
                    
                    unset(self::$DATA[$form][$obj]); 
                } elseif (strtolower($obj)=='fmedit'){
                    
                    self::$DATA[$form]['--fmedit'] = self::$DATA[$form][$obj];
                    unset(self::$DATA[$form][$obj]); 
                }
            }
        }
    }
    
    static function setForm($form = false){
        
        global $_FORMS, $formSelected;
        
        if ($form)
            self::$form = strtolower($form);
        else
            self::$form = strtolower($_FORMS[$formSelected]);
    }
    
    static function getEvent($object, $type){
        $type = strtolower($type);
        return self::$DATA[strtolower(self::$form)][strtolower($object)][strtolower($type)];
    }
    
    static function setEvent($object, $type, $value, $upd=true){
        $type = strtolower($type);
        self::$DATA[strtolower(self::$form)][strtolower($object)][strtolower($type)] = $value;
		if($upd)
		myHistory::addEvent($name, $type, $value);
    }
    
    static function copyEvent($original, $new, $type = false){
        
        $type = strtolower($type);
        $new  = strtolower($new);
        $original  = strtolower($original);
        if ($type)
            self::$DATA[self::$form][$new][$type] = self::$DATA[(self::$form)][($original)][$type];
        else
            self::$DATA[self::$form][$new] = self::$DATA[(self::$form)][($original)]; 
    }
    
    static function changeEvent($object, $type, $new){
        
        $type = strtolower($type);
        $new  = strtolower($new);
        $object  = strtolower($object);
        self::$DATA[(self::$form)][($object)][$new] =
                self::$DATA[(self::$form)][($object)][$type];
        unset(self::$DATA[(self::$form)][$object][$type]);
    }
    
    static function delEvent($object, $type = false, $up=true){
        
        $type	= strtolower($type);
        $object	= strtolower($object);
		if(isSet(self::$DATA[self::$form][$object])) 
		{
			if ($type)
			{
				if($up)
					myHistory::addEvent( $object, $type, self::$DATA[self::$form][$object][$type] );
				unset(self::$DATA[self::$form][$object][$type]);
			} else
			{
				if($up)
					foreach( self::$DATA[self::$form][$object] as $type=>$data )
					myHistory::addEvent($object, $type, $data);
				unset(self::$DATA[self::$form][$object]);
			}
		}
    }
    
    static function changeName($object, $new){
        
        if ($object==$new) return;
        self::copyEvent($object, $new);
        self::delEvent($object);
    }
    
    static function eventList($object){
        
		if( !isset(self::$DATA[strtolower(self::$form)][strtolower($object)]) ) return [];
        return array_keys((array)self::$DATA[strtolower(self::$form)][strtolower($object)]);
    }
    
    static function listEvents($obj){
        
        return self::eventList($obj);
    }
    
    static function listEventsEx($obj){
        
        $result = [];
        $events = self::listEvents($obj);
		
		if(is_array($events))
			foreach ($events as $i=>$ev)
				$result[] = t($ev);
				
        return $result;
    }
    
    static function updateIndexes(){
        
        global $fmEdit;
        
        self::$DATA['--indexes'][self::$form] = [];
        foreach ((array)self::$DATA[self::$form] as $obj_name=>$code){
            
            if ($obj_name == '--fmedit')
                self::$DATA['--indexes'][self::$form][$obj_name] = -1;
            else
                self::$DATA['--indexes'][self::$form][$obj_name] = $fmEdit->findComponent($obj_name)->componentIndex;
        }
    }
    
    static function updateIndex($obj){
        
        self::$DATA['--indexes'][_c($obj->owner)->name][$obj->name] = $obj->componentIndex;
    }
}


$GLOBALS['__exEvents'] = [];
function setEchoController($obj_or_func){ DSApi::echoController($obj_or_func); }
DSApi::echoController(false);

    function setEvetFromFunction($obj, $event, $function){
        
        if (function_exists($function))
            $obj->$event = $function;
        else
            $obj->$event = '__callFunction("'.$function.'",'.$obj->self.'); _empty';
    }

class __exEvents {
    private static $res_string;
	private static $to_store;
    static function setEchoController($obj_or_func){
        
        $GLOBALS['__echoController'] = $obj_or_func;
    }
    
	static function echo_handler($s, $type)
	{
		switch($type)
		{
			case 3:
			{
				$stbefore = self::$to_store;
				self::$to_store = true;
				if( $stbefore )
				{
					gui_message( self::$res_string );
					self::$res_string = '';
				}
			}break;
			case 2:
			{
				if( self::$to_store )
				{
					self::$res_string .= $s;
					return;
				}
			}break;
			case 4:
			{
				self::$to_store = false;
				$s = self::$res_string;
				self::$res_string = '';
			}break;
		}
		if( is_string($s) )
				if( !strlen($s) ) return;
		$controller = $GLOBALS['__echoController'];
		 if (is_numeric($controller)) $controller = c($controller);
			
		 if ($controller)
		 {
			if (is_object($controller)){
				
				if ($controller instanceof TChromium)
					$controller->html .= $s;
				else
					$controller->text .= $s;
				
			} elseif (is_callable($controller)){
					call_user_func($controller, $s);
			}
		} else {
		
			if( is_object($s) &&  method_exists($s, '__toString()') ){
				$s = (string) $s;
			}
			gui_message( obsafe_print_r($s, true) );
		}
	}
    static function addGlobalVar($name){
        
        if ($name[0]!=='$')
        $name = '$'.$name;
        
        if ($GLOBALS['__addIncCode']){
            $last_str = 'global ' . implode(', ', (array)$GLOBALS['__addIncCode']);
            $GLOBALS['__addIncCode'][] = $name;
            $GLOBALS['__addIncCode'] = array_unique($GLOBALS['__addIncCode']);
            $str = 'global ' . implode(', ', $GLOBALS['__addIncCode']).';';
            enc_setValue('__incCode',str_replace($last_str, $str, enc_getValue('__incCode')));
        } else {
            
            $GLOBALS['__addIncCode'][] = $name;
            $GLOBALS['__addIncCode'] = array_unique($GLOBALS['__addIncCode']);
            $str = 'global ' . implode(', ', $GLOBALS['__addIncCode']).';';
            
            enc_setValue('__incCode', enc_getValue('__incCode').$str);
        }
        
    }
    
    static function getEventInfo($self){
        
        return $GLOBALS['__exEvents'][$self]['obj_name'];
    }
    
    static function setEventInfo($self, $event){
        
        global $__eventInfo;
    
        $__eventInfo['obj_name'] = $GLOBALS['__exEvents'][$self]['obj_name'];
        $__eventInfo['name']     = $event;
        $__eventInfo['self']     = $self;
        
        $GLOBALS['__ownerComponent_last'][] = $GLOBALS['__ownerComponent'];
        
        if (gui_is($self, 'TForm'))
            $GLOBALS['__ownerComponent'] = $self;
        else
            $GLOBALS['__ownerComponent'] = gui_owner($self);
        
        ob_start('__exEvents::echo_handler', PHP_OUTPUT_HANDLER_CONT);
    }
    
    static function freeEventInfo(){
        
        ob_end_flush();

        
        $GLOBALS['__ownerComponent'] = $GLOBALS['__ownerComponent_last'][count($GLOBALS['__ownerComponent_last'])-1];
        unset($GLOBALS['__ownerComponent_last'][count($GLOBALS['__ownerComponent_last'])-1]);
        $GLOBALS['__ownerComponent_last'] = array_values($GLOBALS['__ownerComponent_last']);
        
        unset($GLOBALS['__eventInfo']);
    }
    
    static function runCode($code, $self){
		return eval( enc_getValue('__incCode') . $code);
    }
    
    static function runCodeEx($script){
        
        eval($script);
    }
    
    static function getEvent($self, $name){
            return $GLOBALS['__exEvents'][$self]['events'][strtolower($name)];
    }
    
    static function callCode($_self, $_eventName){
        $self   = c($_self);
        self::setEventInfo($_self, $_eventName);
        eval( enc_getValue('__incCode') );
        eval( self::getEvent($_self,$_eventName) );
        self::freeEventInfo();
    }
	
	static function callCodeHitTest($_self, &$HitResult, $_eventName)
	{
        $self   = c($_self);
        self::setEventInfo($_self, $_eventName);
        eval( enc_getValue('__incCode') );
        eval( self::getEvent($_self,$_eventName) );
        self::freeEventInfo();
    }
	
	static function callCodeBrushSet($_self, $brush, &$continue, $_eventName)
	{
        $self   = c($_self);
        self::setEventInfo($_self, $_eventName);
        eval( enc_getValue('__incCode') );
        eval( self::getEvent($_self,$_eventName) );
        self::freeEventInfo();
    }
	static function callCodeFontSet($_self, $font, &$continue, $_eventName)
	{
        $self   = c($_self);
        self::setEventInfo($_self, $_eventName);
        eval( enc_getValue('__incCode') );
        eval( self::getEvent($_self,$_eventName) );
        self::freeEventInfo();
    }
	
	static function callCodePenSet($_self, $pen, &$continue, $_eventName)
	{
        $self   = c($_self);
        self::setEventInfo($_self, $_eventName);
        eval( enc_getValue('__incCode') );
        eval( self::getEvent($_self,$_eventName) );
        self::freeEventInfo();
    }
    
    static function callCodeKey($_self, &$key, $shift, $_eventName){
        
        $self   = c($_self); $shift  = explode(',', $shift);
        
        self::setEventInfo($_self, $_eventName);
		eval( self::getEvent($_self,$_eventName) );
        
        self::freeEventInfo();
    }
    
    static function callCodeKeyPress($_self, &$key, $shift, $_eventName){
        
        $self   = c($_self); $shift  = explode(',', $shift);
        
        self::setEventInfo($_self, $_eventName);
        
        eval( enc_getValue('__incCode') );
        eval( self::getEvent($_self,$_eventName) );    
        self::freeEventInfo();
    }
    
    static function callCodeCloseQuery($_self, &$canClose, $_eventName){
        
        $self   = c($_self);
        
        self::setEventInfo($_self, $_eventName);
        eval( enc_getValue('__incCode') );
        eval( self::getEvent($_self,$_eventName) );
        self::freeEventInfo();
    }
    
    
    static function callCodeSelect($self, $value, $_eventName){
        
        $self   = c($_self);
        
        self::setEventInfo($_self, $_eventName);
        eval( enc_getValue('__incCode') );
        eval( self::getEvent($_self,$_eventName) );
        self::freeEventInfo();
    }
    
    static function callCodeScroll($_self, $scrollCode, &$scrollPos, $_eventName){
        
        $self   = c($_self);
        
        self::setEventInfo($_self, $_eventName);
        eval( enc_getValue('__incCode') );
        eval( self::getEvent($_self,$_eventName) );
        self::freeEventInfo();
    }
    
    static function callCodeMouse($_self, $button, $shift, $x, $y, $_eventName){
        
        $self   = c($_self); $shift  = explode(',', $shift);
        
        self::setEventInfo($_self, $_eventName);
        eval( enc_getValue('__incCode') );
        eval( self::getEvent($_self,$_eventName) );
        self::freeEventInfo();
    }
    
    static function callCodeMouseMove($_self, $shift, $x, $y, $_eventName){
        
        $self   = c($_self); $shift  = explode(',', $shift);
        
        self::setEventInfo($_self, $_eventName);
        eval( enc_getValue('__incCode') );
        eval( self::getEvent($_self,$_eventName) );
        self::freeEventInfo();
    }
    
    static function callEventEx($_self, $_params, $_eventName){
        
        foreach($_params as $_x_name => $_value){
            $$_x_name = $_value;
        }
        
        $self = _c($_self);
        self::setEventInfo($_self, $_eventName);
        eval( enc_getValue('__incCode') );
        eval( self::getEvent($_self,$_eventName) );
        self::freeEventInfo();
    }
    
    static function callEventVars($_self, &$_params, $_eventName){
        
        foreach($_params as $_x_name => &$_value){
            $$_x_name =& $_value;
        }
        
        $self = _c($_self);
        self::setEventInfo($_self, $_eventName);
        eval( enc_getValue('__incCode') );
        eval( self::getEvent($_self,$_eventName) );
        self::freeEventInfo();
    }
    
    static function OnExecute($__self, $__names){
        
        $__args = func_get_args();
        
        unset($__names[0],$__names[1], $__args[0], $__args[1]);
        
        $__names = array_values($__names);
        $__args  = array_values($__args);
        
        foreach ($__names as $__i=>$__var){
            $__var  = str_replace('$','',$__var);
            
            $$__var = $__args[$__i];
        }
        
        $__script = self::getEvent($__self,'OnExecute');
        
        self::setEventInfo($__self, $__name);
        
            eval( enc_getValue('__incCode') );
            $res = eval( self::getEvent($_self,$_eventName) );
            
        self::freeEventInfo();
            
        return $res;
    }
    
    static function OnActivate($self){ self::callCode($self, __FUNCTION__); }
    static function OnDeactivate($self){ self::callCode($self, __FUNCTION__); }
    static function onChromiumLibLoad($self){ self::callCode($self, __FUNCTION__); }
    
    static function OnStartTrack($self){ self::callCode($self, __FUNCTION__); }
    static function OnEndTrack($self){ self::callCode($self, __FUNCTION__); }
    static function OnTimer($self){ self::callCode($self, __FUNCTION__); }
    static function OnStart($self){ self::callCode($self, __FUNCTION__); }
    static function OnClick($self){ self::callCode($self, __FUNCTION__); }
    static function OnChange($self){ self::callCode($self, __FUNCTION__); }
    static function OnCreate($self){ self::callCode($self, __FUNCTION__); }
    static function OnDestroy($self){ self::callCode($self, __FUNCTION__); }
	static function OnBrushSet($self,$brush,&$continue)
	{
		self::callCodeBrushSet($self, new TBrush(nil,false,$brush), $continue, __FUNCTION__);
	}
	static function OnFontSet($self,$font,&$continue)
	{
		self::callCodeFontSet($self, new TFont(nil,false,$font), $continue, __FUNCTION__);
	}
	static function OnPenSet($self,$pen,&$continue)
	{
		self::callCodePenSet($self, new TPen(nil,false,$pen), $continue, __FUNCTION__);
	}
	static function OnHitTest($self,&$HitResult)
	{
		self::callCodeHitTest($self, $HitResult, __FUNCTION__);
	}
	static function OnBrushChage($self){ self::callCode($self, __FUNCTION__); }
	static function OnFontChage($self){ self::callCode($self, __FUNCTION__); }
	static function OnPenChage($self){ self::callCode($self, __FUNCTION__); }
    static function OnDblClick($self){ self::callCode($self, __FUNCTION__); }
    static function OnClose($self){ self::callCode($self, __FUNCTION__); }
    static function OnPaint($self){ self::callCode($self, __FUNCTION__); }
    static function OnResize($self){ self::callCode($self, __FUNCTION__); }
    static function OnShow($self){ self::callCode($self, __FUNCTION__); }
    static function OnSetCursor($self){ self::callCode($self, __FUNCTION__); }
    static function OnSelect($self){ self::callCode($self, __FUNCTION__); }

    static function OnFocus($self){ self::callCode($self, __FUNCTION__); }
    static function OnBlur($self){ self::callCode($self, __FUNCTION__); }
    
    static function OnCloseQuery($self, &$canClose){ self::callCodeCloseQuery($self, $canClose, __FUNCTION__); }
    
    static function OnScroll($self, $scrollCode, &$scrollPos){ self::callCodeScroll($self, $scrollCode, $scrollPos, __FUNCTION__); }
     static function OnScrollVert($self, $scrollCode, &$scrollPos){ self::callCodeScroll($self, $scrollCode, $scrollPos, __FUNCTION__); }
     static function OnScrollHorz($self, $scrollCode, &$scrollPos){ self::callCodeScroll($self, $scrollCode, $scrollPos, __FUNCTION__); }
    
    static function OnSelectDialog($self, $value){
        self::callCodeSelect($self, $value, __FUNCTION__);
    }
    
    static function OnMouseEnter($self){ self::callCode($self, __FUNCTION__); }
    static function OnMouseLeave($self){ self::callCode($self, __FUNCTION__); }
    
    static function OnKeyDown($self, &$key, $shift){
        self::callCodeKey($self, $key, $shift, __FUNCTION__);
    }
    
    static function OnKeyUp($self, &$key, $shift){
        self::callCodeKey($self, $key, $shift, __FUNCTION__);
    }
    
    static function OnKeyPress($self, &$key){
        self::callCodeKeyPress($self, $key, 0, __FUNCTION__);
    }
    
    static function OnMouseDown($self, $button, $shift, $x, $y){
        self::callCodeMouse($self, $button, $shift, $x, $y, __FUNCTION__);
    }
    
    static function OnMouseUp($self, $button, $shift, $x, $y){
        self::callCodeMouse($self, $button, $shift, $x, $y, __FUNCTION__);
    }
    
    static function OnMouseMove($self, $shift, $x, $y){
        self::callCodeMouseMove($self, $shift, $x, $y, __FUNCTION__);
    }
    
    static function OnBeforeBrowse($_self, $url, $method, $navType, $isRedirect, &$continue){
        
        $self   = c($_self);
        
        self::setEventInfo($_self, __FUNCTION__);
            eval( enc_getValue('__incCode') );
            $res = eval( self::getEvent($_self,__FUNCTION__) );
        self::freeEventInfo();
    }
    
    static function OnBeforePopup($_self, $url, &$continue){
        
        $self   = c($_self);
        
        self::setEventInfo($_self, __FUNCTION__);
            eval( enc_getValue('__incCode') );
            $res = eval( self::getEvent($_self,__FUNCTION__) );
        self::freeEventInfo();
    }
    
    static function OnBeforeMenu($_self, $x, $y, $linkUrl, $imageUrl, $pageUrl, $frameUrl, $selectText, &$continue){
        
        $self   = c($_self);
        
        self::setEventInfo($_self, __FUNCTION__);
            eval( enc_getValue('__incCode') );
            $res = eval( self::getEvent($_self,__FUNCTION__) );
        self::freeEventInfo();
    }
    
    static function OnAuthCredentials($_self, $isProxy,$port,$host,$realm,$scheme,$username,$password,&$continue){
        
        $self   = c($_self);
        
        self::setEventInfo($_self, __FUNCTION__);
            eval( enc_getValue('__incCode') );            
            $res = eval( self::getEvent($_self,__FUNCTION__) );
        self::freeEventInfo();
    }
    
    static function OnGetDownloadHandler($_self, $url, $mimeType, $fileName, $contentLength, &$continue){
        
        $self   = c($_self);
        
        self::setEventInfo($_self, __FUNCTION__);
            eval( enc_getValue('__incCode') );            
            $res = eval( self::getEvent($_self,__FUNCTION__) );
        self::freeEventInfo();
    }
    
    static function OnConsoleMessage($_self, $message, $source, $line, &$continue){
        
        $self   = c($_self);
        self::setEventInfo($_self, __FUNCTION__);
            eval( enc_getValue('__incCode') );            
            $res = eval( self::getEvent($_self,__FUNCTION__) );
        self::freeEventInfo();
    }
    
    static function OnLoadStart($_self){
        
        self::callCode($_self, __FUNCTION__);
    }
    
    static function OnLoadEnd($_self, $httpStatus, &$continue){
        
        $self   = c($_self);
        
        self::setEventInfo($_self, __FUNCTION__);
            eval( enc_getValue('__incCode') );            
            $res = eval( self::getEvent($_self,__FUNCTION__) );
        self::freeEventInfo();
    }
    
    static function OnLoadError($_self, $errorCode, $failedUrl, $errorText, &$continue){
        
        $self   = c($_self);
        
        self::setEventInfo($_self, __FUNCTION__);
            eval( enc_getValue('__incCode') );            
            $res = eval( self::getEvent($_self,__FUNCTION__) );
        self::freeEventInfo();
    }
    
    static function OnStatusMessage($_self, $value, $status, &$continue){
        
        $self   = c($_self);
        
        self::setEventInfo($_self, __FUNCTION__);
            eval( enc_getValue('__incCode') );            
            $res = eval( self::getEvent($_self,__FUNCTION__) );
        self::freeEventInfo();
    }
    
    static function OnAddressChange($_self, $url){
        
        $self   = c($_self);
        
        self::setEventInfo($_self, __FUNCTION__);
            eval( enc_getValue('__incCode') );            
			$res = eval( self::getEvent($_self,__FUNCTION__) );
        self::freeEventInfo();
    }
    
    static function OnTitleChange($_self, $title, &$continue){
        
        $self   = c($_self);
        
        self::setEventInfo($_self, __FUNCTION__);
            eval( enc_getValue('__incCode') );            
            $res = eval( self::getEvent($_self,__FUNCTION__) );
        self::freeEventInfo();
    }
    
    static function OnTooltip($_self, $text, &$continue){
        
        $self   = c($_self);
        
        self::setEventInfo($_self, __FUNCTION__);
            eval( enc_getValue('__incCode') );            
            $res = eval( self::getEvent($_self,__FUNCTION__) );
        self::freeEventInfo();
    }
    
    static function OnContentsSizeChange($_self, $width, $height){
        
        $self   = c($_self);
        
        self::setEventInfo($_self, __FUNCTION__);
            eval( enc_getValue('__incCode') );            
            $res = eval( self::getEvent($_self,__FUNCTION__) );
        self::freeEventInfo();
    }

    static function OnDropFiles($_self, $files, $x, $y){
        
        $files  = explode(chr(10), $files);
        $self   = c($_self);
        
        self::setEventInfo($_self, __FUNCTION__);
            eval( enc_getValue('__incCode') );
            $res = eval( self::getEvent($_self,__FUNCTION__) );
        self::freeEventInfo();
    }
}

function ___getEvent($self, $name){
    
    
    $name= strtolower($name);
        $result = ($GLOBALS['__exEvents'][$self]['events'][$name]);
    return $result;
}

DSApi::reg_eventParams('OnDblClick', ['self']);
DSApi::reg_eventParams('onKeyUp',			['self','&key','shift']);
DSApi::reg_eventParams('onKeyDown',			['self','&key','shift']);
DSApi::reg_eventParams('onKeyPress',		['self','&key']);
DSApi::reg_eventParams('onMouseDown',		['self','button','shift','x','y']);
DSApi::reg_eventParams('onMouseUp',			['self','button','shift','x','y']);
DSApi::reg_eventParams('onMouseMove',		['self','shift','x','y']);
DSApi::reg_eventParams('onMouseWheel',		['self','shift', 'wheelDelta', 'x', 'y', '&handled']);
DSApi::reg_eventParams('onCloseQuery',		['self','&canClose']);
DSApi::reg_eventParams('onScroll',			['self','scrollCode', '&scrollPos']);
DSApi::reg_eventParams('onScrollVert',			['self','scrollCode', '&scrollPos']);
DSApi::reg_eventParams('onScrollHorz',			['self','scrollCode', '&scrollPos']);

DSApi::reg_eventParams('onBeforePopup',		['self', 'url', '&continue']);
DSApi::reg_eventParams('onBeforeBrowse',	['self', 'url', 'method', 'navType', 'isRedirect', '&continue']);
DSApi::reg_eventParams('onBeforeMenu',		['self', 'x', 'y', 'linkUrl', 'imageUrl', 'pageUrl', 'frameUrl', 'selectText', '&continue']);

DSApi::reg_eventParams('OnAuthCredentials',
    ['isProxy', 'port', 'host', 'realm', 'scheme', 'username', 'password', '&continue']);

DSApi::reg_eventParams('OnGetDownloadHandler',
    ['url', 'mimeType', 'fileName', 'contentLength', '&continue']);

DSApi::reg_eventParams('OnConsoleMessage',
    ['message', 'source', 'line', '&continue']);

DSApi::reg_eventParams('OnLoadStart',		['self']);
DSApi::reg_eventParams('OnLoadEnd',['httpStatus', '&continue']);
DSApi::reg_eventParams('OnLoadError',['errorCode', 'failedUrl', 'errorText', '&continue']);
DSApi::reg_eventParams('OnStatusMessage',['value', 'status', '&continue']);

DSApi::reg_eventParams('OnAddressChange',['url']);
DSApi::reg_eventParams('OnTitleChange',['title', '&continue']);
DSApi::reg_eventParams('OnTooltip',['text', '&continue']);

DSApi::reg_eventParams('OnContentsSizeChange',['width', 'height']);

DSApi::reg_eventParams('onDropFiles',['self','files', 'x', 'y']);

DSApi::reg_eventParams('onDestroy', ['self']);
DSApi::reg_eventParams('onCreate', ['self']);
DSApi::reg_eventParams('onBrushSet', ['self','brush','&continue']);
DSApi::reg_eventParams('onFontSet', ['self','font','&continue']);
DSApi::reg_eventParams('onPenSet', ['self','pen','&continue']);
DSApi::reg_eventParams('onBrushChage', ['self']);
DSApi::reg_eventParams('onFontChage', ['self']);
DSApi::reg_eventParams('onPenChage', ['self']);

DSApi::reg_eventParams('onHitTest', ['self', '&HitResult']);
DSApi::reg_eventParams('onChromiumLibLoad', ['self']);
?>