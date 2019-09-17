<?
function searchCompList( $text ) {
global $_cComplist;
$cp = c('fmComponents->list');

	foreach($cp->groups as $cpgr){
		_c($cpgr)->free();
		$cp->groups = $cp->items = [];
	}
    ////// обновляем панель компонентов /////////
    
        $componentClasses = [];
        $groups = c('fmComponents->list')->groups;
        foreach ($_cComplist as $c){
			if( strpos(strtolower(' '.$c['CAPTION'] .' - '. $c['CLASS']), strtolower($text)) ||
				strpos(strtolower(' '.$c['GROUP']), strtolower($text)) ||
				strpos(strtolower(' '.t('gr_'.$c['GROUP'])), strtolower($text)) ) {
			if (!in_array($c['GROUP'], $groups)){
                $cp->addSection($c['GROUP'],t('gr_'.$c['GROUP']));
                $groups[] = $c['GROUP'];
            }
            $btn = $cp->addButton($c['GROUP']);
			$componentClasses[$btn->self] = $c;
            $btn->caption    = $c['CAPTION'];
            $btn->hint       = $c['CAPTION'] .' - '.$c['CLASS'];
            $btn->imageIndex = myImages::getImgID($c['CLASS']);
            if ($btn->imageIndex == -1)
                $btn->imageIndex = myImages::getImgID('component');
			}
        }
		myVars::set2($componentClasses, 'componentClasses');
}

function resetCompList(){
global $_cComplist;
$cp = c('fmComponents->list');
	foreach($cp->groups as $cpgr){
		_c($cpgr)->free();
		$cp->groups = $cp->items = [];
	}
    ////// обновляем панель компонентов /////////
    
        $componentClasses = [];
        $groups = c('fmComponents->list')->groups;
        foreach ($_cComplist as $c){
			if (!in_array($c['GROUP'], $groups)){
                $cp->addSection($c['GROUP'],t('gr_'.$c['GROUP']));
                $groups[] = $c['GROUP'];
            }
            $btn = $cp->addButton($c['GROUP']);
			$componentClasses[$btn->self] = $c;
            $btn->caption    = $c['CAPTION'];
            $btn->hint       = $c['CAPTION'] .' - '.$c['CLASS'];
            $btn->imageIndex = myImages::getImgID($c['CLASS']);
            if ($btn->imageIndex == -1)
                $btn->imageIndex = myImages::getImgID('component');
        }
		 myVars::set2($componentClasses, 'componentClasses');
		 c('fmMain->list')->selectedList = explode(',',myOptions::get('components','groups', 'main'));
}

