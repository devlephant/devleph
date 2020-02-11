<?
// Class author: Antonovich Sergey - vk.com/yandexphp
class YandexAPI
{
	static protected $data = null;
	static protected $cookie = 'CookieApi';
	public static function Authorize($Login,$Password,&$Result=null){
		if(empty($Login) or empty($Password)) return $Result = [false,null];
		if(file_exists(self::$cookie)) unlink(self::$cookie);
		$ch = curl_init('https://m.vk.com/');
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.3; rv:38.0) Gecko/20100101 Firefox/38.0');
		curl_setopt($ch, CURLOPT_COOKIEFILE, self::$cookie);
		curl_setopt($ch, CURLOPT_COOKIEJAR, self::$cookie);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		$exec = curl_exec($ch);
		preg_match('/<form.+="(.*?)".+>/', $exec, $match);
		if(empty($match[1])){
			curl_close($ch);
			return $Result = [false,null];
		}else{
			curl_setopt($ch, CURLOPT_URL, $match[1]);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query( ['email'=>$Login,'pass'=>$Password] ));
			curl_exec($ch);
			curl_setopt($ch, CURLOPT_URL, curl_getinfo($ch, CURLINFO_EFFECTIVE_URL));
			curl_setopt($ch, CURLOPT_POST, false);
			curl_exec($ch);
			curl_setopt($ch, CURLOPT_URL, 'https://oauth.vk.com/authorize?client_id=5585573&display=mobile&scope=friends,photos,audio,video,docs,status,wall,groups,messages,notifications,stats&redirect_uri=https://oauth.vk.com/blank.html&response_type=token&v5.53');
			$exec = curl_exec($ch);
			preg_match('/<form.+="(.*?)">/',$exec,$match);
			if(!empty($match[1])){
				curl_setopt($ch, CURLOPT_URL,  $match[1]);
				$exec = curl_exec($ch);
			}
			$url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
			if(empty($exec)){
				curl_close($ch);
				return $Result = [false,null];
			}else{
				$arr = parse_url($url);
				parse_str($arr['fragment'],$arr);
				curl_close($ch);
				self::$data = array_combine(['id','access_token'],[$arr['user_id'],$arr['access_token']]);
				if(array_key_exists('access_token', $arr)) return $Result = [true,self::$data];
				return $Result = [false,null];
			}
		}
	}
	private function JsonDecode1251($json){
		if( UTF8_SUPPORT )
			return $json;
		foreach($json as $i => $v) is_array($v)?$json[$i] = self::JsonDecode1251($v):$json[$i] = iconv('UTF-8','CP1251',$v);
		return $json;
	}
	public static function SendInquiry($Method,$Inquiry,&$Result=null){
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_URL, 'https://api.vk.com/method/'.$Method.'?'.$Inquiry.'&access_token='.self::$data['access_token']); 
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$json = curl_exec($ch);
		curl_close($ch);
		if(!$json) $Result = [false,null]; else $Result = [true,self::JsonDecode1251(json_decode($json,true))]; 
		return $Result;
	}
}
?>