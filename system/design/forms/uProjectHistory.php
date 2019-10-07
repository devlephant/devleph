<?
class ev_fmProjectHistory
{
	public static $data = [];
	
	static function Show()
	{
		self::updview();
		c("fmProjectHistory")->show();
	}
	
	static function toName($name)
	{
		global $_FORMS, $formSelected;
		$formSelName = $_FORMS[$formSelected];
		$name = str_replace(["--fmEdit","fmEdit->"], [$formSelName,"$formSelName->"], $name);
		if( $name  == "fmEdit" )
			return $formSelName;
		return $name;
	}
	static function updview()
	{
		global $_FORMS, $formSelected;
		$tree = c("fmProjectHistory->history");
		$selIndex = [0,0];
		$tree->items->BeginUpdate();
		$tree->text = "";
		$Forms = "";
		$text = "";
		$imgindex[] = myImages::getImgID("empty");
		$expand[0] = true;
		$cindex = 0;
		if(!is_array(myHistory::$HISTORY_ARRAY) || count(myHistory::$HISTORY_ARRAY)==0) return;
		$text .= t("Forms")._BR_;
		foreach( myHistory::$HISTORY_ARRAY as $form=>$data )
		{
			self::$data = [];
			$text .= "\t" . $form . PHP_EOL;
			$imgindex[] = myImages::getImgID("form");
			++$cindex;
			$findex = $cindex;
			$expand[$cindex] = false;
			if(is_array($data))
			foreach( $data as $el=>$objs )
			{
				//0 = anything, string
				//1 = class
				//2 = object
				//3 = event name
				//4 = event code
				//5 = event notice
				if(!isset($objs[0][0])) $objs[0] = [$objs[0]];
				foreach($objs as $obj)
				{
					$name = self::toName($obj[0]["name"]);
					pre([$name,$obj[0]["name"],$objs]);
				if( $obj[1] == myHistory::INDEX_PROP )
				{
					if( is_array($obj[0]["prop"]) )
					{
						foreach($obj[0]["prop"] as $i=>$_obj)
						{
							++$cindex;
							$text .= "\t\t{$obj[2]} {$obj[3]} [$cindex] ($name->$_obj)" . PHP_EOL;
							$imgindex[] = myImages::getImgID("property");
							
							$imgindex[] = myImages::getImgID("valueofproperty");
							++$cindex;
							$text .= "\t\t\t Value: [...]" . PHP_EOL;
							self::$data[$cindex] = [0,$obj[0]["value"][$i],[$el,0,"value",$i]];
							++$cindex;
							$text .= "\t\t\t " . t("Name of the object:") ." ". $name . PHP_EOL;
							self::$data[$cindex] = [0,$name,[$el,0,"name"]];
							++$cindex;
							$text .= "\t\t\t " . t("Class of the object:") ." ". $obj[0]["class"] . PHP_EOL;
							self::$data[$cindex] = [1,$obj[0]["class"],[$el,0,"class"]];
						}
					} else {
						++$cindex;
							$text .= "\t\t{$obj[2]} {$obj[3]} [$cindex] ($name->{$obj[0]["prop"]})" . PHP_EOL;
							$imgindex[] = myImages::getImgID("property");
							
							$imgindex[] = myImages::getImgID("valueofproperty");
							++$cindex;
							$text .= "\t\t\t Value: [...]" . PHP_EOL;
							self::$data[$cindex] = [0,$obj[0]["value"],[$el,0,"value"]];
							++$cindex;
							$text .= "\t\t\t " . t("Name of the object:") ." ". $name . PHP_EOL;
							self::$data[$cindex] = [0,$name,[$el,0,"name"]];
							++$cindex;
							$text .= "\t\t\t " . t("Class of the object:") ." ". $obj[0]["class"] . PHP_EOL;
							self::$data[$cindex] = [1,$obj[0]["class"],[$el,0,"class"]];
					}
				} elseif( $obj[1] == myHistory::INDEX_OBJECT ) {
					++$cindex;
					$text .= "\t\t{$obj[2]} {$obj[3]} [$cindex] (".t("Object %s " . ($obj[0]["data"]==null?"created": "deleted"), $name) . PHP_EOL;
					$imgindex[] = myImages::getImgID($obj[0]["class"]);
					$imgindex[] = myImages::getImgID("property");
					$imgindex[] = myImages::getImgID("property");
					$imgindex[] = myImages::getImgID("property");
					++$cindex;
					$text .= "\t\t\t " . t("Name of the object:") ." ". $name . PHP_EOL;
					self::$data[$cindex] = [0,$name,[$el,0,"name"]];
					++$cindex;
					$text .= "\t\t\t " . t("Class of the object:") ." ". $obj[0]["class"] . PHP_EOL;
					self::$data[$cindex] = [1,$obj[0]["class"],[$el,0,"class"]];
					++$cindex;
					$text .= "\t\t\t " . t("Parent of the object:") ." ". self::toName($obj[0]["parent"]) . PHP_EOL;
					self::$data[$cindex] = [2,self::toName($obj[0]["parent"]),[$el,0,"parent"]];
				} elseif( $obj[1] == myHistory::INDEX_EVENT )
				{
					$imgindex[] = myImages::getImgID($obj[0]["event"]);
					++$cindex;
					$text .= "\t\t{$obj[2]} {$obj[3]} [$cindex] ($name->" . $obj[0]["event"] .")" .  PHP_EOL;
					
					++$cindex;
					$text .= "\t\t\t " . t("Name of the object:") ." ". $name . PHP_EOL;
					self::$data[$cindex] = [0,$name,[$el,0,"name"]];
					++$cindex;
					$text .= "\t\t\t " . t("Class of the object:") ." ". $obj[0]["class"] . PHP_EOL;
					self::$data[$cindex] = [1,$obj[0]["class"],[$el,0,"class"]];
					++$cindex;
					$text .= "\t\t\t " . t("Event name:") ." ". $obj[0]["event"] .  PHP_EOL;
					self::$data[$cindex] = [3,$obj[0]["event"],[$el,0,"event"]];
					++$cindex;
					$text .= "\t\t\t " . t("Event code:") ." [...]". PHP_EOL;
					self::$data[$cindex] = [4,$obj[0]["data"],[$el,0,"data"]];
					++$cindex;
					$text .= "\t\t\t " . t("Event has been " . ($obj[0]["c"]==0?"created":($obj[0]["c"]==1?"changed":"deleted"))) . PHP_EOL;
					self::$data[$cindex] = [5,$obj[0]["c"],[$el,0,"c"]];
				}
				}
				if($form == $_FORMS[$formSelected] && $el == myHistory::$HISTORY_INDEXES[$_FORMS[$formSelected]] )
				{
					foreach( range($findex, $cindex-$findex) as $r )
						$expand[$r] = true;
					$selIndex = [$cindex, $cindex-$findex];
				} else {
					foreach( range($findex, $cindex-$findex) as $r )
						$expand[$r] = false;
				}
			}
		}
		pre($text);
		$tree->text = $text;
		foreach($tree->items as $i=>$item){
			$item->Expanded = $expand[$i];
			$item->imageIndex = $imgindex[$i];
			$item->SelectedIndex = $imgindex[$i];
		}
		$tree->Images = c('MainImages24');
		$tree->items->EndUpdate();
	}
	static function EditClick($self)
	{
		global $fmEdit, $_FORMS, $formSelected;
		$self = _c($self);
		$result = "";
		if( isSet(self::$data[$self->absIndex]) )
		{
			$inf = self::$data[$self->absIndex];
			$pr = false;
			foreach($inf[2] as $el)
			{
				if($pr == false)
				{
					$pr = true;
					$pointer = myHistory::$HISTORY_ARRAY[$_FORMS[$formSelected]][$el];
				} else {
					$pointer =& $pointer[$el];
				}
			}
			if( $inf[0] == 0 )
			{
				TextEditor::$value = $inf[1];
				if(TextEditor::Execute())
				{
					$pointer = TextEditor::$value;
				}
			} elseif( $inf[0] == 1 )
			{
				self::create235(array_filter(get_declared_classes(), function($k){return is_subclass_of($k,'TComponent');}),$inf[1],$pointer);
			} elseif( $inf[0] == 2 )
			{
				$names = [];
				foreach( $fmEdit->components as $component )
				{
					if($component->name=="") continue;
					$names[] = $_FORMS[$formSelected] . "->" . $component->name;
				}
				self::create235($names,$inf[1],$pointer);
			} elseif( $inf[0] == 3 )
			{
				self::create235(array_keys($GLOBALS['__EVENTS_API_PRMS']),$inf[1],$pointer);
			} elseif( $inf[0] == 4 )
			{
				TextEditor::$value = $inf[1];
				if(TextEditor::Execute())
				{
					$pointer = TextEditor::$value;
				}
				//open code editor
			} elseif( $inf[0] == 5 )
			{
				self::create235(range(0,5),$inf[1],$pointer);
			}
			self::updview();
			return $pointer;
		}
	}
	public static function DeleteClick($self)
	{
		$self = _c($self);
		if( isSet(self::$data[$self->absIndex]) )
		{
			$inf = self::$data[$self->absIndex];
			unset(myHistory::$HISTORY_ARRAY[$_FORMS[$formSelected]][$inf[2][0]]);
			unset(self::$data[$self->absIndex]);
			self::updview();
		}
	}
	public static function OpenClick($self)
	{
		$self = _c($self);
		if( isSet(self::$data[$self->absIndex]) )
		{
			$inf = self::$data[$self->absIndex];
			myHistory::load($inf[2][0]);
		}
	}
	public static function create235($value,$values,&$result)
	{
		$f = new TForm();
		$c = new TComBoBox($f);
		$c->parent = $f;
		$c->text = $values;
		$c->itemIndex = array_search($value,$values);
		$c->align = alClient;
		$c->autosize = true;
		$f->autosize = true;
		$f->BorderStyle = bsToolWindow;
		$c->onChange = function($self)
		{
			_c($self)->parent->ModalResult = mrOk;
			_c($self)->parent->close();
		};
		$r = $f->ShowModal() == mrOk;
		$result = $values[$c->itemIndex];
		$f->free();
		return $r;
	}
}

class ev_fmProjectHistory_history
{
	static function onDblClick($self)
	{
		ev_fmProjectHistory::OpenClick($self);
	}
	static function onClick($self)
	{
		ev_fmProjectHistory::EditClick($self);
	}
}

class ev_fmProjectHistory_btnDelete
{
	static function onClick($self)
	{
		ev_fmProjectHistory::DeleteClick( c("fmProjectHistory->history") );
	}
}

class ev_fmProjectHistory_btnEdit
{
	static function onClick($self)
	{
		ev_fmProjectHistory::EditClick( c("fmProjectHistory->history") );
	}
}

class ev_fmProjectHistory_btnLoad
{
	static function onClick($self)
	{
		ev_fmProjectHistory::OpenClick( c("fmProjectHistory->history") );
	}
}