class evfmMain {
    public static $visfix = [];
	public static $pSizes = [];
    static function checkVer($file_info, $last_ver){
        if ($last_ver){
			$lver = myOptions::get('main', 'lastVer', DV_VERSION);
            if ($lver !== $last_ver and version_compare($last_ver, DV_VERSION, '>')){
                
                myOptions::set('main', 'lastVer', $last_ver);
                
                if (messageBox(t("Воу, ты устарел,\nуже доступна версия %s\nОбновить программу?",$last_ver), t('.: Мастер обновления :.'), MB_YESNO)==mrYes){
                    
                    ev_it_masterupdate::onClick(0);
                }
            }
        }
    }
	static function onShow($self){
		global $fmEdit, $fmMain;
		static $i;
		if( trim(c("fmMain->c_formComponents")->intext) == ':TForm'){
			c("fmMain->c_formComponents")->intext = $fmEdit->name.' :TForm';
		}
		myDesign::bugfixFormProps();
		if( !isset($i) )
		{
			$i = true;
			self::aftershow();
			myBackup::init();
		}
	}
    static function aftershow()
	{
		global $_sc;
		// запускаем таймер для проверки позиции курсора...
		Timer::setInterval('initEditorHotKeys', 250);
			if( !empty(self::$visfix) )
			{
				foreach( self::$visfix as $v )
					myOptions::getFloat($v->name, $v);
				
				self::$visfix = null;
				
				myDesign::szRefresh();
			}
		$_sc->update();
		
	}
    static function getLastVer(){
        
        dsErrorDebug::hide();
        $file_info = file("http://kashaproduct.at.ua/ds/last.txt");
        $last_ver = $file_info[3];
            
        sync('evfmMain::checkVer', array($file_info, $last_ver));
    }

    
    // сохранение настроек программы...
    static function saveMainConfig(){
        
        global $_sc, $fmEdit, $fmMain, $fmObjInspect;
        $_sc->clearTargets();
        myProperties::unFocusPanel(); // fix AV !!!
        
        myProject::clearProject(); // for fix AV
        
		myOptions::setXYWH('fmMain', $fmMain);
		myOptions::set('fmMain', 's', $fmMain->windowState);
        myOptions::setXYWH('fmPHPEditor', c('fmPHPEditor',1));
		myOptions::set('fmPHPEditor', 's', c('fmPHPEditor',1)->windowState);
        myOptions::set('fmPHPEditor', 'panelH', (int)c('fmPHPEditor->errPanel')->h);
        myOptions::set('fmObjInspect', 'visible',(bool)$fmObjInspect->visible);
		myOptions::set('newProjectDialog', 'startup', (bool)c('fmNewProject->startup')->checked);
        
        Docking::saveFile(c('fmMain->pDockBottom'),DS_USERDIR.'bottom.dock');
        Docking::saveFile(c('fmMain->pDockRight'),DS_USERDIR.'right.dock');
        Docking::saveFile(c('fmMain->pDockLeft'),DS_USERDIR.'left.dock');
        
        myOptions::set('pDockRight','width', c('fmMain->pDockRight')->w);
        myOptions::set('pDockLeft','width', c('fmMain->pDockLeft')->w);
        myOptions::set('pDockBottom','height', c('fmMain->pDockBottom')->h);
		myOptions::set('treebrowser','visible', c('fmMain->TTreeBwr')->TabVisible);

        myOptions::setFloat('pComponents', c('fmMain->pComponents'));
        myOptions::setFloat('pInspector', c('fmMain->pInspector'));
        myOptions::setFloat('pProps', c('fmMain->pProps'));
        myOptions::setFloat('pDebugWindow', c('fmMain->pDebugWindow'));
        
        myOptions::set('components','groups', implode(',',c('fmMain->list')->selectedList));
        myOptions::set('components','smallIcons', c('fmMain->list')->smallIcons);        
        
		myOptions::setXYWH('rundebug', c('fmRunDebug'));
		
        c('fmPHPEditor->SynPHPSyn')->saveToArray($arr);
        $arr['main']['color'] = c('fmPHPEditor->memo')->color;
        $ini = new TIniFileEx;
        $ini->arr = $arr;
        $ini->filename = DS_USERDIR.'phpsyn.ini';
        $ini->updateFile();
        
        $ini = new TIniFileEx;
        $ini->arr = (array)$GLOBALS['ALL_CONFIG'];
        $ini->filename = DS_USERDIR.'allconfig.ini';
        $ini->updateFile();
    }
    
    static function isDocked($obj){
        
        $panels = array('pDockLeft','pDockRight','pDockBottom');
        foreach ($panels as $panel){
            foreach (c('fmMain->'.$panel)->get_dockList() as $el)
                if ($el->self == $obj->self) return true;
        }
        
        return false;
    }
    
    static function panelStartDock($self, &$drag){

        if( gui_class( control_dockhost($self) ) == 'TPanel')
		{
			$se = c($self);
			$x = get_x($se) + GetSystemMetrics(32);
			$y = get_y($se) + GetSystemMetrics(SM_CYSMCAPTION);
			control_manualfloat($self, $x, $y, $x+$se->w, $y+$se->h);
		}
        $drag = control_dragobject($self);
    }
	
    static function panelVisibility($self, $host, $value)
	{
		if($value)
			ev_fmMain_pDockLeft::setcrz(true);
		if(gui_class($host)!=='TPanel') return;
		$sl = c($self);
		$obj = c($host);
		if( $value )
		{
			global $_sc;
			list($obj->w, $obj->h, $sl->w, $sl->h) = isset( evfmMain::$pSizes[$self] )?  evfmMain::$pSizes[$self]: [220, 170, 220, 170];
			$_sc->update();
			return;
		}
			
			self::$pSizes[$self] = [$obj->w, $obj->h, $sl->w, $sl->h];
			foreach( $obj->get_dockList() as $v )
			{
				if( $v->visible && $v->self !== $self )
				{
					return;
				}
			}
			$obj->h = $obj->w = 5;
	}
	
