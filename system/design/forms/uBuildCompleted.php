<?


class ev_fmBuildCompleted_btn_run {
    
    
    static function onClick($self){
        
        run(c('fmBuildProgram->path')->text);
    }
}

class ev_fmBuildCompleted_btn_dir {
    
    
    static function onClick($self){
        
        run(dirname(c('fmBuildProgram->path')->text));
    }
}

class ev_fmBuildCompleted_btn_close {
    static function onClick($self)
	{
        c("fmBuildCompleted")->close();
    }
}
class ev_fmBuildCompleted_btn_copylink
{
	static function onClick($self)
	{
		clipboard_SetText('https://www.microsoft.com/en-us/download/details.aspx?id=30679');
	}
}
class ev_fmBuildCompleted{
	static function onShow($self)
	{
		c("fmBuildCompleted->richEdit1")->text = t('build_notify_ua');
	}
}