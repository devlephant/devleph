<?
namespace DevS;
class cache
{
	public static $rrr = [];
	public static function c($e, $threadcheck=false)
	{
		if(!isSet(self::$rrr[$e]))
			self::$rrr[$e] = c($e,$threadcheck);
		return self::$rrr[$e];
	}
}