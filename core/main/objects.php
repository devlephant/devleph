<?
/*
  
  PHP4Delphi Objects Library
  
  2019 ver 4
  
  Classes:
  _Object, TObject, TComponent, TFont, TRealFont, TControl
  
*/
define('nil',-1);

define('OS_WIN',1);
define('OS_UNIX',2);
define('OS_MACOS',3);
define('__SYSTEM__',OS_WIN);

    switch(__SYSTEM__){
		case OS_WIN:	define('_BR_',chr(13).chr(10)); break;
		case OS_UNIX:	define('_BR_',chr(13)); break;
		case OS_MACOS:	define('_BR_',chr(10)); break;
		default:		define('_BR_',chr(13).chr(13));
    }
    
global $_c;
//Константы, отвечающие какой тип свойства передан/взят
$_c->tkUnknown		= 0;
$_c->tkInteger		= 1;
$_c->tkChar			= 2;
$_c->tkEnumeration	= 3;
$_c->tkFloat		= 4;
$_c->tkString		= 5;
$_c->tkSet			= 6;
$_c->tkClass		= 7;
$_c->tkMethod		= 8;
$_c->tkWChar		= 9;
$_c->tkLString		= 10;
$_c->tkWString		= 11;
$_c->tkVariant		= 12;
$_c->tkArray		= 13;
$_c->tkRecord		= 14;
$_c->tkInterface	= 15;
$_c->tkInt64		= 16;
$_c->tkDynArray		= 17;
$_c->tkUString		= 18;
$_c->tkClassRef		= 19;
$_c->tkPointer		= 20;
$_c->tkProcedure	= 21;

function rtti_call($obj,$prop,$values=false){
		if( is_array($values) ) { //проверяет входящие аргументы на содержание объектов
			foreach($values as $key=>$val )
			if( is_object($val) ) { //Опять таки, проверочка на объекты
				if( isset($val->self) ) //Если объект у нас VCL (нуу, предположительно)
					if( gui_isset($val->self) ) { //если объект у нас VCL (точный анализ!)
						$values[$key] = $val->self; //Заменяем позицию в массиве, жёсткий костыль...
					} else{
						trigger_error('Cannot use custom objects in RTTI VCL methods', E_USER_ERROR);//посылаем пользователя в яму
						return;
					}
			}
			
			$f = gui_methodCall($obj->self, $prop, $values); //вызываем метод с передачей аргументов
		}else $f = gui_methodCall($obj->self, $prop); //		вызываем метод без передачи аргументов 
												//случай, если аргументы не были переданы в функцию
	if(gui_methodrtype($obj->self, $prop) == tkClass)//случай, если возвращаемое значение - объект
	{
		$f = class_exists(gui_class($f))? _c($f): $f; 		//костыль с функцией c()
	}elseif(gui_methodrtype($obj->self, $prop) == tkPointer){
		return new Pointer($f);
	}
	return $f;
}
class Pointer
{
	public function __construct($self)
	{
		$this->self = $self;
	}
}	
/* Class for Object with property ala java */
class _Object {  
    
    protected $props = [];
    
    function __get($nm) {
	    $s = 'get_'.$nm;
	    $s2 = 'getx_'.$nm;
	    $isset = true;
	    if (method_exists($this,$s2)){
		    return $this->$s2();
	    } elseif (method_exists($this,$s))
		    return $this->$s();
	    elseif (property_exists($this,$nm))
		    return $this->$nm;
	    elseif (array_key_exists($nm,$this->props) && method_exists($this,'setx_'.$nm)){
		    return $this->__getPropEx($nm);
	    } elseif (array_key_exists($nm,$this->props)) {
		return $this->props[$nm];
	    } else {
			    return -908067676;
	    }
     }
    
    function __set($nm, $val) {
        
	$s = 'set_'.$nm;
	$s2 = 'setx_'.$nm;
	    if (property_exists($this,$nm)){
		$this->$nm = $val;
	    } elseif (method_exists($this,$s2)) {
		$this->props[$nm] = $val;
	    }
	
	    if (method_exists($this,$s))
	      $this->$s($val);
	    if (method_exists($this,$s2))
	      $this->$s2($val);
	  
		if(!method_exists($this,$s2) && !method_exists($this,$s2) && !property_exists($this,$nm))
			if( rtti_exists($this, $nm) )
				rtti_set($this, $nm, $val);
     }
	 
