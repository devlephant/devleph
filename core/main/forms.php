<?
/*
  
  PHP4Delphi Forms Library
  
  2017 ver 1.3 
				TApplication, TScreen, TScreenEx, TForm
  
*/
global $_c;

/* results of dialogs and forms */
$_c->setConstList([
			'idOk','idCancel','idAbort','idRetry','idIgnore',
			'idYes','idNo','idClose','idHelp','idTryAgain',
			'idContinue'
                        ],false,1);

$_c->mrNone     = 0;
$_c->mrOk       = idOk;
$_c->mrCancel   = idCancel;
$_c->mrAbort    = idAbort;
$_c->mrRetry    = idRetry;
$_c->mrIgnore   = idIgnore;
$_c->mrYes      = idYes;
$_c->mrNo       = idNo;
$_c->mrAll	= mrNo + 1;
$_c->mrNoToAll  = mrAll + 1;
$_c->mrYesToAll = mrNoToAll + 1;


/* cursors ----------------- */
  $_c->crDefault     = 0;
  $_c->crNone        = -1;  
  $_c->crArrow       = -2;
  $_c->crCross       = -3;
  $_c->crIBeam       = -4;
  $_c->crSize        = -22;
  $_c->crSizeNESW    = -6;
  $_c->crSizeNS      = -7;
  $_c->crSizeNWSE    = -8;
  $_c->crSizeWE      = -9;
  $_c->crUpArrow     = -10;
  $_c->crHourGlass   = -11;
  $_c->crDrag        = -12;
  $_c->crNoDrop      = -13;
  $_c->crHSplit      = -14;
  $_c->crVSplit      = -15;
  $_c->crMultiDrag   = -16;
  $_c->crSQLWait     = -17;
  $_c->crNo          = -18;
  $_c->crAppStart    = -19;
  $_c->crHelp        = -20;
  $_c->crHandPoint   = -21;
  $_c->crSizeAll     = -22;
  

 $GLOBALS['cursors_meta'] = 
	[
		  0 =>'crDefault',
	      -1=>'crNone',
	      -2=>'crArrow',
	      -3=>'crCross',
	      -4=>'crIBeam',
	      -22=>'crSize',
	      -6=>'crSizeNESW',
	      -7=>'crSizeNS',
	      -8=>'crSizeNWSE',
	      -9=>'crSizeWE',
	      -10=>'crUpArrow',
	      -11=>'crHourGlass',
	      -12=>'crDrag',
	      -13=>'crNoDrop',
	      -14=>'crHSplit',
	      -15=>'crVSplit',
	      -16=>'crMultiDrag',
	      -17=>'crSQLWait',
	      -18=>'crNo',
	      -19=>'crAppStart',
	      -20=>'crHelp',
	      -21=>'crHandPoint',
	];
 

  
/* close type */
$_c->setConstList(['caNone', 'caHide', 'caFree', 'caMinimize']);
  
/* window state */
$_c->setConstList(['wsNormal','wsMinimized','wsMaximized']);

//TFormStyle = (fsNormal, fsMDIChild, fsMDIForm, fsStayOnTop);
$_c->setConstList(['fsNormal', 'fsMDIChild', 'fsMDIForm', 'fsStayOnTop']);

//TFormBorderStyle = (bsNone, bsSingle, bsSizeable, bsDialog, bsToolWindow, bsSizeToolWin);
$_c->setConstList(['bsNone', 'bsSingle', 'bsSizeable', 'bsDialog', 'bsToolWindow', 'bsSizeToolWin']);

$_c->setConstList(['poDesigned', 'poDefault', 'poDefaultPosOnly', 'poDefaultSizeOnly', 'poScreenCenter',
			'poDesktopCenter', 'poMainFormCenter', 'poOwnerFormCenter']);

$_c->setConstList(['dmManual', 'dmAutomatic']);
$_c->setConstList(['dkDock', 'dkDrag']);

class TForm extends TControl
{
	
	protected $_constraints;
	private $_icon;
	function get_icon()
	{
		if(!isset($this->_icon))
		$this->_icon = new TIcon($this, false, gui_propGet($this->self, 'Icon'));
		if( !$this->_icon->Modified )
			$this->_icon->assign( $GLOBALS['APPLICATION']->icon );
		return $this->_icon;
	}
	function get_constraints(){
		if (!isset($this->_constraints)){
			$this->_constraints = new TSizeConstraints(nil, false);
			$this->_constraints->self = gui_propGet( $this->self, 'constraints' );
		}
		return $this->_constraints;
	}
	function Capture()
	{
		ReleaseCapture();
		$this->perform(0x112, 0xF012, 0);

	}
	function Show($mode = SW_SHOW){
		if( $mode == SW_SHOW )
		{
			$this->visible = true;
		} elseif ( $mode == SW_SHOWNOACTIVATE ) {
			show_window( $this->handle, $mode );
			$this->visible = true;
		} else
			show_window( $this->handle, $mode);
	}
	function ShowOnTop($mode = SW_SHOW)
	{
		$this->show($mode);
		$this->BringToFront();
	}
	function showModal(){
		gui_formShowModal( $this->self );
		return $this->modalResult;
	}
	function scrollBy($x, $y){
		
		form_scrollby($this->self, $x, $y);
	}
	
	function setx_positionEx($v){
		
	}
	
	static function loadFromFile($name,$init = false){
		
		return createFormWithEvents($name, $init);
	}
}

function asTForm($self){
        return to_object($self,'TForm');
}

// делает форму $form главной в приложении...
function setMainForm($form){
        set_main_form($form->self);
}


/* TScreen класс... */
class TScreen extends TComponent{
        
        
	
	function get_activeForm(){
		
		return _c(screen_form_active());
	}
        
        function get_formcount(){
                return screen_form_count();
        }
        
        function formById($id){
                return screen_form_by_id($id);
        }
        
        function formList(){
                $forms = [];
                $count = $this->get_formcount();
                if($count<=0) return [];        
                        for ($i=0; $i<$count; $i++){
                                $forms[] = asTForm($this->formById($i));
                        }
                        
                return $forms;
        }
        
        function get_forms(){
                return $this->formList();
        }
}

class TScreenEx extends TScreen{
        
        
}


/* TApplication класс ... */
class TApplication extends TControl{

        function terminate(){
                application_terminate();
        }
        
        function minimize(){
                application_minimize();
        }
        
        function processMessages(){
                application_processmessages();
        }
        
        function restore(){
                application_restore();
        }
        
        function messageBox($text,$caption,$flag = 1){
                return application_messagebox($text,$caption,$flag);
        }

	function set_title($title){
		application_set_title($title);
	}
	
	function get_title(){ return application_prop('title',null); }
	function get_active(){ return application_prop('active',null); }

        function get_handle(){ return application_prop('handle', null); }
	
	function set_showMainForm($v){ application_prop('showMainForm', $v); }
	function get_showMainForm(){ return application_prop('showMainForm',null); }
	
	function set_mainFormOnTaskBar($v){ application_prop('mainformontaskbar', $v); }
	function get_mainFormOnTaskBar(){ return application_prop('mainformontaskbar',null); }
	
	
	function toFront(){
		application_tofront();
	}
	
	static function doTerminate(){
		if( isset($GLOBALS['__TApplication_doTerminate']) )
		foreach ((array)$GLOBALS['__TApplication_doTerminate'] as $func){
			eval($func);
		}
	}
	
	static function addTermFunc($code){
		$GLOBALS['__TApplication_doTerminate'][] = $code.';';
	}
}

function appTitle(){
        return application_prop('title',null);
}

function halt(){
       application_terminate();
	   die();
}
?>