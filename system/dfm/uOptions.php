<?php
class ev_fmOptions_c_showgrid {
	static function onClick($self){
		global $_sc;
		$_sc->showGrid = c($self)->checked;
		c('fmEdit')->repaint();
	}
}

class ev_fmOptions_e_gridsize {
	static function onChange($self){
		global $_sc;
		c('fmOptions->up_gridsize')->position = (int)c($self)->text;
		if( c('fmOptions->c_showgrid')->checked ) {
			$_sc->gridSize = c('fmOptions->up_gridsize')->position;
			c('fmEdit')->repaint();
		}
	}
}

class ev_fmOptions_up_gridsize {
	static function onClick($self){
		global $_sc;
		c('fmOptions->e_gridsize')->text = c($self)->position;
		if( c('fmOptions->c_showgrid')->checked ) {
			$_sc->gridSize = c($self)->position;
			c('fmEdit')->repaint();
		}
	}
}

class ev_fmOptions_en_bc {
	static function onMouseDown($self, $button, $shift, $x, $y){
		global $_sc;
		$dlg = new TSColorDialog();
		$col1 = $dlg->color = c($self)->brushColor;
		if( file_exists(realpath(SYSTEM_DIR.'/colors.in')) )
		{
			list($dlg->MainColors->text, $dlg->CustomColors->text) = unserialize(file_get_contents(realpath(SYSTEM_DIR.'/colors.in')));
		}
		if($dlg->execute()) {
			$_sc->BtnColor = c($self)->brushColor = $dlg->color;
			c($self)->penColor = TColor::compare_contrast($col1, $dlg->color);
			file_put_contents(SYSTEM_DIR.'/colors.in', serialize(array($dlg->MainColors->text, $dlg->CustomColors->text)));
		}
		$dlg->free();
	}
}

class ev_fmOptions_dis_bc {
	static function onMouseDown($self, $button, $shift, $x, $y){
		global $_sc;
		$dlg = new TSColorDialog();
		$col1 = $dlg->color = c($self)->brushColor;
		if( file_exists(realpath(SYSTEM_DIR.'/colors.in')) )
		{
			list($dlg->MainColors->text, $dlg->CustomColors->text) = unserialize(file_get_contents(realpath(SYSTEM_DIR.'/colors.in')));
		}
		if($dlg->execute()) {
			$_sc->BtnColorDisabled = c($self)->brushColor = $dlg->color;
			c($self)->penColor = TColor::compare_contrast($col1, $dlg->color);
			file_put_contents(SYSTEM_DIR.'/colors.in', serialize(array($dlg->MainColors->text, $dlg->CustomColors->text)));
		}
		$dlg->free();
	}
}

class ev_fmOptions_sel_color {
	static function onMouseDown($self, $button, $shift, $x, $y){
		
		$dlg = new TSColorDialog();
		$col1 = $dlg->color = c($self)->brushColor;
		if( file_exists(realpath(SYSTEM_DIR.'/colors.in')) )
		{
			list($dlg->MainColors->text, $dlg->CustomColors->text) = unserialize(file_get_contents(realpath(SYSTEM_DIR.'/colors.in')));
		}
		if($dlg->execute()) {
			c($self)->brushColor = $dlg->color;
			c($self)->penColor = TColor::compare_contrast($col1, $dlg->color);
			file_put_contents(SYSTEM_DIR.'/colors.in', serialize(array($dlg->MainColors->text, $dlg->CustomColors->text)));
		}
		$dlg->free();
	}
}