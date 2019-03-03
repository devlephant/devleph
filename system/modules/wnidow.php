<?php
class window
{
 public function __construct($app){
	$_SESSION['app'] = $app;
}
 public function create($form, $parent, $size = 1){
global $arr;
$app = $_SESSION['app'];
 $app->processMessages();
	$line = new TShape($form);
	$line->parent = c($parent);
	$line->align = alLeft;
	$line->w = $size;
	$line->name = $form.'_line1';
	$line->brushColor = 0;
	$line->penColor = 0;
$arr .= $line->name.';';

 $app->processMessages();
    $line = new TShape($form);
	$line->parent = c($parent);
	$line->align = alRight;
	$line->w = $size;
	$line->name = $form.'_line2';
	$line->brushColor = 0;
	$line->penColor = 0;
$arr .= $line->name.';';

 $app->processMessages();
    $line = new TShape($form);
	$line->parent = c($parent);
	$line->align = alBottom;
	$line->h = $size;
	$line->name = $form.'_line3';
	$line->brushColor = 0;
	$line->penColor = 0;
$arr .= $line->name.';';

 $app->processMessages();
	$line = new TShape($form);
	$line->parent = c($parent);
	$line->align = alTop;
	$line->h = $size;
	$line->name = $form.'_line4';
	$line->brushColor = 0;
	$line->penColor = 0;
$arr .= $line->name.';';

$app->processMessages();
	$line = new TShape($form);
	$line->parent = c($parent);
	$line->x = 0 + c($form.'_line1')->w;
	$line->y = 0 + c($form.'_line4')->h;
	$line->w = c($form)->w - c($form.'_line1')->w * 2;
	$line->anchors = 'akLeft, akTop, akRight';
	$line->h = 32;
	$line->name = $form.'_box';
	$line->brushColor = 0xEEEEEE;
	$line->penColor = 0xEEEEEE;
	$line->onMouseDown = function($self)use($form){
	global $sx, $sy, $fx, $fy, $a;
    $sx = cursor_pos_x();
    $sy = cursor_pos_y();
    $fx = c($form)->x;
    $fy = c($form)->y;
    $a = 1;
		while($a == 1){
		c($form)->x = $fx - ($sx - cursor_pos_x());
		c($form)->y = $fy - ($sy - cursor_pos_y());
		$_SESSION['app']->processMessages();
		usleep(5);
		}
	};
    $line->onMouseUp = function($self){
    global $a;
    $a = 0;
    };

$arr .= $line->name;
}