	function __call($prop, $args){
		if (gui_methodExists($this->self, $prop)) {
		if(!is_array($args))
			return rtti_call($this, $prop, false);
		if( empty($args) )
			return rtti_call($this, $prop, false);
		return rtti_call($this, $prop, $args);
		}
	 }
}

/* General class TObject from Delphi */
class TObject extends _Object {
    
    public $self;
    
    function get_className(){
	return rtti_class($this->self);
    }
    
    function isClass($class){
	if (is_array($class)){
	    $s_class = strtolower($this->get_className());
	    foreach ($class as $el)
		if (strtolower($el)==$s_class)
		    return true;
	    return false;
	} else {
	    return strtolower($class)==$s_class;
	}
    }
    
    function __construct($init = true){
        $this->self = component_create(__CLASS__,nil);
    }
    
    function free(){
	
		if (class_exists('animate'))
			animate::objectFree($this->self);
		gui_destroy($this->self);
		//obj_free($this->self);	
    }
	
	function safeFree(){
		
		if (class_exists('animate'))
			animate::objectFree($this->self);
		gui_safeDestroy($this->self);
	}
    function destroy(){
        $this->free();
    }

}

function to_object($self, $type='TControl'){ //самый интересный и ужасный костыль DS
	$type = trim($type);
        
	  if ( class_exists($type)) //Если запрашиваемый делфи-класс существует в виде обёртки, то...
        return new $type(nil,false,$self);//Создаём екземпляр его php-обёртки
	
    return false; //В ином случае возвращаем False (ложь, нифига, тусс)
}



function asObject($obj,$type) //синоним функции описанной выше
{
    return to_object($obj->self,$type);
}

function reg_object($form,$name) //ещё один синоним, но с какой-то странной разницей...
								//функцию reg_component не нашёл, так что пока одни вопросы.
								//Функция reg component ищет компонент по владельцу и имени(глобально), возвращая его ID
								//ReturnValue := integer(FindGlobalComponent(GetFormFromName(Parameters[0].Value),Parameters[1].Value))
{
    return to_object(reg_component($form,$name));
}

