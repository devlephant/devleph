<?

class Mongo {
    /* Constants */
    const VERSION = "x.x";
    const DEFAULT_HOST = "localhost" ;
    const DEFAULT_PORT = 27017;
    
    /* Fields */
    public $connected = FALSE ;
    public $status = NULL ;
    protected $server = NULL ;
    protected $persistent = NULL ;
    
    /* Methods */
    public function close(){}
    public function connect(){}
    protected function connectUtil(){}
    public function __construct($server = "mongodb://localhost:27017",  $options = array("connect" => TRUE) )
    public function dropDB( $db ){}
    public function  __get( $dbname ){}
    public function array getHosts(){}
    static function int getPoolSize(){}
    public function string getSlave(){}
    public function bool getSlaveOkay(){}
    public function array listDBs(){}
    public function array poolDebug(){}
    public function selectCollection ( $db, $collection ){}
    public function selectDB( $name ){}
    static function setPoolSize( $size ){}
    public function setSlaveOkay( $ok = true ){}
    public function switchSlave(){}
    public function __toString(){}
}