<?

class mySyntaxCheck {
    
    static $errors;
    static $noerrors;
	public static function checkForm($form, $obj_name){
        
        $form     = strtolower($form);
        $obj_name = strtolower($obj_name);
		
        if ($form == $obj_name)
            $eventList = eventEngine::$DATA[$form]['--fmedit'];
        else
            $eventList = eventEngine::$DATA[$form][$obj_name];
		$list = c('fmMain->debugList');
        if($eventList)
        foreach ($eventList as $event=>$code){
            
            if ( !trim($code) ) continue;
			
            $GLOBALS['__error_last'] = false;
			$exp = explode(_BR_, str_replace(['\t', ' ', '/**/'], '', $code))[0];
			if( strtolower(substr($exp, 0, 9)) === 'namespace' )
			{
				$spos = stripos($exp, ';');
				$spos = $spos? $spos: stripos($exp, '\\');
				$spos = $spos? $spos-9:28;
				$err = ['msg' => 'logic error, unexpected \''.substr($exp,9, $spos) .'\' {T_NAMESPACE}', 'line'=>1, 'type'=> E_USER_ERROR];
			} else {
				eval('if(false){' . $code . _BR_ . '}');
				$err = err_last();
			}
			$exp = null;
            if (is_array($err)){ // если 
				if($obj_name==$form) $obj_name = false;
				
                self::$errors[$list->itemIndex+count(self::$errors)+1] = ['msg'=>$err['msg'], 'type'=>$err['type'],
                                        'line'=>$err['line'], 'event'=>$event,
                                        'form'=>$form, 'obj'=>$obj_name];
				$list->onClick = 'mySyntaxCheck::clickError';
				$list->onDblClick = 'mySyntaxCheck::dblClickError';
                $obj_name = $obj_name? $form .'->'. $obj_name: $form;
                
				message_beep(MB_ICONERROR);    

				myCompile::addStatus('Error', ': {'.$obj_name.', '.t($event).'}  '.$err['msg'].' '.t('on line').' '. ($err['line']));
			}
            
        }
        
    }
	
	public static function checkFile($filename)
	{
		$code = str_replace(['\t', ' ', '/**/'], ' ', file_get_contents($filename));
		 if ( !trim($code) ) return;
			
            $GLOBALS['__error_last'] = false;
			if(!stripos('!'.$code, '<?')) return;
			$code = substr($code, stripos($code,'<?')+2);
			if( strtolower(substr($code, 0, 3)) === 'php' )
				$code = substr($code, 5);
			while(substr($code, strlen($code)-2) === '?>')
			{
				$code = substr($code, 0, strlen($code)-2);
			}
			$code = str_replace(['  ', '	'], ' ', $code);
			
			$code = preg_replace( "#namespace\W+\S+\;|namespace\W+\S+\W+\;|namespace\S+\;|namespace\S+\W+\;#i", '	', $code, 1 );
			eval('if(false){' . $code . _BR_ . '}');
			$err = err_last();
			
			$exp = null;
            if (is_array($err)){ // если 

				$event = '/scripts/' . basename($filename);
                self::$errors[$list->itemIndex+count(self::$errors)+1] = ['msg'=>$err['msg'], 'type'=>$err['type'],
                                        'line'=>$err['line'], 'event'=>$event,
                                        'form'=>'<>', 'obj'=>false];

            message_beep(MB_ICONERROR);    

			myCompile::addStatus('Error', ': {<--'.t('ScriptF').'-->, '.$event.'}  '.$err['msg'].' '.t('on line').' '. ($err['line']));
            }
	}
    
    public static function checkProject($prefix = ''){
        
        global $projectFile;
        self::$errors = [];         
        foreach ( myProject::getFormsObjects() as $form => $objs ){
            
            self::checkForm($form, $form);
            foreach ($objs as $obj)
                self::checkForm($form, $obj['NAME']);    
        }
        
        foreach (findFiles( dirname($projectFile).'/scripts/', 'php',0,1 ) as $file){
            self::checkFile($file);
        }

        if (count(self::$errors)>0)
            return false;
        else
            return true;
    }
    
    static function clickError($self){
        
        $index = c($self)->itemIndex;
        if ($index==-1) return;
        
        global $_FORMS, $formSelected, $fmEdit, $_sc, $myEvents;
        
        $error = self::$errors[$index];
        if (!$error) return;
        
        if ($error['form']=='<>'){
            
            return;
        }
        
        
        if (strtolower($_FORMS[$formSelected])!==strtolower($error['form'])){
                
                eventEngine::setForm($error['form']);
                myUtils::saveForm();
                myUtils::loadForm($error['form']);
        }
        
        if (!$error['obj']){
            $_sc->clearTargets();
            myDesign::formProps();
        } else { 
            
            myDesign::inspectElement( $fmEdit->findComponent($error['obj']) );    
        }
        
        if (!$error['event']) $error['event'] = 'OnExecute';
        c('fmMain->eventList')->items->selected = t(strtolower($error['event']));
    }
    
    static function dblClickError($self){
        
        $index = c($self)->itemIndex;
        if ($index==-1) return;
        $error = self::$errors[$index];
        
        self::clickError($self);
        
        if ($error['form']=='<>'){
            
            global $projectFile;
            
            run(dirname($projectFile).'/scripts/'.$error['event'].'.php');
            return;
        }
        
        myEvents::editorShow($error['line']);
    }
}