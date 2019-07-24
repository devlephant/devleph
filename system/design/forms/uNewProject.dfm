object fmNewProject: TfmNewProject
  Left = 369
  Top = 256
  Anchors = [akRight, akBottom]
  BorderStyle = bsDialog
  Caption = '{New Project}'
  ClientHeight = 355
  ClientWidth = 502
  Color = clBtnFace
  Font.Charset = DEFAULT_CHARSET
  Font.Color = clWindowText
  Font.Quality = fqClearTypeNatural
  Font.Name = 'Segoe UI'
  Font.Size = 9
  Font.Style = []
  OldCreateOrder = False
  Position = poScreenCenter
  DesignSize = (
    502
    355)
  PixelsPerInch = 96
  TextHeight = 13
  object GroupBox1: TGroupBox
    Left = 8
    Top = 8
    Width = 487
    Height = 339
    Anchors = [akLeft, akTop, akRight, akBottom]
    Caption = '{ Project }'
    TabOrder = 0
    DesignSize = (
      487
      339)
    object Label1: TLabel
      Left = 16
      Top = 24
      Width = 141
      Height = 13
      Caption = '{Path to file project *.msppr}'
	  Transparent = True
    end
    object Label2: TLabel
      Left = 16
      Top = 136
      Width = 117
      Height = 13
      Caption = '{Open Last project:}'
      Font.Charset = DEFAULT_CHARSET
      Font.Color = clWindowText
      Font.Name = 'Segoe UI'
	  Font.Size = 9
      Font.Style = [fsBold]
      ParentFont = False
	  Transparent = True
    end
    object path: TEdit
      Left = 16
      Top = 40
      Width = 423
      Height = 21
      Anchors = [akLeft, akTop, akRight]
      TabOrder = 0
    end
    object btn_dlg: TBitBtn
      Left = 449
      Top = 40
      Width = 25
      Height = 21
      Cursor = crHandPoint
      Anchors = [akTop, akRight]
      Caption = '...'
      TabOrder = 1
    end
    object c_alldelete: TCheckBox
      Left = 16
      Top = 72
      Width = 488
      Height = 17
	  Anchors = [akLeft, akTop, akRight]
      Caption = '{Delete all files and folders in this path}'
      TabOrder = 2
    end
    object BitBtn1: TBitBtn
      Left = 384
      Top = 300
      Width = 91
      Height = 27
      Anchors = [akRight, akBottom]
      Caption = '{ok}'
      ModalResult = 1
      TabOrder = 3
    end
    object BitBtn2: TBitBtn
      Left = 288
      Top = 300
      Width = 91
      Height = 27
      Anchors = [akRight, akBottom]
      Caption = '{cancel}'
      ModalResult = 2
      TabOrder = 4
    end
    object startup: TCheckBox
      Left = 16
      Top = 97
      Width = 488
      Height = 17
      Caption = '{Show on Studio startup}'
      Checked = True
      State = cbChecked
      TabOrder = 5
    end
    object lastProjects: TListBox
      Left = 16
      Top = 152
      Width = 457
      Height = 137
      Style = lbOwnerDrawFixed
      ItemHeight = 19
      TabOrder = 6
    end
    object btn_demos: TBitBtn
      Left = 16
      Top = 300
      Width = 145
      Height = 27
      Hint = '{Open demos project directory}'
      Caption = '{Demo projects}'
      ParentShowHint = False
      ShowHint = True
      TabOrder = 7
    end
  end
end