    static function loadMainConfig(){
        
        $ini = new TIniFileEx(DS_USERDIR.'phpsyn.ini');
		
        c('fmPHPEditor->SynPHPSyn')->loadFromArray($ini->arr);
        c('fmPHPEditor->memo')->color = $ini->read('main','color',clWhite);
		c('fmMain->shapeSize')->penStyle = (int)myOptions::get('sc','SizerPenStyle',2);
		c('fmMain->shapeSize')->brushColor = myOptions::get('sc','SizerInnerColor',12632256);
		$GLOBALS['sc_offset'] = (int)myOptions::get('sc', 'offset', 8);
        c('fmMain->shapeSize')->penColor = myOptions::get('sc','SizerOuterColor',clBlack);
		myOptions::getXYWH('rundebug', c('fmRunDebug'));
		
        c('fmMain->pDockRight')->w = (int)myOptions::get('pDockRight','width',200);
        c('fmMain->pDockLeft')->w = (int)myOptions::get('pDockLeft','width',220);
        c('fmMain->pDockBottom')->h = (int)myOptions::get('pDockBottom','height',220);
		c('fmMain->TTreeBwr')->TabVisible = (bool)myOptions::get('treebrowser','visible',1);
        
        c('fmMain->list')->selectedList = explode(',',myOptions::get('components','groups', 'main'));
        c('fmMain->list')->smallIcons   = myOptions::get('components','smallIcons',false);
        c('fmMain->c_type')->itemIndex  = c('fmMain->list')->smallIcons ? 1 : 0;
       
        
        control_floatstyle( c('fmMain->pDockRight')->self );
        control_floatstyle( c('fmMain->pDockLeft')->self );
        control_floatstyle( c('fmMain->pDockBottom')->self );
        control_floatstyle( c('fmMain->pInspector')->self );
        control_floatstyle( c('fmMain->pComponents')->self );
        control_floatstyle( c('fmMain->pProps')->self );
        control_floatstyle( c('fmMain->pDebugWindow')->self );
        
        c('fmMain->pDebugWindow')->onStartDock = 'evfmMain::panelStartDock';
        c('fmMain->pInspector')->onStartDock = 'evfmMain::panelStartDock';
        c('fmMain->pProps')->onStartDock = 'evfmMain::panelStartDock';
        c('fmMain->pComponents')->onStartDock = 'evfmMain::panelStartDock';
		c('fmMain->pComponents')->onDockedVisibilityChanged = 'evfmMain::panelVisibility';
        c('fmMain->pInspector')->onDockedVisibilityChanged = 'evfmMain::panelVisibility';
        c('fmMain->pProps')->onDockedVisibilityChanged = 'evfmMain::panelVisibility';
        c('fmMain->pDebugWindow')->onDockedVisibilityChanged = 'evfmMain::panelVisibility';
           
        if (!file_exists(DS_USERDIR.'bottom.dock')){
            
            c('fmMain->pComponents')->manualDock(c('fmMain->pDockRight'), alTop);
            c('fmMain->pInspector')->manualDock(c('fmMain->pDockBottom'),alTop);
            c('fmMain->pProps')->manualDock(c('fmMain->pDockLeft'),alTop);
            c('fmMain->pDebugWindow')->manualDock(c('fmMain->pDockBottom'),alBottom);
            
        } else {
            Docking::loadFile(c('fmMain->pDockBottom'),DS_USERDIR.'bottom.dock');
            Docking::loadFile(c('fmMain->pDockRight'),DS_USERDIR.'right.dock');
            Docking::loadFile(c('fmMain->pDockLeft'),DS_USERDIR.'left.dock');
            
            if (!self::isDocked(c('fmMain->pComponents')))
			{
				self::$visfix[] = c('fmMain->pComponents');
			}
            if (!self::isDocked(c('fmMain->pInspector')))
			{	
				self::$visfix[] = c('fmMain->pInspector');		
			}
            if (!self::isDocked(c('fmMain->pProps')))
			{
				self::$visfix[] = c('fmMain->pProps');
			}
            if (!self::isDocked(c('fmMain->pDebugWindow')))
			{
				self::$visfix[] = c('fmMain->pDebugWindow');
			}
            
            c('fmMain->it_components')->checked = c('fmMain->pComponents')->visible;
            c('fmMain->it_objectinspector')->checked = c('fmMain->pInspector')->visible;
            c('fmMain->it_props')->checked = c('fmMain->pProps')->visible;
            c('fmMain->it_debuginfo')->checked = c('fmMain->pDebugWindow')->visible;
			c('fmMain->it_treebrowser')->checked = c('fmMain->TTreeBwr')->TabVisible;
        }
        
            $obj  = new TComboBox( c('fmMain') );
            $list = c('fmObjectInspector->list');
            
            $obj->parent = $list->parent;
            $obj->align  = alTop;
            $obj->style  = csOwnerDrawFixed;
            $obj->text   = array(t('Icons + text'), t('Small Icons'));

            $smallIcons = myOptions::get('inspector', 'smallIcons', 0);
            
            $list->viewStyle = (int)$smallIcons;
            $obj->itemIndex = $smallIcons;

            $obj->onChange = function() use ($obj, $list){
                    $list->viewStyle = $obj->itemIndex;
                    myOptions::set('inspector', 'smallIcons', $obj->itemIndex);
            };
            
            c('fmPropsAndEvents->eventList')->onDblClick = 'myEvents::phpEditorShow';
            c('fmPropsAndEvents->btn_editEvent')->onClick = 'myEvents::phpEditorShow';
            c('fmPropsAndEvents->btn_delEvent')->onClick  = 'myEvents::deleteEvent';
            c('fmPropsAndEvents->btn_changeEvent')->onClick = 'myEvents::changeEvent';
            
            gui_propSet(gui_propGet(c("fmObjectInspector->list")->self, 'IconOptions'), 'AutoArrange', 1);
			$list->BorderStyle = bsNone;
			
    }
    
