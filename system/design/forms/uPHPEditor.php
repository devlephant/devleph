<?
global $fmphpeditor_lastAction;
$fmphpeditor_lastAction = false;
$s = DevS\cache::c("fmPHPEditor->memo");
$s->rightEdge  = false;
$s->font->name = 'Trebuchet MS';
$s->font->size = 10;
$s->wordWrap   = true;
$s->options    = '[eoAutoIndent, eoDragDropEditing, eoEnhanceEndKey, eoGroupUndo, eoHalfPageScroll, eoShowScrollHint, eoSmartTabDelete, eoTabIndent, eoHideShowScrollbars]';

class ev_fmPHPEditor_tlOk{
	static function onMouseEnter($self){
		DevS\cache::c("fmPHPEditor->ok_cl")->visible = true;
	}
	static function onMouseLeave($self){
		DevS\cache::c("fmPHPEditor->ok_cl")->visible = false;
	}
	static function onClick($self){
		global $phpeditorClosing, $lastStringSelStart, $myEvents;
		myComplete::saveCode();
			$event = DevS\cache::c('fmPHPEditor')->event;
			$name  = $myEvents->selObj instanceof TForm ? '--fmedit' : $myEvents->selObj->name;
			$tx = DevS\cache::c("fmPHPEditor->memo");
			eventEngine::setEvent($name, $event, $tx->text);
			$lastStringSelStart[$name][$event]['x'] =  $tx->caretX;
			$lastStringSelStart[$name][$event]['y'] =  $tx->caretY;
		
		$phpeditorClosing = 1;
		DevS\cache::c("fmPHPEditor")->close();
		DevS\cache::c("fmPHPEditor")->ModalResult = 1;
	}
}
class ev_fmPHPEditor_tlCancel{
	static function onMouseEnter($self){
		if( DevS\cache::c($self)->enabled )
			DevS\cache::c("fmPHPEditor->ok_cn")->visible = true;
	}
	static function onMouseLeave($self){
		DevS\cache::c("fmPHPEditor->ok_cn")->visible = false;
	}
	static function onClick($self){
		DevS\cache::c("fmPHPEditor")->close();
		DevS\cache::c("fmPHPEditor")->ModalResult = 2;
	}
}
class evfmPHPEditor {
	static function onShow($self)
	{
		DevS\cache::c("fmPHPEditor->ok_cn")->visible = false;
		
		eventTabs_show();
	}
	
	static function onCloseQuery($self, &$canClose)
	{
		global $phpeditorClosing, $showComplete, $showHint, $lastStringSelStart, $myEvents, $cancel;
		$event = DevS\cache::c('fmPHPEditor')->event;
		$name  = $myEvents->selObj instanceof TForm ? '--fmedit' : $myEvents->selObj->name;
		$evt_schange = $phpeditorClosing? true: md5( str_replace(array(" ", "\t", "\r", "\n"), "", eventEngine::getEvent($name, $event)) )!== md5( str_replace(array(" ", "\t", "\r", "\n"), "", DevS\cache::c('fmPHPEditor->memo')->text ) );
		if( !$evt_schange && !$phpeditorClosing )
		{
			$phpeditorClosing = 1;
			DevS\cache::c('fmPHPEditor')->close();
		}
		if(	!$phpeditorClosing and DevS\cache::c('fmPHPEditor->tlCancel')->enabled and $msg = messageBox(t('All unsaved changes in the code will be lost. Do you want to save the code before closing?'), t('Closing the Code Editor'), MB_ICONWARNING + MB_YESNOCANCEL) and $msg == mrYes )
		{		
			myComplete::saveCode();   
			$tx = DevS\cache::c("fmPHPEditor->memo");
			eventEngine::setEvent($name, $event, $tx->text);
			$lastStringSelStart[$name][$event]['x'] =  $tx->caretX;
			$lastStringSelStart[$name][$event]['y'] =  $tx->caretY;
		
			$phpeditorClosing = 1;
			DevS\cache::c('fmPHPEditor')->close();
		}
		elseif($msg !== mrCancel)
		{
			$phpeditorClosing = 1;
			DevS\cache::c('fmPHPEditor')->close();
		}
		else
		{
			$canClose = false;
		}
		
		if( $phpeditorClosing )
		{
			$phpeditorClosing = 0;
			$showHint = $showComplete = false;
		}
		
	}
}
class evfmPHPEditorMEMO {
    
    
    static function onDblClick($self){       
        $action = myActions::getAction(action_Simple::getLine());
        if ($action)
		{            
            action_Simple::openDialog($action['DIALOG'], $action);
        }
    }
    
    
    static function onMouseDown($self){
		global $fmphpeditor_lastAction;
		$fmphpeditor_lastAction = $action = myActions::getAction(action_Simple::getLine());
        if ($action){
            DevS\cache::c('fmPHPEditor->info')->caption = $action['TEXT'];
            DevS\cache::c('fmPHPEditor->action_image')->loadPicture($action['ICON']);
            DevS\cache::c('fmPHPEditor->desc')->caption = myActions::getInlineFixed($action);
			DevS\cache::c('fmPHPEditor->desc')->hint	 = myActions::getInline($action);
        } else {
            DevS\cache::c('fmPHPEditor->info')->caption = '';
            DevS\cache::c('fmPHPEditor->desc')->caption = '';
            DevS\cache::c('fmPHPEditor.action_image')->picture->clear();
			DevS\cache::c('fmPHPEditor.desc')->hint	 = '';
        }
    }
	
