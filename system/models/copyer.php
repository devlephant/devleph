<?



class myCopyer {
    
    
    function stripChilds($str){
        
        $result = array();
        $lines = explode(_BR_, $str);
        $is_child = true;
        
        foreach ($lines as $i=>$line){
            
            if ($i > 0)
            if (substr(trim($line),0,7)=='object '){
                $is_child = true;
                continue;
            }
            
            if ($i !== count($lines)-1)
            if (trim($line)=='end'){
                $is_child = false;
                continue;
            }
            
            $result[] = $line;
        }
        
        return implode(_BR_, $result);
    }
    
    function toString(TComponent $object, $no_childs = false){
        
        if (method_exists($object,'__copy'))
            $result = $object->__copy();
        else {
            $result = gui_componentToString($object->self);
            if ($no_childs)
                $result = self::stripChilds($result);
        }
        
        
        return $result;
    }
    
    function toComponent(TComponent $object, $str){
        
        if ($object->name){
            $lines = explode(_BR_, $str);
            $lines[0] = eregi_replace('object ([\_a-z0-9]+)\: ','object '.$object->name.': ',$lines[0]);
            $str = implode(_BR_,$lines);
        }
        
        gui_stringToComponent($object->self, $str);
    }
    
    
    function getComponentInfo(TComponent $object, &$events){
        
        $childs = $object->childComponents();
        
        $result = array();
        $events = array();
        foreach ($childs as $el){
            if ($el instanceof TTabSheet) continue;
            
            $parent = $el->parent->name;
            if (!$parent){
                
                $parent = $el->parent->parentControl->name;
                $index  = $el->parent->pageIndex;
            }
            
            $result[] = array('name'=>$el->name,
                              'index'=>$index,
                              'pageIndex'=>$el->pageIndex,
                              'class'=>$el->className,
                              'parent'=>$parent,
                              'component'=>self::toString($el));
            $events[$el->name] = self::getComponentEvent($el);
        }
        
        return $result;
    }
    
    function getComponentEvent(TComponent $object){
        
        return eventEngine::$DATA[strtolower(eventEngine::$form)][strtolower($object->name)];
    }
    
    function toBuffer(TComponent $object){
        
        $buffer['component'] = self::toString($object);
        $buffer['events']    = self::getComponentEvent($object);
        $buffer['pageIndex'] = $object->pageIndex;
        $buffer['childs_events'] = array();
        $buffer['childs']    = self::getComponentInfo($object, $buffer['childs_events']);        
        $buffer['info']      = array('name'=>$object->name, 'class'=>$object->className);
        
        return $buffer;
    }
    
    function toBufferList($objects, $cut = false, $unuseBuff = false){
        
        $buffer = array();
        $buffer['is_cut'] = $cut;
        
        foreach ($objects as $el){
            $buffer[] = self::toBuffer($el);
        }
        if(!$unuseBuff)
        clipboard_settext(base64_encode(serialize($buffer)));
    }
    
    function fromBuffer(){
        
        $buffer = unserialize(base64_decode(clipboard_gettext()));
        if (!$buffer)
            return clipboard_gettext();
        return $buffer;
    }
    
    function changeNameInBuffer(&$buffer, $old_name, $name){
        
        
        foreach ($buffer as &$component){
            
            if ( !$component ) continue;
            
            if (strcmp($component['info']['name'], $old_name)==0)
                $component['info']['name'] = $name;
            
			if( is_array($component['childs']) )
            foreach ($component['childs'] as $y=>&$child){
                
                if (strcmp($child['parent'], $old_name)==0)
                    $child['parent'] = $name;
            }
        }
        
    }
    
    function createComponent($class, $name, $parent, $form, $events, &$buffer){
        
        if (!class_exists($class)) return;
        
        $cmp = new $class($form);
        
        if ($form->findComponent($name)){
            $old_name = $name;
            
            $name = myDesign::getNoExistsName($class);
            self::changeNameInBuffer($buffer, $old_name, $name);
        }
        
        $cmp->name   = $name;
        $cmp->parent = $parent;
        $cmp->text   = '';
        eventEngine::$DATA[strtolower(eventEngine::$form)][strtolower($name)] = $events;
        return $cmp;
    }
    