    static function onCloseQuery($self, &$canClose) {
        if (!defined('IS_APPLICATION_START')) return false;
		application_restore();
		c("fmMain")->toFront();
        switch(messageBox(t('ds_on_exit'),t('Closing Dev-S'),MB_YESNOCANCEL)){
            case mrYes:{
				
				myUtils::stop();
				myUtils::saveForm();
				MyProject::save();
				
				Timer::clearTimers();
				self::saveMainConfig();
				
			} break;
			case mrNo:{
				
				self::saveMainConfig();
			
			} break;
			case mrCancel:{
				$canClose = false;
				
			} break;
        }
    }

}
class ev_it_objectinspector {
    
    static function onClick($self){
        
        $GLOBALS['_sc']->updateBtns();
        c('fmMain->pInspector')->visible = !c('fmMain->pInspector')->visible;
    }
}

class ev_it_components {
    
    static function onClick($self){
        
        $GLOBALS['_sc']->updateBtns();
        c('fmMain->pComponents')->visible = !c('fmMain->pComponents')->visible;
    }
}


class ev_it_props {
    static function onClick($self){
        $GLOBALS['_sc']->updateBtns();
        c('fmMain->pProps')->visible = !c('fmMain->pProps')->visible;
    }
}


class ev_it_debuginfo {
    
    static function onClick($self){
        $GLOBALS['_sc']->updateBtns();
        c('fmMain->pDebugWindow')->visible = !c('fmMain->pDebugWindow')->visible;
    }
}

class ev_it_treebrowser {
    
    static function onClick($self){
        $GLOBALS['_sc']->updateBtns();
        c('fmMain->TTreeBwr')->TabVisible = !c('fmMain->TTreeBwr')->TabVisible;
	c('fmMain->it_treebrowser')->checked = c('fmMain->TTreeBwr')->TabVisible;
    }
}

class ev_it_siteprogram {
    static function onClick($self)
	{
        shell_execute(0,'open','http://kashaproduct.at.ua/','','',SW_SHOW);
    }
}

class ev_fmMain_it_phphelp {
    static function onClick($self)
	{
        run('http://php.su/learnphp/');
    }
}

class ev_it_helpbook
{    
    static function onClick($self)
	{
        return shell_execute(0,'open','http://help.develstudio.ru/Vvedenie-16.html','','',SW_SHOW);
        
        if (!file_exists(DOC_ROOT . '/lang/' . LANG_ID . '/help.chm'))
            dsErrorDebug::msg(t('Help book not found for this language'));
        else
            shell_execute(0,'open', DOC_ROOT . '/lang/' . LANG_ID . '/help.chm');
    }
}

class ev_it_aboutprogram {
    static function onClick($self)
	{    
        c('fmAbout')->showModal();
    }
}

class ev_it_exit {
    static function onClick($self)
	{
        c('fmMain')->close();
    }
}

class ev_statusBar {
    static function onClick($self)
	{
        global $projectFile;
        shell_execute(0,'open', replaceSr(dirname($projectFile)).'\\', '', '', SW_SHOW);
    }
}

class ev_fmMain_pDockLeft {
	private static $orients = [];
	private static $crz = false;
	static function setcrz($v)
	{
		self::$crz = $v;
	}
    static function onDockDrop($self, $source=1, $x, $y){
        $GLOBALS['_sc']->updateBtns();
        $obj = c($self);
		$source = c( dragobject_control($source) );
		
        $continue = false;
		if( $obj->dockClientCount > 0)
		foreach( $obj->get_dockList() as $v )
			{
				if( $v->visible )
				{
					$continue = true;
				}
			}
		self::$crz = true;	
		$orient = ($obj->name == 'pDockLeft' || $obj->name == 'pDockRight')? 0: 1;
		if ($continue || $source->visible)
		{
			if( isset(self::$orients[$source->self]) && (self::$orients[$source->self] <> $orient) ) {
				list($w, $h) = $continue? [$source->w, $source->h]: [max($source->w, $obj->w), max($source->h, $obj->h)];
				list($obj->h, $obj->w, $source->h, $source->w) = [$w, $h, $w, $h];
			}elseif( $obj->w < 30){
				$obj->w = 220;
				$source->w = 220;
				
			}
		}
		self::$orients[$source->self] = $orient;
        self::$crz = false;
		$GLOBALS['_sc']->update();
    }
    
