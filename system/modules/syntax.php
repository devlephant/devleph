<?

class AOP_CodeParser
{
    var $init;
    var $length;

    var $code;
    var $tokens;

    var $index;
    var $invalidTokens;
    var $validTokens;

    function AOP_CodeParser($sCode)
    {
        $this->code = $sCode;

        // Reference: http://bugs.php.net/bug.php?id=28391
        $this->tokens = token_get_all($this->code);

        // Initial OPENTAG
        $this->init = 0; // 0: considering PHP Tokenizer removed PHP Tag Open

        // Initial CLOSETAG
        $this->length = count($this->tokens) - 1; // count() - 1: possible PHP Tag Close

        if (count($this->tokens) > 0) {
            // Correcting OPENTAG
            if (!is_array($this->tokens[0]) && $this->tokens[0] == "<") {
                // 3: PHP Tag Open - 0 => <, 1 => ?, 2 => php
                $this->init = 3;
            } elseif (is_array($this->tokens[0]) && token_name($this->tokens[0][0]) == "T_OPEN_TAG") {
                // 1: PHP Tag Open - 0 => < ? php
                $this->init = 1;
            }

            // Correcting CLOSETAG
            if (is_array($this->tokens[$this->length]) && token_name($this->tokens[$this->length][0]) != "T_CLOSE_TAG") {
                $this->length++; // Increase one (same as $l = count($tok);)
            }
        }

        $this->index = $this->init;

        // Initial Invalid Tokens (blank array means none)
        $this->invalidTokens = array();

        // Initial Valid Tokens (blank array means all)
        $this->validTokens = array();
    }


    function getToken($i)
    {
        if ($i >= 0 && $i < $this->length) {
            return $this->tokens[$i];
        }

        return null;
    }


    function getTokenName($i)
    {
        if ($i >= 0 && $i < $this->length) {
            $token = $this->tokens[$this->index];
            return (is_array($token) ? $token[1] : $token);
        }

        return null;
    }


    function setValidTokens($validTokens = array())
    {
        if (!is_array($validTokens)) {
            $validTokens = array($validTokens);
        }

        $this->validTokens = $validTokens;
    }


    function getValidTokens()
    {
        return $this->validTokens;
    }


    function setInvalidTokens($invalidTokens = array())
    {
        if (!is_array($invalidTokens)) {
            $invalidTokens = array($invalidTokens);
        }

        $this->invalidTokens = $invalidTokens;
    }


    function getInvalidTokens()
    {
        return $this->invalidTokens;
    }


    function setIndex($i)
    {
        // Only use this method if you are REALLY SURE of what you're doing
        $this->index = $i;
    }


    function getIndex()
    {
        return $this->index;
    }


    function getInit()
    {
        return $this->init;
    }


    function getLength()
    {
        return $this->length;
    }


    function getCode()
    {
        return $this->code;
    }


    function currentToken()
    {
        return $this->nextToken(false);
    }


    function currentTokenName()
    {
        return $this->nextTokenName(false);
    }


    function nextToken($increment = true)
    {
        if ($increment) {
            $this->increment();
        }

        return $this->getToken($this->index);
    }


    function nextTokenName($increment = true)
    {
        if ($increment) {
            $this->increment();
        }

        return $this->getTokenName($this->index);
    }


    function previousToken($decrement = true)
    {
        if ($decrement) {
            $this->decrement();
        }

        return $this->getToken($this->index);
    }


    function previousTokenName($decrement = true)
    {
        if ($decrement) {
            $this->decrement();
        }

        return $this->getTokenName($this->index);
    }


    function reset()
    {
        $this->index = $this->init;
    }


    function increment()
    {
        do {
            $this->index++;

            // PHP 4 Parser error prevention
            if (array_key_exists($this->index, $this->tokens)) {
                $token = $this->tokens[$this->index];
            } else {
                $this->index = $this->length;
            }
        } while($this->index < $this->length && ($this->isInvalidToken($token) || !$this->isValidToken($token)));
    }


    function decrement()
    {
        do {
            $this->index--;

            // PHP 4 Parser error prevention
            if (array_key_exists($this->index, $this->tokens)) {
                $token = $this->tokens[$this->index];
            } else {
                $this->index = -1;
            }
        } while($this->index >= 0 && ($this->isInvalidToken($token) || !$this->isValidToken($token)));
    }


    function isInvalidToken($token)
    {
        $tokenType = (is_array($token)) ? token_name((int) $token[0]) : $token;

        if (count($this->invalidTokens) < 1) {
            return false;
        }

        $return = array_search($tokenType, $this->invalidTokens);

        return ($return !== null && $return !== false);
    }


