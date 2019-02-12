<?
class TVideoBox extends TScrollBox{

    
	#dio;
    #new_Panel;
    #sampleMovie;

	public function __construct($owner=nil,$init=true,$self=nil){
		parent::__construct($owner,$init,$self);
		if($init){
			$this->caption = '';
		}
	}

	public static function SetParent_form($mdMemberRef,$mdToken){
		$ffi = new ffi("[lib='user32.dll'] int SetParent( int mdMemberRef, int mdToken );");
		return $ffi->SetParent($mdMemberRef,$mdToken);
	}

	public function Load($file,$bool_,$caption=''){
		global $dio,$new_Panel,$sampleMovie;
		$dio = new DOTNET('video','video.myclass');
		$new_Panel=$dio->New_Panel();
		$new_Panel->Left = $new_Panel->Top = 0;
		$new_Panel->Width = $this->w;
		$new_Panel->Height = $this->h;
		$this->SetParent_form($new_Panel->Handle, $this->handle );
		$sampleMovie=$dio->xMovie_Load($new_Panel->Handle,$file,$caption,$bool_);
		$dio->xMovie_SetSize($sampleMovie,$new_Panel->Width,$new_Panel->Height);
		return $sampleMovie;
	}

	public function Close(){ global $dio; return $dio->xMovie_Close($this->handle); }
	public function Play(){ global $dio; return $dio->xMovie_Play($this->handle); }
	public function Stop(){ global $dio; return $dio->xMovie_Stop($this->handle); }
	public function Pause(){ global $dio; return $dio->xMovie_Pause($this->handle); }
	public function Resume(){ global $dio; return $dio->xMovie_Resume($this->handle); }
	public function GetSeek(){ global $dio; return $dio->xMovie_GetSeek($this->handle); }
	public function Seek($seekPosition){ global $dio; return $dio->xMovie_Seek($this->handle,$seekPosition); }
	public function GetVolume(){ global $dio; return $dio->xMovie_GetVolume($this->handle); }
	public function SetVolume($volume){ global $dio; return $dio->xMovie_SetVolume($this->handle,$volume); }
	public function GetLength(){ global $dio; return $dio->xMovie_GetLength($this->handle); }
	public function GetZoom(){ global $dio; return $dio->xMovie_GetZoom($this->handle); }
	public function SetZoom($zoom){ global $dio; return $dio->xMovie_SetZoom($this->handle,$zoom); }
	public function GetSize($side){ global $dio; return $dio->xMovie_GetSize($this->handle,$side); }
	public function SetSize($w,$h){ global $dio; return $dio->xMovie_SetSize($this->handle,$w,$h); }
	public function GetPosition($coordinate){ global $dio; return $dio->xMovie_GetPosition($this->handle,$coordinate); }
	public function SetPostion($x,$y){ global $dio; return $dio->xMovie_SetPostion($this->handle,$x,$y); }
	public function GetRepeat(){ global $dio; return $dio->xMovie_GetRepeat($this->handle); }
	public function SetRepeat($repeat){ global $dio; return $dio->xSetRepeat($this->handle,$repeat); }

}