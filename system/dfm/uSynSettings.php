<?


class ev_fmEditorSettings {
    
    static $bColor;
    static $fColor;
    static $bgColor;
    static $size;
    static $font;
    static $showed;
    
    function getAttri(){
        
        $list    = c('fmEditorSettings->list');
        $prefixs = array('Comment', 'Identifier', 'Key', 'Number', 'Space', 'String', 'Symbol', 'Variable');
        $index   = $list->itemIndex;
        
        if ($index !== -1)
            return c('fmPHPEditor->SynPHPSyn')->getAttri($prefixs[$index]);
        else
            return false;
    }
    
    function bColorSelect($self, $color){
        
        $attr = self::getAttri();
        $attr->background = $color;
    }
    
    function bgColorSelect($self, $color){
        
        c('fmPHPEditor->memo')->color = $color;
    }
    
    function fColorSelect($self, $color){
        
        $attr = self::getAttri();
        $attr->foreground = $color;
    }
    
    function onActive(){
        
        ev_fmEditorSettings::$bgColor->value = c('fmPHPEditor->memo')->color;
        ev_fmEditorSettings_list::onClick(0);
        ev_fmEditorSettings::updateHighLightCfg();
    }
    
    function getHighlight(){
        
        $files = findFiles(SYSTEM_DIR.'/myprofile/highlight/','ini');
        $files = array_merge( $files, findFiles(DS_USERDIR.'/highlight/','ini') );
        
        foreach ($files as $file){
            $lines[] = basenameNoExt($file); 
        }
        
        $lines = array_unique($lines);
        return (array)$lines;
    }
    
    function updateHighLightCfg(){
        
        c('fmEditorSettings->c_config')->text = self::getHighlight();
        //c('fmEditorSettings->c_config')->itemIndex = c('fmEditorSettings->c_config')->items->count - 1;
		c('fmEditorSettings->c_config')->items->selected = myOptions::get('syntax','highlight', 'Notepad++ Style');
    }
    
    function saveHightLight($name){
        
        c('fmPHPEditor->SynPHPSyn')->saveToArray($arr);
        $arr['main']['color'] = c('fmPHPEditor->memo')->color;
        $arr['main']['SelectedColorBG'] = gui_propGet( c('fmPHPEditor->memo')->SelectedColor, 'Background' );
        $arr['main']['SelectedColorFG'] = gui_propGet( c('fmPHPEditor->memo')->SelectedColor, 'Foreground' );
        $arr['main']['ActiveLineColor'] = c('fmPHPEditor->memo')->ActiveLineColor;
        
        $arr['gutter']['color'] = gui_propGet( c('fmPHPEditor->memo')->gutter, 'color' );
        $arr['gutter']['fontcolor'] = gui_propGet( c('fmPHPEditor->memo')->gutter, 'font.color' );
        
        $ini = new TIniFileEx;
        $ini->arr = $arr;
        $ini->filename = DS_USERDIR.'/highlight/'.$name.'.ini';
        $ini->updateFile();
		
		EditorSynt::UnsetSyntaxes();
		EditorSynt::MainStart();
    }
    
    function loadHightLight($name){
        
        $file = DS_USERDIR.'/highlight/'.$name.'.ini';
        if (! file_exists($file) )
            $file = SYSTEM_DIR.'/myprofile/highlight/'.$name.'.ini';
            
        if (!$file) continue;
        
        $ini = new TIniFileEx($file);
        c('fmPHPEditor->SynPHPSyn')->loadFromArray($ini->arr);
        c('fmPHPEditor->memo')->color = $ini->read('main','color',clWhite);
        
		//c('fmPHPEditor->l_eventinfo')->font->color = clGray;
		//c('fmPHPEditor->l_eventinfo')->color = $ini->read('gutter','color',clWhite);
		//c('fmPHPEditor->l_eventinfo')->transparent = False;
		c('fmPHPEditor->memo')->ActiveLineColor = $ini->read('main','ActiveLineColor',c('fmPHPEditor->memo')->color);
        
        gui_propSet( c('fmPHPEditor->memo')->gutter, 'color', $ini->read('gutter','color',clWhite) );
        gui_propSet( c('fmPHPEditor->memo')->gutter, 'font.color', $ini->read('gutter','fontcolor',clGray) );
        gui_propSet( c('fmPHPEditor->memo')->SelectedColor, 'background', $ini->read('main','SelectedColorBG',c('fmPHPEditor->memo')->color) );
        gui_propSet( c('fmPHPEditor->memo')->SelectedColor, 'foreground', $ini->read('main','SelectedColorFG',c('fmPHPEditor->memo')->font->color ) );
        
		EditorSynt::UnsetSyntaxes();
		myOptions::set('syntax','highlight', $name);
		
		EditorSynt::MainStart();
    }
    