    function isValidToken($token)
    {
        $tokenType = (is_array($token)) ? token_name((int) $token[0]) : $token;

        if (count($this->validTokens) < 1) {
            return true;
        }

        $return = array_search($tokenType, $this->validTokens);

        return ($return !== null && $return !== false);
    }
}

class PHPSyntax {
    
    public $skoba;
    public $skoba_s = '{}()[]""\'\'';
    public $skoba_index;
    public $skoba_lines;
    
    public $quotes;
    public $quotes_type;
    public $quotes_line;
   
    public $slashes = 0;
    public $line = 1;
    
    public $errortype;
    public $errors;
    
    const E_STR_QUOTES = 'Unclosed quotes';
    const E_STR_SKOBA_1 = 'Unclosed "{" brackets';
    const E_STR_SKOBA_2 = 'Unclosed "(" brackets';
    const E_STR_SKOBA_3 = 'Unclosed "[" brackets';
    const E_STR_END     = 'Unclosed expression - ";"';
    const E_STR_VARNAME = 'Incorrect variable name';
    const E_STR_OBJ_NOFOUND = 'Object does not exist';
    const E_STR_DIV_ZERO    = 'Division by zero is impossible';
    const E_STR_IF_EQUALL   = 'Operation assignment in condition';
    
    
    public function __construct(){
        
        $this->skoba = array(
                             '{}',
                             '()',
                             '[]',
                             );
        $this->quotes = '"\'';
        
        $this->errortype = array (
                E_ERROR           => t("Error"),
                E_WARNING         => t("Warning"),
                E_PARSE           => t("Parsing Error"),
                E_NOTICE          => t("Notice"),
                E_CORE_ERROR      => t("Core Error"),
                E_CORE_WARNING    => t("Core Warning"),
                E_COMPILE_ERROR   => t("Compile Error"),
                E_COMPILE_WARNING => t("Compile Warning"),
                E_USER_ERROR      => t("User Error"),
                E_USER_WARNING    => t("User Warning"),
                E_USER_NOTICE     => t("User Notice"),
                E_STRICT          => t("Runtime Notice"),
                );
        
        $this->line = 1;
    }
    
    public function errType($ind){
        
        return $this->errortype[$ind];
    }
    
    public function getSkoba($sym){
        
        foreach ($this->skoba as $i=>$sk){
            
            if (strpos($sk, $sym)!==false){
                return $i;
            }
        }
        
        return null;
    }
    
    public function getLine($code, $find){
        
        $code = explode(_BR_, $code);
        foreach ($code as $line=>$text)
            if (stripos($text, $find)!==false)
                return $line+1;
            
        return null;
    }
    
    public function isString($sym, $line){
        
        
        if (!$this->slashes){
            
            if ($this->quotes_type && $this->quotes_type == $sym){
                $this->quotes_type = '';
                $result = false;
            
            } elseif (strpos($this->quotes, $sym)!==false){
                $this->quotes_type = $sym;
                $this->quotes_line = $line;
                $result = true;
            } else {
                $result = $this->quotes_type!='';
            }
            
        } else {
            
            if ($this->quotes_type)
                $result = true;
            else
                $result = false;
        }
        
        if ($sym == '\\')
            $this->slashes = ! $this->slashes;
        else
            $this->slashes = false;
            
        return $result;
    }
    
    public function checkSkoba($code){
        
        $result = '';
        for ($i=0;$i<strlen($code);$i++){
            
            $s = $code[$i];
            
            if ($s=="\n") $this->line++;
            
            if ($this->isString($s, $this->line)) continue;
            $result .= $s;
            
            $k = $this->getSkoba($s);
            if ($k!==null){
                
                $type = strpos($this->skoba[$k], $s);
                
                if ($type) // закрывающий...
                    $this->skoba_index[$k]--;
                else {
                    if ($this->skoba_index[$k]==0)
                        $this->skoba_lines[$k] = $this->line;
                        
                    $this->skoba_index[$k]++;
                }
            }
        }
        
        return $result;
    }
    
