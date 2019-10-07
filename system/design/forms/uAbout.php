<?


class ev_fmAbout_image1{
    
    static function onClick($self)
	{    
        DevS\cache::c('fmAbout')->close();
    }
}