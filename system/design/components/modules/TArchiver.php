<?

Class TArchiver extends __TNoVisual{
	public $class_name_ex = __CLASS__;
	public $type;
	public $file;
	static $opened;
	private $Pak;
	private $Zip;
	private $Rar;
	private $fOnOpen;

	
	public function __construct($owner=nil,$init=true,$self=nil){
		parent::__construct($owner,$init,$self);
			if($init){
				$this->type = 'arRar';
				$this->file = false;
				$this->opened = false;
			}
	}

	public function Open($filename, $password=null){
		if(file_exists($filename)){
			$this->file = $filename;
		}
		if($this->file){
			switch($this->type){
				case 'arRar':
                 if(!file_exists($this->file) ){ $met = ZipArchive::CREATE; }else{ $met = null; }
                 $this->rar = RarArchive::open($this->file, $met);
                break;
				case 'arZip': $this->zip = ZipArchive::open ($this->file); break;
				case 'arPak': $this->pak = new PakArchive($this->file, PAK_OPEN_CREATE); break;
			}
			$this->opened = true;
		}
		if($this->rar or $this->zip or $this->pak){ $this->opened = true; return true; }else{ return false; };
	}

	public function Close(){
		if($this->rar){  $this->rar->close(); };
		if($this->pak){	delete($this->pak); };
		if($this->zip){ $this->zip->close(); };
	}
	
	public function Save(){
		if($this->pak){  $this->pak->savePak(); };
		$this->Close();
	}

	public function AddFile($filename){
		if($this->zip){ $this->zip->addFile($filename); };
		if($this->pak){ $this->pak->Add_file($filename); };
		if($this->type == 'arRar' ){ return False; };
		return True;
	}
	
	public function RenameFile($filename, $newname){
		if($this->pak){ $this->pak->Rename_File($filename, $newname); };
		if($this->zip){	$this->zip->renameName ($filename, $newname); };
		if($this->type == 'arRar' ){ return False; };
		return True;

	}
	
	public function DeleteFile($filename){
		if($this->pak){ $this->pak->Delete_File($filename); };
		if($this->zip){	$this->zip->deleteName($filename); };
		if($this->type == 'arRar' ){ return False; };
		return True;

	}
	
	public function ExtractFile($name, $dir, $password=null){
		switch($this->type){
			case 'arRar':
				$ent = $this->rar->getEntry($name);
				$ent->extract( $dir, $password);
			break;
			case 'arZip':
				file_put_contents($dir.'/'.$name, $this->zip->getFromName( $name ) );
			break;
			case 'arPak':
				$this->pak->Unpack_file($name, $dir, $password);
			break;
		}
	}
	public function Extract($dir, $password=null){
		switch($this->type){
			case 'arRar':
				foreach( $this->rar->getEntries as $ent ){
					$ent->extract( $dir, $password);
				}
			break;
			case 'arZip':
				$this->zip->extractTo($dir, $password);
			break;
			case 'arPak':
			for($i=0;$i<=$this->pak->getFilesCount(true)-1;$i++){
				$this->pak->Unpack_file(0, $dir, $password);
			}
			break;
		}
	}
	
	public function Reset($reopen=0){
		if($this->pak){ obj_free($this->pak); };
		if($this->zip){ obj_free($this->zip); };
		if($this->rar){ obj_free($this->rar); };
		if($reopen && $this->file){
			$this->Open($this->file);
		}else{
			$this->file  = false;
		}
	}
	
	public function Free(){
		if($this->pak){ obj_free($this->pak); };
		if($this->zip){ obj_free($this->zip); };
		if($this->rar){ obj_free($this->rar); };
		obj_free($this->self);
	}
}
?>