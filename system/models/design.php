<?
class myDesign
{
    static $canselect = true;
    
    static function formName(){
        
        global $_FORMS, $formSelected;
        return $_FORMS[$formSelected];
    }
    
    // возвратить список компонентов (имен) в группе
    static function getGroup($obj){
        
        $arr  = (array)myProject::cfg('_grouping');
        $name = strtolower($obj->name);
        
		if(isset($arr[self::formName()]))
			foreach ((array)$arr[self::formName()] as $i=>$group){
				foreach ((array)$group as $x_name)
					if (strtolower($x_name)==$name)
                    return $group;	
			}
        
        return [];
    }
    
    // добавляет выделенные элементы в группу...
    static function addGroup(){
        
        global $_sc;
        $group   = [];
        $targets = $_sc->targets_ex;
        $arr  = (array)myProject::cfg('_grouping');
        
        
        foreach ($targets as $el){
            
            if (count(self::getGroup($el))==0){
                
                self::delObjFromGroups($el);
                $group[] = $el->name;
            }
        }
        
        if (count($group)>0){
            
            $arr[self::formName()][] = $group;
            
            myProject::cfg('_grouping',$arr);
        }
    }
    
    static function groupChangeFormName($name, $new_name){
        
        $arr  = (array)myProject::cfg('_grouping');
        
        $arr[$new_name] = $arr[$name];
        unset($arr[$name]);
        
        myProject::cfg('_grouping',$arr);   
    }
    
    static function eventChangeFormName($name, $new_name){
        
        eventEngine::$DATA[strtolower($new_name)] = eventEngine::$DATA[strtolower($name)];
        unset(eventEngine::$DATA[strtolower($name)]);
    }
    
    static function changeName($obj, $new_name){
        
        global $fmEdit;
        if ( $fmEdit->findComponent($new_name) ) return;
        
        self::groupChangeObjName($obj->name, $new_name);
        eventEngine::changeName($obj->name, $new_name);
        
        $obj->name = $new_name;
        //TEvents::searchEvent($obj, $fmEdit, false); // fix bug
        
        myInspect::refreshItem($obj);
        myInspect::selectObject($obj);
        myInspect::genList($obj);
    }
    
    static function groupChangeObjName($name, $new_name){
        
        $arr  = (array)myProject::cfg('_grouping');
        
        if (!$name) return;
        
        foreach ((array)$arr[self::formName()] as $i=>$group){
            
            foreach ($group as $j=>$x_name)
                if (strtolower($x_name)==$name){
                   
                    $arr[self::formName()][$i][] = $new_name;
                    unset($arr[self::formName()][$i][$j]);
                    $arr[self::formName()][$i] = array_values( $arr[self::formName()][$i] );
                }
        }
        
        myProject::cfg('_grouping',$arr);   
    }
    
    // удаляет объект из всех групп
    static function delObjFromGroups($obj){
        
        $arr  = (array)myProject::cfg('_grouping');
        $name = strtolower($obj->name);
        
        if (!$name) return;
        
        foreach ((array)$arr[self::formName()] as $i=>$group){
            
            foreach ($group as $j=>$x_name)
                if (strtolower($x_name)==$name){
                    unset($arr[self::formName()][$i][$j]);
                    $arr[self::formName()][$i] = array_values($arr[self::formName()][$i]);
                }
        }
        
        myProject::cfg('_grouping',$arr);
    }
    
    static function unGroup(){
        
        global $_sc, $myProperties;
        
        $arr  = (array)myProject::cfg('_grouping');
        $name = strtolower($myProperties->selObj->name);
        
        if (!$name) return;
        
        foreach ((array)$arr[self::formName()] as $i=>$group){
            
            foreach ($group as $x_name)
                if (strtolower($x_name)==$name){
                    unset($arr[self::formName()][$i]);
                    $arr[self::formName()] = array_values($arr[self::formName()]);
                    
                    myProject::cfg('_grouping',$arr);
                    return;
                }
        }
    }
    
