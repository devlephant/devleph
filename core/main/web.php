<?

global $_c;
$_c->CHROMIUM_EXEC_RELOAD = 1;
$_c->CHROMIUM_EXEC_GOBACK = 2;
$_c->CHROMIUM_EXEC_CANGOBACK = 3;
$_c->CHROMIUM_EXEC_GOFORWARD = 4;
$_c->CHROMIUM_EXEC_CANGOFORWARD = 5;
$_c->CHROMIUM_EXEC_SHOWDEVTOOLS = 6;
$_c->CHROMIUM_EXEC_HIDEDEVTOOLS = 7;
$_c->CHROMIUM_EXEC_HIDEPOPUP = 8;
$_c->CHROMIUM_EXEC_SETFOCUS = 9;
$_c->CHROMIUM_EXEC_RELOADIGNORECACHE = 10;
$_c->CHROMIUM_EXEC_STOPLOAD = 11;
$_c->CHROMIUM_EXEC_SETFOCUSEVENT = 12;
$_c->CHROMIUM_EXEC_SETEVENTKEY = 13;
$_c->CHROMIUM_EXEC_MOUSECLICKEVENT = 14;
$_c->CHROMIUM_EXEC_LOAD = 15;
$_c->CHROMIUM_EXEC_SCROLLBY = 16;
$_c->CHROMIUM_EXEC_CLEARHISTORY = 17;

$_c->CHROMIUM_EXEC_UNDO = 22;
$_c->CHROMIUM_EXEC_REDO = 23;
$_c->CHROMIUM_EXEC_CUT  = 24;
$_c->CHROMIUM_EXEC_COPY = 25;
$_c->CHROMIUM_EXEC_PASTE= 26;
$_c->CHROMIUM_EXEC_DEL  = 27;
$_c->CHROMIUM_EXEC_SELECTALL = 28;
$_c->CHROMIUM_EXEC_PRINT = 29;
$_c->CHROMIUM_EXEC_VIEWSOURCE = 30;
$_c->CHROMIUM_EXEC_LOADURL = 31;
$_c->CHROMIUM_EXEC_LOADSTRING = 32;
$_c->CHROMIUM_EXEC_LOADFILE = 33;
$_c->CHROMIUM_EXEC_EXECUTEJS = 34;
$_c->CHROMIUM_EXEC_ZOOM = 35;
$_c->CHROMIUM_EXEC_DEFENCODING = 37;
$_c->CHROMIUM_EXEC_DEFCSSPATH = 36;
$_c->CHROMIUM_EXEC_SOURCE = 38;
$_c->CHROMIUM_EXEC_ADDRESS = 39;

class TChromium extends TControl {
    
    
    public $_options;
    
	public function free(){
		$self = $this->self;
		chromium_free($self);
		obj_free($self);
	}
	public function get_enabled()
	{
		return true;
	}
	public function get_visible()
	{
		return true;
	}
	public function reload(){
		chromium_exec($this->self, CHROMIUM_EXEC_RELOAD, 0);
	}
	
	public function goBack(){
		chromium_exec($this->self, CHROMIUM_EXEC_GOBACK, 0);
	}
	
	public function canGoBack(){
		return chromium_exec($this->self, CHROMIUM_EXEC_CANGOBACK, 0);
	}
	
	public function goForward(){
		chromium_exec($this->self, CHROMIUM_EXEC_GOFORWARD, 0);
	}
	
	public function canGoForward(){
		return chromium_exec($this->self, CHROMIUM_EXEC_CANGOFORWARD, 0);
	}
	
	public function showDevTools(){
		chromium_exec($this->self, CHROMIUM_EXEC_SHOWDEVTOOLS, 0);
	}
	
	public function hideDevTools(){
		chromium_exec($this->self, CHROMIUM_EXEC_HIDEDEVTOOLS, 0);
	}
	
	public function hidePopup(){
		chromium_exec($this->self, CHROMIUM_EXEC_HIDEPOPUP, 0);
	}
	
	public function setFocus($enable = true){
		chromium_exec($this->self, CHROMIUM_EXEC_SETFOCUS, [(bool)$enable]);
	}
	
	public function reloadIgnoreCache(){
		chromium_exec($this->self, CHROMIUM_EXEC_RELOADIGNORECACHE, 0);
	}
	
	public function stopLoad(){
		chromium_exec($this->self, CHROMIUM_EXEC_STOPLOAD, 0);
	}
	
	public function sendFocusEvent($event){
		chromium_exec($this->self, CHROMIUM_EXEC_SETFOCUSEVENT, [(int)$event]);
	}
	
	public function sendKeyEvent($type, $key, $modifers, $sysChar, $imeChar){
		chromium_exec($this->self, CHROMIUM_EXEC_SETEVENTKEY, [(int)$type, (int)$key, (int)$modifers, (int)$sysChar, (int)$imeChar]);
	}
	
