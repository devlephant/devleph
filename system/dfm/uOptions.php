<?php
class ev_fmOptions_c_showgrid {
	static function onClick($self){
		$GLOBALS['_sc']->showGrid = c($self)->checked;
	}
}

class ev_fmOptions_e_gridsize {
	static function onChange($self){
		$obj = _c($self);
		if( (int)$obj->text < 1 ) $obj->text = 1;
		if( (int)$obj->text > 50) $obj->text = 50;
		c('fmOptions->up_gridsize')->position = $obj->text;
		if( c('fmOptions->c_showgrid')->checked )
			$GLOBALS['_sc']->gridSize = c('fmOptions->up_gridsize')->position;
	}
}

class ev_fmOptions_e_fs {
	static function onChange($self){
		$obj = _c($self);
		global $fmEdit;
		if( (int)$obj->text < 2 ) $obj->text = 2;
		if( (int)$obj->text > 14 )$obj->text = 14;
		$fs = (int)$obj->text;
		$obj = c("fmMain->shapeSize");
		$obj->w = $fmEdit->w + $fs * 2;
		$obj->h = $fmEdit->h + $fs * 2;
		$fmEdit->x = $obj->x + $fs;
		$fmEdit->y = $obj->y + $fs;
		c('fmEdit')->repaint();
	}
}

class ev_fmOptions_cb_penstyle {
	static function onSelect($self){
		c('fmMain->shapeSize')->penStyle = c('fmOptions->cb_penstyle')->itemIndex;
	}
}

class ev_fmOptions_en_bc {
	static function doDialog($self, $obj=false, $prop=false)
	{
		$dlg = new TDMSColorDialog();
		$col1 = $dlg->color = c($self)->brushColor;
		if( file_exists(realpath(SYSTEM_DIR.'/colors.in')) )
		{
			list($dlg->MainColors->text, $dlg->CustomColors->text) = unserialize(file_get_contents(realpath(SYSTEM_DIR.'/colors.in')));
		}
		if($dlg->execute())
		{
			if( is_object($obj) ) $obj->$prop = $dlg->color;
			c($self)->brushColor = $dlg->color;
			c($self)->penColor = TColor::compare_contrast($col1, $dlg->color);
			file_put_contents(SYSTEM_DIR.'/colors.in', serialize(array($dlg->MainColors->text, $dlg->CustomColors->text)));
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
		ev_fmOptions_en_bc::doDialog($self, $GLOBALS['_sc'], 'BtnColorDisabled');
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
		c("fmMain->shapeSize")->repaint();
	}
}

class ev_fmOptions_scol_out
 {
	static function onMouseDown($self, $button, $shift, $x, $y)
	{
		ev_fmOptions_en_bc::doDialog($self, c("fmMain->shapeSize"), "penColor");
		c("fmMain->shapeSize")->repaint();
	}
}