    static function getClassInfo($class){
        
        global $componentClasses;
        return BlockData::getItem($componentClasses, $class, 'CLASS');
    }
    
    static function selectClass($panel, $btn){
        
        global $componentClasses;
		if(!ev_fmMain_c_search::$is_search)
		{
			myOptions::set('components','groups', implode(',',c('fmMain->list')->selectedList));
		} else {
			if( (bool) (int)myOptions::get('search','grselcomp', "0") ) //#ADDOPT
				myOptions::set('components','groups', implode(',',c('fmMain->list')->selectedList) . "," . myOptions::get('components','groups'));
		}
        myVars::set($componentClasses[$btn], 'selectedClass');
    }
    
    static function inspectGroup($obj, $gen = true){
        
        global $fmEdit;
        
        if ($gen)
            self::inspectElement($obj);
        
        $group = self::getGroup($obj);
        
        foreach ((array)$group as $name){
            
            $el = $fmEdit->findComponent($name);
            self::inspectElement($el, false);
        }
    }
    
    static function inspectElement($obj, $gen = true){
        
        global $myProperties, $myEvents, $myInspect, $_sc, $selectedClass, $_componentPanel;
		if(!self::$canselect)
		{
			self::$canselect = true;
			return;
		}
        if ($gen)
        $_sc->clearTargets();
        
        $_sc->addTarget($obj);
        
        if ($gen){
        if ($selectedClass){
            $_componentPanel->unSelect();
			$selectedClass = false;
        }               
			
            $myProperties->generate($obj->self,c('fmMain->tabProps',1));
            $myEvents->_generate($obj);
            
        }
        
        if ($gen)  
        myHistory::go();
    }
    
    static function countComponentsByClass($class){
        
        global $fmEdit;
        $components = $fmEdit->componentList;
        $result     = 0;
        foreach ($components as $el){
            
            if ($el->isClass($class))
                ++$result;
        }
        
        return $result;
    }
    
    static function getNoExistsNameIndex($class){
        
        global $fmEdit;
        
        if (is_object($class)) $class = $class->className;
        $classInfo = self::getClassInfo($class); // информация о классe...
        
        $name = $classInfo['NAME'];
        $i = 1;
        $to = vsprintf($classInfo['NAME'].'%s', $i);
        
        while (is_object($fmEdit->findComponent($to))){
            
            ++$i;
            $to = vsprintf($classInfo['NAME'].'%s', $i);
        }
        
        return $i;
    }
    
    static function getNoExistsName($class){
        
        $i = self::getNoExistsNameIndex($class);
        $classInfo = self::getClassInfo($class); // информация о классe...
        return vsprintf($classInfo['NAME'].'%s', $i);
    }
    
    static function isWinControl($obj)
	{
        return gui_is($obj->self, 'TWinControl');//немного оптимизации
    }
    
    static function lastComponent(){
        
        global $fmEdit;
        
        $result = $fmEdit;
        $components = $fmEdit->componentList;
        foreach ($components as $el){
            
            if ($el->name)
                $result = $el;
        }
    
        return $result;
    }
    