	public function sendMouseClickEvent($x, $y, $type, $mouseUp, $clickCount){
		chromium_exec($this->self, CHROMIUM_EXEC_MOUSECLICKEVENT, [(int)$x, (int)$y, (int)$type, (int)$mouseUp, (int)$clickCount]);
	}
	
	public function load($url){
		chromium_exec($this->self, CHROMIUM_EXEC_LOAD, [(string)$url]);
	}
	
	public function scrollBy($x, $y){
		chromium_exec($this->self, CHROMIUM_EXEC_SCROLLBY, [(int)$x, (int)$y]);
	}
	
	public function undo(){
		chromium_exec($this->self, CHROMIUM_EXEC_UNDO, 0);
	}
	
	public function redo(){
		chromium_exec($this->self, CHROMIUM_EXEC_REDO, 0);
	}
	
	public function cut(){
		chromium_exec($this->self, CHROMIUM_EXEC_CUT, 0);
	}
	
	public function copy(){
		chromium_exec($this->self, CHROMIUM_EXEC_COPY, 0);
	}
	
	public function paste(){
		chromium_exec($this->self, CHROMIUM_EXEC_PASTE, 0);
	}
	
	public function del(){
		chromium_exec($this->self, CHROMIUM_EXEC_DEL, 0);
	}
	
	public function selectAll(){
		chromium_exec($this->self, CHROMIUM_EXEC_SELECTALL, 0);
	}
	
	public function showPrint(){
		chromium_exec($this->self, CHROMIUM_EXEC_PRINT, 0);
	}
	
	public function viewSource(){
	    chromium_exec($this->self, CHROMIUM_EXEC_VIEWSOURCE, 0);
	}
	
	public function clearHistory(){
	    chromium_exec($this->self, CHROMIUM_EXEC_CLEARHISTORY, 0);
	}
	
	public function getAddress(){
	    chromium_exec($this->self, CHROMIUM_EXEC_ADDRESS, 0);
	}
	
	public function loadUrl($url){
		chromium_exec($this->self, CHROMIUM_EXEC_LOADURL, [(string)$url]);
	}
	
	public function loadString($str, $url = false){
	    if ( !$url )
		$url = 'file:///' . DOC_ROOT;
		
		chromium_exec($this->self, CHROMIUM_EXEC_LOADSTRING, [(string)$str, (string)$url]);
	}
	
	public function loadFile($file, $url = 'about:blank'){
		chromium_exec($this->self, CHROMIUM_EXEC_LOADFILE, [(string)$file, (string)$url]);
	}
	
	public function executeJs($js, $jsUrl = 'about:blank', $startLine = 0){
		chromium_exec($this->self, CHROMIUM_EXEC_EXECUTEJS, [(string)$js, (string)$jsUrl, (int)$startLine]);
	}
	
	public function callJs($call, $args, $aThis = null, $jsUrl = 'about:blank'){
	    
	    $this->executeJs($call.'.call('.($aThis ? (string)$aThis : 'null').', '.json_encode($args).');');
	}
	
	/* properties */
	public function get_Zoom(){
		return chromium_prop($this->self, CHROMIUM_EXEC_ZOOM, null);
	}
	
	public function set_Zoom($level){
		chromium_prop($this->self, CHROMIUM_EXEC_ZOOM, (double)$level);
	}
	
	public function set_url($url){
	    $this->loadUrl($url);
	}
	
	public function get_url(){
	    return $this->getAddress();
	}
	
	public function get_Source(){
	    
	    return chromium_exec($this->self, CHROMIUM_EXEC_SOURCE, 0);
	}
	
	public function get_defaultEncoding(){
		return chromium_exec($this->self, CHROMIUM_EXEC_DEFENCODING, 0);
	}
	
	public function set_defaultEncoding($str){
		chromium_exec($this->self, CHROMIUM_EXEC_DEFENCODING, [$str]);
	}
	
	public function get_defaultCSSPath(){
		return chromium_exec($this->self, CHROMIUM_EXEC_DEFCSSPATH, 0);
	}
	
	public function set_defaultCSSPath($str){
		chromium_exec($this->self, CHROMIUM_EXEC_DEFCSSPATH, [$str]);
	}
	
	public function set_Source($str){
	    $this->loadString( $str );
	}
	
	public function set_Html($str){
	    $this->set_Source($str);
	}
	
	public function get_Html(){
	    return $this->get_Source();
	}
	
	
	/* options */
	
	public function get_Options(){
	    
	    if (!isset($this->_options)){
		$this->_options = new TChromiumOptions(nil, false);
		$this->_options->self = gui_propGet( $this->self, 'options' );
	    }
	    return $this->_options;
	}
}

class TWebBrowser extends TChromium {}
?>