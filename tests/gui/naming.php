$f = new TForm();
$f->name = "Form1";
$b = new TButton();
$b->name = "Button1";
$b->parent = $f;

$f1 = new TForm();
$f1->name = "Form";
$b1 = new TButton($f1);
$b1->name = "Button";
$b3 = new TButton();
$b3->name = "Butt3";
pre($b->fullname, $b1->fullname, $b3->fullname);