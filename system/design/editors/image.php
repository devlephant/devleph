<?
class ImageEditor
{
	const type = "TNxButtonItem";
	public static function OnCreate( $edt, $class, &$prop )
	{
	
        $edt->caption = $prop['CAPTION'];
        $edt->ButtonCaption = myProperties::ButtonCaption;
        $edt->buttonWidth = myProperties::ButtonWidth;
        $edt->value       = '('. t('None') .')';
        $edt->onButtonClick = __CLASS__ . '::Click';
	}
	public static function Click( $self )
	{
		
        global $myProperties, $_sc, $fmEdit, $toSetProp;
        if($toSetProp) return;
        $param = $myProperties->elements[ $self ];
        $prop  = $param['PROP'];
		
        $dlg = new TImageDialog;
        $dlg->value = $myProperties->selObj->$prop;
        
        if ($dlg->execute()){
            
            $obj = _c($self);
            $bitmap = $dlg->value;
            $targets = count($_sc->targets_ex) ? $_sc->targets_ex : [$fmEdit];
            $m = 'set_' . $prop;
            foreach ($targets as $el)
			{
				$el = _c(myDesign::noVisAlias($el->self));
                $el->$prop->assign($bitmap);
					if( method_exists($el, $m) )
					$el->$m($bitmap);
            }
            $edt->value = '(' . t($bitmap->isEmpty()?'None':'image') . ')';
                
            $_sc->update();  // fix bug
        }
        
        $dlg->free();
		myProperties::updateProps();
	}
	public static function Update( $edt, &$value )
	{
		$edt->value = '(' . t($value->isEmpty()?'None':'image') . ')';
	}
	public static function OnEdit( $edt, $value, $prop, &$upd )
	{
		$upd = true;
	}
}
myProperties::AddType("image", "ImageEditor");