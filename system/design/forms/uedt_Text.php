<?php

class ev_edt_Text_it_cut {
    static function onClick($self=0)
	{
		DevS\cache::c('edt_Text->memo')->cutToClipboard();
    }
}

class ev_edt_Text_it_copy {
    static function onClick($self=0)
	{
		DevS\cache::c('edt_Text->memo')->copyToClipboard();
    }
}

class ev_edt_Text_it_paste {
    static function onClick($self=0)
	{
		DevS\cache::c('edt_Text->memo')->pasteFromClipboard();
    }
}

class ev_edt_Text_it_selectall {
    static function onClick($self=0)
	{
		DevS\cache::c('edt_Text->memo')->selectAll();
    }
}
