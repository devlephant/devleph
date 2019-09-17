<?
class TextEditor
{
	public $value;
	const type = "TNxButtonItem";
	public static function OnCreate( $edt, $class, &$prop )
	{
        $edt->caption = $prop['CAPTION'];
        $edt->ButtonCaption = myProperties::ButtonCaption;
        $edt->buttonWidth = myProperties::ButtonWidth;
        $edt->onButtonClick = __CLASS__ . "::Click";
	}
	public static function Click( $self )
	{
		global $myProperties, $toSetProp, $_sc;
        if ($toSetProp) return;
        
        clearEditorHotKeys();
        
        $param = $myProperties->elements[ $self ];
        $prop  = $param['PROP'];
        $edt = _c($self);
        self::$value = $myProperties->selObj->$prop;
        
        if (self::execute())
		{    
            $edt->value = self::$value;
            
            $targets = count($_sc->targets_ex) ? $_sc->targets_ex : [$fmEdit];
            myHistory::add($targets, $prop);
            
                foreach ($targets as $self=>$el){
                    $el = _c(myDesign::noVisAlias($el->self));
                    $el->$prop = self::$value;
                }
            
            $_sc->update();  // fix bug
        }
        
		$edt->value = self::$value;
	}
	public static function execute()
	{
		$e = c("edt_Text");
        $e->onKeyDown = 'TTextDialog::keyDown';
		$TextField =  c('edt_Text->memo');
        $TextField->onKeyDown = 'TTextDialog::keyDown';
		c('edt_Text->bitbtn3')->onClick = 'TTextDialog::clickCopy';
		c('edt_Text->bitbtn4')->onClick = 'TTextDialog::clickPaste';
		$TextField->text = self::$value;
        $e = $e->showModal() == mrOk;
		self::$value = $TextField->text;
		return $e;
    }
    
    function keyDown($self, &$key, &$shift)
	{
        if ($key == VK_ESCAPE)
            c('edt_Text')->close();
    }
	
	function clickCopy($self)
	{
		clipboard_settext( c('edt_Text->memo')->text );
	}
	
	function clickPaste($self)
	{
		c('edt_Text->memo')->text = clipboard_gettext( );
	}
}
MyProperties::AddType(["text","string","str","caption","shortstring","widestring","ansistring","utf8string"], "TextEditor");