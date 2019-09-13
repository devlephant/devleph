<?
$_c->setConstList(['ttbtAll', 'ttbtCenter']);
class TBoxedTib extends TPanel
{
	public function __construct($owner=nil,$self=nil)
	{
		parent:__construct($owner,$self);
		if($self==nil)
		{
			gui_propset($this->self, 'caption', '');
			gui_propset($this->self, 'bevelOuter', bvNone);
		}
	}
}