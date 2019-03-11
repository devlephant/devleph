<?

$result = array();


$result[] = array(
                  'CAPTION'=>t('Align'),
                  'TYPE'=>'combo',
                  'PROP'=>'align',
                  'VALUES'=>array('alNone', 'alTop', 'alBottom', 'alLeft', 'alRight', 'alClient', 'alCustom'),
                   'ADD_GROUP'=>true
                  );

$result[] = array(
                  'CAPTION'=>t('Default Encoding'),
                  'TYPE'=>'text',
                  'PROP'=>'defaultEncoding',
                  );
$result[] = array(
                  'CAPTION'=>t('Default User CSS Path'),
                  'TYPE'=>'text',
                  'PROP'=>'defaultCSSPath',
                  );                  
                  
$result[] = array(
                  'CAPTION'=>t('URL'),
                  'TYPE'=>'',
                  'PROP'=>'url',
                  );

$result[] = array(
                  'CAPTION'=>t('HTML Code'),
                  'TYPE'=>'',
                  'PROP'=>'html',
                  );

$result[] = array(
                  'CAPTION'=>t('Options'),
                  'TYPE'=>'',
                  'PROP'=>'options',
                  );

$result[] = array(
                  'CAPTION'=>t('Drag Drop Disabled'),
                  'TYPE'=>'',
                  'PROP'=>'options->dragDropDisabled',
                  );

$result[] = array(
                  'CAPTION'=>t('Load Drops Disabled'),
                  'TYPE'=>'',
                  'PROP'=>'options->loadDropsDisabled',
                  );

$result[] = array(
                  'CAPTION'=>t('Encoding Detector Enabled'),
                  'TYPE'=>'',
                  'PROP'=>'options->encodingDetectorEnabled',
                  );

$result[] = array(
                  'CAPTION'=>t('Javascript Disabled'),
                  'TYPE'=>'',
                  'PROP'=>'options->javascriptDisabled',
                  );
$result[] = array(
                  'CAPTION'=>t('Javascript Open Windows Disallowed'),
                  'TYPE'=>'',
                  'PROP'=>'options->javascriptOpenWindowsDisallowed',
                  );
$result[] = array(
                  'CAPTION'=>t('Javascript Close Windows Disallowed'),
                  'TYPE'=>'',
                  'PROP'=>'options->javascriptCloseWindowsDisallowed',
                  );
$result[] = array(
                  'CAPTION'=>t('Javascript Access Clipboard Disallowed'),
                  'TYPE'=>'',
                  'PROP'=>'options->javascriptAccessClipboardDisallowed',
                  );
$result[] = array(
                  'CAPTION'=>t('Dom Paste Disabled'),
                  'TYPE'=>'',
                  'PROP'=>'options->domPasteDisabled',
                  );
$result[] = array(
                  'CAPTION'=>t('Caret Browsing Enabled'),
                  'TYPE'=>'',
                  'PROP'=>'options->caretBrowsingEnabled',
                  );
$result[] = array(
                  'CAPTION'=>t('Java Disabled'),
                  'TYPE'=>'',
                  'PROP'=>'options->javaDisabled',
                  );
$result[] = array(
                  'CAPTION'=>t('PluginsDisabled'),
                  'TYPE'=>'',
                  'PROP'=>'options->pluginsDisabled',
                  );
$result[] = array(
                  'CAPTION'=>t('Universal Access From File Urls Allowed'),
                  'TYPE'=>'',
                  'PROP'=>'options->universalAccessFromFileUrlsAllowed',
                  );
$result[] = array(
                  'CAPTION'=>t('File Access From File Urls Allowed'),
                  'TYPE'=>'',
                  'PROP'=>'options->fileAccessFromFileUrlsAllowed',
                  );
$result[] = array(
                  'CAPTION'=>t('Web Security Disabled'),
                  'TYPE'=>'',
                  'PROP'=>'options->webSecurityDisabled',
                  );
$result[] = array(
                  'CAPTION'=>t('Xss Auditor Enabled'),
                  'TYPE'=>'',
                  'PROP'=>'options->xssAuditorEnabled',
                  );
