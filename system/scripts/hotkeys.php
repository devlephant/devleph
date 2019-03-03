<?



function clearEditorHotKeys(){
    //pre(c('fmMain->itemDel'));
    c('fmMain->itemDel',true)->shortCut = '';
    c('fmMain->itemCopy',true)->shortCut = '';
    c('fmMain->itemCut',true)->shortCut = '';
    c('fmMain->itemPaste',true)->shortCut = '';
    
    global $fmEdit, $fmMain, $editorPopup, $_sc;
    
    //$editorPopup->AutoPopur  = false;
    $fmEdit->popupMenu = null;
    $fmMain->popupMenu = null;
    $_sc->popupMenu    = null;
}

function setEditorHotKeys(){
    c('fmMain->itemDel',1)->shortCut = 'Del';
    c('fmMain->itemCopy',1)->shortCut = 'Ctrl+C';
    c('fmMain->itemCut',1)->shortCut = 'Ctrl+X';
    c('fmMain->itemPaste',1)->shortCut = 'Ctrl+V';
    
    global $fmEdit, $fmMain, $editorPopup, $_sc;
    
    if (myVars::get('__sizeAndMove')){
        //$editorPopup->AutoPopur  = false;
        $fmEdit->popupMenu = null;
        $fmMain->popupMenu = null;
        $_sc->popupMenu    = null;
    } else {
        //$editorPopup->AutoPopur  = true;
        $fmEdit->popupMenu = $editorPopup;
        $fmMain->popupMenu = $editorPopup;
        $_sc->popupMenu    = $editorPopup;
    }
}

function initEditorHotKeys(){
    
    global $fmEdit, $fmMain, $popupShow;
    if (!$fmEdit) return;
   
    $x = cursor_pos_x();
    $y = cursor_pos_y();
    
    //$inform = true;
    $arr['x'] = clientToScreenX($fmEdit->handle);
    $arr['y'] = clientToScreenY($fmEdit->handle);
    $arr = clientToScreen($fmEdit->handle);
    $inform = Geometry::pointInRegion($x, $y, array('x'=>$arr['x'], 'y'=>$arr['y'],
                                          'w'=>$fmEdit->w, 'h'=>$fmEdit->h));
    

    if (!$inform && $popupShow)
        $inform = true;
    
    /*$inform = $fmEdit->focused;*/
    
    /*
    $inform = $inform && ($x > $fmEdit->left + $add_x);
    $inform = $inform && ($y > $fmEdit->top + $add_y);
    
    $inform = $inform && ($x < $fmEdit->left + $add_x + $fmEdit->width);
    $inform = $inform && ($y < $fmEdit->top + $add_y + $fmEdit->height);   
    */
    
    if ($inform)
        setEditorHotKeys();
    else
        clearEditorHotKeys();
}


// запускаем таймер для проверки позиции курсора...
Timer::setInterval('initEditorHotKeys', 250);