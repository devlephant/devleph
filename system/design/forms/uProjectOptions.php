<?

class ev_fmProjectOptions_list {
    
    function onClick($self){
        
        $list = c($self);
        $name = $list->inText;
		$glang = file_exists(dirname(EXE_NAME).'/ext/lang/'.LANG_ID)? strtolower(LANG_ID).'/': 'en/';
		if(file_exists(dirname(EXE_NAME).'/ext/lang/'.$glang.basenameNoExt($name).'.rtf')){
			c('fmProjectOptions->mod_desc')->loadFromFile(dirname(EXE_NAME).'/ext/lang/'.$glang.basenameNoExt($name).'.rtf');
		}else if(file_exists(dirname(EXE_NAME).'/ext/lang/'.$glang.basenameNoExt($name).'.txt')){
			c('fmProjectOptions->mod_desc')->loadFromFile(dirname(EXE_NAME).'/ext/lang/'.$glang.basenameNoExt($name).'.txt');
		}else c('fmProjectOptions->mod_desc')->Text = '['.t('No description').']';	
        
    }
	
}
class ev_fmProjectOptions{
	function onShow($self){
		c('fmProjectOptions->mod_desc')->text = t('To read description, please, select module from list').'.';
	}
}