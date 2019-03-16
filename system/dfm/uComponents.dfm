object fmComponents: TfmComponents
  Left = 687
  Top = 131
  Width = 190
  Height = 546
  AutoScroll = True
  BorderIcons = [biSystemMenu]
  BorderStyle = bsSizeToolWin
  Caption = '{components}'
  Color = clGray
  DragKind = dkDock
  DragMode = dmAutomatic
  Font.Charset = DEFAULT_CHARSET
  Font.Color = clWindowText
  Font.Name = 'Segoe UI'
  Font.Size = 9
  Font.Quality = fqClearTypeNatural
  Font.Style = []
  OldCreateOrder = False
  Position = poDefault
  ScreenSnap = True
  PixelsPerInch = 96
  TextHeight = 13
  object list: TCategoryButtons
    Left = 0
    Top = 21
    Width = 182
    Height = 478
    Align = alClient
    ButtonFlow = cbfVertical
    ButtonHeight = 26
    ButtonWidth = 32
    Images = fmMain.MainImages24
    BackgroundGradientDirection = gdVertical
    Categories = <>
    RegularButtonColor = 17119285
    SelectedButtonColor = 12079702
    ShowHint = True
    TabOrder = 0
  end
  object c_type: TComboBox
    Left = 0
    Top = 0
    Width = 182
    Height = 22
    Align = alTop
    Style = csOwnerDrawFixed
    Color = clYellow
    ItemHeight = 22
    ItemIndex = 0
    TabOrder = 1
    Text = '{Icons + text}'
    Items.Strings = (
      '{Icons + text}'
      '{Small Icons}')
  end
  object c_search: TEdit
    Left = 0
    Top = 22
    Width = 182
    Height = 20
    Align = alTop
    Color = clWhite
    Text = ''
  end
end
