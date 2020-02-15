<?php
global $unit;

$Checks = 
[
"SetText"	=> ["Is it Unicode?🐆🐆🐆🐆🐆",
				result(
						function($t)
						{
							return clipboard_GetText() == "Is it Unicode?🐆🐆🐆🐆🐆";
						}
										)]
];
foreach
(
	[
		"SetText"
	] 
		//=> 
			 as $func
)
	if(!of("clipboard_{$func}")->Check())
	{
		Fail( asCaption("Embed~Clipboard") .  PHP_EOL . "Function clipboard_{$func} is missing!" );
	} elseif( isSet($Checks[$func]) )
		if(!of("clipboard_{$func}")->Call(...$Checks[$func]))
			Fail( asCaption("Embed~Clipboard") . PHP_EOL . "FUNCTION clipboard_{$func} HAS RETURNED WRONG RESULT!" );

if( $unit->errors == 0 )
{
	Out("Embed~Clipboard => OK");
} else {
	Out("Embed~Clipboard => WRONG");
}