    static function onKeyPress($self){
        self::onMouseDown($self);
    }
    
    static function onKeyUp($self){
        self::onMouseDown($self);
    }
    
    
    static function onClick($self){
        self::onMouseDown($self);
    }
    
}
class ev_fmPHPEditor_btn_new {
    static function onClick($self){ DevS\cache::c('fmPHPEditor->memo')->text = ''; }
}

class ev_fmPHPEditor_New1 {
    static function onClick($self){ DevS\cache::c('fmPHPEditor->memo')->text = ''; }
}

class ev_fmPHPEditor_btn_open {
    static function onClick($self)
	{    
        $dlg = new TOpenDialog;
        $dlg->filter = DLG_FILTER_ALL;
        
        if ($dlg->execute())
		{
            DevS\cache::c('fmPHPEditor->memo')->text =  file_get_contents($dlg->fileName) ;   
        }
        
        $dlg->free();
		DevS\cache::c("fmPHPEditor")->toFront();
    }
}

class ev_fmPHPEditor_Open1 {
    static function onClick($self)
	{    
        $dlg = new TOpenDialog;
        $dlg->filter = DLG_FILTER_ALL;
        
        if ($dlg->execute())
		{
            DevS\cache::c('fmPHPEditor->memo')->text =  file_get_contents($dlg->fileName) ;   
        }
        
        $dlg->free();
		DevS\cache::c("fmPHPEditor")->toFront();
    }
}

class ev_fmPHPEditor_btn_save {
    static function onClick($self)
	{   
        $dlg = new TSaveDialog;
        $dlg->filter = 'PHP Script (.php)|*.php';
        
        if ($dlg->execute())
		{
            $fileName = $dlg->fileName;
            if (fileExt($fileName)!=='php') $fileName .= '.php';
            
            file_p_contents( $fileName, DevS\cache::c('fmPHPEditor->memo')->text );   
        }
        
        $dlg->free();
		DevS\cache::c("fmPHPEditor")->toFront();
    }
}


class ev_fmPHPEditor_btn_find
{
    static function onClick($self)
	{
        DevS\cache::c('fmPHPEditor->p_search')->visible = !DevS\cache::c('edt_FindDialog->p_search')->visible;
        DevS\cache::c('fmPHPEditor->p_search')->repaint();
        DevS\cache::c('fmPHPEditor->f_text')->setFocus();
    }
}


class ev_fmPHPEditor_it_find {
    
    static function onClick($self)
	{    
		ev_fmPHPEditor_btn_find::onClick($self);
    }
}

class ev_fmPHPEditor_f_next {
    
    static function onClick($self)
	{
        ev_fmPHPEditor_f_text::onKeyUp(0, 13);
    }
}

class ev_fmPHPEditor_f_prev {
    
    static function onClick($self)
	{    
        $GLOBALS['__findIndex'] -= 1;
        
        if ($GLOBALS['__findIndex']<0)
            $GLOBALS['__findIndex'] = count($GLOBALS['__find'])-1;
        
        ev_fmPHPEditor_f_text::onKeyUp(0, 13);
        
        $GLOBALS['__findIndex'] -= 1;
    }
}

class ev_fmPHPEditor_c_register {
    
