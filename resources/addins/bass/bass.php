<?

class BASS{

    private static $ffi; // ffi
    private static $bass; // bass.dll

    /*****************************/
    /* BASS STRUCTURE < START >  */
    /*****************************/
	public static function GUID ($data1=null, $data2=null, $data3=null, $data4=null) {return func_num_args() ? BASS::struct('GUID') : BASS::struct('GUID', array('data1'=>$data1, 'data2'=>$data2, 'data3'=>$data3, 'data4'=>$data4));}
	
	public static function DEVICEINFO ($name=null, $driver=null, $flags=null) {return func_num_args() ? BASS::struct('BASS_DEVICEINFO') : BASS::struct('BASS_DEVICEINFO', array('name'=>$name, 'driver'=>$driver, 'flags'=>$flags));}
	public static function INFO ($flags=null, $hwsize=null, $hwfree=null, $freesam=null, $free3d=null, $minrate=null, $maxrate=null, $eax=null, $minbuf=null, $dsver=null, $latency=null, $initflags=null, $speakers=null, $freq=null) {return func_num_args() ? BASS::struct('BASS_INFO') : BASS::struct('BASS_INFO', array('flags'=>$flags, 'hwsize'=>$hwsize, 'hwfree'=>$hwfree, 'freesam'=>$freesam, 'free3d'=>$free3d, 'minrate'=>$minrate, 'maxrate'=>$maxrate, 'eax'=>$eax, 'minbuf'=>$minbuf, 'dsver'=>$dsver, 'latency'=>$latency, 'initflags'=>$initflags, 'speakers'=>$speakers, 'freq'=>$freq));}
	public static function RECORDINFO ($flags=null, $formats=null, $inputs=null, $singlein=null, $freq=null) {return func_num_args() ? BASS::struct('BASS_RECORDINFO') : BASS::struct('BASS_RECORDINFO', array('flags'=>$flags, 'formats'=>$formats, 'inputs'=>$inputs, 'singlein'=>$singlein, 'freq'=>$freq));}
	public static function SAMPLE ($freq=null, $volume=null, $pan=null, $flags=null, $length=null, $max=null, $origres=null, $chans=null, $mingap=null, $mode3d=null, $mindist=null, $maxdist=null, $iangle=null, $oangle=null, $outvol=null, $vam=null, $priority=null) {return func_num_args() ? BASS::struct('BASS_SAMPLE') : BASS::struct('BASS_SAMPLE', array('freq'=>$freq, 'volume'=>$volume, 'pan'=>$pan, 'flags'=>$flags, 'length'=>$length, 'max'=>$max, 'origres'=>$origres, 'chans'=>$chans, 'mingap'=>$mingap, 'mode3d'=>$mode3d, 'mindist'=>$mindist, 'maxdist'=>$maxdist, 'iangle'=>$iangle, 'oangle'=>$oangle, 'outvol'=>$outvol, 'vam'=>$vam, 'priority'=>$priority));}
	public static function CHANNELINFO ($freq=null, $chans=null, $flags=null, $ctype=null, $origres=null, $plugin=null, $sample=null, $filename=null) {return func_num_args() ? BASS::struct('BASS_CHANNELINFO') : BASS::struct('BASS_CHANNELINFO', array('freq'=>$freq, 'chans'=>$chans, 'flags'=>$flags, 'ctype'=>$ctype, 'origres'=>$origres, 'plugin'=>$plugin, 'sample'=>$sample, 'filename'=>$filename));}
	public static function PLUGINFORM ($ctype=null, $name=null, $exts=null) {return func_num_args() ? BASS::struct('BASS_PLUGINFORM') : BASS::struct('BASS_PLUGINFORM', array('ctype'=>$ctype, 'name'=>$name, 'exts'=>$exts));}
	public static function PLUGININFO ($version=null, $formatc=null, $formats=null) {return func_num_args() ? BASS::struct('BASS_PLUGININFO') : BASS::struct('BASS_PLUGININFO', array('version'=>$version, 'formatc'=>$formatc, 'formats'=>$formats));}
	public static function VECTOR3D ($x=null, $y=null, $z=null) {return func_num_args() ? BASS::struct('BASS_3DVECTOR') : BASS::struct('BASS_3DVECTOR', array('x'=>$x, 'y'=>$y, 'z'=>$z));}
	
	public static function TAG_APE_BINARY ($key=null, $data=null, $length=null) {return func_num_args() ? BASS::struct('TAG_APE_BINARY') : BASS::struct('TAG_APE_BINARY', array('key'=>$key, 'data'=>$data, 'length'=>$length));}
	public static function TAG_BEXT ($Description=null, $Originator=null, $OriginatorReference=null, $OriginationDate=null, $OriginationTime=null, $TimeReference=null, $Version=null, $UMID=null, $Reserved=null, $CodingHistory=null) {return func_num_args() ? BASS::struct('TAG_BEXT') : BASS::struct('TAG_BEXT', array('Description'=>$Description, 'Originator'=>$Originator, 'OriginatorReference'=>$OriginatorReference, 'OriginationDate'=>$OriginationDate, 'OriginationTime'=>$OriginationTime, 'TimeReference'=>$TimeReference, 'Version'=>$Version, 'UMID'=>$UMID, 'Reserved'=>$Reserved, 'CodingHistory'=>$CodingHistory));}
	public static function TAG_CART_TIMER ($dwUsage=null, $dwValue=null) {return func_num_args() ? BASS::struct('TAG_CART_TIMER') : BASS::struct('TAG_CART_TIMER', array('dwUsage'=>$dwUsage, 'dwValue'=>$dwValue));}
	public static function TAG_CART ($Version=null, $Title=null, $Artist=null, $CutID=null, $ClientID=null, $Category=null, $Classification=null, $OutCue=null, $StartDate=null, $StartTime=null, $EndDate=null, $EndTime=null, $ProducerAppID=null, $ProducerAppVersion=null, $UserDef=null, $dwLevelReference=null, $PostTimer=null, $Reserved=null, $URL=null, $TagText=null) {return func_num_args() ? BASS::struct('TAG_CART') : BASS::struct('TAG_CART', array('Version'=>$Version, 'Title'=>$Title, 'Artist'=>$Artist, 'CutID'=>$CutID, 'ClientID'=>$ClientID, 'Category'=>$Category, 'Classification'=>$Classification, 'OutCue'=>$OutCue, 'StartDate'=>$StartDate, 'StartTime'=>$StartTime, 'EndDate'=>$EndDate, 'EndTime'=>$EndTime, 'ProducerAppID'=>$ProducerAppID, 'ProducerAppVersion'=>$ProducerAppVersion, 'UserDef'=>$UserDef, 'dwLevelReference'=>$dwLevelReference, 'PostTimer'=>$PostTimer, 'Reserved'=>$Reserved, 'URL'=>$URL, 'TagText'=>$TagText));}
	public static function TAG_CA_CODEC ($ftype=null, $atype=null, $name=null) {return func_num_args() ? BASS::struct('TAG_CA_CODEC') : BASS::struct('TAG_CA_CODEC', array('ftype'=>$ftype, 'atype'=>$atype, 'name'=>$name));}
	public static function TAG_ID3 ($id=null, $title=null, $artist=null, $album=null, $year=null, $comment=null, $genre=null) {return func_num_args() ? BASS::struct('TAG_ID3') : BASS::struct('TAG_ID3', array('id'=>$id, 'title'=>$title, 'artist'=>$artist, 'album'=>$album, 'year'=>$year, 'comment'=>$comment, 'genre'=>$genre));}
	
