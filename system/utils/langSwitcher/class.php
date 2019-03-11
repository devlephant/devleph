<?


function langSwitcher($lang){
	if(c('lang_it_'.trim( myOptions::get('main','lang', LANG_ID) ))->self)
		c('lang_it_'.trim( myOptions::get('main','lang', LANG_ID) ))->enabled = true;
	if(c('lang_it_'.trim($lang['lang']))->self)
		c('lang_it_'.trim($lang['lang']))->enabled = false;
   myOptions::set('main','lang',$lang['lang']);

   if( isset($lang['message']) && trim($lang['message']) !== '' )
	pre(Localization::toEncoding($lang['message']));
}

$langs = findFiles(DOC_ROOT.'/lang/','lng',false,true);

    foreach ($langs as $lang){
        
        $info = parse_ini_file($lang);
        $info['lang'] = basenameNoExt($lang);
        $infos[basenameNoExt($lang)] = $info;
    }
    
    BlockData::sortList($infos, 'sort');
    
    foreach ($infos as $id=>$info){
        
        $item = menuItem($info['title'], 0, 'lang_it_'.trim($info['lang']),
                         function() use ($info){
                            langSwitcher($info);
                         },
                     0, DOC_ROOT.'/lang/'.$info['lang'].'/icon.png');
		if( $info['lang'] == LANG_ID ) $item->enabled = false;
        c('fmMain->MainMenu',1)->addItem($item, c('fmMain->itLanguage',1));
    }