    static function onClick($self)
	{    
        unset($GLOBALS['__find']);
        unset($GLOBALS['__findIndex']);
    }
    
    static function onKeyUp($self, $key){
        ev_fmPHPEditor_f_text::onKeyUp($self, $key);
    }
}

class ev_fmPHPEditor_f_text {
    
    static function onKeyUp($self, $key){
        
        if ($key==13 || $key==114){
            
            if (!DevS\cache::c('fmPHPEditor->f_text')->text) return;
            
            if (!isset($GLOBALS['__findIndex']))
                $GLOBALS['__findIndex'] = 0;
            
            
            DevS\cache::c('fmPHPEditor->memo')->selStart = 0;
            DevS\cache::c('fmPHPEditor->memo')->selEnd   = 0;
            
            $start = myEvents::findTextItem($GLOBALS['__findIndex']);
            $length = strlen(DevS\cache::c('fmPHPEditor->f_text')->text);
            
            if (!isset($start)){
                
                if (count($GLOBALS['__find'])==0)
                    msg(t('Nothing found.'));
                else
                    msg(t('Search is over. Found % matches.', count($GLOBALS['__find'])));
                
                $GLOBALS['__findIndex'] = 0;
                return;
            }
            
            ++$GLOBALS['__findIndex'];
            
            DevS\cache::c('fmPHPEditor->memo')->selStart = $start;
            DevS\cache::c('fmPHPEditor->memo')->selEnd   = $start + $length;
            DevS\cache::c('fmPHPEditor->memo')->setFocus();
            
        } elseif ($key==VK_ESCAPE){
                
            DevS\cache::c('fmPHPEditor->p_search')->visible = !c('edt_FindDialog->p_search')->visible;
            DevS\cache::c('fmPHPEditor->memo')->setFocus();
            
        } else {
            $GLOBALS['__findIndex'] = 0;
            myEvents::findText();
        }
    }
}

class ev_fmPHPEditor_lowercase1 {
    static function onClick($self)
	{
        DevS\cache::c('fmPHPEditor->memo')->selText = strtolower(DevS\cache::c('fmPHPEditor->memo')->selText);
    }
}

class ev_fmPHPEditor_UPPERCASE1 {
    static function onClick($self)
	{
        DevS\cache::c('fmPHPEditor->memo')->selText = strtoupper(DevS\cache::c('fmPHPEditor->memo')->selText);
    }
}

class ev_fmPHPEditor_undoItem {
    static function onClick($self)
	{
        DevS\cache::c('fmPHPEditor->memo')->undo();
    }
}

class ev_fmPHPEditor_redoItem {
    static function onClick($self)
	{
        DevS\cache::c('fmPHPEditor->memo')->redo();
    }
}

class ev_fmPHPEditor_btn_undo {
    static function onClick($self)
	{
        DevS\cache::c('fmPHPEditor->memo')->undo();
    }
}

class ev_fmPHPEditor_btn_redo {
    static function onClick($self)
	{
        DevS\cache::c('fmPHPEditor->memo')->redo();
    }
}

class ev_fmPHPEditor_it_saveevent {
    static function onClick($self)
	{
        global $myEvents;
        
        myComplete::saveCode();
        $event = DevS\cache::c('fmPHPEditor')->event;
        $name  = $myEvents->selObj instanceof TForm ? '--fmedit' : $myEvents->selObj->name;
        $tx = DevS\cache::c("fmPHPEditor->memo");
		eventEngine::setEvent($name, $event, $tx->text);
		
		$lastStringSelStart[$name][$event]['x'] =  $tx->caretX;
		$lastStringSelStart[$name][$event]['y'] =  $tx->caretY;
        
        message_beep(66);
        DevS\cache::c('fmPHPEditor->tlCancel')->enabled = false;
    }
}

class ev_fmPHPEditor_exit{
    static function onClick($self)
	{
		global $phpeditorClosing;
		$phpeditorClosing = 1;
		DevS\cache::c('fmPHPEditor->memo')->text = '';
        DevS\cache::c("fmPHPEditor")->close();
    }
}

