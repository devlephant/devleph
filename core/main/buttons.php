<?
/*
  
  PHP4Delphi Buttons Library
  
  2019 ver 1
  
*/

global $_c;

$_c->setConstList(['blGlyphLeft', 'blGlyphRight', 'blGlyphTop', 'blGlyphBottom']);

class TButton extends TControl {}

class TBitBtn extends TControl
{
	
	protected $_picture;
	
	public function get_picture()
	{
		return $this->Glyph;
	}
	
	public function doClick()
	{	
		call_user_func(event_get($this->self, 'onClick'), $this->self);
	}
	
	public function loadPicture($file)
	{
		$this->picture->loadAnyFile($file);
	}
	
	public function loadFromBitmap($bt)
	{
		$this->picture->assign($bt);
	}
}

class TSpeedButton extends TBitBtn {}
?>