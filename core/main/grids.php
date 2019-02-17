<?

/*
  
  PHP SoulEngine
  SoulStream (c) 2010
  
  ver 1.0.3
  21/12/2009
  
  Grid Library
  
*/


class TStringGrid extends TControl {
    
    
    #public filename
    
    function setOption($name, $value = true, $ex = false){
		
		$options = array();
		if ($ex)
			$tmp = explode(',',$this->optionsEx);
		else {
			$tmp = explode(',',$this->options);
		}
		
		foreach ($tmp as $el)
		if ($el)
			$options[] = trim($el);
		
		
			
		$k = array_search($name, (array)$options);
			
		if (!$value){
			if ($k!==false)
				unset($options[$k]);
		} else {
			if ($k===false)
				$options[] = $name;
		}
		
		if ($ex){
			$this->optionsEx = implode(',', (array)$options);
		}
		else
			$this->options = implode(',', (array)$options);
	}
	
	function getOption($name, $ex = false){
		
		if ($ex)
		if (stripos($this->optionsEx, $name)!==false)
			return true;
		if (!$ex)
		if (stripos($this->options, $name)!==false)
			return true;
		
		return false;
	}
    
    
    function save($head = true){
        
        $this->saveFile($this->filename, $head);
    }
    
    function load($head = true){
        
        $this->loadFile($this->filename, $head);
    }
    
    function clear(){
        
        $this->colCount = 1;
        $this->rowCount = 1;
        $this->cells(0,0, '');
    }
    
    function setString($str, $head = true){
        
        $tmp = explode(_BR_, $str);
        $arr = array();
        
        if (!$head){
            foreach ($tmp as $line){
                $arr[] = explode(chr(9), $line);
            }
        } else {
            $colNames = explode(chr(9), $tmp[0]);
            
            for ($i=1;$i<count($tmp);$i++){
                $line = explode(chr(9), $tmp[$i]);
                
                $result = array();
                
                foreach ($colNames as $id=>$name)
                $result[$name] = $line[$id];
                
                $arr[] = $result;
            }
        }
        
        $this->setArray($arr, $head);
    }
    
    function getString($head = true){
        
        $arr = $this->getArray($head);
	
	
        if ($head){
	    $tmp[] = implode(chr(9), array_keys($arr[0]));    
	}
	
        foreach ($arr as $line){
            
            $tmp[] = implode(chr(9), $line);
        }
        
        return implode(_BR_, $tmp);
    }
    
    function loadFile($filename, $head = true){
        
        $filename = getFileName($filename);
        $str = file_get_contents($filename);
        $this->setString($str, $head);
    }
    
    function saveFile($filename, $head = true){
        
        $filename = replaceSl($filename);
        $str = $this->getString($head);
        file_put_contents($filename, $str);
    }
    
    // генерируем таблицу по массиву...
    function setArray(array $arr, $head = true){
        
        $this->clear();
        $rowCount = count($arr)+1; // кол-во строк...
        if ($rowCount == 1) return;
        
        
        if (!$head){
            
            $this->rowCount = count($arr);
            $this->colCount = count(current($arr));
            foreach ($arr as $i=>$line){
                $this->rows($i, $line);
            }
            
            return;
        }
        
        // получаем названия колонок по ключам из первого массива..
        $colNames = array_keys($arr[0]);
        $colCount = count($colNames); // кол-во колонк... 
        
        $this->colCount = $colCount;
        $this->rowCount = $rowCount;
        
        $this->fixedRows = (int)$head;
        
        // $row is array
        // $col is int
        
        $this->rows(0, $colNames); // задаем шапку таблицы
        
        $x = 1;
        foreach ($arr as $colName => $rows){
            
            $this->rows($x, $rows);
            $x++;
        }
    }
    
