<?php
UnitName
(	"php_osinfo.dll"	);

if( Loaded() )
{
	pre( cmp(0, "<=>", 1) );
	of( "osinfo_diskserial" )->Check();
	Call( "osinfo_disktotal", "c", result(">", 100) );
	$a = 0;
	$b = 2;
	$c = 5;
	Call ( "testset", $a, $b, $c, arg(), arg() );
	pre( $a + $b + $c );
}