	public static function DX8_CHORUS ($fWetDryMix=null, $fDepth=null, $fFeedback=null, $fFrequency=null, $lWaveform=null, $fDelay=null, $lPhase=null) {return func_num_args() ? BASS::struct('BASS_DX8_CHORUS') : BASS::struct('BASS_DX8_CHORUS', array('fWetDryMix'=>$fWetDryMix, 'fDepth'=>$fDepth, 'fFeedback'=>$fFeedback, 'fFrequency'=>$fFrequency, 'lWaveform'=>$lWaveform, 'fDelay'=>$fDelay, 'lPhase'=>$lPhase));}
	public static function DX8_COMPRESSOR ($fGain=null, $fAttack=null, $fRelease=null, $fThreshold=null, $fRatio=null, $fPredelay=null) {return func_num_args() ? BASS::struct('BASS_DX8_COMPRESSOR') : BASS::struct('BASS_DX8_COMPRESSOR', array('fGain'=>$fGain, 'fAttack'=>$fAttack, 'fRelease'=>$fRelease, 'fThreshold'=>$fThreshold, 'fRatio'=>$fRatio, 'fPredelay'=>$fPredelay));}
	public static function DX8_DISTORTION ($fGain=null, $fEdge=null, $fPostEQCenterFrequency=null, $fPostEQBandwidth=null, $fPreLowpassCutoff=null) {return func_num_args() ? BASS::struct('BASS_DX8_DISTORTION') : BASS::struct('BASS_DX8_DISTORTION', array('fGain'=>$fGain, 'fEdge'=>$fEdge, 'fPostEQCenterFrequency'=>$fPostEQCenterFrequency, 'fPostEQBandwidth'=>$fPostEQBandwidth, 'fPreLowpassCutoff'=>$fPreLowpassCutoff));}
	public static function DX8_ECHO ($fWetDryMix=null, $fFeedback=null, $fLeftDelay=null, $fRightDelay=null, $lPanDelay=null) {return func_num_args() ? BASS::struct('BASS_DX8_ECHO') : BASS::struct('BASS_DX8_ECHO', array('fWetDryMix'=>$fWetDryMix, 'fFeedback'=>$fFeedback, 'fLeftDelay'=>$fLeftDelay, 'fRightDelay'=>$fRightDelay, 'lPanDelay'=>$lPanDelay));}
	public static function DX8_FLANGER ($fWetDryMix=null, $fDepth=null, $fFeedback=null, $fFrequency=null, $lWaveform=null, $fDelay=null, $lPhase=null) {return func_num_args() ? BASS::struct('BASS_DX8_FLANGER') : BASS::struct('BASS_DX8_FLANGER', array('fWetDryMix'=>$fWetDryMix, 'fDepth'=>$fDepth, 'fFeedback'=>$fFeedback, 'fFrequency'=>$fFrequency, 'lWaveform'=>$lWaveform, 'fDelay'=>$fDelay, 'lPhase'=>$lPhase));}
	public static function DX8_GARGLE ($dwRateHz=null, $dwWaveShape=null) {return func_num_args() ? BASS::struct('BASS_DX8_GARGLE') : BASS::struct('BASS_DX8_GARGLE', array('dwRateHz'=>$dwRateHz, 'dwWaveShape'=>$dwWaveShape));}
	public static function DX8_I3DL2REVERB ($lRoom=null, $lRoomHF=null, $flRoomRolloffFactor=null, $flDecayTime=null, $flDecayHFRatio=null, $lReflections=null, $flReflectionsDelay=null, $lReverb=null, $flReverbDelay=null, $flDiffusion=null, $flDensity=null, $flHFReference=null) {return func_num_args() ? BASS::struct('BASS_DX8_I3DL2REVERB') : BASS::struct('BASS_DX8_I3DL2REVERB', array('lRoom'=>$lRoom, 'lRoomHF'=>$lRoomHF, 'flRoomRolloffFactor'=>$flRoomRolloffFactor, 'flDecayTime'=>$flDecayTime, 'flDecayHFRatio'=>$flDecayHFRatio, 'lReflections'=>$lReflections, 'flReflectionsDelay'=>$flReflectionsDelay, 'lReverb'=>$lReverb, 'flReverbDelay'=>$flReverbDelay, 'flDiffusion'=>$flDiffusion, 'flDensity'=>$flDensity, 'flHFReference'=>$flHFReference));}
	public static function DX8_PARAMEQ ($fCenter=null, $fBandwidth=null, $fGain=null) {return func_num_args() ? BASS::struct('BASS_DX8_PARAMEQ') : BASS::struct('BASS_DX8_PARAMEQ', array('fCenter'=>$fCenter, 'fBandwidth'=>$fBandwidth, 'fGain'=>$fGain));}
	public static function DX8_REVERB ($fInGain=null, $fReverbMix=null, $fReverbTime=null, $fHighFreqRTRatio=null) {return func_num_args() ? BASS::struct('BASS_DX8_REVERB') : BASS::struct('BASS_DX8_REVERB', array('fInGain'=>$fInGain, 'fReverbMix'=>$fReverbMix, 'fReverbTime'=>$fReverbTime, 'fHighFreqRTRatio'=>$fHighFreqRTRatio));}

	public static function DOWNLOADPROC ($buffer=null, $length=null, $user=null) {return func_num_args() ? BASS::struct('DOWNLOADPROC') : BASS::struct('DOWNLOADPROC', array('buffer'=>$buffer, 'length'=>$length, 'user'=>$user));}
	public static function FILECLOSEPRO ($user=null) {return func_num_args() ? BASS::struct('FILECLOSEPRO') : BASS::struct('FILECLOSEPRO', array('user'=>$user));}
	public static function FILELENPRO ($user=null) {return func_num_args() ? BASS::struct('FILELENPRO') : BASS::struct('FILELENPRO', array('user'=>$user));}
	public static function FILEREADPRO ($buffer=null, $length=null, $user=null) {return func_num_args() ? BASS::struct('FILEREADPRO') : BASS::struct('FILEREADPRO', array('buffer'=>$buffer, 'length'=>$length, 'user'=>$user));}
	public static function FILESEEKPRO ($offset=null, $user=null) {return func_num_args() ? BASS::struct('FILESEEKPRO') : BASS::struct('FILESEEKPRO', array('offset'=>$offset, 'user'=>$user));}
	public static function STREAMPROC ($handle=null, $buffer=null, $length=null, $user=null) {return func_num_args() ? BASS::struct('STREAMPROC') : BASS::struct('STREAMPROC', array('handle'=>$handle, 'buffer'=>$buffer, 'length'=>$length, 'user'=>$user));}
	public static function FILEPROCS ($close=null, $length=null, $read=null, $seek=null) {return func_num_args() ? BASS::struct('FILEPROCS') : BASS::struct('FILEPROCS', array('close'=>$close, 'length'=>$length, 'read'=>$read, 'seek'=>$seek));}
	public static function RECORDPROC ($handle=null, $buffer=null, $length=null, $user=null) {return func_num_args() ? BASS::struct('RECORDPROC') : BASS::struct('RECORDPROC', array('handle'=>$handle, 'buffer'=>$buffer, 'length'=>$length, 'user'=>$user));}
	public static function DSPPROC ($handle=null, $channel=null, $buffer=null, $length=null, $user=null) {return func_num_args() ? BASS::struct('DSPPROC') : BASS::struct('DSPPROC', array('handle'=>$handle, 'channel'=>$channel, 'buffer'=>$buffer, 'length'=>$length, 'user'=>$user));}
	public static function SYNCPROC ($handle=null, $channel=null, $data=null, $user=null) {return func_num_args() ? BASS::struct('SYNCPROC') : BASS::struct('SYNCPROC', array('handle'=>$handle, 'channel'=>$channel, 'data'=>$data, 'user'=>$user));} 
    /*****************************/
    /* BASS STRUCTURE < EBD >    */
    /*****************************/
    
    /*****************************/
    /* BASS FUNCTIONS < START >  */
    /*****************************/
	public static function GetConfig($option) {if(BASS::is_enabled()) return BASS::$ffi->BASS_GetConfig($option);}
	public static function GetConfigPtr($option) {if(BASS::is_enabled()) return BASS::$ffi->BASS_GetConfigPtr($option);}
	public static function SetConfig($option,$value) {if(BASS::is_enabled()) return BASS::$ffi->BASS_SetConfig($option,$value);}
	public static function SetConfigPtr($option,$value) {if(BASS::is_enabled()) return BASS::$ffi->BASS_SetConfigPtr($option,$value);}

	public static function PluginFree($handle) {if(BASS::is_enabled()) return BASS::$ffi->BASS_PluginFree($handle);}
	public static function PluginGetInfo($handle) {if(BASS::is_enabled()) return BASS::$ffi->BASS_PluginGetInfo($handle);}
	public static function PluginLoad($file,$flags=0) {if(BASS::is_enabled()) return BASS::$ffi->BASS_PluginLoad($file,$flags);}

	public static function ErrorGetCode() {if(BASS::is_enabled()) return BASS::$ffi->BASS_ErrorGetCode();}
	public static function Free() {if(BASS::is_enabled()) return BASS::$ffi->BASS_Free();}
	public static function GetCPU() {if(BASS::is_enabled()) return BASS::$ffi->BASS_GetCPU();}
	public static function GetDevice() {if(BASS::is_enabled()) return BASS::$ffi->BASS_GetDevice();}
	public static function GetDeviceInfo($device,&$info) {if(BASS::is_enabled()) return BASS::$ffi->BASS_GetDeviceInfo($device,$info);}
	public static function GetDSoundObject($object) {if(BASS::is_enabled()) return BASS::$ffi->BASS_GetDSoundObject($object);}
	public static function GetInfo($info) {if(BASS::is_enabled()) return BASS::$ffi->BASS_GetInfo($info);}
	public static function GetVersion() {if(BASS::is_enabled()) return BASS::$ffi->BASS_GetVersion();}
	public static function GetVolume() {if(BASS::is_enabled()) return BASS::$ffi->BASS_GetVolume();}
	public static function Init($device,$freq,$flags,$win,$clsid=null) {if(BASS::is_enabled()) return BASS::$ffi->BASS_Init($device,$freq,$flags,$win,$clsid);}
	public static function Pause() {if(BASS::is_enabled()) return BASS::$ffi->BASS_Pause();}
	public static function SetDevice($device) {if(BASS::is_enabled()) return BASS::$ffi->BASS_SetDevice($device);}
	public static function SetVolume($volume) {if(BASS::is_enabled()) return BASS::$ffi->BASS_SetVolume($volume);}
	public static function Start() {if(BASS::is_enabled()) return BASS::$ffi->BASS_Start();}
	public static function Stop() {if(BASS::is_enabled()) return BASS::$ffi->BASS_Stop();}
	public static function Update($length) {if(BASS::is_enabled()) return BASS::$ffi->BASS_Update($length);}

