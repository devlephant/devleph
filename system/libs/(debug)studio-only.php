<?php
define('DSS_COMMON_ERROR', 0, true);
define('DSS_FATAL_ERROR', 1, true);
class dssMessages
{
	public static function error($level, $message)
	{
		return ;
	}
	static function framewiz($int,$val)
	{
		static $form;
		static $wwp;
		if(!isset($form))
		{
			$form = new TForm();
			$form->formstyle = fsStayOnTop;
			$form->autoSize = true;
		}
		if(!isset($wwp[$int]))
		{
			$wwp[$int] = new TLabel($form);
			$wwp[$int]->parent = $form;
			$wwp[$int]->align = alTop;
		}
		$wwp[$int]->caption = $val;
		$form->show();
	}
}