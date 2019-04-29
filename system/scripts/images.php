<?

global $_IMAGES16, $_IMAGES24, $_IMAGES32, $allImages;

$allImages = [];
$is_exists = [];
$c         = 0;
$root1	   = SYSTEM_DIR . '/images/';
$root2	   = SYSTEM_DIR . '/images/btns/' . myOptions::get('prefs','studio_theme', 'light') . '/';

$files = array_merge( findFiles($root2.'24/',['bmp','png','gif']),
findFiles($root1 . '24/',['bmp','png','gif']) );

foreach ($files as $i=>$file){
    
    if ( in_array(basenameNoExt($file), $is_exists) ){
        $c++;
        continue;
    }
    if (file_exists($root2 . '24/' . $file))
	{
		$_IMAGES24->addFromFile($root2 . '24/' . $file);
    } elseif(file_exists($root1 . '24/' . $file)) {
		$_IMAGES24->addFromFile($root1 . '24/' . $file);
	} else $_IMAGES24->addFromFile($root1 . '24/empty.bmp');
    
    if (file_exists($root2 . '32/' . $file)) {
        $_IMAGES32->addFromFile($root2 . '32/' . $file);
	} elseif (file_exists($root1 . '32/' . $file))
	{
		$_IMAGES32->addFromFile($root1 . '32/' . $file);
    } else    $_IMAGES32->addFromFile($root1 . '32/empty.bmp');
        
    
    $is_exists[] = basenameNoExt($file);
    $allImages[basenameNoExt($file)] = ['ID' => $i-$c, 'FILE'=>$file];
}