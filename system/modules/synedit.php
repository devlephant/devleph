<?


global $_c;
$_c->setConstList(array('ctCode', 'ctHint', 'ctParams'),0);

	
class TSynEdit extends TMemo {
	

	function set_caretX($v)		{ synedit_caret_x($this->self,$v);			}
	function get_caretX()		{ return synedit_caret_x($this->self,null);	}
	
	function set_caretY($v)		{ synedit_caret_y($this->self,$v);			}
	function get_caretY()		{ return synedit_caret_y($this->self,null);	}
	
	function set_selStart($v)	{ synedit_selstart($this->self,$v);			}
	function get_selStart()		{ synedit_selstart($this->self,null);		}
	
	function set_selEnd($v)		{ synedit_selend($this->self,$v);			}
	function get_selEnd()		{ synedit_selend($this->self,null);			}
	
	function set_selLength($v)
	{
		$this->selEnd = $this->selStart + $v;
	}
	
	function get_selLength( )
	{
		return $this->selEnd - $this->selStart;
	}
	
	public function selectAll( )
	{
		
		$this->setFocus();
		$this->selStart = 0;
		$this->selEnd   = strlen($this->text);
	}
	
	public function undo()	{ edit_undo($this->self); }
	public function redo()	{ edit_redo($this->self); }
    
	public function copyToClipboard()	{ edit_copytoclipboard($this->self);	}
	public function cutToClipboard()	{ edit_cuttoclipboard($this->self);		}
	public function pasteFromClipboard(){ edit_pastefromclipboard($this->self);	}
	public function clearSelected()		{ edit_clearselection($this->self);		}
	public function clearSelection()	{ $this->clearSelected();				}
	
	function set_lineText( $v )
	{
		$this->items->setLine($this->caretY - 1, $v);
	}
	
	function get_lineText( )
	{
		return $this->items->getLine($this->caretY - 1);
	}
	
	function replaceLine( $text )
	{
		$lineT = $this->lineText;
		$lastX = $this->caretX;
		
		
		$s = substr($lineT, 0, strlen($lineT)-strlen(ltrim($lineT)));
		$this->lineText = $s . $text;
		
		
		$this->caretX   = $lastX;
	}
	
	function insertLine( $text )
	{
		
		$lineT = $this->lineText;
		$lastX = $this->caretX;
		$lastY = $this->caretY;
		
		$s = substr($lineT, 0, strlen($lineT)-strlen(ltrim($lineT)));
		$this->lineText = $this->lineText . _BR_ . $s . $text;
		
		$this->caretX   = $lastX;
		$this->caretY   = $lastY;
	}
	
	function insertLineAfter( $text )
	{
		
		$lineT = $this->lineText;
		$lastX = $this->caretX;
		$lastY = $this->caretY;
		
		$s = substr($lineT, 0, strlen($lineT)-strlen(ltrim($lineT)));
		$this->lineText =  $s . $text ._BR_. $this->lineText;
		
		$this->caretX   = $lastX;
		$this->caretY   = $lastY;
	}

	private function set_ShowLineNumbers( )
	{
		gui_propset($this->gutter, 'showlinenumbers', $this->ShowLineNumbers);
	}

	private function set_GutterAuto( )
	{
		gui_propset($this->gutter, 'Autosize', $this->GutterAuto);
	}
	
	function select( $text )
	{
		$this->selStart	= stripos($this->text,$text);
		$this->selEnd	= $this->selStart + strlen($text);
	}

}

class TSynGutter extends TControl{
	
}

class TSynCompletionProposal extends TControl {
    
    
    public $itemList; // TStrings
    public $insertList; // TStrings
    
    #clBackground = clWindow
    #clSelect = clHighlight
    #clSelectText = clHighlightText
    #clTitleBackground = clBtnFace
    
    #margin = 2
    #itemHeight = 0
    #nbLinesInWindow = 8
    #resizeable = true
    #defaultType = ctCode
    #shortCut = CTRL+SPACE
    #title = ''
    #width = 260
    
