object fmMain: TfmMain
  Left = 306
  Top = 117
  Caption = 'Devel Studio 2019'
  ClientHeight = 832
  ClientWidth = 718
  Color = clWhite
  Font.Charset = DEFAULT_CHARSET
  Font.Color = clWindowText
  Font.Height = -13
  Font.Name = 'Segoe UI'
  Font.Size = 8
  Font.Quality = fqClearTypeNatural
  Font.Style = []
  Menu = MainMenu
  OldCreateOrder = False
  Position = poScreenCenter
  PixelsPerInch = 96
  TextHeight = 15
  DoubleBuffered = True
  object Splitter2: TSplitter
    Left = 5
    Top = 33
    Height = 776
    Color = clWhite
    ParentColor = False
    ExplicitLeft = 228
    ExplicitTop = 35
    ExplicitHeight = 516
  end
  object Splitter1: TSplitter
    Left = 709
    Top = 33
    Height = 776
    Align = alRight
    Color = clWhite
    ParentColor = False
    ExplicitLeft = 13
    ExplicitTop = 41
    ExplicitHeight = 508
  end
  object action_panel: TPanel
    Left = 0
    Top = 0
    Width = 718
    Height = 28
    Align = alTop
    Color = clWhite
    Font.Charset = DEFAULT_CHARSET
    Font.Color = clBlack
    Font.Height = -12
    Font.Name = 'Segoe UI'
    Font.Style = []
	BevelOuter = bvNone
	ParentColor = True
    ParentFont = False
    TabOrder = 0
    ExplicitWidth = 836
    DesignSize = (
      726
      38)
	object BevelLineBottom: TBevel
      Left = 0
      Top = 27
      Width = 718
      Height = 2
	  ExplicitWidth = 718
	  Anchors = [akLeft, akRight]
      Shape = bsBottomLine
    end
    object btn_newProject: TImage
      Left = 5
      Top = 1
      Width = 28
      Height = 27
      Hint = '{New project}'
      ShowHint = True
	  Transparent = true
    end
    object btn_openProject: TImage
      Left = 37
      Top = 1
      Width = 28
      Height = 27
      Hint = '{Open file}'
      ShowHint = True
	  Transparent = true
    end
    object btn_saveProject: TImage
      Left = 69
      Top = 1
      Width = 28
      Height = 27
      Hint = '{Save as...}'
      ShowHint = True
	  Transparent = true
    end
    object Bevel1: TBevel
      Left = 104
      Top = 3
      Width = 6
      Height = 23
      Shape = bsLeftLine
    end
	object btn_make: TImage
      Left = 112
      Top = 1
      Width = 28
      Height = 27
      Hint = '{Make program}'
      ShowHint = True
	  TransParent = True
    end
    object btn_stop: TImage
      Left = 144
      Top = 1
      Width = 28
      Height = 27
      Hint = '{Stop project}'
      ShowHint = True
	  Transparent = True
    end
    object btn_run: TImage
      Left = 209
      Top = 1
      Width = 28
      Height = 27
      Hint = '{Compile and Run project}'
      ShowHint = True
	  Transparent = True
    end
	object btn_rundebug: TImage
      Left = 177
      Top = 1
      Width = 28
      Height = 27
      Hint = '{Compile in debug mode}'
      ShowHint = True
	  Transparent = True
    end
    object Bevel2: TBevel
      Left = 245
      Top = 3
      Width = 5
      Height = 23
      Shape = bsLeftLine
    end
    object btn_newForm: TImage
      Left = 253
      Top = 1
      Width = 28
      Height = 27
      Hint = '{Add new form}'
      Transparent = true
    end
    object btn_delForm: TImage
      Left = 285
      Top = 1
      Width = 28
      Height = 27
      Hint = '{Remove selected form}'
      Transparent = true
    end
    object tabForms: TTabControl
      Left = 320
      Top = 0
      Width = 380
      Height = 28
      Cursor = crHandPoint
      Anchors = [akLeft, akTop, akRight]
      Font.Charset = DEFAULT_CHARSET
      Font.Color = clBlack
      Font.Height = -13
      Font.Name = 'Segoe UI'
      Font.Style = []
      ParentFont = False
      PopupMenu = formsPopur
      TabHeight = 28
      TabOrder = 0
    end
  end
  object statusBar: TLabel
    Left = 0
    Top = 753
    Width = 726
    Height = 24
    Color = clWhite
    TransParent = False
    Cursor = crHandPoint
    Font.Charset = DEFAULT_CHARSET
    Font.Color = clWindowText
    Font.Height = -10
    Font.Name = 'Segoe UI Light'
    Font.Size = 10
    Font.Style = [fsBold]
    Align = alBottom
    ExplicitWidth = 836
  end
  object cr_bicycle2: TShape
    Left = 0
    Top = 780
	Width = 726
	Height = 2
	Align = alBottom
    Brush.Style = bsClear
	Pen.Style = psClear
  end
  object tmpEdit: TEdit
    Left = 0
    Top = 8
    Width = 0
    Height = 22
    Font.Charset = DEFAULT_CHARSET
    Font.Color = clWindowText
    Font.Height = -13
    Font.Name = 'Segoe UI'
    Font.Style = []
    ParentFont = False
    TabOrder = 2
    Alignment = taLeftJustify
    ColorOnEnter = clBlack
    FontColorOnEnter = clNone
    TabOnEnter = False
    MarginLeft = 0
    MarginRight = 0
  end
  object pDockRight: TPanel
    Left = 719
    Top = 38
    Width = 7
    Height = 715
    Align = alRight
    BevelOuter = bvNone
    Color = clWhite
    DockSite = True
    TabOrder = 3
    ExplicitLeft = 829
  end
  object pDockLeft: TPanel
    Left = 0
    Top = 38
    Width = 6
    Height = 715
    Align = alLeft
    BevelOuter = bvNone
    Color = clWhite
    DockSite = True
    TabOrder = 4
  end
  object pComponents: TDSPanel
    Left = 577
    Top = 45
    Width = 231
    Height = 572
    Hint = '{Components}'
    Color = clWhite
    Constraints.MinHeight = 29
    Constraints.MinWidth = 40
	BevelKind = bkFlat
	BevelInner = bvNone
	BevelOuter = bvNone
    DragKind = dkDock
    DragMode = dmAutomatic
    TabOrder = 5
    object list: TCategoryButtons
      Left = 1
      Top = 24
      Width = 229
      Height = 499
      Align = alClient
      ButtonFlow = cbfVertical
      ButtonHeight = 26
      ButtonWidth = 32
      ButtonOptions = [boFullSize,  boGradientFill, boShowCaptions, boBoldCaptions, boCaptionOnlyBorder]
      BevelOuter = bvNone
      BevelInner = bvNone
      BorderStyle = bsNone
      Images = MainImages24
      BackgroundGradientColor = clWhite
      Font.Charset = DEFAULT_CHARSET
      Font.Color = clWindowText
      Font.Height = -12
      Font.Size = 9
      Font.Name = 'Segoe UI'
      Font.Style = []
      Font.Quality = fqClearTypeNatural
      Images = MainImages24
      Categories = <>
      RegularButtonColor = clWhite
      SelectedButtonColor = cl3DLight
      HotButtonColor = 8454143
      Color = clWhite
      ShowHint = True
      TabOrder = 0
    end
    object c_type: TComboBox
      Left = 1
      Top = 1
      Width = 229
      Height = 16
      Align = alTop
      Style = csOwnerDrawFixed
      Color = clWhite
      ItemHeight = 17
      ItemIndex = 0
      TabOrder = 1
      Text = '{Icons + text}'
      Items.Strings = (
        '{Icons + text}'
        '{Small Icons}')
    end
	object c_cl_pane: TPanel
    Left = 0
    Top = 22
    Width = 229
    Height = 24
	BevelOuter = bvNone
    Caption = ''
	Align = alTop
    object c_br_bicycle:TShape
      Left = 1
      Top = 1
      Width = 228
      Height = 1
      Align = alTop
	Brush.Style = bsClear
	Pen.Style = psClear
    end
	object c_search: TEdit
    Left = 0
    Top = 23
    Width = 204
    Height = 24
    Align = alLeft
	Anchors = [akLeft, akTop, akBottom, akRight]
    Color = clWhite
    Text = ''
	Hint = '{Find}'
	ShowHint = True
	end
    object c_tcursor: TSpeedButton
    Left = 205
    Top = 25
    Width = 24
    Height = 23
	Align = alRight
	Anchors = [akTop, akBottom, akRight]
    Flat = True
    Glyph.Data = {
      76060000424D7606000000000000360000002800000014000000140000000100
      2000000000004006000000000000000000000000000000000000FFFFFF00FFFF
      FF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFF
      FF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFF
      FF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFF
      FF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFF
      FF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFF
      FF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00C2C2
      C200D7D7D700FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFF
      FF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFF
      FF00FFFFFF00FFFFFF00D8D8D8002E2E2E003E3E3E005A5A5A00F0F0F000FFFF
      FF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFF
      FF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00787878007575
      7500DFDFDF0049494900C7C7C700FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFF
      FF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF005A5A5A004C4C
      4C00E5E5E500F1F1F1002A2A2A00C5C5C500BEBEBE003F3F3F00FDFDFD00FFFF
      FF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFF
      FF00FFFFFF00FFFFFF00212121008A8A8A003B3B3B007E7E7E005C5C5C00E0E0
      E00068686800A7A7A700FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFF
      FF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF0021212100E0E0
      E0009A9A9A0024242400B0B0B000CACACA0037373700F7F7F700FFFFFF00FFFF
      FF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFF
      FF00FFFFFF00FFFFFF0021212100E0E0E000E0E0E000B5B5B500E0E0E0007676
      7600353535006666660079797900BBBBBB00FFFFFF00FFFFFF00FFFFFF00FFFF
      FF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF0021212100E0E0
      E000E0E0E000E0E0E000E0E0E000C3C3C300ACACAC009A9A9A00727272003737
      3700FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFF
      FF00FFFFFF00FFFFFF0021212100E0E0E000E0E0E000E0E0E000E0E0E000E0E0
      E000E0E0E000C0C0C0003C3C3C00BDBDBD00FFFFFF00FFFFFF00FFFFFF00FFFF
      FF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF0021212100E0E0
      E000E0E0E000E0E0E000E0E0E000E0E0E000B8B8B8003B3B3B00C6C6C600FFFF
      FF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFF
      FF00FFFFFF00FFFFFF0021212100E0E0E000E0E0E000E0E0E000E0E0E000B0B0
      B00039393900D0D0D000FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFF
      FF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF0021212100E0E0
      E000E0E0E000E0E0E000A6A6A6003D3D3D00D9D9D900FFFFFF00FFFFFF00FFFF
      FF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFF
      FF00FFFFFF00FFFFFF0021212100E0E0E000E0E0E0009D9D9D0040404000E1E1
      E100FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFF
      FF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF0021212100E0E0
      E0009191910043434300E8E8E800FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFF
      FF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFF
      FF00FFFFFF00FFFFFF0021212100868686004C4C4C00EEEEEE00FFFFFF00FFFF
      FF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFF
      FF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF005A5A5A005757
      5700F3F3F300FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFF
      FF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFF
      FF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFF
      FF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFF
      FF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFF
      FF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFF
      FF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00}
	  Hint = '{Unselect category}'
	  ShowHint = True
  end
    object c_br_bicycle2:TShape
      Left = 1
      Top = 26
      Width = 228
      Height = 1
      Align = alTop
	Brush.Style = bsClear
	Pen.Style = psClear
    end
  end
  end
  object pInspector: TDSPanel
    Left = 388
    Top = 45
    Width = 182
    Height = 572
    Hint = '{Inspector}'
    Color = clWhite
    Constraints.MinHeight = 29
    Constraints.MinWidth = 40
    DragKind = dkDock
    DragMode = dmAutomatic
	BevelOuter = bvNone
    TabOrder = 6
    object listObjs: TListView
      Left = 1
      Top = 1
      Width = 180
      Height = 570
      Cursor = crDefault
	  Ctl3D = false
	  BorderStyle = bsNone
	  HotTrack = true
	  HotTrackStyles = [htHandPoint]
      Align = alClient
      Color = clWhite
      Columns = <>
      MultiSelect = True
	  BevelInner = bvNone
	  BevelOuter = bvNone
	  BevelKind = bkNone
	  BorderStyle = bsSingle
      TabOrder = 0
    end
  end
  object pProps: TDSPanel
    Left = 37
    Top = 45
    Width = 204
    Height = 572
    Hint = '{Properties and Events}'
	Caption = '{Properties and Events}'
	ShowCaption = True
    BevelOuter = bvNone
    Color = clWhite
    Constraints.MinHeight = 29
    Constraints.MinWidth = 40
    DragKind = dkDock
    DragMode = dmAutomatic
    TabOrder = 7
    DesignSize = (
      204
      572)
    object Panel2: TPanel
      Left = 0
      Top = 0
      Width = 204
      Height = 25
      Anchors = [akLeft, akTop, akRight, akBottom]
      BevelOuter = bvNone
      Color = clWhite
      TabOrder = 1
    end
    object panelPropEvent: TPageControl
      Left = 0
      Top = 0
      Width = 204
      Height = 572
      ActivePage = tabProps
      Align = alClient
      Font.Charset = DEFAULT_CHARSET
      Font.Color = clWindowText
      Font.Height = -13
      Font.Name = 'Segoe UI'
      Font.Style = []
      ParentFont = False
      TabOrder = 0
      object tabProps: TTabSheet
        HelpType = htKeyword
        HelpKeyword = 'AAAAAhQCEQVDTEFTUxEJVFRhYlNoZWV0EQZQQVJBTVMUAREIYXZpc2libGUF'
        Caption = '{properties}'
        object Panel1: TPanel
          Left = 0
          Top = 0
          Width = 196
          Height = 47
          Align = alTop
          Color = clWhite      	
          BevelOuter = bvNone
          TabOrder = 0
          DesignSize = (
            196
            47)
          object Label1: TLabel
            Left = 0
            Top = 0
            Width = 194
            Height = 15
            Caption = '{Components}'
          end
          object c_formComponents: TComboBox
            Left = 0
            Top = 20
            Width = 194
            Height = 22
            Color = clWhite
            Style = csDropDown
            Anchors = [akLeft, akTop, akRight]
            DropDownCount = 20
            ItemHeight = 16
            TabOrder = 0
			TabStop = False
            AutoComplete = True
          end
        end
      end
      object tabEvents: TTabSheet
        HelpType = htKeyword
        HelpKeyword = 'AAAAAhQCEQVDTEFTUxEJVFRhYlNoZWV0EQZQQVJBTVMUAREIYXZpc2libGUF'
        Caption = '{events}'
        ImageIndex = 1
        DesignSize = (
          196
          542)
		object shape1: TShape
		  Top = 86
          Width = 196
          Height = 8
		  Brush.Color = clBtnFace
		  Pen.Style = psClear
		  Anchors = [akTop, akLeft, akRight, akBottom]
		end
        object btn_addEvent: TSpeedButton
          Left = 6
          Top = 9
          Width = 181
          Height = 38
          Cursor = crHandPoint
          Anchors = [akLeft, akTop, akRight]
          Caption = '{Add Event}'
          Font.Charset = DEFAULT_CHARSET
          Font.Color = clWindowText
          Font.Height = -12
          Font.Name = 'Segoe UI'
          Font.Style = [fsBold]
          ParentFont = False
          ParentShowHint = False
          ShowHint = False
          Flat = True
        end
        object btn_delEvent:  TSpeedButton
          Left = 6
          Top = 55
          Width = 29
          Height = 29
          Cursor = crHandPoint
          Hint = '{Delete event}'
          ParentShowHint = False
          ShowHint = True
          Flat = True
        end
        object btn_editEvent:  TSpeedButton
          Left = 77
          Top = 55
          Width = 111
          Height = 29
          Cursor = crHandPoint
          Anchors = [akLeft, akTop, akRight]
          Caption = '{Edit Event}'
          Flat = True
        end
        object eventList: TListBox
          Left = 0
          Top = 91
          Width = 196
          Height = 450
          Style = lbOwnerDrawVariable
          Anchors = [akLeft, akTop, akRight, akBottom]
          Ctl3D = False
          Font.Charset = DEFAULT_CHARSET
          Font.Color = clWindowText
          Font.Height = -16
          Font.Name = 'Segoe UI'
          Font.Style = []
          ItemHeight = 25
          ParentCtl3D = False
          ParentFont = False
		  BevelInner = bvNone
		  BevelOuter = bvNone
		  BorderStyle = bsNone
          TabOrder = 3
          Alignment = taLeftJustify
          BorderSelected = True
          Color = clWhite
          TwoColor = clWhite
          TwoFontColor = clNone
          MarginLeft = 2
          ReadOnly = False
        end
        object btn_changeEvent: TSpeedButton
          Left = 42
          Top = 55
          Width = 28
          Height = 29
          Cursor = crHandPoint
          Hint = '{Change type of selected event}'
          ParentShowHint = False
          ShowHint = True
          Flat = True
        end
      end
    end
  end
  object TPanel
    Left = 9
    Top = 38
    Width = 706
    Height = 715
    Align = alClient
    TabOrder = 8
    ExplicitWidth = 816
    object Splitter3: TSplitter
      Left = 1
      Top = 703
      Width = 704
      Height = 5
      Cursor = crVSplit
      Align = alBottom
      Color = clWhite
      ParentColor = False
      ExplicitTop = 823
      ExplicitWidth = 816
    end
    object pDockMain: TScrollBox
      Left = 1
      Top = 1
      Width = 757
      Height = 548
	  StyleElements = []
	  Color = clWhite
	  ParentColor = False
      Align = alClient
      BorderStyle = bsNone
	  BevelOuter = bvNone
      TabOrder = 1
      ExplicitWidth = 699
      ExplicitHeight = 764
	  HorzScrollBar.Smooth = True
	  HorzScrollBar.Tracking = True
	  VertScrollBar.Smooth = True
	  VertScrollBar.Tracking = True
      object shapeSize: TShape
        Left = 2
        Top = 1
        Width = 559
        Height = 360
        Pen.Style = psDash
        Pen.Color = 10070188
		Brush.Color = 14215660
      end
    end
    object pDockBottom: TPanel
      Left = 1
      Top = 708
      Width = 704
      Height = 6
      Align = alBottom
      BevelOuter = bvNone
      Color = clWhite
      DockSite = True
      TabOrder = 0
      ExplicitWidth = 814
    end
  end
  object pDebugWindow: TDSPanel
    Left = 37
    Top = 240
    Width = 730
    Height = 160
    Hint = '{Debug Info}'
    BevelOuter = bvNone
    Color = clWhite
    Constraints.MinHeight = 29
    Constraints.MinWidth = 40
    DragKind = dkDock
    DragMode = dmAutomatic
    Font.Charset = DEFAULT_CHARSET
    Font.Color = clWindowText
    Font.Height = -13
    Font.Name = 'Segoe UI'
    Font.Style = []
    ParentFont = False
    TabOrder = 9
    object PageControl1: TPageControl
      Left = 0
      Top = 0
      Width = 730
      Height = 160
      ActivePage = TabSheet1
      Align = alClient
      TabOrder = 0
      TabPosition = tpBottom
      object TabSheet1: TTabSheet
        Caption = '{Console}'
        object debugList: TListBox
          Left = 0
          Top = 0
          Width = 722
          Height = 133
          Cursor = crHandPoint
          Style = lbOwnerDrawFixed
          Align = alClient
          Color = clWhite
          Font.Charset = DEFAULT_CHARSET
          Font.Color = clWindowText
          Font.Height = -12
          Font.Name = 'Segoe UI'
          Font.Style = []
          ItemHeight = 15
          ParentFont = False
          TabOrder = 0
          Alignment = taLeftJustify
          BorderSelected = True
		  BevelInner = bvNone
		  BevelOuter = bvNone
		  BevelKind = bkNone
		  BorderStyle = bsNone
          TwoColor = clNone
          TwoFontColor = clNone
          MarginLeft = 2
          ReadOnly = True
        end
      end
      object TabSheet2: TTabSheet
        HelpType = htKeyword
        HelpKeyword = 'AAAAAhQCEQVDTEFTUxEJVFRhYlNoZWV0EQZQQVJBTVMUAREIYXZpc2libGUF'
        Caption = '{Variables}'
        Enabled = False
        ImageIndex = 1
        TabVisible = False
        ExplicitLeft = 0
        ExplicitTop = 0
        ExplicitWidth = 0
        ExplicitHeight = 0
        object btn_add: TSpeedButton
          Left = 2
          Top = 3
          Width = 29
          Height = 29
          Glyph.Data = {
            36040000424D3604000000000000360000002800000010000000100000000100
            2000000000000004000000000000000000000000000000000000FF00FF00FF00
            FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00
            FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00
            FF00FF00FF00FF00FF00FF00FF00FF00FF0040A0800040A0800040A08000FF00
            FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00
            FF00FF00FF00FF00FF00FF00FF0040A0800040E0A00040E0A00040E0A00040A0
            8000FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00
            FF00FF00FF00FF00FF00FF00FF0040A0800000C0A00000C0A00000C0A00040A0
            8000FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00
            FF00FF00FF00FF00FF00FF00FF0040A0800000C0A00000C0A00000C0A00040A0
            8000FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00
            FF00FF00FF00FF00FF00FF00FF0040A0800000C0A00000C0A00000C0A00040A0
            8000FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF0040A0
            800040A0800040A0800040A0800040A0800040E0A00040E0A00000E0A00040A0
            800040A0800040A0800040A0800040A08000FF00FF00FF00FF0040C0800040E0
            A00040E0A00040E0A00040E0A00040E0A00040E0A00040E0A00040E0A00040E0
            A00040E0A00040E0A00040E0A00040E0A00040C08000FF00FF0000C0800040E0
            A00040E0A00040E0A00040E0A00040E0A00040E0A00040E0A00040E0A00040E0
            A00040E0A00040E0A00040E0A00040E0A00000C08000FF00FF0000C08000F0FB
            FF0080E0E00080E0E00080E0E000F0FBFF0040E0A00040E0A00040E0A000F0FB
            FF0080E0E00080E0E00080E0E000F0FBFF0000C08000FF00FF00FF00FF0000C0
            A00000C0800000C0800000C0800000C0800040E0A00040E0A00040E0A00000C0
            800000C0800000C0800000C0800000C08000FF00FF00FF00FF00FF00FF00FF00
            FF00FF00FF00FF00FF00FF00FF0000C0800040E0A00040E0A00040E0C00000C0
            8000FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00
            FF00FF00FF00FF00FF00FF00FF0000C0A00040E0C00040E0A00040E0C00000C0
            A000FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00
            FF00FF00FF00FF00FF00FF00FF0000C0A00040E0C00040E0A00040E0C00000C0
            A000FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00
            FF00FF00FF00FF00FF00FF00FF0000C0A000F0FBFF0080E0E000F0FBFF0000C0
            A000FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00
            FF00FF00FF00FF00FF00FF00FF00FF00FF0000C0A00000C0A00000C0A000FF00
            FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00}
        end
        object btn_del: TSpeedButton
          Left = 2
          Top = 39
          Width = 29
          Height = 29
          Glyph.Data = {
            36040000424D3604000000000000360000002800000010000000100000000100
            2000000000000004000000000000000000000000000000000000FFFFFF00FFFF
            FF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFF
            FF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFF
            FF00FFFFFF001717170017171700FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFF
            FF00FFFFFF001717170017171700FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFF
            FF0017171700000080000000800017171700FFFFFF00FFFFFF00FFFFFF00FFFF
            FF0017171700000080000000800017171700FFFFFF00FFFFFF00FFFFFF001717
            17000000800000008000000080000000800017171700FFFFFF00FFFFFF001717
            17000000800000008000000080000000800017171700FFFFFF00FFFFFF001717
            170000008000000080000000FF00000080000000800017171700171717000000
            8000000080000000FF00000080000000800017171700FFFFFF00FFFFFF00FFFF
            FF001717170000008000000080000000FF000000800000008000000080000000
            80000000FF00000080000000800017171700FFFFFF00FFFFFF00FFFFFF00FFFF
            FF00FFFFFF001717170000008000000080000000FF000000FF000000FF000000
            FF00000080000000800017171700FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFF
            FF00FFFFFF00FFFFFF0017171700000080000000FF005855FF005653FF000000
            FF000000800017171700FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFF
            FF00FFFFFF00FFFFFF0017171700000080000000FF005D5AFF005A57FF000000
            FF000000800017171700FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFF
            FF00FFFFFF001717170000008000000080000000FF000000FF000000FF000000
            FF00000080000000800017171700FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFF
            FF001717170000008000000080000000FF000000800000008000000080000000
            80000000FF00000080000000800017171700FFFFFF00FFFFFF00FFFFFF001717
            170000008000000080000000FF00000080000000800017171700171717000000
            8000000080000000FF00000080000000800017171700FFFFFF00FFFFFF001717
            17000000800000008000000080000000800017171700FFFFFF00FFFFFF001717
            17000000800000008000000080000000800017171700FFFFFF00FFFFFF00FFFF
            FF0017171700000080000000800017171700FFFFFF00FFFFFF00FFFFFF00FFFF
            FF0017171700000080000000800017171700FFFFFF00FFFFFF00FFFFFF00FFFF
            FF00FFFFFF001717170017171700FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFF
            FF00FFFFFF001717170017171700FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFF
            FF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFF
            FF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00}
        end
      end
    end
  end
  object MainMenu: TMainMenu
    Left = 672
    Top = 48
    object itFile: TMenuItem
      Caption = '{&file}'
      object it_new: TMenuItem
        Bitmap.Data = {
          36030000424D3603000000000000360000002800000010000000100000000100
          18000000000000030000C40E0000C40E00000000000000000000FFFFFFE1E1E1
          8686868787878787878787878686868686868686868686868686868686868383
          83838383D7D7D7FFFFFFFFFFFFB2B2B2FCFCFCFBFBFBF9F9F9F9F9F9F7F7F7F7
          F7F7F7F7F7F5F5F5F5F5F5F5F5F5F5F5F5FCFCFCA0A0A0FFFFFFFFFFFFB2B2B2
          FCFCFCE7E7E7E7E7E7E7E7E7E7E7E7E7E7E7E8E8E8E8E8E8E8E8E8E8E8E8E8E8
          E8F9F9F9A0A0A0FFFFFFFFFFFFB2B2B2FCFCFCE9E9E9E9E9E9E9E9E9E9E9E9E9
          E9E9E9E9E9E9E9E9E9E9E9E9E9E9E9E9E9FBFBFBA0A0A0FFFFFFFFFFFFB3B3B3
          FCFCFCECECECECECECECECECECECECECECECECECECECECECECECECECECECECEC
          ECFCFCFCA1A1A1FFFFFFFFFFFFB3B3B3FCFCFCF0F0F0F2F2F2F2F2F2F2F2F2F0
          F0F0F0F0F0EEEEEEEEEEEEEEEEEEEEEEEEFCFCFCA1A1A1FFFFFFFFFFFFB3B3B3
          FCFCFCF5F5F5F5F5F5F5F5F5F5F5F5F5F5F5F5F5F5F3F3F3F2F2F2F0F0F0F2F2
          F2FCFCFCA1A1A1FFFFFFFFFFFFB3B3B3FCFCFCF7F7F7F7F7F7F7F7F7F7F7F7F7
          F7F7F7F7F7F7F7F7F7F7F7F5F5F5F3F3F3FCFCFCA2A2A2FFFFFFFFFFFFB3B3B3
          FCFCFCF9F9F9F9F9F9F9F9F9F9F9F9F9F9F9F9F9F9F9F9F9F9F9F9F9F9F9F9F9
          F9FCFCFCA2A2A2FFFFFFFFFFFFB3B3B3FCFCFCFBFBFBFBFBFBFBFBFBFBFBFBFB
          FBFBFBFBFBFBFBFBFBFBFBFBFBFBFBFBFBFCFCFCA2A2A2FFFFFFFFFFFFB3B3B3
          FCFCFCFBFBFBFBFBFBFBFBFBFBFBFBFBFBFBFBFBFBFBFBFBFBFBFBF7F7F7F3F3
          F3FCFCFCA2A2A2FFFFFFFFFFFFB3B3B3FCFCFCFCFCFCFCFCFCFCFCFCFCFCFCFC
          FCFCFCFCFCFCFCFCC6C6C6CCCCCCC9C9C9DADADAA3A3A3FFFFFFFFFFFFB3B3B3
          FCFCFCFCFCFCFCFCFCFCFCFCFCFCFCFCFCFCFCFCFCFBFBFBCBCBCBE8E8E8FCFC
          FCA4A4A4E7E7E7FFFFFFFFFFFFB3B3B3FCFCFCFCFCFCFCFCFCFCFCFCFCFCFCFC
          FCFCFCFCFCF7F7F7CFCFCFFCFCFCAEAEAEEBEBEBFFFFFFFFFFFFFFFFFFB3B3B3
          FCFCFCFCFCFCFCFCFCFCFCFCFCFCFCFCFCFCFCFCFCF7F7F7DADADAB1B1B1F1F1
          F1FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFC0C0C0BFBFBFBFBFBFBFBFBFBFBFBFBF
          BFBFBFBFBFC0C0C0BBBBBBE7E7E7FFFFFFFFFFFFFFFFFFFFFFFF}
        Caption = '{new}'
        ShortCut = 16462
      end
      object it_open: TMenuItem
        Bitmap.Data = {
          66030000424D6603000000000000360000002800000010000000110000000100
          1800000000003003000000000000000000000000000000000000FFFFFFFFFFFF
          FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
          FFFFFFFFFFFFFFFFFFFF2C86D82D88D82D87D82D88D82D88D82D88D82D88D82D
          88D82D88D82D88D82D88D82D87D82D88D82C86D8FFFFFFFFFFFF338ED9DCF0FA
          98E1F695E0F692DFF68EDEF589DCF585DAF480D9F47AD7F374D5F370D3F2C2EA
          F83594DAFFFFFFFFFFFF3594DAEFFAFE93E5F88FE4F889E3F882E1F77ADFF771
          DEF667DBF55BD8F44DD4F340D1F2CAF2FB3594DAFFFFFFFFFFFF369ADAF2FAFD
          94E6F892E5F890E5F88BE3F886E2F77FE1F777DEF66CDCF65ED9F44FD5F3CCF2
          FB3594DAFFFFFFFFFFFF36A1DAF6FCFE94E5F893E5F893E5F891E5F893DBE993
          D7E393D2DC90CED78CC8CF86C1C6C9D8D63594DAC57444CA7F5337A6DAFEFFFF
          F8FDFFF6FDFFF5FCFFF3FCFE9AE4F49AE6F79BE6F69DE5F59EE5F59FE5F4DAF3
          F83594DAFDF4EECA805435ABDAE8F6FB70BCE755AAE24DA5E091C9EBFAF3EFFD
          FEFDFFFDFCFFFDFCFEFDFCFEFCFBFEFEFD3594DAEFF2E8CE815636AADAF1FAFD
          94DEF593DCF464BCE93594DA3594DA3594DA3594DA3594DA3594DA3594DA3594
          DA3594DAFBF6EFCC835535AFDAF7FCFE8EE4F891DEF59FE0F5ACE1F6CA8452FF
          F7F1FFE9D9FFEADBFFE9D9FFE7D7FFE5D2FFE2CBFFF7F1CB855536B3DAFDFEFE
          FEFFFFFEFEFFFDFEFFFEFFFFE4BA91FFF7F0FFE7D5FDE7D6FDE6D4FCE4D0FBE3
          CBFADCC2FEF3E8CC865634B4D95EC2E160C3E260C3E260C3E25FC3E2E4BB91FF
          F7F2FEE7D5FEE7D5FDE5D1FAE0CAF9DEC4F7D9BCFDF2E7CC8757FFFFFFFFFFFF
          FFFFFFFFFFFFFFFFFFFFFFFFE4BB92FEF7F1FCE5D2FCE4D1FBE2CCF9DDC4F6D7
          BBF3D1AFFAEFE4CC8758FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFE4BB92FE
          F6F0FCE2CDFCE3CDFADFC8F7D9BCF5E9DDFAF3EBFBF8F3CA8353FFFFFFFFFFFF
          FFFFFFFFFFFFFFFFFFFFFFFFE4BB93FEF5EDFCDEC5FBE0C7F9DCC2F5D3B4FEF9
          F3FAE2C4ECC193C37D48FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFE5BE96FF
          FFFEFDF3E9FDF3EAFCF2E8FAEFE3FAF2E7EABB88CF8555B4693DFFFFFFFFFFFF
          FFFFFFFFFFFFFFFFFFFFFFFFEAC39DE6BF96E4BB92E4BB92D1A06CD09E6DCC96
          5FC47942B2673CFFFFFF}
        Caption = '{open}'
        ShortCut = 16463
      end
      object it_save: TMenuItem
        Bitmap.Data = {
          36040000424D3604000000000000360000002800000010000000100000000100
          2000000000000004000000000000000000000000000000000000BA6A368FB969
          35B5B86935EEB76835FFB56835FFB46734FFB26634FFB06533FFAE6433FFAC63
          32FFAA6232FFA96132FFA86031FFA76031FEA66031F1A86131C4BA6A35DEEBC6
          ADFFEAC5ADFFFEFBF8FFFEFBF8FFFEFBF8FFFEFBF8FFFEFBF8FFFEFBF8FFFEFB
          F8FFFEFBF8FFFEFBF8FFFEFBF8FFC89A7CFFC79879FFA76031EDBA6B37FEEDCA
          B3FFE0A27AFFFEFAF7FF62C088FF62C088FF62C088FF62C088FF62C088FF62C0
          88FF62C088FF62C088FFFDF9F6FFCA8D65FFC99B7CFFA76031FEBB6C38FFEECC
          B6FFE1A27AFFFEFAF7FFBFDCC2FFBFDCC2FFBFDCC2FFBFDCC2FFBFDCC2FFBFDC
          C2FFBFDCC2FFBFDCC2FFFDF9F6FFCD9068FFCC9E81FFA86132FFBB6B38FFEFCE
          B8FFE1A279FFFEFAF7FF62C088FF62C088FF62C088FF62C088FF62C088FF62C0
          88FF62C088FF62C088FFFDF9F6FFCF936AFFCEA384FFAA6132FFBA6A36FFEFD0
          BBFFE2A27AFFFEFBF8FFFEFBF8FFFEFBF8FFFEFBF8FFFEFBF8FFFEFBF8FFFEFB
          F8FFFEFBF8FFFEFBF8FFFEFBF8FFD3966DFFD2A78AFFAB6232FFBB6A36FFF0D2
          BEFFE2A37AFFE2A37AFFE1A37AFFE2A37BFFE1A37BFFE0A178FFDE9F77FFDD9F
          76FFDC9D74FFD99B72FFD89971FFD69970FFD5AB8EFFAD6333FFBB6A36FFF2D5
          C2FFE3A37AFFE3A37AFFE2A37BFFE2A37BFFE2A47BFFE1A279FFE0A178FFDEA0
          77FFDE9E75FFDC9D74FFDA9B73FFD99B73FFDAB095FFAF6433FFBB6A36FFF2D8
          C5FFE3A47BFFE3A37AFFE3A47AFFE2A47BFFE2A37BFFE1A37BFFE1A279FFDFA0
          77FFDE9F76FFDD9E74FFDB9C72FFDC9D74FFDDB59AFFB16534FFBB6B36FFF4D9
          C7FFE6A67DFFC88C64FFC98D65FFC98E67FFCB926CFFCB926DFFCA9069FFC88C
          65FFC88C64FFC88C64FFC88C64FFDA9C74FFE1BA9FFFB36634FFBB6B36FEF4DC
          C9FFE7A77DFFF9ECE1FFF9ECE1FFF9EDE3FFFCF4EEFFFDFAF7FFFDF7F3FFFAED
          E5FFF7E7DBFFF7E5D9FFF6E5D8FFDEA077FFE4BEA4FFB46734FFBC6B36FAF5DD
          CCFFE7A87EFFFAF0E8FFFAF0E8FFC98D66FFFAF0E9FFFDF8F3FFFEFAF8FFFCF4
          EFFFF9E9DFFFF7E7DBFFF7E5D9FFE0A278FFE7C2A9FFB66835FFBC6B36F0F6DF
          D0FFE8A87EFFFCF6F1FFFCF6F1FFC88C64FFFAF1E9FFFBF4EEFFFDFAF7FFFDF9
          F6FFFAF0E8FFF8E8DDFFF7E6DBFFE1A37AFFEFD5C3FFB76935FEBC6B36D8F6DF
          D1FFE9AA80FFFEFAF6FFFDFAF6FFC88C64FFFBF3EEFFFBF1EAFFFCF6F2FFFEFB
          F8FFFCF6F1FFF9ECE2FFF8E7DBFFEED0BAFFECD0BDFFBB703EF8BC6B369BF6E0
          D1FFF7E0D1FFFEFBF8FFFEFBF7FFFDF9F6FFFCF5F0FFFAF0EAFFFBF2EDFFFDF9
          F6FFFDFAF7FFFBF1EBFFF8E9DFFEECD0BDFBC9895EECB5693563BC6B3671BC6B
          3690BC6B36CCBC6B36EEBC6B36FABB6B36FEBB6B36FFBB6A36FFBB6A36FFBC6C
          39FFBD6E3BFFBB6D3AFFBB6B38EFBB703ECBB6693554FFFFFF00}
        Caption = '{save}'
        ShortCut = 16467
      end
      object it_saveas: TMenuItem
        Caption = '{save_as}'
        ShortCut = 24659
      end
      object it_demoprojects: TMenuItem
        Caption = '{demo_projects}'
        object projects1: TMenuItem
          Caption = '{projects}'
          Enabled = False
        end
        object N01: TMenuItem
          Caption = '-'
        end
      end
      object it_lastprojects: TMenuItem
        Caption = '{last_projects}'
        object clearlist1: TMenuItem
          Caption = '{clear_list}'
        end
        object N6: TMenuItem
          Caption = '-'
        end
      end
      object N1: TMenuItem
        Caption = '-'
      end
      object it_export: TMenuItem
        Bitmap.Data = {
          36030000424D3603000000000000360000002800000010000000100000000100
          18000000000000030000130B0000130B00000000000000000000FFFFFFFFFFFF
          FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
          FFFFFFFFFFFFFFFFFFFFF5F5F5E7E7E7E5E5E5E5E5E5E5E5E5E5E5E5E5E5E5E5
          E5E5E5E5E5E5E5E5E5E5E5E5E5E5E7E7E7F4F4F4FFFFFFFFFFFF9D9D9D828282
          8282828282828282828282828282828282828282828282828282828282828282
          829D9D9DFFFFFFFFFFFF969696EBEBEBE7E7E7E7E7E7E7E7E7E7E7E7E7E7E7E7
          E7E7E7E7E7E7E7E7E7E7E7E7E7E7EBEBEB969696FFFFFFFFFFFFA0A0A0EAEAEA
          E2E2E2E2E2E2E2E2E2E2E2E2E2E2E2E2E2E2E2E2E2E2E2E2E2E2E29696967C7C
          7C979797FFFFFFFFFFFFA5A5A5EDEDEDE6E6E6E6E6E6E6E6E6E6E6E6E6E6E6E6
          E6E6E6E6E6E6E6E6E6E6E6858585FFFFFF868686C9C9C9FFFFFFA9A9A9F0F0F0
          EBEBEBEBEBEBEBEBEBEBEBEBEBEBEBDFDFDFCBCBCBB3B3B39C9C9C909090E4E4
          E4FFFFFF929292CECECEAEAEAEF3F3F3EFEFEFEFEFEFEFEFEFEFEFEFEFEFEFF2
          F2F2F5F5F5F9F9F9FDFDFDFFFFFFFFFFFFFFFFFFFFFFFF9E9E9EB1B1B1F7F7F7
          F4F4F4F4F4F4F4F4F4F4F4F4F4F4F4EAEAEADADADAC5C5C5B2B2B2A8A8A8E9E9
          E9FFFFFFA9A9A9D8D8D8B5B5B5FAFAFAF8F8F8F8F8F8F8F8F8F8F8F8F8F8F8F8
          F8F8F8F8F8F8F8F8F8F8F8B2B2B2FFFFFFB3B3B3DCDCDCFFFFFFB8B8B8FDFDFD
          FCFCFCFCFCFCFCFCFCFCFCFCFCFCFCFCFCFCFCFCFCFCFCFCFCFCFCCACACABABA
          BAB8B8B8FFFFFFFFFFFFBABABAFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
          FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFBABABAFFFFFFFFFFFFB6B6B6BBBBBB
          B9B9B9B7B7B7B4B4B4B2B2B2AEAEAEABABABA8A8A8A4A4A4A2A2A29F9F9F9C9C
          9C9A9A9AFFFFFFFFFFFFC1C1C1CFCFCFDBDBDBD7D7D7D2D3D3CDCECEC8C9C9C6
          C5C5C7C4C4CAC5C5CFC7C7D5CACACDC3C3C1C1C1FFFFFFFFFFFFE8E8E8C3C3C3
          BBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBC3C3
          C3E8E8E8FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
          FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF}
        Caption = '{Export}'
        ShortCut = 16453
        Visible = False
      end
      object it_import: TMenuItem
        Bitmap.Data = {
          36030000424D3603000000000000360000002800000010000000100000000100
          18000000000000030000130B0000130B00000000000000000000FFFFFFFFFFFF
          FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
          FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF5F5F5E7E7E7E5E5E5E5E5E5E5E5E5E5
          E5E5E5E5E5E5E5E5E5E5E5E5E5E5E5E5E5E5E5E5E7E7E7F4F4F4FFFFFFFFFFFF
          9D9D9D8282828282828282828282828282828282828282828282828282828282
          828282828282829D9D9DFFFFFFFFFFFF969696EBEBEBE7E7E7E7E7E7E7E7E7E7
          E7E7E7E7E7E7E7E7E7E7E7E7E7E7E7E7E7E7E7E7EBEBEB969696FFFFFFFFFFFF
          A0A0A0EAEAEA969696808080BEBEBEE2E2E2E2E2E2E2E2E2E2E2E2E2E2E2E2E2
          E2E2E2E2EAEAEAA0A0A0FFFFFFFFFFFFA5A5A5EDEDED858585FEFEFE9D9D9DD0
          D0D0E6E6E6E6E6E6E6E6E6E6E6E6E6E6E6E6E6E6EDEDEDA5A5A5AFAFAF929292
          929292909090909090E4E4E4FAFAFABFBFBFE1E1E1EBEBEBEBEBEBEBEBEBEBEB
          EBEBEBEBF0F0F0A9A9A99E9E9EFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFBFBFBF7
          F7F7F3F3F3EFEFEFEFEFEFEFEFEFEFEFEFEFEFEFF3F3F3AEAEAEBEBEBEA9A9A9
          A9A9A9A8A8A8A8A8A8E9E9E9FDFDFDD0D0D0ECECECF4F4F4F4F4F4F4F4F4F4F4
          F4F4F4F4F7F7F7B1B1B1FFFFFFFFFFFFB5B5B5FAFAFAB2B2B2FFFFFFC4C4C4E8
          E8E8F8F8F8F8F8F8F8F8F8F8F8F8F8F8F8F8F8F8FAFAFAB5B5B5FFFFFFFFFFFF
          B8B8B8FDFDFDCACACABDBDBDE5E5E5FCFCFCFCFCFCFCFCFCFCFCFCFCFCFCFCFC
          FCFCFCFCFDFDFDB8B8B8FFFFFFFFFFFFBABABAFFFFFFFFFFFFFFFFFFFFFFFFFF
          FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFBABABAFFFFFFFFFFFF
          B6B6B6BBBBBBB9B9B9B7B7B7B4B4B4B2B2B2AEAEAEABABABA8A8A8A4A4A4A2A2
          A29F9F9F9C9C9C9A9A9AFFFFFFFFFFFFC1C1C1CFCFCFDBDBDBD7D7D7D2D3D3CD
          CECEC8C9C9C6C5C5C7C4C4CAC5C5CFC7C7D5CACACDC3C3C1C1C1FFFFFFFFFFFF
          E8E8E8C3C3C3BBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBB
          BBBBBBBBC3C3C3E8E8E8FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
          FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF}
        Caption = '{Import}'
        ShortCut = 16457
        Visible = False
      end
      object N3: TMenuItem
        Caption = '-'
        Visible = False
      end
      object it_exit: TMenuItem
        Caption = '{exit}'
      end
    end
    object itEdit: TMenuItem
      Caption = '{&edit}'
      object it_undo: TMenuItem
        Caption = '{Undo}'
        ShortCut = 16474
      end
      object it_redo: TMenuItem
        Caption = '{Redo}'
        ShortCut = 24666
      end
      object N4: TMenuItem
        Caption = '-'
      end
      object it_preference: TMenuItem
        Caption = '{Preference}'
      end
    end
    object itService: TMenuItem
      Caption = '{&view}'
      object it_components: TMenuItem
        Caption = '{Components}'
        Checked = True
      end
      object it_objectinspector: TMenuItem
        Caption = '{Object inspector}'
        Checked = True
      end
      object it_props: TMenuItem
        Caption = '{Props and Events}'
        Checked = True
      end
      object it_debuginfo: TMenuItem
        Caption = '{Debug Info}'
        Checked = True
      end
    end
    object itProject: TMenuItem
      Caption = '{&project}'
      object Compile1: TMenuItem
        Caption = '{Compile}'
        ShortCut = 16504
        Visible = False
      end
      object it_run: TMenuItem
        Bitmap.Data = {
          36040000424D3604000000000000360000002800000010000000100000000100
          2000000000000004000000000000000000000000000000000000000000000000
          000004733AFF21824FFF638272FF000000000000000000000000000000000000
          0000000000000000000000000000000000000000000000000000000000000000
          000004733AFF7ACFA4FF2C8C5AFF3D7659FFAEAEAEFF00000000000000000000
          0000000000000000000000000000000000000000000000000000000000000000
          000004733AFF82D8ACFF76D6A6FF3C9D6AFF27744CFFACAEADFF000000000000
          0000000000000000000000000000000000000000000000000000000000000000
          000009773FFF83DBAEFF1FC671FF72DEA7FF4BB27FFF177445FFA8ADAAFF0000
          0000000000000000000000000000000000000000000000000000000000000000
          000004733AFF83DCAFFF11C369FF1ACC73FF69DFA3FF5AC28DFF137643FF9EA7
          A3FF000000000000000000000000000000000000000000000000000000000000
          000004733AFFA9DCC1FF10BD65FF11C167FF13C269FF59D395FF67C998FF167C
          47FF889C92FF0000000000000000000000000000000000000000000000000000
          000004733AFFA9DCC1FF0DB35EFF0EB660FF0EB660FF0DB45FFF47C484FF70CA
          9CFF1D824DFF678C79FF00000000000000000000000000000000000000000000
          000004733AFFA9DCC1FF0CAA58FF12AE5EFF15AF60FF16AD61FF13AA5DFF3AB6
          77FF75C79DFF288957FF4E8367FF000000000000000000000000000000000000
          000004733AFFA9DCC1FF2EAD6BFF2BAD6AFF27AB68FF22A964FF1CA55FFF41B2
          78FF78C69FFF298858FF678C79FF000000000000000000000000000000000000
          000004733AFFA9DCC1FF36AD70FF32AC6DFF2DAA6AFF28A866FF58BC89FF78C5
          9DFF1F804EFF839A8EFF00000000000000000000000000000000000000000000
          000004733AFFA9DCC1FF3EB176FF3AAF73FF36AE70FF6FC598FF71BF97FF187B
          49FFA6B0ABFF0000000000000000000000000000000000000000000000000000
          000004733AFFA9DCC1FF45B47BFF47B47CFF82CCA6FF67B68CFF177745FFC1C5
          C3FF000000000000000000000000000000000000000000000000000000000000
          000004733AFFA5DABFFF57BB87FF90D2B0FF5BAB82FF23774CFFD4D5D4FF0000
          0000000000000000000000000000000000000000000000000000000000000000
          000004733AFFA9DCC1FF9BD5B7FF4C9F73FF3D7D5CFF00000000000000000000
          0000000000000000000000000000000000000000000000000000000000000000
          000004733AFFA4D9BEFF3D9366FF5F8873FF0000000000000000000000000000
          0000000000000000000000000000000000000000000000000000000000000000
          000004733AFF2D8859FF859C90FF000000000000000000000000000000000000
          0000000000000000000000000000000000000000000000000000}
        Caption = '{Compile && Run}'
        ShortCut = 120
      end
      object it_stopprogram: TMenuItem
        Bitmap.Data = {
          36040000424D3604000000000000360000002800000010000000100000000100
          2000000000000004000000000000000000000000000000000000000000000000
          0000000000000000000000000000000000000000000000000000000000000000
          000000000000000000000000000000000000000000000000000000000000DFC0
          A700DFC0A7FFDFC0A7FFDFC0A7FFDFC0A7FFDFC0A7FFDFC0A7FFDFC0A7FFDFC0
          A7FFDFC0A7FFDFC0A7FFDFC0A7FFDFC0A7FFDFC0A7000000000000000000DFC0
          A7FFDCBA9FFFA46534FFA46534FFA46534FFA46534FFA46534FFA46534FFA465
          34FFA46534FFA46534FFA46534FFDCBA9FFFDFC0A7FF0000000000000000DFC0
          A7FFA46534FFA46534FFA46534FFA46534FFA46534FFA46534FFA46534FFA465
          34FFA46534FFA46534FFA46534FFA46534FFDFC0A7FF0000000000000000DEBF
          A5FFA46534FFA46534FFFCF9F7FFFCF9F7FFFCF9F7FFFCF9F7FFFCF9F7FFFCF9
          F7FFFCF9F7FFFCF9F7FFA46534FFA46534FFDEBFA5FF0000000000000000DEBE
          A4FFA46534FFA46534FFFCF9F7FFF0C29CFFF0C29CFFF2C29CFFF2C29CFFF0BF
          98FFF0BB94FFFCF9F7FFA46534FFA46534FFDEBEA4FF0000000000000000DDBD
          A3FFA46534FFA46534FFFCF9F7FFF3C6A1FFF2C7A4FFF2C8A6FFF2C8A6FFF2C7
          A4FFF2C5A0FFFCF9F7FFA46534FFA46534FFDDBDA3FF0000000000000000DDBC
          A2FFA46534FFA46534FFFCF9F7FFF2C7A8FFF3CCADFFF5D0B5FFF5D0B5FFF5D0
          B5FFF4CEB0FFFCF9F7FFA46534FFA46534FFDDBCA2FF0000000000000000DDBC
          A2FFA46534FFA46534FFFCF9F7FFF4CBAAFFF4D1B4FFF6D6BCFFF7D9C3FFF7D9
          C3FFF6D7C0FFFCF9F7FFA46534FFA46534FFDDBCA2FF0000000000000000DDBC
          A2FFA46534FFA46534FFFCF9F7FFF2CAACFFF6D2B4FFF7D8BFFFF7DBC5FFF9E1
          CDFFF8E0D0FFFCF9F7FFA46534FFA46534FFDDBCA2FF0000000000000000DDBC
          A2FFA46534FFA46534FFFCF9F7FFF3C8A5FFF3CEB1FFF6D6BCFFF7DAC5FFF9E1
          D3FFF8E5D8FFFBF7F5FFA46534FFA46534FFDDBCA2FF0000000000000000DCBB
          A0FFA46534FFA46534FFFCF9F7FFFCF9F7FFFCF9F7FFFCF9F7FFFCF9F7FFFCF9
          F7FFFCF9F7FFFCF9F7FFA46534FFA46534FFDCBBA0FF0000000000000000DCBA
          9FFFA46534FFA46534FFA46534FFA46534FFA46534FFA46534FFA46534FFA465
          34FFA46534FFA46534FFA46534FFA46534FFDCBA9FFF0000000000000000DCBA
          9FFFDCBA9FFFA46534FFA46534FFA46534FFA46534FFA46534FFA46534FFA465
          34FFA46534FFA46534FFA46534FFDCBA9FFFDCBA9FFF0000000000000000DCBA
          9F00DCBA9FFFDCBA9FFFDCBA9FFFDCBA9FFFDCBA9FFFDCBA9FFFDCBA9FFFDCBA
          9FFFDCBA9FFFDCBA9FFFDCBA9FFFDCBA9FFFDCBA9F0000000000000000000000
          0000000000000000000000000000000000000000000000000000000000000000
          0000000000000000000000000000000000000000000000000000}
        Caption = '{Stop program}'
        ShortCut = 16497
      end
      object N2: TMenuItem
        Caption = '-'
      end
      object it_buildproject: TMenuItem
        Bitmap.Data = {
          36030000424D3603000000000000360000002800000010000000100000000100
          18000000000000030000130B0000130B00000000000000000000FFFFFFFFFFFF
          FFFFFFFFFFFFFCFDFE265F9C4E80BA6C95C6ABC3DEE8EEF6FFFFFFFFFFFFFFFF
          FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF5283BCC0E1F6A6
          D4F083B8DF3A79B7FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF35745D0E593D
          0E593D0E593D0E593D23647BD5E6F5D7E9FACBE3F99FD9F4468BC3E8EFF60E59
          3D0E593D35745DFFFFFF146043FFFFFFFFFFFFFDFEFEFBFEFDD4E1ED7FA7D2F9
          FCFEBCE3F938BDE8519ACC498DC5E8EFF6E1F4EF146043FFFFFF1B684AFCFDFD
          FCFEFEF9FDFCF6FBFAF1FAF76390C2C8E4F544D0F400C3F225B8E65198CB4D91
          C6E8EFF61B684AFFFFFF247152FAFCFBF9FDFCF6FBFAF1FAF7EDF8F5E8EFF660
          8FC4C2EAF828CBF300C3F225B8E65198CB5193C8E8EFF6FFFFFF2C7A5AF8FCFA
          F6FBFAF1FAF7EDF8F5E8F6F2E3F4EFE8EFF66594C5C2EBF828CBF300C3F225B8
          E65198CB5696CAFFFFFF368462F7FBFAF1FAF7EDF8F5E8F6F2E3F4EFDDF2ECD8
          F0E9E8EFF66B97C7C2EBF828CBF300C3F227B8E65299CC6C9DCB3E8D6AF4FAF8
          EDF8F5E8F6F2E3F4EFDDF2ECD8F0E9D2EEE6CDECE4E8EFF6709BCAC2EBF828CB
          F300C3F23FBBE65693C7479672F1F9F7E9F6F2E3F4EFDDF2ECD8F0E9D2EEE6CD
          ECE4C8EAE1C3E8DEE8EFF6759ECCC2EBF842D0F35E9FCEB8CCE34E9E79EEF9F5
          E4F4EFDDF2ECD8F0E9D2EEE6CDECE4C8EAE1C3E8DEBFE6DBBBE5D9E8EFF679A1
          CE7CA4CE59989BFFFFFF54A57FEEF8F5EBF7F4E8F6F2E4F5F0E1F4EFDEF2EDDB
          F1EBD8F0E9D6EFE8D3EEE7D1EEE6C8E6E2C5E3E254A57FFFFFFF55A47F59AA83
          59AA8359AA8359AA8359AA8359AA8359AA8359AA8359AA8359AA8359AA8359AA
          8359AA8354A47EFFFFFF53A27E99C9B29ACAB39ACAB39ACAB39ACAB39ACAB39A
          CAB39ACAB39ACAB39ACAB39ACAB39ACAB39ACAB351A17CFFFFFF5BA88398C9B1
          99C9B299C9B299C9B299C9B299C9B299C9B299C9B299C9B299C9B299C9B299C9
          B299C9B258A781FFFFFFA2CFB95EAC865BAB845BAB845BAB845BAB845BAB845B
          AB845BAB845BAB845BAB845BAB845BAB845BAB849FCEB8FFFFFF}
        Caption = '{Build project}'
        ShortCut = 116
      end
      object it_projectmodules: TMenuItem
        Bitmap.Data = {
          36030000424D3603000000000000360000002800000010000000100000000100
          18000000000000030000130B0000130B00000000000000000000FFFFFFFFFFFF
          FFFFFFFFFFFFFFFFFFFFFFFFFEFEFEF8F8F8EFEFEFF0F0F0FAFAFAFFFFFFFFFF
          FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFDFDFDF3F3F3DB
          DBDBC2C2C2C6C6C6E1E1E1F7F7F7FEFEFEFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
          FFFFFFFFFFFFFDFDFDF0F0F0B9BEB7417638435437969696B7B7B7DADADAF4F4
          F4FEFEFEFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF5F5F598B0972E97432C
          C44D2D91013553207D7D7DB3B3B3DEDEDEF9F9F9FFFFFFFFFFFFFFFFFFFFFFFF
          FEFEFEF6F6F69DBE9A21B1462DD2672ABD4A2B93002D9A002C600A858585BEBE
          BEE4E4E4F9F9F9FFFFFFFFFFFFFCFCFCF0F0F0CECED2447C552DCF5C28C75C30
          C9582D99092C92002B8901454D589D9D9DBBBBBBDDDDDDF4F4F4FFFFFFF2F2F2
          AAAABB2323B10D40892BD14D47E1784CEF8333CA592B9E122982000556B72A43
          94898989B2B2B2D7D7D7FFFFFF8989BC0B0BCA0000FF12438C8AFC847FFFA949
          ED7E31D2682DCE5D279714035FB10068FF1341B56E6F78BCBCBCFFFFFF0000D1
          0000FF0000FF0208CC457E716FFE844BF48333D46321B1400988790072EF0060
          FF006BFF193DA4B3B3B3FFFFFF0606D60000FF2121FF4E4CFD0908D01144733F
          D45924B04903859F00AFFF00A9FF006CFF0064FF1B45A7B5B5B5FFFFFF0909DC
          4343FF7D7DFF7171FF5A59FF1E18ED11226B0B87B600D2FF00D6FF00BBFF009E
          FF007EFF1A4AB4C8C8C8FFFFFF5656C58787F88181FF6868FF6565FF5453F755
          508A5193D801F5FF00DBFF00B5FF00A9FF009CFF49669EE8E8E8FFFFFFF8F8FB
          8282CB6060E76F6FFF4444D373738AEDEDEDF6F6FA7DA6F205BAFB00BDFF0888
          EF71829FE9E9E9FCFCFCFFFFFFFFFFFFFFFFFF9D9DD54747B4A7A7B0F5F5F5FD
          FDFDFFFFFFFFFFFF9DB4F42B81DBA8ACB7F5F5F5FDFDFDFFFFFFFFFFFFFFFFFF
          FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
          FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
          FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF}
        Caption = '{Project Modules}'
        ShortCut = 117
        Visible = False
      end
      object N5: TMenuItem
        Caption = '-'
      end
      object it_projectoptions: TMenuItem
        Caption = '{Project options}'
        ShortCut = 118
      end
    end
    object it_Utils: TMenuItem
      Caption = '{&utils}'
    end
    object itLanguage: TMenuItem
      Caption = '&Language'
    end
    object itHelp: TMenuItem
      Caption = '{&help}'
      object it_registration: TMenuItem
        Caption = '{Registration}'
        Visible = False
      end
      object N12: TMenuItem
        Caption = '-'
      end
      object it_tip: TMenuItem
        Bitmap.Data = {
          36030000424D3603000000000000360000002800000010000000100000000100
          18000000000000030000130B0000130B00000000000000000000FFFFFFFFFFFF
          FCFCFCEFEFEFDDDDDDCFCFCFC3C3C34646462C2C2CBCBCBCCECECEDBDBDBECEC
          ECFBFBFBFFFFFFFFFFFFFFFFFFFFFFFFFDFDFDF7F7F7EEEEEEE6E6E6ABABABC8
          C9C9A59F9F686868E6E6E6EDEDEDF5F5F5FDFDFDFFFFFFFFFFFFFFFFFFFFFFFF
          FFFFFFFFFFFFFFFFFFFFFFFFABABABDCDDDDBAAEAE686868FFFFFFFFFFFFFFFF
          FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFABABABB4
          B4B48F8F8F686868FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
          FFFFFFFFFFFFFFFFFFF4F8F97DAEBEB2F1F1B1F1F17DAEBEF4F8F9FFFFFFFFFF
          FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFCFE0E792C0CCAF
          F0F0AEEFEF92C0CCCFE0E7FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
          FFFFFFFFFFFFFCFDFD91BAC8A2D3DBA6EDEDA5EDEDA2D3DB91B9C8FCFDFDFFFF
          FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFB6D2DC8ABDCBB2F0F195
          E8E89CEAEAB9F3F389B9C8B4CFD9FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
          FFFFFFDCEAEF88BBCBABEAEC72DDDD72DDDD80E1E196E8E8BBEFF183B3C3D9E7
          ECFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFA2CAD89AD5DE80E1E164D8D85F
          D7D763D9D979DFDF9CEAEAA4D5DD99C0CDFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
          FFFFFF8DC0D2B7F0F198E8E89AE9E987E3E367D9D964D8D881E1E1BCF1F281B3
          C5FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF91C4D5C6F6F6BCF3F3BEF3F3B2
          F0F087E3E35FD7D774DDDDB8F2F283B7C9FFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
          FFFFFFA5D0DEB6E4ECC5F7F7C0F4F4BEF3F39AE9E964D8D877DEDEA9DFE69AC6
          D5FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFD4E9EF9DCEDDCFF8F9C4F6F6BB
          F3F394E7E76EDBDBA8ECED95C8D7CFE4EBFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
          FFFFFFFEFEFEC0DFE99ED0DEB3E2EBC0F3F4ACEDEE9FDCE497CBDABCDBE6FEFE
          FEFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFD7EAF1AED6E39D
          CDDD9DCDDDABD4E1D6E9F0FFFFFFFFFFFFFFFFFFFFFFFFFFFFFF}
        Caption = '{tip}'
        Visible = False
      end
      object it_aboutprogram: TMenuItem
        Caption = '{about_program}'
      end
      object N8: TMenuItem
        Caption = '-'
      end
      object it_siteprogram: TMenuItem
        Bitmap.Data = {
          36050000424D3605000000000000360400002800000010000000100000000100
          08000000000000010000C40E0000C40E00000001000000000000CC6600009933
          0000FF9E0000F58A0000F88F0000FB950000415E0300616B100045DD75000B77
          3100DD770000D88D0000E3790000DC7600004B6B00003AD46E0058F38D00DE78
          0000F27C000069FFA400006E0E00006D0E003C6100006CFFA000E97B00002FCA
          6700F892000038D46D0039E3950030FFE200E0BD6D00364900006D6C0000F181
          000066FF980061FF9D00886500000F732B00FFDC85000F5800004AE47D0041DA
          74002EC76B00F7860000F08A00008E801F000FEDCD00F48E0000296916000257
          0000244E050061540000E87F000004CDA400EF8900001E5E0D0012883600115B
          00001D53000041E0850004A87200FF9B0000009C650025A3460028B75700F68A
          0000656700002AFFD800F4870000BCB36000E370000028AF55000CF9E5002264
          0F0044E68800FFCA6200AD6900000F65020040D9720044EC9C00019153000078
          1700E17A0000DD7900006EFF98006F460000887E1A00067A1B0043D76C0061FF
          9A000D6B19000AC69700928526004FE071001BF3C40025FFE60000B88900FF8C
          000004FFFF0051E07C008A6A00005B6E1000DAA233004FE6810040FFC0005CF0
          8B0028CD800020F5C7000D88210042D17100FFD9840008690E000068050039C9
          670034C77C0000620200196001003AEA9A0048D16B00E87D00000BFFFF009068
          0000E47C00000DFFF60004A56C00894E00009C66000036FFCC00FFA8120028BB
          6900E87E0000B38303002EE8A10014C4920020D194004A6800004EEB8500FFB8
          380022983F0009883100226B1D009F7A00009AAC630041DA7300FA8B000071FF
          9800FFFFFF000000000000000000000000000000000000000000000000000000
          0000000000000000000000000000000000000000000000000000000000000000
          0000000000000000000000000000000000000000000000000000000000000000
          0000000000000000000000000000000000000000000000000000000000000000
          0000000000000000000000000000000000000000000000000000000000000000
          0000000000000000000000000000000000000000000000000000000000000000
          0000000000000000000000000000000000000000000000000000000000000000
          0000000000000000000000000000000000000000000000000000000000000000
          0000000000000000000000000000000000000000000000000000000000000000
          0000000000000000000000000000000000000000000000000000000000000000
          0000000000000000000000000000000000000000000000000000000000000000
          0000000000000000000000000000000000000000000000000000000000000000
          0000000000000000000000000000000000000000000000000000000000000000
          0000000000000000000000000000000000000000000000000000929292929201
          0101010101929292929292929201010202020202020101929292929201050E8D
          41362C2F1A05050192929201044219391252117A212B0404019292010C7E6A3F
          64180A4627310D4401920103825338591434774C401051790301010390166D88
          7520612447291C33030101033D3A68627C838757711B8A1F7001000B15638525
          66898B13280F676F2A00004D23175A1E6E4B8C84084E8F223E00000643546973
          8E262D814A08585E320092003C5F914F30455C2E3B5D6B6000929200065B7872
          766C7437487B355500929292000909861D7F568049507D009292929292000007
          0765020202000092929292929292920000000000009292929292}
        Caption = '{site_program}'
      end
      object it_sendmail: TMenuItem
        Caption = '{send_mail}'
        Visible = False
      end
    end
    object hidden1: TMenuItem
      Caption = 'hidden'
      Visible = False
      object hd_formrename: TMenuItem
        Caption = 'rename form'
        ShortCut = 8305
      end
      object hd_deleteform: TMenuItem
        Caption = 'delete form'
        ShortCut = 8238
      end
      object hd_newform: TMenuItem
        Caption = 'new form'
        ShortCut = 8306
      end
      object hd_leftform: TMenuItem
        Caption = 'left form'
        ShortCut = 8229
      end
      object hd_rightform: TMenuItem
        Caption = 'right form'
        ShortCut = 8231
      end
      object hd_deleteform2: TMenuItem
        Caption = 'delete form2'
        ShortCut = 16499
      end
    end
  end
  object MainImages16: TImageList
    Left = 632
    Top = 48
  end
  object MainImages32: TImageList
    Height = 32
    ImageType = itMask
    Width = 32
    Left = 592
    Top = 48
  end
  object editorPopup: TPopupMenu
    Left = 672
    Top = 88
    object it_it_Componentname1: TMenuItem
      Caption = '{Component name}'
      Visible = False
    end
    object N7: TMenuItem
      Caption = '-'
      Visible = False
    end
    object itemDel: TMenuItem
      Caption = '{delete}'
      ShortCut = 46
    end
    object itemCopy: TMenuItem
      Bitmap.Data = {
      B6040000424DB604000000000000360000002800000010000000120000000100
      2000000000008004000000000000000000000000000000000000FFFFFF00FFFF
      FF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFF
      FF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00A099
      9400918A8500918A8500918A8500918A8500918A8500918A8500918A8500918A
      85007A706800FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00918A
      8500FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFF
      FF00958D8800FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00918A
      8500FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFF
      FF00958D8800B2ADA900B4AEAA00B4AEAA00D0CDCA00FFFFFF00FFFFFF00918A
      8500FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFF
      FF00958D8800DEDCDA00E0DEDC00E0DEDC00948C8600FFFFFF00FFFFFF00918A
      8500FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFF
      FF00958D8800FFFFFF00FFFFFF00FFFFFF00958D8800FFFFFF00FFFFFF00918A
      8500FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFF
      FF00958D8800FFFFFF00FFFFFF00FFFFFF00958D8800FFFFFF00FFFFFF00918A
      8500FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFF
      FF00958D8800FFFFFF00FFFFFF00FFFFFF00958D8800FFFFFF00FFFFFF00918A
      8500FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFF
      FF00958D8800FFFFFF00FFFFFF00FFFFFF00958D8800FFFFFF00FFFFFF00918A
      8500FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFF
      FF00958D8800FFFFFF00FFFFFF00FFFFFF00958D8800FFFFFF00FFFFFF00918A
      8500FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00EBE9E800DDDBD900DDDB
      D900887F7900FFFFFF00FFFFFF00FFFFFF00958D8800FFFFFF00FFFFFF00918A
      8500FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00918A8500B4AEAA00A49E
      9900695F5900FEFEFE00FFFFFF00FFFFFF00958D8800FFFFFF00FFFFFF00918A
      8500FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00918A8500F0EFEE00877D
      7700EEEDEC00FFFFFF00FFFFFF00FFFFFF00958D8800FFFFFF00FFFFFF009189
      8400E0DEDC00E0DEDC00E0DEDC00E0DEDC00E0DEDC00867D7700877D7700EEED
      EC00FFFFFF00857C7600958D88008C837E00948C8600FFFFFF00FFFFFF00CDCA
      C700B1ABA700B1ABA700AFAAA600776D6500B1ABA700B1ABA700EEEDEC00FFFF
      FF00FFFFFF00958D8800F2F1F00088807A00EDECEB00FFFFFF00FFFFFF00FFFF
      FF00FFFFFF00FFFFFF00FFFFFF0098908B00FFFFFF00FFFFFF00FFFFFF00FFFF
      FF00FFFFFF00887F790088807A00EDECEB00FFFFFF00FFFFFF00FFFFFF00FFFF
      FF00FFFFFF00FFFFFF00FFFFFF007A716B00958D8800958D8800958D8800958D
      8800958D8800776D6500EDECEB00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFF
      FF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFF
      FF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00}
      Caption = '{copy}'
      ShortCut = 16451
    end
	object itemCAll: TMenuItem
      Caption = '{Select All}'
      ShortCut = 16449
    end
    object itemCut: TMenuItem
      Bitmap.Data = {
        36030000424D3603000000000000360000002800000010000000100000000100
        18000000000000030000130B0000130B00000000000000000000FFFFFFFFFFFF
        FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF5F5FA7178C73B45CA5E66C4E3E4F2FFFF
        FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFE1E2F1D9DBEEFDFDFEFFFFFF96
        9BD3404BD9484FC73D47D16C73C7FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
        A2A6D73641C83741CF636AC4E7E7F3686ECB3641CCE7E7F37A80CC3842C6EBEC
        F5FFFFFFFFFFFFFFFFFFFFFFFFFFFFFF4952C54952CE5860C43F4ADD535CBF50
        5AC13B45C8FDFDFE9095D13741C8E0E1F0FFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
        4049C7686FC6FFFFFF757CCA4250D2CBA375414FD66F76C65159CA4850C6F5F5
        FAFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF737ACA3B46CCC6C9E5AFB2DB3B48D4DB
        BD9CEECCA6404CDE3A43D19DA1D4FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
        E1E2F14D54C33C46CF3C47CC3F4CD7D8BC9AF6EAE1CCAD83E6DBCAFFFFFFFFFF
        FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFE1E2F1767CCA535BC77F85CAC8
        AC86F0E0D0C7AA83FAF8F5FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
        FFFFFFFFFFFFFFFFFFFDFDFEFFFFFFD4BEA1F6EADDE1CDB4C4A985FFFFFFFFFF
        FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFD6
        C1A4F1E2D4CFB592F5EBE0C8B08FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
        FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFD6C1A5EEDFCED6C3A7CAAF8EE9D8C5D5C3
        AAFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFD8
        C4A9E7D5C1EDE5DAF3EEE6CAAF8ED9C3A8E2D5C3FFFFFFFFFFFFFFFFFFFFFFFF
        FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFD9C6ADDEC9AFF2ECE4FFFFFFEEE7DCC7AB
        86C4A682FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFDA
        C8AFD7BFA2F8F5F0FFFFFFFFFFFFECE4D8BA996FFFFFFFFFFFFFFFFFFFFFFFFF
        FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFDBC9B1D2B998FBF9F7FFFFFFFFFFFFFFFF
        FFFCFBF9FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFEB
        E3D6C9AD88FDFCFBFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF}
      Caption = '{cut}'
      ShortCut = 16472
    end
    object itemPaste: TMenuItem
      Caption = '{paste}'
      ShortCut = 16470
    end
    object N9: TMenuItem
      Caption = '-'
    end
    object itemSendtofront: TMenuItem
      Caption = '{send_to_front}'
    end
    object itemSendtoback: TMenuItem
      Caption = '{send_to_back}'
    end
    object N10: TMenuItem
      Caption = '-'
    end
    object itemLock: TMenuItem
      Caption = '{Lock component}'
      ShortCut = 16465
    end
    object itemGroup: TMenuItem
      Caption = '{Grouping}'
      ShortCut = 16455
    end
    object itemAddevent: TMenuItem
      Caption = '{Add event}'
      ShortCut = 16453
    end
    object N11: TMenuItem
      Caption = '-'
    end
  end
  object MainImages24: TImageList
    BkColor = clWhite
    DrawingStyle = dsTransparent
    Height = 24
    Width = 24
    Left = 552
    Top = 48
  end
  object formsPopur: TPopupMenu
    Left = 672
    Top = 128
    object fp_delete: TMenuItem
      Bitmap.Data = {
        36030000424D3603000000000000360000002800000010000000100000000100
        18000000000000030000130B0000130B00000000000000000000FFFFFFFFFFFF
        FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
        FFFFFFFFFFFFFFFFFFFFCECECE7E7E7E7E7E7E7E7E7E7E7E7E7E7E7E7E7E7ECA
        CACAFFFFFF0000A8FFFFFFCACACAFFFFFF0000A8FFFFFFDEDEDE7E7E7EE5E5E5
        E5E5E5E5E5E5E5E5E5E5E5E5E5E5E5FFFFFF0000B60000B60000B6FFFFFF0000
        B60000B60000B6FFFFFF7E7E7EE5E5E5E5E5E5E5E5E5E5E5E5E5E5E5E5E5E5F4
        F4F4FFFFFF0000C50000C50000C50000C50000C5FFFFFFCCCCCC7E7E7EE5E5E5
        E5E5E5E5E5E5E5E5E5E5E5E5E5E5E5E5E5E5F4F4F4FFFFFF0000D30000D30000
        D3FFFFFFF6F6F68888887E7E7EE5E5E5E5E5E5E5E5E5E5E5E5E5E5E5E5E5E5F4
        F4F4FFFFFF0000E20000E20000E20000E20000E2FFFFFFCFCFCF7E7E7EE5E5E5
        E5E5E5E5E5E5E5E5E5E5E5E5E5E5E5FFFFFF0000F10000F10000F1FFFFFF0000
        F10000F10000F1FFFFFF8B8B8BF2F2F2F2F2F2F2F2F2F2F2F2F2F2F2F2F2F2FA
        FAFAFFFFFF0000FFFFFFFFFBFBFBFFFFFF0000FFFFFFFFD2D2D28B8B8BF2F2F2
        F2F2F2F2F2F2F2F2F2F2F2F2F2F2F2F2F2F2FAFAFAFFFFFFFBFBFBF6F6F6FBFB
        FBFFFFFFFAFAFA8D8D8D8B8B8BF2F2F2F2F2F2F2F2F2F2F2F2F2F2F2F2F2F2F2
        F2F2F3F3F3F4F4F4F6F6F6F7F7F7F5F5F5F3F3F3F2F2F28B8B8B8B8B8BF2F2F2
        F2F2F2F2F2F2F2F2F2F2F2F2F2F2F2F2F2F2F4F4F4F6F6F6F7F7F7F6F6F6F4F4
        F4F2F2F2F2F2F28B8B8B838383F2F2F2F2F2F2F2F2F2F2F2F2F2F2F2F2F2F2F4
        F4F4F5F5F5F7F7F7F6F6F6F4F4F4F2F2F2F2F2F2F2F2F283838399854CC29002
        C29002C29002C29002C39202C89B02D1AB02D7B603D5B203CCA202C59502C290
        02C29002C2900299854CCB9A04F5EBCDD5AE05CB9A04CB9A04CD9D04D2A705D8
        B305D9B505DAB806F6ECD0D5AF05F5EBCDD5AE05F5EBCDCB9A04CAC0A7B88500
        B88500B88500B88500B98700BC8C00BE9000BE8F00BB8A00B98600B88500B885
        00B88500B88500B0A68DFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
        FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF}
      Caption = '{Delete}'
      ShortCut = 8238
    end
    object fp_new: TMenuItem
      Bitmap.Data = {
        36030000424D3603000000000000360000002800000010000000100000000100
        18000000000000030000130B0000130B00000000000000000000FFFFFFFFFFFF
        FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
        FFFFFFFFFFFFFFFFFFFFCECECE7E7E7E7E7E7E7E7E7E7E7E7E7E7E7E7E7E7E7E
        7E7E7E7E7EFFFFFF00D01700D017FFFFFF7E7E7E7E7E7EAEAEAE7E7E7EE5E5E5
        E5E5E5E5E5E5E5E5E5E5E5E5E5E5E5E5E5E5E5E5E5FFFFFF00D32D00D32DFFFF
        FFE5E5E5E6E6E68080807E7E7EE5E5E5E5E5E5E5E5E5E5E5E5E5E5E5FFFFFFFF
        FFFFFFFFFFFFFFFF00D74400D744FFFFFFFFFFFFFFFFFFFFFFFF7E7E7EE5E5E5
        E5E5E5E5E5E5E5E5E5E5E5E5FFFFFF00DA5A00DA5A00DA5A00DA5A00DA5A00DA
        5A00DA5A00DA5AFFFFFF7E7E7EE5E5E5E5E5E5E5E5E5E5E5E5E5E5E5FFFFFF00
        DE7100DE7100DE7100DE7100DE7100DE7100DE7100DE71FFFFFF7E7E7EE5E5E5
        E5E5E5E5E5E5E5E5E5E5E5E5FFFFFFFFFFFFFFFFFFFFFFFF00E18800E188FFFF
        FFFFFFFFFFFFFFFFFFFF8B8B8BF2F2F2F2F2F2F2F2F2F2F2F2F2F2F2F2F2F2F2
        F2F2F2F2F2FFFFFF00E59E00E59EFFFFFFF6F6F6F5F5F59191918B8B8BF2F2F2
        F2F2F2F2F2F2F2F2F2F2F2F2F2F2F2F2F2F2F2F2F2FFFFFF00E8B400E8B4FFFF
        FFF5F5F5F3F3F38D8D8D8B8B8BF2F2F2F2F2F2F2F2F2F2F2F2F2F2F2F2F2F2F2
        F2F2F3F3F3FFFFFFFFFFFFFFFFFFFFFFFFF3F3F3F2F2F28B8B8B8B8B8BF2F2F2
        F2F2F2F2F2F2F2F2F2F2F2F2F2F2F2F2F2F2F4F4F4F6F6F6F7F7F7F6F6F6F4F4
        F4F2F2F2F2F2F28B8B8B838383F2F2F2F2F2F2F2F2F2F2F2F2F2F2F2F2F2F2F4
        F4F4F5F5F5F7F7F7F6F6F6F4F4F4F2F2F2F2F2F2F2F2F283838399854CC29002
        C29002C29002C29002C39202C89B02D1AB02D7B603D5B203CCA202C59502C290
        02C29002C2900299854CCB9A04F5EBCDD5AE05CB9A04CB9A04CD9D04D2A705D8
        B305D9B505DAB806F6ECD0D5AF05F5EBCDD5AE05F5EBCDCB9A04CAC0A7B88500
        B88500B88500B88500B98700BC8C00BE9000BE8F00BB8A00B98600B88500B885
        00B88500B88500B0A68DFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
        FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF}
      Caption = '{new_form}'
      ShortCut = 8306
    end
    object fp_clone: TMenuItem
      Bitmap.Data = {
        36030000424D3603000000000000360000002800000010000000100000000100
        18000000000000030000130B0000130B00000000000000000000FFFFFFFFFFFF
        FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
        FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFB9B9B989
        8989898989898989898989898989898989898989898989B9B9B9FFFFFFFFFFFF
        FFFFFFFFFFFFFFFFFFFFFFFF898989F0F0F0E4E4E4DADADAD1D1D1C9C9C9C7C7
        C7CACACACECECE898989FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF898989FB
        FBFBB3B3B3AFAFAFABABABA7A7A7A5A5A5A5A5A5D0D0D0898989CECECEACACAC
        ACACACACACACACACACA1A1A1898989FFFFFFFCFCFCF3F3F3E9E9E9DEDEDED7D7
        D7D4D4D4D3D3D3898989ACACACF4F4F4ECECECE5E5E5DFDFDFC1C1C1898989FF
        FFFFB8B8B8B8B8B8B4B4B4AFAFAFACACACAAAAAAD7D7D7898989ACACACFCFCFC
        BFBFBFBBBBBBB8B8B8C6C6C6898989FFFFFFFFFFFFFFFFFFFFFFFFF3F3F3E9E9
        E9E3E3E3DCDCDC898989ACACACFFFFFFFDFDFDF7F7F7F0F0F0CBCBCB898989FF
        FFFFB8B8B8B8B8B8B8B8B8FEFEFEB3B3B3B0B0B0E3E3E3898989ACACACFFFFFF
        C4C4C4C3C3C3C0C0C0D1D1D1898989FFFFFFB8B8B8B8B8B8B8B8B8FFFFFFFEFE
        FEF5F5F5EBEBEB898989ACACACFFFFFFFFFFFFFFFFFFFFFFFFD6D6D6898989FF
        FFFFB8B8B8B8B8B8B8B8B8FFFFFFB8B8B8B8B8B8F4F4F4898989ACACACFFFFFF
        C4C4C4C4C4C4C4C4C4DBDBDB898989FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
        FFFFFFFFFEFEFE898989ACACACFFFFFFC4C4C4C4C4C4C4C4C4DBDBDB898989FF
        FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF898989ACACACFFFFFF
        C4C4C4C4C4C4C4C4C4DBDBDBABABAB8989898989898989898989898989898989
        89898989898989B9B9B9ACACACFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFDBDBDBDB
        DBDBDBDBDBA1A1A1FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFACACACFFFFFF
        FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFACACACFFFFFFFFFFFFFFFF
        FFFFFFFFFFFFFFFFFFFFCECECEACACACACACACACACACACACACACACACACACACAC
        ACACACACACCECECEFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF}
      Caption = '{to_clone}'
    end
    object fp_rename: TMenuItem
      Bitmap.Data = {
        36030000424D3603000000000000360000002800000010000000100000000100
        18000000000000030000130B0000130B00000000000000000000FFFFFFFFFFFF
        FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
        FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
        FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
        FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
        FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
        FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFE8E8E8E8E8E8
        E8E8E8E8E8E8E8E8E8E8E8E8E8E8E8E8E8E86262629595956E6E6EE8E8E8E8E8
        E8E8E8E8E8E8E8E8E8E8C9C9C9FCFCFCFCFCFCFCFCFCFCFCFCFCFCFCFCFCFCFC
        FCFCFCFCFC626262FCFCFCFCFCFCFCFCFCFCFCFCFCFCFCE8E8E8C9C9C9FCFCFC
        C38F6CC3916DC3916EC2926FC29370C19371FCFCFC626262FCFCFCFCFCFCFCFC
        FCFCFCFCFCFCFCE8E8E8C9C9C9FCFCFCC38F6BD99B73D69B73D69D76D6A17BC2
        9370FCFCFC626262FCFCFCFCFCFCFCFCFCFCFCFCFCFCFCE8E8E8C9C9C9FCFCFC
        C38F6BD99872D89972D69B74D79F79C2926FFCFCFC626262FCFCFCFCFCFCFCFC
        FCFCFCFCFCFCFCE8E8E8C9C9C9FCFCFCC38F6BC4906CC38F6CC3906DC3916DC3
        916EFCFCFC626262FCFCFCFCFCFCFCFCFCFCFCFCFCFCFCE8E8E8C9C9C9FCFCFC
        FCFCFCFCFCFCFCFCFCFCFCFCFCFCFCFCFCFCFCFCFC6C6C6CFCFCFCFCFCFCFCFC
        FCFCFCFCFCFCFCE8E8E8C9C9C9C9C9C9C9C9C9C9C9C9C9C9C9C9C9C9C9C9C9C9
        C9C96B6B6B8E8E8E757575C9C9C9C9C9C9C9C9C9C9C9C9C9C9C9FFFFFFFFFFFF
        FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
        FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
        FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
        FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
        FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
        FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF}
      Caption = '{Rename}'
      ShortCut = 8305
    end
    object N74: TMenuItem
      Caption = '-'
    end
    object fp_left: TMenuItem
      Bitmap.Data = {
        36040000424D3604000000000000360000002800000010000000100000000100
        2000000000000004000000000000000000000000000000000000FF00FF00FF00
        FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00
        FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00
        FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00
        FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00
        FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00
        FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00
        FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF004545450045454500FF00
        FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00
        FF00FF00FF00FF00FF00FF00FF00FF00FF0045454500BA7E000045454500FF00
        FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00
        FF00FF00FF00FF00FF00FF00FF0045454500D9930000D993000045454500FF00
        FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00
        FF00FF00FF00FF00FF0045454500FF854800FF854800D9930000454545004545
        45004545450045454500FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00
        FF00FF00FF0045454500FF9D6C00FF9D6C00FF854800FF854800D9930000D993
        0000BA7E000045454500FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00
        FF0045454500FFB59000FF9D6C00FF9D6C00FF9D6C00FF854800FF854800D993
        0000D993000045454500FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00
        FF00FF00FF0045454500FFB59000FF9D6C00FF9D6C00FF9D6C00FF854800FF85
        4800D993000045454500FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00
        FF00FF00FF00FF00FF0045454500FFB59000FF9D6C00FF9D6C00454545004545
        45004545450045454500FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00
        FF00FF00FF00FF00FF00FF00FF0045454500FFB59000FF9D6C0045454500FF00
        FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00
        FF00FF00FF00FF00FF00FF00FF00FF00FF0045454500FFB5900045454500FF00
        FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00
        FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF004545450045454500FF00
        FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00
        FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00
        FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00
        FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00
        FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00}
      Caption = '{fp__toleft_move}'
      ShortCut = 8229
    end
    object fp_right: TMenuItem
      Bitmap.Data = {
        36040000424D3604000000000000360000002800000010000000100000000100
        2000000000000004000000000000000000000000000000000000FF00FF00FF00
        FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00
        FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00
        FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00
        FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00
        FF00FF00FF00FF00FF00FF00FF00FF00FF004545450045454500FF00FF00FF00
        FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00
        FF00FF00FF00FF00FF00FF00FF00FF00FF0045454500D993000045454500FF00
        FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00
        FF00FF00FF00FF00FF00FF00FF00FF00FF0045454500FF6D2400D99300004545
        4500FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00
        FF00FF00FF0045454500454545004545450045454500FF854800FF6D2400D993
        000045454500FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00
        FF00FF00FF0045454500FF9D6C00FF9D6C00FF9D6C00FF854800FF854800FF6D
        2400D993000045454500FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00
        FF00FF00FF0045454500FFB59000FF9D6C00FF9D6C00FF9D6C00FF854800FF85
        4800FF6D2400D993000045454500FF00FF00FF00FF00FF00FF00FF00FF00FF00
        FF00FF00FF0045454500FFB59000FFB59000FF9D6C00FF9D6C00FF9D6C00FF85
        4800FF85480045454500FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00
        FF00FF00FF0045454500454545004545450045454500FF9D6C00FF9D6C00FF9D
        6C0045454500FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00
        FF00FF00FF00FF00FF00FF00FF00FF00FF0045454500FFB59000FF9D6C004545
        4500FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00
        FF00FF00FF00FF00FF00FF00FF00FF00FF0045454500FFB5900045454500FF00
        FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00
        FF00FF00FF00FF00FF00FF00FF00FF00FF004545450045454500FF00FF00FF00
        FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00
        FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00
        FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00
        FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00
        FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00
        FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00
        FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00FF00}
      Caption = '{fp__toright_move}'
      ShortCut = 8231
    end
  end
end