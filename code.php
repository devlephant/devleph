//========================================================

function passIt($name, &$title)
{
pre($name);
$title = 'newTitle: ' . $name;
}

function TestArgs(&...$args)
{
passIt(...$args);
}
$t = 'Title';
$title = 'ter';
TestArgs($title,$t);

pre($t);