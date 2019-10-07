<?

class myOptions {
    
    static function get($section, $name, $def = null)
	{
         return (isset($GLOBALS['ALL_CONFIG'][$section][$name]))? $GLOBALS['ALL_CONFIG'][$section][$name]: $def;
    }
    
    static function set($section, $name, $value){
        
        if ( is_object($value) )
		{
            $value = base64_encode(serialize($value));
        }  
        $GLOBALS['ALL_CONFIG'][$section][$name] = $value;
    }
    
    static function setXYWH($section, $obj){
        
        myOptions::set($section,'x', $obj->x);
        myOptions::set($section,'y', $obj->y);
        myOptions::set($section,'w', $obj->w);
        myOptions::set($section,'h', $obj->h);
    }
    
    static function getXYWH($section, $obj, $def = false){
        if( !is_object($obj) ) return;
        if ($def && myOptions::get($section,'x', null)===null){
            
            if (is_array($def)){
                $obj->x = $def[0];
                $obj->y = $def[1];
                $obj->w = $def[2];
                $obj->h = $def[3];
            }
        } else {
            
            $obj->x = myOptions::get($section,'x', $obj->x);
            $obj->y = myOptions::get($section,'y', $obj->y);
            $obj->w = myOptions::get($section,'w', $obj->w);
            $obj->h = myOptions::get($section,'h', $obj->h);
        }
    }
    
    static function setFloat($section, $obj){
        
        //self::setXYWH($section, $obj);
        myOptions::set($section,'x', control_dockleft($obj->self));
        myOptions::set($section,'y', control_docktop($obj->self));
        myOptions::set($section,'w', control_dockwidth($obj->self));
        myOptions::set($section,'h', control_dockheight($obj->self));
    }
    
    static function getFloat($section, $obj){
        
        $x = myOptions::get($section, 'x', 100);
        $y = myOptions::get($section, 'y', 100);
        $w = myOptions::get($section, 'w', $obj->w);
        $h = myOptions::get($section, 'h', $obj->h);
        
        $x = $x - GetSystemMetrics(32);
        $y = $y - GetSystemMetrics(SM_CYSMCAPTION) - GetSystemMetrics(32);
        
        $obj->manualFloat($x,$y, $x+$w, $y+$h);
    }
    
    static function PHPModules(){
        
        global $myProject, $projectFile;
        $form = DevS\cache::c('fmPHPModules');
        $list = DevS\cache::c('fmPHPModules->list');
        $list->clear();
        
        $modules = findFiles(SYSTEM_DIR . '/../ext/','dll');
        
        $list->items->setArray($modules);
        $list->checkedItems = (array)$myProject->config['modules'];   
        
        if ($form->showModal()==mrOk){
            
            
            $myProject->config['modules'] = $list->checkedItems;
            
            myModules::clear();
            myModules::inc();
            
        }
    }
    
