object fmPHPEditor: TfmPHPEditor
  Left = 221
  Top = 186
  Autosize = False
  BorderStyle = bsSizeable
  Caption = '{php_script_editor}'
  ClientHeight = 597
  ClientWidth = 1011
  Constraints.MinWidth = 450
  Constraints.MinHeight = 350
  Color = clWhite
  Font.Color = clWindowText
  Font.Name = 'Segoe UI'
  Font.Size = 9
  Font.Quality = fqClearTypeNatural
  Font.Style = []
  Menu = MainMenu
  OldCreateOrder = False
  Position = poDesigned
  Visible = False
  PixelsPerInch = 96
  TextHeight = 13
  object eventTabs: TTabControl
    Left = 0
	Top = 0
	Width = 1011
	Height = 24
	Align = alTop
	Tabs.Strings = (
	  'page1'
	  'page2')
	TabIndex = 0
  end
  object shapeshape: TShape
    Left = 0
    Top = 0
	Width = 4011
	Height = 60
	Brush.Color = clWhite
	Pen.Color = clWhite
	Align = alNone
  end
  object panelCode: TPanel
    Left = 0
    Top = 54
    Width = 1011
    Height = 516
    Align = alClient
    BevelOuter = bvNone
    BevelInner = bvNone
    BorderStyle = bsNone
    BorderWidth = 0
    Caption = 'panelCode'
    TabOrder = 0
    ExplicitWidth = 719
    ExplicitHeight = 482
    object TBevel
      Left = 5
      Top = 30
      Width = 1001
      Height = 5
      Shape = bsBottomLine
      Align = alTop
    end
	object memo: TSynEdit
      Left = 5
      Top = 33
      Width = 932
      Height = 523
      Align = alClient
	  FontSmoothing = fsmClearType
      Ctl3D = True
      ParentCtl3D = False
      Font.Color = clWindowText
      Font.Height = -13
      Font.Name = 'Courier New'
      Font.Pitch = fpFixed
      Font.Style = []
      PopupMenu = Popup
      TabOrder = 0
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
      Highlighter = SynPHPSyn
      Options = [eoAutoIndent, eoDragDropEditing, eoEnhanceEndKey, eoGroupUndo, eoHalfPageScroll, eoHideShowScrollbars, eoScrollPastEof, eoShowScrollHint, eoSmartTabDelete, eoTabIndent]
      ScrollHintFormat = shfTopToBottom
      SelectedColor.Foreground = 11990266
      TabWidth = 4
	  WantTabs = True
      ExplicitTop = 25
      ExplicitWidth = 595
      ExplicitHeight = 446
    end
    object errPanel: TPanel
      Left = 5
      Top = 511
      Width = 1001
      Height = 0
      Align = alBottom
      BevelOuter = bvNone
      TabOrder = 1
      ExplicitTop = 477
      ExplicitWidth = 709
      DesignSize = (
        1001
        0)
      object Label2: TLabel
        Left = 1
        Top = 1
        Width = 131
        Height = 13
        Caption = '{Errors and Warnings:}'
        Font.Charset = DEFAULT_CHARSET
        Font.Color = clWindowText
        Font.Name = 'Segoe UI'
		Font.Size = 9
        Font.Style = [fsBold]
        ParentFont = False
      end
      object hide_err_list: TSpeedButton
        Left = 568
        Top = 0
        Width = 23
        Height = 16
        Cursor = crHandPoint
        Hint = '{hide}'
        Anchors = [akTop, akRight]
        Caption = '-'
        Font.Charset = DEFAULT_CHARSET
        Font.Color = clWindowText
        Font.Name = 'Segoe UI'
		Font.Size = 9
        Font.Style = [fsBold]
        ParentFont = False
        ParentShowHint = False
        ShowHint = True
		Transparent = False
        ExplicitLeft = 571
      end
      object err_list: TListBox
        Left = 1
        Top = 16
        Width = 589
        Height = 0
        Anchors = [akLeft, akTop, akRight, akBottom]
        ItemHeight = 13
        TabOrder = 0
      end
    end
    object p_search: TPanel
      Left = 5
      Top = 5
      Width = 1001
      Height = 25
      Align = alTop
      BevelOuter = bvNone
      TabOrder = 0
      ParentBackground = False
      Color = clWhite
      Visible = False
      ExplicitWidth = 709
      DesignSize = (
        1001
        25)
      object Label1: TLabel
        Left = 8
        Top = 3
        Width = 44
        Height = 24
        AutoSize = False
        Caption = '{Find:}'
      end
      object f_next: TSpeedButton
        Left = 626
        Top = 1
        Width = 105
        Height = 22
        Anchors = [akTop, akRight]
        Caption = '{Next}'
        Flat = True
        Glyph.Data = {
          36030000424D3603000000000000360000002800000010000000100000000100
          18000000000000030000C40E0000C40E00000000000000000000FFFFFFFBFBFB
          E7E7E7D1D1D1CCCCCCB8A28CAD7135B8A28CD0D0D0D8D8D8E0E0E0EAEAEAF4F4
          F4FBFBFBFFFFFFFFFFFFFFFFFFFDFDFDF3F3F3E8E8E8C0AA93B07437FFBC1EB0
          7437C2AB95EBEBEBEFEFEFF4F4F4F9F9F9FDFDFDFFFFFFFFFFFFFFFFFFFFFFFF
          FFFFFFDDC2A7B4783AFFC02AFFB201FFBE24B4783ADDC2A7FFFFFFFFFFFFFFFF
          FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFE0C5A8B97D3DFBC23EF8AE09F8AE09F8
          AE09FABD30B97D3DE0C5A8FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFE2C7AA
          BD8141F6C453F3B634F1AE25EEA717F0AD23F2B32DF4BB3FBD8141E2C7AAFFFF
          FFFFFFFFFFFFFFFFFFFFFFFFFFD1A473C38745C38745C38745E9B143E29F26E9
          AE3FC38745C38745C38745D1A473FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
          FFFFFFFFFFFFC88C49E3AE52D89836E2AC4FC88C49FFFFFFFFFFFFFFFFFFFFFF
          FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFCD924EDFAD5ECF9241DD
          AA5BCD924EFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
          FFFFFFFFFFFFD49852E5B569CD9145DCAB5FD49852FDFAF7FFFFFFFFFFFFFFFF
          FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFD99E58F5C77BE9AD61E7
          B266DFA860EDD1AFFDFBF8FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
          FFFFFFFFFFFFE0A763F5C87DEFB367EFB569F3C579E5AE64DFA35BDEA25ADEA2
          5AE7BA84FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFEABD85F4C77CF3BD71F3
          BB6FF3BC70F6C67AF8CC80F8CC80FAD387E3A75DFFFFFFFFFFFFFFFFFFFFFFFF
          FFFFFFFFFFFFF7E4CCEBB469FAD286FAC97DF9C87CF9C87CF9C87CF9C87CFCD4
          88E7AB61FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFEF4D4ABEEB76BF9
          D084FDD88CFEDA8EFEDA8EFEDA8EFFDE92EBAF64FFFFFFFFFFFFFFFFFFFFFFFF
          FFFFFFFFFFFFFFFFFFFFFFFEF9E6CEF2C48CEEB66EEEB268EDB166EDB166EDB1
          66F2C58CFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
          FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF}
        ExplicitLeft = 628
		Transparent = False
      end
      object f_prev: TSpeedButton
        Left = 736
        Top = 1
        Width = 105
        Height = 22
        Anchors = [akTop, akRight]
        Caption = '{Previous}'
        Flat = True
        Glyph.Data = {
          36030000424D3603000000000000360000002800000010000000100000000100
          18000000000000030000C40E0000C40E00000000000000000000FFFFFFF5F5F5
          E7E7E7E5E5E5E5E5E5E5E5E5E5E5E5E5E5E5E5E5E5E5E5E5E8E8E8EDEDEDF2F2
          F2F8F8F8FCFCFCFFFFFFFFFFFFECECECA4805CAD7135AD7135AD7135AD7237B0
          773FB78B5EBEB0A1D1D1D1DBDBDBE6E6E6F1F1F1FAFAFAFFFFFFFFFFFFFFFFFF
          B07437FFBC1DFFB811FFB70FFFB70EF9B211E5A11DBB7E31D4B493FEFEFEFFFF
          FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFB4783AFEBA1AFEB102FEB102FEB102FE
          B102FEB204F7B015C08236E7D4C0FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
          B97D3DF9BD37F8B728F8B625F7B11BF5AC0FF5AB0EF5AC0FE3A22CCA9D6DFFFF
          FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFCDA071BD8141BD8141BE8341C98E42E8
          AB39E9A41FE9A31EE9AA32C1884CFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
          FFFFFFFFFFFFFFFFFFFCFAF7E2C6A6CC9149E0A43DDC9A30E2A742C48847FFFF
          FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFCFAF7C9
          8D4ADCA754D1943EDBA552C88C49FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
          FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFCD924EDBA85CCC9044D9A65ACD924EFFFF
          FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFD4
          9852E2B165D09448DCAA5ED49852FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
          FFFFFFFFFFFFE3B681D99D56D99D56D99D56F4C579EEB266F4C377D99D56D99D
          56D99D56E3B681FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF0D5B4DEA25AFDDD91F5
          C77BF2BD71EFB367F2BC70F5C579FAD68ADEA25AF0D5B4FFFFFFFFFFFFFFFFFF
          FFFFFFFFFFFFFFFFFFF2D7B6E3A75DFEE094F3BB6FF3BB6FF3BB6FFDDC90E3A7
          5DF2D7B6FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF4D9B8E7
          AB61FFE397F9C87CFFE195E7AB61F4D9B8FFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
          FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF6DBB9EBAF64FFE498EBAF64F6DBB9FFFF
          FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
          FFFFF7DCBAEDB166F7DCBAFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF}
        ExplicitLeft = 748
		Transparent = False
      end
      object f_text: TEdit
        Left = 58
        Top = 1
        Width = 561
        Height = 21
        Anchors = [akLeft, akTop, akRight]
        TabOrder = 0
        ExplicitWidth = 269
      end
      object c_register: TCheckBox
        Left = 856
        Top = 3
        Width = 129
        Height = 17
        Anchors = [akTop, akRight]
        Caption = '{Sensitive}'
        TabOrder = 1
        ExplicitLeft = 564
      end
    end
  end
  object Panel2: TPanel
    Left = 0
    Top = 27
    Width = 1011
    Height = 27
    Align = alTop
    BevelOuter = bvNone
    TabOrder = 1
    ExplicitWidth = 719
    object btn_new: TSpeedButton
      Left = 5
      Top = 2
      Width = 25
      Height = 25
      Hint = '{New}'
      Flat = True
      Glyph.Data = {
        36030000424D3603000000000000360000002800000010000000100000000100
        18000000000000030000C40E0000C40E00000000000000000000FFFFFFB1B2B2
        9FA0A09FA0A09FA0A09FA0A09FA0A09FA0A09FA0A09FA0A09FA0A09FA0A09FA0
        A09FA0A0B1B2B2FFFFFFFFFFFF9FA0A0D6D6D6C9C9C9C9C9C9C9C9C9C9C9C9BA
        BABABABABAC9C9C9C9C9C9C9C9C9C9C9C9D6D6D69FA0A0FFFFFFFFFFFF9FA0A0
        DBDBDBCECECECECECECECECECECECEC2C2C2C2C2C2CECECECECECECECECECECE
        CEDBDBDB9FA0A0FFFFFFFFFFFF9FA0A0E0E0E0E0E0E0D2D2D2D2D2D2D2D2D2C8
        C9C9C8C9C9D2D2D2D2D2D2D2D2D2E0E0E0E0E0E09FA0A0FFFFFFFFFFFF9FA0A0
        E6E6E6E6E6E6D8D8D8D8D8D8D8D8D8D0D1D1D0D1D1D8D8D8D8D8D8D8D8D8E6E6
        E6E6E6E69FA0A0FFFFFFFFFFFF9FA0A0EBEBEBEBEBEBE0E0E0E0E0E0E0E0E0DA
        DADADADADAE0E0E0E0E0E0E0E0E0EBEBEBEBEBEB9FA0A0FFFFFFFFFFFF9FA0A0
        F0F0F0F0F0F0F0F0F0E9E9E9E9E9E9E4E4E4E4E4E4E9E9E9E9E9E9F0F0F0F0F0
        F0F0F0F09FA0A0FFFFFFFFFFFF9FA0A0F5F5F5F5F5F5F5F5F5F0F0F0F0F0F0EC
        ECECECECECF0F0F0F0F0F0F5F5F5F5F5F5F5F5F59FA0A0FFFFFFFFFFFF9FA0A0
        F8F8F8F8F8F8F8F8F8F6F6F6F6F6F6F4F4F4F4F4F4F6F6F6F6F6F6F8F8F8F8F8
        F8F8F8F89FA0A0FFFFFFFFFFFFBCBDBDFAFAFAFAFAFAFAFAFAFAFAFAFAFAFAF9
        F9F9F9F9F9FAFAFAFAFAFAFAFAFAFAFAFAFAFAFABCBDBDFFFFFFFFFFFFBCBDBD
        FAFAFAFAFAFAFAFAFAFAFAFAFAFAFAFAFAFAFAFAFAF9F9F9F7F7F7F4F4F4F2F2
        F2F4F4F4BABBBBFFFFFFFFFFFFBCBDBDFAFAFAFAFAFAFAFAFAFAFAFAFAFAFAFA
        FAFAFAFAFAF7F7F7F0F0F0E8E8E8E6E6E6EAEAEAB7B8B8FFFFFFFFFFFFBCBDBD
        FAFAFAFAFAFAFAFAFAFAFAFAFAFAFAFAFAFAFAFAFAF4F4F4E8E8E8FFFFFFFFFF
        FFFFFFFFB4B5B5FFFFFFFFFFFFBCBDBDFAFAFAFAFAFAFAFAFAFAFAFAFAFAFAFA
        FAFAFAFAFAF2F2F2E6E6E6FFFFFFFFFFFFC2C2C2CECECEFFFFFFFFFFFFBCBDBD
        FAFAFAFAFAFAFAFAFAFAFAFAFAFAFAFAFAFAFAFAFAF4F4F4EAEAEAFFFFFFC2C2
        C2C9C9C9F9F9F9FFFFFFFFFFFFB1B2B2BCBDBDBCBDBDBCBDBDBCBDBDBCBDBDBC
        BDBDBCBDBDBABBBBB7B8B8B4B5B5CECECEF9F9F9FDFDFDFFFFFF}
      ParentShowHint = False
      ShowHint = True
	  Transparent = False
    end
    object btn_open: TSpeedButton
      Left = 34
      Top = 2
      Width = 25
      Height = 25
      Hint = '{Open file}'
      Flat = True
      Glyph.Data = {
        36030000424D3603000000000000360000002800000010000000100000000100
        18000000000000030000C40E0000C40E00000000000000000000FFFFFFFFFFFF
        FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
        FFFFFFFFFFFFFFFFFFFFF9F9F9E9E9E9E5E5E5E5E5E5E5E5E5E5E5E5E5E5E5E5
        E5E5E5E5E5E5E5E5E5E5E5E5E5E5E5E5E5E8E8E8F0F0F0F7F7F76E96AA4287AA
        4287AA4287AA4287AA4287AA4287AA4287AA4287AA4287AA4287AA4287AA4287
        AA6791A6E1E1E1EFEFEF4F96B96AB7DA82CCED82CCED82CCED82CCED82CCED82
        CCED82CCED82CCED82CCED82CCED83CDEE5DA5C8BFD1DAFFFFFF5DA4C856AACE
        80CBEB7EC9E97EC9E97EC9E97EC9E97EC9E97EC9E97EC9E97EC9E97EC9E97EC9
        E970BBDC91BDD3FFFFFF62A9CD44A1CB8AD3EF83CDEB83CDEB83CDEB83CDEB83
        CDEB83CDEB83CDEB83CDEB83CDEB83CDEB87D0EC6CACCDFEFEFF66ADD152B0D7
        85D2EC89D2EE89D2EE89D2EE89D2EE89D2EE89D2EE89D2EE89D2EE89D2EE89D2
        EE90D8F16CB4D6E2F0F66AB1D474CAE874CAE890D8F28FD7F18FD7F18FD7F18F
        D7F18FD7F18FD7F18FD7F18FD7F18FD7F191D8F279C4E3B9DCED6DB4D78FDDF4
        63C0E5A8EEFAA8EEFAA8EEFAA8EEFAA8EEFAA8EEFAA8EEFAA8EEFAA8EEFAA8EE
        FAA8EEFA96DDF18EC8E571B8DAA7ECFC64C2E94FB5E24DB4E24CB3E14BB2E049
        B1DF48B0DF47AEDE45ADDD44ACDD46AEDF389FD37EC2E59ED1EB74BADDABF0FE
        A4E9FCA2E7FB9FE5FA9CE3F89AE1F797DEF694DCF491D9F38ED7F18BD4F090D8
        F374BADDFFFFFFFFFFFF77BDE0ADF1FFA6EBFDA4E9FCA2E7FB9FE5FA9CE3F89A
        E1F797DEF694DCF491D9F38ED7F193DAF477BDE0FFFFFFFFFFFF7ABFE2B0F4FF
        ADF1FFABF0FEA9EEFDA7ECFCA5EAFBA2E8FAA0E6F99DE3F89AE1F798DFF699E0
        F77ABFE2FFFFFFFFFFFF9CD0EA7CC1E47CC1E47CC1E47CC1E47CC1E47CC1E4FE
        FEFDF5F5EEEBEBDDFEC941F4B62E7CC1E49CD0EAFFFFFFFFFFFFFFFFFFFFFFFF
        FFFFFFFFFFFFFFFFFFFFFFFFD1EAF67EC3E57EC3E57EC3E57EC3E57EC3E5D1EA
        F6FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
        FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF}
      ParentShowHint = False
      ShowHint = True
	  Transparent = False
    end
    object btn_save: TSpeedButton
      Left = 63
      Top = 2
      Width = 25
      Height = 25
      Hint = '{Save as...}'
      Flat = True
      Glyph.Data = {
        36030000424D3603000000000000360000002800000010000000100000000100
        18000000000000030000C40E0000C40E00000000000000000000C1761BC27519
        BD6B13B96504B96504B96504BA6504BA6504BA6504BA6504BA6504BA6504BA65
        04BC690AB96A15C3791FD5933DEFB736CDC6C0E9F8FFDBE5F6DBE8F8DBE8F8DB
        E8F9DBE8F8DAE7F8DBE7F8D8E4F5E9F6FFCDC6C0EAA714C0761DCD9551E8AE3C
        DCD7D4ECE8E9ADA0A2A79B9E9E939594898C8A818583797C7B7276685F64ECE8
        E9DCD7D4E59E20C77B25D09653EAB447DCD7D4EFF0EFDFDEDCE1E0DFE0DFDEDF
        E0DDE0DFDDDFDEDDDFE0DEDBD9D9EDEDEDDCD7D4E7A62BC9802BD49B58EBB950
        DCD7D4ECE8E9A99D9FA4999E9A919492888B897F8582797C7A7177655C62ECE8
        E9DCD7D4E8AC37CC8531D69E5BEDBD5ADCD7D4FFFFFFFFFEFEFFFFFFFFFFFFFF
        FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFDCD7D4EAB340D08B34D9A45EF0C263
        DCD7D4ECE8E9A99D9FA4999E9A919492888B897F8582797C7A7177655C62ECE8
        E9DCD7D4EDB749D2903AD8A35CF0C66DDCD7D4FFFFFFFFFFFFFFFFFFFFFFFFFF
        FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFDCD7D4EEBD54D7963EDEAC69F9D281
        C1975C9A7B6095775E97795D97795D97795D97795D97795C97795C95775E9A7A
        5EC19A64F7CA6BD99B44DDAB67F6D58BFFD056C0A887C8C5C9CEC6BFCDC6C0CD
        C6C0CDC6BFD6D0CAD6D3D0CFCED4C0A888FFD25DF3CC75DCA148DCA966F6D993
        FBC85DC2B4A2D7DEEBDDDDDDDCDDDEDCDBDDE7E8EAC8BAA7A29692C2B4A2C6BC
        A9FBCB63F3D07EE0A74CE5B973F6DA97FBCC62C8BAA7DDE0E9E1DFDDE0DFDEDF
        DDDCEFF3F99F886FE5AF479E9189C7BDB2FDCF6AF5D484E3AC51E9BC75F8DD9E
        FDCF69CEC0AFE3E7EFE7E5E3E6E5E4E5E4E2F1F6FFBAA386FFE873B5AB9ECAC0
        B8FFD26EF9DA8EE7B25BEAC079F8E09BFBD165D3C4AFEAEEF6ECEBE8ECEBE9EB
        E9E6FBFFFFA28E78DEAF4FA89C95D1C7B9FFDA78F5D889E2A442ECC47EFEF4D5
        FFE290DCD7D4F5FFFFF6FEFFF6FEFFF6FDFFFFFFFFDFDDDCC8BAA7DFDDDCE5E4
        E2FFDE88E4AA45FCF5EBECC681F0CA82F4CA7DE8C788EFCF94EFD498EDCF92EE
        D092EED093F2D396F7D79BF6D69BE6C48AEBB552FDF9F2FFFFFF}
      ParentShowHint = False
      ShowHint = True
	  Transparent = False
    end
    object btn_undo: TSpeedButton
      Left = 101
      Top = 2
      Width = 25
      Height = 25
      Hint = '{Undo}'
      Flat = True
      Glyph.Data = {
        36030000424D3603000000000000360000002800000010000000100000000100
        18000000000000030000C40E0000C40E00000000000000000000FFFFFFFFFFFF
        FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
        FFFFFFFFFFFFFFFFFFFFF9F7F3E1D3C0FBF9F7FFFFFFFFFFFFFFFFFFFFFFFFFF
        FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFDDCAB2BE9155
        B5905FD5C1A8F9F7F3FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
        FFFFFFFFFFFFFFFFFFFFD8B684D79A3BDAA856C69A58B48E5BD1BCA0F8F5F1FF
        FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF8F5F1E6DACAF6F2EDD2A867D0860A
        D28C11D9A035DFB058CBA15AB28C58DDCDB9FFFFFFFFFFFFFFFFFFFFFFFFDECF
        BBB18B54BF9858D5BD9BD2A154D28D0DD4900ED59310D89715DEA634E3B75CF3
        E0BAFFFFFFFFFFFFFFFFFFFFFFFFEAD4A7EABF5EE9B94EDAB56FD29E43D59310
        D79511D89611D99812DCA42DEFD397FEFCF8FFFFFFFFFFFFFFFFFFFFFFFFD8BB
        8BE4A61BE5A71BDFB152D39D36D89611D99812DA9A13CC9428BD9049F6F2EDFF
        FFFFFFFFFFFFFFFFFFFFFFEAE1D4CFA455E6A81CE7A91DE3B653D9A132DA9A13
        E7BC61DC9D15E1A82FE5B54EC2A275F6F2EDFFFFFFFFFFFFDDCDB9BE975CE9B5
        41E7AA1DE8AB1EF0D28DE8BF69F4E0B5FFFFFFE1AB34E0A218E1A41CDEB35BB5
        8F59BD9E76B18D5DC89F5BEBBE55E8AC20E8AB1EE8AD26FDF8EDFFFFFFFFFFFF
        FFFFFFF9EDD1E3A61EE4A61BE7AD2AEBC05FE2B862EBC266ECBB49E8AC20E8AB
        1EE8AB1EF6DDA4FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF8E8C5E9B133E7A91DE7
        AB1FEAB12DE8AD22E8AB1EE8AB1EE9AE25F6DCA2FFFFFFFFFFFFFFFFFFFFFFFF
        FFFFFFFFFFFFFFFFFFFEFAF2F6DDA5EEC25BECBB48EBB538EFC665F4D590FCF5
        E5FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
        FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
        FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
        FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
        FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF}
      ParentShowHint = False
      ShowHint = True
	  Transparent = False
    end
    object btn_redo: TSpeedButton
      Left = 130
      Top = 2
      Width = 25
      Height = 25
      Hint = '{Redo}'
      Flat = True
      Glyph.Data = {
        36030000424D3603000000000000360000002800000010000000100000000100
        18000000000000030000C40E0000C40E00000000000000000000FFFFFFFFFFFF
        FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
        FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
        FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFBF9F7E1D3C0F9F7F3FFFFFFFFFFFF
        FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF9F7F3D5C1
        A8B59060C29959DECCB2F6F2EDE6DACAF8F5F1FFFFFFFFFFFFFFFFFFFFFFFFFF
        FFFFFFFFFFF8F5F1D1BCA0B48F5CCAA15BE2B75EE3B146DDBF89D3BB9ABB9256
        B18953DECFBBFFFFFFFFFFFFFFFFFFFFFFFFDDCDB9B28C58CDA45BE3B85CE2AD
        3CDFA01BDFA017D9B46DD2A968DBA442E0AF56E6CEA2FFFFFFFFFFFFFFFFFFFF
        FFFFF3E0BAE5B95DE1AC38DFA01ADFA017E0A218E1A319DAAF5CD3A149D4900E
        D59310D6B989FFFFFFFFFFFFFFFFFFFFFFFFFEFCF8F0D498E0A830E0A218E1A3
        19E2A41AE4A61BDCAD4CD8A74BD79511D89611C99D50EAE1D4FFFFFFFFFFFFFF
        FFFFFFFFFFF6F2EDBD924AD19A2CE4A61BE5A71BE6A81CDEAB3EE9C887D99812
        DA9A13E0AB3ABD965ADDCDB9FFFFFFFFFFFFF6F2EDC2A275E8B951E8B033E6A8
        1CEFC567E7AA1DE5B13CFCF7ECDB9E1CDC9D15DE9F18E5B650C59E5AB18D5DBD
        9E76B58F59E0B55CE6A91FE7A91DE7B239FFFFFFF8E4B8F0C96FFFFFFFF2D8A1
        DFA017E0A218E1A41BE8B546E9BF65E1B862EBC05FE9AF2CE7AA1DE8AD22FAEE
        D2FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF3D9A0E3A721E4A61BE5A71BE6AA20E9
        AF2CE7AB1FE8AB1EEAB435F9EAC5FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
        FFFFFFFCF5E5F3D48FEFC465EAB438ECBB48EEC25BF6DDA5FEFAF2FFFFFFFFFF
        FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
        FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
        FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
        FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
        FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF}
      ParentShowHint = False
      ShowHint = True
	  Transparent = False
    end
    object btn_find: TSpeedButton
      Left = 159
      Top = 2
      Width = 25
      Height = 25
      Hint = '{Search}'
      Flat = True
      Glyph.Data = {
        36030000424D3603000000000000360000002800000010000000100000000100
        18000000000000030000C40E0000C40E00000000000000000000FFFFFFFFFFFF
        FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
        FFFFFFFFFFFFFFFFFFFFFFFFFFC6C0BDAC8977CDAE9FE2DFDEFFFFFFFFFFFFFF
        FFFFFFFFFFFFFFFFFFFFFFFFFFFFF8F1EDE9DED9FFFFFFFFFFFFB5AFAC834321
        C7A47ECCA4809B5E3FB3AEABFFFFFFFFFFFFFFFFFFFFFFFFFDFDFDB58A74B074
        53A066468A563AE2DDDA8D5F46C39E4FE7D36CE7D36CBE924F77513CFFFFFFFF
        FFFFFFFFFFFFFFFFBDAAA0AA7546E7D36CE7D36CB28542976B52653C269F611E
        CD921ECD921EA56729613D2AFFFFFFFFFFFFFFFFFFFFFFFF7B6155AA6C31CD92
        1ECD921EBC7F1E8349286B69687342249E5D39B06D4B714225404040FFFFFFFF
        FFFFFFFFFFFFFFFF565656824827B3753AB5762C894A2265412EDBDBDB393939
        817C7AACABAA6565653C3C3CFFFFFFFFFFFFFFFFFFFFFFFF757575434343876D
        60AE8B7B504641999999FFFFFF474747606060A1A1A1737373323232E2E2E2DD
        DDDDDDDDDDE3E3E36565657777779999997D7D7D363636D6D6D6FFFFFF737373
        606060A1A1A17171712D2D2D9F9F9F929292929292A6A6A6494949767676A1A1
        A17070703D3D3DFDFDFDFFFFFF9F9F9F60606099999A7A7A7B40404166666767
        67671E1E1E4E4F503A3A3A7272729A9B9B7070706F6F6FFFFFFFFFFFFFCCCCCC
        60606098999982838568696A4344445F5F5F0B0B0B20212141424268696A9595
        96707070A0A0A0FFFFFFFFFFFFF8F8F862626280808182838568696A41424256
        56560A0A0A1A1B1B41424268696A767676707070DCDCDCFFFFFFFFFFFFFFFFFF
        D6D6D65F5F5F3434356161626363646F70702B2B2B3D3E3F5E5F5F5051524040
        40B3B3B3FFFFFFFFFFFFFFFFFFFFFFFFFFFFFF7979793C3C3D8D8D8EFFFFFFFF
        FFFFFFFFFFFFFFFFC2C3C37C7C7E474748FFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
        FFFFFFDBDBDB5A5A5BC3C3C4FFFFFFFFFFFFFFFFFFFFFFFFEAEAEA8A8A8C8C8C
        8DFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
        FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF}
      ParentShowHint = False
      ShowHint = True
	  Transparent = False
    end
    object Bevel2: TBevel
      Left = 94
      Top = 4
      Width = 11
      Height = 23
      Shape = bsLeftLine
    end
	object opt_saveTabs: TComboBox
      Left = 197
      Top = 4
      Width = 112
      Height = 23
      Hint = '{When changing the tab, what to do?}'
      HelpType = htKeyword
      HelpKeyword = 
        'AAAAAhQCEQVDTEFTUxEJVENvbWJvQm94EQZQQVJBTVMUCBEIYXZpc2libGUFEQhh' +
        'ZW5hYmxlZAURAXcMQFoAAAAAAAARAWgMAAAAAAAAAAARC29ubW91c2Vkb3duERZt' +
        'eURlc2lnbjo6b2JqTW91c2VEb3duEQF5EQE0EQF4EQMxOTcRCmJldmVsd2lkdGgR' +
        'ATA='
      ItemIndex = 0
      ParentShowHint = False
      ShowHint = True
      TabOrder = 0
      Text = '{Save with asking}'
      Items.Strings = (
        '{Save with asking}'
        '{Save without asking}'
        '{Don'#39't save}')
    end


  end
  object Panel3: TPanel
    Left = 0
    Top = 543
    Width = 1011
    Height = 54
    Align = alBottom
    BevelOuter = bvNone
    TabOrder = 2
    ExplicitTop = 509
    ExplicitWidth = 719
    DesignSize = (
      1011
      54)
    object desc: TLabel
      Left = 40
      Top = 25
      Width = 1065
      Height = 24
      Anchors = [akLeft, akRight, akBottom]
      AutoSize = False
      WordWrap = True
      ExplicitWidth = 469
    end
    object action_image: TImage
      Left = 9
      Top = 6
      Width = 25
      Height = 25
      Anchors = [akLeft, akBottom]
      Center = True
      Transparent = True
    end
    object info: TLabel
      Left = 40
      Top = 6
      Width = 295
      Height = 13
      Anchors = [akLeft, akBottom]
      Font.Charset = DEFAULT_CHARSET
      Font.Color = clWindowText
      Font.Name = 'Segoe UI'
	  Font.Size = 9
      Font.Style = [fsBold]
      ParentFont = False
      ExplicitWidth = 3
    end
    object tlCancel: TLabel
      Left = 807
      Top = 6
      Width = 91
      Height = 40
      Cursor = crHandPoint
      Anchors = [akRight, akBottom]
      Caption = '{cancel}'
      Font.Charset = DEFAULT_CHARSET
      Font.Color = clWindowText
      Font.Name = 'Segoe UI'
	  Font.Size = 9
      Font.Style = [fsBold]
      ParentFont = False
      Autosize = False
	  Alignment = taCenter
	  Layout = tlCenter
    end
    object ok_cn: TLabel
      Left = 807
      Top = 46
      Width = 91
      Height = 3
      Cursor = crHandPoint
      Anchors = [akRight, akBottom]
      Caption = ''
      Color = clBlue
      Transparent = False
      Autosize = False
      Visible = False
    end
    object tlOk: TLabel
      Left = 902
      Top = 6
      Width = 103
      Height = 40
      Cursor = crHandPoint
      Anchors = [akRight, akBottom]
      Caption = '{ok}'
      Font.Charset = DEFAULT_CHARSET
      Font.Color = clWindowText
      Font.Name = 'Segoe UI'
	  Font.Size = 9
      Font.Style = [fsBold]
      ParentFont = False
      Autosize = False
	  Alignment = taCenter
	  Layout = tlCenter
    end
    object ok_cl: TLabel
      Left = 902
      Top = 46
      Width = 103
      Height = 3
      Cursor = crHandPoint
      Anchors = [akRight, akBottom]
      Caption = ''
      Color = clBlue
      Transparent = False
      Autosize = False
      Visible = False
    end
  end
  object SynPHPSyn: TSynPHPSyn
    CommentAttri.Foreground = 8158332
    KeyAttri.Foreground = 8404992
    NumberAttri.Foreground = 11425536
    StringAttri.Foreground = 16512
    SymbolAttri.Foreground = clRed
    VariableAttri.Foreground = 32829
    VariableAttri.Style = [fsBold]
    Left = 584
    Top = 192
  end
  object MainMenu: TMainMenu
    Left = 464
    Top = 192
    object File1: TMenuItem
      Caption = '{file}'
      object new1: TMenuItem
        Caption = '{new}'
        ShortCut = 16462
      end
      object Open1: TMenuItem
        Caption = '{open}'
        ShortCut = 16463
      end
      object Saveas1: TMenuItem
        Caption = '{save_as}'
        ShortCut = 24659
      end
      object N1: TMenuItem
        Caption = '-'
      end
      object Exit: TMenuItem
        Caption = '{exit}'
        ShortCut = 32883
      end
    end
    object edit1: TMenuItem
      Caption = '{edit}'
      object undoItem: TMenuItem
        Caption = '{Undo}'
        ShortCut = 16474
      end
      object redoItem: TMenuItem
        Caption = '{Redo}'
        ShortCut = 16473
      end
      object N4: TMenuItem
        Caption = '-'
      end
      object cut1: TMenuItem
        Caption = '{cut}'
        ShortCut = 16472
      end
      object copy1: TMenuItem
        Caption = '{copy}'
        ShortCut = 16451
      end
      object paste1: TMenuItem
        Caption = '{paste}'
        ShortCut = 16470
      end
      object selectall1: TMenuItem
        Caption = '{select all}'
        ShortCut = 16449
      end
      object N5: TMenuItem
        Caption = '-'
      end
    end
	object view: TMenuItem
	  Caption = '{&view}'
	  object it_tabs: TMenuItem
		Caption = '{Tabs}'
		Checked = True
	  end
	end
    object iconv: TMenuItem
      Caption = '{iconv}'
      object cutf8: TMenuItem
        Caption = '{UTF-8 (*Unicode)}'
      end
      object cansi: TMenuItem
        Caption = '{Ansi}'
      end
      object N7: TMenuItem
        Caption = '-'
      end
    end
    object Syntaxes: TMenuItem
      Caption = '{Syntax}'
      object SynList: TMenuItem
        Caption = '{Highlighting}'
      end
      object N8: TMenuItem
        Caption = '-'
      end
      object options: TMenuItem
        Caption = '{Setting}'
      end
    end
  end
  object synComplete: TSynCompletionProposal
    Options = [scoLimitToMatchedText, scoUseInsertList, scoUsePrettyText, scoCompleteWithEnter]
    NbLinesInWindow = 11
    ClSelectedText = clCaptionText
    ClBackground = clWhite
    Width = 400
    EndOfTokenChr = '()[]'
    TriggerChars = '.'
    Font.Charset = DEFAULT_CHARSET
    Font.Color = clWindowText
    Font.Name = 'Segoe UI'
	Font.Size = 9
    Font.Style = []
    TitleFont.Charset = DEFAULT_CHARSET
    TitleFont.Color = clBtnText
    TitleFont.Name = 'Segoe UI'
	TitleFont.Size = 9
    TitleFont.Style = [fsBold]
	DefaultType = ctCode
    Columns = <>
    ItemHeight = 20
    Margin = 5
    ShortCut = 16416
    Editor = memo
    Left = 520
    Top = 192
  end
  object synHint: TSynCompletionProposal
    DefaultType = ctParams
    EndOfTokenChr = '()[]. '
    TriggerChars = '.'
    Font.Charset = DEFAULT_CHARSET
    Font.Color = clWindowText
    Font.Name = 'Segoe UI'
	Font.Size = 9
    Font.Style = []
    TitleFont.Charset = DEFAULT_CHARSET
    TitleFont.Color = clBtnText
    TitleFont.Name = 'Segoe UI'
	TitleFont.Size = 9
    TitleFont.Style = [fsBold]
    Columns = <>
    Resizeable = True
    ShortCut = 0
    Editor = memo
    Left = 488
    Top = 192
  end
  object Popup: TPopupMenu
    Left = 432
    Top = 192
    object it_cut: TMenuItem
      Caption = '{cut}'
      ShortCut = 16472
    end
    object it_paste: TMenuItem
      Caption = '{paste}'
      ShortCut = 16470
    end
    object it_copy: TMenuItem
      Caption = '{copy}'
      ShortCut = 16451
    end
    object it_selectall: TMenuItem
      Caption = '{Select all}'
      ShortCut = 16449
    end
    object N2: TMenuItem
      Caption = '-'
    end
    object it_find: TMenuItem
      Caption = '{Find text}'
      ShortCut = 114
    end
    object it_saveevent: TMenuItem
      Caption = '{Save Event}'
      ShortCut = 16467
      Visible = False
    end
  end
end