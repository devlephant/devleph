<?

function array_insert(&$array, $index, $value)
{
	$array = array_merge(array_slice($array,0,$index), [$value], array_slice($array,$index));
}

function array_add(&$array, $value)
{
	$array[] = $value;
}

function array_sub(&$array, $value, $strict=false)
{
	while(array_search($value,$array,$strict)!==false)
	unset($array[ array_search($value,$array,$strict) ]);
}

//----------------------------TYPES----------------------------//

function starr(...$pieces)
{
	return new StaticArray($pieces);
}