function setEvent($form,$name,$event,$func){
    $obj = reg_object($form,$name);
	set_event( $obj->self, $event, $func );
    //set_event($obj->self,$event,$func);
}
function findComponent($str,$sep = '->',$asObject='TControl'){
    global $SCREEN, $COMPONENT_COOL_CACHE;
    //переменная COMPONENT_COOL_CACHE использовалась для хранения php-объектов (обёрток), я их вырезал, сейчас она не нужна
	//внимание: так делать НЕ НАДО, для хранения объектов лучше используйте статический класс (синглтон)
    $str = str_replace('.', $sep, $str);
    $names = explode($sep,$str);
    $owner = $GLOBALS['APPLICATION'];//первый объект у нас - TApplication, по нему ищем уже дочерние объекты
    $x     = true;
    
    for ($i=0;$i<count($names);$i++){
	
	if ( !$owner ) return null; //если каким-то образом объект не был найден (например удалён или не существует вообще)
    
        $owner = $owner->findComponent($names[$i]);//ищем дочерний объект, далее проверка на удачность
		//например если это TButton, а не TForm, объект найден не будет, т.к имя использовано в контексте события 
		//(т.е имя используется событием на компоненте для обращения к компоненту той-же формы, на которой он находится) 
		if ($x && !$owner){
			//а вот это костыль из студии, он проверяет не было ли задано событием его самое местонахождения
			//см. процедура SetEventInfo (класс __exEvents)
			//далее данные из SetEventInfo удаляются через freeEventInfo
				//p.s в этом месте можно поставить хук на событие для отладки
			if(isset($GLOBALS['__ownerComponent'])){
				if ($GLOBALS['__ownerComponent']){
					$owner = c($GLOBALS['__ownerComponent']); //если инфа о родителе есть, он берётся из неё
				}else{
					$owner = $SCREEN->activeForm; //если такой инфы нет, он берётся по учтению активной формы
					//в данном случае обращение из TPanel, TPageControl к дочерним компонентам объекта неактуально, оно
					//уйдёт вникуда, если информация об событии не была инициализирована через setEventInfo
				}
			}else{
				//та-же самая проверка, но на случай первого обращения к компоненту после запуска приложения
				$owner = $SCREEN->activeForm;
			}
			
			$i--;
			$x = false;
			
		}
    }
    
	//возвращаем наш компонент, в случае если такового нет, я переместил возвращение в код выше (см. цикл for /\)
    return $owner;
}
function rtti_DClass($name) //возврашает настоящий класс из псевдо-класса
{
	$name = is_object($name)?get_class($name):$name;
	while( !gui_class_isset($name) && (bool)strlen($name) )
		{
			$name = get_parent_class($name);
		}
		return $name;
}
function rtti_class($self) //Возвращает Delphi-класс компонента/объекта
{
    
    $help = control_helpkeyword($self, null); //Получает ht-help-keyword, в него Dim-S
											 //Записывает названия пользовательских классов, на базе настоящих VCL-классов
											//Ужасный костыль, следует как-то иначе реализовать функцию создания пользовательских
										   //Компонентов
    if ($help){
		//Тут происходит чтение информации helpKeyword (по сути сериализованного массива, кстати в него же записываются свойства)
	    $help = uni_unserialize($help);
		//Ну и поиск имени класса
	    if (class_exists($help['CLASS']))
			return $help['CLASS'];

	    return gui_class($self);
    }
    
    //иначе возвращаем оригинальный класс, мда...
    return gui_class($self);
}

function _c($self = false, $check_thread = true){
	if( is_object($self) ) return $self;   
	if( isset($GLOBALS['THREAD_SELF']) )	
     if ( $check_thread && $GLOBALS['THREAD_SELF'] )
	    return new ThreadDebugClass($self);
    
     if ($self===false) return 0;
	
     return to_object($self,rtti_class($self));
}
function c_Alias($org, $alias){
    
    $GLOBALS['__OBJ_ALIAS'][$org][] = $alias;
}
function c($str, $check_thread = true){
	if( is_object($str) ) return $str;
	if( $check_thread && isset($GLOBALS['THREAD_SELF']) ) {
		return ThreadObjectReceiver::c($str);
	} elseif(is_numeric($str))
	{
		return to_object($str,rtti_class($str));		
	} else {
		if (isset($GLOBALS['__OBJ_ALIAS']))
		    foreach ($GLOBALS['__OBJ_ALIAS'] as $org=>$alias)
				$str = str_ireplace($alias, $org, $str);
		$res = findComponent($str);
	}

    return is_object($res)? to_object($res->self,rtti_class($res->self)): new DebugClass($str);
}

function с($str, $check_thread = false){
    return c($str, $check_thread);
}

// cSetProp('form.object.caption', 'text')
function cSetProp($str, $value){
    
    $str = str_ireplace(['font.', '->'],['font','.'],$str);
    $obj = c(substr($str, 0, strrpos($str,'.')));
    $method = substr($str, strrpos($str, ".")+1, strlen($str) - strrpos($str, '.'));

    if ( is_object($obj) ) {
		$obj->$method = $value;
		return true;
    }

	return false;
}

// cGetProp('MainForm->Button_1->Caption');
function cGetProp($str){
    
    $str = str_ireplace(['font.', '->'],['font','.'],$str);
    
    $obj = c(substr($str, 0, strrpos($str,'.')));
    $method = substr($str, strrpos($str, ".")+1, strlen($str) - strrpos($str, '.'));

	return is_object($obj)? $obj->$method: NULL;
}

// alias of cGetProp
function p($str){
    return cGetProp($str);
}

// cCallMethod('form.object.setFocus')
function cCallMethod($str){
    
    $str = str_ireplace(['font.', '->'],['font','.'],$str);
    $obj = c(substr($str, 0, strrpos($str,'.')));
    $method = substr($str, strrpos($str, ".")+1, strlen($str) - strrpos($str, '.'));

	return is_object($obj)? $obj->$method(): NULL;
}

