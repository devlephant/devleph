<?php

define('THB_BITMAP', 0x0001);
define('THB_ICON', 0x0002);
define('THB_TOOLTIP', 0x0004);
define('THB_FLAGS', 0x0008);
define('THBF_ENABLED', 0x0000);
define('THBF_DISABLED', 0x0001);
define('THBF_DISMISSONCLICK', 0x0002);
define('THBF_NOBACKGROUND', 0x0004);
define('THBF_HIDDEN', 0x0008);
define('THBF_NONINTERACTIVE', 0x10);
define('THBN_CLICKED', 0x1800);
define('TBPF_NOPROGRESS', 0); 
define('TBPF_INDETERMINATE', 0x1); 
define('TBPF_NORMAL', 0x2); 
define('TBPF_ERROR', 0x4); 
define('TBPF_PAUSED', 0x8); 
define('TBATF_USEMDITHUMBNAIL', 0x1); 
define('TBATF_USEMDILIVEPREVIEW', 0x2); 

Class TThumbButton {
    public $dwMask  = null;	# DWORD
    public $iId     = null;	# UINT
    public $iBitmap = null;	# UINT
    public $hIcon   = null;	# HICON
	public $szTip   = null;	# WCHAR = 260
    public $dwFlags = null;	# DWORD
}

class TThumbButtonArray {
	public $Value = [];
	
	public function add(TThumbButton $elm1,
						TThumbButton $elm2 = null, TThumbButton $elm3 = null,
						TThumbButton $elm4 = null, TThumbButton $elm5 = null,
						TThumbButton $elm6 = null, TThumbButton $elm7 = null) {
		if( count($this->Value) >= 7 ) {
			return false;
		}

		foreach (func_get_args() as $v) {
			if(count($this->Value) >= 7) break;
			
			$this->Value[] = $v;
		}
		return true;
	}
	
	public function Rem($idx) {
		if(array_key_exists($idx, $this->Value)) {
			unset($this->Value[$idx]);
			return false;
		}
		return false;
	}
	
	public function GetElm($idx) {
		if(array_key_exists($idx, $this->Value)) {
			return $this->Value[$idx];
		} else 
			return false;
	}
	
	public function ToArray() { 
		$ListBtn = [];
		$i = 0;
		foreach($this->Value as $v) {
			if($v->dwMask !== null)	 $ListBtn[$i]['dwmask']	 = $v->dwMask;
			if($v->iId !== null)	 $ListBtn[$i]['iid']	 = $v->iId;
			if($v->iBitmap !== null) $ListBtn[$i]['ibitmap'] = $v->iBitmap;
			if($v->hIcon !== null)	 $ListBtn[$i]['hicon']	 = $v->hIcon;
			if($v->szTip !== null)	 $ListBtn[$i]['sztip']	 = $v->szTip;
			if($v->dwFlags !== null) $ListBtn[$i]['dwflags'] = $v->dwFlags;
			$i++;
		}
		return $ListBtn;
	}
}



