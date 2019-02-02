<?
global $dio,$new_Panel,$sampleMovie;

function SetParent_form($mdMemberRef,$mdToken){
$ffi = new ffi("[lib='user32.dll'] int SetParent( int mdMemberRef, int mdToken );");
return $ffi->SetParent($mdMemberRef,$mdToken);
}
function Movie_Load($form,$file_video,$bool_,$Width=500,$Height=400,$Left=0,$Top=0,$caption=''){
global $dio,$new_Panel,$sampleMovie;
$dio = new DOTNET('video','video.myclass');
$new_Panel=$dio->New_Panel();
$new_Panel->Left=$Left;
$new_Panel->Top=$Top;
$new_Panel->Width=$Width;
$new_Panel->Height=$Height;
SetParent_form($new_Panel->Handle, $form );
$sampleMovie=$dio->xMovie_Load($new_Panel->Handle,$file_video,$caption,$bool_);
$dio->xMovie_SetSize($sampleMovie,$new_Panel->Width,$new_Panel->Height);
return $sampleMovie;
}

function Movie_Close($handle){ global $dio; return $dio->xMovie_Close($handle); }
function Movie_Play($handle){ global $dio; return $dio->xMovie_Play($handle); }
function Movie_Stop($handle){ global $dio; return $dio->xMovie_Stop($handle); }
function Movie_Pause($handle){ global $dio; return $dio->xMovie_Pause($handle); }
function Movie_Resume($handle){ global $dio; return $dio->xMovie_Resume($handle); }
function Movie_GetSeek($handle){ global $dio; return $dio->xMovie_GetSeek($handle); }
function Movie_Seek($handle,$seekPosition){ global $dio; return $dio->xMovie_Seek($handle,$seekPosition); }
function Movie_GetVolume($handle){ global $dio; return $dio->xMovie_GetVolume($handle); }
function Movie_SetVolume($handle,$volume){ global $dio; return $dio->xMovie_SetVolume($handle,$volume); }
function Movie_GetLength($handle){ global $dio; return $dio->xMovie_GetLength($handle); }
function Movie_GetZoom($handle){ global $dio; return $dio->xMovie_GetZoom($handle); }
function Movie_SetZoom($handle,$zoom){ global $dio; return $dio->xMovie_SetZoom($handle,$zoom); }
function Movie_GetSize($handle,$side){ global $dio; return $dio->xMovie_GetSize($handle,$side); }
function Movie_SetSize($handle,$w,$h){ global $dio; return $dio->xMovie_SetSize($handle,$w,$h); }
function Movie_GetPosition($handle,$coordinate){ global $dio; return $dio->xMovie_GetPosition($handle,$coordinate); }
function Movie_SetPostion($handle,$x,$y){ global $dio; return $dio->xMovie_SetPostion($handle,$x,$y); }
function Movie_GetRepeat($handle){ global $dio; return $dio->xMovie_GetRepeat($handle); }
function Movie_SetRepeat($handle,$repeat){ global $dio; return $dio->xSetRepeat($handle,$repeat); }





