list($n,$l)=file('input.txt');$l=explode(' ',$l);$r=0;
for($d=1;$d<=$n;$d++)foreach($l as$i=>$v)
$r+=!($d%2)? (!($i%2)?-$v:$v): (!($i%2)?$v:-$v);
file_put_contents('output.txt',$r);