    static function createComponent($x = 20, $y = 20, $parent = nil, $w = false, $h = false){
        
        global $fmEdit, $_sc, $_componentPanel, $selectedClass;
        
        
        $c = myVars::get('selectedClass');
        if ($c['CLASS'] == 'TCursor') return;
        
        $_sc->clearTargets();
        
		if ($c){
            if(c("fmComponents->c_search")->text !== ''){
				c("fmComponents->c_search")->text = '';
				//myOptions::set("components","groups", implode(",",c("fmMain->list")->selectedList));
			}
			if (isset($c['IS_ONE']))
            if ($c['IS_ONE'] && self::countComponentsByClass($c['CLASS'])>0){
                msg(t('This object class %s must be one on form',$c['CLASS']));
                
                myVars::set(false, 'selectedClass');
                $_componentPanel->unSelect();
                unset($selectedClass);
                
                self::formProps();
                $_sc->clearTargets();
                return false;
            }
                        
            $class = $c['CLASS'];
			self::$canselect = false;
            $obj = new $class($fmEdit);
            if (($parent->self!==$fmEdit->self) && is_subclass_of($obj,  '__TNoVisual') ){
                $x     += getAbsoluteX($parent->self, $fmEdit->self);
                $y     += getAbsoluteY($parent->self, $fmEdit->self);
                $parent = $fmEdit;
            } else {
            
                $parent = (is_object($parent) &&
                            gui_is($parent->self, 'TWinControl')) ? $parent : $fmEdit;
                
                if ($parent instanceof TPageControl){
                    
                    $y = $y - ($parent->h - $parent->activePage->h);
                    $parent = $parent->activePage;
                }
            }
            
            $id = self::getNoExistsNameIndex($obj);
            $obj->name = vsprintf($c['NAME'].'%s', $id);            
            
            foreach ((array)$c['PROPS'] as $prop=>$value){
                $obj->$prop = $value;
            }
         
            $x = round($x / $_sc->gridSize) * $_sc->gridSize;
            $y = round($y / $_sc->gridSize) * $_sc->gridSize;
            
            if ($w < $_sc->gridSize * 3) $w = false;
            if ($h < $_sc->gridSize) $h = false;
                     
            if ($w)
                $w = $w + $w % $_sc->gridSize;
            if ($h)
                $h = $h + $h % $_sc->gridSize;
            
            
            $x -= $_sc->gridSize;
            $y -= $_sc->gridSize;
            $obj->left = $x;
            $obj->top  = $y;

            if ($c['W'] && !$w){
                //$w = $c['W'] * $_sc->gridSize;
                $w = $c['W'] * 7;
                $w+= $w % $_sc->gridSize;
            }
            
            if ($c['H'] && !$h){
                //$h = $c['H'] * $_sc->gridSize;
                $h = $c['H'] * 7;
                $h+= $h % $_sc->gridSize;
            }

            if (is_subclass_of($obj,  '__TNoVisual')){
                
            } else {
                $obj->w = round($w / $_sc->gridSize) * $_sc->gridSize;
                $obj->h = round($h / $_sc->gridSize) * $_sc->gridSize;
            }
            /////////////////
            
            $obj->parent = $parent;
            if (is_subclass_of($obj,  '__TNoVisual'))
                $obj->text = '';
            else
                $obj->text = vsprintf($c['CAPTION'].'%s', $id);
           
            if ($class == 'TPageControl'){
                
                $obj->addPage(t('page%s',1));//->onMouseDown = 'myDesign::objMouseDown';
                $obj->addPage(t('page%s',2));//->onMouseDown = 'myDesign::objMouseDown';
                $obj->addPage(t('page%s',3));//->onMouseDown = 'myDesign::objMouseDown';
            }
            
            if ($class == 'TTabControl'){
                
                $obj->addPage(t('page%s',1));
                $obj->addPage(t('page%s',2));
                $obj->addPage(t('page%s',3));
            }
            
            $obj->onMouseDown     = 'myDesign::objMouseDown';
            $_sc->onSizeMouseDown = 'myDesign::selectComponent';
            $_sc->OnEndSizeMove   = 'myDesign::endSizeMove';
                  
            myVars::set(false, 'selectedClass');
            
            $_componentPanel->unSelect();
            unset($selectedClass);
            
            
            global $myProperties, $myEvents, $myInspect;
            $myProperties->generate($obj->self,c('fmPropsAndEvents->tabProps',1));
            $myEvents->generate($obj);
            $myInspect->addItem($obj);
            
            $_sc->addTarget($obj);
            myInspect::selectObject($obj);
            
			treeBwr_add();
			
            self::showPopup();
            
            myVars::set($obj->self, 'targetSelected');
            
            if (method_exists($obj,'__updateDesign'))
                $obj->__updateDesign();
                
            
            return $obj;
        }
        
        return false;
    }
    
