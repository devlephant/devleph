<?
/*
  
  DevelStudio Delphi Form reader & writer
  
  2017 ver 1.0.1
 
  Ѕиблиотека дл¤ загрузки и сохранени¤ форм из dfm файлов...
  
  
*/

// создание формы на основе внешнего dfm файла
function dfm_read($dfm_file_name, $aform = false, $str = false, $form_name = false, $is_runtime = false)
{
	if ($dfm_file_name)
		dsErrorDebug::checkFile($dfm_file_name);

	if (!$aform)
		$form = new TForm( $GLOBALS['APPLICATION'] );
	else {
		$form = $aform;
		$form->positionEx = $form->position;
	}
	
	$dfm_file_name = replaceSr($dfm_file_name);
	
	if ( !$str )
		$str = file_get_contents($dfm_file_name);

	
		gui_readStr($form->self, $str);
		
	
	if ($form_name)
		$form->name = $form_name;
	
	$components = $form->componentList;
	
	for ($i=0;$i<count($components);$i++){
		
		$el =& $components[$i];
		
		if (!$GLOBALS['APP_DESIGN_MODE'] || $is_runtime){
			
			if (!$el->isClass(['TEvents','TTabSheet']) && !$el->name){
				$el->free();
				continue;
			}
			
			if (method_exists($el, '__initComponentInfo')){
				$el->__initComponentInfo();
			}		
		
		} else {
			
		}
	}
		
 return $form->self;
}

// сохранение формы в dfm файл
function dfm_write($dfm_file_name, TForm $form)
{
   file_put_contents(replaceSr($dfm_file_name), gui_writeStr($form->self) );
}

// ---------------------------- // -------------------------------------------//

function createForm($file)
{
	$form = new TForm( $GLOBALS['APPLICATION'] );
	gui_readStr($form->self, file_get_contents($file));
    return $form;
}

function saveFormAsDfm($file,$form){
	
	$form = toObject($form);
        dfm_write($file,$form);
}

function createFormWithEvents($name,$init = false)
{
	$res = createForm(replaceSr(DOC_ROOT . "/" . $name . '.dfm'));
	
        if (file_exists(DOC_ROOT . '/' . $name.'.php')){

                include_once(DOC_ROOT . '/' . $name.'.php');
                if ($init)
                        loadFormEvents($res);
        }
	return $res;
}

// динамическа¤ загрузка событий дл¤ формы...
function loadFormEvents(TForm $form)
{
	$name = $form->name;
	$objs_l = $form->componentLinks;
	$events = ['onClick','onClose','onCloseQuery','onDblClick','onKeyUp','onKeyPress','onKeyDown',
	'onMouseDown','onMouseUp','onMouseMove','onMouseEnter','onMouseLeave','onCanResize',
	'onChange','onChanging','onShow','onPaint','onResize','onHide','onActivate','onDeactivate',
	'onDestroy','onSelect','onTimer','onScroll', 'onMouseCursor','onDockDrop','onDockOver',
	'onUndock','onStartDock','onEndDock','OnDuringSizeMove','OnStartSizeMove','OnEndSizeMove','OnPopup'];
        
        for ($i=0;$i<count($objs_l);$i++){
		$self = $objs_l[$i];
		$o_name = component_name($self);
            for ($j=0;$j<count($events);$j++)
			{
				$ev = $events[$j];
				$class = 'ev' . $name . $o_name;
				
				if (!class_exists($class,false))
					$class = 'ev_' . $name . '_' . $o_name; 
				if (!class_exists($class,false))
					$class = 'ev_' . $o_name;
				if (!class_exists($class,false)) continue;
				if (!method_exists($class,$ev)) continue;
				
				set_event($self, $ev, $class . '::' . $ev);
            }
        }
	
	for ($j=0;$j<count($events);$j++){
                        $ev = $events[$j];
                        
			$class = 'ev' . $name;
			if (!class_exists($class))
				$class = 'ev_' . $name;
                        
                        if (!class_exists($class)) continue;
			if (!method_exists($class,$ev)) continue;
                        
                        $form->$ev = $class . '::' . $ev;
        }
}


?>