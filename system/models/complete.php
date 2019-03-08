<?



class myComplete {
    
    
    static function updateComponentList(){
        
        $combo = c('fmPHPEditor->c_component');
        $text = array();
        
        $forms = myProject::getFormsObjects();
        foreach($forms as $form=>$list){
            
            $text[] = $form;
            
            foreach($list as $obj){
                $text[] = '...' . $obj['NAME'];
            }
        }
        
        $combo->text = $text;
    }
    
    
    static function init(){
        
        global $myComplete, $synComplete, $synHint, $phpMemo, $completeList,
                $showHint, $showComplete;
                	c('fmLogoin->label5')->caption = 'Initializing... 83%';
        $synComplete = c('fmPHPEditor->synComplete');
        $synHint     = c('fmPHPEditor->synHint');
        $phpMemo     = c('fmPHPEditor->memo');
        $phpMemo->onKeyDown = 'myComplete::memoKeyUp';
        $phpMemo->onKeyPress= 'myComplete::memoKeyPress';
        
        $synComplete->onClose='myComplete::synClose';
        $synHint->onClose    ='myComplete::synClose';
        
        c('fmPHPEditor->hide_err_list')->onClick = 'myComplete::hideErrors';
        
        $myComplete = new myComplete;
        	c('fmLogoin->label5')->caption = 'Initializing... 87%';
        $dir = DOC_ROOT . '/design/complete/';
        $completes = findDirs($dir);
        foreach ($completes as $code){
            
            $i_dir = $dir . $code . '/';
            
            if (!file_exists($i_dir . 'info.php')) continue;
            $info  = include $i_dir . 'info.php';
            $info['CODE'] = $code;
            if (file_exists($i_dir . 'class.php')){
                include $i_dir . 'class.php';
                
                $class = 'complete_' . $code;
                if (method_exists($class, 'init'))
                    call_user_func($class . '::init');
            }
            $completeList[] = $info;
        }
        	
        // сортируем весь массив по полю СОРТ
        BlockData::sortList($completeList, 'SORT');
        
		c('fmLogoin->label5')->caption = 'Initializing... 100%';
        Timer::setInterval('myComplete::checkInline', 100);
    }
    