 public function color($clr, $form = ''){
$app = $_SESSION['app'];
 global $arr;
 if($form !== null){
 $Arr = explode(";", $arr);
    foreach($Arr as $v => $k){
    $a = explode('_', $Arr[$v]);
     if($a[1] !== 'box'){
     c($Arr[$v])->penColor = $clr;
     c($Arr[$v])->brushColor = $clr;
     }
    $app->processMessages();
    }
 $app->processMessages();
 }else{
	c($form.'_line1')->penColor = $clr;
	c($form.'_line1')->brushColor = $clr;
	
	c($form.'_line2')->penColor = $clr;
	c($form.'_line2')->brushColor = $clr;
	
	c($form.'_line3')->penColor = $clr;
	c($form.'_line3')->brushColor = $clr;
	
	c($form.'_line4')->penColor = $clr;
	c($form.'_line4')->brushColor = $clr;
 }
 }
 public function buttons($form, $parent, $hide = false, $max = false, $close = false){
 $z = $max + $hide + $close;
    if($close){
    $lbl = new TLabel($form);
    $lbl->parent = c($parent);
    $lbl->caption = 'X';
    $lbl->name = $form.'_close';
    $lbl->font->color = clBlack;
    $lbl->font = c($form)->font;
    $lbl->font->size = 12;
    $lbl->font->style = 'small';
    $lbl->transparent = 1;
    $lbl->color = 0x0F2F2F2;
    $lbl->w = 29;
    $lbl->h = 32;
    $lbl->autoSize = 0;
    $lbl->x = c($form.'_box')->w - $lbl->w;
    $lbl->y = 1;
    $lbl->alignment = taCenter;
    $lbl->layout = tlCenter;
    $lbl->anchors = 'akTop, akRight';
    $lbl->onMouseEnter = function($self){
    $self = c($self);
    $self->transparent = 0;
    };
    $lbl->onMouseLeave = function($self){
    $self = c($self);
    $self->transparent = 1;
    $self->color = 0x0F2F2F2;
    $self->alignment = taCenter;
    $self->layout = tlCenter;
    $self->font->color = clBlack;
    };
    $lbl->onMouseDown = function($self){
    $self = c($self);
    $self->color = clRed;
    $self->font->color = clWhite;
    $self->alignment = taCenter;
    $self->layout = tlCenter;
    };
    $lbl->onMouseUp = function($self){
    $self = c($self);
    $self->color = clMaroon;
    $self->font->color = clWhite;
    $self->alignment = taCenter;
    $self->layout = tlCenter;
    app::close();
    };
    }
    if($max){
    $lbl = new TLabel($form);
    $lbl->parent = c($parent);
    $lbl->caption = '[]';
    $lbl->name = $form.'_max';
    $lbl->font->color = clBlack;
    $lbl->font = c($form)->font;
    $lbl->font->size = 12;
    $lbl->font->style = 'small';
    $lbl->transparent = 1;
    $lbl->color = 0x0F2F2F2;
    $lbl->w = 29;
    $lbl->h = 32;
    $lbl->autoSize = 0;
	if($z == 3) $lbl->x = c($form.'_box')->w - $lbl->w * 2;
    else $lbl->x = c($form.'_box')->w - $lbl->w * $z;
    $lbl->y = 1;
    $lbl->alignment = taCenter;
    $lbl->layout = tlCenter;
    $lbl->anchors = 'akTop, akRight';
    $lbl->onMouseEnter = function($self){
    $self = c($self);
    $self->transparent = 0;
    };
    $lbl->onMouseLeave = function($self){
    $self = c($self);
    $self->transparent = 1;
    $self->color = 0x0F2F2F2;
    $self->alignment = taCenter;
    $self->layout = tlCenter;
    $self->font->color = clBlack;
    };
    $lbl->onMouseDown = function($self){
    $self = c($self);
    $self->color = 0xD8D8D8;
    $self->alignment = taCenter;
    $self->layout = tlCenter;
    };
    $lbl->onMouseUp = function($self)use($form){
    global $byte;
    $self = c($self);
    $self->color = 0xBEBEBE;
    $self->alignment = taCenter;
    $self->layout = tlCenter;
     if($self->caption == '[]'){
     $self->caption = '[ ]';
     $byte = c($form)->w.','.c($form)->h;
     c($form)->windowState = wsMaximized;
     }else{
     $self->caption = '[]';
     $b = explode(',', $byte);
     c($form)->w = $b[0];
     c($form)->h = $b[1];
     unset($byte);
     }
    };
    }
    if($hide){
        $lbl = new TLabel($form);
    $lbl->parent = c($parent);
    $lbl->caption = '_';
    $lbl->name = $form.'_max';
    $lbl->font->color = clBlack;
    $lbl->font = c($form)->font;
    $lbl->font->size = 12;
    $lbl->font->style = 'small';
    $lbl->transparent = 1;
    $lbl->color = 0x0F2F2F2;
    $lbl->w = 29;
    $lbl->h = 32;
    $lbl->autoSize = 0;
    $lbl->x = c($form.'_box')->w - $lbl->w * $z;
    $lbl->y = 1;
    $lbl->alignment = taCenter;
    $lbl->layout = tlCenter;
    $lbl->anchors = 'akTop, akRight';
    $lbl->onMouseEnter = function($self){
    $self = c($self);
    $self->transparent = 0;
    };
    $lbl->onMouseLeave = function($self){
    $self = c($self);
    $self->transparent = 1;
    $self->color = 0x0F2F2F2;
    $self->alignment = taCenter;
    $self->layout = tlCenter;
    $self->font->color = clBlack;
    };
    $lbl->onMouseDown = function($self){
    $self = c($self);
    $self->color = 0xD8D8D8;
    $self->alignment = taCenter;
    $self->layout = tlCenter;
    };
    $lbl->onMouseUp = function($self)use($form){
    global $byte;
    $self = c($self);
    $self->color = 0xBEBEBE;
    $self->alignment = taCenter;
    $self->layout = tlCenter;
    app::hide();
    };
    }
    
    $lbl = new TLabel($form);
    $lbl->name = $form.'_caption';
    $lbl->parent = c($parent);
    $lbl->autoSize = false;
    $lbl->x = c($form.'_line1')->w * 4;
    $lbl->y = 1;
    $lbl->w = c($form.'_box')->w - 98;
    $lbl->h = 32;
    $lbl->layout = tlCenter;
    $lbl->caption = $_SESSION['app']->title;
    $lbl->font->color = clBlack;
    $lbl->font = c($form)->font;
    $lbl->font->size = 12;
    $lbl->font->style = 'small';
    $lbl->anchors = 'akLeft, akTop, akRight';
    $lbl->onMouseDown = function($self)use($form){
	global $sx, $sy, $fx, $fy, $a;
    $sx = cursor_pos_x();
    $sy = cursor_pos_y();
    $fx = c($form)->x;
    $fy = c($form)->y;
    $a = 1;
		while($a == 1){
		c($form)->x = $fx - ($sx - cursor_pos_x());
		c($form)->y = $fy - ($sy - cursor_pos_y());
		$_SESSION['app']->processMessages();
		usleep(5);
		}
	};
    $lbl->onMouseUp = function($self){
    global $a;
    $a = 0;
    };
    
 }
}
?>