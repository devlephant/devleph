<?

class TMCIPlayer extends __TNoVisual {

   


   
   

 public function __construct($onwer=nil,$init=true,$self=nil){
	parent::__construct($onwer, $init, $self);
  
        if ($init){
	    $this->priority = tpIdle;
		$this->volume = '500';
		$this->PlayOnStart = false;
		$this->repeat = false;
	}
    }
       


	   
	   
    public function __initComponentInfo(){
        
        parent::__initComponentInfo();
               
        if ($this->playOnStart)
            $this->play();
			
			Global $MediaPlayer;
			
			$MediaPlayer    = NEW FFI("
        [lib='winmm.dll']
                sint32 mciSendStringA
                (
                        char    *lpszCommand,
                        char    *lpszReturnString,
                        uint32  cchReturn,
                        sint32  hwndCallback
                );
");	

    }  
	   
	   


function play()
            {		

		$MediaPlayer    = NEW FFI("
        [lib='winmm.dll']
                sint32 mciSendStringA
                (
                        char    *lpszCommand,
                        char    *lpszReturnString,
                        uint32  cchReturn,
                        sint32  hwndCallback
                );
");	
             
			
$url = $this->url;
$volume = $this->volume;

if($this->repeat){
$repeat = 'repeat';
}		
			 
$MediaPlayer->mciSendStringA('close myFile', '', 0, 0);
$MediaPlayer->mciSendStringA('open "'.$url.'" alias myFile', '', 0, 0);
$MediaPlayer->mciSendStringA("setaudio myfile volume to ".$volume, '', 0, 0);
$MediaPlayer->mciSendStringA("play myFile ".$repeat, '', 0, 0);	 
	
	
	        }
static function stop()	
            {
Global $MediaPlayer;
			
			
$MediaPlayer->mciSendStringA('close myFile', '', 0, 0);		
			
			}
			


static function pause()	
            {
Global $MediaPlayer;
			
			
$MediaPlayer->mciSendStringA('pause myFile', '', 0, 0);		
			
			}				



static function resume()	
            {
Global $MediaPlayer;
			
			
$MediaPlayer->mciSendStringA('resume myFile', '', 0, 0);		
			
			}			
			
			
			
function vol($volume)	
            {
Global $MediaPlayer;
			

$MediaPlayer->mciSendStringA("setaudio myfile volume to ".$volume, '', 0, 0);

$this->volume = $volume;

return $volume;
			
			}	

		
			
			
			
			
			
			
static function status()
                   {
Global $MediaPlayer;

$status = $MediaPlayer->mciSendStringA('status myFile', '', 0, 0);
if( $status == '263' ){
$answer = 'Stop';
return $answer;
}
if( $status == '273' ){
$answer = 'Play';
return $answer;
}

}


}




?>