    function createFunction($info, $form){
        
        $func = new TFunction($form);
        $func->parent = $form;
        
        if ($form->findComponent($info['name'])){
            $info['name'] = myDesign::getNoExistsName('TFunction');
        }
        
        $x = cursor_pos_x();
        $y = cursor_pos_y();
        $arr = clientToScreen($form->handle);
        $inform = Geometry::pointInRegion($x, $y, array('x'=>$arr['x'], 'y'=>$arr['y'],
                                          'w'=>$form->w, 'h'=>$form->h));
        if ($info){
            
            $formArr = screenToClient($form->handle);
            $real_x  = ($x - $formArr['x']);
            $real_y  = ($y - $formArr['y']);
        } else {
            
            $real_x  = 20;
            $real_y  = 20;
        }
        
        $func->x = $real_x;
        $func->y = $real_y;
        
        $func->name = $info['name'];
        $func->parameters = $info['params'];
        eventEngine::setEvent($info['name'], 'OnExecute', $info['code']);
        return $func;
    }
    
    function pasteFromBuffer($parent, $form){
        
        global $_sc;
        $buffer = self::fromBuffer();
        
        if (self::isPHPFunction($buffer)){
            
            $func = self::getFunction($buffer);
            $func = self::createFunction($func, $form);
            return array(array('cmp'=>$func));
        }
        
        if (! is_array($buffer) ) return;
        $result = array();
        foreach ($buffer as $x=>$component){
            if (!is_numeric($x)) continue;
            
                $cmp = self::createComponent($component['info']['class'],
                                         $component['info']['name'],
                                         $parent,
                                         $form,
                                         $component['events'], $buffer);
            if (method_exists($cmp,'__paste'))
                $cmp->__paste($component['component']);    
            else
                self::toComponent($cmp, $component['component']);
            
            $result[$x]['cmp'] = $cmp;
            
            if (!$buffer['is_cut']){
                $cmp->x += $_sc->gridSize;
                $cmp->y += $_sc->gridSize;
            }
            
            foreach ($component['childs'] as $y=>$child){
                    
                    if (!$child['name']) continue;
                    
                    //$p_name = ();
                    $parent = $form->findComponent($buffer[$x]['childs'][$y]['parent']);
                    if (is_numeric($child['index'])){
                        $pages  = $parent->pages();
                        $parent = $pages[$child['index']];
                    }
                    
                    $cmp = self::createComponent($child['class'],
                                         $child['name'],
                                         $parent,
                                         $form,
                                         $component['childs_events'][$child['name']], $buffer);
                
                if (method_exists($cmp,'__paste'))
                    $cmp->__paste($child['component']);    
                else {
                    self::toComponent($cmp, $child['component']);
                }
                
                    if (is_numeric($child['index'])){
                        //$cmp->y -= $pages->tabHeight ? $pages->tabHeight : 18;
                    }
                    
                if ($cmp instanceof TPageControl){
                    $cmp->pageIndex = $child['pageIndex'];
                }
                    
                $result[$x]['childs'][] = $cmp;
            }
            
            if ($result[$x]['cmp'] instanceof TPageControl){
                $result[$x]['cmp']->pageIndex = $component['pageIndex'];
            }
        }
        
        return $result;
    }
    
    function isPHPFunction($code){
        if( is_array($code) ) return false;
        $code = trim($code);
        $lines = explode("\n", $code);
        
        return ereg('^function ([a-z0-9A-Z\_]+)',$lines[0]);
    }
    
    function getFunction($code){
        
        $code = trim($code);
        $lines = explode("\n", $code);
        $line_0 = ltrim( str_replace('function ','',$lines[0]) );
        
        $result['name']   = rtrim(substr($line_0, 0, strpos($line_0,'(')));
        $result['params'] = trim(substr($line_0, strlen($result['name'])));
        
        $result['params'] = trim(substr($result['params'],1,strlen($result['params'])-2));
        
        if (substr($result['params'],-1)==')')
            $result['params'] = substr($result['params'],0,-1);
        
        $f_begin = strpos($code,'{')+1;
        $result['code'] = rtrim(substr($code, $f_begin));
        
        if (substr($result['code'],-1)=='}')
            $result['code'] = substr($result['code'],0,-1);
		if (substr($result['code'], 0, 1)=='')
			$result['code'] = substr($result['code'],1);
        return $result;
    }
    
}