    public function checkVars($code, $org_code){
        
        $code = str_replace(_BR_,' ', $code);
        preg_match_all('/\$([a-z0-9\_\!\@\#\&]*)/i', $code, $arr);
       
       
        foreach ((array)$arr[1] as $var){
            
            if (!eregi('^([a-z\_]{1})([a-z0-9\_]*)$', $var)){
                
                $line = $this->getLine($org_code, '$'.$var);
                $this->addError(E_ERROR, self::E_STR_VARNAME, $line, '$'.$var);
            }
        }
    }
    
    
    public function checkDivZero($code, $org_code){
        
        $tmp = str_replace(_BR_,' ', $code);
        preg_match_all('/([0-9\) ]+\/0)[ \)]*\;{1,}/i', $tmp, $arr);
       
       
        foreach ((array)$arr[0] as $expr){
                
                $line = $this->getLine($code, $expr);
                $this->addError(E_WARNING, self::E_STR_DIV_ZERO, $line, $expr);
        }
    }
    
    public function checkIfEquall($code, $org_code){
        
        $tmp = str_replace(_BR_,' ', $code);
        preg_match_all('/([ ]+|^)(\}?elseif|while|do|if)[ ]+\((.*)\)/i', $tmp, $arr);
       
        foreach ((array)$arr[3] as $i=>$expr){
            
            if (eregi('([a-z0-9\*\+\/\-\%\$\@\) ]+)=([ a-z0-9\*\+\/\-\%\$\@\!\(]+)', $expr)){
                $line = $this->getLine($code, $expr);
                if ($line)
                    $this->addError(E_WARNING, self::E_STR_IF_EQUALL, $line, '= >>> == ?');
            }
        }
    }
    
    
    
    public function checkObjects($code, $org_code){
        
        $tmp = str_replace(_BR_,' ', $org_code);
        preg_match_all('/c\(\"([a-z\_0-9\-\>]+)\"\)/i', $tmp, $arr);
        preg_match_all('/c\(\\\'([a-z\_0-9\-\>]+)\\\'\)/i', $tmp, $arr2);
        $check_objs = array();
        
        $arr[1] = array_merge($arr[1], $arr2[1]);
        
        foreach ((array)$arr[1] as $obj_name){
            
            if (in_array($obj_name, $check_objs)) continue;
            
            $class = complete_Props::getClass($obj_name);
            if (!$class){
                $line = $this->getLine($org_code, 'c("'.$obj_name.'")');
                
                $this->addError(E_WARNING, self::E_STR_OBJ_NOFOUND, $line, $obj_name);
            }
            
            $check_objs[] = $obj_name;
        }
    }
    
    public function addError($type, $msg, $line = -1, $prs = array()){
        
        $this->errors[] = array('type'=>$type, 'msg'=>$msg, 'line'=>$line, 'prs'=>$prs);
    }
    
    public function initErrors(){
        
        if ($this->quotes_type){
            $this->addError(E_ERROR, self::E_STR_QUOTES, $this->quotes_line);
        }
        
        
        foreach ((array)$this->skoba_index as $k=>$value){
            
            if ($value!==0){
                
                $line = $this->skoba_lines[$k];
                switch ($k){
                    case 0: $msg = self::E_STR_SKOBA_1; break;
                    case 1: $msg = self::E_STR_SKOBA_2; break;
                    case 2: $msg = self::E_STR_SKOBA_3; break;
                }
                
                $this->addError(E_ERROR, $msg, $line);
            }
        }
    }
    
    public function check($code){
        
        $this->errors = array();
        
        $result = $this->checkSkoba($code);
        $this->checkDivZero($result, $code);
        $this->checkIfEquall($result, $code);
       // $this->checkVars($result, $code);
        $this->checkObjects($result, $code);
        
        $this->initErrors();
    }
    
    static function clearSkobki($code){
        
        $tmp = new PHPSyntax;
        $result = $tmp->checkSkoba($code);
        unset($tmp);
        return $result;
    }
    
    static function analizFile($file, $doc_root = false){
        
        $code   = ( file_get_contents($file) );
        return self::analiz($code, $doc_root);
    }
    
