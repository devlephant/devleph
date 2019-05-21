$win32_idl = <<<EOD
[lib='kernel32.dll'] DWORD GetTickCount();
[lib='user32.dll'] int MessageBoxA(int handle, char *text, char *caption, int type);
EOD;

//Then bind those into an ffi context:

$ffi = new ffi($win32_idl);

//And then use it:

$count = $ffi->GetTickCount();
echo $ffi->MessageBoxA(0, "The tick count is " . $count, "Ticky Ticky", 1);