<?
function curl_close( reource $ch ){}
function curl_copy_handle( reource $ch ){}
function curl_errno( reource $ch ){}
function curl_error( reource $ch ){}
function curl_exec( resource $ch ){}
function curl_getinfo( resource $ch [, int $opt ] ){}
function curl_init([ string $url = NULL ] ){}
function curl_multi_add_handle( resource $mh , resource $ch ){}
function curl_multi_close( resource $mh ){}
function curl_multi_exec( resource $mh, int &$still_running ){}
function curl_multi_getcontent( resource $ch ){}
function curl_multi_info_read( resource $mh [, int &$msgs_in_queue = NULL ] ){}
function curl_multi_init(){}
function curl_multi_remove_handle( resource $mh , resource $ch ){}
function curl_multi_select( resource $mh [, float $timeout = 1.0 ] ){}
function curl_setopt( resource $ch , int $option , mixed $value ){}
function curl_setopt_array ( resource $ch , array $options ){}
function curl_version([ int $age = CURLVERSION_NOW ] ){}