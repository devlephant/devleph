<?
$_c->setConstList(['ttbtAll', 'ttbtCenter']);
class TBoxedTib extends TPanel
{
	public function __construct($owner=nil,$init=true,$self=nil)
	{
		parent:__construct($owner,$init,$self);
		if($init)
		{
			gui_propset($this->self, 'caption', '');
			gui_propset($this->self, 'bevelOuter', bvNone);
		}
	}
}