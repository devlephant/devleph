<?

/* cashacat */
/* qAnim v1*/

class TqAnim extends TImage{

   
	private $_timer;
	public $intervals;
	protected $frames;
	
   function __construct($onwer=nil,$init=true,$self=nil, $src=''){
    parent::__construct($onwer,$init,$self);
    if($init){
     $this->center = $this->autoPlay = true;
	 $this->_timer = gui_construct('TTimer');
		if( is_file($src) && fileExt($src) == 'gif' ){
			$__gif = new GifDecoder( imagecreatefromgif($src) );
			$this->frames = $__gif->getFrames();
			$this->intervals = $__gif->getDelays();
			$this->loop = $__gif->getLoop();
			unset( $__gif );
			
			gui_propset($this->_timer, 'Interval', '100');
			if($this->autoPlay) $this->play();
		}
	 
    }
   }

   public function get_state(){
    return $this->index;
   }

   public function set_state($index=0){
    $arr = $this->frames;
    if( $arr[$index] ){
     $img = $arr[$index];
     $this->picture->loadFromStr( $img[0], $img[1]);
     $this->index = $index;
    }
   }

   public function replace($index=false, $file=false){
    if($index!==false and $file!==false){
     if( is_file($file) ){
      $arr = $this->frames;
      $arr[$index] = array( file_get_contents($file), strtoupper(fileExt($file)) );
      $this->frames = $arr;
     }
    }
   }

   public function add($file=false){
    if($file!==false){
     if( is_file($file) ){
      $arr = $this->frames;
      $arr[] = array( file_get_contents($file), strtoupper(fileExt($file)) );
      $this->frames = $arr;
      return count($arr)-1;
     }
    }
   }

   public function delete($index=false){
    if($index!==false){
     $arr = $this->frames;
     if( is_array($arr) and $arr[$index] ){
      unset($arr[$index]);
     }
     $this->frames = array_values($arr);
    }
   }

   public function clear(){
     $this->frames = array();
     $this->picture->clear();
   }

	public function play(){
		if(!empty($this->frames)){
			$obj = $this->self;
			$slf = $this->_timer;
			gui_propset($this->_timer, 'WorkBackground', 1);
			gui_propset($this->_timer, 'OnExecute', function() use($obj, $slf){
				$obj->state++;
				if(isset($obj->intervals[$obj->state])){
					gui_propset($slf, 'Interval', $obj->intervals[$obj->state]);
				}else{
					gui_propset($slf, 'Enabled', 0);
				}
			});
		}
	}
   public function get_enable($v){
	   return $this->enabled;
   }
   public function set_enable($v){
		$this->enabled = $v;
   }
 
}