<?
class FontPropertiesEditor
{
	const type = "TNxButtonItem";
	public static function OnCreate( $edt, $class, &$prop)
	{
		global $myProperties, $componentProps;
        $edt->ButtonCaption = myProperties::ButtonCaption;
        $edt->buttonWidth = myProperties::ButtonWidth;
        $edt->onButtonClick = __CLASS__ . "::Click";
		if(isset($prop["SINGLE"]))
			RETURN;
		$gr = (isset($prop["ADD_GROUP"])? $prop["ADD_GROUP"]: false)? $myProperties->panels[$class]["ADD_GROUP"]: $myProperties->panels[$class]["GROUP"];
		$rprop = isset($prop['REAL_PROP'])? $prop['REAL_PROP']: $prop['PROP'];
		 $xprops = 
				[
				  ['CAPTION'=>t('Font Color'), 'TYPE'=>'color', 'PROP'=>'fontColor', 'REAL_PROP'=>"$rprop->color"],
				  ['CAPTION'=>t('Font Size'), 'TYPE'=>'number', 'PROP'=>'fontsize', 'REAL_PROP'=>"$rprop->size"],
				  ['CAPTION'=>t('Font Height'), 'TYPE'=>'number', 'PROP'=>'fontheight', 'REAL_PROP'=>"$rprop->height"],
				  ['CAPTION'=>t('Font Pitch'), 'TYPE'=>'combo', 'PROP'=>'fontpitch', 'REAL_PROP'=>"$rprop->pitch", 'VALUES'=>['fpDefault','fpVariable', 'fpFixed']],
				  ['CAPTION'=>t('Font Quality'), 'TYPE'=>'combo', 'PROP'=>'fontquality', 'REAL_PROP'=>"$rprop->quality", 'VALUES'=>['fqDefault', 'fqDraft', 'fqProof', 'fqNonAntialiased', 'fqAntialiased', 'fqClearType', 'fqClearTypeNatural']],
				  ['CAPTION'=>t('Font Orientation'), 'TYPE'=>'number', 'PROP'=>'fontori', 'REAL_PROP'=>"$rprop->orientation"]
				  //Font style
				  ];
		foreach($xprops as $property)
		{
			$type = myProperties::$types[$property['TYPE']];
			$edit = $type::type;
			$edit = new $type;
			$type::OnCreate( $edit, $class, $property );
			$myProperties->params[$class][] = $edit->self;
			$edit->hint = $property['CAPTION']._BR_."[->{$property['REAL_PROP']}]";
			$edit->showHint = true;
			$componentProps[$class][] = $property;
			$myProperties->elements[$edt->self] = $property;
		}
	}
	public static function Click( $self )
	{
		global $myProperties, $_sc, $fmEdit, $toSetProp;
		if ($toSetProp) return;
        $prop = $myProperties->elements[ $self ]['PROP'];
        $dlg = new TFontDialog;
        $dlg->font->assign( $myProperties->selObj->$prop );
        if ($dlg->execute()){
            
            $font  = $dlg->font;
			
			$targets = $_sc->targets_ex;
			$targets = count($targets)>0?$targets : [$fmEdit];
			myHistory::add($targets, $prop);
            foreach ($targets as $link=>$el){
				_c(myDesign::noVisAlias($link))->$prop->assign($font);
            }
            $_sc->update();  // fix bug
        }
        $dlg->free();
		myProperties::updateProps();
	}
	
	public static function Update( $edt, $value )
	{
        foreach(['name', 'color', 'style', 'charset'] as $p)
		$edt->ValueFont->$p = $value->$p;
        $edt->value = $value->name. ','. $value->size .','. ColorPickerEditor::ToColorFormat($value->color);
	}
	
	public static function OnEdit( $edit, $prop, $value, &$upd  )
	{
		$upd = true;
	}
}
myProperties::AddType(["font","TFont","TRealFont"], "FontPropertiesEditor");