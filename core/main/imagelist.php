<?
/*
  
  SoulEngine ImageList Library
  
  2009 ver 0.2
  
  Dim-S Software (c) 2009
  
*/
global $_c;

// ImageType
$_c->itImage = 0;
$_c->itMask  = 1;

// DrawingStyle
$_c->setConstList (array('dsFocus', 'dsSelected', 'dsNormal', 'dsTransparent'), 0);

class TImageList extends TControl {
    
    
    
    #public $imageType = (itImage, itMask)
    #public $blendColor
    #public $bkColor
    #public $masked = (true, false)
    #public $width
    #public $height
    #public $drawingStyle = (dsFocus, dsSelected, dsNormal, dsTransparent)
    
    function addFromFile($file, $color = 0){
        
        $tmp = new TBitmap;
        $tmp->loadAnyFile( $file );
        return $this->altAdd($tmp, $color);
    }
    
    function add(TBitmap $image, TBitmap $mask){
        return imagelist_add($this->self, $image->self, $mask->self);
    }
    
    function altAdd(TBitmap $image, $color = 0){
        imagelist_altadd($this->self, $image->self, $color);
    }
    
    function addMasked(TBitmap $image, $color){
        return imagelist_add_masked($this->self, $image->self, $color);
    }
    
    function insert($index, TBitmap $image, TBitmap $mask){
        return imagelist_insert($this->self, $index, $image->self, $mask->self);
    }
    
    function insertMasked($index, TBitmap $image, $color = 0){
        imagelist_insertmasked($this->self, $index, $image->self, $color);
    }
    
    function move($curIndex, $newIndex){
        imagelist_move($curIndex, $newIndex);
    }
    
    function delete($index){
        imagelist_delete($this->self, $index);
    }
    
    function getBitmap($index, TBitmap $image){
        return imagelist_get_bitmap($this->self, $index, $image->self);
    }
    
    function get_images($index){
        $bmp = new TBitmap;
        $this->getBitmap($index, $bmp);
        return $bmp;
    }
    
    function get_count(){
        return imagelist_count($this->self);
    }
    
    function get_xwidth(){
        
        return $this->get_prop('width');
    }
    
    function set_xwidth($v){
        $this->set_prop('width',$v);
    }
    
    function get_xheight(){
        return $this->get_prop('height');
    }
    
    function set_xheight($v){
        $this->set_prop('height',$v);
    }
}
?>