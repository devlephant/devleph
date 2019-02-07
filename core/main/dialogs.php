<?
/*
  
  SoulEngine Dialogs Library
  
  2016 ver 4
  
  Kashaket Company (c) 2016
  
				TColorDialog, TCommonDialog, TDMSColorDialog, TFindDialog,
				TFontDialog, TOpenDialog, TPageSetupDialog, TPrintDialog,
				TReplaceDialog, TSaveDialog
  
*/
global $_c, $APPLICATION;

	/* MessageBox flags */
	$_c->MB_OK = 0x000000;
	$_c->MB_OKCANCEL = 0x000001;
	$_c->MB_ABORTRETRYIGNORE = 0x000002;
	$_c->MB_YESNOCANCEL = 0x000003;
	$_c->MB_YESNO = 0x000004;
	$_c->MB_RETRYCANCEL = 0x000005;
	$_c->MB_ABORTRETRYCONTINUE = 0x000006;
	
	$_c->MB_OKHELP = 0x005000;
	$_c->MB_RETRYALL = 0x000050;
	$_c->MB_ICONHAND = 0x000010;
	$_c->MB_ICONQUESTION = 0x000020;
	$_c->MB_ICONEXCLAMATION = 0x000030;
	$_c->MB_ICONASTERISK = 0x000040;
	$_c->MB_USERICON = 0x000080;
	$_c->MB_ICONWARNING     = MB_ICONEXCLAMATION;
	$_c->MB_ICONERROR       = MB_ICONHAND;
	$_c->MB_ICONINFORMATION = MB_ICONASTERISK;
	$_c->MB_ICONSTOP        = MB_ICONHAND;
	
	$_c->MB_APPLMODAL = 0x000000;
	$_c->MB_SYSTEMMODAL = 0x001000;
	$_c->MB_TASKMODAL = 0x002000;
	$_c->MB_HELP = 0x004000;

//TMsgDlgType = (mtWarning, mtError, mtInformation, mtConfirmation, mtCustom);
$_c->setConstList(array('mtWarning', 'mtError', 'mtInformation', 'mtConfirmation', 'mtCustom'), 0);
$_c->setConstList(array('fdScreen', 'fdPrinter', 'fdBoth'), 0);

function messageBox($text,$caption,$flag = MB_OK){
	
	return syncEx('application_messagebox', array($text, $caption, $flag));
}

function messageDlg($text, $type = mtInformation, $flag = MB_OK){
	
	return syncEx('message_dlg', array($text, $type, $flag));
}

function message($text, $mode = mtCustom){
    
	return messageDlg($text, $mode);
}

function showMessage($text){
	
	messageBox($text,appTitle());
}

function alert($text){showMessage($text);}
function msg($text){showMessage($text);}

function confirm($text){
	$res = messageBox($text,appTitle(),MB_YESNO);
	return $res == idYes;
}
class __TNoVisual extends TControl {
    
    public $class_name = __CLASS__;
	public $real;
    function __initComponentInfo(){
	if($this->file && trim($this->file) > ''){
		$this->setImage(replaceSr($this->file));
		$this->onDestroy = false;
		$this->font->name = 'Segoe UI';
	}
	$this->hide();
	if($this->aevisiable == true){
		$this->show();
	}
    }
	public function	 set_onFree(callable $v)
	{
		$this->onDestroy = $v;
	}
	public function  get_onFree()
	{
		return $this->onDestroy;
	}
	public function copy()
	{
		if( is_callable($this->onCopy) )
			return $this->onCopy();
	}
    public function  free(){
		if( is_callable($this->onDestroy) )
			$this->onDestroy();
		
		if (class_exists('animate'))
			animate::objectFree($this->self);
		
		gui_destroy($this->self);
	}
    
    public function __construct($onwer=nil,$init=true,$self=nil){
        
		parent::__construct($onwer, $init, $self);

	    if ($init){

			$this->showHint = true;
			$this->hint = $this->name;

			$this->aevisiable = false;
			$this->file = '';

	        if ($GLOBALS['APP_DESIGN_MODE']){
	            $this->__loadDesign();
	        }

	    }
    }
    
    public function __updateDesign(){
	
	$this->toFront();
    }
    
    static function __doMouseLeave($self){
	
	$obj = _c($self);
	$obj->panel->free();
	$obj->panel = '';
	$obj->label = '';
    }
    
    public function __loadDesign(){	
	
	$this->setImage(myImages::get24($this->class_name_ex));
	$this->onDblClick = '__TNoVisual::panelDblClick';
    }
    
    public function __pasteDesign(){	
	
	$this->setImage(myImages::get24($this->class_name_ex));
	$this->onDblClick = '__TNoVisual::panelDblClick';
    }
        
