$f1 = new TForm();
$f1->Show();
$f = new TForm();
$f->ParentWindow = $f1->Handle;
$f->show();