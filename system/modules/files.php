<?


class Data {
    
    static function write($data, $file){
        
        if (is_object($data)){
            
            $tmp['x'] = $data->x;
            $tmp['y'] = $data->y;
            $tmp['w'] = $data->w;
            $tmp['h'] = $data->h;
            $tmp['text'] = $data->text;
            $tmp['color'] = $data->color;
            $data = $tmp;
        }
    
        $file = getFileName($file);
        file_str($file, serialize($data));
    }
    
    static function read($file, &$buffer){
        
        $file = getFileName($file);
        $data = unserialize(file_get_contents($file));
        
        if (is_array($data) && is_object($buffer)){
            foreach ($data as $key=>$value){
                $buffer->$key = $value;
            }
        } elseif (is_object($buffer)){
            $buffer->text = $data;
        } else {
            $buffer = $data;
        }
    }
}

function file_str($file, $data){
    
    $file = replaceSl($file);
    dir_create(dirname($file));
    return file_put_contents($file,$data);
}

function file_delete($file){
    
    $file = replaceSl($file);
    if (file_exists($file))
        unlink($file);
}

function file_copy($file, $to){
    
    $to = replaceSl($to);
    $file = replaceSl($file);
    
    $dir = dirname($to);
    if (!is_dir($dir)) mkdir($dir, 0777, true);
    
    copy($file, $to);
}

function file_move($file, $to){
    
    file_copy($file, $to);
    file_delete($file);
}

function file_rename($file, $to){
    
    $file = replaceSl($file);
    $to   = replaceSl($to);
    
    if (!file_exists($file)) return false;
    if (file_exists($to)) return false;
    
    rename($file, $to);
    return true;
}


function dir_search($dir, &$buffer, $exts = false, $recursive = true, $with_dir = true){
    
    if ($exts){
        $exts = explode(',',$exts);
    }
    
    $buffer = findFiles($dir, $exts, $recursive, $with_dir);
    foreach ($buffer as $i=>$file)
        $buffer[$i] = str_replace('//','/',$file);
}

function dir_delete($dir){
    
    $dir = replaceSl($dir);
    if (!is_dir($dir)) return false;
    
    rmdir_recursive($dir);
    return true;
}

function dir_rename($dir, $to){
    
    $dir = replaceSl($dir);
    $to  = replaceSl($to);
    if (!is_dir($dir)) return false;
    if (is_dir($to)) return false;
    
    rename($dir, $to);
    return true;
}

function dir_create($dir){
    
    $dir = replaceSl($dir);
    if (is_dir($dir)) return false;
    
    mkdir($dir, 0777, true);
}

function dir_copy($dir, $to){
    
    dir_create($to);
    $to = replaceSl($to);
    $dir = replaceSl($dir);
    $dir = realpath(str_replace(['\\\\\\', '\\\\', '///', '//'], ['\\', '\\', '/', '/'], $dir));
    $result = array();
    if (!is_dir($dir)) return false;
    
    $files = findFiles($dir, null, true, true);
	
    foreach ($files as $file){
        $result[] = str_ireplace($dir,'',$file);
        file_copy($file, $to .'/'. str_replace($dir,'',$file));
    }
    
    return $result;
}

function dir_move($dir, $to){
    
    dir_copy($dir, $to);
    dir_delete($dir);
}

// проверка версий 1.x.x.x, если первая версия больше первой то 1
function compareVer($ver1, $ver2){
    
    if ($ver1==$ver2) return 0;
    
    $ver1 = (int) str_replace('.','',$ver1);
    $ver2 = (int) str_replace('.','',$ver2);
    
    return $ver1 > $ver2 ? 1 : -1;
}

?>