class ev_fmPHPEditor_it_selectall {
    static function onClick($self)
	{
		DevS\cache::c('fmPHPEditor->memo')->selectAll();
    }
}
class ev_fmPHPEditor_selectall1 {
    static function onClick($self)
	{
		DevS\cache::c('fmPHPEditor->memo')->selectAll();
    }
}
class ev_fmPHPEditor_it_cut {
    static function onClick($self)
	{
		DevS\cache::c('fmPHPEditor->memo')->cutToClipboard();
    }
}
class ev_fmPHPEditor_cut1 {
    static function onClick($self)
	{
		DevS\cache::c('fmPHPEditor->memo')->cutToClipboard();
    }
}
class ev_fmPHPEditor_Saveas1{
	static function onClick($self)
	{
        $dlg = new TSaveDialog;
        $dlg->filter = 'PHP Script (.php)|*.php';
        
        if ($dlg->execute()){
            
            $fileName = $dlg->fileName;
            if (fileExt($fileName)!=='php') $fileName .= '.php';
            
            file_p_contents( $fileName, c('fmPHPEditor->memo')->text );   
        }
        
        $dlg->free();
		DevS\cache::c("fmPHPEditor")->toFront();
    }
}

class ev_fmPHPEditor_it_copy {
    static function onClick($self){DevS\cache::c('fmPHPEditor->memo')->copyToClipboard();}
}
class ev_fmPHPEditor_copy1{
    static function onClick($self){DevS\cache::c('fmPHPEditor->memo')->copyToClipboard();}
}
class ev_fmPHPEditor_it_paste {
    static function onClick($self){DevS\cache::c('fmPHPEditor->memo')->pasteFromClipboard();}
}
class ev_fmPHPEditor_paste1 {
    static function onClick($self){DevS\cache::c('fmPHPEditor->memo')->pasteFromClipboard();}
}
c('fmPHPEditor')->onResize = function($self)
{
	global $fmphpeditor_lastAction;
        
        if ($fmphpeditor_lastAction)
            DevS\cache::c('fmPHPEditor.desc')->caption = myActions::getInlineFixed($fmphpeditor_lastAction);
};
class EditorSynt
{
	static function getHighlight(){
		
		$files = findFiles(SYSTEM_DIR.'/design/highlight/','ini');
		$files = array_merge( $files, findFiles(DS_USERDIR.'/highlight/','ini') );
		
		foreach ($files as $file){
			$lines[] = basenameNoExt($file); 
		}
		
		$lines = array_unique($lines);
		return (array)$lines;
	}

	static function loadHightLight($name)
	{
        $file = DS_USERDIR.'/highlight/'.$name.'.ini';
        if (! file_exists($file) )
            $file = SYSTEM_DIR.'/design/highlight/'.$name.'.ini';
		
		$ini = new TIniFileEx($file);
		ev_fmPHPEditor_options::$ini = $ini;
		DevS\cache::c('fmPHPEditor->SynPHPSyn')->loadFromArray($ini->arr);
        DevS\cache::c('fmPHPEditor->memo')->font->name = $ini->read('main','font','Courier New');
	DevS\cache::c('fmPHPEditor->memo')->font->size = $ini->read('main','fontsize',10);
	DevS\cache::c('fmPHPEditor->memo')->color = $ini->read('main','color',clWhite);
	if( $ini->read('main','setForm',true) ){
	$col_ac = $ini->read('main','color',0);
	if( $col_ac == $ini->read('Comment','background',0) and $col_ac == $ini->read('Identifier','background',0) and $col_ac == $ini->read('Key','background',0) and $col_ac == $ini->read('Number','background',0) and $col_ac == $ini->read('String','background',0) and $col_ac == $ini->read('Symbol','background',0) and $col_ac == $ini->read('Variable','background',0) ){
			$resc =$ini->read('main','color',0) == $ini->read('gutter','color',0);
	}else{
		if( $ini->read('main','color',0) == $ini->read('Space','background',0)){ $resc = $ini->read('Space','background',0) ; };
		if( $ini->read('Space', 'backround',0)  == $ini->read('gutter', 'color',0) ){ $resc = $ini->read('gutter', 'color',0); };
	}
	if(!isset($resc)){if(!$ini->read('gutter','color',false)){ $resc = $ini->read('main','color',0); }else{ $resc = $ini->read('gutter','color',0); }  }
	DevS\cache::c('fmPHPEditor')->color = $resc;
	foreach( c('fmPHPEditor')->get_componentList() as $obj ){
		if(get_class($obj) == 'TLabel'){
		$obj->font->color = $ini->read('String','foreground',clWhite);
		}
	}
	}
		DevS\cache::c('fmPHPEditor->memo')->ActiveLineColor = $ini->read('main','ActiveLineColor',DevS\cache::c('fmPHPEditor->memo')->color);
        gui_propSet( DevS\cache::c('fmPHPEditor->memo')->gutter->self, 'color', $ini->read('gutter','color',clWhite) );
        gui_propSet( DevS\cache::c('fmPHPEditor->memo')->gutter->self, 'font.color', $ini->read('gutter','fontcolor',clGray) );

        gui_propSet( DevS\cache::c('fmPHPEditor->memo')->SelectedColor, 'background', $ini->read('main','SelectedColorBG',DevS\cache::c('fmPHPEditor->memo')->color) );
        gui_propSet( DevS\cache::c('fmPHPEditor->memo')->SelectedColor, 'foreground', $ini->read('main','SelectedColorFG',DevS\cache::c('fmPHPEditor->memo')->font->color ) );
	
		myOptions::set('syntax','highlight', $name);
	}

