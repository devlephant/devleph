<?
//
//
// ARMEN PRODUCTONS  |  TClicker 1.4 Class
//
//


Class TClicker Extends __TNoVisual{


Function Click($x,$y){
    SetCursorPos($x,$y);  
    Mouse_Event(MOUSEEVENTF_LEFTDOWN, $x, $y, 0, 0);
	Mouse_Event(MOUSEEVENTF_LEFTUP, $x, $y, 0, 0);
}

Function LClick($x,$y){
    SetCursorPos($x,$y);  
    Mouse_Event(MOUSEEVENTF_LEFTDOWN, $x, $y, 0, 0);
	Mouse_Event(MOUSEEVENTF_LEFTUP, $x, $y, 0, 0);
}

Function RClick($x,$y){
    SetCursorPos($x,$y);  
    Mouse_Event(MOUSEEVENTF_RIGHTDOWN, $x, $y, 0, 0);
	Mouse_Event(MOUSEEVENTF_RIGHTUP, $x, $y, 0, 0);
}

Function MClick($x,$y){
    SetCursorPos($x,$y);  
    Mouse_Event(MOUSEEVENTF_MIDDLEDOWN, $x, $y, 0, 0);
	Mouse_Event(MOUSEEVENTF_MIDDLEUP, $x, $y, 0, 0);
}

Function DClick($x,$y){
    SetCursorPos($x,$y);  
    Mouse_Event(MOUSEEVENTF_LEFTDOWN, $x, $y, 0, 0);
	Mouse_Event(MOUSEEVENTF_LEFTUP, $x, $y, 0, 0);
	Mouse_Event(MOUSEEVENTF_LEFTDOWN, $x, $y, 0, 0);
	Mouse_Event(MOUSEEVENTF_LEFTUP, $x, $y, 0, 0);
}

Function LDClick($x,$y){
    SetCursorPos($x,$y);  
    Mouse_Event(MOUSEEVENTF_LEFTDOWN, $x, $y, 0, 0);
	Mouse_Event(MOUSEEVENTF_LEFTUP, $x, $y, 0, 0);
	Mouse_Event(MOUSEEVENTF_LEFTDOWN, $x, $y, 0, 0);
	Mouse_Event(MOUSEEVENTF_LEFTUP, $x, $y, 0, 0);
}

Function RDClick($x,$y){
    SetCursorPos($x,$y);  
    Mouse_Event(MOUSEEVENTF_RIGHTDOWN, $x, $y, 0, 0);
	Mouse_Event(MOUSEEVENTF_RIGHTUP, $x, $y, 0, 0);
	Mouse_Event(MOUSEEVENTF_RIGHTDOWN, $x, $y, 0, 0);
	Mouse_Event(MOUSEEVENTF_RIGHTUP, $x, $y, 0, 0);
}

Function MDClick($x,$y){
    SetCursorPos($x,$y);  
    Mouse_Event(MOUSEEVENTF_MIDDLEDOWN, $x, $y, 0, 0);
	Mouse_Event(MOUSEEVENTF_MIDDLEUP, $x, $y, 0, 0);
	Mouse_Event(MOUSEEVENTF_MIDDLEDOWN, $x, $y, 0, 0);
	Mouse_Event(MOUSEEVENTF_MIDDLEUP, $x, $y, 0, 0);
}

Function VClick($x,$y){
$xc = cursor_pos_x();
$yc = cursor_pos_y();

    SetCursorPos($x,$y);  
    Mouse_Event(MOUSEEVENTF_LEFTDOWN, $x, $y, 0, 0);
	Mouse_Event(MOUSEEVENTF_LEFTUP, $x, $y, 0, 0);
	SetCursorPos($xc,$yc); 

}

Function VLClick($x,$y){
$xc = cursor_pos_x();
$yc = cursor_pos_y();

    SetCursorPos($x,$y);  
    Mouse_Event(MOUSEEVENTF_LEFTDOWN, $x, $y, 0, 0);
	Mouse_Event(MOUSEEVENTF_LEFTUP, $x, $y, 0, 0);
	SetCursorPos($xc,$yc); 

}

Function VRClick($x,$y){
$xc = cursor_pos_x();
$yc = cursor_pos_y();

    SetCursorPos($x,$y);  
    Mouse_Event(MOUSEEVENTF_RIGHTDOWN, $x, $y, 0, 0);
	Mouse_Event(MOUSEEVENTF_RIGHTUP, $x, $y, 0, 0);
	SetCursorPos($xc,$yc); 

}

Function VMClick($x,$y){
$xc = cursor_pos_x();
$yc = cursor_pos_y();

    SetCursorPos($x,$y);  
    Mouse_Event(MOUSEEVENTF_MIDDLEDOWN, $x, $y, 0, 0);
	Mouse_Event(MOUSEEVENTF_MIDDLEUP, $x, $y, 0, 0);
	SetCursorPos($xc,$yc); 

}

Function VDClick($x,$y){
$xc = cursor_pos_x();
$yc = cursor_pos_y();

    SetCursorPos($x,$y);  
    Mouse_Event(MOUSEEVENTF_LEFTDOWN, $x, $y, 0, 0);
	Mouse_Event(MOUSEEVENTF_LEFTUP, $x, $y, 0, 0);
	Mouse_Event(MOUSEEVENTF_LEFTDOWN, $x, $y, 0, 0);
	Mouse_Event(MOUSEEVENTF_LEFTUP, $x, $y, 0, 0);
	SetCursorPos($xc,$yc); 

}

Function VDLClick($x,$y){
$xc = cursor_pos_x();
$yc = cursor_pos_y();

    SetCursorPos($x,$y);  
    Mouse_Event(MOUSEEVENTF_LEFTDOWN, $x, $y, 0, 0);
	Mouse_Event(MOUSEEVENTF_LEFTUP, $x, $y, 0, 0);
	Mouse_Event(MOUSEEVENTF_LEFTDOWN, $x, $y, 0, 0);
	Mouse_Event(MOUSEEVENTF_LEFTUP, $x, $y, 0, 0);
	SetCursorPos($xc,$yc); 

}

Function VDRClick($x,$y){
$xc = cursor_pos_x();
$yc = cursor_pos_y();

    SetCursorPos($x,$y);  
    Mouse_Event(MOUSEEVENTF_RIGHTDOWN, $x, $y, 0, 0);
	Mouse_Event(MOUSEEVENTF_RIGHTUP, $x, $y, 0, 0);
	Mouse_Event(MOUSEEVENTF_RIGHTDOWN, $x, $y, 0, 0);
	Mouse_Event(MOUSEEVENTF_RIGHTUP, $x, $y, 0, 0);
	SetCursorPos($xc,$yc); 
}

Function VDMClick($x,$y){
$xc = cursor_pos_x();
$yc = cursor_pos_y();

    SetCursorPos($x,$y);  
    Mouse_Event(MOUSEEVENTF_MIDDLEDOWN, $x, $y, 0, 0);
	Mouse_Event(MOUSEEVENTF_MIDDLEUP, $x, $y, 0, 0);
	Mouse_Event(MOUSEEVENTF_MIDDLEDOWN, $x, $y, 0, 0);
	Mouse_Event(MOUSEEVENTF_MIDDLEUP, $x, $y, 0, 0);
	SetCursorPos($xc,$yc); 
}



Function Set($x,$y){
    SetCursorPos($x,$y);
}

Function Get($i){
 $arr = ["x"=>cursor_pos_x(),"y"=>cursor_pos_y()];
    IF($i == "xy"){ Return $arr; }
ELSEIF($i == "x"){ Return $arr['x']; }
ELSEIF($i == "y"){ Return $arr['y']; }
}

Function Loop($x,$y,$l)
{
 $l = $l + 1;
 For($i=1;$i<$l;$i++)
 { 
   SetCursorPos($x,$y);  
   Mouse_Event(MOUSEEVENTF_LEFTDOWN, $x, $y, 0, 0);
   Mouse_Event(MOUSEEVENTF_LEFTUP, $x, $y, 0, 0);
 }
}

Function Caret()
{

$Form = new TForm;
$Form->name = "Caret";
$Form->Caption = "Caret :: TClicker 1.5   ";
$Form->windowState = wsMaximized;
$Form->Color = 0x00804000;
$Form->transparentColor = true;
$Form->transparentColorValue = 0x00804000;
$Form->Show();
$Form->borderStyle = bsSizeable;

$Add = new TSpeedButton;
$Add->Parent = $Form;
$Add->Caption = "Add Point";
$Add->x = 0;
$Add->y = 0;
$Add->w = 72;
$Add->h = 30;

$Point = new TSpeedButton;
$Point->Parent = $Form;
$Point->Caption = "Points";
$Point->x = 72;
$Point->y = 0;
$Point->w = 72;
$Point->h = 30;

$Ch1 = new TCheckBox;
$Ch1->Parent = $Form;
$Ch1->x = 152;
$Ch1->y = 4;
$Ch1->w = 80;
$Ch1->h = 24;
$Ch1->text = "Show Points";
$Ch1->Checked = True;

$Ch2 = new TCheckBox;
$Ch2->Parent = $Form;
$Ch2->x = 240;
$Ch2->y = 4;
$Ch2->w = 94;
$Ch2->h = 24;
$Ch2->text = "Show Numbers";
$Ch2->Checked = True;

$Info = new TLabel;
$Info->parent = $Form;
$Info->x = 344;
$Info->y = 7;
$Info->w = 116;
$Info->h = 16;
$Info->Caption = "Point : | X : | Y : ";
$Info->Font->Name = "Segoe UI";
$Info->Font->Style = "fsBold";
$Info->Font->Size = 10;

$Shape = new TShape;
$Shape->Parent = $Form;
$Shape->Align = alTop;
$Shape->h = 30;
$Shape->toBack();

$Del = new TShape;
$Del->Parent = $Form;
$Del->w = 56;
$Del->h = 30;
$Del->x = $Form->w - 72;
$Del->y = 0;
$Del->anchors = ' akTop , akLeft';
$Del->penStyle = psDot;
$Del->visible = false;

$Lab = new TLabel;
$Lab->Parent = $Form;
$Lab->x = $Del->x + 14;
$Lab->y = 3;
$Lab->w = 40;
$Lab->h = 28;
$Lab->Caption = "Delete\r\n Point";


$Pos = new TLabel;
$Pos->Parent = $Form;
$Pos->w = 163;
$Pos->h = 25;
$Pos->Font->Name = "Segoe UI";
$Pos->Font->Style = "fsLight";
$Pos->Font->Size = 14;
$Pos->caption = "X - 0 | Y - 0";
$Pos->alignment = taCenter;

$Ret = new TSpeedButton;
$Ret->parent = $Form;
$Ret->x = $Form->w - 100;
$Ret->y = 30;
$Ret->w = 100;
$Ret->h = 30;
$Ret->Caption = "Exit";

$Ret->onClick = Function($self) use($Form)
{
  Global $__nv,$Caret;
  $Caret = $__nv;
  $Form->free();
};
/////////////////////////////////* Main FX Core */////////////////////////////////

Function Del($s)
{
 $s->free();
}

$T = new TTimer;
$T->Interval = 1;
$T->Enabled = true;
$T->Repeat = true;

$T->OnTimer = Function($self) use($Pos,$Ch1,$Ch2,$Del,$Lab)
{
 $Lab->visible = $Del->visible;
  $x = cursor_pos_x();
  $y = cursor_pos_y();

  $Pos->caption = "X - $x | Y - $y";
  $Pos->x = $x - 80;
  $Pos->y = $y;

  Global $__cv;
  $c = $__cv + 1;

  For($i=1;$i<$c;$i++)
  {
     if(! c("point$i") instanceof DebugClass )
     {
      c("point$i")->visible = $Ch1->checked;
     }

     if(! c("number$i") instanceof DebugClass )
     {
      c("number$i")->visible = $Ch2->checked;
     }
  }
};



$Add->OnClick = Function($self) use( $Form , $Info , $Del , $Pos)
{
Global $__cv,$__nv;
++$__cv;

$move = new TTimer;
$shap = new TShape;
$time = new TTimer;
$prog = new TProgressBar;
$labe = new TLabel;
$numb = new TLabel;

$time->enabled = true;
$time->interval = 200;
$time->repeat = true;

$move->enabled = false;
$move->interval = 1;
$move->repeat = true;

$shap->PenColor = clRed;
$shap->PenWidth = 2;
$shap->name = "point".$__cv;
$shap->x = $Form->w / 2 + 5;
$shap->y = $Form->h / 2 + 5;
$shap->w = 10;
$shap->h = 10;
$shap->parent = $Form;
$shap->point = $__cv;


$sx = $shap->x + 5;
$sy = $shap->y + 27;
$__nv["point$__cv"] = "X : $sx | Y : $sy";

$labe->caption = "X - $sx | Y - $sy";
$labe->parent = $Form;
$labe->autoSize = false;
$labe->visible = false;
$labe->x = $shap->x - 34;
$labe->y = $shap->y - 20;
$labe->w = 260;

$numb->caption = $__cv;
$numb->parent = $Form;
$numb->autoSize = true;
$numb->name = "number".$__cv;

$numb->x = $shap->x - 18;
$numb->y = $shap->y - 2;

$time->OnTimer = Function($self) use ($shap,$prog){
  ++$prog->position;

 if($prog->position == 1)
 {
  $shap->PenColor = clRed;
 } elseif($prog->position == 2)
 {
  $shap->PenColor = clBlue;
  $prog->position = 0;
 }
};


$move->OnTimer = Function($self) use ($shap,$labe,$numb,$Info,$time,$Del){

Global $__nv,$__cv;

   $p = $shap->point;
   $sx = $shap->x + 5;
   $sy = $shap->y + 27;
      $Info->caption = "Point : $p | X : $sx | Y : $sy";
      $__nv[$shap->name] = "X : $sx | Y : $sy";
    $labe->caption = "X - $sx | Y - $sy";
    $labe->x = $shap->x - 34;
    $labe->y = $shap->y - 20;

    $numb->x = $shap->x - 18;
    $numb->y = $shap->y - 2;

 global $sx, $sy, $fx, $fy;
 $shap->x = $fx - ($sx - cursor_pos_x());
 $shap->y = $fy - ($sy - cursor_pos_y());

 if($shap->point == $__cv)
 {

 if( $shap->x + 5 > $Del->x && $shap->x + 5 < $Del->x + $Del->w && $shap->y + 5 > $Del->y && $shap->y + 5 < $Del->y + $Del->h)
    {
       $shap->penColor = clRed;
       $shap->brushColor = clRed;
       $time->enabled = false;
    }
    else
    {
     $time->enabled = true;
     $shap->brushColor = clWhite;
    }
  }
  else
  {
   $Del->visible = false;
  }
};

$shap->OnMouseDown = Function($self) use ($move,$labe,$Del,$Pos){
 global $sx, $sy, $fx, $fy , $__cv;
 $sx = cursor_pos_x();
 $sy = cursor_pos_y();
 $fx = c($self)->x;
 $fy = c($self)->y;
 $move->enabled = true;
 $Pos->visible = false;
 $labe->visible = true;

 if( c($self)->point == $__cv)
 {
  $Del->visible = true;
 }
 else
 {
  $Del->visible = false;
 }

};

$shap->OnMouseUp = Function($self) use ($move,$labe,$numb,$time,$prog,$shap,$Info,$Form,$Del,$Pos){
 Global $__cv;
 $move->enabled = false;
 $Pos->visible = true;
 $labe->visible = false;
 $Info->caption = "Point : | X : | Y : ";

    $numb->x = c($self)->x - 18;
    $numb->y = c($self)->y - 2;

    if( c($self)->x > $Form->w ) { c($self)->x = $Form->w - 27; }
    if( c($self)->y > $Form->h  ) { c($self)->y = $Form->h - 48; }
    if( c($self)->x < 0 ) { c($self)->x = 0; }
    if( c($self)->y < 0 ) { c($self)->y = 0; }

    // delete //
    if( c($self)->point == $__cv)
    {
       $Del->visible = true;
      if( c($self)->x + 5 > $Del->x && c($self)->x + 5 < $Del->x + $Del->w && c($self)->y + 5 > $Del->y && c($self)->y + 5 < $Del->y + $Del->h)
      {
         $move->free();
         $time->free();
         $prog->free();
         $labe->free();
         $numb->free();

          Global $__cv,$__nv;
          --$__cv;
          unset( $__nv[c($self)->name] );
          Del( c($self) );
      }
     }
     else
     {
      $Del->visible = false;
     }
     $Del->visible = false;
};

};

////////////////////////////////////////////////////////////////////////////////

$Point->OnClick = Function($self)
{
  Global $__nv;
  $points = [];
  Foreach($__nv as $p)
  {
   $points[] = $p;
  }
  pre($points);
};


/////////////////////////////////* Main FX Core */////////////////////////////////
}



Public Function __construct($owner=nil,$init=true,$self=nil){
        parent::__construct($owner,$init,$self);} 
 
}