<?


class myActions {
    
    // загружаем основаные части изи редактора действий...
    static function init(){
        
        $dir = SYSTEM_DIR . '/design/actions/';
        $actions = findDirs($dir);
        
        $result = [];
        $groups = [];
        
        $id_icon = 0;
        foreach ($actions as $id=>$action){
            
            
            /// файл языка
            Localization::inc($dir . $action . '/lang');
            
            if (!file_exists($dir . $action . '/info.php')){
				if ( $action !== '.svn' )
                msg(t('Inccorect "%s" action, file "info.php" not found!', $action));
                continue;
            }
            
            if (!preg_match('/([a-z0-9\_]+)/i',$action)){
                msg(t('Inccorect code "%s" for action!', $action));
                continue;
            }
            
            // подключаем класс описания если есть...
            if (file_exists($dir . $action . '/class.php'))
                require $dir . $action . '/class.php';
            
            $item = [];
            $item['CODE'] = $action;
            $item['ID']   = $id;
            
            $arr = include ($dir . $action . '/info.php');
            
            ////// загружаем иконку.... *////
            if (file_exists($dir . $action . '/icon.bmp'))
                $item['ICON'] = $dir . $action . '/icon.bmp';
            else if (file_exists($dir . $action . '/icon.png'))
                $item['ICON'] = $dir . $action . '/icon.png';
            else if ($arr['ICON'])
                $item['ICON'] = myImages::get24($arr['ICON']);
                
            if (!$item['ICON'])
                $item['ICON'] = myImages::get24($action);
            
            $item['ICON_ID'] = $id_icon;
            ++$id_icon;
            
            
            // загружаем текст...
            $item['TEXT'] = t('action_'.$action);
            $item['DESCRIPTION'] = $arr['TEXT'];
            $item['HINT'] = $arr['TEXT'];
            
            if (isset($arr['TEXT']))
                $item['TEXT'] = t($arr['TEXT']);
                
                
            if (isset($arr['DESCRIPTION']))
                $item['DESCRIPTION'] = t($arr['DESCRIPTION']);
                
            if (isset($arr['INLINE']))
                $item['INLINE'] = t($arr['INLINE']);
                    
            if (isset($arr['HINT']))
                $item['HINT'] = t($arr['HINT']);
            ////////////////////////////////////////////////////////////////////
            
            // условные шаблоны для действия
            if (isset($arr['EREG']))
                $item['EREG'] = $arr['EREG'];
            if (isset($arr['PREG']))
                $item['PREG'] = $arr['PREG'];
            
            if (!isset($arr['EREG']) && !isset($arr['PREG'])) continue;    
            
            if( isset($arr['COMMAND']) )
            $item['COMMAND'] = $arr['COMMAND'];
		
			if( isset($arr['SECTION']) )
            $item['SECTION'] = $arr['SECTION'];
			
			if( isset($arr['NO_BRACKETS']) )
            $item['NO_BRACKETS'] = $arr['NO_BRACKETS'];
		
			if( isset($arr['NO_TSZ']) )
            $item['NO_TSZ']  = $arr['NO_TSZ'];
            
            // сортировка для отображения на панеле... 
            $item['SORT']    = isset($arr['SORT']) ? $arr['SORT'] : 9999999;
			
			if( isset($arr['NO_SHOW']) )
            $item['NO_SHOW'] = $arr['NO_SHOW'];
            
            /* очень грузит начальную загрузку среды, поэтому создаем диалоги по необходимости,
              а не сразу все...
            $params = [];
            // создаем форму диалог, в парамс достаем объекты формы...
            $item['DIALOG'] = self::createDialog($action, $item, $params);
            // записываем объекты формы сюда..
            $item['PARAMS_OBJS'] = $params;
                                         */
            
            $result[$action]  = $item;
        }
        
        // сортируем весь массив по полю СОРТ
        BlockData::sortList($result, 'SORT');
        
        
        foreach ($result as $item):
            
            // показывать на панеле действие или нет...
			if(isset($item['NO_SHOW']))
            if (!$item['NO_SHOW']){    
                    if (!in_array($item['SECTION'], $groups)){
						
                        if(isset($actionPanel2))
                        if ($actionPanel2->self)
                            $actionPanel2->addSection($item['SECTION'],t('gr_'.$item['SECTION']));
                        
                        $groups[] = $item['SECTION'];
                    }
                    
					if(isset($actionPanel2))
                    if ( $actionPanel2->self )
                        self::addButton($item, $actionPanel2);
            }
            
        endforeach;
        
        
        
        // сортируем весь массив по полю СОРТ в обратном порядке...
        BlockData::sortList($result, 'SORT', 'desc');
        
        myVars::set($result, 'arrayActions');
    }
    