    static function edk($self, $p, $source){
        
        $GLOBALS['_sc']->updateBtns();
         $continue = true;
		
        foreach( $self->get_dockList() as $v )
			{
				if( $v->visible && $v->self !== $source )
				{
					$continue = false;
				}
			}
            if($continue)$self->$p = 5;
		$GLOBALS['_sc']->update();
    }
	
	static function onUndock($self, $source){
		self::edk(c($self), 'w', $source);
	}
	
	static function nrsz($self,$p)
	{
		if( $self->$p <= 10 )
		{
			$list = $self->get_dockList();
			if( !empty($list) )
				foreach($list as $ev)
			$ev->visible = false;
			self::$crz = false;
		}else self::$crz = true;
		if( isset($GLOBALS['_sc']) )
			if( is_object($GLOBALS['_sc']))
				$GLOBALS['_sc']->update();
	}
	
	static function crsz($self, $p, $npv, &$r)
	{
		if( $self->$p <= 10 && $npv >= 10 && !self::$crz )
		{
			$self->get_dockList();
			$r = false;
			if( !empty($list) )
				foreach($list as $ev)
				if($ev->visible){ $r = true; return; }
		}
	}
	
	static function onResize($self)
	{
		self::nrsz(c($self), 'w');
	}
	
	static function onCanResize($self, &$nW, &$nH, &$can)
	{
		ev_fmMain_pDockLeft::crsz(c($self), 'w', $nW, $can);
	}
}

class ev_fmMain_pDockRight {
	
    static function onDockDrop($self, $source=1, $x, $y){
        ev_fmMain_pDockLeft::onDockDrop($self, $source, $x, $y);
    }
    
    
    static function onUndock($self, $source){
       ev_fmMain_pDockLeft::onUnDock($self, $source);
    }
	
	static function onResize($self)
	{
		ev_fmMain_pDockLeft::nrsz(c($self), 'w');
	}
	
	static function onCanResize($self, &$nW, &$nH, &$can)
	{
		ev_fmMain_pDockLeft::onCanResize($self, $nW, $nH, $can);
	}
}

class ev_fmMain_pDockBottom {

    static function onDockDrop($self, $source=1, $x, $y){
       
        $GLOBALS['_sc']->updateBtns();
        
        $obj = c($self);
        $source = c( dragobject_control($source) );
        $continue = false;
		foreach( $obj->get_dockList() as $v )
			{
				if( $v->visible )
				{
					$continue = true;
				}
			}
		ev_fmMain_pDockLeft::setcrz(true);
		if (($continue || $source->visible) && $obj->h < 30 ){
            $obj->h = 170;
            $source->h = 170;
          }
		  
        ev_fmMain_pDockLeft::setcrz(false);
        $GLOBALS['_sc']->update();
    }
    
    static function onUndock($self, $source=1){
        
        ev_fmMain_pDockLeft::edk(c($self), 'h', $source);
    }
	
	static function onResize($self)
	{
		ev_fmMain_pDockLeft::nrsz(c($self), 'h');
	}
	
	static function onCanResize($self, &$nW, &$nH, &$can)
	{
		ev_fmMain_pDockLeft::crsz(c($self), 'h', $nH, $can);
	}
}


class ev_fmMain_c_formComponents {
    
    static function onChange($self){
        
        global $fmEdit;
        
        $index = c($self)->itemIndex;
        
        if ($index===0) $obj = $fmEdit;
        else {
            
            global $_FORMS, $formSelected;
            $forms = myProject::getFormsObjects();
            $obj = $fmEdit->findComponent($forms[$_FORMS[$formSelected]][$index-1]['NAME']);
        }
		
       	if(!$obj->self) $obj = $fmEdit;
        myDesign::inspectElement($obj);
    }
}

class ev_fmMain_pDockMain {
    
    static function doit(){
        global $_sc, $fmEdit;

        myDesign::formProps();
        $fmEdit->parent = c('fmMain->pDockMain');
        $_sc->clearTargets();
    }
    
