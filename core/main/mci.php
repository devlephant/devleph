<?

class cMCIPlayer extends _Object{
    
    
    
    public $file;
    public $is_play = false;
    
    private $_enable = false;
    
    function __construct(){
        $this->is_play = false;
        $this->enable  = true;
    }
    
    function get_filename(){
        return $this->file;
    }
    
    function set_filename($v){
        
        $this->file = getFileName($v);
        mci_command('filename',$this->file);
    }
    
    function play(){
        
        mci_command('play',0);
        $this->is_play = true;
    }
    
    function open(){
        mci_command('open',0);
    }
    
    function stop(){ 
        
        mci_command('stop',0);
        $this->is_play = false;
    }
    
    function pause(){
        
        mci_command('pause',0);
        $this->is_play = !$this->is_play;
    }
    
    function get_position(){

        return mci_command('position',false);
    }
    
    function set_position($v){
        mci_command('position',$v);
    }
    
    function get_length(){
        return mci_command('length',0);
    }
    
    function get_start(){
        return mci_command('start',0);
    }
    
    function get_startpos(){
        return mci_command('startpos',0);
    }
    
    function get_endpos(){
        return mci_command('endpos',0);
    }
    
    function eject(){
        return mci_command('eject',0);
    }
    
    function set_enable($v){
        mci_command('enable',$v);
        $this->_enable = $v;
    }
    
    function get_enable(){
        
        return (bool)$this->_enable;
    }
    
    function set_autoopen($v){
        mci_command('autoopen',$v);
    }
    
    function set_autorewind($v){
        mci_command('autorewind',$v);
    }
    
    function set_autoenable($v){
        mci_command('autoenable',$v);
    }
    
    function set_shareable($v){
        mci_command('shareable',$v);
    }
}
?>