$f = new TForm();
$f->caption = 'Caption'.random(10000);
//Событие OnClick
$c = new TBevel();
$c->parent = $f;
$c->align = alClient;
$f->show();