    static function ProjectOptions(){
        
        global $myProject, $projectFile;
        
        $list = DevS\cache::c('fmProjectOptions->list');
        $list->clear();
        
        $modules = findFiles(SYSTEM_DIR . '/../ext/','dll');
        
        $list->items->setArray($modules);
        $list->checkedItems = (array)$myProject->config['modules'];   
        
        DevS\cache::c('fmProjectOptions->c_debugmode')->checked = $myProject->config['debug']['enabled'];
        DevS\cache::c('fmProjectOptions->c_ignorewarnings')->checked = $myProject->config['debug']['no_warnings'];
        DevS\cache::c('fmProjectOptions->c_ignoreerrors')->checked = $myProject->config['debug']['no_errors'];
        
        DevS\cache::c('fmProjectOptions->c_programtype')->itemIndex = (int)$myProject->config['prog_type'];
        
        DevS\cache::c('fmProjectOptions->e_apptitle',1)->text    = $myProject->config['apptitle'];
        DevS\cache::c('fmProjectOptions->e_programname',1)->text = basenameNoExt($projectFile);
         
			global $projectFile;
		if(!file_exists(dirname($projectFile).'/c_php.ini')) copy( dirname(EXE_NAME) . '/core/c_php.ini', dirname($projectFile).'/c_php.ini');
		
        DevS\cache::c('fmProjectOptions->phmemo')->text = file_get_contents(dirname($projectFile).'/c_php.ini');
        if (DevS\cache::c('fmProjectOptions')->showModal() == mrOk){
            
            file_put_contents(dirname($projectFile).'/c_php.ini', DevS\cache::c('fmProjectOptions->phmemo')->text);
            $myProject->config['debug']['enabled'] = DevS\cache::c('fmProjectOptions->c_debugmode')->checked;
            $myProject->config['debug']['no_warnings'] = DevS\cache::c('fmProjectOptions->c_ignorewarnings')->checked;
            $myProject->config['debug']['no_errors'] = DevS\cache::c('fmProjectOptions->c_ignoreerrors')->checked;
            $myProject->config['prog_type'] = DevS\cache::c('fmProjectOptions->c_programtype')->itemIndex;
            
            $myProject->config['apptitle'] = DevS\cache::c('fmProjectOptions->e_apptitle')->text;
			$prLast = $projectFile;
            $projectFile = dirname($projectFile) . '/' . DevS\cache::c('fmProjectOptions->e_programname')->text . '.msppr';
            if( $prLast !== $projectFile ){
				unlink(	dirname($prLast) . '/' . basenameNoExt($prLast) . '.cfg'		);
				unlink(	dirname($prLast) . '/' . basenameNoExt($prLast) . '.events'		);
				unlink(	dirname($prLast) . '/' . basenameNoExt($prLast) . '.inf'		);
				/*
				unlink(	dirname($prLast) . '/' . basenameNoExt($prLast) . '.exe'		);
				*/
				unlink(	$prLast	);
			}
            $myProject->config['modules'] = $list->checkedItems;

            myProject::save();
            DevS\cache::c("fmMain->statusBar")->caption = " ".replaceSr($projectFile);
			treeBwr_add();
        }
    }
    
    
    static function saveExeDialog(){
        
        $dlg = new TSaveDialog;
        $dlg->filter = 'EXE File (*.exe)|*.exe';
        
        if ($dlg->execute()){
                
            $dlg->fileName = fileExt($dlg->fileName)=='exe' ? $dlg->fileName : $dlg->fileName . '.exe';
            
            if (file_exists($dlg->fileName))
                msg(t('WARNING: File %s exists!',$dlg->fileName));
            
            DevS\cache::c('fmBuildProgram->path')->text = $dlg->fileName;
        }
        
        $dlg->free();
		DevS\cache::c('fmProjectOptions')->toFront();
	}
    
    static function openIconDialog(){
        
        $dlg = new TOpenDialog;
        $dlg->filter = 'Icon files (*.ico)|*.ico';
        
        if ($dlg->execute()){
            
            DevS\cache::c('fmBuildProgram->im_icon')->picture->loadFromFile($dlg->fileName);
            myVars::set($dlg->fileName, '__iconFile');
        }
		$dlg->free();
		DevS\cache::c('fmProjectOptions')->toFront();
    }
    
    static function saveSettings(){
        
        global $projectFile;
        
        $file = dirname($projectFile).'/build.cfg';
        $ini  = new TIniFileEx($file);
        $ini->write('main','path', c('fmBuildProgram->path')->text);
        $ini->write('main','attachphp', c('fmBuildProgram->c_attachphp')->checked);
        $ini->write('main','attachsoulengine',c('fmBuildProgram->c_attachsoulengine')->checked);
        $ini->write('main','attachdata', c('fmBuildProgram->c_attachdata')->checked);
        $ini->write('main','upx_level', c('fmBuildProgram->c_upx')->itemIndex);
        $ini->write('main','company', c('fmBuildProgram->e_companyname')->text);
        $ini->write('main','version', c('fmBuildProgram->e_version')->text);
        $ini->write('main','c_compress', c('fmBuildProgram->c_compress')->checked);
        $fileIco = SYSTEM_DIR . '/project_parts/project.ico';
        if (file_exists($GLOBALS['__iconFile'])){
            
            x_copy($GLOBALS['__iconFile'], dirname($projectFile).'/icon.ico');
            $ini->write('main', 'icon', dirname($projectFile).'/icon.ico');
        }
        
        $ini->updateFile();
    }
    
