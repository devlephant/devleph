<?

$result = array();

$result[] = array(
                  'CAPTION'=>'Set Visible',
                  'PROP'=>'set_visible',
                  'INLINE'=>'set_visible (string v) - Set visible',
                  );

$result[] = array(
                  'CAPTION'=>'Get Visible',
                  'PROP'=>'get_visible',
                  'INLINE'=>'get_visible ( void ) - Get visible',
                  );	

$result[] = array(
                  'CAPTION'=>'PanelDblClick',
                  'PROP'=>'PanelDblClick',
                  'INLINE'=>'PanelDblClick (object self)',
                  );
	
$result[] = array(
                  'CAPTION'=>'panelClick',
                  'PROP'=>'panelClick',
                  'INLINE'=>'panelClick (object self)',
                  );

$result[] = array(
                  'CAPTION'=>'Set Label',
                  'PROP'=>'initLabel',
                  'INLINE'=>'initLabel (object self)  - Set label caption by object name',
                  );		  
	
$result[] = array(
                  'CAPTION'=>'Set Image',
                  'PROP'=>'setImage',
                  'INLINE'=>'setImage (string file, bool pre) - Load image from *.bmp',
                  );		

$result[] = array(
                  'CAPTION'=>'Free',
                  'PROP'=>'Free',
                  'INLINE'=>'Free ( void ) - Delete this object',
                  );

return $result;