    // добавляем кнопку на панел действий...
    static function addButton($item, $actionPanel){
        
        global $actionPanel2;
        
    }
    
    static function addAction($self, $btn){
        
        global $btnCodes;
        $code = $btnCodes[$btn];
        
        global $arrayActions;
        
        $action = self::getActionByCODE($code);
        if ($action){

            action_Simple::openDialog($action['DIALOG'], $action, false);
            evfmPHPEditorMEMO::onMouseDown($self);
        }
    }
    
    static function getActionByCODE($code){
        
        global $arrayActions;
        return BlockData::getItem($arrayActions, $code, 'CODE');
    }
    
    static function getActionByCODE_id($code){
        
        global $arrayActions;
        foreach ($arrayActions as $i=>$action){
            if ($action['CODE']==$code)
                return $i;
        }
        
        return -1;
    }
    
    // достаем АКТИОН (массив) по строчке, автоматически удаляем все пробелы слева и справа
    static function getAction($line){
        
        
        global $arrayActions;
        
        $line = trim($line);
        if ($line[strlen($line)-1]==';'){
            $line[strlen($line)-1] = ' ';
            $line = trim($line);
        }
        
        $x_line = PHPSyntax::clearSkobki($line);
        foreach ($arrayActions as $name=>$action){
            
			if(isset($action['PREG']))
            if ($action['PREG']){
                if (preg_match($action['PREG'], $x_line))
                    return $action;
            }
            
			if(isset($action['EREG']))
            if ($action['EREG']){
                if (preg_match("/".$action['EREG']."/i",$x_line))
                    return $action;
            }
        }
        
        return false;
    }
    
    // params - список объектов параметров
    static function createDialog($code, $action, &$params){
        $dir = SYSTEM_DIR . '/design/actions/'.$code.'/dialog.php';
        
        if ( !file_exists($dir) ) return false;
        
        // подключаем инициализирующий файл для формы, он возвращает все параметры формы
        $data = include $dir;
        
        // создаем форму
        $frm = new TForm;
        $frm->tag = 2012;
        $frm->caption = $action['TEXT'];
        $frm->name = str_replace('.','_', $code) . '_action';
        $frm->borderStyle = bsDialog;
        $frm->position    = poScreenCenter;
        //$frm->formStyle   = fsStayOnTop;
        
        $frm->font->name = 'Tahoma';
        $frm->w = 430;
        $frm->h = 20;
        $h = 30;
        
        // создаем гроупбокс для визуальности
        $gb = new TGroupBox($frm);
        $gb->parent = $frm;
        $gb->w      = $frm->w - 16;
        $gb->x      = 5;
        $gb->h      = $frm->h - 10;
        $gb->y      = 5;
        $gb->caption= $action['TEXT'];
       
        // проходимся по параметрам формы редактора...
        foreach ($data as $editor){
            
            $class = $editor['TYPE'] . '_editor';
            $tmp   = new $class;
        
            // создаем тип редактора...
            $h += $tmp->create($gb, $action, $editor, $h);
            
            // добавляем объект - параметр
            $params[] = $tmp;
            
            $h += 20;   
        }
        
        
        // создаем кнопку ОК
        $btn = new TBitBtn($frm);
        $btn->parent = $gb;
        $btn->w = 100;
        $btn->h = 25;
        $btn->x = $frm->w - $btn->w - 10 - $gb->x*3;
        
        $btn->modalResult = mrOk;
        $btn->caption = t('ok');
        
        // создаем кнопку "Отмена"
        $btn2 = new TBitBtn($frm);
        $btn2->parent = $gb;
        $btn2->w = $btn->w;
        $btn2->h = $btn->h;
        $btn2->x = $frm->w - $btn->w - 15 - $btn2->w - $gb->x*3;
        
        $btn2->modalResult = mrCancel;
        $btn2->caption = t('cancel');
        
        // добавляем немного высоты...
        $h += $btn->h + 60;
        
        //$gb->anchors= 'akLeft, akTop, akRight';
        $frm->h = $h;
        $gb->h  = $h - 43;
        
        // определяем положение по Y кнопок ОК и ОТМЕНА
        $btn->y  = $frm->h - $btn->h * 2 - 15 - $gb->y*2;
        $btn2->y = $btn->y;
        
        // возвращаем форму
        return $frm;
    }
    