    static function saveCode(){
        
        global $completeList, $phpMemo;
        $code = $phpMemo->text;
        
        foreach ($completeList as $complete){
            
            $class = 'complete_'.$complete['CODE'];
            if (method_exists($class, 'saveCode'))
                call_user_func($class . '::saveCode', $code);
        }
    }
	static function findSymbol($text, $symbol){
		for($i=0;$i<strlen($text);$i++)
			if($text[$i]==$symbol) return true;
			
		return false;
	}
	static function findSymbolPos($text, $symbol){
		for($i=0;$i<strlen($text);$i++)
			if($text[$i]==$symbol) return $i;
			
		return false;
	}
	static function isDublicate($text, $symbol, $ignore=array(" ", "	")){
		if(!$text or $text=="") return false;
		for($i=0;$i<strlen($text);$i++) {
			if(!in_array($text[$i], $ignore) && $text[$i]==$symbol) return true;
			if(!in_array($text[$i], $ignore) && $text[$i]!==$symbol) return false;
		}
		return false;
	}
    static function memoKeyUp($self, &$key, $shift){
		if( (bool)(int)myOptions::get('prefs','complete_actskeys', "0") ){
		if( $key == 13 || $key==114){
			
			//c( $self )->BeginUndoBlock();
			$CaretY = gui_propGet($self, 'CaretY') - 1;
			$CaretX = gui_propGet($self, 'CaretX') - 1;
			$line = c( $self )->items->getLine($CaretY);
			$length = strlen($line) - strlen( substr($line, 0, $CaretX) );
			if( myComplete::findSymbol( substr($line, 0, $CaretX), "{") && myComplete::findSymbol(substr($line, $CaretX, $length), "}") ) {
				$spos = myComplete::findSymbolPos(substr($line, $CaretX, $length), "}");
				$str1 = substr($line, $CaretX, $length);
				$str = substr($str1, 0, $spos);
				$Array = c( $self )->items->get_lines();
				$arr[0] = array_slice($Array, 0, $CaretY);
				$arr[1][0] = substr($line, 0, $CaretX);
				$arr[1][1] = "	".$str;
				$arr[1][2] = "}".substr($str1, $spos+1, $length);
				$arr[2] = array_slice($Array, $CaretY+1, count($Array));
				
				c( $self )->items->setArray( array_merge($arr[0], $arr[1], $arr[2]) );
		        /*
				c( $self )->items->setLine($CaretY,  substr($line, 0, $CaretX)); 
				c( $self )->items->setLine($CaretY+1,  "	".$str );
			
				c( $self )->items->setLine($CaretY+2, "}".substr($str1, $spos+1, $length) );//*/
				//c( $self )->EndUndoBlock();
				//c( $self )->BeginUndoBlock();
				gui_propSet($self, 'CaretY', $CaretY + 2);
				gui_propSet($self, 'CaretX', 2);
				//c( $self )->EndUndoBlock();
			
			$key=null;
			}
		}
		if( $key == 27 ){
			c("fmPHPEditor")->close();
			c("fmPHPEditor")->ModalResult = 2;
		}
        }
		global $phpMemo, $synComplete, $synHint;
        $phpMemo->onChange = 'myComplete::memoChange';
        unset($GLOBALS['__find']);
        unset($GLOBALS['__findIndex']);
		
    }
	static function checkDublicate($self, $key){
		$CaretY = gui_propGet($self, 'CaretY') - 1;
		$CaretX = gui_propGet($self, 'CaretX') - 1;
		$line = c( $self )->items->getLine($CaretY);
		$length = strlen($line) - strlen( substr($line, 0, $CaretX) );
		
		switch($key){
		case "{":{ return false; }break;
		case "[":{ return myComplete::isDublicate(substr($line, $CaretX, $length), "]"); }break;
		case ")":{ return myComplete::isDublicate(substr($line, $CaretX, $length), ")"); }break;
		case "(":{ return myComplete::isDublicate(substr($line, $CaretX, $length), ")"); }break;
		case "]":{ return myComplete::isDublicate(substr($line, $CaretX, $length), "]"); }break;
		case '"':{ 
		$text = strtolower(substr($line, $CaretX, $length));
		for($i=0;$i<strlen($text);$i++) {
			if($text[$i]==$symbol) return true;
		}
		}break;
		}
		return false;
	}
    static function memoKeyPress($self, &$key){

		$chars = array(
		'(' => ')',
		'{' => '}',
		'[' => ']',
		'"' => '"',);
		if( (bool)(int)myOptions::get('prefs','complete_chars', "0") )
		{
		if( isset($chars[$key]) ) {
			//c( $self )->BeginUndoBlock();
			$CaretY = gui_propGet($self, 'CaretY') - 1;
			$CaretX = gui_propGet($self, 'CaretX') - 1;
			$line = c( $self )->items->getLine($CaretY);
			$length = strlen($line) - strlen( substr($line, 0, $CaretX) );
			if( !myComplete::checkDublicate($self, $key) ){
			c( $self )->items->setLine($CaretY,  substr($line, 0, $CaretX) . $key.$chars[$key] . substr($line, $CaretX, $length) );
			}else{
			c( $self )->items->setLine($CaretY,  substr($line, 0, $CaretX) . $key . substr($line, $CaretX, $length) );
			}
			//c( $self )->EndUndoBlock();
			//c( $self )->BeginUndoBlock();
			gui_PropSet($self, 'CaretX', gui_propGet($self, 'CaretX') + 1);
			$key = "";
			//c( $self )->EndUndoBlock();
		}
		if( in_array($key, array(')', ']')) ) {
			if( myComplete::checkDublicate($self, $key) ) {
				//c( $self )->BeginUndoBlock();
				gui_propSet($self, gui_propGet($self, 'CaretX') + 1);
				$key = "";
				//c( $self )->EndUndoBlock();
			}
		}
		}
        global $phpMemo, $synComplete, $synHint;
		$phpMemo->onChange = 'myComplete::memoChange';
        unset($GLOBALS['__find']);
        unset($GLOBALS['__findIndex']);
    }

    static function synClose(){
        
        global $showComplete, $showHint;
        
        $showComplete = false;
        $showHint     = false;
    }
    
    static function _memoChange(){
        
        global $phpMemo, $synComplete, $synHint, $showComplete, $showHint;
        
        c('fmPHPEditor->tlCancel')->enabled = true;
        
        if ($synComplete->visible) return;
        $lineText = $phpMemo->lineText;
        $result = self::findComplete();    
            
        if (is_array($result)){
			if ($result['TYPE']=='HINT'){
                if (!$showHint){
                
                    $synHint->item   = (array)$result['ARR']['item'];
                    $synHint->insert = (array)$result['ARR']['insert'];
                    //c('fmPHPEditor')->formStyle = fsStayOnTop;
                    $synHint->active( /*true*/ );
                    //c('fmPHPEditor')->formStyle = fsNormal;
                    $synComplete->active(false);
                    $showHint = true;
                    $showComplete = false;
                }
            } elseif (true/*!$showComplete*/) {
                
                $synComplete->item   = (array)$result['ARR']['item'];
                $synComplete->insert = (array)$result['ARR']['insert'];
				$synComplete->active();
                $synHint->active(false);
                c('fmPHPEditor')->show();
                
                $showComplete = true;
                $showHint     = false;
            }
            
        } else {
            
            $tmp   = new complete_Funcs;
			$result['ARR'] = $tmp->getList(null);
           // $result['ARR'] = $tmp->getList('' /*$lineText*/);
            unset($tmp);
            
            $synComplete->item = $result['ARR']['item'];
            $synComplete->insert= $result['ARR']['insert'];
            
            if (!trim(self::getLastText())){
                $synComplete->active(false);
                $synHint->active(false);
            }
            
            $showComplete = false;
            $showHint     = false;
        }
        
        setTimeout(1,'global $phpMemo; $phpMemo->onChange = "_empty"');
    }
    
