<?
$it = new TMenuItem(c('fmMain'));
$it->caption = 'Skincrafter';   
c('fmMain->it_Utils')->addItem($it);

$vb = new TMenuItem();
$vb->caption = 'Skin Builder';
$vb->loadPicture(dirname(__FILE__) . '/skf.bmp');
$it->addItem($vb);
$vb->onClick = function(){run(dirname(__FILE__).'/SkinBuilder.exe', false);};

$help = new TMenuItem();
$help->caption = t('SkinBuilder Manual');
if( file_exists(SYSTEM_DIR . '/images/btns/' . myOptions::get('prefs','studio_theme', 'light') . '/24/help.bmp') ) {
	$help->loadPicture(SYSTEM_DIR . '/images/btns/' . myOptions::get('prefs','studio_theme', 'light') . '/24/help.bmp');
} elseif ( file_exists(SYSTEM_DIR . '/images/24/help.bmp') ) {
	$help->loadPicture(SYSTEM_DIR . '/images/24/help.bmp');
}
c('fmMain->itHelp')->addItem($help);
$help->onClick = function(){run(dirname(__FILE__).'/manual.chm', false);};

$site = new TMenuItem();
$site->caption = t('License');
$it->addItem($site);
$site->onClick = function(){run(dirname(__FILE__).'/SkinBuilder License.rtf', false);};