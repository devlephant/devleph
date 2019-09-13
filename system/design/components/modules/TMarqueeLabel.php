<?
class TMarqueeLabel extends TLabel {
    

	public function setIntervalTime($self, $interval){
		gui_propSet($self, 'interval', (int)$interval);
	}

	public function setEnabledTime($self, $value){
		gui_propSet($self, 'enabled', $value);
	}

	public function getEnabledTime($self){
		return gui_propGet($self, 'enabled');
	}

	public function clearTimer($self){
		if (gui_is($self, 'TTimer')){
			gui_propSet($self, 'enabled', false);
			event_set($self, 'OnTimer', null);
			gui_threadFree($self);
		}
	}

	public function CreateTTimer($func, $interval, $Enabled = true, $p = false, $param = []) {
		$TTimerNew = gui_create('TTimer', null);
		gui_propSet($TTimerNew, 'interval', (int)$interval);
		if(!$p)
			event_set($TTimerNew, 'OnTimer', $func);
		else
			event_set($TTimerNew, 'OnTimer', function($self) use ($func, $param){
				call_user_func_array($func, array_merge([$self], $param));
			});

		gui_propSet($TTimerNew, 'enabled', $Enabled);
		return $TTimerNew;
	}


    public function __construct($onwer=nil,$self=nil){
        parent::__construct($onwer,$self);

        if ($self==nil){
			$this->active = true;
			$this->leftDirection = true;
			$this->IntervalTimer  = 100;
        }
    }

    public function __initComponentInfo(){
        parent::__initComponentInfo();
		$this->CreateTTimer('TMarqueeLabel::running_line', $this->IntervalTimer, true, true, [$this]);
    }

	public function running_line($self, $obj) {
		if($obj->active) {
			if($obj->leftDirection) {
				if($Text = $obj->caption) {
					$Text .= $Text[0];
					$obj->caption = substr($Text, 1);
				}
			} else {
				if($Text = $obj->caption) {
					$Text = $Text[strlen($Text)-1].$Text;
					$obj->caption = substr($Text, 0, -1);
				}
			}
		}
	}
}