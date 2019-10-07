<?


class evfmEasySelectDialog {
    
    static function onActivate($self){
        
        global $myProject, $formSelected, $_FORMS;
        
        $arr = myProject::getFormsObjects($GLOBALS['OBJ_CLASSES']);
        DevS\cache::c('fmEasySelectDialog->objs_forms')->items->setArray(array_keys($arr));
        DevS\cache::c('fmEasySelectDialog->objs_forms')->itemIndex = $formSelected;
        
        DevS\cache::c('fmEasySelectDialog->lst_forms')->items->setArray(array_keys($arr));
        DevS\cache::c('fmEasySelectDialog->lst_forms')->itemIndex = $formSelected;
        
        myInspect::generateEx($arr[ $_FORMS[$formSelected] ], DevS\cache::c('fmEasySelectDialog->objs_list'));
        myInspect::generateEx($arr[ $_FORMS[$formSelected] ], DevS\cache::c('fmEasySelectDialog->lst_objects'));
        
        $txt = DevS\cache::c('fmEasySelectDialog->line')->text;
        DevS\cache::c('fmEasySelectDialog->c_kav')->checked = ($txt[0]=='"' && $txt[strlen($txt)-1]=='"');
        if ( preg_match('/^c\((.*)\)$/i', trim($txt)) ){
            
            DevS\cache::c('fmEasySelectDialog->pages')->pageIndex    = 1;
            $obj_str = str_ireplace('c("','', $txt);
            $obj_str = str_ireplace('")','',$obj_str);
            $obj_str = trim($obj_str);
            $objs = explode('->',$obj_str);
                
                if (in_array($objs[0],$_FORMS)){
                    DevS\cache::c('fmEasySelectDialog->objs_forms')->itemIndex = array_search($objs[0], $_FORMS);
                    myInspect::generateEx($arr[ $objs[0] ], DevS\cache::c('fmEasySelectDialog->objs_list'));
                    DevS\cache::c('fmEasySelectDialog->objs_forms')->setFocus();
                    if ( $objs[1] ){
                        DevS\cache::c('fmEasySelectDialog->objs_list')->items->selectedCaption = $objs[1];
                        DevS\cache::c('fmEasySelectDialog->objs_list')->setFocus();
                    }
                } else {
                    DevS\cache::c('fmEasySelectDialog->objs_list')->items->selectedCaption = $objs[0];
                    DevS\cache::c('fmEasySelectDialog->objs_list')->setFocus();
                }
                
        } elseif ( preg_match('/^c\((.*)\)\-\>([a-z0-9\_\-\>]+)$/i', trim($txt)) ){
            
            DevS\cache::c('fmEasySelectDialog->pages')->pageIndex    = 2;
            preg_match_all('#^c\(\"(.*)\"\)\-\>([a-z0-9\_\-\>]+)$#i', $txt, $arx);
            
            $prop = trim($arx[2][0]);
            $obj_str = trim($arx[1][0]);
            $objs = explode('->',$obj_str);
            $form_str = $objs[0];
            $obj_str  = $objs[1];
            
            
            if ( !$objs[1] && !in_array($form_str,$_FORMS) ){
                $form_str = $_FORMS[$formSelected];
                $obj_str = $objs[0];
            }
            
            if ( $obj_str ){
                
                $index = -1;
                foreach($arr[$form_str] as $i=>$el)
                    if ( $el['NAME']==$obj_str ){
                        $index = $i;
                        break;
                    }
                    
                DevS\cache::c('fmEasySelectDialog->lst_objects')->items->selectedCaption = $obj_str;
            }
            
            ev_lst_objects::onClick(DevS\cache::c('fmEasySelectDialog->lst_objects')->self);
            DevS\cache::c('fmEasySelectDialog->lst_props')->setFocus();
                
            DevS\cache::c('fmEasySelectDialog->lst_props')->items->selected = myProperties::getPropertyText($prop);
            DevS\cache::c('fmEasySelectDialog->lst_props')->setFocus();
            DevS\cache::c('fmEasySelectDialog->line')->text = $arx[0][0];
            
            myInspect::generateEx($arr[ $form_str ], c('fmEasySelectDialog->lst_objects'));
            
            DevS\cache::c('fmEasySelectDialog->lst_objects')->items->selectedCaption = $obj_str;
            
            if ( !$objs[1] )
                DevS\cache::c('fmEasySelectDialog->lst_objects')->itemIndex = -1;
        }
    }
    
    static function onShow($self){
        
        $obj = new TEditColorDialog(_c($self));
        $obj->parent = DevS\cache::c('fmEasySelectDialog->gb_color');
        $obj->w = 160;
        $obj->x = 13;
        $obj->y = 40;
        $obj->onSelect = 'evfmEasySelectDialog::onColorSelect';
        $obj->onClick  = 'evfmEasySelectDialog::onColorClick';
    }
    
    static function onColorClick($self){
       DevS\cache::c('fmEasySelectDialog->line')->text = _c($self)->text;
    }
    
