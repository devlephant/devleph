<?

/* mod by xsnakes */

	#01 - clearEx($fixed=true)
	#02 - addRow($index = "END")
	#03 - addCol($index = "END")
	#04 - deleteRow($index=-1, $fixed=true)
	#05 - deleteCol($index=-1, $fixed=true)
	#06 - rowHeight($index, $h)
	#07 - colWidth($index, $w)
	#08 - get_rowsHeight()
	#09 - set_rowsHeight($array)
	#10 - get_colsWidth()
	#11 - set_colsWidth($array)
	#12 - get_rowsText($fixed=true)
	#13 - set_rowsText($array, $fixed=true,$cfr=true,$cfc=true)
	#14 - get_colsText($fixed=true)
	#15 - set_colsText($array, $fixed=true,$cfr=true,$cfc=true)]

	#xx - get_array($size=false, $type="ROW", $fixed=true)
	#xx - set_array($array, $size=false, $type="ROW", $fixed=true, $cfr=true, $cfc=true)


class TStringGridMod extends TStringGrid {

	

	function __construct($onwer=nil,$init=true,$self=nil){
		parent::__construct($onwer,$init,$self);
		if($init){
			$this->font->name = "Courier New";
			$this->font->size = 9;
			$this->defaultColWidth = 100;
			$this->defaultRowHeight = 18;
			$this->rowCount = 2;
			$this->colCount = 2;
			$this->colw(0,50);
			$this->ctl3D = false;
			$this->colSizing = true;
			$this->rowSizing = true;
			$this->editing = true;
			$this->tabs = true;
			$this->focusSelected = true;
		}
	}
	
	function clearEx($fixed=true){
		if($fixed){
			$index = 0;
		}else{
			for($f = 0; $f < $grid->fixedCols; $f++){
				$fixCols[] = $grid->cols($f);
			}
			$index = $grid->fixedRows;
		}
		for($y = $index; $y < $grid->rowCount; $y++){
			$grid->rows($y, []);
		}
		if(is_array($fixCols)){
			foreach($fixCols as $x=>$arr){
				$grid->cols($x,$arr);
			}
		}
	}

	function addRow($index = "END"){
		switch ($index) {
			case "HOME" : $n = $this->fixedRows; break; // в начало
			case "PREV" : $n = $this->row; break; // выше
			case "NEXT" : $n = $this->row+1; break; // ниже
			case "END"  : $n = $this->rowCount; break; // в конец
			default : if(is_numeric($index)){$n = $index;}else{$n = $this->rowCount;}
		}
		$this->rowCount += 1;
		for($i = $this->rowCount; $i > $n; $i--){
			$this->rows($i, $this->rows($i-1));
		}
		$this->rows($n, []);
		$this->row = $n;
	}

	function addCol($index = "END"){
		switch ($index) {
			case "HOME" : $n = $this->fixedCols; break; // в начало
			case "PREV" : $n = $this->col; break; // выше
			case "NEXT" : $n = $this->col+1; break; // ниже
			case "END"  : $n = $this->colCount; break; // в конец
			default : if(is_numeric($index)){$n = $index;}else{$n = $this->colCount;}
		}
		$this->colCount += 1;
		for($i = $this->colCount; $i > $n; $i--){
			$this->cols($i, $this->cols($i-1));
		}
		$this->cols($n, []);
		$this->col = $n;
	}

	function deleteRow($index=-1, $fixed=false){
		if($index<0){
			if($this->row > $this->fixedRows){
				$index = $this->row;
			}
		}
		if($fixed){$fix = $index;}else{$fix = $this->fixedRows;}
		if($index >= $fix){
			if($this->rowCount > $this->fixedRows+1){
				for($i = $index; $i < $this->rowCount-1; $i++){
					$this->rows($i, $this->rows($i+1));
				}
				$this->rowCount -= 1;
			}else{
				$this->rows($index, []);
			}
		}
	}

	function deleteCol($index=-1, $fixed=false){
		if($index<0){
			if($this->col > $this->fixedCols){
				$index = $this->col;
			}
		}
		if($fixed){$fix = $index;}else{$fix = $this->fixedCols;}
		if($index >= $fix){
			if($this->colCount > $this->fixedCols+1){
				for($i = $index; $i < $this->colCount-1; $i++){
					$this->cols($i, $this->cols($i+1));
				}
				$this->colCount -= 1;
			}else{
				$this->cols($index, []);
			}
		}
	}

	function rowH($index, $h=NULL){ return grid_rowHeight($this->self, $index, $h); }
	function colW($index, $w=NULL){ return grid_colWidth($this->self, $index, $w); }
	function rowHeight($index, $h=NULL){ return grid_rowHeight($this->self, $index, $h); }
	function colWidth($index, $w=NULL){ return grid_colWidth($this->self, $index, $w); }

	function get_rowsHeight(){
		for($i=0; $i<$this->rowCount; $i++){
			$array[$i] = $this->rowHeight($i);
		}
		return $array;
	}

