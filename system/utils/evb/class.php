<?
$it = new TMenuItem(c('fmMain'));
$it->caption = 'Enigma';   
c('fmMain->it_Utils')->addItem($it);

$vb = new TMenuItem();
$vb->caption = 'Virtual Box';
$vb->loadPicture(dirname(__FILE__) . '/vb.bmp');
$it->addItem($vb);
$vb->onClick = function(){run(dirname(__FILE__).'/enigmavb.exe', false);};

$help = new TMenuItem();
$help->caption = t('Enigma Help');
if( file_exists(SYSTEM_DIR . '/images/btns/' . myOptions::get('prefs','studio_theme', 'light') . '/24/help.bmp') ) {
	$help->loadPicture(SYSTEM_DIR . '/images/btns/' . myOptions::get('prefs','studio_theme', 'light') . '/24/help.bmp');
} elseif ( file_exists(SYSTEM_DIR . '/images/24/help.bmp') ) {
	$help->loadPicture(SYSTEM_DIR . '/images/24/help.bmp');
}
c('fmMain->itHelp')->addItem($help);
$help->onClick = function(){run(dirname(__FILE__).'/help.chm', false);};

$site = new TMenuItem();
$site->caption = t('Site');
$it->addItem($site);
$site->onClick = function(){run(dirname(__FILE__).'/site.url', false);};

$forum = new TMenuItem();
$forum->caption = t('Forum');
$it->addItem($forum);
$forum->onClick = function(){run(dirname(__FILE__).'/forum.url', false);};

$support = new TMenuItem();
$support->caption = t('Support');
$it->addItem($support);
$support->onClick = function(){run(dirname(__FILE__).'/support.url', false);};