    function set_visible($v){
	$this->set_prop('visible', (bool)$v);
    }
	
    function get_visible(){
	return $this->get_prop('visible');
    }
    
    static function panelDblClick($self){
	
	$name = inputText(t('To change name of object'),t('New Name'),_c($self)->caption);
	
	if ($name){
	    
	    if (!eregi('^[a-z]{1}[a-z0-9\_]*$',$name)) return;
	    
	    myDesign::changeName(_c(_c($self)->obj), $name);
	    global $myProperties;
	    $myProperties->updateProps();
	}
    }
    
    
    static function panelClick($self){
	
	global $_sc;
	$_sc->clearTargets();
	    
	myDesign::selectComponent($_sc->self, _c($self)->obj, 0, 0);
	_c(_c($self)->obj)->toFront();
	_c(_c(_c($self)->obj)->panel)->toFront();
	$_sc->addTarget(_c(_c($self)->obj));
    }
    
    public function setImage($file,$pre=false){	
	global $_IMAGES24, $fmMain;
	if (!file_exists($file) and $_IMAGES24 and $fmMain)
	    $file = myImages::get24('component');

	if($pre)
		echo $file;
	
	$this->__iconName = replaceSr($file);
    }

}
class TCommonDialog extends TControl{
	
	public $class_name = __CLASS__;
	#public onSelect
	
	function execute(){

		$res = dialog_execute($this->self);

		/*if ($res && $this->onSelectDialog){
			eval($this->onSelectDialog . '('.$this->self.',\''. addslashes($this->filename) .'\');');
		}*/
		return $res;
	}
	
	function closeDialog(){
		dialog_close($this->self);
	}
	
	function close(){
		$this->closeDialog();
	}
	
	function showModal(){return $this->execute();}
	function show(){return $this->execute();}
	
	function get_files(){
		
		$tmp = (array)explode(_BR_, dialog_items($this->self));
		foreach ($tmp as $el)
		if ($el)
		$result[] = replaceSl($el);
		
		return $result;
	}
	
	function setOption($name, $value = true, $ex = false){
		
		$options = array();
		if ($ex)
			$tmp = explode(',',$this->optionsEx);
		else {
			$tmp = explode(',',$this->options);
		}
		
		foreach ($tmp as $el)
		if ($el)
			$options[] = trim($el);
		
		
			
		$k = array_search($name, (array)$options);
			
		if (!$value){
			if ($k!==false)
				unset($options[$k]);
		} else {
			if ($k===false)
				$options[] = $name;
		}
		
		if ($ex){
			$this->optionsEx = implode(',', (array)$options);
		}
		else
			$this->options = implode(',', (array)$options);
	}
	
	function getOption($name, $ex = false){
		
		if ($ex)
		if (stripos($this->optionsEx, $name)!==false)
			return true;
		if (!$ex)
		if (stripos($this->options, $name)!==false)
			return true;
		
		return false;
	}
	
}

class TOpenDialog extends TCommonDialog{	
	public $class_name = __CLASS__;
	
	
	function set_smallMode($v){
		$this->setOption('ofExNoPlacesBar', $v, true);
	}
	
	function get_smallMode(){
		return $this->getOption('ofExNoPlacesBar', true);
	}
	
	
	function set_multiSelect($v){
		$this->setOption('ofAllowMultiSelect', $v);
	}
	
	function get_multiSelect(){
		return $this->getOption('ofAllowMultiSelect');
	}
	
}
class TSaveDialog extends TOpenDialog{
	public $class_name = __CLASS__;
}
class TFontDialog extends TCommonDialog{
	public $class_name = __CLASS__;
}
class TColorDialog extends TCommonDialog{
	public $class_name = __CLASS__;
	
	function set_smallMode($v){
		$this->setOption('cdFullOpen', !$v);
	}
	
	function get_smallMode(){
		return !$this->getOption('cdFullOpen');
	}
}
class TDMSColorDialog extends TCommonDialog{
	public $class_name = __CLASS__;
}
class TPrintDialog extends TCommonDialog{
	public $class_name = __CLASS__;
}
class TPageSetupDialog extends TCommonDialog{
	public $class_name = __CLASS__;
}
class TFindDialog extends TCommonDialog{
	public $class_name = __CLASS__;
	
	public function get_isMatchCase(){
		return $this->getOption('frMatchCase');
	}
	
	public function set_isMatchCase($v){
		$this->setOption('frMatchCase',$v);
	}
	
}

class TReplaceDialog extends TCommonDialog{
	public $class_name = __CLASS__;
	
	public function get_isMatchCase(){
		return $this->getOption('frMatchCase');
	}
	
	public function set_isMatchCase($v){
		$this->setOption('frMatchCase',$v);
	}
}

?>