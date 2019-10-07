<?



function clearEditorHotKeys(){
    DevS\cache::c('fmMain->itemDel',true)->shortCut = '';
    DevS\cache::c('fmMain->itemCopy',true)->shortCut = '';
    DevS\cache::c('fmMain->itemCut',true)->shortCut = '';
    DevS\cache::c('fmMain->itemPaste',true)->shortCut = '';
	DevS\cache::c('fmMain->itemInvert',true)->shortCut = '';
    
    global $fmEdit, $fmMain, $editorPopup, $_sc;
    $fmEdit->popupMenu = null;
    $fmMain->popupMenu = null;
    $_sc->popupMenu    = null;
}

function setEditorHotKeys(){
    DevS\cache::c('fmMain->itemDel',1)->shortCut = 'Del';
    DevS\cache::c('fmMain->itemCopy',1)->shortCut = 'Ctrl+C';
    DevS\cache::c('fmMain->itemCut',1)->shortCut = 'Ctrl+X';
    DevS\cache::c('fmMain->itemPaste',1)->shortCut = 'Ctrl+V';
	DevS\cache::c('fmMain->itemInvert',1)->shortCut = 'Ctrl+J';
    
    global $fmEdit, $fmMain, $editorPopup, $_sc;
    
    if (myVars::get('__sizeAndMove')){
        $fmEdit->popupMenu = null;
        $fmMain->popupMenu = null;
        $_sc->popupMenu    = null;
    } else {
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
    $arr = clientToScreen($fmEdit->handle);
	$arr['w'] = $fmEdit->w;
	$arr['h'] = $fmEdit->h;
    $inform = Geometry::pointInRegion($x, $y, $arr);
	
	if (!$inform && $popupShow)
		$inform = true;    
	if ($inform){
		setEditorHotKeys();
	}else
		clearEditorHotKeys();
}