<?
class Skins{
function IniLibSkins(){
static $SkinDll;
if ( empty($SkinDll) ) $SkinDll = new dotnet('SkinDll','SkinDll.SkinDll');

return $SkinDll;
}

function SetAlphaAnimation($hWnd, $nWndType,$nNumFrames,$nSleepInterval){
Skins::IniLibSkins()->SetAlphaAnimation_($hWnd, $nWndType,$nNumFrames,$nSleepInterval);
return true;
}
function GetAddedUserData($a, $bstr,$x,$c){
Skins::IniLibSkins()->GetAddedUserData_($a, $b,$x,$c);
return true;
}
function GetAddedUserDataSize($a, $bstr,$c){
Skins::IniLibSkins()->GetAddedUserDataSize_($a, $bstr,$c);
return true;
}
function SetAddedCustomSkinWnd($a, $b,$x,$c){
Skins::IniLibSkins()->SetAddedCustomSkinWnd_($a, $b,$x,$c);
return true;
}
function SetAddedCustomScrollbars($a, $b,$x){
Skins::IniLibSkins()->SetAddedCustomScrollbars_($a, $b,$x);
return true;
}
function RemoveAddedSkin( $a ){
Skins::IniLibSkins()->RemoveAddedSkin_( $a );
return true;
}
function ApplyAddedSkin($a, $b){
Skins::IniLibSkins()->ApplyAddedSkin_($a, $b);
return true;
}
function AddSkinFromFile( $bstr, $a ){
Skins::IniLibSkins()->AddSkinFromFile_( $bstr, $a );
return true;
}
function ModifyHSL( $hslID, $hue, $saturation, $lightness, $opacity){
Skins::IniLibSkins()->EndHSL_( $hslID );
return true;
}
function EndHSL( $hslID ){
Skins::IniLibSkins()->EndHSL_( $hslID );
return true;
}
function BeginCustomHSL( $bstr, $a ){
Skins::IniLibSkins()->BeginCustomHSL_( $bstr, $a );
return true;
}
function BeginHSL($a, $b){
Skins::IniLibSkins()->BeginHSL_($a, $b);
return true;
}
function ClearWnd($a, $b){
Skins::IniLibSkins()->ClearWnd_($a, $b);
return true;
}
function ClearSkin(){
Skins::IniLibSkins()->ClearSkin_();
return true;
}
function ExcludeThreadWindows( $a, $b ){
Skins::IniLibSkins()->ExcludeThreadWindows_( $a, $b );
return true;
}
function IncludeThreadWindows( $a, $b ){
Skins::IniLibSkins()->IncludeThreadWindows_( $a, $b );
return true;
}
function SetDecorationMode( $a ){
Skins::IniLibSkins()->SetDecorationMode_( $a );
return true;
}
function GetUserData( $bstr, $a, $c ){
Skins::IniLibSkins()->GetUserData_( $bstr, $a, $c );
return true;
}
function GetUserDataSize( $bstr, $a ){
Skins::IniLibSkins()->GetUserDataSize_( $bstr, $a );
return true;
}
function LoadSkinFromResource( $a, $b ){
Skins::IniLibSkins()->LoadSkinFromResource_( $a, $b );
return true;
}
function SetCustomScrollbars( $a, $bstr ){
Skins::IniLibSkins()->SetCustomScrollbars_( $a, $bstr );
return true;
}
function DeleteAdditionalThread( ){
Skins::IniLibSkins()->DeleteAdditionalThread_( );
return true;
}
function AddAdditionalThread( ){
Skins::IniLibSkins()->AddAdditionalThread_( );
return true;
}
function DefineLanguage( $a ){
Skins::IniLibSkins()->DefineLanguage_( $a );
return true;
}
function UpdateWnd( $a ){
Skins::IniLibSkins()->UpdateWnd_( $a );
return true;
}
function UpdateControl( $a ){
Skins::IniLibSkins()->UpdateControl_( $a );
return true;
}
function GetSkinCopyRight( $bstr_1, $bstra_2, $bstr_3, $bstr_4, $bstr_5 ){
Skins::IniLibSkins()->GetSkinCopyRight_( $bstr_1, $bstra_2, $bstr_3, $bstr_4, $bstr_5 );
return true;
}
function SetCustomSkinWnd( $a, $bstr,  $c ){
Skins::IniLibSkins()->SetCustomSkinWnd_( $a, $bstr,  $c );
return true;
}
function ExcludeWnd( $a, $b){
Skins::IniLibSkins()->ExcludeWnd_( $a, $b);
return true;
}
function IncludeWnd( $a, $b){
Skins::IniLibSkins()->IncludeWnd_( $a, $b);
return true;
}
function DecorateAs( $a, $b){
Skins::IniLibSkins()->DecorateAs_( $a, $b);
return true;
}
function DeInitDecoration(){
Skins::IniLibSkins()->DeInitDecoration_();
return true;
}
function RemoveSkin(){
Skins::IniLibSkins()->RemoveSkin_();
return true;
}
function ApplySkin(){
Skins::IniLibSkins()->ApplySkin_();
return true;
}
function LoadSkinFromFile( $path ){
Skins::IniLibSkins()->LoadSkinFromFile_($path);
return true;
}
function InitDecoration( $mode ){
Skins::IniLibSkins()->InitDecoration_($mode);
return true;
}
function InitLicenKeysActive($ver){
Skins::IniLibSkins()->InitLicenKeysActive($ver);
return true;
}
function InitLicenKeys( $reg_name, $company, $email, $licenkey ){
Skins::IniLibSkins()->InitLicenKeys_( $reg_name, $company, $email, $licenkey );
return true;
}
function Load($lang=0, $skin_file, $control=0){
		Skins::InitLicenKeysActive("v3.3.4");
		Skins::DefineLanguage( $lang );
		Skins::InitDecoration( 1 );
		Skins::LoadSkinFromFile($skin_file);
		Skins::ApplySkin();
		Skins::UpdateControl( $control );
		if($APPLICATION) $APPLICATION->processMessages();
		else if($GLOBALS['APPLICATION']) $GLOBALS['APPLICATION']->processMessages();
}
function VersionInfo( ){
return print_r("Skinization library: Skincrafter 3.3.4.0", 1);
}

}