function rtti_set($obj, $prop, $val)
	{
		
		$obj = is_object($obj)?$obj->self:$obj;
		if( !gui_propExists($obj, $prop) ) return;
		if( gui_propType($obj, $prop) == tkEvent) return;
		if( is_callable($val) ){
			if( gui_propType($obj, $prop) == 8) return;
		}elseif( is_object($val) ) //Если в функцию передали объект
		{
			if( isset($val->self) ) //И, Если у объекта есть ->self
								   //По-другому я хз как проверять объект взят из делфи или нет, может потом составлю реестр классов 
								  //с помощью UnitClass, и уже там буду проверять...
				if( is_numeric( $val->self ) and gui_propType($obj, $prop) == tkClass ) { //Если тип свойства - объект
					gui_propSet($obj, $prop, $val->self); //Функция для задания свойства, по-хорошему, стоит объединить и поставить проверку, сейчас займусь
					//$obj - объект, $prop - свойство, $val - SELF-объекта
					return; 
				}
		} elseif( is_array($val) )$val = '['. implode(',', $val) . ']';

    gui_propSet($obj, $prop, $val);
	//$obj - объект, $prop - свойство, $val - значение свойства
}

function rtti_get($obj,$prop){
	
	if( gui_propExists($obj->self, $prop) ){
		$f = gui_propGet($obj->self, $prop);
   if( is_numeric( $f ) and gui_propType($obj->self, $prop) == tkClass ) { // Проверка типа свойства, если свойство является объектом, то, возвращаем как объект
   //Костыль ниже \/    \/
	   if( class_exists( gui_class($f) ) ) {
		   
			$f = _c($f);
	   }
   } 	

   return $f;
	}
}
function rtti_exists($obj,$prop){
   return gui_propExists($obj->self, $prop);
}

function rtti_is_object($obj, $class){
    return gui_is($obj->self, $class);
}

function get_owner($obj){
   return gui_owner($obj->self);
}

function obj_create($class,$owner){
    
	if (is_object($owner) && property_exists($owner, 'self')){
		return component_create($class,$owner->self);
	}
	else
		return component_create($class,nil);
}

function set_event($self, $event, $value){
	    if( is_array($value) )
		{
			if( is_callable($value[0]) )
				$r = event_set($self, $event, $value[0]);
			else
				return FALSE;
			
			foreach( array_slice($value, 1) as $Add )
				event_add($self, $event, $Add);
				return $r;
	    } else event_set($self, $event, $value);
}

function uni_serialize($str){
	return base64_encode(igbinary_serialize($str));
}

function uni_unserialize($str){
	    
	    $st = dsErrorDebug::ErrStatus(0);
		dsErrorDebug::clearErr();
	    $result = igbinary_unserialize(base64_decode($str));
	    
	    if ( dsErrorDebug::getLastMsg() ){
			$result = unserialize(base64_decode($str));
	    }
	    dsErrorDebug::ErrStatus($st);
	    
	    return $result;
}

/* TComponent class ala Delphi */
class TComponent extends TObject {
	
	#public hekpKeyword // здесь храняться все нестандартные свойства
	
	function valid(){
	    return true;
	}
	
	function getHelpKeyword(){
	    
	    return control_helpkeyword($this->self, null);
	}
	
	function setHelpKeyword($v){
	    control_helpkeyword($this->self, $v);
	}
	
	// доп инфа для нестандартных свойств
	function __addPropEx($nm, $val){

	    $class = get_class($this);		    
	    $result = uni_unserialize($this->getHelpKeyword());
	    
	    $nm = strtolower($nm);
	    
	    if ($val===NULL){
		if ( $result ) unset($result['PARAMS'][$nm]);
	    }  else
		$result['PARAMS'][$nm] = $val;
	    
	    
	    $this->setHelpKeyword( 
			uni_serialize(
					[
						  'CLASS' => $class,
						  'PARAMS'=> $result['PARAMS'], 
					]
				)
			);
	}
	