    static function onClick($self=0){
        setTimeout(15,'ev_fmMain_pDockMain::doit()');
    }
}

class ev_fmMain_c_type {
    
    static function onChange($self)
	{
        c('fmMain->list')->smallIcons = ( _c($self)->itemIndex == 1 );
    }
}
class ev_fmMain_c_search
{
	public static $is_search = false;
	public static $changing;
	private static $timerSelf = false;
	private static $self;
    static function onChange($self)
	{
		self::$changing = true;
		self::$self = $self;
		if( self::$timerSelf==false )
			self::$timerSelf = Timer::SetInterval(__CLASS__ . '::doInterval', 250);
    }
	static function doInterval($s=false)
	{
		if(self::$self == false) return;
		if( self::$changing )
		{
			self::$changing = false;
		} else {
			if(!self::$is_search)
			{
				myOptions::set("components","groups", implode(",",c("fmMain->list")->selectedList));
				resetCompList();
			}
			$text = _c(self::$self)->text;
			if(trim($text)){
				self::$is_search =  true;
				searchCompList($text);
			}else{
				self::$is_search = false;
				resetCompList();
			}
			self::$self = false;
		}
	}
}
class ev_fmMain_c_tcursor{
	static function onClick($self){
		global $_componentPanel;
		$_componentPanel->unSelect();
		myVars::set(false, 'selectedClass');
	}
}

class ev_fmMain_shapeSize {
    private static $self_object;
	private static $hbar;
	private static $vbar;
	private static $timer;
	private static $phbars;
    static function typeCursor($self, $x, $y){
        
        $obj = toObject($self);
        $w   = $obj->w;
        $h   = $obj->h;
        $curType = crDefault;
        
        if ( $y>$h-$GLOBALS['sc_offset'] ){
            $curType = crSizeNS;
        }
        
        if ( $x>$w-$GLOBALS['sc_offset'] ){
            $curType = crSizeWE;
        }
        
        if ( $y>$h-$GLOBALS['sc_offset'] && $x>$w-$GLOBALS['sc_offset']){
            $curType = crSizeNWSE;
        }
        
        return $curType;    
    }
    
    static function onMouseDown($self, $button, $shift, $x, $y){
        if( $button == 1 ) return;
        global $shapeSize, $_preX, $_preY, $curType, $_scgridSize;
        c('fmMain->pDockMain',1)->doubleBuffer = true;
        
        $obj = _c($self);
       
        $shapeSize = true;
		$_scgridSize = $GLOBALS['_sc']->AlignToGrid? myOptions::get('sc','gridSize',8): 1;
        
        $curType = self::typeCursor($self, $x, $y);
        $obj->cursor = $curType;
		
		if(!isset(self::$timer))
		{
			self::$self_object = $obj;
			self::$timer 	   = new TTimerEx();
			self::$timer->interval = 5;
			self::$timer->workbackground = true;
			self::$timer->repeat = true;
			self::$timer->prioruty = tpHigher;
			self::$timer->onTimer = __CLASS__ . '::onTimer';
		}
		
			self::$hbar = c("fmEdit->pDockMain")->HorzScrollBar;
			self::$vbar = c("fmEdit->pDockMain")->VertScrollBar;
		$_preX = false;
		self::$phbars = [self::$hbar->position, self::$vbar->position];
		self::$timer->enabled = true;
    }

