<?
$result = array();
$result[] = array(
                  'CAPTION'=>t('File'),
                  'TYPE'=>'text',
                  'PROP'=>'file',
                  );	
				
$result[] = array('CAPTION'=>t('p_Left'), 'PROP'=>'x','TYPE'=>'number','ADD_GROUP'=>1,'UPDATE_DSGN'=>1);
$result[] = array('CAPTION'=>t('p_Top'), 'PROP'=>'y','TYPE'=>'number','ADD_GROUP'=>1,'UPDATE_DSGN'=>1);
$result[] = array('CAPTION'=>t('Width'), 'PROP'=>'w','TYPE'=>'number','ADD_GROUP'=>1,'UPDATE_DSGN'=>1);
$result[] = array('CAPTION'=>t('Height'), 'PROP'=>'h','TYPE'=>'number','ADD_GROUP'=>1,'UPDATE_DSGN'=>1);
$result[] = array('CAPTION'=>t('Is Opened'), 'PROP'=>'opened','TYPE'=>'');
return $result;