    static function loadSettings(){
        
        global $projectFile;
        
        $file = dirname($projectFile).'/build.cfg';
        $ini  = new TIniFileEx($file);
        $path = dirname($projectFile).'/build/'.basenameNoExt($projectFile).'.exe';
        
        DevS\cache::c('fmBuildProgram->path')->text = $ini->read('main','path', $path);
        DevS\cache::c('fmBuildProgram->c_attachphp')->checked = $ini->read('main','attachphp', true);
        DevS\cache::c('fmBuildProgram->c_attachsoulengine')->checked = $ini->read('main','attachsoulengine',true);
        DevS\cache::c('fmBuildProgram->c_attachdata')->checked = $ini->read('main','attachdata', true);
        DevS\cache::c('fmBuildProgram->c_upx')->itemIndex = $ini->read('main','upx_level', 0);
        DevS\cache::c('fmBuildProgram->e_companyname')->text = $ini->read('main','company', '');
        DevS\cache::c('fmBuildProgram->e_version')->text = $ini->read('main','version', '1.0.0.0');
        DevS\cache::c('fmBuildProgram->c_compress')->checked = $ini->read('main','c_compress', false);
        $iconFile = $ini->read('main', 'icon', '');
        if ($iconFile){
            DevS\cache::c('fmBuildProgram->im_icon')->picture->loadFromFile($iconFile);
            myVars::set($iconFile, '__iconFile');    
        }
    }
    
    static function BuildProgram(){
        
        DevS\cache::c('fmBuildProgram->btn_path')->onClick = 'myOptions::saveExeDialog';
        DevS\cache::c('fmBuildProgram->btn_icon')->onClick = 'myOptions::openIconDialog';
        DevS\cache::c('fmBuildProgram->btn_savesettings')->onClick = function($self){
            myOptions::saveSettings();
            message_beep(66);
        };
        
        
        self::loadSettings();
        
        if (DevS\cache::c('fmBuildProgram')->showModal() == mrOk){
            
            /*if (!is_writable(replaceSl(DevS\cache::c('fmBuildProgram->path')->text))){
            
                msg(t('Please, select correct path for your program!'));
                self::BuildProgram();
                return;
            }*/
            
            self::saveSettings();
            myCompile::adv_start(
                                DevS\cache::c('fmBuildProgram->path')->text,
								DevS\cache\ c('fmBuildProgram->c_attachphp')->checked,
                                DevS\cache::c('fmBuildProgram->c_attachsoulengine')->checked,
                                DevS\cache::c('fmBuildProgram->c_attachdata')->checked,
                                DevS\cache::c('fmBuildProgram->c_upx')->itemIndex,
                                DevS\cache::c('fmBuildProgram->e_companyname')->text,
                                DevS\cache::c('fmBuildProgram->e_version')->text,
                                /* DevS\cache\('fmBuildProgram->e_filedescription')->text */ '',
								DevS\cache::c('fmBuildProgram->c_compress')->checked,
                                 myVars::get('__iconFile')
                                );
            
            if (false && dsErrorDebug::getLastMsg()){
            
                msg(t('Please, select correct path for your program!'));
                self::BuildProgram();
                return;
            }
            
            message_beep(66);
            DevS\cache::c('fmBuildCompleted->e_filename')->text = DevS\cache::c('fmBuildProgram->path')->text;
            DevS\cache::c('fmBuildCompleted')->showModal();
        }
    }
    
    
    