    static function selectComponent($self, $target, $x, $y){
        
        global $_sc, $selectedClass, $myProperties, $fmEdit, $APPLICATION;
        $obj = _c($target);
        
        self::showPopup();
        
        if ($selectedClass){
            if (self::isWinControl($obj)){
                $tmp = self::createComponent($x, $y, $obj);
            } else {
                $a_x = getAbsoluteX($obj->self, $fmEdit->self);
                $a_y = getAbsoluteY($obj->self, $fmEdit->self);
                self::createComponent($x + $a_x, $y + $a_y, $fmEdit);
            }
            
        } else {
        
            setTimeout(25,"myDesign::_selectComponent($self, $target, $y, $y);");
            //myDesign::_selectComponent($self, $target, $y, $y);
        }
    }
    
    static function _selectComponent($self, $target, $x, $y){
        
        
        global $_componentPanel, $_sc, $selectedClass, $myProperties, $fmEdit, $APPLICATION;
        
        $obj = _c($target);
           
        myInspect::selectObject($obj);
        self::showPopup();
        myVars::set($target, 'targetSelected');
        
        if ($selectedClass && self::isWinControl($obj)){

            self::createComponent($x, $y, $obj);
        } else {
            
            // $c = myVars::get('selectedClass');
            if ($selectedClass){
                $_componentPanel->unSelect();
                $selectedClass = false;
            } else {
                    
                $_sc->addTarget($obj, false);
                global $myProperties, $myEvents;
                
                $myProperties->generate($target,c('fmPropsAndEvents->tabProps',1));
                $myEvents->generate($obj);
                
                //self::inspectElement(_c($target));
                self::inspectGroup($obj,false);
            }
        }
        
    }
    
    static function startSizeMove($self, $state){
        
        global $_sc;
        self::showPopup();
        
        if ($state == 1){
            myHistory::addXY($_sc->targets_ex);
            
        } elseif ($state == 2){
            myHistory::addWH($_sc->targets_ex);
        }
        
        $targets = $_sc->targets_ex;
        foreach ($targets as $el){
            
            $childs = $el->childComponents();
            foreach ($childs as $child)
                if (!($child instanceof TTabSheet))
                $_sc->deleteTarget($child);
        }
        
        myVars::set(true, '__sizeAndMove');    
    }
    
    static function endSizeMove($self, $state){
        
        global $_sc;
       
        $targets = $_sc->targets_ex;
		if ($state == 1){
            myHistory::addXY($targets); 
        } elseif ($state == 2){
            myHistory::addWH($targets);
        }
        foreach ($targets as $el){
            if (method_exists($el,'__updateDesign'))
                $el->__updateDesign();
        }
        
        myInspect::selectObject(_c(myVars::get('targetSelected')));
        myProperties::updateProps();
        $_sc->update();
        
            
        myVars::set(false, '__sizeAndMove');
    }
   
    static function duringSizeMove($self, $dx, $dy, $state){
        global $targetSelected;
        $obj = _c($targetSelected);
        
        if (is_subclass_of($obj,  '__TNoVisual')) return;
        myInspect::selectObject($obj,
                                $dx + control_x($targetSelected,null), $dy + control_y($targetSelected,null));
				
    }

    static function objMouseDown($self, $button, $shift, $x, $y){
        
        self::showPopup();
        self::selectComponent(nil, $self, $x, $y);
    }
    
