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
        
        global $dsg_cfg;
        if ($last_ver){
            
            if ($dsg_cfg->main->lastVer!==$last_ver && compareVer($last_ver, '3.0.4.0')===1){
                
                $dsg_cfg->main->lastVer = $last_ver;
                
                if (messageBox(t("Воу, ты устарел,\nуже доступна версия %s\nОбновить программу?",$last_ver), t('.: Мастер обновления :.'), MB_YESNO)==mrYes){
                    
                    ev_it_masterupdate::onClick();
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
        
        global $dsg_cfg, $_sc, $fmEdit, $fmComponents, $fmMain, $fmObjInspect;
        $_sc->clearTargets();
        myProperties::unFocusPanel(); // fix AV !!!
        
        $dsg_cfg->main->gridSize = $_sc->gridSize;
        $dsg_cfg->main->BtnColor = (int)$_sc->BtnColor;
		$dsg_cfg->main->BtnColorDisabled = (int)$_sc->BtnColorDisabled;
        $dsg_cfg->main->showGrid = (int)$_sc->showGrid;
        $dsg_cfg->main->lastVer  = $fmMain->lastVer;
        
        myProject::clearProject(); // for fix AV
        
        $dsg_cfg->fmMain->x  = $fmMain->left;
        $dsg_cfg->fmMain->y  = $fmMain->top;
        $dsg_cfg->fmMain->w  = $fmMain->width;
        $dsg_cfg->fmMain->h  = $fmMain->height;
        $dsg_cfg->fmMain->wS = $fmMain->windowState;
        
        $dsg_cfg->lastVer    = DV_VERSION;
        
        $dsg_cfg->fmPHPEditor->w = c('fmPHPEditor',1)->w;
        $dsg_cfg->fmPHPEditor->h = c('fmPHPEditor',1)->h;
        $dsg_cfg->fmPHPEditor->x = c('fmPHPEditor',1)->x;
        $dsg_cfg->fmPHPEditor->y = c('fmPHPEditor',1)->y;
        $dsg_cfg->fmPHPEditor->wS= c('fmPHPEditor',1)->windowState;
        $dsg_cfg->fmPHPEditor->panelH = c('fmPHPEditor->errPanel')->h;
        
        $dsg_cfg->fmObjInspect->visible = (int)$fmObjInspect->visible;
        $dsg_cfg->newProjectDialog->startup = (int)c('fmNewProject->startup')->checked;
        $dsg_cfg->saveToFile(DS_USERDIR.'config.ini');
        
        Docking::saveFile(c('fmMain->pDockBottom'),DS_USERDIR.'bottom.dock');
        Docking::saveFile(c('fmMain->pDockRight'),DS_USERDIR.'right.dock');
        Docking::saveFile(c('fmMain->pDockLeft'),DS_USERDIR.'left.dock');
        
        myOptions::set('pDockRight','width', c('fmMain->pDockRight')->w);
        myOptions::set('pDockLeft','width', c('fmMain->pDockLeft')->w);
        myOptions::set('pDockBottom','height', c('fmMain->pDockBottom')->h);

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
	    
	${00} = array('psSolid', 'psDash', 'psDot', 'psDashDot', 'psDashDotDot', 'psClear', 'psInsideFrame', 'psUserStyle', 'psAlternate');
	${01} = myOptions::get('sc','penStyle',1);
		
	c('fmMain->shapeSize')->penStyle = ${00}[${01}];
        
		myOptions::getXYWH('rundebug', c('fmRunDebug'));
		
        c('fmMain->pDockRight')->w = myOptions::get('pDockRight','width',200);
        c('fmMain->pDockLeft')->w = myOptions::get('pDockLeft','width',220);
        c('fmMain->pDockBottom')->h = myOptions::get('pDockBottom','height',220);
        
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
        switch(messageBox(t('ds_on_exit'),t('Closing Devel Studio'),MB_YESNOCANCEL)){
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

class ev_it_siteprogram {
    
    static function onClick(){
        
        shell_execute(0,'open','http://kashaproduct.at.ua/','','',SW_SHOW);
    }
}

class ev_fmMain_it_phphelp {
    
    static function onClick(){
        run('http://php.su/learnphp/');
    }
}

class ev_it_helpbook {
    
    static function onClick() {
        
        return shell_execute(0,'open','http://help.develstudio.ru/Vvedenie-16.html','','',SW_SHOW);
        
        if (!file_exists(DOC_ROOT . '/lang/' . LANG_ID . '/help.chm'))
            dsErrorDebug::msg(t('Help book not found for this language'));
        else
            shell_execute(0,'open', DOC_ROOT . '/lang/' . LANG_ID . '/help.chm');
    }
}

class ev_it_aboutprogram {
    
    static function onClick(){
        
        c('fmAbout')->showModal();
    }
}

class ev_it_exit {
    
    static function onClick(){
        c('fmMain')->close();
    }
}

class ev_statusBar {
    
    static function onClick(){
        
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
        form_parent($fmEdit->self, c('fmMain->pDockMain')->self);
        $_sc->clearTargets();
    }
    
    static function onClick(){
        setTimeout(15,'ev_fmMain_pDockMain::doit()');
    }
}

class ev_fmMain_c_type {
    
    static function onChange($self){
        
        c('fmMain->list')->smallIcons = ( c($self)->itemIndex == 1 );
    }
}
class ev_fmMain_c_search{
    static function onChange($self){
		if(!$GLOBALS["is_search"]){ myOptions::set("components","groups", implode(",",c("fmMain->list")->selectedList));
		resetCompList(); }
		if(trim(c($self)->text)){
			$GLOBALS['is_search'] =  true;
			searchCompList(c($self)->text);
		}else{
			$GLOBALS['is_search'] = false;
			resetCompList();
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
	private static $timer;
	
    static function typeCursor($self, $x, $y){
        
        $obj = toObject($self);
        $w   = $obj->w;
        $h   = $obj->h;
        $curType = crDefault;
        
        if ( $y>$h-20 ){
            $curType = crSizeNS;
        }
        
        if ( $x>$w-20 ){
            $curType = crSizeWE;
        }
        
        if ( $y>$h-20 && $x>$w-20){
            $curType = crSizeNWSE;
        }
        
        return $curType;    
    }
    
    static function onMouseDown($self, $button, $shift, $x, $y){
        
        global $shapeSize, $_preX, $_preY, $curType;
        c('fmMain->pDockMain',1)->doubleBuffer = true;
        
        
        $obj = _c($self);
        $_preX = $obj->w - $x;
        $_preY = $obj->h - $y;
        $shapeSize = true;
        
        $curType = self::typeCursor($self, $x, $y);
        $obj->cursor = $curType;
		self::$self_object = $self;
		if(!isset(self::$timer))
		{
			self::$timer 	   = new TTimerEx();
			self::$timer->interval = 5;
			self::$timer->workbackground = true;
			self::$timer->repeat = true;
			self::$timer->prioruty = tpTimeCritical;
			self::$timer->onTimer = __CLASS__ . '::onTimer';
		}
		self::$timer->enabled = true;
    }
    
    static function onTimer($self){
        
        global $curType, $shapeSize, $_preY, $_preX, $fmEdit;
        
        $obj = _c(self::$self_object);
	/////// Просто ужаснейший костыль, наверное. но другого выхода не нашёл \\\\\\\
		$x = cursor_offsetted_x($obj)  + $obj->parent->HorzScrollBar->position;
		$y = cursor_offsetted_y($obj) - 20 + $obj->parent->VertScrollBar->position;
		//20, position - фикс бага с TScrollBox, т.к при перемещении формы он задаёт ей позицию как пожелает
		
        if ($shapeSize)
		{
			$w   = $obj->w;
			$h   = $obj->h;
			
			$fW   = $fmEdit->w;
			$fH   = $fmEdit->h;
			$minW = $fmEdit->constraints->minWidth;
			$minH = $fmEdit->constraints->minHeight;
			$maxW = $fmEdit->constraints->maxWidth;
			$maxH = $fmEdit->constraints->maxHeight;
			$aSize= $fmEdit->autoSize;
			$gridSize = myOptions::get('sc','gridSize',8);
        
            if ($fW<0 || $fH<0) return;
                
            if ($aSize) return;
            
            $obj->cursor = $curType;
            
            if( $fmEdit->y !== (c("fmMain->shapeSize")->y + 9) ) 
			{
				$fmEdit->y = c("fmMain->shapeSize")->y + 9;
				$fmEdit->x = c("fmMain->shapeSize")->x + 8;
            }
            $new_w = $x+1 + $_preX;
            $new_w = $new_w - $new_w% $gridSize;
            
            if ($curType==crSizeWE || $curType==crSizeNWSE){
                if ((($new_w-($gridSize * 2)-1 < $maxW) || $maxW==0) && (($new_w-($gridSize * 2)-1 > $minW) || $minW==0)){
                    c('fmMain->shapeSize',1)->w = $new_w < 1 ? $gridSize * 2 : ($new_w - $gridSize * 2) + 17;
                    $fmEdit->w = $new_w-$gridSize * 2;
                }
            }
            
            $new_h = $y+1 + $_preY;
            $new_h = $new_h - ($new_h % $gridSize );
            
            if ($curType==crSizeNS || $curType==crSizeNWSE){
                
                if ((($new_h-($gridSize * 2)-1 < $maxH) || $maxH==0) && (($new_h-($gridSize * 2)-1 > $minH) || $minH==0)){
                    c('fmMain->shapeSize',1)->h = $new_h < 1 ? $gridSize * 2 : ($new_h - $gridSize * 2) + 17;
                    $fmEdit->h = $new_h - $gridSize * 2;
                }
               
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
    
    static function onClick(){
        global $fmEdit, $_sc;

        foreach( $fmEdit->componentList as $c )
		{
			if( $c->self !== $_sc->self )
				$_sc->addTarget($c);
		}
	}
}
//add these please
class ev_fmMain_itinvertce {
	static function onClick()
	{
		global $fmEdit, $_sc;
		$targets = count($_sc->targets_ex) ? $_sc->targets_ex : array($fmEdit);
		foreach( $fmEdit->componentList as $c )
		{
			if( $c->self !== $_sc->self )
				if( in_array($c, $targets) )
				{
					$_sc->unRegisterTarget($c);
				} else { 
					$_sc->addTarget($c);
				}
		}
	}
}

//base class for image buttons */button displaying/*
class fmain_ibtn {
	static $onClick;
	static $images;
	static function s($callback)
	{
		self::sevent(substr(get_called_class(),10), $callback);
	}
	static function sevent($ic, $callback)
	{
		self::$onClick[c('fmMain->'.$ic)->self] = $callback;
		$is = DOC_ROOT.'design/theme/' . myOptions::get('prefs','studio_theme', 'light') . '/' . $ic; //#ADDOPT;
		for($i=1;$i<4;$i++)
		{
			if ( file_exists($is.'_'.$i.'.bmp') )
			{
				self::$images[c('fmMain->'.$ic)->self][] = [file_get_contents( $is.'_'.$i.'.bmp' ), 'bmp']; 
			} elseif( file_exists($is.'_'.$i.'.png') )
			{
				self::$images[c('fmMain->'.$ic)->self][] = [file_get_contents( $is.'_'.$i.'.png' ), 'png']; 
			} elseif( file_exists($is.'_'.$i.'.jpg') )
			{
				self::$images[c('fmMain->'.$ic)->self][] = [file_get_contents( $is.'_'.$i.'.jpg' ), 'jpeg']; 
			} elseif( file_exists($is.'_'.$i.'.gif') )
			{
				self::$images[c('fmMain->'.$ic)->self][] = [file_get_contents( $is.'_'.$i.'.gif' ), 'gif']; 
			}else break;
			
		}
		self::state( 'fmMain->'.$ic );
	}
	static function state($s, $index=0)
	{
		$arr = self::$images[c($s)->self];
		if( isset($arr[$index]) )
		{
			$img = $arr[$index];
			c($s)->picture->loadFromStr( $img[0], $img[1]);
			c($s)->index = $index;
		}
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

function fmMain_reloadims()
{
	//loading every skinnable icon in the main form */*2nd-party buttons and menu items displaying*/*
	$theme = DOC_ROOT . 'design/theme/' . myOptions::get('prefs','studio_theme', 'light'); //#ADDOPT;
	//iterating troughout icons-styleziable components
	foreach( array("btn_addEvent", "itemAddevent", "btn_editEvent", "btn_changeEvent", "btn_delEvent",
	/*Object Menu->>>*/	  "itemDel", "itemCopy", "itemCut", "itemGroup", "itemPaste", 
	"itFile"	/*->>>*/, "it_new", "it_open", "it_save", "it_saveas",
	"itEdit"	/*->>>*/, "it_undo", "it_redo", "it_preference",
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
	
}

event_set(c("fmMain->pDockMain")->self, 'OnScrollVert', function($self, $scrollCode, &$scrollPos)
{
	global $_sc;
	$_sc->update();
});
event_set(c("fmMain->pDockMain")->self, 'onScrollHorz', function($self, $scrollCode, &$scrollPos)
{
	global $_sc;
	$_sc->update();
});
fmMain_reloadims();
