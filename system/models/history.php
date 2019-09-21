<?
class myHistory {
	
	const INDEX_PROP = 0;
	const INDEX_EVENT = 1;
	const INDEX_OBJECT = 2;
	public static $HISTORY_ARRAY = [];
	static function add($objects, $prop)
	{
        if (!count($objects)) return;
        
        global $_FORMS, $formSelected, $__isUndo;
		if( $__isUndo )
		{
			self::$HISTORY_ARRAY[$_FORMS[$formSelected]] = array_slice(self::$HISTORY_ARRAY[$_FORMS[$formSelected]], 0, $GLOBALS['historyIndex']);
			$__isUndo = false;
		}
        $arr = [];
        foreach ($objects as $el){
            
            $el = toObject($el);
            
            if (is_array($prop)){
                foreach ($prop as $x)
                    $value[] = self::getProp($el, $x);
            } else
                $value = self::getProp($el, $prop);
            
            $arr[] = array ('name'=>self::toName($el->name,$el->self),
                            'prop'=>$prop,
                            'value'=>$value);
            unset($value);
            
        }
        self::$HISTORY_ARRAY[$_FORMS[$formSelected]][] = [$arr,self::INDEX_PROP,date("Dm Y"),date("H:i:s")];
        ++$GLOBALS['historyIndex'];
    }
    
	static function addArr($objects, $prop, $vals)
	{
        
        if (!count($objects)) return;
        
        global $_FORMS, $formSelected, $__isUndo;
		if( $__isUndo )
		{
			self::$HISTORY_ARRAY[$_FORMS[$formSelected]] = array_slice(self::$HISTORY_ARRAY[$_FORMS[$formSelected]], 0, $GLOBALS['historyIndex']);
			$__isUndo = false;
		}
        $arr = [];
        foreach ($objects as $link=>$el){
            $el = toObject($el);
            $arr[] =		
					[
						'name'=>self::toName($el->name,$el->self),
						'prop'=>$prop,
						'value'=>$vals[$link]
					];
        }
        
        self::$HISTORY_ARRAY[$_FORMS[$formSelected]][] = [$arr,self::INDEX_PROP,date("Dm Y"),date("H:i:s")];
        ++$GLOBALS['historyIndex'];
    }
	
	static function addObj($object)
	{
        global $_FORMS, $formSelected, $__isUndo;
		if( $__isUndo )
		{
			self::$HISTORY_ARRAY[$_FORMS[$formSelected]] = array_slice(self::$HISTORY_ARRAY[$_FORMS[$formSelected]], 0, $GLOBALS['historyIndex']);
			$__isUndo = false;
		}
		$obj = toObject($object);
		$arr[] =
		[
			"name"=>self::toName($obj->name,$obj->self),
			"data"=>null
		];
        
        self::$HISTORY_ARRAY[$_FORMS[$formSelected]][] = [$arr,self::INDEX_OBJECT,date("Dm Y"),date("H:i:s")];
        ++$GLOBALS['historyIndex'];
	}
	
	static function delObj($objects)
	{
		if (!count($objects)) return;
        
        global $_FORMS, $formSelected, $__isUndo;
		if( $__isUndo )
		{
			self::$HISTORY_ARRAY[$_FORMS[$formSelected]] = array_slice(self::$HISTORY_ARRAY[$_FORMS[$formSelected]], 0, $GLOBALS['historyIndex']);
			$__isUndo = false;
		}
        $arr = [];
        foreach ($objects as $el)
		{
            $el = toObject($el);
			$name = $el->Name;
			$arr[] =
			[
				"name"=>self::toName($el->name,$el->self),
				"parent"=>self::toName($el->name,$el->parent->self),
				"data"=>gui_writeStr($el->self)
			];
        }
        
        self::$HISTORY_ARRAY[$_FORMS[$formSelected]][] = [$arr,self::INDEX_OBJECT,date("Dm Y"),date("H:i:s")];
        ++$GLOBALS['historyIndex'];
	}
	
	static function addEvent($obj, $event, $code)
	{
		global $_FORMS, $formSelected, $__isUndo;
		if( $__isUndo )
		{
			self::$HISTORY_ARRAY[$_FORMS[$formSelected]] = array_slice(self::$HISTORY_ARRAY[$_FORMS[$formSelected]], 0, $GLOBALS['historyIndex']);
			$__isUndo = false;
		}
        self::$HISTORY_ARRAY[$_FORMS[$formSelected]][] = [
			[
			"name"=>$obj,
			"event"=>$event,
			"data"=>$code
			]
		,self::INDEX_EVENT,date("Dm Y"),date("H:i:s")];
        ++$GLOBALS['historyIndex'];
	}
	
