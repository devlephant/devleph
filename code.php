$code = '
parsemy
elsemy
mustmycheck
elsewreck
<?php
echo ;testin;';
$code = substr($code, stripos($code, '<?')-2);
pre($code);