	public static function Apply3D() {if(BASS::is_enabled()) return BASS::$ffi->BASS_Apply3D();}
	public static function Get3DFactors($distf,$rollf,$doppf) {if(BASS::is_enabled()) return BASS::$ffi->BASS_Get3DFactors($distf,$rollf,$doppf);}
	public static function Get3DPosition($pos,$vel,$front,$top) {if(BASS::is_enabled()) return BASS::$ffi->BASS_Get3DPosition($pos,$vel,$front,$top);}
	public static function GetEAXParameters($env,$vol,$decay,$damp) {if(BASS::is_enabled()) return BASS::$ffi->BASS_GetEAXParameters($env,$vol,$decay,$damp);}
	public static function Set3DFactors($distf,$rollf,$doppf) {if(BASS::is_enabled()) return BASS::$ffi->BASS_Set3DFactors($distf,$rollf,$doppf);}
	public static function Set3DPosition($pos,$vel,$front,$top) {if(BASS::is_enabled()) return BASS::$ffi->BASS_Set3DPosition($pos,$vel,$front,$top);}
	public static function SetEAXParameters($env,$vol,$decay,$damp) {if(BASS::is_enabled()) return BASS::$ffi->BASS_SetEAXParameters($env,$vol,$decay,$damp);}

	public static function SampleCreate($length,$freq,$chans,$max,$flags) {if(BASS::is_enabled()) return BASS::$ffi->BASS_SampleCreate($length,$freq,$chans,$max,$flags);}
	public static function SampleFree($handle) {if(BASS::is_enabled()) return BASS::$ffi->BASS_SampleFree($handle);}
	public static function SampleGetChannel($handle,$onlynew) {if(BASS::is_enabled()) return BASS::$ffi->BASS_SampleGetChannel($handle,$onlynew);}
	public static function SampleGetChannels($handle,$channels) {if(BASS::is_enabled()) return BASS::$ffi->BASS_SampleGetChannels($handle,$channels);}
	public static function SampleGetData($handle,$buffer) {if(BASS::is_enabled()) return BASS::$ffi->BASS_SampleGetData($handle,$buffer);}
	public static function SampleGetInfo($handle,$info) {if(BASS::is_enabled()) return BASS::$ffi->BASS_SampleGetInfo($handle,$info);}
	public static function SampleSetData($handle,$buffer) {if(BASS::is_enabled()) return BASS::$ffi->BASS_SampleSetData($handle,$buffer);}
	public static function SampleSetInfo($handle,$info) {if(BASS::is_enabled()) return BASS::$ffi->BASS_SampleSetInfo($handle,$info);}
	public static function SampleStop($handle) {if(BASS::is_enabled()) return BASS::$ffi->BASS_SampleStop($handle);}
	public static function SampleLoad($mem,$file,$offset,$length,$max,$flags) {if(BASS::is_enabled()) return BASS::$ffi->BASS_SampleLoad($mem,$file,$offset,$length,$max,$flags);}

	public static function StreamCreate($freq,$chans,$flags,$proc,$user) {if(BASS::is_enabled()) return BASS::$ffi->BASS_StreamCreate($freq,$chans,$flags,$proc,$user);}
	public static function StreamCreateFile($mem,$file,$offset,$length,$flags) {if(BASS::is_enabled()) return BASS::$ffi->BASS_StreamCreateFile($mem,$file,$offset,$length,$flags);}
	public static function StreamCreateFileUser($system,$flags,$procs,$user) {if(BASS::is_enabled()) return BASS::$ffi->BASS_StreamCreateFileUser($system,$flags,$procs,$user);}
	public static function StreamCreateURL($url,$offset,$flags,$proc,$user) {if(BASS::is_enabled()) return BASS::$ffi->BASS_StreamCreateURL($url,$offset,$flags,$proc,$user);}
	public static function StreamFree($handle) {if(BASS::is_enabled()) return BASS::$ffi->BASS_StreamFree($handle);}
	public static function StreamGetFilePosition($handle,$mode) {if(BASS::is_enabled()) return BASS::$ffi->BASS_StreamGetFilePosition($handle,$mode);}
	public static function StreamPutData($handle,$buffer,$length) {if(BASS::is_enabled()) return BASS::$ffi->BASS_StreamPutData($handle,$buffer,$length);}
	public static function StreamPutFileData($handle,$buffer,$length) {if(BASS::is_enabled()) return BASS::$ffi->BASS_StreamPutFileData($handle,$buffer,$length);}

	public static function MusicFree($handle) {if(BASS::is_enabled()) return BASS::$ffi->BASS_MusicFree($handle);}
	public static function MusicLoad($mem,$file,$offset,$length,$flags,$freq) {if(BASS::is_enabled()) return BASS::$ffi->BASS_MusicLoad($mem,$file,$offset,$length,$flags,$freq);}

	public static function RecordFree() {if(BASS::is_enabled()) return BASS::$ffi->BASS_RecordFree();}
	public static function RecordGetDevice() {if(BASS::is_enabled()) return BASS::$ffi->BASS_RecordGetDevice();}
	public static function RecordGetDeviceInfo($device,$info) {if(BASS::is_enabled()) return BASS::$ffi->BASS_RecordGetDeviceInfo($device,$info);}
	public static function RecordGetInfo($info) {if(BASS::is_enabled()) return BASS::$ffi->BASS_RecordGetInfo($info);}
	public static function RecordGetInput($input,$volume) {if(BASS::is_enabled()) return BASS::$ffi->BASS_RecordGetInput($input,$volume);}
	public static function RecordGetInputName($input) {if(BASS::is_enabled()) return BASS::$ffi->BASS_RecordGetInputName($input);}
	public static function RecordInit($device) {if(BASS::is_enabled()) return BASS::$ffi->BASS_RecordInit($device);}
	public static function RecordSetDevice($device) {if(BASS::is_enabled()) return BASS::$ffi->BASS_RecordSetDevice($device);}
	public static function RecordSetInput($input,$flags,$volume) {if(BASS::is_enabled()) return BASS::$ffi->BASS_RecordSetInput($input,$flags,$volume);}
	public static function RecordStart($freq,$chans,$flags,$proc,$user) {if(BASS::is_enabled()) return BASS::$ffi->BASS_RecordStart($freq,$chans,$flags,$proc,$user);}

	public static function ChannelBytes2Seconds($handle,$pos) {if(BASS::is_enabled()) return BASS::$ffi->BASS_ChannelBytes2Seconds($handle,$pos);}
	public static function ChannelFlags($handle,$flags,$mask) {if(BASS::is_enabled()) return BASS::$ffi->BASS_ChannelFlags($handle,$flags,$mask);}
	public static function ChannelGet3DAttributes($handle,$mode,$min,$max,$iangle,$oangle,$outvol) {if(BASS::is_enabled()) return BASS::$ffi->BASS_ChannelGet3DAttributes($handle,$mode,$min,$max,$iangle,$oangle,$outvol);}
	public static function ChannelGet3DPosition($handle,$pos,$orient,$vel) {if(BASS::is_enabled()) return BASS::$ffi->BASS_ChannelGet3DPosition($handle,$pos,$orient,$vel);}
	public static function ChannelGetAttribute($handle,$attrib,$value) {if(BASS::is_enabled()) return BASS::$ffi->BASS_ChannelGetAttribute($handle,$attrib,$value);}
	public static function ChannelGetData($handle,$buffer,$length) {if(BASS::is_enabled()) return BASS::$ffi->BASS_ChannelGetData($handle,$buffer,$length);}
	public static function ChannelGetDevice($handle) {if(BASS::is_enabled()) return BASS::$ffi->BASS_ChannelGetDevice($handle);}
	public static function ChannelGetInfo($handle,$info) {if(BASS::is_enabled()) return BASS::$ffi->BASS_ChannelGetInfo($handle,$info);}
	public static function ChannelGetLength($handle,$mode) {if(BASS::is_enabled()) return BASS::$ffi->BASS_ChannelGetLength($handle,$mode);}
	public static function ChannelGetLevel($handle) {if(BASS::is_enabled()) return BASS::$ffi->BASS_ChannelGetLevel($handle);}
	public static function ChannelGetPosition($handle,$mode) {if(BASS::is_enabled()) return BASS::$ffi->BASS_ChannelGetPosition($handle,$mode);}
	public static function ChannelGetTags($handle,$tags) {if(BASS::is_enabled()) return BASS::$ffi->BASS_ChannelGetTags($handle,$tags);}
	public static function ChannelIsActive($handle) {if(BASS::is_enabled()) return BASS::$ffi->BASS_ChannelIsActive($handle);}
	public static function ChannelIsSliding($handle,$attrib) {if(BASS::is_enabled()) return BASS::$ffi->BASS_ChannelIsSliding($handle,$attrib);}
	public static function ChannelLock($handle,$lock) {if(BASS::is_enabled()) return BASS::$ffi->BASS_ChannelLock($handle,$lock);}
	public static function ChannelPause($handle) {if(BASS::is_enabled()) return BASS::$ffi->BASS_ChannelPause($handle);}
	public static function ChannelPlay($handle,$restart=false) {if(BASS::is_enabled()) return BASS::$ffi->BASS_ChannelPlay($handle,$restart);}
	public static function ChannelRemoveDSP($handle,$dsp) {if(BASS::is_enabled()) return BASS::$ffi->BASS_ChannelRemoveDSP($handle,$dsp);}
	public static function ChannelRemoveFX($handle,$fx) {if(BASS::is_enabled()) return BASS::$ffi->BASS_ChannelRemoveFX($handle,$fx);}
	public static function ChannelRemoveLink($handle,$chan) {if(BASS::is_enabled()) return BASS::$ffi->BASS_ChannelRemoveLink($handle,$chan);}
	public static function ChannelRemoveSync($handle,$sync) {if(BASS::is_enabled()) return BASS::$ffi->BASS_ChannelRemoveSync($handle,$sync);}
	public static function ChannelSeconds2Bytes($handle,$pos) {if(BASS::is_enabled()) return BASS::$ffi->BASS_ChannelSeconds2Bytes($handle,$pos);}
	public static function ChannelSet3DAttributes($handle,$mode,$min,$max,$iangle,$oangle,$outvol) {if(BASS::is_enabled()) return BASS::$ffi->BASS_ChannelSet3DAttributes($handle,$mode,$min,$max,$iangle,$oangle,$outvol);}
	public static function ChannelSet3DPosition($handle,$pos,$orient,$vel) {if(BASS::is_enabled()) return BASS::$ffi->BASS_ChannelSet3DPosition($handle,$pos,$orient,$vel);}
	public static function ChannelSetAttribute($handle,$attrib,$value) {if(BASS::is_enabled()) return BASS::$ffi->BASS_ChannelSetAttribute($handle,$attrib,$value);}
	public static function ChannelSetDevice($handle,$device) {if(BASS::is_enabled()) return BASS::$ffi->BASS_ChannelSetDevice($handle,$device);}