$result[] = array(
                  'CAPTION'=>t('Image Load Disabled'),
                  'TYPE'=>'',
                  'PROP'=>'options->imageLoadDisabled',
                  );
$result[] = array(
                  'CAPTION'=>t('Shrink Standalone Images To Fit'),
                  'TYPE'=>'',
                  'PROP'=>'options->shrinkStandaloneImagesToFit',
                  );
$result[] = array(
                  'CAPTION'=>t('Site Specific Quirks Disabled'),
                  'TYPE'=>'',
                  'PROP'=>'options->siteSpecificQuirksDisabled',
                  );
$result[] = array(
                  'CAPTION'=>t('Text Area Resize Disabled'),
                  'TYPE'=>'',
                  'PROP'=>'options->textAreaResizeDisabled',
                  );
$result[] = array(
                  'CAPTION'=>t('Page Cache Disabled'),
                  'TYPE'=>'',
                  'PROP'=>'options->pageCacheDisabled',
                  );
$result[] = array(
                  'CAPTION'=>t('Tab To Links Disabled'),
                  'TYPE'=>'',
                  'PROP'=>'options->tabToLinksDisabled',
                  );
$result[] = array(
                  'CAPTION'=>t('Hyperlink Auditing Disabled'),
                  'TYPE'=>'',
                  'PROP'=>'options->hyperlinkAuditingDisabled',
                  );
$result[] = array(
                  'CAPTION'=>t('User Style Sheet Enabled'),
                  'TYPE'=>'',
                  'PROP'=>'options->userStyleSheetEnabled',
                  );
$result[] = array(
                  'CAPTION'=>t('Author And User Styles Disabled'),
                  'TYPE'=>'',
                  'PROP'=>'options->authorAndUserStylesDisabled',
                  );
$result[] = array(
                  'CAPTION'=>t('Local Storage Disabled'),
                  'TYPE'=>'',
                  'PROP'=>'options->localStorageDisabled',
                  );
$result[] = array(
                  'CAPTION'=>t('Databases Disabled'),
                  'TYPE'=>'',
                  'PROP'=>'options->databasesDisabled',
                  );
$result[] = array(
                  'CAPTION'=>t('Application Cache Disabled'),
                  'TYPE'=>'',
                  'PROP'=>'options->applicationCacheDisabled',
                  );
$result[] = array(
                  'CAPTION'=>t('Webgl Disabled'),
                  'TYPE'=>'',
                  'PROP'=>'options->webglDisabled',
                  );
$result[] = array(
                  'CAPTION'=>t('Accelerated Compositing Enabled'),
                  'TYPE'=>'',
                  'PROP'=>'options->acceleratedCompositingEnabled',
                  );
$result[] = array(
                  'CAPTION'=>t('Threaded Compositing Enabled'),
                  'TYPE'=>'',
                  'PROP'=>'options->threadedCompositingEnabled',
                  );
$result[] = array(
                  'CAPTION'=>t('Accelerated Layers Disabled'),
                  'TYPE'=>'',
                  'PROP'=>'options->acceleratedLayersDisabled',
                  );
$result[] = array(
                  'CAPTION'=>t('Accelerated 2d Canvas Disabled'),
                  'TYPE'=>'',
                  'PROP'=>'options->accelerated2dCanvasDisabled',
                  );
$result[] = array(
                  'CAPTION'=>t('Developer Tools Disabled'),
                  'TYPE'=>'',
                  'PROP'=>'options->developerToolsDisabled',
                  );
                  
$result[] = array(
                  'CAPTION'=>t('Sizes and position'),
                  'TYPE'=>'sizes',
                  'PROP'=>'',
                  'ADD_GROUP'=>true,
                  );

$result[] = array('CAPTION'=>t('p_Left'), 'PROP'=>'x','TYPE'=>'number','ADD_GROUP'=>1);
$result[] = array('CAPTION'=>t('p_Top'), 'PROP'=>'y','TYPE'=>'number','ADD_GROUP'=>1);
$result[] = array('CAPTION'=>t('Width'), 'PROP'=>'w','TYPE'=>'number','ADD_GROUP'=>1);
$result[] = array('CAPTION'=>t('Height'), 'PROP'=>'h','TYPE'=>'number','ADD_GROUP'=>1);

return $result;