    static function mouseDown($self, $button, $shift, $x, $y){
        
        global $_sc, $_designSel, $fmEdit, $fmMain, $_componentPanel, $selectedClass;
        
        
        myDesign::showPopup();   
        myDesign::hidePopup();
        self::showPopup();
        
        myVars::set(0, 'targetSelected');
        myInspect::selectObject(0);
        
        
        if ($button == 1){
            $_componentPanel->unSelect();
            $selectedClass = false;
            myVars::set(true, 'popupShow');
            myVars::set(false, 'isMouseDown');
            self::formProps(true);
            $_sc->clearTargets();
            return;
        } else {
            myVars::set(true, 'isMouseDown');
        }
        
       // c('fmMain')->text = $button;
        
        myInspect::selectFmEdit();
        if ($_designSel)
            $_designSel->free();   
        
            myVars::set($x, '_startX');
            myVars::set($y, '_startY');
            
            myVars::set(cursor_pos_x(), '_startAX');
            myVars::set(cursor_pos_y(), '_startAY');
    }
    
    static function mouseMove($self, $shift, $x, $y){
        
        global $_designSel, $fmEdit, $_startAY, $_startAX, $_startX, $_startY, $isMouseDown;
        
            //$ax = $_designSel->x;
            //$ay = $_designSel->y;
                    if ($isMouseDown && abs($_startX-$x)>10 && abs($_startY-$y)>10){
                
                if (!$_designSel){
                    //$fmEdit->doubleBuffer = true;
                    $_designSel = new TForm;
					//gui_propSet($_designSel->self, 'StyleElements', '[]');
                    $_designSel->visible = 0;
                    $_designSel->AlphaBlend = true;
                    $_designSel->Color = myOptions::get('sc', 'SelectColor', clBlack);//#ADDOPT; , all ready
                    $_designSel->FormStyle = fsStayOnTop;
                    $_designSel->AlphaBlendValue = 170;
                    $_designSel->BorderStyle = bsNone;
                    $_designSel->x = cursor_pos_x();
                    $_designSel->y = cursor_pos_y();
                    $_designSel->w = 0;
                    $_designSel->h = 0;
                    
                    myVars::set($_designSel, '_designSel');
                }
                
                $_designSel->show( SW_SHOWNOACTIVATE );
                
                $ax = $_startAX;
                $ay = $_startAY;
                
                $w = -$ax + cursor_pos_x();
                $h = -$ay + cursor_pos_y();
                
                if ($w < 0){
                    $ax = cursor_pos_x();
                    $w  = $_startAX - $ax;
                }
                
                if ($h < 0){
                    $ay = cursor_pos_y();
                    $h = $_startAY - $ay;
                }
                
                $_designSel->x = $ax;
                $_designSel->y = $ay;
                $_designSel->w = $w;
                $_designSel->h = $h;
            }
    }
    
    static function mouseUp($self, $button, $shift, $x, $y){
        
        global $_designSel, $selectedClass, $_sc, $fmEdit, $myEvents, $myProperties;
        
        myVars::set(false, 'isMouseDown');
        myVars::set(true, '__sizeAndMove');
        
        $_sc->clearTargets();
        if (!$_designSel && $button!=1){
            
            if ($selectedClass) {
                
                self::createComponent($x, $y, $fmEdit);        
            } else {
                myDesign::formProps();
            }
            
            myVars::set(false, '__sizeAndMove');
            return false;
        }
        
        if ($_designSel){
            //$A =& $_designSel;
            $_designSel->hide();
            
            $ax = myVars::get('_startX');
            $ay = myVars::get('_startY');
            
            $w  = $x - $ax;
            if ($w < 0){
                $w = $ax - $x;
                $ax = $x;
            }
            
            $h  = $y - $ay;
            if ($h < 0){
                $h = $ay - $y;
                $ay = $y;
            }
            
        self::showPopup();
        if ($selectedClass) {
            self::createComponent($ax, $ay, $fmEdit, $w, $h);
        } else {
            
            $i = 0;
            $components = $fmEdit->componentList;
            foreach ($components as $el){
                
                if (!$el->name || in_array(rtti_class($el->self),array('TEvents','TSizeCtrl'))) continue;
                
                if (self::inArea($el->self, $ax, $ay, $w, $h)){
                    ++$i;
                    $_sc->addTarget($el);
                    if ($i==1){
                
                        $myEvents->generate($el);
                        $myProperties->generate($el->self, c('fmPropsAndEvents->tabProps',1));
                    }
                }
            }
            
            if ($i==0){
                myDesign::formProps();
            }
        }
    
        }
        
        myVars::set(false, '__sizeAndMove');
            
        if ($_designSel)
        $_designSel->free();
        
        unset($GLOBALS['_designSel']);
        self::showPopup();
    }
    