    static function getInline($action, $line = false){
        
        $inline = isset( $action['INLINE'] )? $action['INLINE'] : $action['DESCRIPTION'];
        
        $class = 'action_Simple';
        if (class_exists('action_'.str_replace('.','_', $action['CODE'])))
            $class = 'action_'.str_replace('.','_',$action['CODE']);
        
        if (!$line)
            $line = action_Simple::getLine();
        
        $tmp = new $class; //что за... Это вообще здесь зачем? Дим-с странный...
        $params_str = $tmp->getLineParams($line,$action);
        unset($tmp);
        
        foreach ($params_str as $i=>$el)
            $arr[] = '%pr'.($i+1).'%';
        
        $inline = str_replace($arr, $params_str, $inline);
        
        return $inline;
    }
    static function getInlineFixed($action)
	{
		if(strlen($action)==0) return '';
		$line = self::getInline($action, false);
		if(strlen($line)==0) return '';
		$canvas = new TControlCanvas(c('fmPHPEditor->desc'));
		$pixel = ($canvas->textWidth('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890')/62);
		$pixelDiff = ($pixel - ($pixel - (int)$pixel));
		$pixel = $pixelDiff>=($pixel-0.5)? ($pixel - 0.5): (int)$pixel;

		$maxLen = (int)(c('fmPHPEditor->tlCancel',1)->left - 8 ) / $pixel;
		$line = (strlen($line)>$maxLen)? substr($line, 0, $maxLen - 3) . '...': $line;
		return $line;
	}
}


// инициализирум сразу при запуске программы... ^
myActions::init();



class action_Simple {
    
    static function trimLine($result){
        
        $result = trim($result);
        if ($result[strlen($result)-1]==';'){
            $result[strlen($result)-1] = ' ';
            $result = trim($result);
        }
        
        return $result;
    }
    
    static function getLine(){
        
        $result = c('fmPHPEditor.memo')->lineText;
        
        return self::trimLine( $result );
    }

    static function replaceCommand($command){
        
        /*$command = trim($command);
        if ($command[strlen($command)-1]!==';'){
            $command = $command . ';';
        }*/
        
        $lineY = c('fmPHPEditor.memo',1)->caretY;
        c('fmPHPEditor.memo',1)->replaceLine($command);
        c('fmPHPEditor.memo',1)->caretY = $lineY;
    }
    
    static function insertCommand($command){
        
        /*
        $command = trim($command);
        if ($command[strlen($command)-1]!==';'){
            $command = $command . ';';
        }
               */
        
        $lineY = c('fmPHPEditor.memo',1)->caretY;
        c('fmPHPEditor.memo',1)->insertLine($command);
        c('fmPHPEditor.memo',1)->caretY = $lineY+1;
    }
    
    static function getLineParams($line, $action = false){
        
        $command = self::getLineCommand($line, $action);
        
		if(isset($action['NO_BRACKETS'])) {
			if ($action['NO_BRACKETS']) {
				$str = substr($line, strlen($command)+1, strlen($line)-strlen($command)-1);
			} else {
				$str = substr($line, strlen($command)+1, strlen($line)-strlen($command)-2);
			}
		} else {
			$str = substr($line, strlen($command)+1, strlen($line)-strlen($command)-2);
		}
        
        $is_str = false;
        $dd_q   = [];
        $d_q    = [];
        $skoba  = 0;
        for($i=0;$i<strlen($str);$i++){
            
            if (in_array($str[$i],array('"',"'"))){
                $is_str = !$is_str;
                continue;
            }
            
            if (!$is_str && $str[$i] == '(')
                ++$skoba;
            elseif (!$is_str && $str[$i] == ')')
                --$skoba;
            
            if (!$is_str && ($skoba!==0 && $str[$i]==','))
                $dd_q[] = $i;
            elseif ($is_str && $str[$i]==',')
                $dd_q[] = $i;
        }
        
        foreach ($dd_q as $i)
            $str[$i] = chr(15);
        
        //pre($dd_q);    
        $result = explode(',',$str);
        
        foreach ($result as $i=>$el)
            $result[$i] = trim(str_replace(array(chr(15)),array(','), $el));
        
        return $result;
    }
    
    static function getLineCommand($line, $action){
        
        $sym = $action['NO_BRACKETS'] ? ' ' : '(';
        for ($i=0;$i<strlen($line);$i++){
            
            if ($line[$i] == $sym){
                $k = $i;
                break;
            }
        }
        
        return substr($line, 0, $k);
    }
    
