object fmBuildProgram: TfmBuildProgram
  Left = 396
  Top = 146
  AutoSize = True
  BorderStyle = bsDialog
  BorderWidth = 8
  Caption = '{Build program}'
  ClientHeight = 433
  ClientWidth = 417
  Color = clBtnFace
  Font.Charset = DEFAULT_CHARSET
  Font.Color = clWindowText
  Font.Quality = fqClearTypeNatural
  Font.Name = 'Segoe UI'
  Font.Size = 9
  Font.Style = []
  OldCreateOrder = False
  Position = poScreenCenter
  PixelsPerInch = 96
  TextHeight = 13
  object GroupBox1: TGroupBox
    Left = 0
    Top = 0
    Width = 417
    Height = 433
    Caption = '{Build Master}'
    Color = clBtnFace
    ParentColor = False
    TabOrder = 0
    object Label1: TLabel
      Left = 24
      Top = 32
      Width = 117
      Height = 13
      Caption = '{Path for your program}'
    end
    object btn_savesettings: TButton
      Left = 24
      Top = 387
      Width = 144
      Height = 32
      Caption = '{Save settings}'
      Font.Charset = DEFAULT_CHARSET
      Font.Color = clWhite
      Font.Name = 'Segoe UI'
	  Font.Size = 9
      Font.Style = []
    end
    object path: TEdit
      Left = 24
      Top = 48
      Width = 337
      Height = 21
      TabOrder = 0
      Alignment = taLeftJustify
      ColorOnEnter = clNone
      FontColorOnEnter = clNone
      TabOnEnter = False
      MarginLeft = 0
      MarginRight = 0
    end
    object btn_path: TBitBtn
      Left = 368
      Top = 48
      Width = 25
      Height = 21
      Caption = '...'
      TabOrder = 1
    end
    object c_attachphp: TCheckBox
      Left = 24
      Top = 80
      Width = 369
      Height = 17
      Caption = '{Attach PHP Engine to EXE File}'
      Enabled = False
      TabOrder = 2
    end
    object c_attachsoulengine: TCheckBox
      Left = 24
      Top = 104
      Width = 369
      Height = 17
      Caption = '{Attach framework PHPSoul Engine to EXE File}'
      Checked = True
      State = cbChecked
      TabOrder = 3
    end
    object GroupBox2: TGroupBox
      Left = 24
      Top = 160
      Width = 369
      Height = 209
      Caption = '{Other}'
      Color = clBtnFace
      ParentColor = False
      TabOrder = 4
      object Label2: TLabel
        Left = 16
        Top = 24
        Width = 75
        Height = 13
        Caption = '{UPX Exe pack}'
      end
      object Label3: TLabel
        Left = 16
        Top = 80
        Width = 85
        Height = 13
        Caption = '{Company Name}'
      end
      object Label4: TLabel
        Left = 16
        Top = 120
        Width = 45
        Height = 13
        Caption = '{Version}'
      end
      object im_icon: TImage
        Left = 289
        Top = 95
        Width = 65
        Height = 57
        Center = True
      end
      object Label5: TLabel
        Left = 291
        Top = 72
        Width = 31
        Height = 13
        Caption = '{Icon}'
      end
      object Shape1: TShape
        Left = 289
        Top = 95
        Width = 65
        Height = 57
        Brush.Style = bsClear
        Pen.Style = psDot
      end
      object btn_icon: TButton
        Left = 328
        Top = 72
        Width = 24
        Height = 16
        Caption = '...'
        Font.Charset = DEFAULT_CHARSET
        Font.Color = clWhite
        Font.Name = 'Segoe UI'
		Font.Size = 9
        Font.Style = []
        ParentFont = False
      end
      object c_upx: TComboBox
        Left = 16
        Top = 40
        Width = 337
        Height = 21
        Style = csOwnerDrawFixed
        ItemHeight = 13
        ItemIndex = 0
        TabOrder = 0
        Text = '{upx_None}'
        Items.Strings = (
          '{upx_None}'
          '{Fast}'
          '{Normal}'
          '{Maximum}'
          '{Super Max}')
      end
      object e_companyname: TEdit
        Left = 16
        Top = 96
        Width = 259
        Height = 21
        TabOrder = 1
        Text = ' '
        Alignment = taLeftJustify
        ColorOnEnter = clNone
        FontColorOnEnter = clNone
        TabOnEnter = False
        MarginLeft = 0
        MarginRight = 0
      end
      object e_version: TEdit
        Left = 16
        Top = 136
        Width = 259
        Height = 21
        TabOrder = 2
        Text = ' '
        Alignment = taLeftJustify
        ColorOnEnter = clNone
        FontColorOnEnter = clNone
        TabOnEnter = False
        MarginLeft = 0
        MarginRight = 0
      end
      object c_compress: TCheckBox
        Left = 20
        Top = 176
        Width = 333
        Height = 17
        Caption = '{Compress all binaries}'
        Font.Charset = DEFAULT_CHARSET
        Font.Color = clWindowText
        Font.Name = 'Segoe UI'
		Font.Size = 9
        Font.Style = [fsBold]
        ParentFont = False
        TabOrder = 3
      end
    end
    object BitBtn2: TBitBtn
      Left = 305
      Top = 384
      Width = 91
      Height = 33
      Cursor = crHandPoint
      Caption = '{Build}'
      Font.Charset = DEFAULT_CHARSET
      Font.Color = clWindowText
      Font.Name = 'Segoe UI'
	  Font.Size = 9
      Font.Style = [fsBold]
      ModalResult = 1
      ParentFont = False
      TabOrder = 5
    end
    object BitBtn3: TBitBtn
      Left = 208
      Top = 384
      Width = 91
      Height = 33
      Cursor = crHandPoint
      Caption = '{cancel}'
      ModalResult = 2
      TabOrder = 6
    end
    object c_attachdata: TCheckBox
      Left = 24
      Top = 136
      Width = 369
      Height = 17
      Caption = '{Attach resource data files}'
      Checked = True
      State = cbChecked
      TabOrder = 7
    end
  end
end