	function __setClass(){
	    $class = get_class($this);	
	    $result = uni_unserialize($this->getHelpKeyword());
	    $this->helpKeyword = uni_serialize(
				[
					  'CLASS' => $class,
					  'PARAMS'=> $result['PARAMS'] 
				]
			);
	}
	
	// достаем свойство...
	function __getPropEx($nm){
	    
	    $result = uni_unserialize(control_helpkeyword($this->self, null));
			
		return $result['PARAMS'][strtolower($nm)];
	}
	
	static function __getPropExArray($self){
	    
	    $result = uni_unserialize(control_helpkeyword($self, null));	    
	    return $result['PARAMS'];
	}
	
	function __setAllPropEx($init = true){
	    
	    if ($init)
			$this->__setClass();
	}
	
	function __setAllPropX(){
	    $result = uni_unserialize(  $this->getHelpKeyword()  );
	    
	    foreach ((array)$result['PARAMS'] as $prop=>$value){
		
			$this->props[strtolower($prop)] = $value;
			$this->$prop        = $value;
	    }
	}
	
	function __initComponentInfo(){
	    
	    $this->visible = $this->avisible;
	    $this->enabled = $this->aenabled;
	}
	function __construct($onwer = nil,$init = true,$self = nil)
	{
	    if ($init){
			$this->self = obj_create(rtti_DClass($this), $onwer);
	    }
	    
        if ($self !== nil)
             $this->self = $self;
		
	   $this->__setAllPropEx($init);
	}
	
	function set_prop($prop,$val){
		rtti_set($this,$prop,$val);
	}
    
	function call_method($prop, $args = false ){
		if(!is_array($args))
			return rtti_call($this, $prop, false);
		if( empty($args) )
			return rtti_call($this, $prop, false);
		return rtti_call($this, $prop, $args);
	}
	
	function get_prop($prop){
		$result = rtti_get($this,$prop);
		
		if ($result==='True') $result = true;
		elseif ($result==='False') $result = false;
		
		return $result;
	}
	
	function exists_prop($prop){
		return rtti_exists($this,$prop);
	}
	
	function __set($nm,$val){
		
		$nm = strtolower($nm);
		$class = rtti_DClass($this);
		if (!method_exists($this,'set_'.$nm))
		if ($class!=='TWebBrowser' && $class!=='TScreenEx' && $class!=='TPen' && $class!=='TImageList'){
		    
		    if ($nm=='visible'){
				return control_visible($this->self, $val);
		    } elseif ($nm=='left'){
				return control_x($this->self, $val);
		    } elseif ($nm=='top'){
				return control_y($this->self, $val);
		    } elseif ($nm=='width'){
				return control_w($this->self, $val);
		    } elseif ($nm=='height'){
				return control_h($this->self, $val);
		    }
		}
				  
		if (strtolower(substr($nm,0,2)) == 'on'){
		    //if ( !method_exists($this, 'set_'.$nm) ){
		    $result = set_event($this->self,$nm,$val);
		    if ( method_exists($this, 'set_'.$nm) ){
				$method = 'set_'.$nm;
				$this->$method($val);
		    }
		    if ($result) return;
		}
		
		if (!$this->exists_prop($nm)){
				    
			$this->__addPropEx($nm,$val);
			parent::__set($nm,$val);
		} else {
		    $s = 'set_'.$nm;
		    if (method_exists($this,'set_'.$nm))
				$this->$s($val);
		    else
				$this->set_prop($nm,$val);
		}
	}
	
	function __get($nm){
            
	    $nm = strtolower($nm);
	    $res = parent::__get($nm);
	    $class = rtti_DClass($this);
		if (!method_exists($this,'get_'.$nm))
		if ($class!=='TScreenEx' && $class!=='TPen' && $class!=='TImageList'){
		    
		    if ($nm == 'visible'){
				return control_visible($this->self, null);
		    } elseif ($nm=='left'){
				return control_x($this->self, null);
		    } elseif ($nm=='top'){
				return control_y($this->self, null);
		    } elseif ($nm=='width'){
				return control_w($this->self, null);
		    } elseif ($nm=='height'){
				return control_h($this->self, null);
		    }
		}
			    
	    if (is_int($res) && ($res == -908067676)){ //Вот этот инопланетный код ошибки, непоймёшь откуда взятый, даже нет для него константы у Dim-s, просто число
		    
		    $result = $this->__getPropEx($nm);
		    if ($result === NULL)
				return $this->get_prop($nm);
		    else
				return $result;
		} else
			return $res; 
	}
	
