<?
class master_scriptsmaster{

function inc($pdir=false){
	
}
function add($moo){
	$dir = DS_DIR.'ext/mods/'.$moo;
	if( file_exists($dir) && is_dir($dir) && file_exists($dir.'.php') ){
				$info = include $dir.'.php';
				if(	is_array($info)	){
					if ( is_array($info['MODULES']) ){ //Добавляем php модули
						foreach($info['MODULES'] as $f) SELF::add_m($f);
					}else SELF::add_m($info['MODULES']);
					if( is_array($info['SCRIPTS']) ){ //Копируем скрипты
						foreach( $info['SCRIPTS'] as $f ) SELF::add_s($f, $dir);
					}else SELF::add_s($info['SCRIPTS'], $dir);
				}
	}
}
function delete($moo){
	global $myProject;
	unset( $myProject->config['mods'][ array_search($moo, $myProject->config['mods']) ] );
}
function add_s($f, $dir){
	global $projectFile;
	$n = $f;
	if( fileext($n) !== 'php' ) $n .= '.php';
	if(file_exists($dir.'/'.$n))
		x_copy( $dir.'/'.$n, dirname($projectFile).'/scripts/'.$n);
}

function add_m($f){
	global $myProject;
	if( is_array($f) ){
		foreach($f as $x){
			if( strtolower(substr(trim($x), 0, 4)) == 'php_' and !in_array($x, $myProject->config['modules'])) $myProject->config['modules'][] = (fileext($x)=='dll')?$x: $x.'.dll';
		}
	}else{
		if( strtolower(substr(trim($f), 0, 4)) == 'php_'  and !in_array($f, $myProject->config['modules'])) $myProject->config['modules'][] = (fileext($f)=='dll')?$f: $f.'.dll'
	}
}
	
}