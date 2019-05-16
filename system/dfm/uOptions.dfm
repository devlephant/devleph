object fmOptions: TfmOptions
  Left = 213
  Top = 150
  BorderStyle = bsDialog
  Caption = '{Preference}'
  ClientHeight = 283
  ClientWidth = 490
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
  object Bevel1: TBevel
    Left = 8
    Top = 233
    Width = 474
    Height = 9
    Shape = bsTopLine
  end
  object PageControl1: TPageControl
    Left = 8
    Top = 8
    Width = 474
    Height = 219
    ActivePage = TabSheet2
    TabOrder = 0
    object TabSheet2: TTabSheet
      Caption = '{Backup}'
      ImageIndex = 1
      object Label2: TLabel
        Left = 16
        Top = 48
        Width = 94
        Height = 13
        Caption = '{Backup Dir Name}'
      end
      object Label3: TLabel
        Left = 16
        Top = 104
        Width = 85
        Height = 13
        Caption = '{Backup Interval}'
      end
      object Label4: TLabel
        Left = 199
        Top = 126
        Width = 25
        Height = 13
        Caption = '{min.}'
      end
      object Label5: TLabel
        Left = 248
        Top = 104
        Width = 79
        Height = 13
        Caption = '{Backup Count}'
      end
      object backup_active: TCheckBox
        Left = 16
        Top = 16
        Width = 262
        Height = 17
        Caption = '{Backup Projects}'
        Checked = True
        State = cbChecked
        TabOrder = 0
      end
      object backup_dir: TEdit
        Left = 16
        Top = 67
        Width = 433
        Height = 21
        TabOrder = 1
        Text = 'backup'
        Alignment = taLeftJustify
        ColorOnEnter = clNone
        FontColorOnEnter = clNone
        TabOnEnter = False
        MarginLeft = 0
        MarginRight = 0
      end
      object backup_interval: TEdit
        Left = 16
        Top = 123
        Width = 177
        Height = 21
        TabOrder = 2
        Text = '2'
        Alignment = taLeftJustify
        ColorOnEnter = clNone
        FontColorOnEnter = clNone
        TabOnEnter = False
        MarginLeft = 0
        MarginRight = 0
      end
      object backup_count: TEdit
        Left = 248
        Top = 123
        Width = 201
        Height = 21
        TabOrder = 3
        Text = '3'
        Alignment = taLeftJustify
        ColorOnEnter = clNone
        FontColorOnEnter = clNone
        TabOnEnter = False
        MarginLeft = 0
        MarginRight = 0
      end
    end
    object TabSheet1: TTabSheet
      Caption = '{Size and move}'
      object e_gridsize: TEdit
        Left = 16
        Top = 56
        Width = 278
        Height = 21
        TabOrder = 0
        Text = '8'
		NumbersOnly = True
        Alignment = taLeftJustify
        ColorOnEnter = clNone
        FontColorOnEnter = clNone
        TabOnEnter = False
        MarginLeft = 0
        MarginRight = 0
      end
	  object Label1: TLabel
        Left = 16
        Top = 40
        Width = 288
        Height = 13
		AutoSize = False
        Caption = '{Grid Size}'
    end
	object c_showgrid: TCheckBox
        Left = 16
        Top = 16
        Width = 321
        Height = 17
        Caption = '{Show grid}'
        Checked = True
        State = cbChecked
        TabOrder = 1
      end
	object groupBox1: TGroupBox
     Left = 312
     Top = 17
     Width = 152
     Height = 167
     Caption = '{Sizing Colors}'
     ParentColor = False
     TabOrder = 5
      object label9: TLabel
        Left = 8
        Top = 24
        Width = 136
        Height = 16
		AutoSize = False
        Caption = '{Pen Style}'
      end
	  object cb_penstyle: TComboBox
        Left = 8
        Top = 39
        Width = 136
        Height = 23
		Style = csOwnerDrawFixed
		ItemIndex = 0
        Items.Strings = (
          'psSolid'
          'psDash'
          'psDot'
          'psDashDot'
          'psDashDotDot'
          'psClear'
          'psInsideFrame'
          'psUserStyle'
          'psAlternate')
      end
	  object label10: TLabel
        Left = 8
        Top = 72
        Width = 136
        Height = 16
		AutoSize = False
        Caption = '{Inner Color}'
      end
	  object scol_inn: TShape
		Left = 8
		Top = 88
		Width = 136
		Height = 20
		Pen.Width = 2
		Brush.Color = 14215660
	  end
	  object label11: TLabel
        Left = 8
        Top = 120
        Width = 136
        Height = 16
		AutoSize = False
        Caption = '{Outer Color}'
      end
	  object scol_out: TShape
		Left = 8
		Top = 136
		Width = 136
		Height = 20
		Pen.Width = 2
		Brush.Color = 10070188
	  end
	end
      object clrs: TGroupBox
        Left = 16
        Top = 84
        Width = 288
        Height = 100
        Caption = '{Selection Colors}'
        Color = clBtnFace
        ParentColor = False
        TabOrder = 2
        object en_bc: TShape
          Left = 12
          Top = 33
          Width = 144
          Height = 20
          Brush.Color = clBlue
          Pen.Width = 2
        end
        object dis_bc: TShape
          Left = 12
          Top = 73
          Width = 144
          Height = 20
          Brush.Color = clGray
          Pen.Width = 2
        end
        object label6: TLabel
          Left = 16
          Top = 16
          Width = 142
          Height = 13
          AutoSize = False
          Caption = '{Enabled Button Color}'
        end
        object label7: TLabel
          Left = 16
          Top = 56
          Width = 145
          Height = 13
          AutoSize = False
          Caption = '{Disabled Button Color}'
        end
        object sel_color: TShape
          Left = 171
          Top = 33
          Width = 96
          Height = 60
          Brush.Color = clBlack
          Pen.Color = 12615808
          Pen.Width = 2
        end
        object label8: TLabel
          Left = 166
          Top = 16
          Width = 106
          Height = 13
          Alignment = taCenter
          AutoSize = False
          Caption = '{Selector Color}'
          Layout = tlCenter
        end
      end
      object up_gridsize: TUpDown
        Left = 294
        Top = 55
        Width = 12
        Height = 25
		Min = 1
		Max = 50
		Associate = e_gridsize
		Thousands = False
		Position = 8
        TabOrder = 3
      end
    end
  end
  object BitBtn1: TBitBtn
    Left = 391
    Top = 244
    Width = 91
    Height = 27
    Caption = '{ok}'
    Font.Charset = DEFAULT_CHARSET
    Font.Color = clWindowText
    Font.Name = 'Segoe UI'
    Font.Style = [fsBold]
    ModalResult = 1
    ParentFont = False
    TabOrder = 1
  end
  object BitBtn2: TBitBtn
    Left = 294
    Top = 244
    Width = 91
    Height = 27
    Caption = '{cancel}'
    ModalResult = 2
    TabOrder = 2
  end
end