    static function memoChange($self){
        
        global $showHint, $showComplete, $synComplete;
        
        $showComplete = $synComplete->form->visible && $showComplete;
        if (!$showComplete){
            $showComplete = true;
            setTimeout(1, 'myComplete::_memoChange(); global $showComplete; $showComplete = false;');
        }
    }
    
    static function getLastText(){
        
        global $phpMemo;
        $lineText = $phpMemo->lineText;
        
        $lineText = ($lineText);
        $x        = $phpMemo->caretX;
        
        if ($x == 0) return false;
        if ($x-2 >= strlen($lineText)) return false;
        
        $text     = ltrim(substr($lineText, 0, $x-1));
        
        $text     = explode(' ', $text);
        $result   = $text[count($text)-1];
        
        $result   = explode(';', $result);
        $result   = $result[count($result)-1];
        
        $result   = explode('{', $result);
        $result   = $result[count($result)-1];
        
        //$result   = explode('(', $result);
       // $result   = $result[count($result)-1];
        
        $result   = explode('[', $result);
        $result   = $result[count($result)-1];
        
        return $result;
    }
    
    static function findComplete(){
        
        global $completeList;
        $text =  self::getLastText() ;
        
        foreach ($completeList as $one){
            
            if (preg_match($one['PREG'], $text)){
                $result = $one;
                break;
            }
        }
        
        if (!isset($result)) return false;
        if (!$result) return false;
		
        $class = 'complete_' . $result['CODE'];
        $tmp   = new $class;
        $result['ARR'] = $tmp->getList($text);
        unset($tmp);
        
        return $result;
    }
    
    static function fromBB($text){
        
        $text = str_ireplace('[B]','\style{+B}', $text);
        $text = str_ireplace('[/B]','\style{-B}', $text);
        $text = str_ireplace('[I]','\style{+I}', $text);
        $text = str_ireplace('[/I]','\style{-I}', $text);
        
        $text = str_ireplace(array(
                                   '[U]',
                                   '[/U]',
                                   '[$R]',
                                   '[$B]',
                                   '[$G]',
                                   '[$GR]',
                                   '[$S]',
                                   '[$BL]',
                                   ),
                             array(
                                   '\style{+U}',
                                   '\style{-U}',
                                   '\color{$CC}',
                                   '\color{clBlack}',
                                   '\color{clGreen}',
                                   '\color{clGray}',
                                   '\color{clSilver}',
                                   '\color{clBlue}',
                                   ),
                             
                             $text
                             );
        
        return $text;
    }
    
    static function checkInline(){
        
        if( !c('fmPHPEditor') ) return;
        if (!c('fmPHPEditor')->visible) return;
        
        $synComplete = c('fmPHPEditor->synComplete',1);
        
        //global $showComplete, $synComplete;
        if ($synComplete->get_empty()){
                $synComplete->active(false);
        }
    }
    
    static function checkSyntax() {
        
        if (!c('fmPHPEditor',1)->visible) return; 
                                  
        
        $phpMemo = c('fmPHPEditor->memo');
        $code    = $phpMemo->text;
        
        $checker = new PHPSyntax;
        $checker->check($code);
        $lines   = array();
        
        foreach ($checker->errors as $err){
            
            if ($err['prs'])
                $add = ' - "'. $err['prs'] . '"';
            else
                $add = '';
            
            $str = '['.$checker->errType( $err['type'] );
            if ($err['line'])
                $str .= ': '.t('line').' - '.$err['line'].date(' ( H:i');
                
            $str .= '] ' . t($err['msg']) . $add;
            $lines[] = $str;
        }
        
        $index = c('fmPHPEditor->err_list',1)->itemIndex;
        c('fmPHPEditor->err_list',1)->text = $lines;
        c('fmPHPEditor->err_list',1)->itemIndex = $index;
    }
    
    static function hideErrors($self){
        
        c('errPanel')->height = 1;
    }

}
