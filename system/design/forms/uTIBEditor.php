<?
global $_c;

$_c->DLG_FILTER_ALL      = 'All files (*.*)|*.*';
$_c->DLG_FILTER_PROJECT  = 'PHP Soul Project (.spro)|*.spro;*.msppr;*.upr|' . DLG_FILTER_ALL;
$_c->DLG_FILTER_PICTURES = 'All images|*.bmp;*.gif;*.jpeg;*.jpg;*.jpe;*.jif;*jfif;*.wmf;*.tif;*.tiff;*.svg;*.emf;*.ico;*.icon;*.png|
Windows Graphics|*.bmp;*.wmf;*.emf;*.tif;*.tiff;*.ico|
Bitmap Picture|*.bmp|
Windows Metafile Image|*.wmf|
Enchanced Metafile Image|*.emf|
Metafile|*.wmf;*.emf|
Joint Picture Group|*.jpg;*.jpeg;*.jif;*.jfif|
Scalable Vector Graphics|*.svg|
Graphics Interchange Format|*.gif|
Windows Icon|*.ico;*.icon|
Portable Network Graphics|*.png|
Tagged Image File|*.tif;*.tiff|
' . DLG_FILTER_ALL;
$_c->DLG_FILTER_MUSIC    = 'All Music and Sounds|*.mp3;*.mp2;*.wav;*.wave;*.wma;*.midi;*.mid|' . DLG_FILTER_ALL;
/* xsnakes, LZ/AZ/LAZARUS XD */
/* TIB v1.5*/
	DevS\cache::c('fmTIB')->doubleBuffered = 1;
	$dlg = new TOpenDialog( c('fmTIB') );
	$dlg->filter = DLG_FILTER_PICTURES;
	$dlg->name = 'openDlg1';
	DevS\cache::c('fmTIB->listBox1')->onClick = function(){
		if( DevS\cache::c('fmTIB->listBox1')->itemIndex > -1 ){
		        $tib = DevS\cache::c('fmTIB')->tib;
		        if( is_object($tib) ){
		         if( $tib->classname == 'TIB'){
		          $arr = $tib->images;
		          $i = DevS\cache::c('fmTIB->listBox1')->itemIndex;
		          if( is_array($arr[$i]) ){
		           DevS\cache::c('fmTIB->image1')->picture->loadFromStr($arr[$i][0],$arr[$i][1]);
		          }
		         }
		        }
		}else{
		 DevS\cache::c('fmTIB->image1')->picture->clear();
		}
	};
	DevS\cache::c('fmTIB->spButton1')->onClick = function(){
		$tib = DevS\cache::c('fmTIB')->tib;
		if( is_object($tib) ){
		 if( $tib->classname == 'TIB'){
		  DevS\cache::c('fmTIB->openDlg1')->multiSelect = false;
		  if( DevS\cache::c('fmTIB->openDlg1')->execute() ){
		   $index = $tib->add( DevS\cache::c('fmTIB->openDlg1')->fileName );
		   master_TIB::tib_update_list();
		   DevS\cache::c('fmTIB->listBox1')->itemIndex = $index;
		   master_TIB::tib_update_img();
		  }
		  DevS\cache::c('fmTIB')->toFront();
		 }
		}
	};
	c('fmTIB->spButton2')->onClick = function(){
		$tib = DevS\cache::c('fmTIB')->tib;
		if( is_object($tib) ){
		 if( $tib->classname == 'TIB'){
		  DevS\cache::c('fmTIB->openDlg1')->multiSelect = true;
		  if( DevS\cache::c('fmTIB->openDlg1')->execute() ){
		   $files = DevS\cache::c('fmTIB->openDlg1')->files;
		   foreach($files as $f){
		    $index = $tib->add($f);
		   }
		   master_TIB::tib_update_list();
		   DevS\cache::c('fmTIB->listBox1')->itemIndex = $index;
		   master_TIB::tib_update_img();
		  }
		   DevS\cache::c('fmTIB')->toFront();
		 }
		}
	};
	DevS\cache::c('fmTIB->spButton3')->onClick = function(){
		$tib = DevS\cache::c('fmTIB')->tib;
		if( is_object($tib) ){
		 if( $tib->classname == 'TIB'){
		  $i = DevS\cache::c('fmTIB->listBox1')->itemIndex;
		  if( $i > -1 ){
		   $tib->delete($i);
		   master_TIB::tib_update_list();
		   master_TIB::tib_update_img();
		  }
		 }
		}
	};
	DevS\cache::c('fmTIB->spButton4')->onClick = function(){
		if( DevS\cache::c('fmTIB->listBox1')->itemIndex > 0 and DevS\cache::c('fmTIB->listBox1')->items->count > 1){
		        $tib = DevS\cache::c('fmTIB')->tib;
		        if( is_object($tib) ){
		         if( $tib->classname == 'TIB'){
		          $arr = $tib->images;
		          $i = DevS\cache::c('fmTIB->listBox1')->itemIndex;
		          $t1 = $arr[$i];
		          $t2 = $arr[$i-1];
		          $arr[$i-1] = $t1;
		          $arr[$i] = $t2;
		          $tib->images = $arr;
		          DevS\cache::c('fmTIB->listBox1')->itemIndex = $i-1;
		         }
		        }
		}
	};
	DevS\cache::c('fmTIB->spButton5')->onClick = function(){
		$i = DevS\cache::c('fmTIB->listBox1')->itemIndex;
		if( $i > -1 and $i < DevS\cache::c('fmTIB->listBox1')->items->count-1  and DevS\cache::c('fmTIB->listBox1')->items->count > 1){
		        $tib = DevS\cache::c('fmTIB')->tib;
		        if( is_object($tib) ){
		         if( $tib->classname == 'TIB'){
		          $arr = $tib->images;
		          $t1 = $arr[$i];
		          $t2 = $arr[$i+1];
		          $arr[$i+1] = $t1;
		          $arr[$i] = $t2;
		          $tib->images = $arr;
		          DevS\cache::c('fmTIB->listBox1')->itemIndex = $i+1;
		         }
		        }
		}
	};
	DevS\cache::c('fmTIB->spButton6')->onClick = function(){
		$tib = DevS\cache::c('fmTIB')->tib;
		if( is_object($tib) ){
		 $i = DevS\cache::c('fmTIB->listBox1')->itemIndex;
		 if( $tib->classname == 'TIB' and $i > -1 ){
		  DevS\cache::c('fmTIB->openDlg1')->multiSelect = false;
		  if( DevS\cache::c('fmTIB->openDlg1')->execute() ){
		   $tib->replace($i, DevS\cache::c('fmTIB->openDlg1')->fileName );
		   master_TIB::tib_update_list();
		   DevS\cache::c('fmTIB->listBox1')->itemIndex = $i;
		   $arr = $tib->images;
		   if( is_array($arr[$i]) ){
		    DevS\cache::c('fmTIB->image1')->picture->loadFromStr($arr[$i][0],$arr[$i][1]);
		   }
		  }
		  DevS\cache::c('fmTIB')->toFront();
		 }
		}
	};
	DevS\cache::c('fmTIB->spButton7')->onClick = function(){
		$tib = DevS\cache::c('fmTIB')->tib;
		if( is_object($tib) ){
		 if( $tib->classname == 'TIB' and DevS\cache::c('fmTIB->listBox1')->itemIndex > -1 ){
		  $arr = $tib->images;
		  $i = DevS\cache::c('fmTIB->listBox1')->itemIndex;
		  if( is_array($arr[$i]) ){
		   $tib->state = $i;
		  }
		 }
		}
	};
	DevS\cache::c('fmTIB->spButton8')->onClick = function(){
		$tib = DevS\cache::c('fmTIB')->tib;
		if( is_object($tib) ){
		 if( $tib->classname == 'TIB'){
		  $tib->picture->clear();
		   $tib->index = false;
		 }
		}
	};
	DevS\cache::c('fmTIB->spButton9')->onClick = function(){
		global $fmTib_mres;
		DevS\cache::c('fmTIB')->close();
		$fmTib_mres = false;
	};
	DevS\cache::c('fmTIB->spButton11')->onClick = function(){
		global $fmTib_mres;
		DevS\cache::c('fmTIB')->close();
		$fmTib_mres = true;
	};
	DevS\cache::c('fmTIB->spButton10')->onClick = function(){
		$tib = DevS\cache::c('fmTIB')->tib;
		if( is_object($tib) ){
		 if( $tib->classname == 'TIB' and count($tib->images) > 0 ){
		  $tib->clear();
		  DevS\cache::c('fmTIB->listBox1')->items->clear();
		  DevS\cache::c('fmTIB->image1')->picture->clear();
		 }
		}
	};
