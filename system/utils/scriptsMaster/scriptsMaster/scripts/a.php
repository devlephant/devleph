<?

class Ground3D extends TPanel {
    
    public $class_name_ex = __CLASS__;
    public $picture;
    
    public function __construct($onwer=nil,$init=true,$self=nil){
        parent::__construct($onwer, $init, $self);
        if ($init){
			$this->fullscreen = 0;
			$this->Ecamera = 0;
        }        
    }
    
      
    public function __initComponentInfo(){
        parent::__initComponentInfo();
		if($this->dsplash){
			xSetEngineSetting("Splash::TilingTime","0");
			xSetEngineSetting("Splash::AfterTilingTime","0"); 
		}
		$this->UStart($this->fullscreen, $this, $this->caption);
    }

	private function UStart($fullscreen,$form,$caption){
		
	if($fullscreen==0){
		InitUltimate3D($form->handle,0, 0, $form->w, $form->h, 32, 1.0, 0.0, 0, $caption);
		
	}else{
		
		$form->h=$SCREEN->height;
		$form->w=$SCREEN->width;
		$this->InitUltimate3D($form->handle,0, 0, $form->w, $form->h, 32, 1.0, 0.0, 0, $caption);
		$form->formStyle = fsStayOnTop;
		$form->borderStyle = bsNone;
		}
	}
	
	public function keyboard_check($key){
	for($i=0;$i<0xff;$i++){
		$return = 0;
		if(get_key_state($i) < 0){
			if($i==1 && $key=='MOUSE_LEFT'){return $return = 1;break;}
			if($i==2 && $key=='MOUSE_RIGHT'){return $return = 1;break;}
			if($i==27 && $key=='ESC'){return $return = 1;break;}
			if($i==162 || $i==163 && $key=='Ctrl'){return $return = 1;break;}
			if($i==112 && $key=='F1'){return $return = 1;break;}
			if($i==113 && $key=='F2'){return $return = 1;break;}
			if($i==114 && $key=='F3'){return $return = 1;break;}
			if($i==115 && $key=='F4'){return $return = 1;break;}
			if($i==116 && $key=='F5'){return $return = 1;break;}
			if($i==117 && $key=='F6'){return $return = 1;break;}
			if($i==118 && $key=='F7'){return $return = 1;break;}
			if($i==119 && $key=='F8'){return $return = 1;break;}
			if($i==120 && $key=='F9'){return $return = 1;break;}
			if($i==121 && $key=='F10'){return $return = 1;break;}
			if($i==122 && $key=='F11'){return $return = 1;break;}
			if($i==123 && $key=='F12'){return $return = 1;break;}
			if($i==192 && $key=='`'){return $return = 1;break;}
			if($i==48 && $key=='0'){return $return = 1;break;}
			if($i==49 && $key=='1'){return $return = 1;break;}
			if($i==50 && $key=='2'){return $return = 1;break;}
			if($i==51 && $key=='3'){return $return = 1;break;}
			if($i==52 && $key=='4'){return $return = 1;break;}
			if($i==53 && $key=='5'){return $return = 1;break;}
			if($i==54 && $key=='6'){return $return = 1;break;}
			if($i==55 && $key=='7'){return $return = 1;break;}
			if($i==56 && $key=='8'){return $return = 1;break;}
			if($i==57 && $key=='9'){return $return = 1;break;}
			if($i==189 && $key=='-'){return $return = 1;break;}
			if($i==187 && $key=='='){return $return = 1;break;}
			if($i==8 && $key=='Backspace'){return $return = 1;break;}
			if($i==9 && $key=='Tab'){return $return = 1;break;}
			if($i==20 && $key=='CapsLock'){return $return = 1;break;}
			if($i==164 && $key=='Alt'){return $return = 1;break;}
			if($i==32 && $key=='Space'){return $return = 1;break;}
			if($i==165 && $key=='AltGr'){return $return = 1;break;}
			if($i==160 || $i==161 && $key=='Shift'){return $return = 1;break;}
			if($i==13 && $key=='Enter'){return $return = 1;break;}
			if($i==81 && $key=='Q'){return $return = 1;break;}
			if($i==65 && $key=='A'){return $return = 1;break;}
			if($i==90 && $key=='Z'){return $return = 1;break;}
			if($i==87 && $key=='W'){return $return = 1;break;}
			if($i==83 && $key=='S'){return $return = 1;break;}
			if($i==88 && $key=='X'){return $return = 1;break;}
			if($i==69 && $key=='E'){return $return = 1;break;}
			if($i==68 && $key=='D'){return $return = 1;break;}
			if($i==67 && $key=='C'){return $return = 1;break;}
			if($i==82 && $key=='R'){return $return = 1;break;}
			if($i==70 && $key=='F'){return $return = 1;break;}
			if($i==86 && $key=='V'){return $return = 1;break;}
			if($i==84 && $key=='T'){return $return = 1;break;}
			if($i==71 && $key=='G'){return $return = 1;break;}
			if($i==66 && $key=='B'){return $return = 1;break;}
			if($i==89 && $key=='Y'){return $return = 1;break;}
			if($i==72 && $key=='H'){return $return = 1;break;}
			if($i==78 && $key=='N'){return $return = 1;break;}
			if($i==85 && $key=='U'){return $return = 1;break;}
			if($i==74 && $key=='J'){return $return = 1;break;}
			if($i==77 && $key=='M'){return $return = 1;break;}
			if($i==73 && $key=='I'){return $return = 1;break;}
			if($i==75 && $key=='K'){return $return = 1;break;}
			if($i==188 && $key==','){return $return = 1;break;}
			if($i==79 && $key=='O'){return $return = 1;break;}
			if($i==76 && $key=='L'){return $return = 1;break;}
			if($i==80 && $key=='P'){return $return = 1;break;}
			if($i==190 && $key=="."){return $return = 1;break;}
			if($i==186 && $key==";"){return $return = 1;break;}
			if($i==191 && $key=="/"){return $return = 1;break;}
			if($i==191 && $key=="."){return $return = 1;break;}
			if($i==219 && $key=="["){return $return = 1;break;}
			if($i==221 && $key=="]"){return $return = 1;break;}
			if($i==44 && $key=='PrintScreenSysRq'){return $return = 1;break;}
			if($i==145 && $key=='ScrollLock'){return $return = 1;break;}
			if($i==19 && $key=='PauseBreak'){return $return = 1;break;}
			if($i==45 && $key=='lnsert'){return $return = 1;break;}
			if($i==46 || $i==110 && $key=='Delete'){return $return = 1;break;}
			if($i==46 || $i==110 && $key=='Del'){return $return = 1;break;}
		}
	}
	return $return;
	}
	private function InitUltimate3D($q_1, $q_2, $q_3, $q_4, $q_5, $q_6, $q_7, $q_8, $q_9, $q_10){
		$this->x_dll_3D = new DOTNET("dll","dll.myclass");
		$this->x_dll_3D->InitUltimate3D_($q_1, $q_2, $q_3, $q_4, $q_5, $q_6, $q_7, $q_8, $q_9, $q_10);
	}
	
}

?>