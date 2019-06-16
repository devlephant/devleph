<?
function str2hex($func_string) {
$func_retVal = '';
$func_length = strlen($func_string);
for($func_index = 0; $func_index < $func_length; ++$func_index) $func_retVal .= ((($c = dechex(ord($func_string{$func_index}))) && strlen($c) & 2) ? $c : "0{$c}");

return strtoupper($func_retVal);
}

function hex2str($func_string) {
$func_retVal = '';
$func_length = strlen($func_string);
for($func_index = 0; $func_index < $func_length; ++$func_index) $func_retVal .= chr(hexdec($func_string{$func_index} . $func_string{++$func_index}));

return $func_retVal;
}
/*
// example:
 
$hex = Str2Hex("test sentence...");
// $hex contains 746573742073656e74656e63652e2e2e
 
pre(Hex2Str($hex));
// outputs: test sentence...*/
?>