    static function Options(){
        
        global $_sc;
        DevS\cache::c('fmOptions->c_showgrid')->checked = (bool)myOptions::get('sc','showGrid',false);
        DevS\cache::c('fmOptions->e_gridsize')->text    = c('fmOptions->up_gridsize')->position = (int)myOptions::get('sc','gridSize',8);
		DevS\cache::c('fmOptions->e_fs')->text = c("fmOptions->up_fs")->position = (int)myOptions::get('sc', 'offset', 8);
		DevS\cache::c('fmOptions->cb_penstyle')->itemIndex = (int)myOptions::get('sc','SizerPenStyle',2);
		DevS\cache::c('fmOptions->backup_active')->checked = (bool)myOptions::get('backup','active',true);
		DevS\cache::c('fmOptions->delete_exefile')->checked = (bool)myOptions::get('delete_exefile','active',false);
		DevS\cache::c('fmOptions->en_bc')->brushColor = myOptions::get('sc','BtnColor',clBlue);
		DevS\cache::c('fmOptions->dis_bc')->brushColor = myOptions::get('sc','DisabledBtnColor', clGray);
		DevS\cache::c('fmOptions->sel_color')->brushColor = myOptions::get('sc','SelectColor', clBlack);
		DevS\cache::c('fmOptions->en_bc')->penColor = myOptions::get('sc','pEn',clBlack);
		DevS\cache::c('fmOptions->dis_bc')->penColor = myOptions::get('sc','pDis', clBlack);
		DevS\cache::c('fmOptions->scol_inn')->brushColor = myOptions::get('sc','SizerInnerColor', 12632256);
		DevS\cache::c('fmOptions->scol_out')->brushColor = myOptions::get('sc','SizerOuterColor', clBlack);
		DevS\cache::c('fmOptions->scol_inn')->penColor = myOptions::get('sc','pSin',clBlack);
		DevS\cache::c('fmOptions->scol_out')->penColor = myOptions::get('sc','pSout', clBlack);
		DevS\cache::c('fmOptions->sel_color')->penColor = myOptions::get('sc','pSel', 12615808);
		DevS\cache::c('fmOptions->backup_dir')->text = (string)myOptions::get('backup','dir','backup');
		DevS\cache::c('fmOptions->backup_count')->text = c('fmOptions->up_bcnt')->position = (int)myOptions::get('backup','count',3);
		DevS\cache::c('fmOptions->backup_interval')->text = c('fmOptions->up_bint')->position = (int)myOptions::get('backup','interval',2);
		DevS\cache::c('fmOptions->lb_themes')->text = implode(_BR_, findDirs(DOC_ROOT.'design/theme/'));
        
        if (DevS\cache::c('fmOptions')->showModal() == mrOk){
            
            
            myOptions::set('sc','showGrid', DevS\cache::c('fmOptions->c_showgrid')->checked);
			myOptions::set('backup','active', DevS\cache::c('fmOptions->backup_active')->checked);
			myOptions::set('delete_exefile','active', DevS\cache::c('fmOptions->delete_exefile')->checked);
			
			$dir = DevS\cache::c('fmOptions->backup_dir')->text;
			if ( !preg_match('/$([.\-\_a-zа-яА-Я0-9]+)/i', $dir) )
				$dir = 'backup';
		
				myOptions::set('backup','dir', $dir);
				myOptions::set('backup','interval', (int)DevS\cache::c('fmOptions->backup_interval')->text);
				myOptions::set('backup','count', (int)DevS\cache::c('fmOptions->backup_count')->text);
			
                myOptions::set('sc','gridSize', (int)DevS\cache::c('fmOptions->e_gridsize')->text);
				myOptions::set('sc','SizerPenStyle', DevS\cache::c('fmOptions->cb_penstyle')->itemIndex);	
				myOptions::set('sc','BtnColor', DevS\cache::c('fmOptions->en_bc')->brushColor);
				myOptions::set('sc','DisabledBtnColor', DevS\cache::c('fmOptions->dis_bc')->brushColor);
				myOptions::set('sc','SelectColor', DevS\cache::c('fmOptions->sel_color')->brushColor);
				
				$_sc->MovePanelCanvas->brush->color = DevS\cache::c('fmOptions->scol_inn')->brushColor;
				$_sc->MovePanelCanvas->pen->color = DevS\cache::c('fmOptions->scol_out')->brushColor;
				$_sc->MovePanelCanvas->pen->style = DevS\cache::c('fmOptions->cb_penstyle')->itemIndex;
				
				myOptions::set('sc', 'SizerInnerColor', (int)DevS\cache::c('fmOptions->scol_inn')->brushColor);
				myOptions::set('sc', 'SizerOuterColor', (int)DevS\cache::c('fmOptions->scol_out')->brushColor);
				myOptions::set('sc','pEn',  DevS\cache::c('fmOptions->en_bc')->penColor);
				myOptions::set('sc','pDis', DevS\cache::c('fmOptions->dis_bc')->penColor);
				myOptions::set('sc','pSel', DevS\cache::c('fmOptions->sel_color')->penColor);
				myOptions::set('sc','pSin', DevS\cache::c('fmOptions->scol_inn')->penColor);
				myOptions::set('sc','pSout', DevS\cache::c('fmOptions->scol_out')->penColor);
				myOptions::set('sc', 'offset', (int)DevS\cache::c('fmOptions->e_fs')->text);
				$GLOBALS['sc_offset'] = (int)DevS\cache::c('fmOptions->e_fs')->text;		
				myBackup::updateSettings();	
        } else {
			global $fmEdit;
			$_sc->BtnColor = myOptions::get('sc','BtnColor',clBlue);
			$_sc->DisabledBtnColor = myOptions::get('sc','DisabledBtnColor',clGray);
			$_sc->showGrid = (bool)myOptions::get('sc','showGrid',false);
			$_sc->gridSize = (int)myOptions::get('sc','gridSize',8);
			$GLOBALS['sc_offset'] = (int)myOptions::get('sc', 'offset', 8);
			$obj = DevS\cache::c("fmMain->shapeSize");
			$obj->w = $fmEdit->w + $GLOBALS['sc_offset'] * 2;
			$obj->h = $fmEdit->h + $GLOBALS['sc_offset'] * 2;
			$fmEdit->x = $obj->x + $GLOBALS['sc_offset'];
			$fmEdit->y = $obj->y + $GLOBALS['sc_offset'];
			DevS\cache::c('fmMain->shapeSize')->penStyle = myOptions::get('sc','SizerPenStyle',2);
			DevS\cache::c('fmMain->shapeSize')->brushColor = myOptions::get('sc', 'SizerInnerColor', 12632256);
			DevS\cache::c('fmMain->shapeSize')->penColor = myOptions::get('sc', 'SizerOuterColor', clBlack);
			DevS\cache::c('fmOptions->en_bc')->penColor = myOptions::get('sc','pEn',clBlack);
			DevS\cache::c('fmOptions->dis_bc')->penColor = myOptions::get('sc','pDis', clBlack);
			DevS\cache::c('fmOptions->sel_color')->penColor = myOptions::get('sc','pSel', 12615808);
			DevS\cache::c('fmEdit')->repaint();
		}
    }
}

