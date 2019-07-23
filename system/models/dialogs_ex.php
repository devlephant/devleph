<?

// модуль нестандартных диалогов...

function __inputTextKeyDownEvent($self, $key, $shift){
    
    if ($key==VK_ESCAPE){
        c('edt_inputText')->close();
    } elseif ($key==VK_RETURN){
        c('edt_inputText')->close();
        c('edt_inputText')->modalResult = mrOk;
    }
}


function inputText($caption, $text, $value='', $xy = true){
    
    $frm = c('edt_inputText');
    $frm->onKeyDown = '__inputTextKeyDownEvent';
    c('edt_inputText->text')->onKeyDown = '__inputTextKeyDownEvent';
    c('edt_inputText->btn_ok')->onKeyDown = '__inputTextKeyDownEvent';
    c('edt_inputText->btn_cancel')->onKeyDown = '__inputTextKeyDownEvent';
    
    if ($xy){
        $frm->x = cursor_real_x($frm,10);
        $frm->y = cursor_real_y($frm,10);
    }
    
    $frm->caption = $caption;
    c('edt_inputText->e_label')->text = $text;
    c('edt_inputText->text')->text = $value;
    c('edt_inputText->text')->setFocus();
    
    $res = $frm->showModal()==mrOk/* || $GLOBALS['__inputtext_modalresult']==mrOk*/;
    
    if ($res){
        return c('edt_inputText->text')->text;
    } else
        return false;
}

// диалог для текста...
class TTextDialog extends TPanel {
    
    
    
    function execute($xy_mouse = true,$text = false){
        
        c('edt_Text')->onKeyDown = 'TTextDialog::keyDown';
        c('edt_Text->memo')->onKeyDown = 'TTextDialog::keyDown';
		c('edt_Text->bitbtn3')->onClick = 'TTextDialog::clickCopy';
		c('edt_Text->bitbtn4')->onClick = 'TTextDialog::clickPaste';

	if( $this->color )
            $this->color = clGray;	
        
        if ($text){
			$this->value = $text;
            c('edt_Text->memo')->text = $text;
        }            
        if ($xy_mouse){
            c('edt_Text')->x = cursor_real_x(c('edt_Text'),10);
            c('edt_Text')->y = cursor_real_y(c('edt_Text'),10);
        }
        
        return c('edt_Text')->showModal() == mrOk;
    }
    
    function get_value(){
        
        $val = c('edt_Text->memo')->text;
        
        if (!$val || strlen($val)==0) return "";
        
        return $val;
    }
    
    function set_value($v){
        c('edt_Text->memo')->text = $v;
    }
    
    
    function keyDown($self, $key, $shift){
        
        if ($key == VK_ESCAPE)
            c('edt_Text')->close();
    }
	
	function clickCopy($self){
		clipboard_settext( c('edt_Text->memo')->text );
	}
	
	function clickPaste($self){
		c('edt_Text->memo')->text = clipboard_gettext( );
	}
}

// диалог для размеров...
class TSizesDialog extends TPanel {
    
    
    
