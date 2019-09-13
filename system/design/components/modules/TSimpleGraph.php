<?
global $_c;
$_c->sgori_Graphics = 0;
$_c->sgori_Bottom	= 1;
$_c->sgori_Top		= 2;
$_c->sgori_Center	= 3;
class TSimpleGraph extends TImage
{
	private $_charts;
	public function __construct( $owner = nil, $self = nil )
	{
		parent::__construct( $owner, $self );
		if( $self==nil )
		{
			$this->_charts = [];//initial chart\\
		}
	}
	
	private function _drawBg()
	{
		$this->canvas->clear();
	}
	private function _drawLine( $line )
	{
	}
	private function _drawGrid()
	{
	}
	private function _draw()
	{
		$filter = function($arr, $k)
		{
			if(!isset($arr[0][$k]))
				return 1;
			
			$res = $arr[0][$k];
			for($i=0;$i<=count($arr);$i++)
				if( $res < $arr[$i][$k] )
					$res = $arr[$i][$k];
			return $res;
		};
		
		$w = $filter($this->_charts, 'x');
		$h = $filter($this->_charts, 'y');
		
		$this->_drawBg();
		if( is_array($this->_charts) )
			foreach( $this->_charts as $chart )
			switch( $this->type )
			{
				case sgori_Bottom: {
				$this->_drawLine($chart);
				}	break;
			}
		$this->_drawGrid();
	}
}