<?

function Search($Dir, $Pattern, $view = true) {
    $Iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($Dir, RecursiveDirectoryIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST,
        RecursiveIteratorIterator::CATCH_GET_CHILD
    );
    $Arr = iterator_to_array(new RegexIterator($Iterator, $Pattern, RecursiveRegexIterator::GET_MATCH));
    if($view) $Arr = array_keys($Arr);
    return $Arr;
}

function SearchOnExpansion($Dir, $Ext, $view = true) {
    if(is_array($Ext))
        $Ext = implode('|', $Ext);

    return Search($Dir, '#^.+\.('. trim($Ext) .')$#i', $view);
}

function SearchOnName($Dir, $Ext, $view = true) {
    if(is_array($Ext))
        $Ext = implode('|', $Ext);

    return Search($Dir, '#('.$Ext.')#i', $view);
}

?>