    static function getResult($command, $params_str, $action){
        
		if(isset($action['NO_BRACKETS'])) {
			if ($action['NO_BRACKETS']) {
				$res  = $command . ' ';
			} else {
				$res  = $command . '(';
			}
        } else {
			$res  = $command . '(';
		}
        $res .= implode(', ',$params_str);
        
        $tsz = ';';
		
		if(isset($action['NO_TSZ']))
        if ($action['NO_TSZ'])
            $tsz = '';
        
		if(isset($action['NO_BRACKETS'])) {
			if ($action['NO_BRACKETS']) {
				$res .= $tsz;
			} else {
				$res .= ')' . $tsz;
			}
		} else {
			$res .= ')' . $tsz;
		}
        return $res;
    }
    
    static function trimQuote($value){
        
        $value = trim($value);
        if ($value[0]=='"' && $value[strlen($value)-1]=='"'){
                
            $value[0] = ' ';
            $value[strlen($value)-1] = ' ';
            $value = trim($value);
        }
        return $value;
    }
    
    static function parseParam($value, $el){
        
        if ($el->use_quote){
            
            if ($value[0]=='"' && $value[strlen($value)-1]=='"'){
                
                $value[0] = ' ';
                $value[strlen($value)-1] = ' ';
                $value = trim($value);
                $el->to_quote = true;
            } else {
                $el->to_quote = false;
            }
        }
        
        return $value;
    }
    
    static function parseParamGet($value, $el){
        
        if ($el->use_quote && $el->to_quote){
            
            $x = trim($value);
            if (
                preg_match('/^c\(/i', $x)             ||
                preg_match('/^\$([a-z0-9\_]+)/i', $x) ||
                preg_match('/^0x([ABCDF0-9]+)/i', $x) ||
                strtolower($value) == 'true'  ||
                strtolower($value) == 'false'
            ) {
                  
            } else
                $value = '"' . $value . '"';
        } elseif ($el->use_quote) {
            
            if ( !preg_match('/^([a-z0-9\_]*)$/i', trim($value)) ){
                if ($value[0]!=='"')
                    $value = '"' . $value . '"';
            }
        }
        
        return $value;
    }
    
    static function openDialog($form, $action, $edit = true){
        
        if (!$form){
            global $arrayActions;
            
            $id = myActions::getActionByCODE_id($action['CODE']);
            
            $params = [];
            $form   = myActions::createDialog($action['CODE'],$action, $params);
			
            $arrayActions[$id]['DIALOG'] =& $form;
            $arrayActions[$id]['PARAMS_OBJS'] = $params;
            $action['DIALOG'] =& $form;
            $action['PARAMS_OBJS'] = $params;
        }
        
        $class = 'action_'.$action['CODE'];
        if (!class_exists($class))
            $class = 'action_Simple';
            
        $tmp        = new $class;
        
        if ($edit){
            $params_str = $tmp->getLineParams(self::getLine(), $action);
            $command    = $tmp->getLineCommand(self::getLine(), $action);
        } else {
            $command = $action['COMMAND'];
            $params_str = [];    
        }
        
            foreach ($action['PARAMS_OBJS'] as $i=>$el){
                $value = $params_str[$i];
                
                if (method_exists($el, 'openDialog'))
                    $el->openDialog();
                
                if ($edit)
                if (method_exists($tmp,'parseParam')){
                    $value = $tmp->parseParam($value, $el);
                }
                
                $el->setValue($value);
            }
        
        
        if (!count($action['PARAMS_OBJS']) || $form->showModal() == mrOk){
            
            $result = [];
            foreach ($action['PARAMS_OBJS'] as $i=>$el){
                
                $value = $el->getValue();
                if (method_exists($tmp,'parseParamGet')){
                    
                    if (!$edit && $el->use_quote)
                        $el->to_quote  = true;
                    
                    $value = $tmp->parseParamGet($value, $el);
                }
                
                $result[] = $value;
            }
            
            if ($edit){
                if (count($action['PARAMS_OBJS'])){
                    self::replaceCommand( $tmp->getResult($command, $result, $action) );
                }
            }
            else {
                if ( !self::getLine() )
                    self::replaceCommand( $tmp->getResult($command, $result, $action) );
                else
                    self::insertCommand( $tmp->getResult($command, $result, $action) );
            }
            
        } else {
            
            $tmp->cancelAction($form, $action);
        }
    }
    
    static function checkDialog($form, $action){
        
        
    }
    
    static function insertAction($form, $action){
        
        
    }
    
    static function cancelAction($form, $action){
        
        
    }
}