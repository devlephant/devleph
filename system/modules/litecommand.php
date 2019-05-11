<?

// простые команды... наследие от MSBScript


global $_c;

class app {

    static function hide(){
        
        //thread::func('application_minimize');
        if ( sync('app::hide') ) return;
        
        application_minimize();
    }

    static function close(){
        
        if ( sync('app::close') ) return;
        
        global $mainForm;
        if ( $mainForm )
            $mainForm->close();
        else
            application_terminate();
    }
    
    static function restore(){
        //thread::func('application_restore');
        if ( sync('app::restore') ) return;
        
        application_restore();
    }
    
    static function title($value = null){
        
        if ( sync('app::title', func_get_args()) ) return;
        
        global $APPLICATION;
        if ($value == null)
            return $APPLICATION->title;
        else
            $APPLICATION->title = $value;
    }
}

function run($command, $wait = false){
    
    if ( sync(__FUNCTION__, func_get_args()) ) return;    
    
    $command = getFileName($command);
    $command = replaceSr($command);
    
    if ($wait)
        shell_execute_wait('"'.$command.'"', false, SW_SHOW);
    else
        shell_execute(0, 'open', $command, '', replaceSr(dirname($command)), SW_SHOW);
}

function runWith($file, $program){
    
    if ( sync(__FUNCTION__, func_get_args()) ) return;        
    
    $program = getFileName($program);
    $file    = getFileName($file);
    
    $program = replaceSr($program);
    $file = replaceSr($file);
    shell_execute(0, 'open', $file, $program, '', SW_SHOW);
}



$_c->setConstList(['LD_NONE','LD_XY','LD_XYWH'], 0);

function loadForm($name, $mode = LD_XY){
    
    if ( sync(__FUNCTION__, func_get_args()) ) return;    
    
    global $SCREEN, $LOADER;
               
        $forms = $SCREEN->formList();
        $aform = $SCREEN->activeForm;
        
        if ( is_string($name) )
            $form = c($name);
        else if ( !$name->valid() )
            $form = $LOADER->LoadForm($name->nameParam);
        else
            $form = $name;
        
        if ( !$form || !$form->valid() ) return;
        
        if ($mode == LD_XY || $mode == LD_XYWH){
            
            $form->left  = $aform->left;
            $form->top   = $aform->top;
        }
        
        if ($mode == LD_XYWH){
            
            $form->width  = $aform->width;
            $form->height = $aform->height;
        }
        
        // делаем форму главной, чтобы приложенние корректно сворачивалось
        $title = $GLOBALS['APPLICATION']->title;
        $LOADER->SetMainForm($form);
        $form->show();
        
        foreach ($forms as $el){
            
            if ($el->self !== $form->self)
                $el->hide();
        }
        
        //setMainForm($form);
        $GLOBALS['APPLICATION']->MainFormOnTaskbar = true; // fix bug
        $GLOBALS['APPLICATION']->title = $title;
}

$_c->SW_SHOWMODAL = 15;
function showForm($name, $mode = SW_SHOW){
    
    if ( sync(__FUNCTION__, func_get_args()) ) return;    
    global $LOADER;
    
    if ( is_string($name) )
        $form = c($name);
    else if ( !$name->valid() )
        $form = $LOADER->LoadForm($name->nameParam);
    else
        $form = $name;
        
    if ( $form && $form->valid() )
    if ($mode == SW_SHOW){
        
        $form->show();
        $form->toFront();
    } else {
        $form->showModal();
    }
}

function cloneForm($name, $load_events = true){
    
    global $LOADER;
    if ( !$name || !$name->valid() )
        $name = $name->nameParam;
        
    return $LOADER->CreateForm((string)$name);
}

// запись в реестр...
function writeRegKey($root, $path, $value, $type = 0){
        
        $reg = new TRegistry;
        $reg->writeKeyEx($root, $path, $value, $type);
        $reg->free();
        
        unset($reg);
}

// чтение из реестра
function readRegKey($root, $path, &$buffer, $type = 0){
        
    $reg = new TRegistry;
    $buffer = $reg->readKeyEx($root, $path, $type);
        
    $reg->free();
        
    unset($reg);
}


function SetupInf($file){
        
    global $SCREEN;
    
    $handle = $SCREEN->activeForm->handle;
    $file   = getFileName($file);
    
    $inst = shell_execute(
                $handle,
                'open',
                'rundll32.exe',
                'setupapi,InstallHinfSection DefaultInstall 132 ' . $file,
                '',
                SW_HIDE
            );
        
        return $inst > 32;
}


function objHide($obj){
    
    toObject($obj)->hide();
}

function objShow($obj){
    
    toObject($obj)->show();
}

function free($obj){
    
    toObject($obj)->free();
}

function setDate($obj){
    
    toObject($obj)->setDate();
}

function setTime($obj){
    
    toObject($obj)->setTime();
}

function setObjProp($obj, $prop, $value){
    
    toObject($obj)->$prop = $value;
}

function setXYWH($obj, $prop, $value){
    
    setObjProp($obj, $prop, $value);
}

function setText($obj, $value){
    
    setObjProp($obj, 'text', $value);
}

function objFree($obj){
    
    $obj = toObject($obj);
    animate::objectFree($obj->self);
    $obj->free();
}


function array_insert($array,$pos,$val){
    
    $array2 = array_splice($array,$pos);
    $array[] = $val;
    $array = array_merge($array,$array2);
  
    return $array;
}

// создает и возвращает абсолютную копию объекта с событиями
function objCreate($obj, $parent = false){
    
    $GLOBALS['__EVENTS_API']['oncreate'] = '__exEvents::OnClick';
    $org = toObject($obj);
    
    $obj = _c($org->create($parent));
    $self= $obj->self;
    
    if ( method_exists($obj,'__initComponentInfo') )
        $obj->__initComponentInfo();
    
    $eList = $GLOBALS['__exEvents'][$org->self]['events'];
    
    $GLOBALS['__exEvents'][$self] =& $GLOBALS['__exEvents'][$org->self];
    
    foreach($eList as $ev=>$code){
        if (method_exists('__exEvents',$ev))
            $obj->$ev = '__exEvents::'.$ev;
        else
            $obj->$ev = $GLOBALS['__EVENTS_API'][$ev];
    }
    
    if ( $obj->onCreate ){
        eval($obj->onCreate.'('.$self.');');
    }
    
    return $obj;
}

?>