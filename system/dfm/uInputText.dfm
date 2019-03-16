object edt_inputText: Tedt_inputText
  Left = 291
  Top = 218
  BorderIcons = [biSystemMenu]
  BorderStyle = bsToolWindow
  Caption = '{Input text}'
  ClientHeight = 87
  ClientWidth = 299
  Color = clBtnFace
  Font.Charset = DEFAULT_CHARSET
  Font.Color = clWindowText
  Font.Name = 'Segoe UI'
  Font.Size = 8
  Font.Quality = fqClearTypeNatural
  Font.Style = []
  OldCreateOrder = False
  DesignSize = (
    299
    87)
  PixelsPerInch = 96
  TextHeight = 13
  object e_label: TLabel
    Left = 8
    Top = 8
    Width = 32
    Height = 13
    Caption = '{Text}'
  end
  object btn_ok: TBitBtn
    Left = 216
    Top = 54
    Width = 75
    Height = 25
    Anchors = [akRight, akBottom]
    Caption = '{ok}'
    ModalResult = 1
    TabOrder = 0
  end
  object btn_cancel: TBitBtn
    Left = 136
    Top = 54
    Width = 75
    Height = 25
    Anchors = [akRight, akBottom]
    Caption = '{cancel}'
    ModalResult = 2
    TabOrder = 1
  end
  object text: TEdit
    Left = 8
    Top = 24
    Width = 282
    Height = 21
    Font.Name = 'Segoe UI'
	Font.Size = 8
    Font.Style = [fsBold]
    ParentFont = False
	Color = clWhite
    Anchors = [akLeft, akTop, akRight]
    TabOrder = 2
  end
end
