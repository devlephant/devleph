<?


class myMasters {
    
    const UTIL_DIR = '/utils/';
    
    static function generate(){
        
        $utils = findDirs(SYSTEM_DIR . self::UTIL_DIR);
        
        foreach ($utils as $code)
            self::createMaster($code);
		
		if( c('fmMain->it_Utils')->count <= 0 )
			c('fmMain->it_Utils')->visible = false;
    }
    
    static function createMaster($code){
        
        if (!eregi('([a-z0-9\_]+)',$code)) return false;
        
        $dir = SYSTEM_DIR . self::UTIL_DIR . $code;
        
        /// פאיכ ÿחûךא
        Localization::inc($dir . '/lang');
        
        if (file_exists($dir . '/info.php')){
            $info = include $dir . '/info.php';
            
            $it = new TMenuItem(c('fmMain'));
            $it->caption = $info['CAPTION'];
			$obj_CCC = c("fmMain->it_Utils");
            $obj_CCC->addItem($it);   
            
            if (file_exists($dir.'/icon.bmp'))
                $it->loadPicture($dir.'/icon.bmp');
            elseif (file_exists($dir.'/icon.png'))
                $it->loadPicture($dir.'/icon.png');
            elseif (file_exists($dir.'/icon.gif'))
                $it->loadPicture($dir.'/icon.gif');
            
            c('fmMain->it_Utils')->addItem($it);
            $it->onClick = function() use ($code, $info){
                call_user_func('master_'.$code.'::open', $info['MSP_PROJECT']);
            };
        }
        
        if (file_exists($dir.'/class.php')){
            include $dir .'/class.php';
        }

        if( isset($info['FORMS']) )
        foreach ((array)$info['FORMS'] as $form){
            if (file_exists($dir.'/'.$form.'.dfm')){   
                $frm = TForm::loadFromFile(self::UTIL_DIR .$code.'/'. $form, true);
                $frm->name = 'mst_' . $code;
            }
        }
    }
    
}