    static function addXY($objects)
	{
        self::add($objects, ['x','y']);
    }
    
    static function addWH($objects)
	{
        self::add($objects, ['w','h','x','y']);
    }
    static function setProp($o, $prop, $val)
	{
		global $myProperties, $_sc, $_FORMS, $projectFile, $myProject, $formSelected, $fmEdit;
		
		$o = _c(myDesign::noVisAlias($o->self));
		if($o instanceof TForm)
		{
			$prop = strtolower($prop);
			if($prop=="name")
			{
				if (preg_match('/^([a-z]{1})([a-z0-9\_]+)$/i',$val)){
				foreach ($_FORMS as $el){
					if (strtolower($el)==strtolower($val)){
						return;
					}
				}
				$name = $GLOBALS['_FORMS'][$GLOBALS['formSelected']];
				$dfm_file = dirname($projectFile) .'/'. $name . '.dfm';
				$dfm_file2= dirname($projectFile) .'/'. $val . '.dfm';
				if (file_exists($dfm_file2))
					unlink($dfm_file2);
				
				rename($dfm_file, $dfm_file2);
				
				myDesign::groupChangeFormName($name, $value);
				myDesign::eventChangeFormName($name, $value);
				
					$k = array_search($name, $_FORMS);
					$_FORMS[$k] = $val;
					$id = c('fmMain->tabForms')->tabIndex;
					c('fmMain->tabForms')->tabs->setLine($k,$val.'.dfm');
					c('fmMain->tabForms')->tabIndex = $id;
					$myProject->formsInfo[$val] = $myProject->formsInfo[$name];
					unset($myProject->formsInfo[$name]);
					
					treeBwr_add();
				}
			}elseif( in_array($prop, ['cursor','x','y','autoscroll','alphablend','alphablendvalue','screensnap','snapbuffer','transparentcolor','transparentcolorvalue','doublebuffered']) )
			{
				$myProject->formsInfo[$_FORMS[$formSelected]][$prop] = $val;
			}
		} else {
			if ($prop=="name")
			{
				myDesign::changeName($o, $val);
			}
			else 	
			{
				$o->$prop = $val;
			}
		}
	}
	static function getProp($o, $prop)
	{
		global $fmEdit;
		$o = _c(myDesign::noVisAlias($o->self));
		$p = $o->$prop;
		if($o instanceof TForm && !is_object($o->$prop))
		{
			$fname = $GLOBALS['_FORMS'][$GLOBALS['formSelected']];
			$formsinfo = $GLOBALS['myProject']->formsInfo[$fname];
			if(strtolower($prop)=='name')
			{
				$p = $fname;
			} elseif( isSet( $formsinfo[$prop] ) )
			{
				$p = $formsinfo[$prop];
			}
		}
		if( $o->name!=="" && !gui_is($o->self, 'TControl') )
		{
			$prop =	strtolower($prop);
			$arr = ["x","y","w","h","left","top","width","height"];
			if(in_array($prop,$arr))
			{
				$pos = array_search($prop,$arr);
				$p = $GLOBALS['myProject']->formsInfo[$GLOBALS['_FORMS'][$GLOBALS['formSelected']]]["_v"][$o->name][ ($pos%2==0?1:0) ];
				if($pos%3==0||$pos%4==0)
					$p = 24;
			}
		}
		return $p;
	}
    static function open($arr)
	{
		pre($arr);
		global $myEvents, $myProperties, $myInspect, $_sc, $fmEdit;
		
		if(!is_array($arr)) return;
		if( $arr[1] == SELF::INDEX_PROP )
		{
			foreach ($arr[0] as $el)
			{    
				$obj  = c($el['name']);
				$prop = $el['prop'];
				if (is_array($prop)){
					foreach ($prop as $i=>$x){
						self::SetProp($obj, $x, $el['value'][$i]);
					}
				} else
					self::SetProp($obj, $prop, $el['value']);
			}
		} elseif ( $arr[1] == SELF::INDEX_OBJECT )
		{
			$s = false;
			$iter = 0;
			foreach ($arr[0] as $el)
			{
				if($el["data"]==null)
				{
					myDesign::deleteObject(c($el['name']));
					$obj = _c(myDesign::noVisAlias(myDesign::lastComponent()->self));
					$myProperties->generate($obj->self,c('fmPropsAndEvents->tabProps',1));
					$myEvents->generate($obj);
					if ($obj->self !== $fmEdit->self)
					$_sc->addTarget(_c(myDesign::noVisAliasRt($obj->self)));
					myInspect::generate($fmEdit);
				} else {
					myVars::set(true, '__sizeAndMove');
					$obj = new TControl($fmEdit);
					$obj->parent = $fmEdit;
					gui_ReadStr($obj->self, $el["data"]);
					if ( !gui_is($obj->self, 'TControl') )
					{
						$alias = new __TNoVisual($obj->owner,nil,get_class($obj));
						$alias->parent = $obj->owner;
						$alias->Assoc = $obj;
						$_el = $obj;
						$alias->onMove = function($self)use($_el)
						{
							myDesign::SavePosOf($_el, gui_propget($self,'Left'), gui_propget($self,'Top'));
						};
						$alias->tag = -3;
						myDesign::LoadPosOf($_el, $alias);
						self::plusnoVisAlias($obj->self, $alias->self);
					} else $alias = $obj;
					$myInspect->addItem($alias);
					if( ($iter++) <=1000)
						$_sc->addTarget($alias);
					$controls = $obj->Controls;
					if(count($controls) > 0)
					foreach ($controls as $x=>$child){
                    
						if (method_exists($child,'__updateDesign')) $child->__updateDesign();
						if (method_exists($child,'__pasteDesign')) $child->__pasteDesign();
						
						$myInspect->addItem($child);
						
						if ($iter++<=1000)
							$_sc->registerTarget($child);
					}
					if($s===false)
						$s = $alias;
				}
			}
			
			myVars::set(false, '__sizeAndMove');
			
			if($s!==false)
			{
				$_sc->update();
				$myEvents->generate($s);
				$myProperties->generate($s, c('fmPropsAndEvents->tabProps',1));
				
				goto tree;
			}
		
		} elseif ( $arr[1] == SELF::INDEX_EVENT )
		{
			if( $arr[0]["data"] == null)
			{
				eventEngine::delEvent($arr["name"],$arr["event"],false);
			}
				else eventEngine::setEvent($arr["name"],$arr["event"],$arr["data"],false);
			goto upd_events;
		}
        
        myProperties::updateProps();
		$_sc->update();
		upd_events:
		$myEvents->genList();
		tree:
		treeBwr_add();
    }
    