	function __call($nm, $val){
		$vcall = 'call_' . $nm;
		if( !isset($this->$vcall) )
			return $this->call_method($nm, $val);
		
		return $this->$vcall($val);
	}
	
	function get_x(){
	    return $this->left;
	}
	
	function set_x($v){
	    $this->left = (int)$v;
	}
	
	function get_y(){
	    return $this->top;
	}
	
	function set_y($v){
	    $this->top = (int)$v;
	}
	
	function get_w(){
	    return $this->width;
	}
	
	function set_w($v){
	    
	    $this->width = (int)$v;
	}
	
	function create($form = null){
	    
	    $form = $form == null ? $this->owner : $form;
	    if (is_object($form))
		$form = $form->self;
		
	    return component_copy($this->self, $form);
	}
}

class TFont extends TControl {
	
	public $self;
	
	function get_style(){
	    
	    $result = $this->prop('style');
	    $result = explode(',',$result);
	    foreach ($result as $x=>$e)
		$result[$x] = trim($e);
	    return $result;
	}
	
	function assign($font){
        if ( $font instanceof TRealFont || $font instanceof TFont )
		{
            $this->name = $font->name;
            $this->size = $font->size;
            $this->color = $font->color;
            $this->charset = $font->charset;
            $this->style = $font->style;
        }
	}
}

class TRealFont extends TFont {

	public $self;

    function __construct($self){
        $this->self = $self;
    }

	function prop($prop){
	    return gui_propGet($this->self, $prop);
	}

    function propSet($prop, $value){
		
        if (is_array($value)) $value = implode(',', $value);

        return rtti_set($this, $prop, $value);
    }


	function get_style(){

	    $result = $this->prop('style');
	    $result = explode(',',$result);
	    foreach ($result as $x=>$e)
		    $result[$x] = trim($e);

	    return $result;
	}

	function assign($font){
		if ( $font instanceof TRealFont || $font instanceof TFont )
		{
			$this->name = $font->name;
			$this->size = $font->size;
			$this->color = $font->color;
			$this->charset = $font->charset;
			$this->style = $font->style;
			$this->orientation = $font->orientation;
		}
	}
}
/* TControl is visual component */
class TControl extends TComponent {
	
	
	protected $_font;
	//public $avisible;
	
	function __construct($onwer=nil,$init=true,$self=nil){
	    parent::__construct($onwer,$init);
			
		if ($self!==nil) $this->self = $self;
		if ($init){
			
		    $this->avisible = $this->visible;
			//please, do not remove this at any way
			/*if( !is_bool(gui_propGet($this->self, 'Enabled')) )
				pre( gettype(gui_propGet($this->self, 'Enabled')) );*/
		    $this->aenabled = $this->enabled;
		}
		
		$this->__setAllPropEx($init);
	}
	
	function parentComponents(){
	    
	    $result = [];
	    $components = $this->controlList;
	    
	    foreach ($components as $el){
		
			if ($el){
				$result[] = $el;
				$result   = array_merge($result, $el->parentComponents());
			}
	    }
	    
	    return $result;
	}
	
	// возвращает список всех компонентов объекта по паренту, а не owner'y
	function childComponents($recursive = true){
	    
	    $result = [];
		$owner = $this->get_owner();
	    $owner  = $owner>0? _c($owner): $this;
	    $links  = $owner->get_componentLinks();
	   
	    foreach ($links as $link){

			if ( gui_Propget($link,'Parent') == $this->self ){
				$el = _c($link);
				$result[] = $el;
				if ($recursive)
				$result = array_merge($result, $el->childComponents());
			}
	    }
	    
	    return $result;
	}
	
