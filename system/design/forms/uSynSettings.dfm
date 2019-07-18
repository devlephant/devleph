object fmEditorSettings: TfmEditorSettings
  Left = 0
  Top = 0
  BorderStyle = bsDialog
  BorderWidth = 9
  Caption = '{Editor settings}'
  ClientHeight = 294
  ClientWidth = 463
  Color = clBtnFace
  Font.Charset = DEFAULT_CHARSET
  Font.Color = clWindowText
  Font.Name = 'Segoe UI'
  Font.Size = 9
  Font.Quality = fqClearTypeNatural
  Font.Style = []
  OldCreateOrder = False
  Position = poScreenCenter
  DesignSize = (
    463
    234)
  PixelsPerInch = 96
  TextHeight = 13
  object Bevel1: TBevel
    Left = 0
    Top = 178
    Width = 463
    Height = 17
    Shape = bsTopLine
  end
  object Label1: TLabel
    Left = 8
    Top = 188
    Width = 70
    Height = 13
    Caption = '{Background:}'
  end
  object LabelSize: TLabel
    Left = 8
    Top = 210
    Width = 70
    Height = 13
    Caption = '{Size:}'
  end
  object LabelFont: TLabel
    Left = 8
    Top = 232
    Width = 70
    Height = 13
    Caption = '{Font:}'
  end
  object Label4: TLabel
    Left = 0
    Top = 0
    Width = 66
    Height = 13
    Caption = '{Category}'
    Font.Charset = DEFAULT_CHARSET
    Font.Color = clWindowText
    Font.Name = 'Segoe UI'
    Font.Style = [fsBold]
	Font.Size = 9
    ParentFont = False
  end
  object BitBtn1: TBitBtn
    Left = 356
    Top = 261
    Width = 91
    Height = 25
    Anchors = [akRight, akBottom]
    Caption = '{ok}'
    Font.Charset = DEFAULT_CHARSET
    Font.Color = clWindowText
    Font.Name = 'Segoe UI'
    Font.Style = [fsBold]
	Font.Size = 9
    ModalResult = 1
    ParentFont = False
    TabOrder = 0
    ExplicitTop = 214
  end
  object btn_cancel: TBitBtn
    Left = 259
    Top = 261
    Width = 91
    Height = 25
    Anchors = [akRight, akBottom]
    Caption = '{cancel}'
    ModalResult = 2
    TabOrder = 1
    ExplicitTop = 214
  end
  object List: TListBox
    Left = 0
    Top = 19
    Width = 129
    Height = 153
    Style = lbOwnerDrawFixed
    ItemHeight = 16
    Items.Strings = (
      '{Comment}'
      '{Identifier}'
      '{Key}'
      '{Number}'
      '{Space}'
      '{String}'
      '{Symbol}'
      '{Variable}')
    TabOrder = 2
  end
  object GroupBox: TGroupBox
    Left = 143
    Top = 43
    Width = 320
    Height = 129
    Caption = '{Attribute}'
    TabOrder = 3
    object Label2: TLabel
      Left = 16
      Top = 28
      Width = 70
      Height = 13
      Caption = '{Background:}'
    end
    object Label3: TLabel
      Left = 16
      Top = 55
      Width = 62
      Height = 13
      Caption = '{Font color:}'
    end
    object c_bold: TCheckBox
      Left = 16
      Top = 96
      Width = 94
      Height = 17
      Caption = '{Bold}'
      TabOrder = 0
    end
    object c_italic: TCheckBox
      Left = 116
      Top = 96
      Width = 89
      Height = 17
      Caption = '{Italic}'
      TabOrder = 1
    end
    object c_underline: TCheckBox
      Left = 211
      Top = 96
      Width = 95
      Height = 17
      Caption = '{Underline}'
      TabOrder = 2
    end
  end
  object c_config: TComboBox
    Left = 143
    Top = 16
    Width = 234
    Height = 21
    Style = csOwnerDrawFixed
    ItemHeight = 13
    TabOrder = 4
  end
  object btn_delcfg: TBitBtn
    Left = 383
    Top = 16
    Width = 37
    Height = 21
    Caption = '-'
    Font.Charset = DEFAULT_CHARSET
    Font.Color = clWindowText
    Font.Name = 'Segoe UI'
    Font.Style = [fsBold]
	Font.Size = 9
    ParentFont = False
    TabOrder = 5
  end
  object btn_addcfg: TBitBtn
    Left = 426
    Top = 16
    Width = 37
    Height = 21
    Caption = '+'
    Font.Charset = DEFAULT_CHARSET
    Font.Color = clWindowText
    Font.Name = 'Segoe UI'
	Font.Size = 9
    Font.Style = [fsBold]
    ParentFont = False
    TabOrder = 6
  end
end
