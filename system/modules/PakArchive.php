<?
class PakArchive extends TComponent{
	private $__pak_file;
	private $settings;
	private $files;
	private $__xnow;
	private $__pnow;
	private $files_add;

	public $gz_level;
	public $archive;
public function __construct($pak, $method = PAK_OPEN_CREATE ){
		$this->__xnow = $this->__pnow = 0;
		$this->gz_level = 6;
		$this->archive = array();
		$this->files_add = array();
		$this->files = array();
		if($method == PAK_OPEN_CREATE){
			if( file_exists($pak) ){
				$this->___open($pak);
			}else{
				$this->___create($pak);
			}
		}
		if( $method == PAK_OPEN){ if(file_exists($pak)){ $this->___open($pak); } }
		if( $method == PAK_CREATE){ $this->___create($pak); };
	}


	private function aes128_en($decrypted, $password, $salt='!kQm*fF3pXe1Kbm%9') {
		$key = hash('SHA256', $salt . $password, true);
		srand(); $iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC), MCRYPT_RAND);
		if (strlen($iv_base64 = rtrim(base64_encode($iv), '=')) != 22) return false;
		$encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $decrypted . md5($decrypted), MCRYPT_MODE_CBC, $iv));
		return $iv_base64 . $encrypted;
	}

	private function aes128_de($encrypted, $password, $salt='!kQm*fF3pXe1Kbm%9') {
		$key = hash('SHA256', $salt . $password, true);
		$iv = base64_decode(substr($encrypted, 0, 22) . '==');
		$encrypted = substr($encrypted, 22);
		$decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, base64_decode($encrypted), MCRYPT_MODE_CBC, $iv), "\0\4");
		$hash = substr($decrypted, -32);
		$decrypted = substr($decrypted, 0, -32);
		if (md5($decrypted) != $hash) return false;
		return $decrypted;
	}


	public function setDoBase64($v){ $this->settings['base64'] = $v; }
	public function setDoGz($v){ $this->settings['gz'] = $v; }
	public function setDoBz($v){ $this->settings['bz'] = $v; }
	public function setDoAes128($v){ $this->settings['aes128'] = $v; }
	public function setDoSerialize($v){ $this->settings['serialize'] = $v; }
	public function setStoreFileSize($v){ $this->settings['fileinfo'] = $v; }
	public function setDoPackSettings($v){ $this->settings['pack_settings'] = $v; }
	public function setSettings($array){ $this->settings = $array; }
	private function ___create($pak){
		$this->files = array();
		$this->settings = array('base64'=>0, 'bz'=>0, 'gz'=>0, 'aes128'=>0, 'serialize'=>1, 'fileinfo'=>1, 'pack_settings'=>1);
		file_put_contents($pak, serialize( array( 'files'=>array(), 'settings'=>$this->settings) ) );
		$this->__pak_file = realpath($pak);
	}

	private function ___open($pak){
		$err_s = err_status();
		if($err_s){	err_no();	};
		$arr = unserialize( file_get_contents($pak) );
		if( !$arr ){ $arr = unserialize( gzuncompress(file_get_contents($pak)) ); };
		if($err_s){	err_yes();	};
				if($arr['settings']){
					$this->files = $arr['files'];
					$this->settings = $arr['settings'];
				}else{ $this->files = $arr; };

				$this->__pak_file = $pak;
	}

	public function Unpack_file($name=null, $folder, $password=null){
		if($this->settings['serialize'] && $this->files[0]['name']){
			if($name==null or !$name or $name==false or $name==nil){	$data = $this->files[$this->__xnow]['data']; $name = $this->files[$this->__xnow]['name'];$this->__xnow += 1;	}else{ foreach($this->files as $file ){ if($file['name'] == $name){$data=$file['data'];} }; };
			if($this->settings['base64'] == 1){	$data = base64_decode($data);	};
			if($this->settings['bz'] == 1){	$data = gzuncompress($data);	};
			if($this->settings['gz'] == 1){	$data = bzuncompress($data);	};
			if($this->settings['aes128'] == 1){	$data = $this->aes128_de($data, $password);	};
			file_put_contents($folder.'/'.$name, $data);
			if(file_exists($folder.'/'.$name)){	return True;	}else{ return False;	};
		}
	}

	public function Add_file($file){
		if(file_exists($file)){
			$this->files_add[basename($file)] = array('name'=>basename($file), 'adress'=>$file, 'size'=>filesize($file));
			return True;
		}else{
			return False;
		}
	}
	public function Rename_File($name, $new_name){
		if($this->files_add[$name]){
			if( strpos($this->files_add[$name]['name'],'/') ){
				$aso = explode('/', $this->files_add[$name]['name']);
				$this->files_add[$name]['name'] = str_ireplace($aso[count($aso)-1], $new_name, $this->files_add[$name]['name']);
			}else{
				$this->files_add[$name]['name'] = $new_name;
			};
			return True;
		}
		return False;
	}
	
	public function Delete_File($name){
		if($this->files_add[$name] or $this->files[$name]){
			unset($this->files_add[$name]);
			unset($this->files[$name]);
			return True;
		}else{
			return False;
		};
		
	}
	
	public function Add_folder($folder, $pfix=null){
		dir_search($folder, $finded, '', 1, 1);
		foreach($folder as $file){
			if(is_file($file)){ $this->files_add[$pfix.basename($folder).'/'.basename($file)] = array('name'=>$pfix.basename($folder).'/'.basename($file), 'adress'=>$file, 'size'=>filesize($file)); }else{
				if(is_dir($file)){ Add_folder($file, basename($folder).'/');};
			};
		}
		return True;
	}
	public function getFilesCount($mode=0){
		if(!$mode){
			return count($this->files_add);
		}else{
			return count($this->files);
		}
	}
	public function getPercent($mode=PER_PACK){
		if($mode==PER_PACK){	$per = $this->__xnow; $per2 = $this->getFilesCount(1);	};
		if($mode==PER_UNPACK){	$per = $this->__pnow; $per2 = $this->getFilesCount(0);	};
		$pdel = '1';
		for($i=0;$i<strlen($per);$i++){ $pdel .= '0'; }
		return $per2 / $pdel;
	}
	public function Pack_file(){
		foreach($this->files_add as $file_g){	$re_a[] = $file_g;	}
		$this->files_add = $re_a;
		if($this->settings['serialize'] && $this->files_add[0]['name']){
			$file = $this->files_add[$this->__pnow]; $this->__pnow += 1;
			if($this->settings['pack_settings'] == 1 && $this->settings['serialize'] == 1){	$this->archive['settings'] = $this->settings;	};

			$data = file_get_contents($file['adress']);
			$name = $file['name'];
			$size = $file['size'];

			if($this->settings['base64'] == 1){	$data = base64_encode($data);	};
			if($this->settings['bz'] == 1){	$data = gzcompress($data, $this->gz_level);	};
			if($this->settings['gz'] == 1){	$data = bzcompress($data);	};
			if($this->settings['aes128'] == 1){	$data = $this->aes128_en($data, $password);	};

			if($this->settings['serialize'] == 1 and $this->settings['fileinfo'] == 1){	$res = array('name'=>$name, 'data'=>$data, 'size'=>size);	}else{	$res = array('name'=>$name, 'data'=>$data);	}
			if($this->settings['pack_settings'] == 1){
			$this->archive['files'][] = $res;
			}else{ $this->archive[] = $res; };
			Return True;
		}else{	Return False;	};
	}
	public function savePak($gz=false){
		$filename = $this->__pak_file;
		if($this->archive){
		if( file_exists($filename) ){ if(!confirm("File '".basename($filename)."' already exists.\r\nReplace?")){return False;} };
		if( $this->settings['serialize'] ){
			if($gz){ file_put_contents( $filename, gzcompress( serialize($this->archive), $this->gz_level)); }else{ file_put_contents( $filename, serialize($this->archive)); };
		}else{
			if($this->settings['pack_settings']){
				$settings = '$settings = array(
							"base64"=>'.$this->settings['base64'].',
							"bz"=>'.$this->settings['bz'].',
							"gz"=>'.$this->settings['gz'].',
							"aes128"=>'.$this->settings['aes128'].',
							"serialize"=>'.$this->settings['serialize'].',
							"fileinfo"=>'.$this->settings['fileinfo'].',
							"pack_settings"=>'.$this->settings['pack_settings'].',
							);';
			}

			$files = $settings._BR_.'$files = array(';
			$xn=0;

			foreach($this->archive['files'] as $file2){
				$files .= '"'.$xn.'"=>array(
							"name"=>"'.$file2['name'].'",';
							if($this->settings['fileinfo']){
								$files .= '		"size"=>"'.$file2['size'].'",';
							}
				$files .= '"data"=>"'.base64_encode($file2['data']).'",
							),';
				$xn++;
			}
				$files .= '
				);';
			if($gz){ file_put_contents($filename, gzcompress($files, $this->gz_level) ); }else{ file_put_contents($filename, $files); }
		 }
		}
		if( file_exists($filename) ){return True;}else{ return False; };
	}

	public function Get_file($name){
		if($this->files[$name]){
			return $this->files[$name]['data'];
		}else{ return False; };
	}

}
?>