	static function UncheckSyntItems()
	{
		global $syntItems;
		foreach($syntItems as $s)
		{
			$s->checked = false;
		}
	}
	
	static function UnsetSyntaxes()
	{
		global $syntItems;
		foreach($syntItems as $e=>$s)
		{
			$s->free();
			unset( $syntItems[$e] );
		}
		$syntItems = [];
	}
	
	static function loadFirstSyntax()
	{
		global $syntItems;
		EditorSynt::UncheckSyntItems();
		$syntax = myOptions::get('syntax','highlight', 'Notepad++ Style');
        $file = DS_USERDIR.'/highlight/'.$syntax.'.ini';
        if (! file_exists($file) )
            $file = SYSTEM_DIR.'/design/highlight/'.$syntax.'.ini';
		EditorSynt::loadHightLight($syntax);
		$synItem = $syntItems[$syntax];
		$synItem->checked =  true;
	}
	
	static function MainStart()
	{
		global $syntItems;

		$synList = EditorSynt::getHighlight();

		if( !empty($synList) )
		foreach( $synList as $s )
		{
			$it = new TMenuItem;
			$it->parent = DevS\cache::c("fmPHPEditor");
			$it->name = str_replace([' ', '-', '#', '@', '!', '$', '.', '+', '=', '(', ')'], '_', $s);
			$it->caption = $s;
			$it->onClick = function($self)use($s){
				$self = c($self);
				EditorSynt::UncheckSyntItems();
				EditorSynt::loadHightLight($s);
				$self->checked=true; 
			};
			
			$syntItems[$s] = $it;
			
			DevS\cache::c('fmPHPEditor->SynList')->addItem($it);
		}
		else
		{
			$it = new TMenuItem;
			$it->caption = t('Syntax highlighting is not found');
			$it->enabled = false;
			
			DevS\cache::c('fmPHPEditor->SynList')->addItem($it);
		}
		
		EditorSynt::loadFirstSyntax();
	}
}

EditorSynt::MainStart();		

class ev_fmPHPEditor_options {
	public static $ini;
    static function onClick($self)
	{	
        $ini = self::$ini;
        DevS\cache::c('fmPHPEditor->SynPHPSyn')->saveToArray($arr);
        $color = DevS\cache::c('fmPHPEditor->memo')->color;
        if (DevS\cache::c('fmEditorSettings')->showModal()!==mrOk){
            DevS\cache::c('fmPHPEditor->SynPHPSyn')->loadFromArray($arr);
            DevS\cache::c('fmPHPEditor->memo')->color = $ini->read('main','color',clWhite);
            DevS\cache::c('fmPHPEditor->memo')->ActiveLineColor = $ini->read('main','ActiveLineColor',DevS\cache::c('fmPHPEditor->memo')->color);
            
            gui_propSet( DevS\cache::c('fmPHPEditor->memo')->gutter, 'color', $ini->read('gutter','color',clWhite) );
            gui_propSet( DevS\cache::c('fmPHPEditor->memo')->gutter, 'font.color', $ini->read('gutter','fontcolor',clGray) );
            gui_propSet( DevS\cache::c('fmPHPEditor->memo')->SelectedColor, 'background', $ini->read('main','SelectedColorBG',DevS\cache::c('fmPHPEditor->memo')->color) );
            gui_propSet( DevS\cache::c('fmPHPEditor->memo')->SelectedColor, 'foreground', $ini->read('main','SelectedColorFG', DevS\cache::c('fmPHPEditor->memo')->font->color ) );
        }
    }
}
class ev_fmPHPEditor_cutf8 {
    static function onClick($self)
	{	
		if( ! DevS\cache::c("fmPHPEditor->cutf8")->checked ){
			if( messageBox( t(t('enc_chng_dg'), 'UTF-8'), t('change encode'), MB_ICONWARNING + MB_YESNO  ) == mrNo )
				return;
			DevS\cache::c('fmPHPEditor->memo')->text = iconv('windows-1251', 'UTF-8', DevS\cache::c('fmPHPEditor->memo')->text);
		}
        DevS\cache::c("fmPHPEditor->cutf8")->checked = true;
        DevS\cache::c("fmPHPEditor->cansi")->checked = false;
    }
}

        DevS\cache::c("fmPHPEditor->cutf8")->checked=false;
        DevS\cache::c("fmPHPEditor->cansi")->checked=true; 

