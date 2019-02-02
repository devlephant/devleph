<?
function apc_add ( string $key , mixed $var [, int $ttl = 0 ] ){}
function apc_fetch ( mixed $key [, bool &$success ] ){}
function apc_cas ( string $key , int $old , int $new ){}
function apc_exists ( mixed $keys ){}
function apc_delete ( string $key ){}
function apc_store ( string $key , mixed $var [, int $ttl = 0 ] ){}
function apc_dec ( string $key [, int $step = 1 [, bool &$success ]] ){}
function apc_inc ( string $key [, int $step = 1 [, bool &$success ]] ){}

function apc_bin_dump ([ array $files = NULL [, array $user_vars = NULL ]] ){}
function apc_bin_dumpfile ( array $files , array $user_vars , string $filename [, int $flags = 0 [, resource $context = NULL ]] ){}
function apc_bin_load ( string $data [, int $flags = 0 ] ){}
function apc_bin_loadfile ( string $filename [, resource $context = NULL [, int $flags = 0 ]] ){}

function apc_cache_info ([ string $cache_type = "" [, bool $limited = false ]] ){}
function apc_clear_cache ([ string $cache_type = "" ] ){}

function apc_compile_file ( string $filename [, bool $atomic = true ] ){}
function apc_delete_file ( mixed $keys ){}

function apc_define_constants ( string $key , array $constants [, bool $case_sensitive = true ] ){}
function apc_load_constants ( string $key [, bool $case_sensitive = true ] ){}

function apc_sma_info ([ bool $limited = false ] ){}