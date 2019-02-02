<?

class mySyntaxCheck {
    
    static $errors;
    static $noerrors;
    
    public static function saveFiles($dir, $form, $obj_name){
        
        $form     = strtolower($form);
        $obj_name = strtolower($obj_name);
        $result = array();
        if ($form == $obj_name)
            $eventList = eventEngine::$DATA[$form]['--fmedit'];
        else
            $eventList = eventEngine::$DATA[$form][$obj_name];
        if($eventList)
        foreach ($eventList as $event=>$code){
            
            
            $code = 'if (!function_exists("my_func")){ function my_func() { '.$code."\n".'} }';

            if ( in_array(md5($code),self::$noerrors) || !trim($code) ) continue;
            
            if ($form == $obj_name)
                $file = $dir.'/'.$form.'.'.$event.'.php';                
            else 
                $file = $dir.'/'.$form.'.'.$obj_name.'.'.$event.'.php';
            
            
            file_p_contents($file, $code);
            $result[] = replaceSr($file);
        }
        
        return $result;
    }
    
    function parseErrors($file){
        $list = c('fmMain->debugList');
		$file = str_replace('//', '/', $file);
        $result = file($file);
		
        $dir    = dirname($file);
        foreach ($result as $line){
            $info = explode('|',$line);
            if (trim($info[1])){ // если есть ошибка
                $tmp = explode('.', basenameNoExt($info[0]));
                $event = $tmp[count($tmp)-1];
                $form  = $tmp[0];
                $obj   = count($tmp)==2 ? '' : $tmp[1];
                
                self::$errors[$list->itemIndex+count(self::$errors)+1] = array('msg'=>trim($info[1]), 'type'=>(int)$info[2],
                                        'line'=>(int)$info[3], 'event'=>$event,
                                        'form'=>$form, 'obj'=>$obj);
            } else {
                if( file_exists( str_replace('//', '/', $dir.'/'.$info[0]) ) )
					self::$noerrors[] = md5_file( str_replace('//', '/', $dir.'/'.$info[0]) );
            }
        }
    }
    
    public static function showErrors(){
        
        $list = c('fmMain->debugList');
        $list->onClick = 'mySyntaxCheck::clickError';
        $list->onDblClick = 'mySyntaxCheck::dblClickError';
        foreach ((array)self::$errors as $err){
            
            $obj_name = $err['form'];
            if ($err['obj'])
                $obj_name .= '->'.$err['obj'];
                
            if ($obj_name=='___scripts'){
                $obj_name = t('Скрипт проекта');
                $err['event'] = '/scripts/'.$err['event'].'.php';
            }
            message_beep(MB_ICONERROR);    
			myCompile::addStatus('Error', ': {'.$obj_name.', '.t($err['event']).'}  '.$err['msg'].' '.t('on line').' '. ($err['line']));
			
        }
    }
    
    public static function checkProject($prefix = ''){
        
        global $projectFile;
        self::$errors = array();
        
        if (!$prefix)
            $prefix = md5($projectFile);
        
        $dir   = TEMP_DIR.'/ds3/syntaxcheck/'.$prefix.'/';
        $list  = myProject::getFormsObjects();
        $files = array();
        
        if (file_exists($dir.'/noerror.log')){
            
            self::$noerrors = explode("\n", file_get_contents($dir.'/noerror.log'));
        }
        
        foreach ( $list as $form => $objs ){
            
            $files = array_merge( $files, self::saveFiles($dir, $form, $form) );
            foreach ($objs as $obj)
                $files = array_merge( $files, self::saveFiles($dir, $form, $obj['NAME']) );    
        }
        
        
        $scripts = findFiles( dirname($projectFile).'/scripts/', 'php' );
        foreach ($scripts as $file){
            copy(dirname($projectFile).'/scripts/'.$file, $dir.'/___scripts.'.$file);
            $files[] = $dir.'/___scripts.'.$file;
        }
        
        
        if (count($files)==0) return true;
        file_p_contents($dir.'/files.chk', implode("\n", $files));
        
        
        Kill_Task('phpUtils.exe');
        shell_execute_wait2(SYSTEM_DIR . '/../phpUtils.exe','"'.$dir.'/files.chk" "'.$dir.'/error.log"', 'open', SW_HIDE);
        
        self::parseErrors($dir.'/error.log');
        file_put_contents($dir.'/noerror.log', implode("\n", self::$noerrors));
        
        foreach ($files as $file)
            unlink($file);
        
        
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
        
        if ($error['form']=='___scripts'){
            
            return;
        }
        
        
        if (strtolower($_FORMS[$formSelected])!=strtolower($error['form'])){
                
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
        
        if ($error['form']=='___scripts'){
            
            global $projectFile;
            
            run(dirname($projectFile).'/scripts/'.$error['event'].'.php');
            return;
        }
        
        myEvents::editorShow($error['line']);
    }
}