    static function inArea($self, $x, $y, $w, $h){
        
        //$self = $CTRL->self;
        $tmp['x'] = getAbsoluteX($self, $GLOBALS['fmEdit']->self);
        $tmp['y'] = getAbsoluteY($self, $GLOBALS['fmEdit']->self);
        $tmp['w'] = control_w($self, null);
        $tmp['h'] = control_h($self, null);
        return Geometry::collision2D($tmp, array('x'=>$x,'y'=>$y,'w'=>$w,'h'=>$h));
    }
   
    static function formProps($clear = false){
        global $myProperties,$myEvents,$fmEdit;
		
        self::showPopup();
       
        if ($clear){
            $myProperties->selObj = false;
            $myEvents->selObj = false;
        }
        $myProperties->generate($fmEdit->self,c('fmPropsAndEvents->tabProps',1));

        $myEvents->_generate($fmEdit);
    }
    static function bugfixFormProps()
	{
		global $myProperties;
		if( !$myProperties->panels['TForm']['PANEL']->VertScrollBar->OldPosition && !$myProperties->panels['TForm']['PANEL']->VertScrollBar->Position)
		$myProperties->panels['TForm']['PANEL']->CollapseAll();
		$myProperties->panels['TForm']['PANEL']->ExpandAll();
	}
    static function deleteObject($obj){
        
        if (link_null($obj->self)) return;
        
        global $fmEdit, $_sc, $myInspect;
        
        self::delObjFromGroups($obj);
        eventEngine::delEvent($obj->name);
            $_sc->unRegisterTarget($obj);
            $myInspect->delItem($obj);
        
        $childs = $obj->childComponents(false);
        foreach ($childs as $child)
            self::deleteObject($child);
        
        $obj->free();
		treeBwr_add();
    }
    
    static function keyDelete(){
        
        myVars::set(0, 'popupShow');

        //if (!self::canDoIt()) return;
        
        global $_sc, $fmEdit, $myInspect;
        $components = $_sc->targets_ex;
        
        $_sc->clearTargets();
        
        foreach ($components as $el){
            self::deleteObject($el);
        }
        
        
        $obj = self::lastComponent();
        
        global $myProperties, $myEvents, $myInspect;
        
        $myProperties->generate($obj->self,c('fmPropsAndEvents->tabProps',1));
        $myEvents->generate($obj);
        
        if ($obj->self !== $fmEdit->self)
        $_sc->addTarget($obj);
        
        myInspect::generate($fmEdit);
    }
    
    static function canDoIt(){
        
        if ( c('fmMain->tmpEdit',1)->focused )
            return true;
        
        if ( c('fmComponents',1)->focused )
            return true;
        
        if ( c('fmComponents->list',1)->focused )
            return true;
        
        if ( c('fmPropsAndEvents->eventList',1)->focused )
            return true;
        
        if ( c('fmPropsAndEvents->tabEvents',1)->focused )
            return true;
		
		if ( c('fmPropsAndEvents->TTreeBwr',1)->focused )
            return true;
        
        
        return false;
    }
    
