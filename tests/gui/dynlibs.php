<?php
if( ldtl('LoadDllCLasses.dll') )
{
class TFlowPanel extends TControl{
public $class_name = __CLASS__;
}
$form = new TForm();
$c = new TFlowPanel();
$c->parent = $form;
$form->show();
}

if( lbpl('TestPack240.bpl') )
{
class TTouchKeyboard extends TControl{
public $class_name = __CLASS__;
}
$c = new TTouchKeyboard();
$c->h = 20 * 5;
$c->parent = $form;
$form->show();
}