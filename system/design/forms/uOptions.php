<?php
class ev_fmOptions_c_showgrid {
	static function onClick($self){
		$GLOBALS['_sc']->showGrid = DevS\cache::c($self)->checked;
	}
}

class ev_fmOptions_e_gridsize {
	static function onChange($self){
		$obj =	DevS\cache::c($self);
		if( (int)$obj->text < 1 ) $obj->text = 1;
		if( (int)$obj->text > 50) $obj->text = 50;
		DevS\cache::c('fmOptions->up_gridsize')->position = $obj->text;
		if( DevS\cache::c('fmOptions->c_showgrid')->checked )
			$GLOBALS['_sc']->gridSize = DevS\cache::c('fmOptions->up_gridsize')->position;
	}
}

class ev_fmOptions_e_fs {
	static function onChange($self){
		$obj = DevS\cache::c($self);
		global $fmEdit;
		if( (int)$obj->text < 2 ) $obj->text = 2;
		if( (int)$obj->text > 14 )$obj->text = 14;
		$fs = (int)$obj->text;
		$obj = DevS\cache::c("fmMain->shapeSize");
		$obj->w = $fmEdit->w + $fs * 2;
		$obj->h = $fmEdit->h + $fs * 2;
		$fmEdit->x = $obj->x + $fs;
		$fmEdit->y = $obj->y + $fs;
		DevS\cache::c('fmEdit')->repaint();
	}
}

class ev_fmOptions_cb_penstyle {
	static function onSelect($self){
		DevS\cache::c('fmMain->shapeSize')->penStyle = DevS\cache::c('fmOptions->cb_penstyle')->itemIndex;
	}
}

class ev_fmOptions_en_bc {
	static function doDialog($self, $obj=false, $prop=false)
	{
		$dlg = new TDMSColorDialog();
		$col1 = $dlg->color = DevS\cache::c($self)->brushColor;
		$colors = myOptions::get('colors','dialog',null);
		if( $colors!==null )
		{
			list($dlg->MainColors->text, $dlg->CustomColors->text) = unserialize(base64_decode($colors));
		}
		if($dlg->execute())
		{
			if( is_object($obj) ) $obj->$prop = $dlg->color;
			DevS\cache::c($self)->brushColor = $dlg->color;
			DevS\cache::c($self)->penColor = TColor::compare_contrast($col1, $dlg->color);
			myOptions::set('colors','dialog', base64_encode(serialize(array($dlg->MainColors->text, $dlg->CustomColors->text))));
		}
		$dlg->free();
	}
	static function onMouseDown($self, $button, $shift, $x, $y)
	{
		self::doDialog($self, $GLOBALS['_sc'], 'BtnColor');
	}
}

class ev_fmOptions_dis_bc {
	static function onMouseDown($self, $button, $shift, $x, $y){
		ev_fmOptions_en_bc::doDialog($self, $GLOBALS['_sc'], 'DisabledBtnColor');
	}
}

class ev_fmOptions_sel_color {
	static function onMouseDown($self, $button, $shift, $x, $y)
	{
		ev_fmOptions_en_bc::doDialog($self);
	}
}

class ev_fmOptions_scol_inn
 {
	static function onMouseDown($self, $button, $shift, $x, $y)
	{
		ev_fmOptions_en_bc::doDialog($self, c("fmMain->shapeSize"), "brushColor");
		DevS\cache::c("fmMain->shapeSize")->repaint();
	}
}

class ev_fmOptions_scol_out
 {
	static function onMouseDown($self, $button, $shift, $x, $y)
	{
		ev_fmOptions_en_bc::doDialog($self, c("fmMain->shapeSize"), "penColor");
		DevS\cache::c("fmMain->shapeSize")->repaint();
	}
}

class ev_fmOptions_btn_select
 {
	static function onClick($self)
	{
		$themes_list = DevS\cache::c("fmOptions->lb_themes");
		if(DevS\cache::c("fmOptions->lb_themes")->itemIndex < 0) return;
		//Gignorie: Это - ds, тут и без php 5.6 обойтись почти можно XD <--- Andrewz'у
		$id = $themes_list->items->lines[$themes_list->itemIndex];
		
		if( $id == "mixed" ){ pre("Sorry... This function is not working. \n \nTo do...."); return;}
		//Gignorie: Простите, но доделаю чуть поже. Просто лето, жара, сами понимаете.
		//Понимаем, осень, холод, учёба, все дела...
			dsThemeDesign::Change($id);
			message_beep(66);
		unset($themes_list, $id);
	}
}