Class TWinTaskbar {
    public $Self = 0;
	public $ApplicationHandle;
	public $RPosition = 0;
	public $RMaxPosition = 0;

    function __construct($ApplicationHandle = 0){
		$this->Self = TWinTaskbarCreate();
		if($ApplicationHandle == 0)
			$ApplicationHandle = application_prop('handle', null);
		
		$this->SetApplicationHandle($ApplicationHandle);
		
        $this->SetProgressValue($this->RPosition, $this->RMaxPosition);
    }
	
	public function __set($name, $value) {
		switch(strtolower($name)) {
			case 'position':
				$pos = (int)trim($value);


				
				$this->SetProgressValue($pos, $this->RMaxPosition);
			break;
			
			case 'maxposition':
				$this->RMaxPosition = (int)trim($value);
			break;
		}
	}
	
    public function __get($name) {
		switch(strtolower($name)) {
			case 'position':
				return $this->RPosition;
			break;
			
			case 'maxposition':
				return $this->RMaxPosition;
			break;
		}
	}
	
	
	public function IsCreate() {
		if ($this->Self == 0) {
			$this->Self = TWinTaskbarCreate();
		}		
		
		if ($this->ApplicationHandle == 0) {
			$this->ApplicationHandle = $this->MainWindow();
		}
		
		return $this->Self <> 0;
	}

	function SetApplicationHandle($ApplicationHandle) {
		$this->ApplicationHandle = is_numeric($ApplicationHandle) ? $ApplicationHandle : 0;
		return $this->IsCreate() ? $this->MainWindow($this->ApplicationHandle) : false;
	}
	
	public function WMCommandApplication($CallBackName) {
		return $this->IsCreate() ? WMCommandApplication($this->MainWindow(), $CallBackName) : false;
	}
	
    public function ActivateTab($AHwnd) {
		return $this->IsCreate() ? TBActivateTab($this->Self, $AHwnd) : false;
    }
	
    public function AddTab($AHwnd) {
		return $this->IsCreate() ? TBAddTab($this->Self, $AHwnd) : false;
    }
    public function DeleteTab($AHwnd) {
		return $this->IsCreate() ? TBDeleteTab($this->Self, $AHwnd) : false;
    }
	
    public function SetActiveAlt($AHwnd) {
		return $this->IsCreate() ? TBSetActiveAlt($this->Self, $AHwnd) : false;
    }

    //ITaskBarList2
    public function MarkFullscreenWindow($AHwnd, $AFullscreen) {
		return $this->IsCreate() ? TBMarkFullscreenWindow($this->Self, $AFullscreen) : false;
		
    }

    //ITaskBarList3
    public function RegisterTab($ATabHandle) {
		return $this->IsCreate() ? TBRegisterTab($this->Self, $ATabHandle) : false;
    }
	
    public function SetOverlayIcon($AIcon, $ADescription) {
		return $this->IsCreate() ? TBSetOverlayIcon($this->Self, $AIcon, $ADescription) : false;
    }

    public function SetProgressState($AState) {
		if ($this->IsCreate()) {
			TBSetProgressState($this->Self, $this->MainWindow(), TBPF_NOPROGRESS);
			TBSetProgressState($this->Self, $this->MainWindow(), $AState);	
			if($AState <> TBPF_INDETERMINATE) {
				$this->SetProgressValue($this->RPosition, $this->RMaxPosition);
			} else {
				$this->RPosition = 0;
			}
		} else 
			return false;
    }
	
    public function SetProgressValue($ACompleted, $ATotal) {
		if ($this->IsCreate()) {
			if($this->RMaxPosition < $ACompleted) {
				while(!($this->RMaxPosition == $ACompleted)) {
					--$ACompleted;
				}
			}
			
			if(($ACompleted < 0) and (($this->RPosition - $ACompleted) > 0)) {
				$ACompleted = 0;
			}
			
			$this->RPosition = $ACompleted;
			return TBSetProgressValue($this->Self, $this->MainWindow(), $ACompleted, $ATotal);			
		} else 
			return false;

    }
	
    public function SetTabActive($AHwndTab) {
		return $this->IsCreate() ? TBSetTabActive($this->Self, $AHwndTab) : false;
    }
	
    public function SetTabOrder($AHwndTab, $AHwndInsertBefore = 0) {
		return $this->IsCreate() ? TBSetTabOrder($this->Self, $AHwndInsertBefore) : false;
    }

    public function SetThumbnailClip(TRect $AClipRect) {
		if ($this->IsCreate()) {
			$arrAClipRect = [];
			if($AClipRect->Left !== null)	 $arrAClipRect['left']	 = $AClipRect->Left;
			if($AClipRect->Top !== null)	 $arrAClipRect['top']	 = $AClipRect->Top;
			if($AClipRect->Right !== null)	 $arrAClipRect['right']	 = $AClipRect->Right;
			if($AClipRect->Bottom !== null)	 $arrAClipRect['bottom'] = $AClipRect->Bottom;
			
			return TBSetThumbnailClip($this->Self, $this->MainWindow(), $arrAClipRect);			
		} else 
			return false;

    }
	
    public function ClearThumbnailClip() {
		return $this->IsCreate() ? TBClearThumbnailClip($this->Self, $this->MainWindow()) : false;
    }
	
    public function SetThumbnailTooltip($ATip) {
		return $this->IsCreate() ? TBSetThumbnailTooltip($this->Self, $this->MainWindow(), $ATip) : false;
    }
	
    public function ClearThumbnailTooltip() {
		return $this->IsCreate() ? TBClearThumbnailTooltip($this->Self) : false;
    }
	
    public function ThumbBarAddButtons(TThumbButtonArray $AButtonList) {
		if ($this->IsCreate() and (!empty($AButtonList->Value))) {
			return TBThumbBarAddButtons($this->Self, $AButtonList->To[], $this->MainWindow());			
		} else 
			return false;
    }
	
    public function ThumbBarSetImageList($AImageList) {
		return $this->IsCreate() ? TBThumbBarSetImageList($this->Self, $this->MainWindow(), $AImageList) : false;
    }
	
    public function ThumbBarUpdateButtons(TThumbButtonArray $AButtonList) {
		if ($this->IsCreate() and (!empty($AButtonList->Value))) {
			return TBThumbBarUpdateButtons($this->Self, $AButtonList->To[], $this->MainWindow());
		} else 
			return false;
    }
	
    public function UnregisterTab($AHwndTab) {
		return $this->IsCreate() ? TBUnregisterTab($this->Self, $AHwndTab) : false;
    }
 
    //ITaskBarList4
    public function SetTabProperties($AHwndTab, $AStpFlags) {
		return $this->IsCreate() ? TBSetTabProperties($this->Self, $AHwndTab, $AStpFlags) : false;
    }

    public function LastError() {
		return $this->IsCreate() ? TBLastError($this->Self) : false;
    }
    
    public function MainWindow($handle = null) {
		if ($this->IsCreate()) {
			if($handle === null)
				return TBMainWindow($this->Self);
			else 
				return TBMainWindow($this->Self, $handle);			
		} else 
			return false;

    }
}