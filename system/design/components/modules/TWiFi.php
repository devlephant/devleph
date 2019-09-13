<?
class TWiFi extends __TNoVisual {
	static function getInformation(){
		global $result;
		$list = shell_exec('netsh wlan show networks');
		$result = (function_exists('delphi_is_uc') &&  delphi_is_uc())? iconv('CP866', 'UTF-8', $list) :iconv('CP866','CP1251',$list);
		return $result . _BR_;
	}
	static function networksList(){

		$list = shell_exec('netsh wlan show networks');
		$result = (function_exists('delphi_is_uc') &&  delphi_is_uc())? iconv('CP866', 'UTF-8', $list) :iconv('CP866','CP1251',$list);
		$txt .= $result ._BR_;
		
		$text = $txt;
		
		preg_match_all("#SSID (.*?)\\���#ies",$text,$matches);
		$hotspot = implode($matches[1]);
		
		return $hotspot;
	}
	static function connectNetwork($name){
		shell_exec("netsh wlan disconnect");
		shell_exec("netsh wlan connect name=$name");
	}
	static function disconnect(){
		shell_exec("netsh wlan disconnect");
	}
	static function showInterface(){
		global $res;
		$list = shell_exec('netsh wlan show interface');
		$res = (function_exists('delphi_is_uc') &&  delphi_is_uc())? iconv('CP866', 'UTF-8', $list) :iconv('CP866','CP1251',$list);
		return $res . _BR_;
	}
	static function connection(){
		global $res;
		$text = $res;
		$ip=explode('Имя:',$text);
		$ip=explode('Опис',$ip[1]);
		$ip=$ip[0];
		return $ip;
	}
	static function state(){
		global $res;
		$text = $res;
		$ip=explode('Состояние:',$text);
		$ip=explode('SSID',$ip[1]);
		$ip=$ip[0];
		return $ip;
	}
	static function cipher(){
		global $res;
		$text = $res;
		$ip=explode('Шифр:',$text);
		$ip=explode('Режим',$ip[1]);
		$ip=$ip[0];
		return $ip;
	}
	static function typeRadio(){
		global $res;
		$text = $res;
		$ip=explode('Тип радио:',$text);
		$ip=explode('Проверка',$ip[1]);
		$ip=$ip[0];
		return $ip;
	}
	static function typeNetwork(){
		global $res;
		$text = $res;
		$ip=explode('Тип сети:',$text);
		$ip=explode('Тип',$ip[1]);
		$ip=$ip[0];
		return $ip;
	}
	static function receipt(){
		global $res;
		$text = $res;
		$ip=explode('Скорость приёма (Мбит/с):',$text);
		$ip=explode('Скорость',$ip[1]);
		$ip=$ip[0];
		return $ip;
	}
	static function speedR(){
		global $res;
		$text = $res;
		$ip=explode('Скорость передачи (Мбит/с):',$text);
		$ip=explode('Сигнал',$ip[1]);
		$ip=$ip[0];
		return $ip;
	}
	static function signal(){
		global $res;
		$text = $res;
		$ip=explode('Сигнал:',$text);
		$ip=explode('Профиль',$ip[1]);
		$ip=$ip[0];
		return $ip;
	}
}