    static function onColorSelect($obj, $color){
        DevS\cache::c('fmEasySelectDialog->line')->text = '0x'.dechex($color);
    }
}


class ev_objs_forms {
    
    static function onChange($self){
        
        global $_FORMS;
        $index = _c($self)->itemIndex;
        $arr = myProject::getFormsObjects($GLOBALS['OBJ_CLASSES']);
        
        myInspect::generateEx($arr[ $_FORMS[$index] ], DevS\cache::c('fmEasySelectDialog->objs_list'));
        
        if ($GLOBALS['OBJ_ISFUNC'])
            DevS\cache::c('fmEasySelectDialog->line')->text = _c($self)->items->selected;
        else
            DevS\cache::c('fmEasySelectDialog->line')->text = 'c(\'' . _c($self)->items->selected . '\')';
    }
    
    
    static function onClick($self){
        
       // DevS\cache::c('fmEasySelectDialog->line')->text = 'c(\'' . _c($self)->items->selected . '\')';
    }
}


class ev_lst_forms {
    
    
    static function onChange($self){
        
        global $_FORMS;
        $index = _c($self)->itemIndex;
        $arr = myProject::getFormsObjects($GLOBALS['OBJ_CLASSES']);
        
        myInspect::generateEx($arr[ $_FORMS[$index] ], DevS\cache::c('fmEasySelectDialog->lst_objects'));
        ev_lst_objects::onClick(c('fmEasySelectDialog->lst_objects')->self);
        DevS\cache::c('fmEasySelectDialog->lst_objects')->items->itemIndex = -1;
        
        
        //DevS\cache::c('fmEasySelectDialog->line')->text = 'c(\'' . _c($self)->items->selected . '\')';
    }
    
    static function onSelect($self){
        
        self::onChange($self);
    }
    
}



class ev_objs_list {
    
    
    static function onClick($self){
        
        global $_FORMS, $formSelected;
        
        $objs = _c($self)->items->selectedCaption;
        $form_name = DevS\cache::c('fmEasySelectDialog->objs_forms')->items->selected;
        
        if ($GLOBALS['OBJ_ISFUNC']){
            if (current($objs))
                if ($GLOBALS['OBJ_FULLPATH'])
                    DevS\cache::c('fmEasySelectDialog->line')->text = $form_name .'->'. current($objs);
                else
                    DevS\cache::c('fmEasySelectDialog->line')->text = current($objs);
            else
                DevS\cache::c('fmEasySelectDialog->line')->text = $form_name;
        } else {
            if (current($objs)){
                if ($_FORMS[$formSelected]==$form_name)
                    DevS\cache::c('fmEasySelectDialog->line')->text = 'c("' . current($objs) . '")';
                else
                    DevS\cache::c('fmEasySelectDialog->line')->text = 'c("' . $form_name.'->'. current($objs) . '")';
            }
            else
                DevS\cache::c('fmEasySelectDialog->line')->text = 'c("' . $form_name . '")';
        }
    }
    
}


class ev_lst_objects {
    
    
    static function onClick($self){
        
        global $_FORMS, $formSelected;
        $obj = _c($self);
        
        $index = current($obj->items->selected);
        $findex = DevS\cache::c('fmEasySelectDialog->lst_forms')->items->selected;
        
        $arr = myProject::getFormsObjects($GLOBALS['OBJ_CLASSES']);
        
        if (!is_numeric($index))
            $class = 'TForm';
        else
            $class = $arr[$findex][$index]['CLASS'];
        
        $arr = myProperties::getPropertiesInfo($class);
        $result = [];
        foreach ($arr as $el)
            $result[] = $el['CAPTION'];
        
        DevS\cache::c('fmEasySelectDialog->lst_props')->items->setArray($result);
        $form_name = DevS\cache::c('fmEasySelectDialog->lst_forms')->items->selected;
        
        if ($class!='TForm'){
            
            if ($_FORMS[$formSelected]==$form_name)
               DevS\cache::c('fmEasySelectDialog->line')->text = 'c("' . current($obj->items->selectedCaption) . '")';
            else
                DevS\cache::c('fmEasySelectDialog->line')->text = 'c("' . $form_name .'->'. current($obj->items->selectedCaption) . '")';
        }
        else
            DevS\cache::c('fmEasySelectDialog->line')->text = 'c("' . $form_name . '")';
    }
}




