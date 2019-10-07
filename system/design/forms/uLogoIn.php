<?
class fmLogoin
{
	private static $queue;
	private static $p;
	static function Progress($v, $t='')
	{
		self::$p = (isset(self::$p)?(self::$p + $v):$v);
		$v = self::$p;
		DevS\cache::c("fmLogoin->label5")->caption = "{$v}%";
		DevS\cache::c("fmLogoin->loadbar")->w = (691 / 100) * $v;
		DevS\cache::c("fmLogoin->loadbar_desc")->caption = $t;
	}
	static function Progress2($max, $MaxSteps, $t=false)
	{
		if(!isset(self::$queue[$MaxSteps]))
		{
			self::$queue[$MaxSteps][0] = 1;
			self::$queue[$MaxSteps][1] = self::$p;
		}else ++self::$queue[$MaxSteps][0];
		$Step = self::$queue[$MaxSteps][0];
		$v = (self::$p + floor(($max/$MaxSteps) * $Step))-1;
		DevS\cache::c("fmLogoin->loadbar")->w = (691 / 100) * $v;
		if($t!==false)
			DevS\cache::c("fmLogoin->loadbar_desc")->caption = $t;

		if($Step==$MaxSteps)
		{
			self::$p = $v;
			DevS\cache::c("fmLogoin->label5")->caption = "{$v}%";
			unset(self::$queue[$MaxSteps]);
		}
	}
}