    function deleteHighlight($name){
        
        $file = DS_USERDIR.'/highlight/'.$name.'.ini';
        $file2 = SYSTEM_DIR.'/myprofile/highlight/'.$name.'.ini';
		
        if (file_exists($file))
		{
            unlink($file);  
			
			c('fmEditorSettings->c_config')->itemIndex=0;
			c('fmEditorSettings->list')->itemIndex=0;
			
			EditorSynt::UnsetSyntaxes();
			EditorSynt::MainStart();
		}
		elseif( ! file_exists($file) and file_exists( $file2 ))
			messageBox(t('Unable to remove the system highlighting'), '', MB_OK+MB_ICONWARNING);
		elseif( ! file_exists($file) and ! file_exists( $file2 ) )
			messageBox(t('Unable to remove the highlighting, file not found'), '', MB_OK+MB_ICONERROR);
    }
    
    function sizeChange($self)
    {
        $self = c($self);
        
        //c('fmPHPEditor->memo')->font->size = (int) $self->text;
        $int = (int) $self->Text;
        if( $int < 1 )
            $int = 1;
        
        gui_stringToComponent( c('fmPHPEditor->memo')->self, '
        object memo: TSynEdit
            Gutter.Font.Size = '.$int.'
            Font.Size = '.$int.'
        end
        ');
        
    }
    
    function fontChange($self)
    {
        $self = c($self);
        
        //c('fmPHPEditor->memo')->font->size = (int) $self->text;
        $font = new TFontDialog;
        
        $font->font->name = c("fmPHPEditor->memo")->font->name;
        $font->font->style = c("fmPHPEditor->memo")->font->style;        
        $font->font->size = c("fmPHPEditor->memo")->font->size;
        
        if( $font->execute() )
        {
            $name = $font->font->name;
            $Size = (int) $font->font->size;
            
			c('fmPHPEditor->memo')->Gutter->Font->Name = c('fmPHPEditor->memo')->Font->Name = $name;
            
            self::$size->text = $Size;
            self::$font->caption = $name;
        }
		$font->free();
		c("fmEditorSettings")->toFront();
    }
    
    function onShow(){
        
        $form = c('fmEditorSettings');
        $group= c('fmEditorSettings->groupBox');
        
        if( self::$showed ) return;
        self::$showed=1;
        
        self::$bColor = new TEditColorDialog( $form );
        self::$bColor->parent = $group;
        self::$bColor->x = 90;
        self::$bColor->y = 28;
        self::$bColor->w = 215;
        self::$bColor->onSelect = 'ev_fmEditorSettings::bColorSelect';
        
        self::$fColor = new TEditColorDialog( $form );
        self::$fColor->parent = $group;
        self::$fColor->x = 90;
        self::$fColor->y = 55;
        self::$fColor->w = 215;
        self::$fColor->onSelect = 'ev_fmEditorSettings::fColorSelect';
        
        self::$bgColor = new TEditColorDialog( $form );
        self::$bgColor->parent = $form;
        self::$bgColor->y = 184;
        self::$bgColor->x = 90;
        self::$bgColor->w = 160;
        self::$bgColor->onSelect = 'ev_fmEditorSettings::bgColorSelect';
        
        self::$size = new TEdit( $form );
        self::$size->parent = $form;
        self::$size->text = c("fmPHPEditor->memo")->font->size;
        self::$size->y = 206;
        self::$size->x = 90;
        self::$size->w = 80;
        self::$size->onChange = 'ev_fmEditorSettings::sizeChange';
        
        self::$font = new TLabel( $form );
        self::$font->parent = $form;
        self::$font->caption = c("fmPHPEditor->memo")->font->name;
        self::$font->hint = 'Изменить';
        self::$font->autoSize = false;
        self::$font->y = 228;
        self::$font->x = 90;
        self::$font->w = 80;
        self::$font->h = 22;
        self::$font->font->color = clGray;
        self::$font->alignment = taLeftJustify;
        self::$font->layout = tlCenter;
        self::$font->onClick = 'ev_fmEditorSettings::fontChange';
        self::$font->cursor = crHandPoint;
        

        self::onActive();
    }
    
    function getStyle($style, $checked, $val){
        
        $style = str_ireplace($val,'',$style);
        $style = str_replace(' ','',$style);
        $style = str_replace(',,',',',$style);
        if (substr($style,-1)==',') $style = substr($style,0,-1);
        
        if ($checked)
            $style .= $style ? ','.$val : $val;
        
        return $style;
    }
}


class ev_fmEditorSettings_c_bold {
    