	public static function ChannelSetDSP($handle,$proc,$user,$priority) {if(BASS::is_enabled()) return BASS::$ffi->BASS_ChannelSetDSP($handle,$proc,$user,$priority);}
	public static function ChannelSetFX($handle,$type,$priority) {if(BASS::is_enabled()) return BASS::$ffi->BASS_ChannelSetFX($handle,$type,$priority);}
	public static function ChannelSetLink($handle,$chan) {if(BASS::is_enabled()) return BASS::$ffi->BASS_ChannelSetLink($handle,$chan);}
	public static function ChannelSetPosition($handle,$pos,$mode) {if(BASS::is_enabled()) return BASS::$ffi->BASS_ChannelSetPosition($handle,$pos,$mode);}
	public static function ChannelSetSync($handle,$type,$param,$proc,$user) {if(BASS::is_enabled()) return BASS::$ffi->BASS_ChannelSetSync($handle,$type,$param,$proc,$user);}
	public static function ChannelSlideAttribute($handle,$attrib,$value,$time) {if(BASS::is_enabled()) return BASS::$ffi->BASS_ChannelSlideAttribute($handle,$attrib,$value,$time);}
	public static function ChannelStop($handle) {if(BASS::is_enabled()) return BASS::$ffi->BASS_ChannelStop($handle);}
	public static function ChannelUpdate($handle,$length) {if(BASS::is_enabled()) return BASS::$ffi->BASS_ChannelUpdate($handle,$length);}

	public static function FXGetParameters($handle,$params) {if(BASS::is_enabled()) return BASS::$ffi->BASS_FXGetParameters($handle,$params);}
	public static function FXReset($handle) {if(BASS::is_enabled()) return BASS::$ffi->BASS_FXReset($handle);}
	public static function FXSetParameters($handle,$params) {if(BASS::is_enabled()) return BASS::$ffi->BASS_FXSetParameters($handle,$params);}
    /*****************************/
    /* BASS FUNCTIONS < END >    */
    /*****************************/


    /*****************************/
    /* FFI FUNCTIONS < START >   */
    /*****************************/
    public static function is_enabled(){
        return is_a(BASS::$ffi, FFI) and is_file(BASS::$bass);}
	
    public static function load($bass = 'bass.dll'){
        return BASS::reload($bass, is_a(BASS::$ffi, FFI));}
	
    public static function struct($name, $params=null){
    	if(BASS::is_enabled()){
        	$s = new FFIStruct(BASS::$ffi,$name);
        	if(is_array($params) and is_a($s, FFIStruct)){
        		foreach($params as $pname=>$pvalue)
        			$s->$pname = $pvalue;}
        	return $s;
        }
	}

