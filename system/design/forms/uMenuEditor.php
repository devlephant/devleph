<?

class menuEditor {
    
    static function resultToText($result){
        
        $return = [];
        
        foreach((array)$result as $item){
            $item = str_replace(chr(9),' ',$item);
            
            $params = [];
            $k      = strpos($item,'[');
            if ($k!==false){
                $text   = substr($item, 0, $k);
                $params = trim(substr($item, $k+1, -1));
                $params = explode(',', $params);
            } else {
                $text   = $item;
            }
            
            $return[] = $text;
        }
        
        return implode(_BR_, $return);
    }
    
    static function updateTree(){
        $tree = DevS\cache::c('edt_menuEditor->tree');
        $tree->text = self::resultToText( self::getResult() );
        $tree->fullExpand();
    }
    
    static function getParam($index){
        
        if ($index>=0){
        
            $result = self::getResult();
			
            $item = $result[$index];
            
            $params = [];
            $k      = strpos($item,'[');
            if ($k!==false){
                $text   = (substr($item, 0, $k));
                $params = trim(substr($item, $k+1, -1));
                $params = explode(',', $params);
            } else {
                $text   = ($item);
            }
            
            $return['level'] = strlen($text) - strlen(ltrim($text));
            $return['text']  = trim($text);
            $return['func']  = trim($params[0]);
            $return['icon']  = trim($params[1]);
            $return['scut']  = trim($params[2]);
            $return['name']  = trim($params[3]); 
            $return['enabled']  = trim($params[4]); 
            $return['checked']  = trim($params[5]); 
            $return['AutoCheck']  = trim($params[6]); 
            $return['iconData']  = trim($params[7]); 
            
 
            return $return;
        } else
            return array('text'=>'','func'=>'','icon'=>'','scut'=>'','name'=>'', 'enabled'=>'', 'checked'=>'', 'AutoCheck'=>'', 'iconData'=>'');
    }
    
    static function setParam($index, $params){
        
        $result = self::getResult();
        //$item   = $result[$index];
        
        $item = str_repeat(' ',$params['level']) . $params['text'] . '[';
        $item.= $params['func'] .','. $params['icon'] .','. $params['scut'] .','. $params['name'].','. $params['enabled'].','. $params['checked'].','. $params['AutoCheck'].','. $params['iconData'];
        $item.=']';
        
        
        $result[$index] = $item;
        DevS\cache::c('edt_menuEditor')->result = implode(_BR_, $result);
    }
    
    static function getResult(){
        
        $result = DevS\cache::c('edt_menuEditor')->result;
        $result = explode(_BR_, $result);
        
        array_map('trim',$result);
        foreach ($result as $i=>$it)
            if (!$it)
                unset($result[$i]);
        
        return $result;
    }
    
    static function insert($index, $params){
        
        $index = $index == -1 ? 0 : $index;
        
        $result = self::getResult();
        $item = '-';
        $c    = count($result);
        
        if (is_int($index) && $index!==count($result)){
            $result = array_insert($result, $index, $item);
            DevS\cache::c('edt_menuEditor')->result = implode(_BR_, $result);
            //$index++;
        } else {
            
            $result[] = $item;
            $index    = count($result)-1;
        }
        
        self::setParam($index, $params);
        return $index;
    }
    
    static function add($params){
        
        self::insert(false, $params);
    }
    
    static function getParams(){
        
		$file = val('edt_menuEditor->e_icon');
		$type = fileExt($file);
		$bmp = base64_encode( serialize( array( file_get_contents( $file ), $type ) ) );
		
        $result['text'] = val('edt_menuEditor->e_text');
        $result['icon'] = $file;
        $result['func'] = val('edt_menuEditor->e_func');
        $result['level'] = val('edt_menuEditor->e_level');
        $result['name'] = val('edt_menuEditor->e_name');
        $result['scut'] = DevS\cache::c('edt_menuEditor->e_scut')->hotKey;

        $result['enabled'] = ! (int) DevS\cache::c('edt_menuEditor->e_enabled')->checked;
        $result['checked'] = (int) DevS\cache::c('edt_menuEditor->e_checked')->checked;
        $result['AutoCheck'] = (int) DevS\cache::c('edt_menuEditor->e_AutoCheck')->checked;
		$result['iconData'] = $bmp;
        
        return $result;
    }
    
