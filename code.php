$f = 
'C:/Users/Andrew/Documents/DS KE/Project19/soulEngine.pak';
$f2 = base64_decode(file_get_contents($f));
file_put_contents('just_testing.php', $f2);