class myRemoveExe {
	public static $timer;
	
	static function setActive($active){
		$delete_exefile = myOptions::get('delete_exefile','active',false);
		if((bool)$active and (bool)$delete_exefile){
			self::$timer = _c(Timer::setInterval('myRemoveExe::doInterval', 5000));
		} elseif((bool)$delete_exefile) {
			self::doInterval();
			Timer::ClearTimer(self::$timer->self);
		}
	}
	
	static function doInterval($self){
		global $projectFile;
		
		$task = basenameNoExt($projectFile);
		if(!exists_task("{$task}.exe")){
			unlink(dirname($projectFile)."/{$task}.exe");
			Timer::ClearTimer(self::$timer->self);
		}
	}
	
}

class myBackup {
	
	public static $timer;
	public static $dir;
	public static $count;
	
	static function doInterval($thks=true){
		
		global $projectFile;
		if ( !preg_match('/$([.\-\_a-zа-яА-Я0-9]+)/i', $projectFile) )
			self::$dir = 'backup';
		
		$dir = dirname($projectFile) .'/'. self::$dir . '/';
		
		if ( !is_dir($dir) )
			mkdir($dir,0777,true);
			
		$file = basenameNoExt($projectFile) . date('(h.i d.m.Y)');
		$from = 0;
		while ( is_file( $dir . $file . $from . '.dvs' ) ) ++$from; 
		
		$src = $dir . $file . $from . '.dvs';
		if(myProject::saveAsDVS($src,$thks) ) myCompile::setStatus('Backup', t('Backup created').date(' ( H:i:s )'));
		$check = $dir . $file .($from - self::$count - 1) . '.dvs';
		
		if ( is_file( $check ) ){
		    unlink( $check );
		}
	}
	
	static function setInterval($min){
		
		if ( $min < 1 )
			$min = 1;
		if( !(bool)myOptions::get('backup','active',true) ) return;
		if(isset(self::$timer) && is_object(self::$timer)){
			self::$timer->interval = $min * 60000;
		} else self::$timer = _c(Timer::setInterval('myBackup::doInterval', $min * 60000));
	}
	
	static function setActive($active){
		if(isset(self::$timer) && is_object(self::$timer))
		{
			if( !$active )
				self::$timer = Timer::ClearTimer(self::$timer->self);
			
		} else if((bool)$active) self::$timer = _c(Timer::setInterval('myBackup::doInterval',  (int)myOptions::get('backup','interval',2) * 60000));
	}
	
	static function updateSettings(){
		global $projectFile, $myProject;
		if($myProject){
        if(file_exists(dirname($projectFile)))
			$cnt = count(findFiles(dirname($projectFile).'/'.$myProject->config['data_dir'].'/','dvs',true,true));
		else $cnt = 3;
        }else $cnt = 3;
		self::setActive( (bool)myOptions::get('backup','active',true) );
		self::setInterval((int)myOptions::get('backup','interval',2) );
		self::$dir = myOptions::get('backup','dir','backup');
		self::$count = (int)myOptions::get('backup','count',$cnt);
	}
	
	static function init()
	{
			if((bool)DevS\cache::c('fmOptions->backup_active')->checked)
				if((bool)myOptions::get('backup','active',true))
					if(!isset(self::$timer)||!is_object(self::$timer))
					{
						self::$timer = _c(Timer::setInterval('myBackup::doInterval', 60000 * (int)myOptions::get('backup','interval',2)));
					}
					else 
					{
						Timer::ClearTimer(self::$timer->self);
						self::$timer = _c(Timer::setInterval('myBackup::doInterval',  (int)myOptions::get('backup','interval',2) * 60000));
					}
	}
}
