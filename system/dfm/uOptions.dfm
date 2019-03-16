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
    HelpType = htKeyword
    HelpKeyword = 
      'AAAAAhQCEQVDTEFTUxEMVFBhZ2VDb250cm9sEQZQQVJBTVMUAxEJcGFnZWluZGV4' +
      'EQEwEQphcGFnZWluZGV4BgARAXcIAdo='
    ActivePage = TabSheet2
    TabOrder = 0
    object TabSheet2: TTabSheet
      HelpType = htKeyword
      HelpKeyword = 'AAAAAhQCEQVDTEFTUxEJVFRhYlNoZWV0EQZQQVJBTVMUAREIYXZpc2libGUF'
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
        Width = 158
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
      HelpType = htKeyword
      HelpKeyword = 'AAAAAhQCEQVDTEFTUxEJVFRhYlNoZWV0EQZQQVJBTVMUAREIYXZpc2libGUF'
      Caption = '{Size and move}'
      object Label1: TLabel
        Left = 16
        Top = 40
        Width = 51
        Height = 13
        HelpType = htKeyword
        HelpKeyword = 'AAAAAhQCEQVDTEFTUxEGVExhYmVsEQZQQVJBTVMUAREBeBECMTY='
        Caption = '{Grid Size}'
      end
      object e_gridsize: TEdit
        Left = 16
        Top = 56
        Width = 271
        Height = 21
        HelpType = htKeyword
        HelpKeyword = 
          'AAAAAhQCEQVDTEFTUxEFVEVkaXQRBlBBUkFNUxQDEQF3EQMyNzERAWgRAjIyEQF4' +
          'EQIxNg=='
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
      object c_showgrid: TCheckBox
        Left = 16
        Top = 16
        Width = 321
        Height = 17
        HelpType = htKeyword
        HelpKeyword = 'AAAAAhQCEQVDTEFTUxEJVENoZWNrQm94EQZQQVJBTVMUAREBeBECMTY='
        Caption = '{Show grid}'
        Checked = True
        State = cbChecked
        TabOrder = 1
      end
      object clrs: TGroupBox
        Left = 16
        Top = 84
        Width = 288
        Height = 100
        HelpType = htKeyword
        HelpKeyword = 
          'AAAAAhQCEQVDTEFTUxEJVEdyb3VwQm94EQZQQVJBTVMUCREIYXZpc2libGUFEQhh' +
          'ZW5hYmxlZAURAXcMQHIAAAAAAAARAWgRAzEwMBEGcGFyZW50FwlUVGFiU2hlZXQU' +
          'BBEKY2xhc3NfbmFtZQ4JEQgAKgBfZm9udAARBHNlbGYKCBYqMBEIACoAcHJvcHMU' +
          'ABEEdGV4dBEGw/Dz7+AxEQp3aW5jb250cm9sBRELdHJhbnNwYXJlbnQEEQF4EQIx' +
          'Ng=='
        Caption = '{Selection Colors}'
        Color = clBtnFace
        ParentColor = False
        TabOrder = 2
        object en_bc: TShape
          Left = 12
          Top = 33
          Width = 144
          Height = 20
          HelpType = htKeyword
          HelpKeyword = 
            'AAAAAhQCEQVDTEFTUxEGVFNoYXBlEQZQQVJBTVMUCREIYXZpc2libGUFEQhhZW5h' +
            'YmxlZAURAXcMQGIAAAAAAAARAWgRAjIwEQZwYXJlbnQXCVRHcm91cEJveBQEEQpj' +
            'bGFzc19uYW1lDgkRCAAqAF9mb250ABEEc2VsZgoIKr8gEQgAKgBwcm9wcxQAEQR0' +
            'ZXh0EQfUs+Pz8OAxEQF5EQIzMxEKYnJ1c2hjb2xvcgoA/wAAEQhwZW53aWR0aBEB' +
            'Mg=='
          Brush.Color = clBlue
          Pen.Width = 2
        end
        object dis_bc: TShape
          Left = 12
          Top = 73
          Width = 144
          Height = 20
          HelpType = htKeyword
          HelpKeyword = 
            'AAAAAhQCEQVDTEFTUxEGVFNoYXBlEQZQQVJBTVMUChEIYXZpc2libGUFEQhhZW5h' +
            'YmxlZAURAXcMQGIAAAAAAAARAWgRAjIwEQZwYXJlbnQXCVRHcm91cEJveBQEEQpj' +
            'bGFzc19uYW1lDgkRCAAqAF9mb250ABEEc2VsZgoIKr8gEQgAKgBwcm9wcxQAEQR0' +
            'ZXh0EQfUs+Pz8OAxEQF4BhgRAXkRAjczEQpicnVzaGNvbG9yCgCAgIARCHBlbndp' +
            'ZHRoEQEy'
          Brush.Color = clGray
          Pen.Width = 2
        end
        object label6: TLabel
          Left = 16
          Top = 16
          Width = 142
          Height = 13
          HelpType = htKeyword
          HelpKeyword = 'AAAAAhQCEQVDTEFTUxEGVExhYmVsEQZQQVJBTVMUAhEBeAYcEQF5BjQ='
          AutoSize = False
          Caption = '{Enabled Button Color}'
        end
        object label7: TLabel
          Left = 16
          Top = 56
          Width = 145
          Height = 13
          HelpType = htKeyword
          HelpKeyword = 'AAAAAhQCEQVDTEFTUxEGVExhYmVsEQZQQVJBTVMUAhEBeAYcEQF5EQI1Ng=='
          AutoSize = False
          Caption = '{Disabled Button Color}'
        end
        object sel_color: TShape
          Left = 171
          Top = 33
          Width = 96
          Height = 60
          HelpType = htKeyword
          HelpKeyword = 
            'AAAAAhQCEQVDTEFTUxEGVFNoYXBlEQZQQVJBTVMUCxEIYXZpc2libGUFEQhhZW5h' +
            'YmxlZAURAXcMQGIAAAAAAAARAWgRAjYwEQZwYXJlbnQXCVRHcm91cEJveBQEEQpj' +
            'bGFzc19uYW1lDgkRCAAqAF9mb250ABEEc2VsZgoIKr8gEQgAKgBwcm9wcxQAEQR0' +
            'ZXh0EQfUs+Pz8OAxEQF5Bi0RCmJydXNoY29sb3IGABEBeBEDMTcxEQhwZW5jb2xv' +
            'cgoAwICAEQhwZW53aWR0aBEBMg=='
          Brush.Color = clBlack
          Pen.Color = 12615808
          Pen.Width = 2
        end
        object label8: TLabel
          Left = 166
          Top = 16
          Width = 106
          Height = 13
          HelpType = htKeyword
          HelpKeyword = 'AAAAAhQCEQVDTEFTUxEGVExhYmVsEQZQQVJBTVMUAhEBeBEDMTY2EQF5Bhw='
          Alignment = taCenter
          AutoSize = False
          Caption = '{Selector Color}'
          Layout = tlCenter
        end
      end
      object up_gridsize: TUpDown
        Left = 287
        Top = 57
        Width = 12
        Height = 19
		Thousands = False
		Position = 8
        HelpType = htKeyword
        HelpKeyword = 
          'AAAAAhQCEQVDTEFTUxEHVFVwRG93bhEGUEFSQU1TFAkRCGF2aXNpYmxlBREIYWVu' +
          'YWJsZWQFEQF3EQIxNREBaBECMjIRBnBhcmVudBcJVFRhYlNoZWV0FAQRCmNsYXNz' +
          'X25hbWUOChEIACoAX2ZvbnQAEQRzZWxmCggWEpARCAAqAHByb3BzFAARBHRleHQR' +
          'CNHy8LPr6ugxEQp3aW5jb250cm9sBBEBeRECNTYRAXgRAzI4Nw=='
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
