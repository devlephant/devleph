<?

$result = [];


$result[] = array(
                  'CAPTION'=>'Check',
                  'PROP'=>'Check()',
                  'INLINE'=>'Check ( $url )',
                  );

$result[] = array(
                  'CAPTION'=>'Get',
                  'PROP'=>'Get()',
                  'INLINE'=>'Get ( $url )',
                  );
				  
$result[] = array(
                  'CAPTION'=>'Put',
                  'PROP'=>'Put()',
                  'INLINE'=>'Put ( $url,$data,$continue )',
                  );	

$result[] = array(
                  'CAPTION'=>'Alternate',
                  'PROP'=>'Alternate()',
                  'INLINE'=>'Alternate ( $url,$fx )',
                  );				  
return $result;