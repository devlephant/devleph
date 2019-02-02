object fmOptions: TfmOptions
  Left = 213
  Top = 150
  BorderStyle = bsDialog
  Caption = 'fmOptions'
  ClientHeight = 194
  ClientWidth = 402
  Color = clBtnFace
  Font.Charset = DEFAULT_CHARSET
  Font.Color = clWindowText
  Font.Height = -11
  Font.Name = 'Segoe UI'
  Font.Size = 8
  Font.Quality = fqClearTypeNatural
  Font.Style = []
  OldCreateOrder = False
  Position = poScreenCenter
  PixelsPerInch = 96
  TextHeight = 13
  object GroupBox1: TGroupBox
    Left = 8
    Top = 8
    Width = 385
    Height = 177
    Caption = '{Studio Options}'
    TabOrder = 0
    object GroupBox2: TGroupBox
      Left = 16
      Top = 24
      Width = 353
      Height = 105
      Caption = '{Size and move}'
      TabOrder = 0
      object Label1: TLabel
        Left = 16
        Top = 48
        Width = 50
        Height = 13
        Caption = '{Grid Size}'
      end
      object c_showgrid: TCheckBox
        Left = 16
        Top = 24
        Width = 321
        Height = 17
        Caption = '{Show grid}'
        Checked = True
        State = cbChecked
        TabOrder = 0
      end
      object e_gridsize: TEdit
        Left = 16
        Top = 64
        Width = 305
        Height = 21
        TabOrder = 1
        Text = '8'
      end
      object UpDown1: TUpDown
        Left = 321
        Top = 64
        Width = 16
        Height = 21
        Associate = e_gridsize
        Min = 1
        Max = 50
        Position = 8
        TabOrder = 2
      end
    end
    object BitBtn1: TBitBtn
      Left = 280
      Top = 136
      Width = 91
      Height = 25
      Caption = '{ok}'
      TabOrder = 1
    end
    object BitBtn2: TBitBtn
      Left = 184
      Top = 136
      Width = 91
      Height = 25
      Caption = '{cancel}'
      TabOrder = 2
    end
  end
end