    static function setParams($result){
        
        val('edt_menuEditor->e_text', $result['text']);
        val('edt_menuEditor->e_icon',$result['icon']);
        val('edt_menuEditor->e_func',$result['func']);
        val('edt_menuEditor->e_level',$result['level']);
        val('edt_menuEditor->e_name',$result['name']);
        DevS\cache::c('edt_menuEditor->e_scut')->hotKey = $result['scut'];
        DevS\cache::c('edt_menuEditor->e_enabled')->checked = ! (int) $result['enabled'];
        DevS\cache::c('edt_menuEditor->e_checked')->checked = (int) $result['checked'];
        DevS\cache::c('edt_menuEditor->e_AutoCheck')->checked = (int) $result['AutoCheck'];
    }
    
    static function exchange($from, $to){
        
        $params1 = self::getParam($from);
        $params2 = self::getParam($to);
        
        if ($from > $to){ // вверх перемещаем
            
            if ($params1['level']-$params2['level']>1){
                $params1['level'] = $params2['level']+1;
                self::setParam($from, $params1);
            }
            
        } elseif ($from < $to){
            
            if ($params2['level']-$params1['level']>1){
                $params1['level'] = $params2['level']+1;
                self::setParam($from, $params1);
            }
        }
        
        $result = self::getResult();
        
        $tmp           = $result[$from];
        $result[$from] = $result[$to];
        $result[$to]   = $tmp;
        
        DevS\cache::c('edt_menuEditor')->result = implode(_BR_, $result);
    }
    
    static function itemUp($index){
        
        if (is_int($index) && ($index!==0) && $index!==count(self::getResult())){
            
            self::exchange($index, $index-1);
            return $index-1;
        }
    }
    
    static function itemDown($index){
        
        if (is_int($index) && $index!==count(self::getResult())){
            
            self::exchange($index, $index+1);
            return $index+1;
        }
    }
    
    static function delete($index){
        
        $result = self::getResult();
        $params = self::getParam($index);
        $c      = count($result);
        
        for($i=$index+1;$i<$c;$i++){
            
            $tmp = self::getParam($i);
            
            if (is_int($tmp['level']) && $params['level']>=$tmp['level']){
                break;    
            } else 
                unset($result[$i]);
        }
        
        unset($result[$index]);
        $result = array_values($result);
        DevS\cache::c('edt_menuEditor')->result = implode(_BR_, $result);
        return $index;
    }
}

class ev_edt_menuEditor {
    
    
    static function onActivate($self){
        
        DevS\cache::c('tree')->text = menuEditor::resultToText( menuEditor::getResult() );
        DevS\cache::c('edt_menuEditor->tree')->absIndex = 0;
        menuEditor::setParams( menuEditor::getParam( 0 ) );
    }
}

class ev_edt_menuEditor_btn_data {
    
    static function onClick($self){
        TextEditor::$value = DevS\cache::c('edt_menuEditor')->result;
        if (TextEditor::execute()){
            
            DevS\cache::c('edt_menuEditor')->result = TextEditor::$value;
            menuEditor::updateTree();
        }
		DevS\cache::c("edt_menuEditor")->toFront();
    }
}

class ev_edt_menuEditor_btn_path {
    
    static function onClick($self){
        
        $dlg = new TObjectsDialog;
        if ($dlg->execute( array('TFunction'),t('To select function for click event') )){
            DevS\cache::c('edt_menuEditor->e_func')->text = $dlg->value;
            ev_edt_menuEditor_btn_save::onClick(0);
        }
        
        $dlg->free();
		DevS\cache::c("edt_menuEditor")->toFront();
    }
}
class ev_edt_menuEditor_btn_pathToIcon {
    
    static function onClick($self){
        
        $dlg = new TOpenDialog;
        if ($dlg->execute()){
			DevS\cache::c('edt_menuEditor->e_icon')->text = $dlg->fileName;
        }
        
        $dlg->free();
		DevS\cache::c("edt_menuEditor")->toFront();
    }
}