class ev_lst_props {
    
    
    static function onClick($self){
        
        
        global $_FORMS, $formSelected;
        $obj = DevS\cache::c('fmEasySelectDialog->lst_objects');
        
        $index = current($obj->items->selected);
        $findex = DevS\cache::c('fmEasySelectDialog->lst_forms')->items->selected;
        $arr = myProject::getFormsObjects($GLOBALS['OBJ_CLASSES']);
        
        if (!is_numeric($index))
            $class = 'TForm';
        else
            $class = $arr[$findex][$index]['CLASS'];
        
        $arr = myProperties::getPropertiesInfo($class);
        
        $s_index = _c($self)->itemIndex;
        if ($s_index < 0) return;
        
            $prop = $arr[$s_index]['PROP'];
        
        $form_name = DevS\cache::c('fmEasySelectDialog->lst_forms')->items->selected;
        
        if ($class!='TForm'){
            
            if ($_FORMS[$formSelected]==$form_name)
                $result = 'c("' . current($obj->items->selectedCaption) . '")';
            else
                $result = 'c("' . $form_name .'->'. current($obj->items->selectedCaption) . '")';
        }
        else
            $result = 'c("' . $form_name . '")';
        
        DevS\cache::c('fmEasySelectDialog->line')->text = $result . '->' . $prop;
    }
}


class ev_GlobalVars {
    
    
    static function onClick($self){
        
        DevS\cache::c('fmEasySelectDialog->line')->text = _c($self)->items->selected;
    }
}

class ev_lst_constants {
    
    static function onClick($self){
        
        DevS\cache::c('fmEasySelectDialog->line')->text = _c($self)->items->selected;
    }
}

class ev_localVars {
    
    
    static function onClick($self){
        
        DevS\cache::c('fmEasySelectDialog->line')->text = _c($self)->items->selected;
    }
}


class ev_fd_browsedir {
    
    static function onClick($self){
        
        $dir = '';
        if (selectDirectory('','',$dir)){
            
            global $projectFile;
            $p_dir = dirname($projectFile);
            $dir   = str_replace($p_dir.'/','',$dir) . '/';
            
            DevS\cache::c('fmEasySelectDialog->line')->text  = $dir;
            DevS\cache::c('fmEasySelectDialog->l_dir')->text = $dir;
        }
    }
}


class ev_fd_browsefiles {
    
    static function onClick($self){
        
        $dlg = new TOpenDialog;
        $dlg->filter = 'All files (*.*)|*.*|PHP Scripts (*.php)|*.php';
        
        if ($dlg->execute()){
            
            global $projectFile;
            $p_dir = dirname($projectFile);
            $file  = replaceSl($dlg->fileName);
            $file  = str_replace($p_dir . '/', '', $file);
            
            DevS\cache::c('fmEasySelectDialog->line')->text   = $file;
            DevS\cache::c('fmEasySelectDialog->l_file')->text = $file;
        }
        
        $dlg->free();
		DevS\cache::c("fmEasySelectDialog")->toFront();
    }
}


class ev_fd_browsedirlocal {
    
    static function onClick($self){
        
        global $projectFile;
        $dir = '';
        if (selectDirectory('',dirname($projectFile),$dir)){
            
            $p_dir = dirname($projectFile);
            $dir   = str_replace($p_dir .'/','',$dir) . '/';
            
            DevS\cache::c('fmEasySelectDialog->line')->text  = $dir;
            DevS\cache::c('fmEasySelectDialog->l_dirlocal')->text = $dir;
        }
    }
}


class ev_fd_browsefileslocal {
    
    static function onClick($self){
        
        global $projectFile;
        $dlg = new TOpenDialog;
        $dlg->filter     = 'All files (*.*)|*.*|PHP Scripts (*.php)|*.php';
        $dlg->initialDir = replaceSr(dirname($projectFile));
        
        if ($dlg->execute()){
            
            $p_dir = dirname($projectFile);
            $file  = replaceSl($dlg->fileName);
            $file  = str_replace($p_dir . '/', '', $file);
            
            DevS\cache::c('fmEasySelectDialog->line')->text   = $file;
            DevS\cache::c('fmEasySelectDialog->l_filelocal')->text = $file;
        }
        
        $dlg->free();
		DevS\cache::c("fmEasySelectDialog")->toFront();
    }
}

class ev_search_inweb {
    
    static function onClick($self){
        
        shell_execute(0,'open','http://php.su/functions/?' . urlencode( c('fmEasySelectDialog->e_search')->text ), '', '', SW_SHOW);
    }
    
}

class ev_e_search {
     
    static function onKeyUp($self){
        
        DevS\cache::c('fmEasySelectDialog->line')->text = _c($self)->text;
    }
    
    static function onKeyPress($self){
        
        DevS\cache::c('fmEasySelectDialog->line')->text = _c($self)->text;
    }
}

class ev_e_true {
    
    static function onClick($self){
        DevS\cache::c('fmEasySelectDialog->line')->text = 'true';
    }
}

class ev_e_false {
    
    static function onClick($self){
        DevS\cache::c('fmEasySelectDialog->line')->text = 'false';
    }
}


class ev_c_kav {
    
    static function onMouseUp($self){
        
        if (c($self)->checked){
            DevS\cache::c('fmEasySelectDialog->line')->text = '"' . c('fmEasySelectDialog->line')->text . '"';
        } else {
            DevS\cache::c('fmEasySelectDialog->line')->text = action_Simple::trimQuote(c('fmEasySelectDialog->line')->text);
        }
    }
}