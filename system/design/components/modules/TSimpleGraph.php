<?
global $_c;
$_c->sgori_Graphics = 0;
$_c->sgori_Bottom	= 1;
$_c->sgori_Top		= 2;
$_c->sgori_Center	= 3;
class TSimpleGraph extends TImage
{
	private $_charts;
	public function __construct( $owner = nil, $init = true, $self = nil )
	{
		parent::__construct( $owner, $init, $self );
		if( $init )
		{
			$this->_charts = array();//initial chart\\
		}
	}
	
	private function init()
	{
		if( !c($this->_canv->self) ) {
			$this->_canv = new TControlCanvas($this);
		}
	}
	private function _drawBg()
	{
		$this->_canv->clear();
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