    static function editorPopup(){
        global $_sc, $fmEdit, $popupShow, $myProperties, $_designSel;
        if( is_object($_designSel) )
			$_designSel->hide();
        
		self::showPopup();
        $popupShow = true;
        $components = $_sc->targets_ex;
        $theme = dsThemeDesign::$dir;
        c('fmMain->itemLock')->checked = false;
		c('fmMain->itemLock')->picture->loadFromFile("{$theme}/mi_lock.bmp" );
		c('fmMain->itemLock')->caption = t("Lock component");
        if (count($components)==0) return;
        
		$r = false;
        foreach($components as $el)
			if($el->tag==2012) $r = true;
		if($r)
		{
			c('fmMain->itemLock',1)->checked = true;
			c('fmMain->itemLock',1)->picture->loadFromFile("{$theme}/mi_unlock.bmp" );
			c('fmMain->itemLock',1)->caption = t("Unlock component");
		}
        c('fmMain->itemGroup',1)->caption = count(self::getGroup($myProperties->selObj))>0 ?
                                            t('Ungroup') : t('Group');
    }
    
    static function hidePopup(){
        
        global $popupShow;
        $popupShow = false;
    }
    
    static function showPopup(){
        
        setEditorHotKeys();
        myProperties::unFocusPanel();

        c('fmMain->tmpEdit')->setFocus();
    }
    
    static function groupComponent(){
        
        global $myProperties;
        
        $obj = $myProperties->selObj;
        
        if (count(self::getGroup($obj))>0){
            self::unGroup();
        }
        else
            self::addGroup();
    }
    
    static function lockComponent(){
        
        global $_sc, $fmEdit;
        $components = $_sc->targets_ex;
        
        if (count($components)==0) return;
        
		$new_tag = 2012;
        foreach($components as $el)
			if($el->tag==2012) $new_tag = 0;
			
        foreach ($components as $el)
            $el->tag = $new_tag;
        
        $_sc->updateBtns();        
    }
    
    static function keyCopy($self = 0, $cut = false){
        
        myVars::set(0, 'popupShow');
        if (!self::canDoIt()) return;
        
        global $_sc, $fmEdit;
        
        $components = $_sc->targets_ex;
        if( empty($components) )
		{
			clipboard_settext('');
			return;
		}
        $unlinks = [];
        foreach ($components as $el){
            $childs = $el->childComponents();
            foreach ($childs as $child)
                $unlinks[] = $child->self;
        }
        
        foreach ($components as $x=>$el)
            if (in_array($el->self, $unlinks)) unset($components[$x]);
        
        $components = array_values($components);
        myCopyer::toBufferList($components, $cut);
    }
    
    static function keyPaste(){
        
        myVars::set(0, 'popupShow');
        //if (!self::canDoIt()) return;
        
        myVars::set(true, '__sizeAndMove');
        
        //myCopyer::fromBuffer();
        
        global $_sc, $fmEdit, $myEvents, $myProperties, $hak_text,
                $bufferComponents, $bufferEvents, $myInspect;
        
        //if (!count($bufferComponents)) return false;
        
        $_sc->clearTargets();
        
        $parentObj = $myProperties->selObj;
        if ($parentObj instanceof TPageControl)
            $parentObj = $parentObj->activePage;
        elseif (!self::isWinControl($parentObj))
            $parentObj = $fmEdit;
        
        $objs = myCopyer::pasteFromBuffer($parentObj, $fmEdit);
		if( !is_array($objs) )
		{
			myVars::set(false, '__sizeAndMove');
			return;
		}
        $s    = current($objs);
        $s    = $s['cmp'];
        $iter = 0;
        foreach ($objs as $el){
            ++$iter;
            if (method_exists($el['cmp'],'__updateDesign')) $el['cmp']->__updateDesign();
            if (method_exists($el['cmp'],'__pasteDesign')) $el['cmp']->__pasteDesign();
            
            
                $myInspect->addItem($el['cmp']);
            if ($iter<=1000)
				$_sc->addTarget($el['cmp']);
            
				if(isSet($el['childs']) && is_array($el['childs']))
					foreach ($el['childs'] as $x=>$child){
                    
					if (method_exists($child,'__updateDesign')) $child->__updateDesign();
					if (method_exists($child,'__pasteDesign')) $child->__pasteDesign();
					$myInspect->addItem($child);
					if ($iter<=1000)
					$_sc->registerTarget($child);
				}
        }
        
        if ($s){
			
            $myEvents->generate($s);
            $myProperties->generate($s, c('fmPropsAndEvents->tabProps',1));
        }
        
        myVars::set(false, '__sizeAndMove');
    }
    
