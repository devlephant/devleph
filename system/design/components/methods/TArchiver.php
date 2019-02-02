<?

$result = array();
$ars = 'archive(*.zip, *.rar, *.pak)';
$result[] = array(
                  'CAPTION'=>'Open',
                  'PROP'=>'Open',
                  'INLINE'=>'Open (string filename, string password ) \n - Open '.$ars,
                  );

$result[] = array(
                  'CAPTION'=>'AddFile',
                  'PROP'=>'AddFile',
                  'INLINE'=>'AddFile (string filename) \n - Add file to '.$ars,
                  );	

$result[] = array(
                  'CAPTION'=>'RenameFile',
                  'PROP'=>'RenameFile',
                  'INLINE'=>'RenameFile (string filename, string newname) \n - Rename file in '.$ars,
                  );
	

$result[] = array(
                  'CAPTION'=>'DeleteFile',
                  'PROP'=>'DeleteFile',
                  'INLINE'=>'DeleteFile ( string filename ) \n - Delete file in '.$ars,
                  );		  
	
$result[] = array(
                  'CAPTION'=>'ExtractFile',
                  'PROP'=>'ExtractFile',
                  'INLINE'=>'ExtractFile (string name, string dir, string password) \n - Extract file from '.$ars.' to $dir',
                  );		

$result[] = array(
                  'CAPTION'=>'Extract',
                  'PROP'=>'Extract',
                  'INLINE'=>'Extract ( string dir, string password ) \n - Extract all from archive to $dir',
                  );	  
	
$result[] = array(
                  'CAPTION'=>'Save',
                  'PROP'=>'Save',
                  'INLINE'=>'Save ( void ) \n - Save archive',
                  );	


$result[] = array(
                  'CAPTION'=>'Reset',
                  'PROP'=>'Reset',
                  'INLINE'=>'Reset ( string reopen ) \n - Reopen/Reset archive',
                  );	

$result[] = array(
                  'CAPTION'=>'Free',
                  'PROP'=>'Free',
                  'INLINE'=>'Free ( void ) \n - Delete this object',
                  );

return $result;