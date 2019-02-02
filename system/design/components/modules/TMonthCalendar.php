<?
class TMonthCalendar extends TControl{
	public $class_name = __CLASS__;
    
    public function get_date(){
		
		return datetime_str($this->get_prop('date'));
	}
	
	function set_date($v){ $this->set_prop('date', str_datetime($v)); }
    

	
	function get_maxDate(){ return datetime_str($this->get_prop('maxDate'));}
	function get_minDate(){ return datetime_str($this->get_prop('minDate'));}
	function set_maxDate($v){ $this->set_prop('maxDate', str_datetime($v)); }
	function set_minDate($v){ $this->set_prop('minDate', str_datetime($v)); }
}