    function execute($xy_cursor = true){
        
        $obj = $this->getObject();
        $anchors = explode(',', $obj->anchors);
        
        if ($xy_cursor){
            c('fmSizesPosition',1)->x = cursor_real_x(c('fmSizesPosition'),10);
            c('fmSizesPosition',1)->y = cursor_real_y(c('fmSizesPosition'),10);
        }
        
        c('fmSizesPosition->e_x',1)->onKeyUp = 'TSizesDialog::setSizes';
        c('fmSizesPosition->e_x',1)->onKeyPress= 'TSizesDialog::setSizes';
        
        c('fmSizesPosition->e_y',1)->onKeyUp = 'TSizesDialog::setSizes';
        c('fmSizesPosition->e_y',1)->onKeyPress= 'TSizesDialog::setSizes';
        
        c('fmSizesPosition->e_w',1)->onKeyUp = 'TSizesDialog::setSizes';
        c('fmSizesPosition->e_w',1)->onKeyPress= 'TSizesDialog::setSizes';
        
        c('fmSizesPosition->e_h',1)->onKeyUp = 'TSizesDialog::setSizes';
        c('fmSizesPosition->e_h',1)->onKeyPress= 'TSizesDialog::setSizes';
        
        c('fmSizesPosition->c_left',1)->checked = in_array('akLeft', $anchors);
        c('fmSizesPosition->c_top',1)->checked  = in_array('akTop', $anchors);
        c('fmSizesPosition->c_right',1)->checked= in_array('akRight', $anchors);
        c('fmSizesPosition->c_bottom',1)->checked = in_array('akBottom', $anchors);
        
        c('fmSizesPosition->e_x',1)->text = $obj->x;
        c('fmSizesPosition->e_y',1)->text = $obj->y;
        c('fmSizesPosition->e_h',1)->text = $obj->h;
        c('fmSizesPosition->e_w',1)->text = $obj->w;
        
        if (c('fmSizesPosition',1)->showModal()==mrOk){
            
            $anchors = [];
            if (c('fmSizesPosition->c_left',1)->checked)
                $anchors[] = 'akLeft';
                
            if (c('fmSizesPosition->c_top',1)->checked)
                $anchors[] = 'akTop';
            
            if (c('fmSizesPosition->c_right',1)->checked)
                $anchors[] = 'akRight';
            
            if (c('fmSizesPosition->c_bottom',1)->checked)
                $anchors[] = 'akBottom';
            
            $targets = $this->getSizeControl()->targets_ex;
            
            foreach ($targets as $el){
                $el->anchors = implode(',', $anchors);
            }
        }
    }
    
    function setSizes(){
        
        global $_sc;
        $targets = $_sc->targets_ex;
        foreach ($targets as $el){
            
            $el->x = c('fmSizesPosition->e_x')->text;
            $el->y = c('fmSizesPosition->e_y')->text;
            $el->w = c('fmSizesPosition->e_w')->text;
            $el->h = c('fmSizesPosition->e_h')->text;
        }
    }
    
    function setSizeControl($name){
        
        $this->sc = $name;
    }
    
    function getSizeControl(){
        
        return $GLOBALS[$this->sc];
    }
    
    function setObject($obj){
        
        $this->component = $obj->self;
    }
    
    function getObject(){
        return _c($this->component);
    }

}

// диалог для картинки...
class TImageDialog extends TPanel {
    
    
    
    function execute($imagelist = false){
        
        global $_sc;
        c('edt_ImageView->btn_load')->onClick = 'TImageDialog::load';
        c('edt_ImageView->btn_save')->onClick = 'TImageDialog::save';
        c('edt_ImageView->btn_clear')->onClick= 'TImageDialog::clear';
        c('edt_ImageView->btn_copy')->onClick = 'TImageDialog::copy';
        c('edt_ImageView->btn_paste')->onClick= 'TImageDialog::paste';
		
        if ($this->imagelist){
            $this->setImages();
            c('edt_ImageView')->h = 498;
        } else {
            c('edt_ImageView')->h = 357;
        }
        
        return c('edt_ImageView')->showModal() == mrOk;
    }
    
    static function clear(){
        
        c('edt_ImageView->image')->picture->clear();
		c('edt_ImageView->background')->visible = false;
    }
    
    static function load(){
        
        $dlg = new TOpenDialog;
        $dlg->filter = DLG_FILTER_PICTURES;
        
        $result = false;
        if ($dlg->execute()){
            
            c('edt_ImageView->image')->picture->loadAnyFile($dlg->fileName);
			c('edt_ImageView->background')->visible = (c('edt_ImageView->image')->picture->graphic->SupportsPartialTransparency || c('edt_ImageView->image')->picture->graphic->Transparent);
			c('edt_ImageView')->repaint();
			$result = true;
        }
        
        $dlg->free();
		c('edt_ImageView')->toFront();
		
        return $result;
    }
    
