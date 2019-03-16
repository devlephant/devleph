object fmEasySelectDialog: TfmEasySelectDialog
  Left = 295
  Top = 183
  AutoSize = True
  BorderStyle = bsDialog
  BorderWidth = 8
  Caption = '{Easy Select Dialog}'
  ClientHeight = 329
  ClientWidth = 499
  Color = clBtnFace
  Font.Charset = DEFAULT_CHARSET
  Font.Color = clWindowText
  Font.Name = 'Segoe UI'
  Font.Style = []
  Font.Size = 9
  Font.Quality = fqClearTypeNatural
  OldCreateOrder = False
  Position = poScreenCenter
  PixelsPerInch = 96
  TextHeight = 13
  object l_status: TLabel
    Left = 0
    Top = 312
    Width = 3
    Height = 13
  end
  object pages: TPageControl
    Left = 0
    Top = 0
    Width = 497
    Height = 265
    ActivePage = tsVars
    TabOrder = 0
    object tsVars: TTabSheet
      Caption = '{Variables}'
      object Label1: TLabel
        Left = 8
        Top = 8
        Width = 85
        Height = 13
        Caption = '{Global Variables}'
      end
      object Label2: TLabel
        Left = 224
        Top = 8
        Width = 80
        Height = 13
        Caption = '{Local Variables}'
      end
      object globalVars: TListBox
        Left = 8
        Top = 24
        Width = 209
        Height = 201
        Style = lbOwnerDrawFixed
        Font.Charset = DEFAULT_CHARSET
        Font.Color = clMaroon
        Font.Name = 'Segoe UI'
		Font.Size = 9
        Font.Style = [fsBold]
        ItemHeight = 22
        Items.Strings = (
          '$APPLICATION'
          '$SCREEN'
          '$progDir'
          '$_c'
          '$self'
          '$x'
          '$y'
          '$key'
          '$canClose')
        ParentFont = False
        TabOrder = 0
      end
      object localVars: TListBox
        Left = 224
        Top = 24
        Width = 257
        Height = 201
        Style = lbOwnerDrawFixed
        Font.Charset = DEFAULT_CHARSET
        Font.Color = clGreen
        Font.Name = 'Segoe UI'
		Font.Size = 9
        Font.Style = [fsBold]
        ItemHeight = 22
        ParentFont = False
        TabOrder = 1
      end
    end
    object tsObjects: TTabSheet
      Caption = '{Objects}'
      ImageIndex = 4
      ExplicitLeft = 0
      ExplicitTop = 0
      ExplicitWidth = 0
      ExplicitHeight = 0
      object Label11: TLabel
        Left = 8
        Top = 8
        Width = 39
        Height = 13
        Caption = '{Forms}'
      end
      object objs_forms: TComboBox
        Left = 8
        Top = 24
        Width = 473
        Height = 22
        Style = csOwnerDrawFixed
        Font.Charset = DEFAULT_CHARSET
        Font.Color = clWindowText
        Font.Name = 'Segoe UI'
		Font.Size = 9
        Font.Style = []
        ItemHeight = 0
        ParentFont = False
        TabOrder = 0
      end
      object objs_list: TListView
        Left = 8
        Top = 56
        Width = 473
        Height = 169
        Cursor = crHandPoint
        Columns = <>
        MultiSelect = True
        ReadOnly = True
        TabOrder = 1
      end
    end
    object tsProps: TTabSheet
      Caption = '{Object Properties}'
      ImageIndex = 1
      ExplicitLeft = 0
      ExplicitTop = 0
      ExplicitWidth = 0
      ExplicitHeight = 0
      object Label3: TLabel
        Left = 8
        Top = 8
        Width = 39
        Height = 13
        Caption = '{Forms}'
      end
      object Label4: TLabel
        Left = 8
        Top = 48
        Width = 47
        Height = 13
        Caption = '{Objects}'
      end
      object Label5: TLabel
        Left = 240
        Top = 8
        Width = 75
        Height = 13
        Caption = '{Properties list}'
      end
      object lst_forms: TComboBox
        Left = 8
        Top = 24
        Width = 225
        Height = 22
        Style = csOwnerDrawFixed
        Font.Charset = DEFAULT_CHARSET
        Font.Color = clWindowText
        Font.Name = 'Segoe UI'
		Font.Size = 9
        Font.Style = []
        ItemHeight = 0
        ParentFont = False
        TabOrder = 0
      end
      object lst_props: TListBox
        Left = 240
        Top = 24
        Width = 241
        Height = 201
        Style = lbOwnerDrawFixed
        ItemHeight = 20
        TabOrder = 1
      end
      object lst_objects: TListView
        Left = 8
        Top = 64
        Width = 225
        Height = 161
        Cursor = crHandPoint
        Columns = <>
        MultiSelect = True
        ReadOnly = True
        TabOrder = 2
      end
    end
    object tsFuncs: TTabSheet
      Caption = '{Functions}'
      ImageIndex = 2
      ExplicitLeft = 0
      ExplicitTop = 0
      ExplicitWidth = 0
      ExplicitHeight = 0
      object Label6: TLabel
        Left = 8
        Top = 8
        Width = 62
        Height = 13
        Caption = '{Categories}'
        Enabled = False
      end
      object Label7: TLabel
        Left = 184
        Top = 8
        Width = 43
        Height = 13
        Caption = '{Search}'
      end
      object Label8: TLabel
        Left = 184
        Top = 56
        Width = 56
        Height = 13
        Caption = '{Functions}'
        Enabled = False
      end
      object ListBox5: TListBox
        Left = 8
        Top = 24
        Width = 169
        Height = 201
        Enabled = False
        ItemHeight = 13
        Items.Strings = (
          'comming soon...')
        TabOrder = 0
      end
      object ListBox6: TListBox
        Left = 184
        Top = 72
        Width = 297
        Height = 153
        Enabled = False
        ItemHeight = 13
        Items.Strings = (
          'comming soon...')
        TabOrder = 1
      end
      object e_search: TEdit
        Left = 184
        Top = 24
        Width = 265
        Height = 22
        Font.Charset = DEFAULT_CHARSET
        Font.Color = clWindowText
        Font.Name = 'Segoe UI'
		Font.Size = 9
        Font.Style = []
        ParentFont = False
        TabOrder = 2
      end
      object search_inweb: TBitBtn
        Left = 456
        Top = 23
        Width = 25
        Height = 24
        Cursor = crHandPoint
        Hint = '{Search description function in web}'
        ParentShowHint = False
        ShowHint = True
        TabOrder = 3
        Glyph.Data = {
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
      end
    end
    object tsFiles: TTabSheet
      Caption = '{Files && Directories}'
      ImageIndex = 3
      ExplicitLeft = 0
      ExplicitTop = 0
      ExplicitWidth = 0
      ExplicitHeight = 0
      object l_dir: TLabel
        Left = 168
        Top = 32
        Width = 12
        Height = 13
        Caption = '...'
      end
      object l_file: TLabel
        Left = 168
        Top = 64
        Width = 12
        Height = 13
        Caption = '...'
      end
      object Label9: TLabel
        Left = 8
        Top = 8
        Width = 49
        Height = 13
        Caption = '{Global}'
        Font.Charset = DEFAULT_CHARSET
        Font.Color = clWindowText
        Font.Name = 'Segoe UI'
		Font.Size = 9
        Font.Style = [fsBold]
        ParentFont = False
      end
      object Label10: TLabel
        Left = 8
        Top = 96
        Width = 43
        Height = 13
        Caption = '{Local}'
        Font.Charset = DEFAULT_CHARSET
        Font.Color = clWindowText
        Font.Name = 'Segoe UI'
		Font.Size = 9
        Font.Style = [fsBold]
        ParentFont = False
      end
      object l_filelocal: TLabel
        Left = 168
        Top = 152
        Width = 12
        Height = 13
        Caption = '...'
      end
      object l_dirlocal: TLabel
        Left = 168
        Top = 120
        Width = 12
        Height = 13
        Caption = '...'
      end
      object fd_browsedir: TBitBtn
        Left = 16
        Top = 24
        Width = 145
        Height = 25
        Caption = '{Browse directories}'
        TabOrder = 0
      end
      object fd_browsefiles: TBitBtn
        Left = 16
        Top = 56
        Width = 145
        Height = 25
        Caption = '{Browse files}'
        TabOrder = 1
      end
      object fd_browsedirlocal: TBitBtn
        Left = 16
        Top = 112
        Width = 145
        Height = 25
        Caption = '{Browse directories}'
        TabOrder = 2
      end
      object fd_browsefileslocal: TBitBtn
        Left = 16
        Top = 144
        Width = 145
        Height = 25
        Caption = '{Browse files}'
        TabOrder = 3
      end
    end
    object tsConsts: TTabSheet
      Caption = '{Constants}'
      ImageIndex = 5
      ExplicitLeft = 0
      ExplicitTop = 0
      ExplicitWidth = 0
      ExplicitHeight = 0
      object Label14: TLabel
        Left = 200
        Top = 8
        Width = 70
        Height = 13
        Caption = '{Constant list}'
      end
      object GroupBox1: TGroupBox
        Left = 8
        Top = 8
        Width = 185
        Height = 121
        Caption = '{Boolean}'
        TabOrder = 0
        object Label12: TLabel
          Left = 16
          Top = 24
          Width = 27
          Height = 13
          Caption = '{Yes}'
        end
        object Label13: TLabel
          Left = 16
          Top = 64
          Width = 23
          Height = 13
          Caption = '{No}'
        end
        object e_true: TEdit
          Left = 16
          Top = 40
          Width = 153
          Height = 21
          Cursor = crHandPoint
          Font.Charset = DEFAULT_CHARSET
          Font.Color = clGreen
          Font.Name = 'Segoe UI'
		  Font.Size = 9
          Font.Style = [fsBold]
          ParentFont = False
          ReadOnly = True
          TabOrder = 0
          Text = 'true'
        end
        object e_false: TEdit
          Left = 16
          Top = 80
          Width = 153
          Height = 21
          Cursor = crHandPoint
          Font.Charset = DEFAULT_CHARSET
          Font.Color = clMaroon
          Font.Name = 'Segoe UI'
		  Font.Size = 9
          Font.Style = [fsBold]
          ParentFont = False
          ReadOnly = True
          TabOrder = 1
          Text = 'false'
        end
      end
      object gb_color: TGroupBox
        Left = 8
        Top = 136
        Width = 185
        Height = 89
        Caption = '{Color}'
        TabOrder = 1
      end
      object lst_constants: TListBox
        Left = 200
        Top = 24
        Width = 281
        Height = 201
        Style = lbOwnerDrawFixed
        Font.Charset = DEFAULT_CHARSET
        Font.Color = clMaroon
        Font.Name = 'Segoe UI'
        Font.Style = []
		Font.Size = 9
        ItemHeight = 20
        Items.Strings = (
          'DOC_ROOT'
          'DRIVE_CHAR'
          'DIRECTORY_SEPARATOR'
          'EXE_NAME'
          'APP_ID'
          'APP_MD5')
        ParentFont = False
        TabOrder = 2
      end
    end
  end
  object line_: TEdit
    Left = 0
    Top = 272
    Width = 457
    Height = 21
    TabOrder = 1
  end
  object BitBtn3: TBitBtn
    Left = 392
    Top = 304
    Width = 107
    Height = 25
    Caption = '{ok}'
    ModalResult = 1
    TabOrder = 2
  end
  object BitBtn4: TBitBtn
    Left = 278
    Top = 304
    Width = 107
    Height = 25
    Caption = '{cancel}'
    ModalResult = 2
    TabOrder = 3
  end
  object line: TSynEdit
    Left = 0
    Top = 272
    Width = 497
    Height = 25
    Font.Charset = DEFAULT_CHARSET
    Font.Color = clWindowText
    Font.Name = 'Courier New'
    Font.Style = []
    TabOrder = 4
    Gutter.Font.Charset = DEFAULT_CHARSET
    Gutter.Font.Color = clWindowText
    Gutter.Font.Height = -11
    Gutter.Font.Name = 'Courier New'
    Gutter.Font.Style = []
    Gutter.LeftOffset = 0
    Gutter.Width = 0
    Gutter.GradientEndColor = clWhite
    Gutter.GradientSteps = 2
    Highlighter = SynPHPSyn
    ScrollBars = ssNone
  end
  object c_kav: TCheckBox
    Left = 0
    Top = 312
    Width = 121
    Height = 17
    Caption = '{Quotes}'
    TabOrder = 5
  end
  object SynPHPSyn: TSynPHPSyn
    CommentAttri.Foreground = clSilver
    NumberAttri.Foreground = clBlue
    StringAttri.Foreground = 16512
    SymbolAttri.Foreground = 4194304
    VariableAttri.Foreground = clGreen
    VariableAttri.Style = [fsBold]
    Left = 600
    Top = 32
  end
  object OpenDialog1: TOpenDialog
    Options = [ofHideReadOnly, ofAllowMultiSelect, ofEnableSizing]
    Left = 268
    Top = 64
  end
end