    static function keyCut(){
        
        myVars::set(0, 'popupShow');
        //if (!self::canDoIt()) return;
        
        global $_sc,$fmEdit;
        
        self::keyCopy(0, true);
        self::keyDelete();
        myInspect::generate($fmEdit);
    }
    
    static function szRefresh(){
    
        global $fmEdit, $_FORMS, $formSelected, $_sc,
                $targetSelected, $myEvents, $myProperties;
        
        lockWindowUpdate(c('fmPropsAndEvents->tabProps',1)->handle);
        
        $el = $targetSelected>0?c($targetSelected):$fmEdit;
        $myEvents->generate($el);
        $myProperties->generate($el->self, c('fmPropsAndEvents->tabProps',1));
        lockWindowUpdate(0);
    }
    
    static function toFront(){
        
        myVars::set(0, 'popupShow');
        
        global $_sc;
        $components = $_sc->targets_ex;
        foreach ($components as $el){
            $el->toFront();
        }
        
    }
    
    static function toBack(){
        
        myVars::set(0, 'popupShow');
        
        global $_sc;
        $components = $_sc->targets_ex;
        foreach ($components as $el){
            $el->toBack();
        }
        
    }
    
    static function tabFormClick($self, $button, $shift, $x, $y)
	{
        global $_FORMS, $formSelected, $historyIndex;
        $index = c('fmMain->tabForms')->tabIndex;   
        if ($index == $formSelected) return false;
        myUtils::saveForm();
        $formSelected = $index;
        myUtils::loadForm($_FORMS[$index]);
        $historyIndex = 0;
    }
    
    static function objsInspectEdited($self, $item, &$s){
        
        
        global $fmEdit, $myInspect;
        
        if (!preg_match('/^[a-z]{1}[a-z0-9\_]*$/i',$s))
                return $s = (_c($item)->caption);
        
        $obj = $myInspect->getObj(_c($item));
        $last = $obj->name;
        $obj->name = $s;
        $myInspect->refreshItem($obj);
        
        if ($last==$obj->name){
            $s = $last;
        }
    }
    
    
    static function refreshForm(){
        
        global $fmEdit, $_sc;
        $fmEdit->repaint();
        $_sc->clearTargets();
        myDesign::formProps();
    }
    
    
    static function resizeEditForm($self){
        
        global $fmEdit, $_sc;
        
        c('fmMain->shapeSize',1)->w = $fmEdit->w + $GLOBALS['sc_offset']*2;
        c('fmMain->shapeSize',1)->h = $fmEdit->h + $GLOBALS['sc_offset']*2; 
		if( isset($_sc) )
			if( is_object($_sc) )
				$_sc->update();
    }
    
    static function itViewsPopup($self){
        
        c('fmMain->it_components')->checked = c('fmMain->pComponents')->visible;
        c('fmMain->it_objectinspector')->checked = c('fmMain->pInspector')->visible;
        c('fmMain->it_props')->checked = c('fmMain->pProps')->visible;
        c('fmMain->it_debuginfo')->checked = c('fmMain->pDebugWindow')->visible;
    }
	
	static function detectNS($self)
	{
		return !( 
		(gui_propexists($self, "Width")	 || gui_propexists($self, "Height"))
		&& (gui_propexists($self, "Top") || gui_propexists($self, "Left"))
		);
	}
}