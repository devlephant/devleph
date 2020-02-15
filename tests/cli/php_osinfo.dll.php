<?php
global $unit;
if( !Loaded() )
	Fault( 	
			asCaption("PHP_OSINFO") .  PHP_EOL .
			"Unable load php_osinfo" . PHP_EOL .
			"Reason: extension " . ["not found", "contains error"][(int)$unit->Self->Available]
		);
$Checks = 
[
"DiskTotal"	=>["c", result(">", 100)		],
"DiskSerial"=>["c", result("!=", "00000000")],
"DotNet"	=>[		result(
					function($ver)
					{
						return substr_count($ver, ".") > 1 AND substr($ver,0,1) !== "0";
					}
											)]
];
foreach
(
	[
		"DotNet", "IsNt", "WinVer", "DOSVer", "Locale",
		"Memory", "IsAdmin", "DiskSerial", "DiskTotal", 
		"DiskFree", "MacAddress", "get", "DisplayDevice",
		"DriveType", "ComputerName", "UserName", "SysLang"
	] 
		//=> 
			 as $func
)
	if(!of("osinfo_{$func}")->Check())
	{
		Fail( asCaption("PHP_OSINFO") .  PHP_EOL . "Function osinfo_{$func} is missing!" );
	} elseif( isSet($Checks[$func]) )
		if(!of("osinfo_{$func}")->Call(...$Checks[$func]))
	{
		if(ArrayContains(Check("sub", "Arg"), $Checks[$func]))
			Fail( asCaption("PHP_OSINFO") . PHP_EOL . "FUNCTION osinfo_{$func} HAS WRITTEN UNCORRECT OUTPUT TO ARGUMENT!" );
		else 
			Fail( asCaption("PHP_OSINFO") . PHP_EOL . "FUNCTION osinfo_{$func} HAS RETURNED WRONG RESULT!" );
	}

if( $unit->errors == 0 )
{
	Out("PHP_OSINFO => OK");
} else {
	Out("PHP_OSINFO => WRONG");
}