	function set_visible($v){
	    $this->avisible = $v;
	    $this->set_prop('visible',$v);
	}

        function get_owner(){
            return get_owner($this);
        }
        
        function componentById($id,$type = 'TComponent'){
            return _c(component_by_id($this->self,$id), $type);
        }
        
        function componentCount(){
            return component_count($this->self);
        }
	
	function controlById($id){
	    return _c(control_by_id($this->self, $id));
	}
	
	function controlCount(){
	    return control_count($this->self);
	}
	
	function get_componentIndex(){
	    return component_index($this->self);
	}
	
	function get_controlIndex(){
	    return control_index($this->self);
	}
        
    function get_componentList(){
        $res = [];
        $count = $this->componentCount();
	    
        for ($i=0;$i<$count;$i++){
            $res[] = $this->componentById($i);
        }
            
            return $res;
    }
	
    function get_controlList(){
        $res = [];
        $count = $this->controlCount();
        for ($i=0;$i<$count;$i++){
            $res[] = $this->controlById($i);
        }
            
        return $res;
    }
	
	function get_fullname()
	{
		global $APPLICATION;
		if( strlen( $this->name ) <= 0 || $this->name == '' )
			return $this->self;
		
			$obj = $this;

			while($obj)
			{
				$res[]	= strlen(trim($obj->name))>0? $obj->name: $obj->self;
				$obj	= ($obj->owner && $obj->owner!==$APPLICATION->Self)? c($obj->owner): $obj->parent;
			}
		return implode('->', array_reverse( $res ) );
	}
	
	function get_componentLinks(){
	    
	    $res = [];
            $count = $this->componentCount();
            for ($i=0;$i<$count;$i++){
			
				$res[] = component_by_id($this->self,$i);
            }
            
	    return $res;
	}
	function get_handle(){
	    return gui_getHandle($this->self);
	}
	function set_handle($v){
		gui_propset($this->self, 'Handle', $v);
	}
	function get_h(){
	    return $this->height;
	}
	
	function set_h($v){
	    $this->height = (int)$v;
	}
	
	function get_fontsize()  { return $this->font->size; }
	function set_fontsize($v){ $this->font->size = $v; }
        
	function get_fontname()  { return $this->font->name; }
	function set_fontname($v){ $this->font->name = $v; }
	
	function get_fontcolor()  { return $this->font->color; }
	function set_fontcolor($v){ $this->font->color = $v; }
	
	function get_fontori()  { return $this->font->Orientation; }
	function set_fontori($v){ $this->font->Orientation = $v; }
	
	function get_fontpitch()  { return $this->font->Pitch; }
	function set_fontpitch($v){ $this->font->Pitch = $v; }
	
	function get_fontquality()  { return $this->font->Quality; }
	function set_fontquality($v){ $this->font->Quality = $v; }
	
	function get_fontheight()  { return $this->font->Height; }
	function set_fontheight($v){ $this->font->Height = $v; }
	function get_height()
	{
		return gui_propGet($this->self, 'Height');
	}
	function set_height($v)
	{
		return gui_propSet($this->self, 'Height', $v);
	}
	function get_pitch()
	{
		return gui_propGet($this->self, 'Pitch');
	}
	function set_pitch($v)
	{
		return gui_propSet($this->self, 'Pitch', $v);
	}
	function setDate(){
	    
	    if ($this->exists_prop('caption'))
			$this->caption = date('Y.m.d');
	    elseif ($this->exists_prop('text'))
			$this->text    = date('Y.m.d');
	}
	
	function setTime(){
	    
	    if ($this->exists_prop('caption'))
			$this->caption = date('H:i:s');
	    elseif ($this->exists_prop('text'))
			$this->text    = date('H:i:s');
	}
	
	function repaint(){
	    gui_repaint($this->self);
	}
	
	function toBack(){
	    gui_toBack($this->self);
	}
	
	function toFront(){
	    gui_toFront($this->self);
	}
	
	function set_doubleBuffer($v){
	    gui_doubleBuffer($this->self,$v);
	}
	function get_doubleBuffer(){
	    return gui_doubleBuffer($this->self);
	}
	