    function getArray($head = true){
        
        $rowCount = $this->rowCount;
        $colCount = $this->colCount;
        $result   = array();
            
        if ($head){
            
            $colNames = $this->rows(0); // достаем заголовки...
            
            for ($i=1; $i<$rowCount; $i++){
                
                $rows = $this->rows($i);
		
                foreach ($colNames as $x=>$colName){
                    
                    $rows[$colName] = $rows[$x];
                    unset($rows[$x]);
                }
                
                $result[] = $rows;
            }
            
        } else {
            
            for ($i=0; $i<$rowCount; $i++){
                 
                $result[] = $this->rows($i);
            }
        }
        
        return $result;
    }
    
    // задаем или получаем значени ячейки x,y
    function cells($x, $y, $value = null){
        
        if ($value===null)
            return grid_cells($this->self, $x, $y, null);
        else
            grid_cells($this->self, $x, $y, $value);
    }
    
    function get_col(){
        return grid_col($this->self, null);
    }
    
    function set_col($v){
        grid_col($this->self, (int)$v);
    }
    
    function get_row(){
        return grid_row($this->self, null);
    }
    
    function set_row($v){
        grid_row($this->self, $v);
    }
    
    // задаем строке в таблице массив...
    function rows($y, $arr = null){
        
        if ($arr !== null){
            if (is_array($arr))
                $arr = implode(_BR_, $arr);
                
            grid_rows($this->self, (int)$y, $arr);
        } else {
            $result = explode(_BR_, grid_rows($this->self, (int)$y, null));
            unset($result[count($result)-1]);
            return $result;
        }
    }
    
    // задаем колонку для таблицы
    function cols($x, $arr = null){
        
        if ($arr !== null){
            if (is_array($arr))
                $arr = implode(_BR_, $arr);
                
            grid_cols($this->self, (int)$x, $arr);
        } else {
            $result = explode(_BR_, grid_cols($this->self, (int)$x, null));
            unset($result[count($result)-1]);
            return $result;
        }
    }
    
    function mouseCoord($x, $y){
        
        return grid_mouseCoord($this->self, (int)$x, (int)$y);
    }
    
    // достаем координаты ячейки по координатам $x, $y
    function mouseToCell($x, $y){
        
        return grid_mouseToCell($this->self, $x, $y);
    }
    
    function get_rowSelect(){ return $this->getOption('goRowSelect'); }
    function set_rowSelect($v){ $this->setOption('goRowSelect', $v); }
    
    function get_focusSelected(){ return $this->getOption('goDrawFocusSelected'); }
    function set_focusSelected($v){ $this->setOption('goDrawFocusSelected', $v); }
    
    function get_editing(){ return $this->getOption('goEditing'); }
    function set_editing($v){ $this->setOption('goEditing', $v); }
    
    function get_hLine(){ return $this->getOption('goHorzLine'); }
    function set_hLine($v){ $this->setOption('goHorzLine',$v); }
    
    function get_vLine(){ return $this->getOption('goVertLine'); }
    function set_vLine($v){ $this->setOption('goVertLine',$v); }
    
    function get_vLineFixed(){ return $this->getOption('goFixedVertLine'); }
    function set_vLineFixed($v){ $this->setOption('goFixedVertLine',$v); }
    
    function get_hLineFixed(){ return $this->getOption('goFixedHorzLine'); }
    function set_hLineFixed($v){ $this->setOption('goFixedHorzLine',$v); }
    
    function get_rowSizing(){ return $this->getOption('goRowSizing'); }
    function set_rowSizing($v){ $this->setOption('goRowSizing', $v); }
    
    function get_colSizing(){ return $this->getOption('goColSizing'); }
    function set_colSizing($v){ $this->setOption('goColSizing', $v); }
    
    function get_colMoving(){ return $this->getOption('goColMoving'); }
    function set_colMoving($v){ $this->setOption('goColMoving', $v); }
    
    function get_rowMoving(){ return $this->getOption('goRowMoving'); }
    function set_rowMoving($v){ $this->setOption('goRowMoving', $v); }
    
    function get_tabs(){ return $this->getOption('goTabs'); }
    function set_tabs($v){ $this->setOption('goTabs',$v); }
}
?>