    static function onTimer($self){
        
        global $curType, $shapeSize, $fmEdit, $_scgridSize;
        
        $obj = self::$self_object;
	/////// Просто ужаснейший костыль, наверное. но другого выхода не нашёл \\\\\\\
		$x = cursor_offsetted_x($obj);
		$y = cursor_offsetted_y($obj) -16;
		//dssMessages::framewiz(1, "x=>{$x}, y=>{$y}"); --новый вид лога
		if ($shapeSize)
		{
			$w   = $obj->w;
			$h   = $obj->h;
			if ($fmEdit->autoSize) return;
			$minW = $fmEdit->constraints->minWidth;
			$minH = $fmEdit->constraints->minHeight;
			$maxW = $fmEdit->constraints->maxWidth;
			$maxH = $fmEdit->constraints->maxHeight;

            $x = $x - ($x%$_scgridSize);
            
            if ($curType==crSizeWE || $curType==crSizeNWSE){
                if ((($x-($_scgridSize * 2)-1 < $maxW) || $maxW==0) && (($x-($_scgridSize * 2)-1 > $minW) || $minW==0)){
                    $x = $x-$_scgridSize * 2;
                }
            }
            
            $y = $y - ($y%$_scgridSize);
            
            if ($curType==crSizeNS || $curType==crSizeNWSE){
                
                if ((($y-($_scgridSize * 2)-1 < $maxH) || $maxH==0) && (($y-($_scgridSize * 2)-1 > $minH) || $minH==0)){
                    $y = $y - $_scgridSize * 2;
                }
               
            }	
				if($obj->cursor !== $curType)
				$obj->cursor = $curType;
				if ($curType==crSizeWE || $curType==crSizeNWSE)
				{
					$fmEdit->w = $x;
					c('fmMain->shapeSize',1)->w = $fmEdit->w + $GLOBALS['sc_offset']*2;
				}
				if ($curType==crSizeNS || $curType==crSizeNWSE)
				{
					$fmEdit->h = $y;
					c('fmMain->shapeSize',1)->h = $fmEdit->h + $GLOBALS['sc_offset']*2;
				}
				global $propFormW, $propFormH;
				$propFormW->value = $fmEdit->w;
				$propFormH->value = $fmEdit->h;
		} else {
            
            $obj->cursor = self::typeCursor($obj, $x, $y);
        }
    }
    static function onMouseMove($self, $shift, $x, $y)
	{
		global $shapeSize;
		if( !$shapeSize )
		{
			$obj = _c($self);
			$obj->cursor = self::typeCursor($obj, $x, $y);
		}
	}
    static function onMouseUp($self, $shift, $x, $y){
        
        global $shapeSize;
        $shapeSize = false;
		self::$timer->enabled = false;
    }
}

class ev_itemCAll {
    
    static function onClick($self=false){
        global $fmEdit, $_sc, $myEvents, $myProperties;
		${0} = false;
        foreach( $fmEdit->componentList as $c )
		{
			if( $c->self !== $_sc->self && gui_is($c->self, 'TControl') )
			{
				if(${0}===false)
					${0} = $c;
				$_sc->addTarget($c);
			}
		}
		if(${0}!==false)
		{
			$myEvents->generate(${0});
			$myProperties->generate(${0}->self, c('fmPropsAndEvents->tabProps',1));
		}
	}
}
//add these please
class ev_fmMain_itemInvert {
	static function onClick($self=nil)
	{
		global $fmEdit, $_sc, $myEvents, $myProperties;
		$targets = count($_sc->targets_ex) ? $_sc->targets_ex : [$fmEdit];
		${0} = false;
		$_sc->ClearTargets();
		foreach( $fmEdit->componentList as $c )
		{
			if( $c->self === $_sc->self || !gui_is($c->self, "TControl") || in_array($c, $targets) ) continue;
			if(${0}===false)${0} = $c;
			$_sc->addTarget($c);
		}
		if(${0}!==false)
		{
			$myEvents->generate(${0});
			$myProperties->generate(${0}->self, c('fmPropsAndEvents->tabProps',1));
		}
	}
}

//base class for image buttons */button displaying/*
class fmain_ibtn {
	static $onClick;
	static $images;
	static $last;
	static $list;
	static function s($callback)
	{
		
		self::sevent(substr(get_called_class(),10), $callback);
	}
	static function reloadDsgn($theme)
	{
		foreach (self::$list as $ic=>$zero)
		{
			$s = c('fmMain->'.$ic);
			self::$images[$s->self] = [];
			self::setDsgn($s,$ic,"{$theme}/{$ic}");
		}
	}
	static function setDsgn(&$s, $ic, $is)
	{
		for($i=1;$i<4;$i++)
		{
			if ( file_exists($is.'_'.$i.'.bmp') )
			{
				self::$images[$s->self][] = [file_get_contents( $is.'_'.$i.'.bmp' ), 'bmp']; 
			} elseif( file_exists($is.'_'.$i.'.png') )
			{
				self::$images[$s->self][] = [file_get_contents( $is.'_'.$i.'.png' ), 'png']; 
			} elseif( file_exists($is.'_'.$i.'.jpg') )
			{
				self::$images[$s->self][] = [file_get_contents( $is.'_'.$i.'.jpg' ), 'jpeg']; 
			} elseif( file_exists($is.'_'.$i.'.gif') )
			{
				self::$images[$s->self][] = [file_get_contents( $is.'_'.$i.'.gif' ), 'gif']; 
			}else break;
			
		}
		self::state( $s->self );
	}
	static function sevent($ic, $callback)
	{
		$s = c('fmMain->'.$ic);
		self::$onClick[$s->self] = $callback;
		self::$list[$ic] = 0;
		self::setDsgn($s,$ic,dsThemeDesign::$dir . '/' . $ic);
	}
	static function state($s, $index=0)
	{
		if( isset(self::$images[$s][$index]) )
		{
			_c($s)->picture->loadFromStr( ...self::$images[$s][$index] );
		} else 
			_c($s)->picture->Clear();
	}
	static function onMouseEnter($self)
	{
		self::state($self, 1);
	}
	static function onMouseLeave($self)
	{
		self::state($self);
	}
	static function onBlur($self)
	{
		self::state($self);
	}
	static function onUnfocus($self)
	{
		self::state($self);
	}
	static function onMouseDown($self)
	{
		self::state($self, 2);
	}
	
