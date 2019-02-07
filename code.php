$d = new TForm();
$d->caption = 'test';
$s = $d->self;
$d = nil;
$d->free();
$sf = new TForm(nil, 1, $s);
pre($sf->caption);