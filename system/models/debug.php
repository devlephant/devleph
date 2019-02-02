<?

class myDebug {
    
    static $receiver_handle;
      
    static function onExcept($handle,$arr){
        
        if (isset($arr['RECEIVER_HANDLE']))
		{
            self::$receiver_handle = $arr['RECEIVER_HANDLE'];
			myUtils::$handle = getwindowprocessid( self::$receiver_handle );
            $debug_vars = (array)myProject::cfg('debug_vars');
            foreach ($debug_vars as $var)
                myDebug::sendMsg(array('action'=>'add','name'=>$var,'type'=>'glVars'));
        } elseif ($arr['type']=='glVars')
		{
            self::regGlVars($arr);
        } elseif ($arr['type']=='error')
		{
            self::regError($handle, $arr);
		}
    }
    
    static function sendMsg($arr){
        
        Receiver::send(self::$receiver_handle, $arr);   
    }
    
    static function regGlVars($arr){
        
        global $__DEBUG_GLVARS;
        //c('fmRunDebug',1)->show();
        $list = c('fmRunDebug->varList',1);
        $index = $list->itemIndex;
        $var   = $list->items->selected;
        $list->text = array_keys($arr['glVars']);
        $list->itemIndex = $index;
        
        $__DEBUG_GLVARS = $arr['glVars'];
        
        if ( c('fmRunDebug->c_refresh',1)->checked )
        c('fmRunDebug->mResult')->text = $__DEBUG_GLVARS[$var];
        
        myProject::cfg('debug_vars', array_keys($arr['glVars']));
            
        c('fmRunDebug->mResult')->repaint();
    }
    
    static function regError($handle, $arr){
        
            $names = explode('->',$arr['name']);
            
            if (!count($names)) return;
            
                /****** event *****/
                if (!CApi::doEvent('onDebugError',array('handle'=>$handle,'params'=>$arr))) return;
                /****** ---- *****/
            
            $form = $names[0];
            $obj  = $names[1];
            
            global $_FORMS, $formSelected, $_sc, $fmEdit, $fmMain, $myProperties, $myEvents;
            
            if ($form==$_FORMS[$formSelected])
                $_sc->clearTargets();
            elseif (myUtils::formExists($form)){
                
                myUtils::saveForm();
                myUtils::saveProject();
                myUtils::loadForm($form);
            }
            
            $GLOBALS['APPLICATION']->toFront();
            
            if ($obj){
                $target = $fmEdit->findComponent($obj);
                $_sc->addTarget($target);
            } else
                $target = $fmEdit;
            
            
            myDesign::inspectElement($target);
            $myEvents->last_self = 0; // fix bug
            $myEvents->_generate($target);
            
            if (!$arr['event']) $arr['event'] = 'OnExecute';
           
            c('fmMain->eventList')->items->selected = t(strtolower($arr['event']));
            
            message_beep(MB_ICONERROR);
            myEvents::editorShow($arr['line'], $arr['line'], $arr);
            
                
                /****** event *****/
                if (!CApi::doEvent('onDebugErrorAfter',array('handle'=>$handle,'params'=>$arr))) return;
                /****** ---- *****/
    }
}