	static function onMouseUp($self)
	{
		self::state($self, 1);
		
		if( is_callable(self::$onClick[$self]) )
			call_user_func(self::$onClick[$self]);
	}
}

//one of the child classes to display buttons correctly */button displaying/*
class ev_fmMain_btn_delForm extends fmain_ibtn {}

class ev_fmMain_btn_newForm extends fmain_ibtn {}

class ev_fmMain_btn_newProject extends fmain_ibtn {}

class ev_fmMain_btn_saveProject extends fmain_ibtn {}

class ev_fmMain_btn_openProject extends fmain_ibtn {}

class ev_fmMain_btn_stop  extends fmain_ibtn {}

class ev_fmMain_btn_run extends fmain_ibtn {}

class ev_fmMain_btn_rundebug extends fmain_ibtn {}

class ev_fmMain_btn_make extends fmain_ibtn {}

$fmMain_reloadims =
function($theme)
{
	//loading every skinnable icon in the main form */*2nd-party buttons and menu items displaying*/*
	//
	//iterating troughout icons-stylezeable components
	foreach( array("btn_addEvent", "itemAddevent", "btn_editEvent", "btn_changeEvent", "btn_delEvent",
	/*Object Menu->>>*/	  "itemDel", "itemCopy", "itemCut", "itemGroup", "itemPaste", "itemInvert", 
	"itFile"	/*->>>*/, "it_new", "it_new_form", "it_new_project", "it_open", "it_save", "it_saveas",
	"itOptions"	/*->>>*/, "it_undo", "it_redo", "it_preference",
	"itService"	/*->>>*/, "it_components", "it_objectinspector", "it_props", "it_debuginfo",
	"itProject"	/*->>>*/, "it_run", "it_stopprogram", "it_buildproject", "it_projectmodules", "it_projectoptions",
	"it_Utils"	/*->>>*/, /*@Services@ items*/
	"itLanguage"/*->>>*/, /*@Languages@ list*/
	"itHelp"	/*->>>*/, "it_registration", "it_tip", "it_aboutprogram", "it_siteprogram", "it_sendmail",
	/*Forms page menu->>>*/"fp_delete", "fp_new", "fp_clone", "fp_rename", "fp_left", "fp_right"
	) as $c )
		if( file_exists("{$theme}/{$c}.bmp") )
		{
			c("fmMain->{$c}")->picture->loadFromFile(		"{$theme}/{$c}.bmp" );
		} elseif ( file_exists("{$theme}/{$c}.png") ) {
			c("fmMain->{$c}")->picture->loadFromFile(		"{$theme}/{$c}.png" );
		} elseif ( file_exists("{$theme}/{$c}.gif") ) {
			c("fmMain->{$c}")->picture->loadFromFile(		"{$theme}/{$c}.gif" );
		} elseif ( file_exists("{$theme}/{$c}.tiff") ) {
			c("fmMain->{$c}")->picture->loadFromFile(		"{$theme}/{$c}.tiff" );
		} elseif  ( file_exists("{$theme}/{$c}.ico") ) {
			c("fmMain->{$c}")->picture->loadFromFile(		"{$theme}/{$c}.ico" );
		}
	
	
	c("fmMain->itemCall")->picture->loadFromFile(			"{$theme}/mi_select.bmp" );
	c("fmMain->itemSendtofront")->picture->loadFromFile(	"{$theme}/mi_bringtofront.bmp" );
	c("fmMain->itemSendtoback")->picture->loadFromFile(		"{$theme}/mi_sendtoback.bmp" );
	
};

event_set(c("fmMain->pDockMain")->self, 'OnScrollVert', function($self, $scrollCode, &$scrollPos)
{
	$GLOBALS['_sc']->update();
});
event_set(c("fmMain->pDockMain")->self, 'onScrollHorz', function($self, $scrollCode, &$scrollPos)
{
	$GLOBALS['_sc']->update();
});
$fmMain_reloadims(dsThemeDesign::$dir);//#ADDOPT;

dsThemeDesign::RegisterRFunc('fmain_ibtn::reloadDsgn',$fmMain_reloadims);