    public static function reload($bass = 'bass.dll', $is_a=false){
        if(is_file($bass) and !$is_a){
            //BASS::Stop();
            //BASS::Free();
            BASS::$bass = $bass;
            BASS::$ffi = new FFI("
    struct GUID {
		DWORD data1;
		short data2;
		short data3;
		char *data4;
    };
    		
    struct BASS_DEVICEINFO {
    	char *name;
    	char *driver;
    	DWORD flags;
    };
    struct BASS_INFO {
    	DWORD flags;
    	DWORD hwsize;
    	DWORD hwfree;
    	DWORD freesam;
    	DWORD free3d;
    	DWORD minrate;
    	DWORD maxrate;
    	BYTE eax;
    	DWORD minbuf;
    	DWORD dsver;
    	DWORD latency;
    	DWORD initflags;
    	DWORD speakers;
    	DWORD freq;
    };
    struct BASS_RECORDINFO {
    	DWORD flags;
    	DWORD formats;
    	DWORD inputs;
    	BYTE singlein;
    	DWORD freq;
    };
    struct BASS_SAMPLE {
    	DWORD freq;
    	float volume;
    	float pan;
    	DWORD flags;
    	DWORD length;
    	DWORD max;
    	DWORD origres;
    	DWORD chans;
    	DWORD mingap;
    	DWORD mode3d;
    	float mindist;
    	float maxdist;
    	DWORD iangle;
    	DWORD oangle;
    	float outvol;
    	DWORD vam;
    	DWORD priority;
    };
    struct BASS_CHANNELINFO {
    	DWORD freq;
    	DWORD chans;
    	DWORD flags;
    	DWORD ctype;
    	DWORD origres;
    	DWORD plugin;
    	DWORD sample;
    	char *filename;
    };
    struct BASS_PLUGINFORM {
	    DWORD ctype;
	    char *name;
	    char *exts;
    };
    struct BASS_PLUGININFO {
    	DWORD version;
    	DWORD formatc;
    	struct BASS_PLUGINFORM *formats;
    };
    struct BASS_3DVECTOR {
	    float x;
	    float y;
    	float z;
    };

    struct TAG_APE_BINARY {
    	char *key;
    	void *data;
    	DWORD length;
    };
    struct TAG_BEXT {
    	char *Description;
    	char *Originator;
    	char *OriginatorReference;
    	char *OriginationDate;
    	char *OriginationTime;
    	uint64 TimeReference;
    	WORD Version;
    	BYTE UMID;
    	BYTE Reserved;
    	char *CodingHistory;
    };
    struct TAG_CART_TIMER {
    	DWORD dwUsage;
    	DWORD dwValue;
    };
    struct TAG_CART {
    	char *Version;
    	char *Title;
    	char *Artist;
    	char *CutID;
    	char *ClientID;
    	char *Category;
    	char *Classification;
    	char *OutCue;
    	char *StartDate;
    	char *StartTime;
    	char *EndDate;
    	char *EndTime;
    	char *ProducerAppID;
    	char *ProducerAppVersion;
    	char *UserDef;
    	DWORD dwLevelReference;
    	struct TAG_CART_TIMER *PostTimer;
    	char *Reserved;
    	char *URL;
    	char *TagText;
    };
    struct TAG_CA_CODEC {
    	DWORD ftype;
    	DWORD atype;
    	char *name;
    };
    struct TAG_ID3 {
    	char *id;
    	char *title;
    	char *artist;
    	char *album;
    	char *year;
    	char *comment;
    	BYTE genre;
    };
    
	struct BASS_DX8_CHORUS {
		float fWetDryMix;
		float fDepth;
		float fFeedback;
		float fFrequency;
		DWORD lWaveform;
		float fDelay;
		DWORD lPhase;
	};
	struct BASS_DX8_COMPRESSOR {
		float fGain;
		float fAttack;
		float fRelease;
		float fThreshold;
		float fRatio;
		float fPredelay;
	};
	struct BASS_DX8_DISTORTION {
		float fGain;
		float fEdge;
		float fPostEQCenterFrequency;
		float fPostEQBandwidth;
		float fPreLowpassCutoff;
	};
	struct BASS_DX8_ECHO {
		float fWetDryMix;
		float fFeedback;
		float fLeftDelay;
		float fRightDelay;
		BYTE lPanDelay;
	};
	struct BASS_DX8_FLANGER {
		float fWetDryMix;
		float fDepth;
		float fFeedback;
		float fFrequency;
		DWORD lWaveform;
		float fDelay;
		DWORD lPhase;
	};
	struct BASS_DX8_GARGLE {
		DWORD dwRateHz;
		DWORD dwWaveShape;
	};
	struct BASS_DX8_I3DL2REVERB {
		int lRoom;
		int lRoomHF;
		float flRoomRolloffFactor;
		float flDecayTime;
		float flDecayHFRatio;
		int lReflections;
		float flReflectionsDelay;
		int lReverb;
		float flReverbDelay;
		float flDiffusion;
		float flDensity;
		float flHFReference;
	};
	struct BASS_DX8_PARAMEQ {
		float fCenter;
		float fBandwidth;
		float fGain;
	};
	struct BASS_DX8_REVERB {
		float fInGain;
		float fReverbMix;
		float fReverbTime;
		float fHighFreqRTRatio;
	};
			
			struct DOWNLOADPROC {
				void *buffer;
				DWORD length;
				void *user;
			};
			struct FILECLOSEPROC { void *user; };
			struct FILELENPROC { void *user; };
			struct FILEREADPROC {
				void *buffer;
				DWORD length;
				void *user;
			};
			struct FILESEEKPROC {
				uint64 offset;
				void *user;
			};
			struct STREAMPROC {
				DWORD handle;
				void *buffer;
				DWORD length;
				void *user;
			};
			struct BASS_FILEPROCS {
				struct FILECLOSEPROC *close;
				struct FILELENPROC *length;
				struct FILEREADPROC *read;
				struct FILESEEKPROC *seek;
			};
			struct RECORDPROC {
				DWORD handle;
				void *buffer;
				DWORD length;
				void *user;
			};
			struct DSPPROC {
				DWORD handle;
				DWORD channel;
				void *buffer;
				DWORD length;
				void *user;
			};
			"./*struct SYNCPROC { DWORD handle; DWORD channel; DWORD data; void *user; };*/"

[lib='{$bass}']
	DWORD  BASS_GetConfig( DWORD option );
	DWORD  BASS_GetConfigPtr( DWORD option );
	BYTE   BASS_SetConfig( DWORD option, DWORD value );
	BYTE   BASS_SetConfigPtr( DWORD option, void *value );
	
	BYTE   BASS_PluginFree( DWORD handle );
	struct BASS_PLUGININFO *BASS_PluginGetInfo( DWORD handle );
	DWORD  BASS_PluginLoad( char *file, DWORD flags );
	
	int	   BASS_ErrorGetCode();
	BYTE   BASS_Free();
	float  BASS_GetCPU();
	DWORD  BASS_GetDevice();
	BYTE   BASS_GetDeviceInfo( DWORD device, struct BASS_DEVICEINFO *info );
	DWORD  BASS_GetDSoundObject( DWORD object );
	BYTE   BASS_GetInfo( struct BASS_INFO *info );
	DWORD  BASS_GetVersion();
	float  BASS_GetVolume();
	BYTE   BASS_Init( int device, DWORD freq, DWORD flags, uint64 win, struct GUID *clsid );
	BYTE   BASS_Pause();
	BYTE   BASS_SetDevice( DWORD device );
	BYTE   BASS_SetVolume( float volume );
	BYTE   BASS_Start();
	BYTE   BASS_Stop();
	BYTE   BASS_Update( DWORD length );
	
	void   BASS_Apply3D();
	BYTE   BASS_Get3DFactors( float *distf, float *rollf, float *doppf );
	BYTE   BASS_Get3DPosition( struct BASS_3DVECTOR *pos, struct BASS_3DVECTOR *vel, struct BASS_3DVECTOR *front, struct BASS_3DVECTOR *top );
	BYTE   BASS_GetEAXParameters( DWORD *env, float *vol, float *decay, float *damp );
	BYTE   BASS_Set3DFactors( float distf, float rollf, float doppf );
	BYTE   BASS_Set3DPosition( struct BASS_3DVECTOR *pos, struct BASS_3DVECTOR *vel, struct BASS_3DVECTOR *front, struct BASS_3DVECTOR *top );
	BYTE   BASS_SetEAXParameters( int env, float vol, float decay, float damp );
	
	DWORD  BASS_SampleCreate( DWORD length, DWORD freq, DWORD chans, DWORD max, DWORD flags );
	BYTE   BASS_SampleFree( DWORD handle );
	DWORD  BASS_SampleGetChannel( DWORD handle, BYTE onlynew );
	DWORD  BASS_SampleGetChannels( DWORD handle, DWORD *channels );
	BYTE   BASS_SampleGetData( DWORD handle, void *buffer );
	BYTE   BASS_SampleGetInfo( DWORD handle, struct BASS_SAMPLE *info );
	BYTE   BASS_SampleSetData( DWORD handle, void *buffer );
	BYTE   BASS_SampleSetInfo( DWORD handle, struct BASS_SAMPLE *info );
	BYTE   BASS_SampleStop( DWORD handle );
	DWORD  BASS_SampleLoad( BYTE mem, void *file, uint64 offset, DWORD length, DWORD max, DWORD flags );
	
			DWORD BASS_StreamCreate( DWORD freq, DWORD chans, DWORD flags, struct STREAMPROC *proc, void *user );
	DWORD  BASS_StreamCreateFile( BYTE mem, void *file, uint64 offset, uint64 length, DWORD flags );
			DWORD BASS_StreamCreateFileUser( DWORD system, DWORD flags, struct BASS_FILEPROCS *procs, void *user );
			DWORD BASS_StreamCreateURL( char *url, DWORD offset, DWORD flags, struct DOWNLOADPROC *proc, void *user );
	BYTE   BASS_StreamFree( DWORD handle );
	uint64 BASS_StreamGetFilePosition( DWORD handle, DWORD mode );
	DWORD  BASS_StreamPutData( DWORD handle, void *buffer, DWORD length );
	DWORD  BASS_StreamPutFileData( DWORD handle, void *buffer, DWORD length );
	
	BYTE   BASS_MusicFree( DWORD handle );
	DWORD  BASS_MusicLoad( BYTE mem, void *file, uint64 offset, DWORD length, DWORD flags, DWORD freq );
	
	BYTE   BASS_RecordFree();
	DWORD  BASS_RecordGetDevice();
	BYTE   BASS_RecordGetDeviceInfo( DWORD device, struct BASS_DEVICEINFO *info );
	BYTE   BASS_RecordGetInfo( struct BASS_RECORDINFO *info );
	DWORD  BASS_RecordGetInput( int input, float *volume );
	char  *BASS_RecordGetInputName( int input );
	BYTE   BASS_RecordInit( int device );
	BYTE   BASS_RecordSetDevice( DWORD device );
	BYTE   BASS_RecordSetInput( int input, DWORD flags, float volume );
			DWORD  BASS_RecordStart( DWORD freq, DWORD chans, DWORD flags, struct RECORDPROC *proc, void *user );
	
	double BASS_ChannelBytes2Seconds( DWORD handle, uint64 pos );
	DWORD  BASS_ChannelFlags( DWORD handle, DWORD flags, DWORD mask );
	BYTE   BASS_ChannelGet3DAttributes( DWORD handle, DWORD *mode, float *min, float *max, DWORD *iangle, DWORD *oangle, float *outvol );
	BYTE   BASS_ChannelGet3DPosition( DWORD handle, struct BASS_3DVECTOR *pos, struct BASS_3DVECTOR *orient, struct BASS_3DVECTOR *vel );
	BYTE   BASS_ChannelGetAttribute( DWORD handle, DWORD attrib, float *value );
	DWORD  BASS_ChannelGetData( DWORD handle, void *buffer, DWORD length);
	DWORD  BASS_ChannelGetDevice( DWORD handle );
	BYTE   BASS_ChannelGetInfo( DWORD handle, struct BASS_CHANNELINFO *info );
	uint64 BASS_ChannelGetLength( DWORD handle, DWORD mode );
	DWORD  BASS_ChannelGetLevel( DWORD handle );
	uint64 BASS_ChannelGetPosition( DWORD handle, DWORD mode );
	char  *BASS_ChannelGetTags( DWORD handle, DWORD tags );
	DWORD  BASS_ChannelIsActive( DWORD handle );
	BYTE   BASS_ChannelIsSliding( DWORD handle, DWORD attrib );
	BYTE   BASS_ChannelLock( DWORD handle, BYTE lock );
	BYTE   BASS_ChannelPause( DWORD handle );
	BYTE   BASS_ChannelPlay( DWORD handle, BYTE restart );
	BYTE   BASS_ChannelRemoveDSP( DWORD handle, DWORD dsp );
	BYTE   BASS_ChannelRemoveFX( DWORD handle, DWORD fx );
	BYTE   BASS_ChannelRemoveLink( DWORD handle, DWORD chan );
	BYTE   BASS_ChannelRemoveSync( DWORD handle, DWORD sync );
	uint64 BASS_ChannelSeconds2Bytes( DWORD handle, double pos );
	BYTE   BASS_ChannelSet3DAttributes( DWORD handle, int mode, float min, float max, int iangle, int oangle, float outvol );
	BYTE   BASS_ChannelSet3DPosition( DWORD handle, struct BASS_3DVECTOR *pos, struct BASS_3DVECTOR *orient, struct BASS_3DVECTOR *vel );
	BYTE   BASS_ChannelSetAttribute( DWORD handle, DWORD attrib, float value );
	BYTE   BASS_ChannelSetDevice( DWORD handle, DWORD device );
	
			DWORD  BASS_ChannelSetDSP( DWORD handle, struct DSPPROC *proc, void *user, int priority );
	DWORD  BASS_ChannelSetFX( DWORD handle, DWORD type, int priority );
	BYTE   BASS_ChannelSetLink( DWORD handle, DWORD chan );
	BYTE   BASS_ChannelSetPosition( DWORD handle, uint64 pos, DWORD mode );
			DWORD  BASS_ChannelSetSync( DWORD handle, DWORD type, uint64 param, void *proc, void *user );"./*SYNCPROC*/"
	BYTE   BASS_ChannelSlideAttribute( DWORD handle, DWORD attrib, float value, DWORD time );
	BYTE   BASS_ChannelStop( DWORD handle );
	BYTE   BASS_ChannelUpdate( DWORD handle, DWORD length );
	
    BYTE BASS_FXGetParameters( DWORD handle, void *params );
    BYTE BASS_FXReset( DWORD handle );
    BYTE BASS_FXSetParameters( DWORD handle, void *params );
            ");
        }
        return is_a(BASS::$ffi, FFI);
    }
    /*****************************/
    /* FFI FUNCTIONS < END >     */
    /*****************************/
    
}

define('BASSVERSION',     0x204);
define('BASSVERSIONTEXT', '2.4');

define('DW_ERROR', -1);
define('QW_ERROR', -1);

// Error codes returned by BASS_ErrorGetCode()
define('BASS_OK',               0);    // all is OK
define('BASS_ERROR_MEM',        1);    // memory error
define('BASS_ERROR_FILEOPEN',   2);    // can't open the file
define('BASS_ERROR_DRIVER',     3);    // can't find a free sound driver
define('BASS_ERROR_BUFLOST',    4);    // the sample buffer was lost
define('BASS_ERROR_HANDLE',     5);    // invalid handle
define('BASS_ERROR_FORMAT',     6);    // unsupported sample format
define('BASS_ERROR_POSITION',   7);    // invalid position
define('BASS_ERROR_INIT',       8);    // BASS_Init has not been successfully called
define('BASS_ERROR_START',      9);    // BASS_Start has not been successfully called
define('BASS_ERROR_ALREADY',    14);   // already initialized/paused/whatever
define('BASS_ERROR_NOCHAN',     18);   // can't get a free channel
define('BASS_ERROR_ILLTYPE',    19);   // an illegal type was specified
define('BASS_ERROR_ILLPARAM',   20);   // an illegal parameter was specified
define('BASS_ERROR_NO3D',       21);   // no 3D support
define('BASS_ERROR_NOEAX',      22);   // no EAX support
define('BASS_ERROR_DEVICE',     23);   // illegal device number
define('BASS_ERROR_NOPLAY',     24);   // not playing
define('BASS_ERROR_FREQ',       25);   // illegal sample rate
define('BASS_ERROR_NOTFILE',    27);   // the stream is not a file stream
define('BASS_ERROR_NOHW',       29);   // no hardware voices available
define('BASS_ERROR_EMPTY',      31);   // the MOD music has no sequence data
define('BASS_ERROR_NONET',      32);   // no internet connection could be opened
define('BASS_ERROR_CREATE',     33);   // couldn't create the file
define('BASS_ERROR_NOFX',       34);   // effects are not enabled
define('BASS_ERROR_NOTAVAIL',   37);   // requested data is not available
define('BASS_ERROR_DECODE',     38);   // the channel is a "decoding channel"
define('BASS_ERROR_DX',         39);   // a sufficient DirectX version is not installed
define('BASS_ERROR_TIMEOUT',    40);   // connection timedout
define('BASS_ERROR_FILEFORM',   41);   // unsupported file format
define('BASS_ERROR_SPEAKER',    42);   // unavailable speaker
define('BASS_ERROR_VERSION',    43);   // invalid BASS version (used by add-ons)
define('BASS_ERROR_CODEC',      44);   // codec is not available/supported
define('BASS_ERROR_ENDED',      45);   // the channel/file has ended
define('BASS_ERROR_BUSY',       46);   // the device is busy
define('BASS_ERROR_UNKNOWN', 	-1);   // some other mystery problem

// BASS_SetConfig options
define('BASS_CONFIG_BUFFER',            0);
define('BASS_CONFIG_UPDATEPERIOD',      1);
define('BASS_CONFIG_GVOL_SAMPLE',       4);
define('BASS_CONFIG_GVOL_STREAM',       5);
define('BASS_CONFIG_GVOL_MUSIC',        6);
define('BASS_CONFIG_CURVE_VOL',         7);
define('BASS_CONFIG_CURVE_PAN',         8);
define('BASS_CONFIG_FLOATDSP',          9);
define('BASS_CONFIG_3DALGORITHM',       10);
define('BASS_CONFIG_NET_TIMEOUT',		11);
define('BASS_CONFIG_NET_BUFFER',		12);
define('BASS_CONFIG_PAUSE_NOPLAY',		13);
define('BASS_CONFIG_NET_PREBUF',		15);
define('BASS_CONFIG_NET_PASSIVE',		18);
define('BASS_CONFIG_REC_BUFFER',		19);
define('BASS_CONFIG_NET_PLAYLIST',		21);
define('BASS_CONFIG_MUSIC_VIRTUAL',		22);
define('BASS_CONFIG_VERIFY',            23);
define('BASS_CONFIG_UPDATETHREADS',		24);
define('BASS_CONFIG_DEV_BUFFER',		27);
define('BASS_CONFIG_VISTA_TRUEPOS',		30);
define('BASS_CONFIG_IOS_MIXAUDIO',		34);
define('BASS_CONFIG_DEV_DEFAULT',		36);
define('BASS_CONFIG_NET_READTIMEOUT',   37);
define('BASS_CONFIG_VISTA_SPEAKERS',    38);
define('BASS_CONFIG_IOS_SPEAKER',		39);
define('BASS_CONFIG_HANDLES',           41);
define('BASS_CONFIG_UNICODE',           42);
define('BASS_CONFIG_SRC',               43);
define('BASS_CONFIG_SRC_SAMPLE',		44);
define('BASS_CONFIG_ASYNCFILE_BUFFER',  45);
define('BASS_CONFIG_OGG_PRESCAN',		47);

// BASS_SetConfigPtr options
define('BASS_CONFIG_NET_AGENT',         16);
define('BASS_CONFIG_NET_PROXY',         17);

// BASS_Init flags
define('BASS_DEVICE_8BITS',		1);      // 8 bit resolution, else 16 bit
define('BASS_DEVICE_MONO',		2);      // mono, else stereo
define('BASS_DEVICE_3D',		4);      // enable 3D functionality
define('BASS_DEVICE_LATENCY',	0x100);  // calculate device latency (BASS_INFO struct)
define('BASS_DEVICE_CPSPEAKERS',0x400);  // detect speakers via Windows control panel
define('BASS_DEVICE_SPEAKERS',	0x800);  // force enabling of speaker assignment
define('BASS_DEVICE_NOSPEAKER',	0x1000); // ignore speaker arrangement
define('BASS_DEVICE_DMIX',		0x2000); // use ALSA "dmix" plugin
define('BASS_DEVICE_FREQ',		0x4000); // set device sample rate

// DirectSound interfaces (for use with BASS_GetDSoundObject)
define('BASS_OBJECT_DS',		1); // IDirectSound
define('BASS_OBJECT_DS3DL',		2); // IDirectSound3DListener

// BASS_DEVICEINFO flags
define('BASS_DEVICE_ENABLED',	1);
define('BASS_DEVICE_DEFAULT',	2);
define('BASS_DEVICE_INIT',		4);

// BASS_INFO flags (from DSOUND.H)
define('DSCAPS_CONTINUOUSRATE',	0x00000010); // supports all sample rates between min/maxrate
define('DSCAPS_EMULDRIVER',		0x00000020); // device does NOT have hardware DirectSound support
define('DSCAPS_CERTIFIED',		0x00000040); // device driver has been certified by Microsoft
define('DSCAPS_SECONDARYMONO',	0x00000100); // mono
define('DSCAPS_SECONDARYSTEREO',0x00000200); // stereo
define('DSCAPS_SECONDARY8BIT',	0x00000400); // 8 bit
define('DSCAPS_SECONDARY16BIT',	0x00000800); // 16 bit

// BASS_RECORDINFO flags (from DSOUND.H)
define('DSCCAPS_EMULDRIVER', DSCAPS_EMULDRIVER);  // device does NOT have hardware DirectSound recording support
define('DSCCAPS_CERTIFIED',  DSCAPS_CERTIFIED);    // device driver has been certified by Microsoft

// defines for formats field of BASS_RECORDINFO (from MMSYSTEM.H)
define('WAVE_FORMAT_1M08',	0x00000001); // 11.025 kHz, Mono,   8-bit
define('WAVE_FORMAT_1S08',	0x00000002); // 11.025 kHz, Stereo, 8-bit
define('WAVE_FORMAT_1M16',	0x00000004); // 11.025 kHz, Mono,   16-bit
define('WAVE_FORMAT_1S16',	0x00000008); // 11.025 kHz, Stereo, 16-bit
define('WAVE_FORMAT_2M08',	0x00000010); // 22.05  kHz, Mono,   8-bit
define('WAVE_FORMAT_2S08',	0x00000020); // 22.05  kHz, Stereo, 8-bit
define('WAVE_FORMAT_2M16',	0x00000040); // 22.05  kHz, Mono,   16-bit
define('WAVE_FORMAT_2S16',	0x00000080); // 22.05  kHz, Stereo, 16-bit
define('WAVE_FORMAT_4M08',	0x00000100); // 44.1   kHz, Mono,   8-bit
define('WAVE_FORMAT_4S08',	0x00000200); // 44.1   kHz, Stereo, 8-bit
define('WAVE_FORMAT_4M16',	0x00000400); // 44.1   kHz, Mono,   16-bit
define('WAVE_FORMAT_4S16',	0x00000800); // 44.1   kHz, Stereo, 16-bit

define('BASS_SAMPLE_8BITS',	    1);   // 8 bit
define('BASS_SAMPLE_FLOAT',	    256); // 32-bit floating-point
define('BASS_SAMPLE_MONO',      2);   // mono
define('BASS_SAMPLE_LOOP',      4);   // looped
define('BASS_SAMPLE_3D',        8);   // 3D functionality
define('BASS_SAMPLE_SOFTWARE',	16);  // not using hardware mixing
define('BASS_SAMPLE_MUTEMAX',	32);  // mute at max distance (3D only)
define('BASS_SAMPLE_VAM',       64);  // DX7 voice allocation & management
define('BASS_SAMPLE_FX',        128); // old implementation of DX8 effects
define('BASS_SAMPLE_OVER_VOL',	0x10000); // override lowest volume
define('BASS_SAMPLE_OVER_POS',	0x20000); // override longest playing
define('BASS_SAMPLE_OVER_DIST',	0x30000); // override furthest from listener (3D only)

define('BASS_STREAM_PRESCAN',	0x20000); // enable pin-point seeking/length (MP3/MP2/MP1)
define('BASS_MP3_SETPOS',       BASS_STREAM_PRESCAN);
define('BASS_STREAM_AUTOFREE',	0x40000);  // automatically free the stream when it stop/ends
define('BASS_STREAM_RESTRATE',	0x80000);  // restrict the download rate of internet file streams
define('BASS_STREAM_BLOCK',     0x100000); // download/play internet file stream in small blocks
define('BASS_STREAM_DECODE',	0x200000); // don't play the stream, only decode (BASS_ChannelGetData)
define('BASS_STREAM_STATUS',	0x800000); // give server status info (HTTP/ICY tags) in DOWNLOADPROC

define('BASS_MUSIC_FLOAT',      BASS_SAMPLE_FLOAT);
define('BASS_MUSIC_MONO',       BASS_SAMPLE_MONO);
define('BASS_MUSIC_LOOP',       BASS_SAMPLE_LOOP);
define('BASS_MUSIC_3D',         BASS_SAMPLE_3D);
define('BASS_MUSIC_FX',         BASS_SAMPLE_FX);
define('BASS_MUSIC_AUTOFREE',	BASS_STREAM_AUTOFREE);
define('BASS_MUSIC_DECODE',	    BASS_STREAM_DECODE);
define('BASS_MUSIC_PRESCAN',	BASS_STREAM_PRESCAN); // calculate playback length
define('BASS_MUSIC_CALCLEN',	BASS_MUSIC_PRESCAN);
define('BASS_MUSIC_RAMP',       0x200);    // normal ramping
define('BASS_MUSIC_RAMPS',      0x400);    // sensitive ramping
define('BASS_MUSIC_SURROUND',	0x800);    // surround sound
define('BASS_MUSIC_SURROUND2',	0x1000);   // surround sound (mode 2)
define('BASS_MUSIC_FT2MOD',     0x2000);   // play .MOD as FastTracker 2 does
define('BASS_MUSIC_PT1MOD',     0x4000);   // play .MOD as ProTracker 1 does
define('BASS_MUSIC_NONINTER',	0x10000);  // non-interpolated sample mixing
define('BASS_MUSIC_SINCINTER',	0x800000); // sinc interpolated sample mixing
define('BASS_MUSIC_POSRESET',	0x8000);   // stop all notes when moving position
define('BASS_MUSIC_POSRESETEX',	0x400000); // stop all notes and reset bmp/etc when moving position
define('BASS_MUSIC_STOPBACK',	0x80000);  // stop the music on a backwards jump effect
define('BASS_MUSIC_NOSAMPLE',	0x100000); // don't load the samples

// Speaker assignment flags
define('BASS_SPEAKER_FRONT',	0x1000000);  // front speakers
define('BASS_SPEAKER_REAR',	    0x2000000);  // rear/side speakers
define('BASS_SPEAKER_CENLFE',	0x3000000);  // center & LFE speakers (5.1)
define('BASS_SPEAKER_REAR2',	0x4000000);  // rear center speakers (7.1)
define('BASS_SPEAKER_LEFT',	    0x10000000); // modifier: left
define('BASS_SPEAKER_RIGHT',	0x20000000); // modifier: right
define('BASS_SPEAKER_FRONTLEFT',	BASS_SPEAKER_FRONT  | BASS_SPEAKER_LEFT);
define('BASS_SPEAKER_FRONTRIGHT',	BASS_SPEAKER_FRONT  | BASS_SPEAKER_RIGHT);
define('BASS_SPEAKER_REARLEFT',		BASS_SPEAKER_REAR   | BASS_SPEAKER_LEFT);
define('BASS_SPEAKER_REARRIGHT',	BASS_SPEAKER_REAR   | BASS_SPEAKER_RIGHT);
define('BASS_SPEAKER_CENTER',		BASS_SPEAKER_CENLFE | BASS_SPEAKER_LEFT);
define('BASS_SPEAKER_LFE',		    BASS_SPEAKER_CENLFE | BASS_SPEAKER_RIGHT);
define('BASS_SPEAKER_REAR2LEFT',	BASS_SPEAKER_REAR2  | BASS_SPEAKER_LEFT);
define('BASS_SPEAKER_REAR2RIGHT',	BASS_SPEAKER_REAR2  | BASS_SPEAKER_RIGHT);

define('BASS_ASYNCFILE',	0x40000000);
define('BASS_UNICODE',      0x80000000);

define('BASS_RECORD_PAUSE', 0x8000); // start recording paused

// DX7 voice allocation & management flags
define('BASS_VAM_HARDWARE',     1);
define('BASS_VAM_SOFTWARE',     2);
define('BASS_VAM_TERM_TIME',	4);
define('BASS_VAM_TERM_DIST',	8);
define('BASS_VAM_TERM_PRIO',	16);

// BASS_CHANNELINFO types
define('BASS_CTYPE_SAMPLE',             1);
define('BASS_CTYPE_RECORD',             2);
define('BASS_CTYPE_STREAM',             0x10000);
define('BASS_CTYPE_STREAM_OGG',         0x10002);
define('BASS_CTYPE_STREAM_MP1',         0x10003);
define('BASS_CTYPE_STREAM_MP2',         0x10004);
define('BASS_CTYPE_STREAM_MP3',         0x10005);
define('BASS_CTYPE_STREAM_AIFF',        0x10006);
define('BASS_CTYPE_STREAM_WAV',         0x40000); // WAVE flag, LOWORD=codec
define('BASS_CTYPE_STREAM_WAV_PCM',     0x50001);
define('BASS_CTYPE_STREAM_WAV_FLOAT',	0x50003);
define('BASS_CTYPE_MUSIC_MOD',          0x20000);
define('BASS_CTYPE_MUSIC_MTM',          0x20001);
define('BASS_CTYPE_MUSIC_S3M',          0x20002);
define('BASS_CTYPE_MUSIC_XM',           0x20003);
define('BASS_CTYPE_MUSIC_IT',           0x20004);
define('BASS_CTYPE_MUSIC_MO3',          0x00100); // MO3 flag

// 3D channel modes
define('BASS_3DMODE_NORMAL',	0); // normal 3D processing
define('BASS_3DMODE_RELATIVE',	1); // position is relative to the listener
define('BASS_3DMODE_OFF',       2); // no 3D processing

// software 3D mixing algorithms (used with BASS_CONFIG_3DALGORITHM)
define('BASS_3DALG_DEFAULT',	0);
define('BASS_3DALG_OFF',        1);
define('BASS_3DALG_FULL',       2);
define('BASS_3DALG_LIGHT',      3);

// EAX environments, use with BASS_SetEAXParameters
define('EAX_ENVIRONMENT_GENERIC',           0);
define('EAX_ENVIRONMENT_PADDEDCELL',        1);
define('EAX_ENVIRONMENT_ROOM',              2);
define('EAX_ENVIRONMENT_BATHROOM',          3);
define('EAX_ENVIRONMENT_LIVINGROOM',        4);
define('EAX_ENVIRONMENT_STONEROOM',         5);
define('EAX_ENVIRONMENT_AUDITORIUM',        6);
define('EAX_ENVIRONMENT_CONCERTHALL',       7);
define('EAX_ENVIRONMENT_CAVE',              8);
define('EAX_ENVIRONMENT_ARENA',             9);
define('EAX_ENVIRONMENT_HANGAR',            10);
define('EAX_ENVIRONMENT_CARPETEDHALLWAY',   11);
define('EAX_ENVIRONMENT_HALLWAY',           12);
define('EAX_ENVIRONMENT_STONECORRIDOR',	    13);
define('EAX_ENVIRONMENT_ALLEY',             14);
define('EAX_ENVIRONMENT_FOREST',            15);
define('EAX_ENVIRONMENT_CITY',              16);
define('EAX_ENVIRONMENT_MOUNTAINS',         17);
define('EAX_ENVIRONMENT_QUARRY',            18);
define('EAX_ENVIRONMENT_PLAIN',             19);
define('EAX_ENVIRONMENT_PARKINGLOT',        20);
define('EAX_ENVIRONMENT_SEWERPIPE',         21);
define('EAX_ENVIRONMENT_UNDERWATER',        22);
define('EAX_ENVIRONMENT_DRUGGED',           23);
define('EAX_ENVIRONMENT_DIZZY',             24);
define('EAX_ENVIRONMENT_PSYCHOTIC',         25);
// total number of environments
define('EAX_ENVIRONMENT_COUNT',             26);

define('BASS_STREAMPROC_END', 0x80000000); // end of user stream flag

// BASS_StreamCreateFileUser file systems
define('STREAMFILE_NOBUFFER',	0);
define('STREAMFILE_BUFFER',	1);
define('STREAMFILE_BUFFERPUSH',	2);

// BASS_StreamPutFileData options
define('BASS_FILEDATA_END',	0); // end & close the file

// BASS_StreamGetFilePosition modes
define('BASS_FILEPOS_CURRENT',	0);
define('BASS_FILEPOS_DECODE',	BASS_FILEPOS_CURRENT);
define('BASS_FILEPOS_DOWNLOAD',	1);
define('BASS_FILEPOS_END',	2);
define('BASS_FILEPOS_START',	3);
define('BASS_FILEPOS_CONNECTED',	4);
define('BASS_FILEPOS_BUFFER',	5);

// BASS_ChannelSetSync types
define('BASS_SYNC_POS',	0);
define('BASS_SYNC_END',	2);
define('BASS_SYNC_META',	4);
define('BASS_SYNC_SLIDE',	5);
define('BASS_SYNC_STALL',	6);
define('BASS_SYNC_DOWNLOAD',	7);
define('BASS_SYNC_FREE',	8);
define('BASS_SYNC_SETPOS',	11);
define('BASS_SYNC_MUSICPOS',	10);
define('BASS_SYNC_MUSICINST',	1);
define('BASS_SYNC_MUSICFX',	3);
define('BASS_SYNC_OGG_CHANGE',	12);
define('BASS_SYNC_MIXTIME',	0x40000000); // FLAG: sync at mixtime, else at playtime
define('BASS_SYNC_ONETIME',	0x80000000); // FLAG: sync only once, else continuously

// BASS_ChannelIsActive return values
define('BASS_ACTIVE_STOPPED',	0);
define('BASS_ACTIVE_PLAYING',	1);
define('BASS_ACTIVE_STALLED',	2);
define('BASS_ACTIVE_PAUSED',	3);

// Channel attributes
define('BASS_ATTRIB_FREQ',      1);
define('BASS_ATTRIB_VOL',       2);
define('BASS_ATTRIB_PAN',       3);
define('BASS_ATTRIB_EAXMIX',	4);
define('BASS_ATTRIB_NOBUFFER',	5);
define('BASS_ATTRIB_CPU',       7);
define('BASS_ATTRIB_SRC',       8);
define('BASS_ATTRIB_MUSIC_AMPLIFY',     0x100);
define('BASS_ATTRIB_MUSIC_PANSEP',      0x101);
define('BASS_ATTRIB_MUSIC_PSCALER',     0x102);
define('BASS_ATTRIB_MUSIC_BPM',         0x103);
define('BASS_ATTRIB_MUSIC_SPEED',       0x104);
define('BASS_ATTRIB_MUSIC_VOL_GLOBAL',  0x105);
define('BASS_ATTRIB_MUSIC_VOL_CHAN',    0x200); // + channel #
define('BASS_ATTRIB_MUSIC_VOL_INST',    0x300); // + instrument #

// BASS_ChannelGetData flags
define('BASS_DATA_AVAILABLE',       0);        // query how much data is buffered
define('BASS_DATA_FLOAT',           0x40000000); // flag: return floating-point sample data
define('BASS_DATA_FFT256',          0x80000000); // 256 sample FFT
define('BASS_DATA_FFT512',          0x80000001); // 512 FFT
define('BASS_DATA_FFT1024',         0x80000002); // 1024 FFT
define('BASS_DATA_FFT2048',         0x80000003); // 2048 FFT
define('BASS_DATA_FFT4096',         0x80000004); // 4096 FFT
define('BASS_DATA_FFT8192',         0x80000005); // 8192 FFT
define('BASS_DATA_FFT16384',        0x80000006); // 16384 FFT
define('BASS_DATA_FFT_INDIVIDUAL',  0x10); // FFT flag: FFT for each channel, else all combined
define('BASS_DATA_FFT_NOWINDOW',    0x20);   // FFT flag: no Hanning window
define('BASS_DATA_FFT_REMOVEDC',    0x40);   // FFT flag: pre-remove DC bias
define('BASS_DATA_FFT_COMPLEX',     0x80);    // FFT flag: return complex data

// BASS_ChannelGetTags types : what's returned
define('BASS_TAG_ID3',              0); // ID3v1 tags : TAG_ID3 structure
define('BASS_TAG_ID3V2',            1); // ID3v2 tags : variable length block
define('BASS_TAG_OGG',              2); // OGG comments : series of null-terminated UTF-8 strings
define('BASS_TAG_HTTP',             3); // HTTP headers : series of null-terminated ANSI strings
define('BASS_TAG_ICY',              4); // ICY headers : series of null-terminated ANSI strings
define('BASS_TAG_META',             5); // ICY metadata : ANSI string
define('BASS_TAG_APE',              6); // APEv2 tags : series of null-terminated UTF-8 strings
define('BASS_TAG_MP4',              7); // MP4/iTunes metadata : series of null-terminated UTF-8 strings
define('BASS_TAG_VENDOR',           9); // OGG encoder : UTF-8 string
define('BASS_TAG_LYRICS3',          10); // Lyric3v2 tag : ASCII string
define('BASS_TAG_CA_CODEC',         11);	// CoreAudio codec info : TAG_CA_CODEC structure
define('BASS_TAG_MF',               13);	// Media Foundation tags : series of null-terminated UTF-8 strings
define('BASS_TAG_WAVEFORMAT',       14);	// WAVE format : WAVEFORMATEEX structure
define('BASS_TAG_RIFF_INFO',        0x100); // RIFF "INFO" tags : series of null-terminated ANSI strings
define('BASS_TAG_RIFF_BEXT',        0x101); // RIFF/BWF "bext" tags : TAG_BEXT structure
define('BASS_TAG_RIFF_CART',        0x102); // RIFF/BWF "cart" tags : TAG_CART structure
define('BASS_TAG_RIFF_DISP',        0x103); // RIFF "DISP" text tag : ANSI string
define('BASS_TAG_APE_BINARY',       0x1000); // + index #, binary APEv2 tag : TAG_APE_BINARY structure
define('BASS_TAG_MUSIC_NAME',       0x10000);	// MOD music name : ANSI string
define('BASS_TAG_MUSIC_MESSAGE',    0x10001); // MOD message : ANSI string
define('BASS_TAG_MUSIC_ORDERS',     0x10002); // MOD order list : BYTE array of pattern numbers
define('BASS_TAG_MUSIC_INST',       0x10100);	// + instrument #, MOD instrument name : ANSI string
define('BASS_TAG_MUSIC_SAMPLE',     0x10300); // + sample #, MOD sample name : ANSI string

// BASS_ChannelGetLength/GetPosition/SetPosition modes
define('BASS_POS_BYTE',         0); // byte position
define('BASS_POS_MUSIC_ORDER',	1); // order.row position, MAKELONG(order,row)
define('BASS_POS_OGG',          3); // OGG bitstream number
define('BASS_POS_DECODE',       0x10000000); // flag: get the decoding (not playing) position
define('BASS_POS_DECODETO',     0x20000000); // flag: decode to the position instead of seeking

// BASS_RecordSetInput flags
define('BASS_INPUT_OFF',	0x10000);
define('BASS_INPUT_ON',     0x20000);

define('BASS_INPUT_TYPE_MASK',      0xFF000000);
define('BASS_INPUT_TYPE_UNDEF',     0x00000000);
define('BASS_INPUT_TYPE_DIGITAL',	0x01000000);
define('BASS_INPUT_TYPE_LINE',      0x02000000);
define('BASS_INPUT_TYPE_MIC',       0x03000000);
define('BASS_INPUT_TYPE_SYNTH',     0x04000000);
define('BASS_INPUT_TYPE_CD',        0x05000000);
define('BASS_INPUT_TYPE_PHONE',     0x06000000);
define('BASS_INPUT_TYPE_SPEAKER',	0x07000000);
define('BASS_INPUT_TYPE_WAVE',      0x08000000);
define('BASS_INPUT_TYPE_AUX',       0x09000000);
define('BASS_INPUT_TYPE_ANALOG',	0x0A000000);

define('BASS_FX_DX8_CHORUS',        0);
define('BASS_FX_DX8_COMPRESSOR',    1);
define('BASS_FX_DX8_DISTORTION',    2);
define('BASS_FX_DX8_ECHO',          3);
define('BASS_FX_DX8_FLANGER',       4);
define('BASS_FX_DX8_GARGLE',        5);
define('BASS_FX_DX8_I3DL2REVERB',	6);
define('BASS_FX_DX8_PARAMEQ',       7);
define('BASS_FX_DX8_REVERB',        8);

define('BASS_DX8_PHASE_NEG_180',	0);
define('BASS_DX8_PHASE_NEG_90',     1);
define('BASS_DX8_PHASE_ZERO',       2);
define('BASS_DX8_PHASE_90',         3);
define('BASS_DX8_PHASE_180',        4);