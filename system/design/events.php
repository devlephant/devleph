<?

DevS\cache::c('fmMain')->onClick = 'myDesign::refreshForm';
DevS\cache::c('fmMain->itemDel')->onClick = 'myDesign::keyDelete';
DevS\cache::c('fmMain->itemCopy')->onClick = 'myDesign::keyCopy';
DevS\cache::c('fmMain->itemCut')->onClick  = 'myDesign::keyCut';
DevS\cache::c('fmMain->itemPaste')->onClick = 'myDesign::keyPaste';
DevS\cache::c('fmMain->itemSendtofront')->onClick = 'myDesign::toFront';
DevS\cache::c('fmMain->itemSendtoback')->onClick  = 'myDesign::toBack';
DevS\cache::c('fmMain->itemLock')->onClick = 'myDesign::lockComponent';
DevS\cache::c('fmMain->itemGroup')->onClick = 'myDesign::groupComponent';
DevS\cache::c('fmMain->itemAddevent')->onClick = function($self){
    myEvents::clickAddEvent(0, true);
};

DevS\cache::c('fmMain->editorPopup')->onPopup = 'myDesign::editorPopup';

DevS\cache::c('fmMain->tabForms')->onMouseDown    = 'myDesign::tabFormClick';
DevS\cache::c('fmObjectInspector->list')->onEdited= 'myDesign::objsInspectEdited';

DevS\cache::c('fmMain->itService')->onClick = 'myDesign::itViewsPopup';
