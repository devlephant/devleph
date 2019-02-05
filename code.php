class TPanelEx extends TPanel{ public $class_name = __CLASS__; }
$f = new TForm();
$ex = new TPanelEx($f);
$ex->parent = $f;
$b = new TButton($f);
$b->parent = $f;
$b->y = $ex->h;
$b->caption = 'clc';
$b->onClick = function($self) use($ex){
$ex->visible =! $ex->visible;
};
pre(
event_set($ex->self, 'onVisibilityChanged', function($self, &$Value){ $Value = true; })
);
$f->show();