    function __construct($onwer=nil,$init=true,$self=nil){
		parent::__construct($onwer,$init,$self);
		$this->itemList = new TStrings(false);
		$this->itemList->self = __rtti_link($this->self,'itemList');
			
			$this->insertList = new TStrings(false);
		$this->insertList->self = __rtti_link($this->self,'insertList');
		
		$this->__setAllPropEx();
    }
    
    public function setEditor(TSynEdit $editor){
	
		syncomplete_editor($this->self, $editor->self);
    }
    
    public function get_visible(){
	return (syncomplete_visible($this->self));
    }
    
    public function get_insert(){
        return $this->insertList->get_text();
    }
    public function set_insert($text){
        $this->insertList->text = $text;
    }
    
    public function get_item(){
        return $this->itemList->get_text();   
    }
    public function set_item($text){
	$this->itemList->text = $text;
    }
    
    public function set_editor(TSynEdit $editor){
        syncomplete_editor($this->self, $editor->self);
    }
    
    public function get_editor(){
        return _c(syncomplete_editor($this->self, null));
    }
    
    public function set_shortCut($sc){
		
	if (!is_numeric($sc))
		$sc = text_to_shortcut(strtoupper($sc));
	$this->set_prop('shortCut',$sc);
    }
	
    public function get_shortCut(){
		
	$result = $this->get_prop('shortCut');
	return shortCut_to_text($result);
    }
    
    public function active($value = true){
        
        syncomplete_activate($this->self, (bool)$value);
    }
    
    public function get_hint(){
        return $this->insertList->text;
    }
    
    public function set_hint($hint){
        $this->defaultType      = ctParams;
        $this->insertList->text = $hint;
        $this->itemList->text   = $hint;
    }
    
    public function get_currentString(){
	
	return syncomplete_currentString($this->self);
    }
    
    public function get_empty(){
	
	return syncomplete_empty($this->self);
    }
}

class TSynHighlighterAttributes extends TControl {
	
	
	#TColor background
	#TColor foreground
	#string style = 'fsBold, fsItalic, fsStrikeOut, fsUnderline'
}

class TSynCustomHighlighter extends TControl {
	
	
	#enabled
	#DefaultFilter 
	
	// ->getAttri('Comment')->background = clGray;
	function getAttri($prefix = 'Comment'){
		
		$prop = $prefix . 'Attri';
		
		$result = new TSynHighlighterAttributes(nil,false);
		$result->self = gui_propGet($this->self, $prop);
		return $result;
	}
}

#attr: Comment, Identifier, Key, Number, Space, String, Symbol, Variable
class TSynPHPSyn extends TSynCustomHighlighter {
	

	static $prefixs = array('Comment', 'Identifier', 'Key', 'Number', 'Space', 'String', 'Symbol', 'Variable');
	
	function saveAttr($prefix, &$arr){
		
		$attr = $this->getAttri($prefix);
		$arr[$prefix]['background'] = $attr->background;
		$arr[$prefix]['foreground'] = $attr->foreground;
		$arr[$prefix]['style']      = $attr->style;
	}
	
	function saveToArray(&$arr){
		
		foreach (self::$prefixs as $prefix)
			$this->saveAttr($prefix, $arr);
	}
	
	function loadFromArray($arr){
		
		foreach (self::$prefixs as $prefix){
			$attr = $this->getAttri($prefix);
			if (isset($arr[$prefix])){
				$attr->background = $arr[$prefix]['background'];
				$attr->foreground = $arr[$prefix]['foreground'];
				$attr->style      = $arr[$prefix]['style'];
			}
		}
	}
}
class TSynGeneralSyn			extends TSynCustomHighlighter	{}
class TSynCppSyn				extends TSynCustomHighlighter 	{}
class TSynCssSyn				extends TSynCustomHighlighter	{}
class TSynHTMLSyn				extends TSynCustomHighlighter	{}
class TSynSQLSyn				extends TSynCustomHighlighter	{}
class TSynJScriptSyn			extends TSynCustomHighlighter	{}
class TSynXMLSyn				extends TSynCustomHighlighter	{}
?>