    static function clear()
	{
        $GLOBALS['HISTORY_ARRAY'] = [];
        myVars::set(0, 'historyIndex');
    }
    
    static function load($index)
	{
        self::open(self::$HISTORY_ARRAY[$GLOBALS['_FORMS'][$GLOBALS['formSelected']]][$index]);
    }
	
    static function undo(){
        global $__isUndo;
        $index = myVars::get('historyIndex');
        if ($index == 0) return false;
        $__isUndo = true;
        self::load($index-1);
        myVars::set($index-1, 'historyIndex');
    }
    
    static function redo(){
        global $_FORMS, $formSelected;
        
        $index = myVars::get('historyIndex');
        if ($index == count(self::$HISTORY_ARRAY[$_FORMS[$formSelected]]) - 1) return false;
        
        self::load($index+1);
        myVars::set($index+1, 'historyIndex');
    }
	
	static function SaveFiles($projectFile)
	{
		$dir = dirname($projectFile) . DIRECTORY_SEPARATOR . "__history";;
		if(!is_dir($dir))
			mkdir($dir);
		if(is_array(self::$HISTORY_ARRAY) && count(self::$HISTORY_ARRAY)>0)
		foreach(self::$HISTORY_ARRAY as $form=>$data)
		{
			file_put_contents($dir . DIRECTORY_SEPARATOR . "$form.json", json_encode($data));
		}
	}
	
	static function LoadFiles($form)
	{
		global $projectFile;
		$dir = dirname($projectFile) . DIRECTORY_SEPARATOR . "__history";;
		if(!is_dir($dir)) goto rc;
			$files = FindFiles($dir,"json",false,true);
			if(empty($files)) goto rc;
			foreach($files as $f)
			{
				self::$HISTORY_ARRAY[BasenameNoExt($f)] = json_decode(file_get_contents($f),true);
			}
		self::ChangeForm( $form );
		return;
		rc:
		self::Clear();
	}
	
	static function toName($n,$self)
	{
		return $n!==""?($n!=="fmEdit"?"fmEdit->$n":$n):$self;
	}
	
	static function ChangeForm($form)
	{
		if(!isset(self::$HISTORY_ARRAY[$form]))
			self::$HISTORY_ARRAY[$form] = [];
		$count = count(self::$HISTORY_ARRAY[$form]);
        myVars::set($count>0?$count-1:0, 'historyIndex');
	}
}

myHistory::Clear();