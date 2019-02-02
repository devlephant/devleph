<?
Class TTarget Extends __TNoVisual{
Public $class_name_ex = __CLASS__;

Function Target($Obj,$Color = 0xe74c3c)
 {
 Global $_OBJ , $_TT_ , $_TE_ , $_S1 , $_S2 , $_S3 , $_S4 , $_S5 , $_S6 , $_S7 , $_S8 , $_OBJ , $_TT_;
 
 IF($_OBJ == Null)
 {
  $_OBJ = $Obj;
  
     $Timer = New TTimer;      $Timer->Interval = 1;       $Timer->Enabled = $Timer->Repeat = True; $_TT_ = $Timer;
	   $_S1 = New TShape;  $_S1->Parent = $_OBJ->Parent;  $_S1->PenColor = $_S1->BrushColor = $Color;  $_S1->w = $_S1->h = 8;  $_TE_['Obj'][] = $_S1; $_TE_['Self'][] = $_S1->Self;                                
	   $_S2 = New TShape;  $_S2->Parent = $_OBJ->Parent;  $_S2->PenColor = $_S2->BrushColor = $Color;  $_S2->w = $_S2->h = 8;  $_TE_['Obj'][] = $_S2; $_TE_['Self'][] = $_S2->Self;  
	   $_S3 = New TShape;  $_S3->Parent = $_OBJ->Parent;  $_S3->PenColor = $_S3->BrushColor = $Color;  $_S3->w = $_S3->h = 8;  $_TE_['Obj'][] = $_S3; $_TE_['Self'][] = $_S3->Self;  
	   $_S4 = New TShape;  $_S4->Parent = $_OBJ->Parent;  $_S4->PenColor = $_S4->BrushColor = $Color;  $_S4->w = $_S4->h = 8;  $_TE_['Obj'][] = $_S4; $_TE_['Self'][] = $_S4->Self;  
	   $_S5 = New TShape;  $_S5->Parent = $_OBJ->Parent;  $_S5->PenColor = $_S5->BrushColor = $Color;  $_S5->w = $_S5->h = 8;  $_TE_['Obj'][] = $_S5; $_TE_['Self'][] = $_S5->Self;  
	   $_S6 = New TShape;  $_S6->Parent = $_OBJ->Parent;  $_S6->PenColor = $_S6->BrushColor = $Color;  $_S6->w = $_S6->h = 8;  $_TE_['Obj'][] = $_S6; $_TE_['Self'][] = $_S6->Self;  
	   $_S7 = New TShape;  $_S7->Parent = $_OBJ->Parent;  $_S7->PenColor = $_S7->BrushColor = $Color;  $_S7->w = $_S7->h = 8;  $_TE_['Obj'][] = $_S7; $_TE_['Self'][] = $_S7->Self;  
	   $_S8 = New TShape;  $_S8->Parent = $_OBJ->Parent;  $_S8->PenColor = $_S8->BrushColor = $Color;  $_S8->w = $_S8->h = 8;  $_TE_['Obj'][] = $_S8; $_TE_['Self'][] = $_S8->Self;  
	   
	 $_S1->OnMouseDown = Function($self) Use($_S1,$_S2,$_S3,$_S4,$_S5,$_S6,$_S7,$_S8,$_OBJ,$_TT_)
	  {
	    
        $Obj = c($self);
        $arr = Array( Cursor_Pos_X() - $Obj->X , Cursor_Pos_Y() - $Obj->Y );
 
        Timer::SetInterval(Function($Move) Use ($_S1,$_S2,$_S3,$_S4,$_S5,$_S6,$_S7,$_S8,$_OBJ,$_TT_,$arr,$Obj){
        IF(Get_Key_State(1)<0)
        {
         $x = Cursor_Pos_X() - $arr[0];
         $y = Cursor_Pos_Y() - $arr[1];
           $_TT_->Enabled = False;
            $Obj->x = $x;
            $Obj->y = $y;
    
            $_S4->x = $_S6->x = $x;
            $_S2->y = $_S3->y = $y;
            $_S2->x = $_S7->x = ($_S3->x + $_S1->x) / 2;
            $_S4->y = $_S5->y = ( $_S6->y + $_S1->y ) / 2;
			
			$_OBJ->x = $_S1->x + 4;
			$_OBJ->y = $_S1->y + 4;
			$_OBJ->w = $_S3->x - $_S1->x ;
			$_OBJ->h = $_S7->y - $_S1->y ;
          			
			
        }
        Else
        {
		 $_TT_->Enabled = True;
         Timer::ClearTimer($Move);
        }
       },1);
	 };
	   
	 $_S2->OnMouseDown = Function($self) Use($_S1,$_S2,$_S3,$_S4,$_S5,$_S6,$_S7,$_S8,$_OBJ,$_TT_)
	  {
	    
        $Obj = c($self);
        $arr = Array( Cursor_Pos_X() - $Obj->X , Cursor_Pos_Y() - $Obj->Y );
 
        Timer::SetInterval(Function($Move) Use ($_S1,$_S2,$_S3,$_S4,$_S5,$_S6,$_S7,$_S8,$_OBJ,$_TT_,$arr,$Obj){
        IF(Get_Key_State(1)<0)
        {
         $x = Cursor_Pos_X() - $arr[0];
         $y = Cursor_Pos_Y() - $arr[1];
           $_TT_->Enabled = False;
            $Obj->y = $y;
    
           $_S1->y = $_S3->y = $y;
           $_S4->y = $_S5->y = ( $_S6->y + $_S1->y ) / 2;
			
			$_OBJ->x = $_S1->x + 4;
			$_OBJ->y = $_S1->y + 4;
			$_OBJ->w = $_S3->x - $_S1->x ;
			$_OBJ->h = $_S7->y - $_S1->y ;
          			
			
        }
        Else
        {
		 $_TT_->Enabled = True;
         Timer::ClearTimer($Move);
        }
       },1);
	 };	   
	   
	  $_S3->OnMouseDown = Function($self) Use($_S1,$_S2,$_S3,$_S4,$_S5,$_S6,$_S7,$_S8,$_OBJ,$_TT_)
	  {
	    
        $Obj = c($self);
        $arr = Array( Cursor_Pos_X() - $Obj->X , Cursor_Pos_Y() - $Obj->Y );
 
        Timer::SetInterval(Function($Move) Use ($_S1,$_S2,$_S3,$_S4,$_S5,$_S6,$_S7,$_S8,$_OBJ,$_TT_,$arr,$Obj){
        IF(Get_Key_State(1)<0)
        {
         $x = Cursor_Pos_X() - $arr[0];
         $y = Cursor_Pos_Y() - $arr[1];
           $_TT_->Enabled = False;
            $Obj->x = $x;
            $Obj->y = $y;
    
              $_S5->x = $_S8->x = $x;
              $_S1->y = $_S2->y = $y;
              $_S2->x = $_S7->x = ( $_S3->x + $_S1->x) / 2;
              $_S4->y = $_S5->y = ( $_S6->y + $_S1->y ) / 2;
			
			$_OBJ->x = $_S1->x + 4;
			$_OBJ->y = $_S1->y + 4;
			$_OBJ->w = $_S3->x - $_S1->x ;
			$_OBJ->h = $_S7->y - $_S1->y ;
          			
			
        }
        Else
        {
		 $_TT_->Enabled = True;
         Timer::ClearTimer($Move);
        }
       },1);
	 };	   
	   
	   
   
	 $_S4->OnMouseDown = Function($self) Use($_S1,$_S2,$_S3,$_S4,$_S5,$_S6,$_S7,$_S8,$_OBJ,$_TT_)
	  {
	    
        $Obj = c($self);
        $arr = Array( Cursor_Pos_X() - $Obj->X , Cursor_Pos_Y() - $Obj->Y );
 
        Timer::SetInterval(Function($Move) Use ($_S1,$_S2,$_S3,$_S4,$_S5,$_S6,$_S7,$_S8,$_OBJ,$_TT_,$arr,$Obj){
        IF(Get_Key_State(1)<0)
        {
         $x = Cursor_Pos_X() - $arr[0];
         $y = Cursor_Pos_Y() - $arr[1];
           $_TT_->Enabled = False;
            $Obj->x = $x;
    
              $_S1->x = $_S6->x = $x;
              $_S2->x = $_S7->x = ($_S3->x + $_S1->x) / 2 ;
			
			$_OBJ->x = $_S1->x + 4;
			$_OBJ->y = $_S1->y + 4;
			$_OBJ->w = $_S3->x - $_S1->x ;
			$_OBJ->h = $_S7->y - $_S1->y ;
          			
			
        }
        Else
        {
		 $_TT_->Enabled = True;
         Timer::ClearTimer($Move);
        }
       },1);
	 };	   
	   
	   
	   
	 $_S5->OnMouseDown = Function($self) Use($_S1,$_S2,$_S3,$_S4,$_S5,$_S6,$_S7,$_S8,$_OBJ,$_TT_)
	  {
	    
        $Obj = c($self);
        $arr = Array( Cursor_Pos_X() - $Obj->X , Cursor_Pos_Y() - $Obj->Y );
 
 
        Timer::SetInterval(Function($Move) Use ($_S1,$_S2,$_S3,$_S4,$_S5,$_S6,$_S7,$_S8,$_OBJ,$_TT_,$arr,$Obj){
        IF(Get_Key_State(1)<0)
        {
         $x = Cursor_Pos_X() - $arr[0];
         $y = Cursor_Pos_Y() - $arr[1];
           $_TT_->Enabled = False;
            $Obj->x = $x;
			
             $_S3->x = $_S8->x = $x;
             $_S2->x = $_S7->x = ( $_S3->x + $_S1->x) / 2;
			
			$_OBJ->x = $_S1->x + 4;
			$_OBJ->y = $_S1->y + 4;
			$_OBJ->w = $_S3->x - $_S1->x ;
			$_OBJ->h = $_S7->y - $_S1->y ;
          			
			
        }
        Else
        {
		 $_TT_->Enabled = True;
         Timer::ClearTimer($Move);
        }
       },1);
	 };	   
	   
 $_S6->OnMouseDown = Function($self) Use($_S1,$_S2,$_S3,$_S4,$_S5,$_S6,$_S7,$_S8,$_OBJ,$_TT_)
	  {
	    
        $Obj = c($self);
        $arr = Array( Cursor_Pos_X() - $Obj->X , Cursor_Pos_Y() - $Obj->Y );
 
        Timer::SetInterval(Function($Move) Use ($_S1,$_S2,$_S3,$_S4,$_S5,$_S6,$_S7,$_S8,$_OBJ,$_TT_,$arr,$Obj){
        IF(Get_Key_State(1)<0)
        {
         $x = Cursor_Pos_X() - $arr[0];
         $y = Cursor_Pos_Y() - $arr[1];
           $_TT_->Enabled = False;
            $Obj->x = $x;
            $Obj->y = $y;
                $_S1->x = $_S4->x = $x;
                $_S7->y = $_S8->y = $y;
                $_S2->x = $_S7->x = ( $_S3->x + $_S1->x) / 2;
                $_S4->y = $_S5->y = ( $_S6->y + $_S1->y ) / 2;
			
			$_OBJ->x = $_S1->x + 4;
			$_OBJ->y = $_S1->y + 4;
			$_OBJ->w = $_S3->x - $_S1->x ;
			$_OBJ->h = $_S7->y - $_S1->y ;
          			
			
        }
        Else
        {
		 $_TT_->Enabled = True;
         Timer::ClearTimer($Move);
        }
       },1);
	 };	
	   
	   
	  $_S7->OnMouseDown = Function($self) Use($_S1,$_S2,$_S3,$_S4,$_S5,$_S6,$_S7,$_S8,$_OBJ,$_TT_)
	  {
	    
        $Obj = c($self);
        $arr = Array( Cursor_Pos_X() - $Obj->X , Cursor_Pos_Y() - $Obj->Y );
 
 
        Timer::SetInterval(Function($Move) Use ($_S1,$_S2,$_S3,$_S4,$_S5,$_S6,$_S7,$_S8,$_OBJ,$_TT_,$arr,$Obj){
        IF(Get_Key_State(1)<0)
        {
         $x = Cursor_Pos_X() - $arr[0];
         $y = Cursor_Pos_Y() - $arr[1];
           $_TT_->Enabled = False;
            $Obj->y = $y;
                $_S6->y = $_S8->y = $y;
                $_S4->y = $_S5->y = ( $_S6->y + $_S1->y ) / 2;
			
			$_OBJ->x = $_S1->x + 4;
			$_OBJ->y = $_S1->y + 4;
			$_OBJ->w = $_S3->x - $_S1->x ;
			$_OBJ->h = $_S7->y - $_S1->y ;
          			
			
        }
        Else
        {
		 $_TT_->Enabled = True;
         Timer::ClearTimer($Move);
        }
       },1);
	 };	 
	   
	 $_S8->OnMouseDown = Function($self) Use($_S1,$_S2,$_S3,$_S4,$_S5,$_S6,$_S7,$_S8,$_OBJ,$_TT_)
	  {
	    
        $Obj = c($self);
        $arr = Array( Cursor_Pos_X() - $Obj->X , Cursor_Pos_Y() - $Obj->Y );
 
        Timer::SetInterval(Function($Move) Use ($_S1,$_S2,$_S3,$_S4,$_S5,$_S6,$_S7,$_S8,$_OBJ,$_TT_,$arr,$Obj){
        IF(Get_Key_State(1)<0)
        {
         $x = Cursor_Pos_X() - $arr[0];
         $y = Cursor_Pos_Y() - $arr[1];
           $_TT_->Enabled = False;
            $Obj->x = $x;
            $Obj->y = $y;
                $_S3->x = $_S5->x = $x;
                $_S6->y = $_S7->y = $y;
                $_S2->x = $_S7->x = ( $_S3->x + $_S1->x) / 2;
                $_S4->y = $_S5->y = ( $_S6->y + $_S1->y ) / 2;
			
			$_OBJ->x = $_S1->x + 4;
			$_OBJ->y = $_S1->y + 4;
			$_OBJ->w = $_S3->x - $_S1->x ;
			$_OBJ->h = $_S7->y - $_S1->y ;
          			
			
        }
        Else
        {
		 $_TT_->Enabled = True;
         Timer::ClearTimer($Move);
        }
       },1);
	 };	 
	   
	   
	   
	   $Timer->OnTimer = Function($self) Use($_S1,$_S2,$_S3,$_S4,$_S5,$_S6,$_S7,$_S8,$_OBJ)
	   {
	    $_S1->x = $_OBJ->x - 4;
        $_S1->y = $_OBJ->y - 4;

        $_S2->x = $_OBJ->x + $_OBJ->w / 2 - 4;
        $_S2->y = $_OBJ->y - 4;

        $_S3->x = $_OBJ->x + $_OBJ->w - 4;
        $_S3->y = $_OBJ->y - 4;

        $_S4->x = $_OBJ->x - 4;
        $_S4->y = $_OBJ->y + $_OBJ->h / 2 - 4;

        $_S5->x = $_OBJ->x + $_OBJ->w - 4;
        $_S5->y = $_OBJ->y + $_OBJ->h / 2 - 4;

        $_S6->x = $_OBJ->x - 4;
        $_S6->y = $_OBJ->y + $_OBJ->h - 4;

        $_S7->x = $_OBJ->x + $_OBJ->w / 2 - 4;
        $_S7->y = $_OBJ->y + $_OBJ->h - 4;

        $_S8->x = $_OBJ->x + $_OBJ->w - 4;
        $_S8->y = $_OBJ->y + $_OBJ->h - 4;
	   };
  
  
  
 
  
 }
}

Function Get_Obj()
{
 Global $_OBJ;
 Return($_OBJ);
}

Function Class_Name()
{
 Global $_OBJ;
 Return($_OBJ->Class_Name);
}

Function Class_Name_Ex()
{
 Global $_OBJ;
 Return($_OBJ->Class_Name_Ex);
}

Function ClearTargets()
{
 Global $_TE_,$_OBJ,$_TT_;
 
 IF($_TE_['Obj'] != Null)
 {
  Foreach($_TE_['Obj'] as $Obj)
  {
   IF($Obj != Null)
   {
    $Obj->Free();
	$_OBJ = Null;
   }
  }
  $_TE_ = Null;
  $_TT_->Enabled = False;
  $_TT_->Free();
  
 }
}

Function Move()
{
 Global $_S1,$_S2,$_S3,$_S4,$_S5,$_S6,$_S7,$_S8,$_OBJ,$_TT_;

 $arr = Array( Cursor_Pos_X() - $_OBJ->X , Cursor_Pos_Y() - $_OBJ->Y );
  Timer::SetInterval(Function($Move1) Use ($_S1,$_S2,$_S3,$_S4,$_S5,$_S6,$_S7,$_S8,$_OBJ,$_TT_,$arr) { 
  
 IF(Get_Key_State(1)<0)
  {
    $_TT_->Enabled = False;
    $_OBJ->x = Cursor_Pos_X() - $arr[0];
    $_OBJ->y = Cursor_Pos_Y() - $arr[1];  
	
	
	    $_S1->x = $_OBJ->x - 4;
        $_S1->y = $_OBJ->y - 4;

        $_S2->x = $_OBJ->x + $_OBJ->w / 2 - 4;
        $_S2->y = $_OBJ->y - 4;

        $_S3->x = $_OBJ->x + $_OBJ->w - 4;
        $_S3->y = $_OBJ->y - 4;

        $_S4->x = $_OBJ->x - 4;
        $_S4->y = $_OBJ->y + $_OBJ->h / 2 - 4;

        $_S5->x = $_OBJ->x + $_OBJ->w - 4;
        $_S5->y = $_OBJ->y + $_OBJ->h / 2 - 4;

        $_S6->x = $_OBJ->x - 4;
        $_S6->y = $_OBJ->y + $_OBJ->h - 4;

        $_S7->x = $_OBJ->x + $_OBJ->w / 2 - 4;
        $_S7->y = $_OBJ->y + $_OBJ->h - 4;

        $_S8->x = $_OBJ->x + $_OBJ->w - 4;
        $_S8->y = $_OBJ->y + $_OBJ->h - 4;
  }
  Else
  {
    Timer::ClearTimer($Move1);
	$_TT_->Enabled = True;
  } 
 },1);
 
 
}











Function __construct($owner = nil , $init = True , $self = nil){
 parent::__construct($owner,$init,$self);}
 
}