class ev_edt_menuEditor_btn_insert {
    
    static function onClick($self){
        
        $index = menuEditor::insert( DevS\cache::c('edt_menuEditor->tree')->absIndex, array('text'=>t('Menu item %s', count(menuEditor::getResult())+1), 'enabled'=>0, 'checked'=>0, 'AutoCheck'=>0) );
        menuEditor::updateTree();
        
        DevS\cache::c('edt_menuEditor->tree')->absIndex = $index;
    }
}


class ev_edt_menuEditor_tree {
    
    
    static function onChange($self){
        
            global $treeIndex; // is hak -_-
            $treeIndex = DevS\cache::c('edt_menuEditor->tree')->absIndex;
            menuEditor::setParams( menuEditor::getParam( $treeIndex ) );        
    }

}

class ev_edt_menuEditor_popup {
    
    static function onPopup($self){
        
        global $treeIndex; // is hak -_-
        $treeIndex = DevS\cache::c('edt_menuEditor->tree')->absIndex;
        menuEditor::setParams( menuEditor::getParam( $treeIndex ) );
    }
}


class ev_edt_menuEditor_btn_save {
    
    static function onClick($self){
        
        $params = menuEditor::getParams();
        $index  = DevS\cache::c('edt_menuEditor->tree')->absIndex;
        menuEditor::setParam( DevS\cache::c('edt_menuEditor->tree')->absIndex, $params );
        menuEditor::updateTree();
        
        menuEditor::setParams( menuEditor::getParam( $index ) );
        DevS\cache::c('edt_menuEditor->tree')->setFocus();
        DevS\cache::c('edt_menuEditor->tree')->absIndex = $index;
    }
}

class ev_edt_menuEditor_btn_cancel {
    
    static function onClick($self){
        
        menuEditor::setParams( menuEditor::getParam( DevS\cache::c('edt_menuEditor->tree')->absIndex ) );
    }
}

class ev_edt_menuEditor_btn_up {
    
    static function onClick($self){
        global $treeIndex;
        $index = menuEditor::itemUp( $treeIndex );
        menuEditor::updateTree();
        DevS\cache::c('edt_menuEditor->tree')->absIndex = $index;
    }
}


class ev_edt_menuEditor_btn_down {
    
    static function onClick($self){
        global $treeIndex;
        $index = menuEditor::itemDown( $treeIndex );
        menuEditor::updateTree();
        DevS\cache::c('edt_menuEditor->tree')->absIndex = $index;
    }
}


class ev_edt_menuEditor_btn_delete {
    
    static function onClick($self){
        
        global $treeIndex;
        $index = menuEditor::delete( $treeIndex );
        menuEditor::updateTree();
        DevS\cache::c('edt_menuEditor->tree')->absIndex = $index;
    }
}

class ev_edt_menuEditor_it_add {
    
    static function onClick($self){
        
        global $treeIndex;
        $index = $treeIndex;
        
        global $is_insert;
        $is_insert = true;
        
        $params = menuEditor::getParam($index);
        
        $new_index = $index+1;
        $c         = count( menuEditor::getResult() );
        for($i=$new_index;$i<$c;$i++){
            
            $tmp = menuEditor::getParam($i);
            if ($params['level']>=$tmp['level']) break;
            
            $new_index = $i+1;
        }
        
        $index = menuEditor::insert(
                                    $new_index,
                                    array('text'=>t('Menu item %s', count(menuEditor::getResult())+1),
                                          'level'=>$params['level']+1)
                                    );
        menuEditor::updateTree();
        DevS\cache::c('edt_menuEditor->tree')->absIndex = $index;
    }
}

class ev_edt_menuEditor_it_delete {
    static function onClick($self){ ev_edt_menuEditor_btn_delete::onClick(0); }
}

class ev_edt_menuEditor_it_insert {
    static function onClick($self){ ev_edt_menuEditor_btn_insert::onClick(0); }
}

class ev_edt_menuEditor_it_up {
    static function onClick($self){ ev_edt_menuEditor_btn_up::onClick(0); }
}

class ev_edt_menuEditor_it_down {
    static function onClick($self){ ev_edt_menuEditor_btn_down::onClick(0); }
}