class ev_fmPHPEditor_cansi {
    static function onClick($self)
	{
		
		if( ! DevS\cache::c("fmPHPEditor->cansi")->checked ){
			if( messageBox( t(t('enc_chng_dg'), 'ANSI'), t('change encode'), MB_ICONWARNING + MB_YESNO  ) == mrNo )
				return;
			DevS\cache::c('fmPHPEditor->memo')->text = iconv('UTF-8', 'windows-1251', DevS\cache::c('fmPHPEditor->memo')->text);
		}
        DevS\cache::c("fmPHPEditor->cutf8")->checked = false;
        DevS\cache::c("fmPHPEditor->cansi")->checked = true;        
    }
}

class ev_fmPHPEditor_it_tabs {
	static function onClick($self)
	{
		$self = DevS\cache::c($self);
		$self->checked = !$self->checked;
		DevS\cache::c("fmPHPEditor->eventTabs")->visible = $self->checked;
	}
}

class ev_fmPHPEditor_eventTabs {
	static function onChange($self){
		global $phpeditorClosing, $lastStringSelStart, $myEvents, $_FORMS, $formSelected;
		eventEngine::setForm();
		$eventList = DevS\cache::c('fmPropsAndEvents->eventList');
		$eventTabs = DevS\cache::c('fmPHPEditor->eventTabs');
		$php_memo = DevS\cache::c('fmPHPEditor->memo');
		$save = myOptions::get('code', 'savemode', 0);//#ADDOPT;
		//code = code editor setup
		/*
		0 => Save with asking
		1 => Save without asking
		2 => Don't save
		*/
		//Пока так. Можно будет потом её прикрутить, как настройку.
		if($eventTabs->TabIndex == $eventTabs->tabs->get_count()-1){
			$eventTabs->TabIndex = $eventTabs->last_index;
			myEvents::clickAddEvent(0, true);
			$eventTabs->TabIndex = $eventTabs->last_index;
			return;
		}
		
		$eventTabs->last_index = $eventTabs->TabIndex;
		
		$name = $myEvents->selObj instanceof TForm ? '--fmedit' : $myEvents->selObj->name;
		$event  = $eventList->events[$eventTabs->TabIndex];
		
		if($save){
			myComplete::saveCode();
			$tx = c("fmPHPEditor->memo");
			eventEngine::setEvent($name, $event, $tx->text);
			$lastStringSelStart[$name][$event]['x'] =  $tx->caretX;
			$lastStringSelStart[$name][$event]['y'] =  $tx->caretY;
		}
		
		DevS\cache::c('fmPHPEditor')->event = $event;
		
        $php_memo->text = eventEngine::getEvent($name, $event);
        $ltight = str_replace('{', '', str_ireplace('event ', '', CApi::getStringEventInfo($event, $myEvents->selObj->className) ) );
        $x_name = $myEvents->selObj->name == 'fmEdit' ? $_FORMS[$formSelected] : $myEvents->selObj->name;
        DevS\cache::c('fmPHPEditor')->text = t('php_script_editor').' -> '.$x_name.'::'.$ltight;
	}
}

function str_replace_o($search, $replace, $text) 
{ 
   $pos = strpos($text, $search); 
   return $pos!==false ? substr_replace($text, $replace, $pos, strlen($search)) : $text; 
} 