	function set_doubleBuffered($v){
	    gui_doubleBuffer($this->self,$v);
	}
	
	function get_doubleBuffered(){
	    return gui_doubleBuffer($this->self);
	}
	
	function setFocus(){
	    
	    if ( $this->visible && $this->enabled )
			gui_setFocus($this->self);
	}
	
	function get_focused(){
	    return gui_isFocused($this->self);
	}
	
	function set_text($v){
	    if ($this->exists_prop('text')){
			$this->set_prop('text',$v);
	    } elseif ($this->exists_prop('caption'))
			$this->caption = $v;
	    elseif ($this->exists_prop('itemstext'))
			$this->itemsText = $v;
	}
	
	function get_text(){
	    if ($this->exists_prop('text'))
			return $this->get_prop('text');
	    elseif ($this->exists_prop('caption'))
			return $this->caption;
	    elseif ($this->exists_prop('itemstext'))
			return $this->itemsText;
	}
	
	function set_popupMenu($menu){
		$men = is_numeric($menu)? $menu: (is_object($menu)? $menu->self: -222);
		if($men === -222) return;
	    popup_set($men, $this->self);
	}
	
	function perform($msg, $hparam, $lparam){
	    
	    return control_perform($this->self, $msg, $hparam, $lparam);
	}
	
	function invalidate(){
	    control_invalidate($this->self);
	}
	
	function manualDock($obj, $align = 0){
	    
	    return control_manualDock($this->self, $obj->self, $align);
	}
	
	function manualFloat($left, $top, $right, $bottom){
	    
	    return control_manualFloat($this->self, $left, $top, $right, $bottom);    
	}
	
	function dock($obj, $left, $top, $right, $bottom){
	    
	    control_dock($this->self, $obj->self, $left, $top, $right, $bottom);    
	}
	
	function get_dockOrientation(){
	    return control_dockOrientation($this->self);
	}
	
	function dockSaveToFile($file){
	    
	    control_docksave($this->self, $file);
	}
	
	
	function dockLoadFromFile($file){
	    
	    control_dockload($this->self, $file);
	}
	
	function dockClient($index){
	    
	    return _c(control_dockClient($this->self, $index));
	}
	
	function get_dockClientCount(){
	    return control_dockClientCount($this->self);
	}
	
	function get_dockList(){
	    
	    $result = [];
	    $c = $this->get_dockClientCount();
	    
	    for($i=0;$i<$c;$i++)
			$result[] = $this->dockClient($i);
		
	    return $result;
	}
	
	function get_canvas(){
	    
	    return _c(component_canvas($this->self));
	}
	
	function set_hint($hint){
	    
	    $this->showHint = (bool)$hint;
	    $this->set_prop('hint', (string)$hint);
	}
}



function cMethodExists($str){
         
    $str = str_ireplace(['font.', '->'],['font','.'],$str);
    
    $obj = c(substr($str, 0, strrpos($str,'.')));
    $method = substr($str, strrpos($str, ".")+1, strlen($str) - strrpos($str, '.'));
    
	return is_object($obj)? method_exists($obj, $method): false;
}

function val($str, $value = null){
    $obj = toObject($str);
    
    $prop = 'text';
    
    if ($obj instanceof TCheckBox)
		$prop = 'checked';
    elseif ($obj instanceof TListBox)
		$prop = 'itemIndex';
    
    if ($value===null){
		return $obj->$prop;
    } else {
		$obj->$prop = $value;
    }
}

function __autoload($name)
{
	
	if( $name == 'TSynSelectedColor' or substr($name, 0, 2) == 'ev' or  substr($name, 0, 7) == 'modifer' ) return;
		if( gui_class_isset($name) )
		{	
			$parent = gui_class_parent($name);
			$parent = in_array(strtolower($parent), ['tpersistent', 'tinterfacedpersistent', 'iinterface'])? 'TControl': $parent;
			$parent = class_exists($parent) && strlen($parent)? $parent: 'TControl';
			eval("class $name extends $parent{};");
		} else {
			eval("class $name extends dsErrorClassUndefined{};");
		}
}
?>