	function set_rowsHeight($array){
		for($i=0; $i<$this->rowCount; $i++){
			$this->rowHeight($i, $array[$i]);
		}
	}

	function get_colsWidth(){
		for($i=0; $i<$this->colCount; $i++){
			$array[$i] = $this->colWidth($i);
		}
		return $array;
	}

	function set_colsWidth($array){
		for($i=0; $i<$this->colCount; $i++){
			$this->colWidth($i, $array[$i]);
		}
	}

	function get_rowsText($fixed=true){
		if($fixed){
			$index = 0;
		}else{
			$index = $this->fixedRows;
			$fcols = $this->fixedCols;
		}
		for($i=$index; $i<$this->rowCount; $i++){
			$arr = $this->rows($i);
			if($fcols){
				$arr = array_slice($arr, $fcols);
			}
			$array[] = $arr;
		}
		return $array;
	}

	function set_rowsText($array, $fixed=true,$cfr=true,$cfc=true){
		foreach($array as $v){
			$max[] = count($v);
		}
		$rowCount = count($array);
		$colCount = max($max);
		if($fixed){
			$frows = 0;
		}else{
			$frows = $this->fixedRows;
			$fcols = $this->fixedCols;
			$rowCount += $frows;
			$colCount += $fcols;
		}
		$this->rowCount = $rowCount;
		$this->colCount = $colCount;
		if($cfr){
			for($i = 0; $i < $this->fixedRows; $i++){
				$this->rows($i, []);
			}
		}
		if($cfc){
			for($i = 0; $i < $this->fixedCols; $i++){
				$this->cols($i, []);
			}
		}
		$n = 0;
		for($i=$frows; $i<$rowCount; $i++){
			$arr = $array[$n++];
			if($fcols){
				$re = [];
				for($f = 0; $f < $fcols; $f++){
					$fixCols = $this->cols($f);
					$re[] = $fixCols[$i];
				}
				if( is_array($re) and is_array($arr) ){
					$arr = array_merge($re, $arr);
				}
			}
			$this->rows($i, $arr);
		}
	}

	function get_colsText($fixed=true){
		if($fixed){
			$index = 0;
		}else{
			$index = $this->fixedXcxxs;
			$frows = $this->fixedRows;
		}
		for($i=$index; $i<$this->colCount; $i++){
			$arr = $this->cols($i);
			if($frows){
				$arr = array_slice($arr, $frows);
			}
			$array[] = $arr;
		}
		return $array;
	}

	function set_colsText($array, $fixed=true,$cfr=true,$cfc=true){
		foreach($array as $v){
			$max[] = count($v);
		}
		$colCount = count($array);
		$rowCount = max($max);
		if($fixed){
			$fcols = 0;
		}else{
			$fcols = $this->fixedCols;
			$frows = $this->fixedRows;
			$colCount += $fcols;
			$rowCount += $frows;
		}
		$this->colCount = $colCount;
		$this->rowCount = $rowCount;
		if($cfr){
			for($i = 0; $i < $this->fixedCols; $i++){
				$this->cols($i, []);
			}
		}
		if($cfc){
			for($i = 0; $i < $this->fixedRows; $i++){
				$this->rows($i, []);
			}
		}
		$n = 0;
		for($i=$fcols; $i<$colCount; $i++){
			$arr = $array[$n++];
			if($frows){
				$re = [];
				for($f = 0; $f < $frows; $f++){
					$fixRows = $this->rows($f);
					$re[] = $fixRows[$i];
				}
				if( is_array($re) and is_array($arr) ){
					$arr = array_merge($re, $arr);
				}
			}
			$this->cols($i, $arr);
		}
	}

} // CLASS END

/*	standard features	*/

	# setOption($name, $value = true, $ex = false)
	# getOption($name, $ex = false)
	# save($head = true)
	# load($head = true)
	# clear()
	# setString($str, $head = true)
	# getString($head = true)
	# loadFile($filename, $head = true)
	# saveFile($filename, $head = true)
	# setArray(array $arr, $head = true)
	# getArray($head = true)
	# cells($x, $y, $value = null)
	# get_col()
	# set_col($v)
	# get_row()
	# set_row($v)
	# rows($y, $arr = null)
	# cols($x, $arr = null)
	# mouseCoord($x, $y)
	# mouseToCell($x, $y)
	# get_rowSelect()
	# set_rowSelect($v)
	# get_focusSelected()
	# set_focusSelected($v)
	# get_editing()
	# set_editing($v)
	# get_hLine()
	# set_hLine($v)
	# get_vLine()
	# set_vLine($v)
	# get_vLineFixed()
	# set_vLineFixed($v)
	# get_hLineFixed()
	# set_hLineFixed($v)
	# get_rowSizing()
	# set_rowSizing($v)
	# get_colSizing()
	# set_colSizing($v)
	# get_colMoving()
	# set_colMoving($v)
	# get_rowMoving()
	# set_rowMoving($v)
	# get_tabs()
	# set_tabs($v)