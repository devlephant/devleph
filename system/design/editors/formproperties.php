<?
class FormPropertiesEditor
{
	const type = "TNxButtonItem";
	const caption = "Properties";
    public static function OnCreate( $edt, $class, &$prop )
	{
        $edt->ButtonCaption = myProperties::ButtonCaption;
        $edt->buttonWidth = myProperties::ButtonWidth;
        $edt->onButtonClick = __CLASS__ . "::Click";
	}
	
	public static function Click( $self )
	{
		global $myProperties, $_sc, $fmEdit;
        
        $prop = $myProperties->elements[ $self ]['PROP'];
        $form = c($prop);
        self::formShow($self, $form);
        if ($form->showModal()==mrOk)
		{
            self::formSelect($self, $form);
        }
	}
	
	static function formShow($self, $form, $x=true)
	{
		global $myProject, $formSelected, $_FORMS, $fmEdit;
        
        $c_position   = $form->findComponent('c_position');
        $c_windowState= $form->findComponent('c_windowstate');
        $c_formstyle  = $form->findComponent('c_formstyle');
        $c_borderstyle= $form->findComponent('c_borderstyle');
        
        $c_visible    = $form->findComponent('c_visible');
        $c_noload     = $form->findComponent('c_noload');
        $i_close      = $form->findComponent('c_close');
        $i_min        = $form->findComponent('c_min');
        $i_max        = $form->findComponent('c_max');
        
        $e_minwidth   = $form->findComponent('e_minwidth');
        $e_minheight  = $form->findComponent('e_minheight');
        $e_maxheight  = $form->findComponent('e_maxheight');
        $e_maxwidth   = $form->findComponent('e_maxwidth');
        
        $e_maxheight->text = $fmEdit->constraints->maxheight;
        $e_maxwidth->text  = $fmEdit->constraints->maxwidth;
        $e_minheight->text = $fmEdit->constraints->minheight;
        $e_minwidth->text  = $fmEdit->constraints->minwidth;
        
        $form->findComponent('ud_maxheight')->position = $fmEdit->constraints->maxheight;
        $form->findComponent('ud_maxwidth')->position  = $fmEdit->constraints->maxwidth;
        $form->findComponent('ud_minheight')->position = $fmEdit->constraints->minheight;
        $form->findComponent('ud_minwidth')->position  = $fmEdit->constraints->minwidth;
        
        $info = $myProject->formsInfo[$_FORMS[$formSelected]];
        
        if ($info['position']){
            $c_position->items->selected    = $info['position'];
            $c_windowState->items->selected = $info['windowState'];
            $c_formstyle->items->selected   = $info['formStyle'];
            $c_borderstyle->items->selected   = $info['borderStyle'];
            
            $c_visible->checked      = (bool)$info['visible'];
            $c_noload->checked       = (bool)$info['noload'];
            $i_close->checked        = $info['i_close'];
            $i_max->checked          = $info['i_max'];
            $i_min->checked          = $info['i_min'];
        } else {
            $c_position->items->selected    = 'poDesigned';
            $c_windowState->items->selected = 'wsNormal';
            $c_formstyle->items->selected   = 'fsNormal';
            $c_visible->checked = false;
            $c_noload->checked = false;
            $i_close->checked   = true;
            $i_max->checked     = true;
            $i_min->checked     = true;
        }
	}
	
	static function formSelect($self,$form)
	{
        global $myProject, $fmEdit, $formSelected, $_FORMS;
        
        $position     = $form->findComponent('c_position')->items->selected;
        $windowState  = $form->findComponent('c_windowstate')->items->selected;
        $formStyle    = $form->findComponent('c_formstyle')->items->selected;
        $borderStyle  = $form->findComponent('c_borderstyle')->items->selected;
        
        $visible      = $form->findComponent('c_visible')->checked;
        $noload       = $form->findComponent('c_noload')->checked;
        $i_close      = $form->findComponent('c_close')->checked;
        $i_min        = $form->findComponent('c_min')->checked;
        $i_max        = $form->findComponent('c_max')->checked;
               
        $e_minwidth   = $form->findComponent('e_minwidth');
        $e_minheight  = $form->findComponent('e_minheight');
        $e_maxheight  = $form->findComponent('e_maxheight');
        $e_maxwidth   = $form->findComponent('e_maxwidth');
        
        $fmEdit->constraints->maxheight  = $e_maxheight->text;
        $fmEdit->constraints->maxwidth  = $e_maxwidth->text;
        $fmEdit->constraints->minheight = $e_minheight->text;
        $fmEdit->constraints->minwidth  = $e_minwidth->text;
        
        $info =& $myProject->formsInfo[$_FORMS[$formSelected]];
        $info['position']    = $position;
        $info['windowState'] = $windowState;
        $info['formStyle']   = $formStyle;
        $info['borderStyle'] = $borderStyle;
        $info['visible']     = $visible;
        $info['noload']      = $noload;
        $info['i_close']     = $i_close;
        $info['i_min']       = $i_min;
        $info['i_max']       = $i_max;
        
        myProject::saveFormInfo();
	}
}
myProperties::AddType(["form", "formproperties", "form_"], "FormPropertiesEditor");