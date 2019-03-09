<?


function shortName($file){
    global $progDir;
    if (file_exists($progDir.'\\'.$file))
        return $progDir.'\\'.$file;
    else
        return $file;
}

// расширение файла без символа ".", все переводит в нижний регистр для удобства
// сравнения
function fileExt($file){
    $file = basename($file);
    $k = strrpos($file,'.');
    if ($k===false) return '';
    return strtolower(substr($file, $k+1, strlen($file)-$k-1));
}

// возвращает true если файл $file расширения $ext, либо его расширение имеется
// в массиве $ext. $ext - массив или строка
function checkExt($file, $ext){
    $file_ext = fileExt($file);
    
    
    if (is_array($ext)){
        foreach ($ext as $item){
            $item = str_replace('.', '', strtolower(trim($item)));
            if ($item == $file_ext) return true;
        }
    } else {
        $ext = str_replace('.', '', strtolower(trim($ext)));
        if ($ext == $file_ext) return true;
    }
    
    return false;
}

// возвращает название файла без расширения
function basenameNoExt($file){
    $file = basename($file);
    $ext = fileExt($file);
    return str_ireplace('.' . $ext, '', $file);
}


function getFileName($str, $check = true){
    
    if ($check && function_exists('resFile')){
        
        return resFile($str);
    }
    
    $last_s = $str;
    if (!file_exists($str))
        $str = DOC_ROOT .'/'. $str;
        
    if (!file_exists($str))
        $str = $last_s;
    else
        $str = str_replace('/', DIRECTORY_SEPARATOR, $str);
        
    return $str;
}
function rglob($pattern, $flags = 0) {
    $files = glob($pattern, $flags); 
    foreach (glob(dirname($pattern).'/*', GLOB_ONLYDIR|GLOB_NOSORT) as $dir) {
        $files = array_merge($files, rglob($dir.'/'.basename($pattern), $flags));
    }
    return $files;
}
// поиск файлов в папке...
// можно искать по расширению exts - список расширений
function findFiles($dir, $exts = null, $recursive = false, $with_dir = false, $with_extension = true){
    $dir = realpath(str_replace(['\\\\\\', '\\\\', '///', '//'], ['\\', '\\', '/', '/'], $dir));
	
    if (!is_dir($dir)) return [];
	$pattern = (($exts==null) or (!(bool)$exts))? 
						"$dir\\*.*": 
						(is_array($exts))? 
							(empty($exts))? "$dir\\*.*":
							"$dir\\*.{" . implode(',', $exts) . "}":
						"$dir\\*.$exts";
	$flag = is_array($exts)? GLOB_BRACE: GLOB_NOSORT;
	if( !$with_dir )
	{
		$result = [];
		foreach(($recursive? rglob($pattern, $flag): glob($pattern, $flag)) as $file)
		{
			$result[] = $with_extension? basename($file): basenameNoExt($file);
		}
		return $result;
	}
	return $recursive? rglob($pattern, $flag): glob($pattern, $flag);
}

function findDirs($dir){
    
    $dir = replaceSl($dir);
    
    if (!is_dir($dir)) return [];
    
    $files = scandir($dir);
	unset($files[0], $files[1]); // remove С.Т and С..Т from array
    
    $result = [];
    foreach ($files as $file){
        
        if (is_dir($dir .'/'. $file)){
            
            $result[] = $file;
        }
    }
    return $result;
}

function rmdir_recursive($dir) {
    $dir = replaceSl($dir);
    
    if (!is_dir($dir)) return false;
    
    $files = scandir($dir);
	unset($files[0], $files[1]); // remove С.Т and С..Т from array
    
    foreach ($files as $file) {
        $file = $dir . '/' . $file;
        if (is_dir($file)) {
            rmdir_recursive($file);
        
        if (is_dir($file))
            rmdir($file);
        } else {
            unlink($file);
        }
    }
    rmdir($dir);
}

function deleteDir($dir, $dir_del = true, $exts = null){
    
    $dir = replaceSl($dir);
    foreach (findFiles($dir, $exts, true, true) as $file)
        unlink($file);
    
    
    if ($dir_del)
        rmdir_recursive($dir);
}

function include_ex($file){
    
    $file = getFileName($file);
    include_enc($file);
}

function fileLock($file){
    
    $file = getFileName($file);
    $fp = fopen($file, "a");
    flock($fp, LOCK_SH);
    $GLOBALS['__fileLock'][$file] = $fp;
}

function fileUnlock($file){
    
    $file = getFileName($file);
    
    if (isset($GLOBALS['__fileLock'][$file]))
        flock($GLOBALS['__fileLock'][$file], LOCK_UN);
}

function dirLock($dir, $exts = null){

    foreach (findFiles($dir, $exts, true, true) as $file)
        fileLock($file);
}

function dirUnlock($dir, $exts = null)
{
    foreach (findFiles($dir, $exts, true, true) as $file)
        fileUnlock($file);
}


function file_p_contents($file, $data){
    $dir  = dirname($file);
    
    if (!file_exists($dir))
        mkdir($dir, 0777, true);
    
    return file_put_contents(replaceSl($file), $data);    
}

function x_copy($from, $to){
    $dir  = dirname($to);
    
    if (!file_exists($dir))
        mkdir($dir, 0777, true);
        
    return copy(replaceSl($from), replaceSl($to));
}

function x_move($from, $to){
    
    $x = 0;
    while (!x_copy($from, $to)){
        if ($x>30){
            break;
        }
        $x++;
    }
    
    $x = 0;
    while (!unlink($from)){
        if ($x>30)
            break;
        $x++;
    }
}
?>