    function onMouseUp($self){
        
        $attr = ev_fmEditorSettings::getAttri();
        if ($attr)
            $attr->style = ev_fmEditorSettings::getStyle($attr->style, c($self)->checked, 'fsBold');
    }
}


class ev_fmEditorSettings_c_italic {
    
    function onMouseUp($self){
        
        $attr = ev_fmEditorSettings::getAttri();
        if ($attr)
            $attr->style = ev_fmEditorSettings::getStyle($attr->style, c($self)->checked, 'fsItalic');    
    }
}

class ev_fmEditorSettings_c_underline {
    
    function onMouseUp($self){
        
        $attr = ev_fmEditorSettings::getAttri();
        if ($attr)
            $attr->style = ev_fmEditorSettings::getStyle($attr->style, c($self)->checked, 'fsUnderline');
    }
}

class ev_fmEditorSettings_list {
    
    function onClick($self){
        
        $attr = ev_fmEditorSettings::getAttri();
        if ($attr){
            
            ev_fmEditorSettings::$bColor->value = $attr->background;
            ev_fmEditorSettings::$fColor->value = $attr->foreground;
            c('fmEditorSettings->c_bold')->checked = strpos($attr->style, 'fsBold')!==false;
            c('fmEditorSettings->c_italic')->checked = strpos($attr->style, 'fsItalic')!==false;
            c('fmEditorSettings->c_underline')->checked = strpos($attr->style, 'fsUnderline')!==false;
        }
    }
}

class ev_fmEditorSettings_c_config {
    
    function onChange($self){
        
        $files = c($self)->items->lines;
        $index = c($self)->itemIndex;
        ev_fmEditorSettings::loadHightLight($files[$index]);
    }
}

class ev_fmEditorSettings_btn_addcfg {
    
    function onClick($self){
        
        $self  = c('fmEditorSettings->c_config')->self;
        $files = c($self)->items->lines;
        $index = c($self)->itemIndex;
        $name  = inputText(t('Add highlight'), t('Name'), $files[$index]);
        $name  = str_ireplace(array('?','\\','/','>','<','|','"',':'),'', $name);
        
        if ($name){
            ev_fmEditorSettings::saveHightLight($name);
            ev_fmEditorSettings::updateHighLightCfg();
        }
    }
}

class ev_fmEditorSettings_btn_delcfg {
    
    function onClick($self){
        
        $self  = c('fmEditorSettings->c_config')->self;
        $files = c($self)->items->lines;
        $index = c($self)->itemIndex;
        
        if (!$files[$index]) return;
        
        if (confirm(t('To delete "%s" highlight?', $files[$index]))){
            
            $name = $files[$index];
            if ($name){
                ev_fmEditorSettings::deleteHighlight($name);
                ev_fmEditorSettings::updateHighLightCfg();
            }
        }
    }
}