<?
class wVolume{
	private function __getnet(){
		static $vol;
		if(isset($vol)) $vol = new dotnet('volume','Volume.Init'); 
		return $vol;
	}
	function __set($name, $value){
		switch($name){
			case 'Volume':  $this->__getnet()->VolumeSet((int)$value); break;
			case 'LeftChannel': $this->__getnet()->VolumeChannelsSet((int)0, (int)$value); break;
			case 'RightChannel': $this->__getnet()->VolumeChannelsSet((int)1, (int)$value); break;
			case 'Mute': if($this->__getnet()->MuteGet()!==(bool)$value) $this->__getnet()->MuteSet(); break;
		}
	}
	function __get($name){
		$arr = json_decode( $this->__getnet()->VolumeChannelsGet() );
		switch($name){
			case 'Volume':  return (int)$this->__getnet()->VolumeGet(); break;
			case 'LeftChannel': return (int)$arr[0]; break;
			case 'RightChannel': return (int)$arr[1]; break;
			case 'Mute': return (bool)$this->__getnet()->MuteGet(); break;
		}	
	}
}