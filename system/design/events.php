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