    static function save(){
        
        $dlg = new TSaveDialog;
        $dlg->filter = 'Bitmap Images (*.bmp)|*.bmp';
        
        if ($dlg->execute()){
            if (file_exists($dlg->fileName) && !confirm(t('File "%s" already exists! You want to replace this file?',basename($dlg->fileName)))) return false;
            
            $dlg->fileName = fileExt($dlg->fileName)=='bmp' ? $dlg->fileName : $dlg->fileName . '.bmp';
                c('edt_ImageView->image')->picture->getBitmap()->saveToFile($dlg->fileName);
        }
        
        $dlg->free();
		c('edt_ImageView')->toFront();
    }
    
    static function copy(){
		c('edt_ImageView->imgBuffer')->picture->assign( c('edt_ImageView->image')->picture );
		clipboard_assign( c('edt_ImageView->image')->picture->self );
    }
    
    static function paste(){
		if( clipboard_checkformat('pic') )
		{
			clipboard_assignpic( c('edt_ImageView->image')->picture->self );
		} else
		{
			c('edt_ImageView->image')->picture->assign( c("edt_ImageView->imgBuffer")->picture );
		}
	   c('edt_ImageView->background')->visible = (c('edt_ImageView->image')->picture->graphic->SupportsPartialTransparency || c('edt_ImageView->image')->picture->graphic->Transparent);
    }
    
    function get_value(){
        
        return c('edt_ImageView->image')->picture;
    }
    
    function set_value($v){
		
        c('edt_ImageView->image')->picture->assign($v);
		if( is_object(c('edt_ImageView->image')->picture->graphic) )
		{
			c('edt_ImageView->background')->visible = (c('edt_ImageView->image')->picture->graphic->SupportsPartialTransparency || c('edt_ImageView->image')->picture->graphic->Transparent);
		} else c('edt_ImageView->background')->visible  = false;
	}
    
}

//диалог для меню...
class TMenuDialog extends TPanel {
    
    
    
    function execute(){
        
        $r = c('edt_menuEditor',1)->showModal();
        return $r == mrOk;
    }
    
    function get_value(){
        
        return c('edt_menuEditor',1)->result;
    }
    
    function set_value($v){
        
        c('edt_menuEditor',1)->result = $v;
    }
}
//диалог выбора объекта...
class TObjectsDialog extends TPanel {
    
    
    
    function execute($classes=false, $status='', $fullpath = false){
        
        c('fmEasySelectDialog->tsVars')->tabVisible = false;
        c('fmEasySelectDialog->tsProps')->tabVisible = false;
        c('fmEasySelectDialog->tsFuncs')->tabVisible = false;
        c('fmEasySelectDialog->tsFiles')->tabVisible = false;
        c('fmEasySelectDialog->tsConsts')->tabVisible = false;
        c('fmEasySelectDialog->c_kav')->hide();
        c('fmEasySelectDialog->pages')->pageIndex    = 1;
        c('fmEasySelectDialog->l_status')->text = $status;
        
        $GLOBALS['OBJ_ISFUNC']  = true;
        $GLOBALS['OBJ_FULLPATH'] = $fullpath;
        $GLOBALS['OBJ_CLASSES'] = $classes;
        
        $r = c('fmEasySelectDialog',1)->showModal();
        
        c('fmEasySelectDialog->l_status')->text = '';
        
        $GLOBALS['OBJ_ISFUNC'] = false;
        $GLOBALS['OBJ_FULLPATH'] = false;
        
        c('fmEasySelectDialog->tsVars')->tabVisible = true;
        c('fmEasySelectDialog->tsConsts')->tabVisible = true;
        c('fmEasySelectDialog->tsProps')->tabVisible = true;
        c('fmEasySelectDialog->tsFuncs')->tabVisible = true;
        c('fmEasySelectDialog->tsFiles')->tabVisible = true;
        c('fmEasySelectDialog->c_kav')->show();
        
        return $r == mrOk;
    }
    
    function get_value(){
        
        return c('fmEasySelectDialog->line')->text;
    }
    
    function set_value($v){
        
        c('fmEasySelectDialog->line')->text = $v;
    }
}

?>