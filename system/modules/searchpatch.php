<?
function StrPosH($haystack, $needle) {
    $haystack = strpos($haystack, $needle);
    return ($haystack !== false) ? $haystack : 0;
}

function SearchPosAB($Text, $A, $B) {
    $Pos[0][0] = StrPosH($Text, $A);
    $Pos[0][1] = strlen($A);
    $Pos[1][0] = StrPosH($Text, $B) - $Pos[0][0];
    $Pos[1][1] = strlen($B);
    return $Pos;
}

function SubStrPosAB($Text, $A, $B) {
    $PosAB = SearchPosAB($Text, $A, $B);
    return substr($Text, $PosAB[0][0], $PosAB[1][0] + $PosAB[1][1]);
}

function ReplaceStrPosAB($Text, $A, $B, $replacement) {
    $PosAB = SearchPosAB($Text, $A, $B);
    return  substr_replace($Text, $replacement, $PosAB[0][0], $PosAB[1][0] + $PosAB[1][1]);
} 



function ArraySearch($Array, $findA, $findB){


foreach($Array as $v) {
    $v = trim($v);
    if((($i = strpos($v, $findA)) !== false) and (($r = strpos($v, $findB)) !== false)) {
        $len = strlen($findA);
        $List[] = trim(substr($v, $i + $len, (($r - $i) - $len)));
    }
}
return $List;

}

function fact($n){
if( is_numeric($n)){
for($f=1 and $r=1;$r<=$n;$r++){
$f*=$r;
}

return $f;
}else{
trigger_error('ERROR Variable must be an number, not instance of something other!', E_USER_ERROR);
}
} 

?>