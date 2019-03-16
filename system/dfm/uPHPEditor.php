<?
global $fmphpeditor_lastAction;
$fmphpeditor_lastAction = false;
$s = c("fmPHPEditor->memo");
$s->rightEdge  = false;
$s->font->name = 'Trebuchet MS';
$s->font->size = 10;
$s->wordWrap   = true;
$s->options    = '[eoAutoIndent, eoDragDropEditing, eoEnhanceEndKey, eoGroupUndo, eoHalfPageScroll, eoShowScrollHint, eoSmartTabDelete, eoTabIndent, eoHideShowScrollbars]';

class ev_fmPHPEditor_tlOk{
	static function onMouseEnter($self){
		c("fmPHPEditor->ok_cl")->visible = true;
	}
	static function onMouseLeave($self){
		c("fmPHPEditor->ok_cl")->visible = false;
	}
	static function onClick($self){
		global $phpeditorClosing, $showComplete, $showHint, $lastStringSelStart, $myEvents, $cancel;
		myComplete::saveCode();
			$event = c('fmPHPEditor')->event;
			$name  = $myEvents->selObj instanceof TForm ? '--fmedit' : $myEvents->selObj->name;
			eventEngine::setEvent($name, $event, c('fmPHPEditor->memo')->text);    
			myHistory::go();
			
			$lastStringSelStart[$name][$event]['x'] =  c('fmPHPEditor->memo')->caretX;
			$lastStringSelStart[$name][$event]['y'] =  c('fmPHPEditor->memo')->caretY;
		
		$phpeditorClosing = 1;
		c("fmPHPEditor")->close();
		c("fmPHPEditor")->ModalResult = 1;
	}
}
class ev_fmPHPEditor_tlCancel{
	static function onMouseEnter($self){
		if( c($self)->enabled )
			c("fmPHPEditor->ok_cn")->visible = true;
	}
	static function onMouseLeave($self){
		c("fmPHPEditor->ok_cn")->visible = false;
	}
	static function onClick($self){
		c("fmPHPEditor")->close();
		c("fmPHPEditor")->ModalResult = 2;
	}
}
class evfmPHPEditor {
	static function onShow($self)
	{
		c("fmPHPEditor->ok_cn")->visible = false;
		//c("fmPHPEditor->tlCancel")->enabled = false;
	}
	static function onCloseQuery($self, &$canClose)
	{
		global $phpeditorClosing, $showComplete, $showHint, $lastStringSelStart, $myEvents, $cancel;
		$event = c('fmPHPEditor')->event;
		$name  = $myEvents->selObj instanceof TForm ? '--fmedit' : $myEvents->selObj->name;
		$evt_schange = $phpeditorClosing? true: md5( str_replace(array(" ", "\t", "\r", "\n"), "", eventEngine::getEvent($name, $event)) )!== md5( str_replace(array(" ", "\t", "\r", "\n"), "", c('fmPHPEditor->memo')->text ) );
		if( !$evt_schange && !$phpeditorClosing )
		{
			$phpeditorClosing = 1;
			c('fmPHPEditor')->close();
		}
		if(	!$phpeditorClosing and c('fmPHPEditor->tlCancel')->enabled and $msg = messageBox(t('All unsaved changes in the code will be lost. Do you want to save the code before closing?'), t('Closing the Code Editor'), MB_ICONWARNING + MB_YESNOCANCEL) and $msg == mrYes )
		{		
			myComplete::saveCode();
			eventEngine::setEvent($name, $event, c('fmPHPEditor->memo')->text);    
			myHistory::go();
			
			$lastStringSelStart[$name][$event]['x'] =  c('fmPHPEditor->memo')->caretX;
			$lastStringSelStart[$name][$event]['y'] =  c('fmPHPEditor->memo')->caretY;
		
			$phpeditorClosing = 1;
			c('fmPHPEditor')->close();
		}
		elseif($msg !== mrCancel)
		{
			$phpeditorClosing = 1;
			c('fmPHPEditor')->close();
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
        if ($action){
            
            action_Simple::openDialog($action['DIALOG'], $action);
        }
    }
    
    
    static function onMouseDown($self){
		global $fmphpeditor_lastAction;
		$fmphpeditor_lastAction = $action = myActions::getAction(action_Simple::getLine());
        
        if ($action){
            c('fmPHPEditor.info',1)->caption = $action['TEXT'];
            c('fmPHPEditor.action_image',1)->loadPicture($action['ICON']);
            c('fmPHPEditor.desc',1)->caption = myActions::getInlineFixed($action);
			c('fmPHPEditor.desc',1)->hint	 = myActions::getInline($action);
        } else {
            c('fmPHPEditor.info',1)->caption = '';
            c('fmPHPEditor.desc',1)->caption = '';
            c('fmPHPEditor.action_image',1)->picture->clear();
			c('fmPHPEditor.desc',1)->hint	 = '';
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
    static function onClick(){ c('fmPHPEditor->memo')->text = ''; }
}

class ev_fmPHPEditor_New1 {
    static function onClick(){ c('fmPHPEditor->memo')->text = ''; }
}

class ev_fmPHPEditor_btn_open {
    static function onClick(){
        
        $dlg = new TOpenDialog;
        $dlg->filter = DLG_FILTER_ALL;
        
        if ($dlg->execute()){
            c('fmPHPEditor->memo')->text =  file_get_contents($dlg->fileName) ;   
        }
        
        $dlg->free();
		c("fmPHPEditor")->toFront();
    }
}

class ev_fmPHPEditor_Open1 {
    static function onClick(){
        
        $dlg = new TOpenDialog;
        $dlg->filter = DLG_FILTER_ALL;
        
        if ($dlg->execute()){
            c('fmPHPEditor->memo')->text =  file_get_contents($dlg->fileName) ;   
        }
        
        $dlg->free();
		c("fmPHPEditor")->toFront();
    }
}

class ev_fmPHPEditor_btn_save {
    static function onClick(){
        
        $dlg = new TSaveDialog;
        $dlg->filter = 'PHP Script (.php)|*.php';
        
        if ($dlg->execute()){
            
            $fileName = $dlg->fileName;
            if (fileExt($fileName)!=='php') $fileName .= '.php';
            
            file_p_contents( $fileName, c('fmPHPEditor->memo')->text );   
        }
        
        $dlg->free();
		c("fmPHPEditor")->toFront();
    }
}


class ev_fmPHPEditor_btn_find {
    static function onClick(){
        
        c('fmPHPEditor->p_search')->visible = !c('edt_FindDialog->p_search')->visible;
        c('fmPHPEditor->p_search')->repaint();
        c('fmPHPEditor->f_text')->setFocus();
    }
}


class ev_fmPHPEditor_it_find {
    
    static function onClick(){
        
        if (c('p_search')->visible){
            ev_fmPHPEditor_f_text::onKeyUp(0,13);
        } else {
            ev_fmPHPEditor_btn_find::onClick();
        }
    }
}

class ev_fmPHPEditor_f_next {
    
    static function onClick(){
        ev_fmPHPEditor_f_text::onKeyUp(0, 13);
    }
}

class ev_fmPHPEditor_f_prev {
    
    static function onClick(){
        
        $GLOBALS['__findIndex'] -= 1;
        
        if ($GLOBALS['__findIndex']<0)
            $GLOBALS['__findIndex'] = count($GLOBALS['__find'])-1;
        
        ev_fmPHPEditor_f_text::onKeyUp(0, 13);
        
        $GLOBALS['__findIndex'] -= 1;
    }
}

class ev_fmPHPEditor_c_register {
    
    static function onClick(){
        
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
            
            if (!c('f_text')->text) return;
            
            if (!isset($GLOBALS['__findIndex']))
                $GLOBALS['__findIndex'] = 0;
            
            
            c('memo')->selStart = 0;
            c('memo')->selEnd   = 0;
            
            $start = myEvents::findTextItem($GLOBALS['__findIndex']);
            $length = strlen(c('f_text')->text);
            
            if (!isset($start)){
                
                if (count($GLOBALS['__find'])==0)
                    msg(t('Nothing found.'));
                else
                    msg(t('Search is over. Found % matches.', count($GLOBALS['__find'])));
                
                $GLOBALS['__findIndex'] = 0;
                return;
            }
            
            $GLOBALS['__findIndex']++;
            
            c('memo')->selStart = $start;
            c('memo')->selEnd   = $start + $length;
            c('fmPHPEditor->memo')->setFocus();
            
        } elseif ($key==VK_ESCAPE){
                
            c('fmPHPEditor->p_search')->visible = !c('edt_FindDialog->p_search')->visible;
            c('fmPHPEditor->memo')->setFocus();
            
        } else {
            $GLOBALS['__findIndex'] = 0;
            myEvents::findText();
        }
    }
}

class ev_fmPHPEditor_lowercase1 {
    static function onClick(){
        c('fmPHPEditor->memo')->selText = strtolower(c('fmPHPEditor->memo')->selText);
    }
}

class ev_fmPHPEditor_UPPERCASE1 {
    static function onClick(){
        c('fmPHPEditor->memo')->selText = strtoupper(c('fmPHPEditor->memo')->selText);
    }
}

class ev_fmPHPEditor_undoItem {
    static function onClick(){
        c('fmPHPEditor->memo')->undo();
    }
}

class ev_fmPHPEditor_redoItem {
    static function onClick(){
        c('fmPHPEditor->memo')->redo();
    }
}

class ev_fmPHPEditor_btn_undo {
    static function onClick(){
        c('fmPHPEditor->memo')->undo();
    }
}

class ev_fmPHPEditor_btn_redo {
    static function onClick(){
        c('fmPHPEditor->memo')->redo();
    }
}

class ev_fmPHPEditor_it_saveevent {
    static function onClick(){
        global $myEvents;
        
        myComplete::saveCode();
        $event = c('fmPHPEditor')->event;
        $name  = $myEvents->selObj instanceof TForm ? '--fmedit' : $myEvents->selObj->name;
        eventEngine::setEvent($name, $event, c('fmPHPEditor->memo')->text);    
        myHistory::go();
        
        message_beep(66);
        c('fmPHPEditor->tlCancel')->enabled = false;
    }
}

class ev_fmPHPEditor_exit{
    static function onClick(){
		global $phpeditorClosing;
		$phpeditorClosing = 1;
		c('fmPHPEditor->memo')->text = '';
        c("fmPHPEditor")->close();
    }
}

class ev_fmPHPEditor_it_selectall {
    static function onClick(){
         c('fmPHPEditor->memo')->selectAll();
    }
}
class ev_fmPHPEditor_selectall1 {
    static function onClick(){
         c('fmPHPEditor->memo')->selectAll();
    }
}
class ev_fmPHPEditor_it_cut {
    static function onClick(){
         c('fmPHPEditor->memo')->cutToClipboard();
    }
}
class ev_fmPHPEditor_cut1 {
    static function onClick(){
         c('fmPHPEditor->memo')->cutToClipboard();
    }
}
class ev_fmPHPEditor_Saveas1{
	    static function onClick(){
        
        $dlg = new TSaveDialog;
        $dlg->filter = 'PHP Script (.php)|*.php';
        
        if ($dlg->execute()){
            
            $fileName = $dlg->fileName;
            if (fileExt($fileName)!=='php') $fileName .= '.php';
            
            file_p_contents( $fileName, c('fmPHPEditor->memo')->text );   
        }
        
        $dlg->free();
		c("fmPHPEditor")->toFront();
    }
}

class ev_fmPHPEditor_it_copy {
    static function onClick(){
         c('fmPHPEditor->memo')->copyToClipboard();
    }
}
class ev_fmPHPEditor_copy1{
    static function onClick(){
         c('fmPHPEditor->memo')->copyToClipboard();
    }
}
class ev_fmPHPEditor_it_paste {
    static function onClick(){
         c('fmPHPEditor->memo')->pasteFromClipboard();
    }
}
class ev_fmPHPEditor_paste1 {
    static function onClick(){
         c('fmPHPEditor->memo')->pasteFromClipboard();
    }
}
c('fmPHPEditor')->onResize = function($self)
{
	global $fmphpeditor_lastAction;
        
        if ($fmphpeditor_lastAction)
            c('fmPHPEditor.desc',1)->caption = myActions::getInlineFixed($fmphpeditor_lastAction);
};
class EditorSynt
{
	static function getHighlight(){
		
		$files = findFiles(SYSTEM_DIR.'/myprofile/highlight/','ini');
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
            $file = SYSTEM_DIR.'/myprofile/highlight/'.$name.'.ini';
		
		$ini = new TIniFileEx($file);
		$GLOBALS['__syn_ini_o__'] = $ini;
		c('fmPHPEditor->SynPHPSyn')->loadFromArray($ini->arr);
        c('fmPHPEditor->memo')->font->name = $ini->read('main','font','Courier New');
	c('fmPHPEditor->memo')->font->size = $ini->read('main','fontsize',10);
	c('fmPHPEditor->memo')->color = $ini->read('main','color',clWhite);
	if( $ini->read('main','setForm',true) ){
	$col_ac = $ini->read('main','color',0);
	if( $col_ac == $ini->read('Comment','background',0) and $col_ac == $ini->read('Identifier','background',0) and $col_ac == $ini->read('Key','background',0) and $col_ac == $ini->read('Number','background',0) and $col_ac == $ini->read('String','background',0) and $col_ac == $ini->read('Symbol','background',0) and $col_ac == $ini->read('Variable','background',0) ){
			$resc =$ini->read('main','color',0) == $ini->read('gutter','color',0);
	}else{
		if( $ini->read('main','color',0) == $ini->read('Space','background',0)){ $resc = $ini->read('Space','background',0) ; };
		if( $ini->read('Space', 'backround',0)  == $ini->read('gutter', 'color',0) ){ $resc = $ini->read('gutter', 'color',0); };
	}
	if(!isset($resc)){if(!$ini->read('gutter','color',false)){ $resc = $ini->read('main','color',0); }else{ $resc = $ini->read('gutter','color',0); }  }
	c('fmPHPEditor')->color = $resc;
	foreach( c('fmPHPEditor')->get_componentList() as $obj ){
		if(get_class($obj) == 'TLabel'){
		$obj->font->color = $ini->read('String','foreground',clWhite);
		}
	}
	}
		//c('fmPHPEditor->l_eventinfo')->font->color = clGray;
		//c('fmPHPEditor->l_eventinfo')->color = $ini->read('gutter','color',clWhite);
		//c('fmPHPEditor->l_eventinfo')->transparent = False;
		c('fmPHPEditor->memo')->ActiveLineColor = $ini->read('main','ActiveLineColor',c('fmPHPEditor->memo')->color);
        gui_propSet( c('fmPHPEditor->memo')->gutter->self, 'color', $ini->read('gutter','color',clWhite) );
        gui_propSet( c('fmPHPEditor->memo')->gutter->self, 'font.color', $ini->read('gutter','fontcolor',clGray) );

        gui_propSet( c('fmPHPEditor->memo')->SelectedColor, 'background', $ini->read('main','SelectedColorBG',c('fmPHPEditor->memo')->color) );
        gui_propSet( c('fmPHPEditor->memo')->SelectedColor, 'foreground', $ini->read('main','SelectedColorFG',c('fmPHPEditor->memo')->font->color ) );
	
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
		$syntItems = array();
	}
	
	static function loadFirstSyntax()
	{
		global $syntItems;
		EditorSynt::UncheckSyntItems();
		$syntax = myOptions::get('syntax','highlight', 'Notepad++ Style');
        $file = DS_USERDIR.'/highlight/'.$syntax.'.ini';
        if (! file_exists($file) )
            $file = SYSTEM_DIR.'/myprofile/highlight/'.$syntax.'.ini';
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
			$it->parent = c("fmPHPEditor");
			$it->name = str_replace(array(' ', '-', '#', '@', '!', '$', '.', '+', '=', '(', ')'), '_', $s);
			$it->caption = $s;
			$it->onClick = function($self)use($s){
				$self = c($self);
				EditorSynt::UncheckSyntItems();
				EditorSynt::loadHightLight($s);
				$self->checked=true; 
			};
			
			$syntItems[$s] = $it;
			
			c('fmPHPEditor->SynList')->addItem($it);
		}
		else
		{
			$it = new TMenuItem;
			$it->caption = t('Syntax highlighting is not found');
			$it->enabled = false;
			
			c('fmPHPEditor->SynList')->addItem($it);
		}
		
		EditorSynt::loadFirstSyntax();
	}
}

EditorSynt::MainStart();		

class ev_fmPHPEditor_options {
    static function onClick(){
		
        $ini = $GLOBALS['__syn_ini_o__'];
        c('fmPHPEditor->SynPHPSyn')->saveToArray($arr);
        $color = c('fmPHPEditor->memo')->color;
        if (c('fmEditorSettings')->showModal()!==mrOk){
            c('fmPHPEditor->SynPHPSyn')->loadFromArray($arr);
            c('fmPHPEditor->memo')->color = $ini->read('main','color',clWhite);
            
            //c('fmPHPEditor->l_eventinfo')->font->color = $ini->read('gutter','fontcolor',clGray);
            //c('fmPHPEditor->l_eventinfo')->color = $ini->read('gutter','color',clWhite);
            //c('fmPHPEditor->l_eventinfo')->transparent = False;
            c('fmPHPEditor->memo')->ActiveLineColor = $ini->read('main','ActiveLineColor',c('fmPHPEditor->memo')->color);
            
            gui_propSet( c('fmPHPEditor->memo')->gutter, 'color', $ini->read('gutter','color',clWhite) );
            gui_propSet( c('fmPHPEditor->memo')->gutter, 'font.color', $ini->read('gutter','fontcolor',clGray) );
            gui_propSet( c('fmPHPEditor->memo')->SelectedColor, 'background', $ini->read('main','SelectedColorBG',c('fmPHPEditor->memo')->color) );
            gui_propSet( c('fmPHPEditor->memo')->SelectedColor, 'foreground', $ini->read('main','SelectedColorFG', c('fmPHPEditor->memo')->font->color ) );
        }
    }
}
class ev_fmPHPEditor_cutf8 {
    static function onClick(){
		
		if( ! c("fmPHPEditor->cutf8")->checked ){
			if( messageBox( t(t('enc_chng_dg'), 'UTF-8'), t('change encode'), MB_ICONWARNING + MB_YESNO  ) == mrNo )
				return;
			c('fmPHPEditor->memo')->text = iconv('windows-1251', 'UTF-8', c('fmPHPEditor->memo')->text);
		}
        c("fmPHPEditor->cutf8")->checked = true;
        c("fmPHPEditor->cansi")->checked = false;
    }
}

        c("fmPHPEditor->cutf8")->checked=false;
        c("fmPHPEditor->cansi")->checked=true; 

class ev_fmPHPEditor_cansi {
    static function onClick(){
		if( ! c("fmPHPEditor->cansi")->checked ){
			if( messageBox( t(t('enc_chng_dg'), 'ANSI'), t('change encode'), MB_ICONWARNING + MB_YESNO  ) == mrNo )
				return;
			c('fmPHPEditor->memo')->text = iconv('UTF-8', 'windows-1251', c('fmPHPEditor->memo')->text);
		}
        c("fmPHPEditor->cutf8")->checked = false;
        c("fmPHPEditor->cansi")->checked = true;        
    }
}

function str_replace_o($search, $replace, $text) 
{ 
   $pos = strpos($text, $search); 
   return $pos!==false ? substr_replace($text, $replace, $pos, strlen($search)) : $text; 
} 
