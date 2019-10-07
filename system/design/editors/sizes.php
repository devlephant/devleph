<?
class SizesEditor
{
	const type = "TNxButtonItem";
	const caption = "Sizes & Position";
    public static function OnCreate( $edt, $class, &$prop )
	{
        $edt->ButtonCaption = myProperties::ButtonCaption;
        $edt->buttonWidth = myProperties::ButtonWidth;
        $edt->onButtonClick = __CLASS__ . "::Click";
	}
	public static function Click( $self )
	{
		global $myProperties;
        self::execute($myProperties->selObj);
	}
	function execute($obj,$xy_cursor = true)
	{   
		global $_sc, $fmEdit;
        $anchors = explode(',', $obj->anchors);
        
        if ($xy_cursor){
            c('fmSizesPosition')->x = cursor_real_x(c('fmSizesPosition'),10);
            c('fmSizesPosition')->y = cursor_real_y(c('fmSizesPosition'),10);
        }
        
        c('fmSizesPosition->e_x')->onKeyUp = __CLASS__ . "::setSizes";
        c('fmSizesPosition->e_x')->onKeyPress= __CLASS__ . "::setSizes";
        
        c('fmSizesPosition->e_y')->onKeyUp = __CLASS__ . "::setSizes";
        c('fmSizesPosition->e_y')->onKeyPress= __CLASS__ . "::setSizes";
        
        c('fmSizesPosition->e_w')->onKeyUp = __CLASS__ . "::setSizes";
        c('fmSizesPosition->e_w')->onKeyPress= __CLASS__ . "::setSizes";
        
        c('fmSizesPosition->e_h')->onKeyUp = __CLASS__ . "::setSizes";
        c('fmSizesPosition->e_h')->onKeyPress= __CLASS__ . "::setSizes";
        
        c('fmSizesPosition->c_left')->checked = in_array('akLeft', $anchors);
        c('fmSizesPosition->c_top')->checked  = in_array('akTop', $anchors);
        c('fmSizesPosition->c_right')->checked= in_array('akRight', $anchors);
        c('fmSizesPosition->c_bottom')->checked = in_array('akBottom', $anchors);
        
        c('fmSizesPosition->e_x')->text = $obj->x;
        c('fmSizesPosition->e_y')->text = $obj->y;
        c('fmSizesPosition->e_w')->text = $obj->w;
		c('fmSizesPosition->e_h')->text = $obj->h;
		$targets = $_sc->targets_ex;
        $targets = count($targets) ? $targets: [$fmEdit];
		$positions = [];
		foreach($targets as $i=>$el)
		{
			$positions[$i] = [$el->x, $el->y, $el->w, $el->h, $el->anchors];
		}
		
        if (c('fmSizesPosition')->showModal()==mrOk){
            
            $anchors = [];
            if (c('fmSizesPosition->c_left')->checked)
                $anchors[] = 'akLeft';
                
            if (c('fmSizesPosition->c_top')->checked)
                $anchors[] = 'akTop';
            
            if (c('fmSizesPosition->c_right')->checked)
                $anchors[] = 'akRight';
            
            if (c('fmSizesPosition->c_bottom')->checked)
                $anchors[] = 'akBottom';
            $anchors = implode(',', $anchors);
			myHistory::addArr($targets, ["x","y","w","h","anchors"], $positions);
			foreach($targets as $el){
                $el->anchors = $anchors;
            }
			myProperties::updateProps();
        } else {
			foreach($targets as $i=>$el)
			{
				list($el->x, $el->y, $el->w, $el->h, $el->anchors) = $positions[$i];
			}
			$_sc->update();
		}
    }
    function setSizes(...$a)
	{
		global $myProperties, $_sc;
		$el0 = $myProperties->selObj;
		$targets = $_sc->targets_ex;
        $targets = count($targets) ? $targets: [$fmEdit];
		
		$x = c('fmSizesPosition->e_x')->text - $el0->x;
		$y = c('fmSizesPosition->e_y')->text - $el0->y;
		$w = c('fmSizesPosition->e_w')->text;
		$h = c('fmSizesPosition->e_h')->text;
		foreach($targets as $el)
		{
			$el->x += $x;
			$el->y += $y;
			$el->w = $w;
			$el->h = $h;
		}
		$_sc->update();
    }
}
myProperties::AddType(["sizes"], "SizesEditor");