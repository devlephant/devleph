<?

global $_IMAGES16, $_IMAGES24, $_IMAGES32, $allImages;

$allImages = [];
$is_exists = [];
$c         = 0;
$root1	   = SYSTEM_DIR . '/design/';
$root2	   = dsThemeDesign::$dir . '/';

$files = array_merge( findFiles($root2.'24bit/',['bmp','png','gif']),
findFiles($root1 . '24bit/',['bmp','png','gif']) );

foreach ($files as $i=>$file){
    
    if ( in_array(basenameNoExt($file), $is_exists) ){
        ++$c;
        continue;
    }
    if (file_exists($root2 . '24bit/' . $file))
	{
		$_IMAGES24->addFromFile($root2 . '24bit/' . $file);
    } elseif(file_exists($root1 . '24bit/' . $file)) {
		$_IMAGES24->addFromFile($root1 . '24bit/' . $file);
	} else $_IMAGES24->addFromFile($root1 . '24bit/empty.bmp');
    
    if (file_exists($root2 . '32bit/' . $file)) {
        $_IMAGES32->addFromFile($root2 . '32bit/' . $file);
	} elseif (file_exists($root1 . '32bit/' . $file))
	{
		$_IMAGES32->addFromFile($root1 . '32bit/' . $file);
    } else    $_IMAGES32->addFromFile($root1 . '32bit/empty.bmp');
        
    
    $is_exists[] = basenameNoExt($file);
    $allImages[basenameNoExt($file)] = ['ID' => $i-$c, 'FILE'=>$file];
}