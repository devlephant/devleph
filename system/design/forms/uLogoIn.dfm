object fmLogoin: TfmLogoin
  Left = 690
  Top = 353
  BorderStyle = bsNone
  Caption = 'fmLogoin'
  ClientHeight = 353
  ClientWidth = 690
  Color = clWhite
  TransparentColor = False
  TransparentColorValue = clNone
  Font.Charset = DEFAULT_CHARSET
  Font.Color = clWindowText
  Font.Height = -11
  Font.Name = 'Segoe UI'
  Font.Size = 9
  Font.Quality = fqClearTypeNatural
  Font.Style = []
  OldCreateOrder = False
  Position = poScreenCenter
  PixelsPerInch = 96
  TextHeight = 13
  object Label1: TLabel
    Left = 176
    Top = 8
    Width = 40
    Height = 24
    Caption = '%s %'
    Font.Charset = DEFAULT_CHARSET
    Font.Color = clWhite
    Font.Height = -19
    Font.Name = 'Segoe UI'
	Font.Size = 9
    Font.Style = [fsBold]
    ParentFont = False
    Transparent = True
  end
  object Panel1: TPanel
    Left = 0
    Top = 0
    Width = 690
    Height = 353
    AutoSize = True
    BevelOuter = bvNone
    BevelWidth = 4
    Color = 13948116
    Ctl3D = False
    ParentCtl3D = False
    TabOrder = 0
    object Image1: TImage
      Left = 0
      Top = 0
      Width = 690
      Height = 353
	end
    object Label9: TLabel
      Left = 6
      Top = 321
      Width = 175
      Height = 15
      Alignment = taRightJustify
      Caption = '... beta 4'
      Font.Charset = DEFAULT_CHARSET
      Font.Color = 0
      Font.Height = -11
      Font.Name = 'Segoe UI'
	  Font.Size = 9
      Font.Style = []
      ParentFont = False
      Transparent = True
      Visible = True
    end
    object Label10: TLabel
      Left = 16
      Top = 329
      Width = 111
      Height = 13
      Caption = 'Kashaproduct.at.ua'
      Font.Charset = DEFAULT_CHARSET
      Font.Color = clWhite
      Font.Height = -11
      Font.Name = 'Verdana'
      Font.Style = []
      ParentFont = False
      Visible = False
    end
    object loadbar: TShape
      Left = 0
      Top = 341
      Width = 691
      Height = 13
      Brush.Color = clWhite
      Pen.Style = psClear
    end
	object loadbar_desc: TLabel
      Left = 0
      Top = 341
      Width = 691
      Height = 13
	  AutoSize = False
      Transparent = True
	  Alignment = taCenter
	  Layout = tlCenter
	end
	object Label5: TLabel
      Left = 608
      Top = 341
      Width = 80
      Height = 13
	  AutoSize = False
      Font.Name = 'Segoe UI'
      Font.Size = 8
      Font.Style = [fsBold]
      ParentFont = False
      Transparent = True
	  Alignment = taRightJustify
	  Layout = tlCenter
    end
  end
end
