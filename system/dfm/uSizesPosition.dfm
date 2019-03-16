object fmSizesPosition: TfmSizesPosition
  Left = 258
  Top = 262
  BorderStyle = bsToolWindow
  Caption = '{Sizes and position}'
  ClientHeight = 184
  ClientWidth = 370
  Color = clBtnFace
  Font.Charset = DEFAULT_CHARSET
  Font.Color = clWindowText
  Font.Name = 'Segoe UI'
  Font.Size = 8
  Font.Quality = fqClearTypeNatural
  Font.Style = []
  OldCreateOrder = False
  PixelsPerInch = 96
  TextHeight = 13
  object GroupBox1: TGroupBox
    Left = 8
    Top = 8
    Width = 161
    Height = 137
    Caption = '{Anchors}'
    TabOrder = 0
    object c_left: TCheckBox
      Left = 16
      Top = 24
      Width = 129
      Height = 17
      Caption = '{to Left side}'
      TabOrder = 0
    end
    object c_top: TCheckBox
      Left = 16
      Top = 48
      Width = 129
      Height = 17
      Caption = '{to Top}'
      TabOrder = 1
    end
    object c_right: TCheckBox
      Left = 16
      Top = 80
      Width = 129
      Height = 17
      Caption = '{to Right side}'
      TabOrder = 2
    end
    object c_bottom: TCheckBox
      Left = 16
      Top = 104
      Width = 129
      Height = 17
      Caption = '{to Bottom}'
      TabOrder = 3
    end
  end
  object GroupBox2: TGroupBox
    Left = 176
    Top = 8
    Width = 185
    Height = 137
    Caption = '{Sizes && Position}'
    TabOrder = 1
    object Label1: TLabel
      Left = 16
      Top = 24
      Width = 10
      Height = 13
      Caption = 'X:'
      Font.Charset = DEFAULT_CHARSET
      Font.Color = clWindowText
      Font.Name = 'Segoe UI'
	  Font.Size = 8
      Font.Style = [fsBold]
      ParentFont = False
    end
    object Label2: TLabel
      Left = 16
      Top = 48
      Width = 10
      Height = 13
      Caption = 'Y:'
      Font.Charset = DEFAULT_CHARSET
      Font.Color = clWindowText
      Font.Name = 'Segoe UI'
	  Font.Size = 8
      Font.Style = [fsBold]
      ParentFont = False
    end
    object Label3: TLabel
      Left = 16
      Top = 80
      Width = 14
      Height = 13
      Caption = 'W:'
      Font.Charset = DEFAULT_CHARSET
      Font.Color = clWindowText
      Font.Name = 'Segoe UI'
	  Font.Size = 8
      Font.Style = [fsBold]
      ParentFont = False
    end
    object Label4: TLabel
      Left = 16
      Top = 104
      Width = 11
      Height = 13
      Caption = 'H:'
      Font.Charset = DEFAULT_CHARSET
      Font.Color = clWindowText
      Font.Name = 'Segoe UI'
	  Font.Size = 8
      Font.Style = [fsBold]
      ParentFont = False
    end
    object e_x: TEdit
      Left = 32
      Top = 24
      Width = 137
      Height = 21
      TabOrder = 0
      Text = '0'
    end
    object e_y: TEdit
      Left = 32
      Top = 48
      Width = 137
      Height = 21
      TabOrder = 1
      Text = '0'
    end
    object e_w: TEdit
      Left = 32
      Top = 80
      Width = 137
      Height = 21
      TabOrder = 2
      Text = '0'
    end
    object e_h: TEdit
      Left = 32
      Top = 104
      Width = 137
      Height = 21
      TabOrder = 3
      Text = '0'
    end
  end
  object BitBtn1: TBitBtn
    Left = 264
    Top = 152
    Width = 99
    Height = 25
    Caption = '{ok}'
    ModalResult = 1
    TabOrder = 2
  end
  object BitBtn2: TBitBtn
    Left = 160
    Top = 151
    Width = 99
    Height = 25
    Caption = '{cancel}'
    ModalResult = 2
    TabOrder = 3
  end
end