    static function analiz($code, $doc_root = false){
        
        if (!$doc_root)
            $doc_root = DOC_ROOT;
        
        $result['functions'] = array();
        $result['classes']   = array(); // + methods
        $result['vars']      = array();
        $result['consts']    = array();
        
        $to_add_func   = true;
        $to_add_method = false;
        $to_add_var    = true;
        $n_class       = false;
        
        $index_skoba   = 0; // {}
        $index_skoba2  = 0; // ()
    
        //$code   = ( file_get_contents($file) );
        $source = $code; //self::clearSkobki($code);
        
        $syn = new AOP_CodeParser($source);
        $last_sec = T_PUBLIC;
        foreach ($syn->tokens as $i=>$token){
           
            if (is_array($token)){
                
                list($id, $name) = $token;
                
                if (in_array($id,array(T_PUBLIC, T_PROTECTED, T_PRIVATE, T_STATIC)))
                    $last_sec = $id;                
                
				if(isset($syn->tokens[$i-2][0]))
                if ($syn->tokens[$i-2][0]==T_CLASS){
                    $result['classes'][$name] = array('name'=>$name, 'methods'=>array(),'construct'=>false);
                    $n_class = $name;
                }
                
				if(isset($syn->tokens[$i-2][0]))
                if ($syn->tokens[$i-2][0]==T_FUNCTION){
                    if(isset($syn->tokens[$i-4])){
						if ($syn->tokens[$i-4][0]==T_COMMENT){
							$desc = $syn->tokens[$i-4][1];
						}else{
							$desc = '';
						}
					}else{
						$desc = '';
					}
                    
                    $params   = array();
                    $defaults = array();
                    for($k=$i;$k<count($syn->tokens);$k++){
                            
                            if ($syn->tokens[$k][0]==T_VARIABLE){
                                $params[] = $syn->tokens[$k][1];
                                $defaults[] = null;
                            } elseif (in_array($syn->tokens[$k][0],
                                             array(T_LNUMBER,T_DNUMBER,T_CONSTANT_ENCAPSED_STRING,T_BOOL_CAST,T_ARRAY_CAST))
                                    ){
                                $defaults[count($defaults)-1] = $syn->tokens[$k][1];
                            } elseif (strtolower($syn->tokens[$k][1])=='null') {
                                $defaults[count($defaults)-1] = $syn->tokens[$k][1];
                            }
                            
                            if ($syn->tokens[$k]=='{') break;
                    }
                    
                    if ($n_class){
                        $type = '';
                        
                        if ( in_array($syn->tokens[$i-4][1],array('static','private','public')) )
                            $type = $syn->tokens[$i-4][1];
                        
                        $x_func = array('name'=>$name,'params'=>$params,'defaults'=>$defaults,'desc'=>$desc,'type'=>$type);
                        
                        if (substr($name,0,2)=='__') $x_func['type'] = 'private';
                        
                        if ($name=='__construct' || $name==$n_class)
                            $result['classes'][$n_class]['construct'] = $x_func;
                        
                        $result['classes'][$n_class]['methods'][] = $x_func;
                    } else {
                        $result['functions'][$name] = array('name'=>$name,'params'=>$params,'defaults'=>$defaults,'desc'=>$desc);
                    }
                }
                
                // свойство объекта
                if ($id==309 && in_array($syn->tokens[$i-2][0],array(T_PUBLIC, T_STATIC, 347))){
                        
                    if (count($result['classes'][$n_class]['methods'])==0){
                        
                        if ($syn->tokens[$i-2][0]==T_PUBLIC || $syn->tokens[$i-2][0]==347){
                            
                            $result['classes'][$n_class]['properties'][] =
                                array('name'=>str_replace('$','',$name), 'type'=>'public');
                        } elseif ($syn->tokens[$i-2][0]==T_STATIC){
                            $result['classes'][$n_class]['properties'][] =
                                array('name'=>$name, 'type'=>'static');    
                        }
                        
                        $last_sec = T_PUBLIC;
                    }
                }
                
                // константа класса
				if(isset($syn->tokens[$i-2][0]))
                if ($id==307 && $syn->tokens[$i-2][0]==334){
                    
                    if (count($result['classes'][$n_class]['methods'])==0){
                        // добавляем как статическое свойство, все равно эффект тот же при отображении
                        $result['classes'][$n_class]['properties'][] =
                                array('name'=>$name, 'type'=>'static');
                            
                        $last_sec = T_PUBLIC;
                    }
                }
                
                if ($id==T_VARIABLE){
                    
                    if ($index_skoba==0 && $index_skoba2==0){
                        $type = '';
                        
                        for($k=1;$k<7;$k++){
                            if ($syn->tokens[$i+$k][0]==T_NEW){
                                
                                $type = trim($syn->tokens[$i+$k+1][1]);
                                if (!$type) $type = trim($syn->tokens[$i+$k+2][1]);
                            }
                        }
                            
                        $result['vars'][$name] = array('name'=>$name,'type'=>$type);
                    }
                }
                
            } else {
                
                if ($token == '{') $index_skoba++;
                if ($token == '}') $index_skoba--;
                if ($token == '(') $index_skoba2++;
                if ($token == ')') $index_skoba2--;
                
                if ($index_skoba==0) $n_class = false;
            }
           
        }
        
        unset($syn);
        return $result;
    }
    
}
?>