/////////////////////////////////////////////////////////////////////////////////
	class master_TIB{
		public static function tib_update_list(){
			$tib = DevS\cache::c('fmTIB')->tib;
			if( is_object($tib) ){
			 if( $tib->classname == 'TIB'){
			  $arr = $tib->images;
			  if( is_array($arr) ){
			   DevS\cache::c('fmTIB->listBox1')->items->clear();
			   foreach($arr as $k=>$v){
			    DevS\cache::c('fmTIB->listBox1')->items->add('Img'.$k.'.'.$v[1]);
			   }
			  }
			 }
			}
		}
		public static function tib_update_img(){
			$tib = DevS\cache::c('fmTIB')->tib;
			if( DevS\cache::c('fmTIB->listBox1')->itemIndex > -1 ){
			        if( is_object($tib) ){
			         if( $tib->classname == 'TIB'){
			          $arr = $tib->images;
			          $i = DevS\cache::c('fmTIB->listBox1')->itemIndex;
			          if( is_array($arr[$i]) ){
			           DevS\cache::c('fmTIB->image1')->picture->loadFromStr($arr[$i][0],$arr[$i][1]);
			          }
			         }
			        }
			}else{
			 DevS\cache::c('fmTIB->image1')->picture->clear();
			}
		}
		public static function execute($obj)
		{
			global $fmTib_mres;
			DevS\cache::c('fmTIB')->tib = $obj;
			DevS\cache::c('fmTIB->listBox1')->items->clear();
			DevS\cache::c('fmTIB->image1')->picture->clear();
			master_TIB::tib_update_list();
			if( count($obj->images) >= $obj->state)
			{
				DevS\cache::c('fmTIB->listBox1')->itemIndex = $obj->state;	
				master_TIB::tib_update_img();
			}
			DevS\cache::c('fmTIB')->showModal();
			DevS\cache::c('fmTIB')->tib = false;
			return $fmTib_mres;
		}
	}