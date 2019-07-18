object fmProjectOptions: TfmProjectOptions
  Left = 364
  Top = 173
  BorderStyle = bsDialog
  BorderWidth = 8
  Caption = '{Project Options}'
  ClientHeight = 383
  ClientWidth = 458
  Color = clBtnFace
  Font.Charset = DEFAULT_CHARSET
  Font.Color = clWindowText
  Font.Name = 'Segoe UI'
  Font.Size = 9
  Font.Quality = fqClearTypeNatural
  Font.Style = []
  OldCreateOrder = False
  Position = poScreenCenter
  PixelsPerInch = 96
  TextHeight = 13
  object StatusBar1: TStatusBar
    Left = 0
    Top = 364
    Width = 458
    Height = 19
    AutoHint = True
    Panels = <>
    SimplePanel = True
  end
  object PageControl1: TPageControl
    Left = 8
    Top = 8
    Width = 441
    Height = 313
    ActivePage = TabSheet1
    TabOrder = 1
    object TabSheet1: TTabSheet
      Caption = '{General}'
      ExplicitLeft = 0
      ExplicitTop = 0
      ExplicitWidth = 0
      ExplicitHeight = 0
      object Label1: TLabel
        Left = 16
        Top = 13
        Width = 83
        Height = 13
        Caption = '{Application title}'
      end
      object Label2: TLabel
        Left = 16
        Top = 59
        Width = 80
        Height = 13
        Caption = '{Program Name}'
      end
      object Label3: TLabel
        Left = 16
        Top = 104
        Width = 75
        Height = 13
        Caption = '{Program type}'
      end
      object e_apptitle: TEdit
        Left = 16
        Top = 32
        Width = 401
        Height = 21
        TabOrder = 0
      end
      object e_programname: TEdit
        Left = 16
        Top = 78
        Width = 401
        Height = 21
        TabOrder = 1
      end
      object c_programtype: TComboBox
        Left = 16
        Top = 121
        Width = 401
        Height = 21
        Style = csOwnerDrawFixed
        ItemHeight = 13
        ItemIndex = 0
        TabOrder = 2
        Text = '{Standart}'
        Items.Strings = (
          '{Standart}'
          '{Desktop widget}'
          '{Silent}')
      end
      object GroupBox2: TGroupBox
        Left = 16
        Top = 153
        Width = 401
        Height = 113
        Caption = '{Debug}'
        TabOrder = 3
        object c_debugmode: TCheckBox
          Left = 24
          Top = 24
          Width = 337
          Height = 17
          Hint = '{Debug_mode_handle}'
          Caption = '{Enabled Debug Mode}'
          Checked = True
          ParentShowHint = False
          ShowHint = True
          State = cbChecked
          TabOrder = 0
        end
        object c_ignorewarnings: TCheckBox
          Left = 24
          Top = 52
          Width = 337
          Height = 17
          Caption = '{Ignore all warnings}'
          TabOrder = 1
        end
        object c_ignoreerrors: TCheckBox
          Left = 24
          Top = 80
          Width = 337
          Height = 17
          Caption = '{Ignore all errors}'
          TabOrder = 2
        end
      end
    end
    object TabSheet2: TTabSheet
      Caption = '{PHP Modules}'
      ImageIndex = 1
      ExplicitLeft = 0
      ExplicitTop = 31
      ExplicitWidth = 0
      ExplicitHeight = 0
      DesignSize = (
        433
        285)
      object Label4: TLabel
        Left = 16
        Top = 13
        Width = 65
        Height = 13
        Caption = '{Modules list}'
      end
      object Label5: TLabel
        Left = 183
        Top = 14
        Width = 63
        Height = 13
        Caption = '{Description}'
      end
      object list: TCheckListBox
        Left = 17
        Top = 32
        Width = 152
        Height = 233
        ItemHeight = 25
        Items.Strings = (
          'php_curl.dll'
          'php_mbstring.dll')
        Style = lbOwnerDrawFixed
        TabOrder = 0
      end
      object Panel1: TPanel
        Left = 175
        Top = 32
        Width = 242
        Height = 233
        Anchors = [akLeft, akTop, akRight, akBottom]
        TabOrder = 1
		object mod_desc: TRichEdit
		Align = alClient
		ReadOnly = True
		ScrollBars = ssBoth
		end
      end
    end
	object TabSheet3: TTabSheet
      Caption = '{PHP.ini}'
      ImageIndex = 2
      ExplicitLeft = 0
      ExplicitTop = 31
      ExplicitWidth = 0
      ExplicitHeight = 0
      DesignSize = (
        433
        285)
		object phmemo: TSynEdit
		Align = alClient
		Ctl3D = False
		Font.Color = clWindowText
		Font.Name = 'Courier New'
		Font.Pitch = fpFixed
		Font.Style = []
		BorderStyle = bsNone
		Gutter.BorderStyle = gbsNone
		Gutter.Font.Color = clGray
		Gutter.Color = clWhite
		Gutter.Font.Size = 10
		Gutter.Font.Name = 'Courier New'
		Gutter.Font.Style = []
		Gutter.LeftOffset = 0
		Gutter.ShowLineNumbers = True
		Gutter.Width = 0
		Options = [eoAutoIndent, eoDragDropEditing, eoEnhanceEndKey, eoGroupUndo, eoHalfPageScroll, eoHideShowScrollbars, eoScrollPastEof, eoShowScrollHint, eoSmartTabDelete, eoTabIndent]
		ScrollHintFormat = shfTopToBottom
		SelectedColor.Foreground = 11990266
		TabWidth = 4
		WantTabs = True
		end
	end
  end
  object BitBtn1: TBitBtn
    Left = 358
    Top = 330
    Width = 91
    Height = 25
    Anchors = [akRight, akBottom]
    Caption = '{ok}'
    ModalResult = 1
    TabOrder = 2
  end
  object BitBtn2: TBitBtn
    Left = 261
    Top = 330
    Width = 91
    Height = 25
    Anchors = [akRight, akBottom]
    Caption = '{cancel}'
    ModalResult = 2
    TabOrder = 3
  end
end
