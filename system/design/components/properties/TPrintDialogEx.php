<?

$result = [];

/*
$result[] = array(
                  'CAPTION'=>t('Print range'),
                  'TYPE'=>'combo',
                  'PROP'=>'printRange',
                  'VALUES'=>array(
					prAllPages => 'prAllPages';
					prSelection => 'prSelection';
					prPageNums => 'prPageNums';
                  ),
				 );*/

$result[] = array(
                  'CAPTION'=>t('From Page'),
                  'TYPE'=>'number',
                  'PROP'=>'fromPage',
				 );

$result[] = array(
                  'CAPTION'=>t('To Page'),
                  'TYPE'=>'number',
                  'PROP'=>'toPage',
				 );
				 
$result[] = array(
                  'CAPTION'=>t('Print to file'),
                  'TYPE'=>'check',
                  'PROP'=>'printToFile',
				 );
				 
$result[] = array(
                  'CAPTION'=>t('Copies'),
                  'TYPE'=>'number',
                  'PROP'=>'copies',
				 );
				 
$result[] = array(
                  'CAPTION'=>t('Colliate'),
                  'TYPE'=>'check',
                  'PROP'=>'collate',
				 );


return $result;