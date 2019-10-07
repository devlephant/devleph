<?

class ev_fmProjectOptions_list {
    
    function onClick($self){
        
        $list = DevS\cache::c($self);
        $name = $list->inText;
		$glang = file_exists(dirname(EXE_NAME).'/ext/lang/'.LANG_ID)? strtolower(LANG_ID).'/': 'en/';
		if(file_exists(dirname(EXE_NAME).'/ext/lang/'.$glang.basenameNoExt($name).'.rtf')){
			DevS\cache::c('fmProjectOptions->mod_desc')->loadFromFile(dirname(EXE_NAME).'/ext/lang/'.$glang.basenameNoExt($name).'.rtf');
		}else if(file_exists(dirname(EXE_NAME).'/ext/lang/'.$glang.basenameNoExt($name).'.txt')){
			DevS\cache::c('fmProjectOptions->mod_desc')->loadFromFile(dirname(EXE_NAME).'/ext/lang/'.$glang.basenameNoExt($name).'.txt');
		}else DevS\cache::c('fmProjectOptions->mod_desc')->Text = '['.t('No description').']';	
        
    }
	
}
class ev_fmProjectOptions{
	function onShow($self){
		c('fmProjectOptions->mod_desc')->text = t('To read description, please, select module from list').'.';
	}
}