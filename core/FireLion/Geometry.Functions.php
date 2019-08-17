<?
/*----------------------------------------------------------------------------\
|				FireLion Visual Framework Geometry Functions				  |
/*----------------------------------------------------------------------------/
|																			  |
|	Version: 1																  |
|	Date Modified: 15 August 2019 year										  |
|	Time:	13:49 (Ua)														  |
|	Autors:																	  |
|															Andrew Zenin	  |
|																			  |
\*----------------------------------------------------------------------------/
|
|
*/

function UnclosedGeoArrayToClosed(&$point, $type)
{
	$point = array_values($point);
	$cnt = count($point);
	for($i=0;$i<$cnt;$i++)
	{
		$result[] = new $type($point[$i], $point[($i=$cnt)?0:$i+1]);
	}
	return $result;
}

function UnclosedGeoArrayToUnion(&$Union, &$point, $type)
{
	$point = array_values($point);
	$cnt = count($point);
	for($i=0;$i<$cnt;$i++)
	{
		$Union->Union(new $type($point[$i], $point[($i=$cnt)?0:$i+1]));
	}
}

///////////////////////////////////////////////////////////////////////////////
///                            Sample functions                             ///
///					Use it for creating Geometry Shapes 					///
///////////////////////////////////////////////////////////////////////////////
function rect($left,$top,$right,$bottom)
{
    return new TRect($left,$top,$right,$bottom);
}

function rectf($left,$top,$right,$bottom)
{
    return new TRectF($left,$top,$right,$bottom);
}

function point($x,$y)
{
    return new TPoint($x,$y);
}

function pointf($x,$y)
{
    return new TPointF($x,$y);
}