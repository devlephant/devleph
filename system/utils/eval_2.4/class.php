<?
	/************/
	/* xsnakes  */
	/* eval 2.4 */
	/************/
	
	c('fmMain->fp_left')->ShortCut = '';
	c('fmMain->fp_right')->ShortCut = '';
	c('fmMain->hd_leftform')->ShortCut = '';
	c('fmMain->hd_rightform')->ShortCut = '';
	
	// Форма диалога сохранения скрипта
	$str = "object dlgEval_saveScript: TForm
			  BorderIcons = []
			  BorderStyle = bsDialog
			  Caption = 'Save script'
			  ClientHeight = 80
			  ClientWidth = 176
			  Color = 15132390
			  Font.Charset = DEFAULT_CHARSET
			  Font.Color = clWindowText
			  Font.Height = -11
			  Font.Name = 'Tahoma'
			  Font.Style = []
			  Visible = False
			  Position = poScreenCenter
			  object label1: TLabel
			    Left = 8
			    Top = 8
			    Width = 160
			    Height = 16
			    AutoSize = False
			    Caption = '{Enter script name}:'
			    Layout = tlBottom
			  end
			  object edit_script_name: TEdit
			    Left = 8
			    Top = 24
			    Width = 160
			    Height = 21
			    TabOrder = 0
			    Alignment = taLeftJustify
			    ColorOnEnter = clNone
			    FontColorOnEnter = clNone
			    TabOnEnter = False
			    MarginLeft = 0
			    MarginRight = 0
			  end
			  object button_save_ok: TBitBtn
			    Left = 88
			    Top = 48
			    Width = 80
			    Height = 24
			    Caption = #1054#1050
			    TabOrder = 1
			  end
			  object button_save_cancel: TBitBtn
			    Left = 8
			    Top = 48
			    Width = 80
			    Height = 24
			    Caption = #1054#1090#1084#1077#1085#1072
			    ModalResult = 2
			    TabOrder = 2
			  end
			end";
	$dlgEval = new TForm();
	gui_stringToComponent($dlgEval->self, $str);
	
	// Eval редактор
	$str = "
	object TabSheet3: TTabSheet
		Name = ''
			object evalPopupMenu: TPopupMenu
				object it_eval_undo: TMenuItem
					Caption = 'Undo'
					ShortCut = 16474
				end
				object it_eval_redo: TMenuItem
					Caption = 'Redo'
					ShortCut = 16473
				end
				object TMenuItem
					Caption = '-'
				end
				object it_eval_cut: TMenuItem
					Caption = 'Cut'
					ShortCut = 16472
				end
				object it_eval_paste: TMenuItem
					Caption = 'Paste'
					ShortCut = 16470
				end
				object it_eval_copy: TMenuItem
					Caption = 'Copy'
					ShortCut = 16451
				end
				object TMenuItem
					Caption = '-'
				end
				object it_eval_delete: TMenuItem
					Caption = 'Delete'
					ShortCut = 16452
				end
				object it_eval_selectall: TMenuItem
					Caption = 'Select All'
					ShortCut = 16449
				end
				object it_eval_date_and_time: TMenuItem
					Caption = 'Paste Date and Time'
					ShortCut = 8308
				end
			end
			object TScrollBox
				Name = 'evalPanel'
				Align = alTop
				BorderStyle = bsNone
				Height = 24
				Color = 16777215
				ParentCtl3D = False
			end
			object evalMemo: TSynEdit
				RightEdge = -1
				Align = alClient
				Color = clWhite
				Ctl3D = True
				BorderStyle = bsNone
				FontSmoothing = fsmClearType
				PopupMenu = evalPopupMenu
				ParentCtl3D = False
				Font.Charset = DEFAULT_CHARSET
				Font.Color = clWindowText
				Font.Height = -13
				Font.Name = 'Courier New'
				Font.Style = []
				Gutter.Font.Charset = DEFAULT_CHARSET
				Gutter.Font.Color = clWindowText
				Gutter.Font.Height = -11
				Gutter.Font.Name = 'Courier New'
				Gutter.Font.Style = []
				Gutter.ShowLineNumbers = True
				Highlighter = fmPHPEditor.SynPHPSyn
				Options = [eoAutoIndent, eoDragDropEditing, eoEnhanceEndKey, eoGroupUndo, eoHalfPageScroll, eoScrollPastEof, eoShowScrollHint, eoSmartTabDelete, eoTabIndent, eoTrimTrailingSpaces]
				SelectedColor.Foreground = 11990266
				TabWidth = 4
				WantTabs = True
			end
			object evalSynCompletionProposal: TSynCompletionProposal
				Options = [scoLimitToMatchedText, scoUseInsertList, scoUsePrettyText, scoCompleteWithTab, scoCompleteWithEnter]
				NbLinesInWindow = 12
				Width = 400
				EndOfTokenChr = ']})>'
				TriggerChars = #39'\"({['
				Font.Charset = DEFAULT_CHARSET
				Font.Color = clWindowText
				Font.Height = -11
				Font.Name = 'MS Sans Serif'
				Font.Style = []
				TitleFont.Charset = DEFAULT_CHARSET
				TitleFont.Color = clBtnText
				TitleFont.Height = -11
				TitleFont.Name = 'MS Sans Serif'
				TitleFont.Style = [fsBold]
				Columns = <>
				ItemHeight = 16
				Images = evalImageList
				ShortCut = 16416
				Editor = evalMemo
				Left = 424
				Top = 208
			end
			object evalImageList: TImageList
				Bitmap = {
				494C010105000900040010001000FFFFFFFFFF00FFFFFFFFFFFFFFFF424D3600
				0000000000003600000028000000400000002000000001002000000000000020
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
				0000000000000000000000000000000000000000000000000000000000000000
				0000000000000000000000000000000000000000000000000000000000000000
				0000000000000000000000000000000000000000000000000000000000000000
				0000000000000000000000000000000000000000000000000000000000000000
				0000000000000000000000000000000000000000000000000000000000000000
				0000000000000000000027A9DF002BC0FF002ABFFF002BC0FF0027A9DF000000
				0000000000000000000000000000000000000000000000000000000000000000
				0000000000000000000000000000000000000000000000000000000000000000
				0000000000000000000000000000000000000000000000000000000000000000
				0000000000000000000000000000000000000000000000000000000000000000
				0000000000000000000000000000000000000000000000000000000000000000
				0000000000000000000000000000000000000000000000000000000000000000
				0000000000000000000000000000000000000000000000000000000000000000
				00000000000027A9DF003EC9FF0076E0FF007BE2FF0076E0FF003EC9FF0027A9
				DF00000000000000000000000000000000000000000000000000000000000000
				0000000000000000000000000000000000000000000000000000000000000000
				0000000000000000000000000000000000000000000000000000000000000000
				0000000000000000000000000000000000000000000000000000000000000000
				0000000000000000000000000000000000000000000000000000000000000000
				0000000000000000000000000000000000000000000000000000000000000000
				0000000000000000000000000000000000000000000000000000000000000000
				0000000000002BC0FF0068D8FF0069D8FF0068D8FF0069D8FF0068D8FF002BC0
				FF00000000000000000000000000000000000000000000000000000000000000
				0000000000000000000000000000000000000000000000000000000000000000
				0000000000000000000000000000000000000000000000000000000000000000
				0000000000000000000000000000000000000000000000000000000000000000
				0000000000000000000000000000000000000000000000000000000000000000
				0000000000000000000000000000000000000000000000000000000000000000
				0000000000000000000000000000000000000000000000000000000000000000
				0000000000002AC0FF0075D7FF0056CEFF0056CEFF0056CEFF0075D7FF002AC0
				FF00000000000000000000000000000000000000000000000000000000000000
				0000000000000000000000000000000000000000000000000000000000000000
				0000000000000000000000000000000000000000000000000000000000000000
				0000000000000000000000000000000000000000000000000000000000000000
				0000000000000000000000000000000000000000000000000000000000000000
				0000000000000000000000000000000000000000000000000000000000000000
				0000000000000000000000000000000000000000000000000000000000000000
				0000000000002AC0FF0095DDFF0062CDFF005CCBFF0062CDFF0095DDFF002AC0
				FF00000000000000000000000000000000000000000000000000000000000000
				0000000000000000000000000000000000000000000000000000000000000000
				0000000000000000000000000000000000000000000000000000000000000000
				0000000000000000000000000000000000000000000000000000000000000000
				0000000000000000000000000000000000000000000000000000000000000000
				0000000000000000000000000000000000000000000000000000000000000000
				0000000000000000000000000000000000000000000000000000000000000000
				0000000000002CC0FE0041C6FF0096DCFF009CDDFF0096DCFF0041C5FF002CC0
				FE00000000000000000000000000000000000000000000000000000000000000
				0000000000000000000000000000000000000000000000000000000000000000
				0000000000000000000000000000000000000000000000000000000000000000
				0000000000000000000000000000000000000000000000000000000000000000
				0000000000000000000000000000000000000000000000000000000000000000
				0000000000000000000000000000000000000000000000000000000000000000
				0000000000000000000000000000000000000000000000000000000000000000
				000000000000000000002BC0FE0029C0FF0028C0FF0029C0FF002BC0FE000000
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
				000000000000000000000000000000000000000000000000000000000000D2B8
				8100B07C1300B07B1200B07B1200B07B1200B07B1200B07B1200B07B1200B07C
				1300B07D1700B67D0C0000000000000000000000000000000000000000000000
				0000000000000000000000000000000000000000000000000000000000000000
				0000000000000000000000000000000000000000000000000000000000000000
				0000000000000000000000000000000000000000000000000000000000000000
				0000000000000000000000000000000000000000000000000000000000000000
				0000000000000000000000000000000000000000000000000000000000000000
				000000000000000000000000000000000000000000000000000000000000D9BC
				8400FDFEFE00FDFEFE00FDFEFE00FDFEFE00FDFEFE00FDFEFE00FDFEFE00FDFE
				FE00FBF8F300B47A080000000000000000000000000000000000000000000000
				00000000000000000000007A4200008A4A0000894900008A4A00007A42000000
				0000000000000000000000000000000000000000000000000000000000000000
				000000000000000000007D7D7D009898980098989800989898007D7D7D000000
				0000000000000000000000000000000000000000000000000000000000000000
				00000000000000000000A2741800B7831900B6821800B7831900A27418000000
				000000000000000000000000000000000000000000000000000000000000DABD
				8300FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFF
				FF00FCF9F400B379060000000000000000000000000000000000000000000000
				000000000000007A4200009B5C0000CE900000D1940000CE9000009B5C00007A
				4200000000000000000000000000000000000000000000000000000000000000
				0000000000007D7D7D009D9D9D00A6A6A600A7A7A700A6A6A6009D9D9D007D7D
				7D00000000000000000000000000000000000000000000000000000000000000
				000000000000A2741800C5922F00EDC07400F1C47A00EDC07400C5922F00A274
				180000000000000000000000000000000000000000000000000000000000DABD
				8400FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFF
				FF00FCF9F400B379070000000000000000000000000000000000000000000000
				000000000000008A4A0000C7890000C88A0000C6890000C88A0000C78900008A
				4A00000000000000000000000000000000000000000000000000000000000000
				00000000000099999900A0A0A000A1A1A100A0A0A000A1A1A100A0A0A0009999
				9900000000000000000000000000000000000000000000000000000000000000
				000000000000B7841A00EAB45C00E9B45C00E8B35B00E9B45C00EAB45C00B784
				1A0000000000000000000000000000000000000000000000000000000000DABD
				8400FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFF
				FF00FCF9F400B37A070000000000000000000000000000000000000000000000
				0000000000000089480025CF990000C07F0000BE7E0000C07F0025CF99000089
				4800000000000000000000000000000000000000000000000000000000000000
				00000000000099999900A0A0A000999999009999990099999900A0A0A0009999
				9900000000000000000000000000000000000000000000000000000000000000
				000000000000B7821900EBB96400E3A64100E3A64100E3A64100EBB96400B782
				190000000000000000000000000000000000000000000000000000000000DABD
				8400FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFFFF00FFFF
				FF00FCF9F400B37A070000000000000000000000000000000000000000000000
				000000000000008A490066DAB4001EC68E0016C388001EC68E0066DAB400008A
				4900000000000000000000000000000000000000000000000000000000000000
				00000000000099999900A5A5A500999999009898980099999900A5A5A5009999
				9900000000000000000000000000000000000000000000000000000000000000
				000000000000B7831900EEC68400E5AA4900E2A64100E5AA4900EEC68400B783
				190000000000000000000000000000000000000000000000000000000000D9B7
				7700EFD6AB00F1D8B200F2DBB600F3DEBB00F5E0C100F4DEBB00F4DEBA00F6DF
				B800FBEFDB00B57C0B0000000000000000000000000000000000000000000000
				000000000000008B4A00109F630074DAB7007ADEBD0074DAB700109F6300008B
				4A00000000000000000000000000000000000000000000000000000000000000
				000000000000989898009A9A9A00A4A4A400A5A5A500A4A4A400999999009898
				9800000000000000000000000000000000000000000000000000000000000000
				000000000000B8841B00C6922E00ECC48200EFC88600ECC48200C6912C00B884
				1B0000000000000000000000000000000000000000000000000000000000D4AC
				6100CA7F1200D08B1500D7983100DFA74B00E6B36500D3A95900BC8518009389
				C100EBD0A300B680110000000000000000000000000000000000000000000000
				00000000000000000000008B4A00008A480000894600008A4800008B4A000000
				0000000000000000000000000000000000000000000000000000000000000000
				0000000000000000000098989800999999009898980099999900989898000000
				0000000000000000000000000000000000000000000000000000000000000000
				00000000000000000000B8841B00B7831900B6821700B7831900B8841B000000
				0000000000000000000000000000000000000000000000000000000000000000
				0000D2A95900D2A95900D2A85800D1A75700D1A75600D2A75600D2A75500D4A9
				5400C99B3E000000000000000000000000000000000000000000000000000000
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
				0000000000000000000000000000000000000000000000000000000000000000
				0000000000000000000000000000000000000000000000000000000000000000
				0000000000000000000000000000000000000000000000000000000000000000
				0000000000000000000000000000000000000000000000000000000000000000
				0000000000000000000000000000000000000000000000000000000000000000
				000000000000000000000000000000000000424D3E000000000000003E000000
				2800000040000000200000000100010000000000000100000000000000000000
				000000000000000000000000FFFFFF00FFFF000000000000FFFF000000000000
				FFFF000000000000FFFF000000000000FFFF000000000000FC1F000000000000
				F80F000000000000F80F000000000000F80F000000000000F80F000000000000
				F80F000000000000FC1F000000000000FFFF000000000000FFFF000000000000
				FFFF000000000000FFFF000000000000FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
				FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFE003FFFFFFFFFFFFE003FC1FFC1FFC1F
				E003F80FF80FF80FE003F80FF80FF80FE003F80FF80FF80FE003F80FF80FF80F
				E003F80FF80FF80FE003FC1FFC1FFC1FF007FFFFFFFFFFFFFFFFFFFFFFFFFFFF
				FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF}
			end
	end";
	
	$page = c("fmMain->PageControl1")->addPage(t("Eval_Caption"));
	gui_stringToComponent($page->self, $str);
	$page->name = "TabSheet3";
	//gui_propSet(c("fmPHPEditor->synComplete")->self, 'Editors', '[fmPHPEditor.memo, fmMain.PageControl1.TabSheet3.evalMemo]');
	$panel = $page->findComponent('evalPanel');
	$memo = $page->findComponent('evalMemo');
	$combo = new TComboBox($page);
	
	if( is_file($file = __DIR__.'/eval.tmp') )
		$memo->text = file_get_contents($file);
	
	// Кнопка RUN, исполнение кода из memo
	$bt = new TSpeedButton($page);
	$bt->parent = $panel;
	$bt->align = alLeft;
	$bt->caption = '';
	$bt->w = 28;
	$bt->flat = true;
	$bt->hint = 'Eval';
	$bt->onClick = function()use($page,$memo){
		file_put_contents(__DIR__.'/eval.tmp', $memo->text);
		$code = '$self = c('.$memo->self.');'.$memo->text;
		if( @eval('return true;'.$code) ) {
			eval($code);
		} else {
			message_beep(66);
			messageDlg('Ошибка синтаксиса!', mtError, MB_OK);
		}
		
	};
	if( is_file($file = __DIR__.'/img/run.png') )
		$bt->loadPicture($file);
	else
		$bt->caption = $bt->hint;
	
	// Навороченный разделитель группы кнопок :)
	$l = new TLabel($page);
	$l->parent = $panel;
	$l->align = alLeft;
	$l->font->color = 0xAAA6A7;
	$l->font->size = 12;
	$l->caption = '|';
	$l->alignment = taCenter;
	$l->layout = tlTop;
	$l->w = 7;
	
	// Кнопка UNDO, отменить
	$bt = new TSpeedButton($page);
	$bt->parent = $panel;
	$bt->align = alLeft;
	$bt->caption = '';
	$bt->w = 28;
	$bt->flat = true;
	$bt->hint = 'Undo';
	$bt->onClick = function()use($memo){$memo->undo();};
	if( is_file($file = __DIR__.'/img/undo.bmp') )
		$bt->loadPicture($file);
	else
		$bt->caption = $bt->hint;
	
	// Кнопка REDO, повторить
	$bt = new TSpeedButton($page);
	$bt->parent = $panel;
	$bt->align = alLeft;
	$bt->caption = '';
	$bt->w = 28;
	$bt->flat = true;
	$bt->hint = 'Redo';
	$bt->onClick = function()use($memo){$memo->redo();};
	if( is_file($file = __DIR__.'/img/redo.bmp') )
		$bt->loadPicture($file);
	else
		$bt->caption = $bt->hint;
	
	// Разделитель
	$l = new TLabel($page);
	$l->parent = $panel;
	$l->align = alLeft;
	$l->font->color = 0xAAA6A7;
	$l->font->size = 12;
	$l->caption = '|';
	$l->alignment = taCenter;
	$l->layout = tlTop;
	$l->w = 7;
	
	// Кнопка NEW, ноый скрипт
	$bt = new TSpeedButton($page);
	$bt->parent = $panel;
	$bt->align = alLeft;
	$bt->caption = '';
	$bt->w = 28;
	$bt->flat = true;
	$bt->hint = 'New';
	$bt->onClick = function()use($memo){
		if(messageDlg('Не сохраненный скрипт будет потерян! Создать новый скрипт?', mtCustom, MB_YESNO) == mrNo)
			return;
		$memo->text = '';};
	if( is_file($file = __DIR__.'/img/new.png') )
		$bt->loadPicture($file);
	else
		$bt->caption = $bt->hint;
	
	// Кнопка SAVE, сохранение скрипта
	$bt = new TSpeedButton($page);
	$bt->parent = $panel;
	$bt->align = alLeft;
	$bt->caption = '';
	$bt->w = 28;
	$bt->flat = true;
	$bt->hint = 'Save';
	$bt->onClick = function()use($combo, $memo){
		$fname = $combo->intext;
		$file = __DIR__.'/scripts/'.$fname.'.script';
		if(is_file($file)){
			message_beep(66);
			if(messageDlg('Перезаписать скрипт "'.$fname.'"?', mtCustom, MB_YESNO) == mrNo)
				return;
			file_put_contents($file, $memo->text);
		}else
			messageDlg('Скрипт не найден!', mtCustom, MB_OK);
	};
	if( is_file($file = __DIR__.'/img/save.png') )
		$bt->loadPicture($file);
	else
		$bt->caption = $bt->hint;
	
	// Кнопка SAVE_AS, сохранение скрипта как ...
	$bt = new TSpeedButton($page);
	$bt->parent = $panel;
	$bt->align = alLeft;
	$bt->caption = '';
	$bt->w = 28;
	$bt->flat = true;
	$bt->hint = 'Save As...';
	$bt->onClick = function()use($dlgEval){ShowForm($dlgEval, SW_SHOWMODAL);};
	if( is_file($file = __DIR__.'/img/save_as.png') )
		$bt->loadPicture($file);
	else
		$bt->caption = $bt->hint;
	
	$combo->style = csOwnerDrawFixed;
	$combo->parent = $panel;
	$combo->align = alClient;
	$combo->parentcolor = true;
	$combo->dropDownCount = 16;
	$combo->font->size = 9;
	$combo->hint = 'Scripts';
	$combo->onFocus = function()use($combo){
		dir_search(__DIR__.'/scripts/', $list, 'script', 0, 0);
		foreach($list as $k=>$v)
			$list[$k] = basenameNoExt($v);
		$combo->text = $list;
	};
	
	// Кнопка LOAD, загрузка выбранного скрипта в мемо
	$bt = new TSpeedButton($page);
	$bt->parent = $panel;
	$bt->align = alLeft;
	$bt->caption = '';
	$bt->w = 28;
	$bt->flat = true;
	$bt->hint = 'Load';
	$bt->onClick = function()use($combo, $memo){
		$file = __DIR__.'/scripts/'.$combo->intext.'.script';
		if(is_file($file)){
			message_beep(66);
			if(messageDlg('Не сохраненный скрипт будет потерян! Загрузить выбранный скрипт?', mtCustom, MB_YESNO) == mrNo)
				return;
			$memo->text = file_get_contents($file);
		}else{
			messageDlg('Скрипт не найден!', mtCustom, MB_OK);
			$combo->setFocus();
		}
	};
	if( is_file($file = __DIR__.'/img/load.png') )
		$bt->loadPicture($file);
	else
		$bt->caption = $bt->hint;
	
	// Кнопка DELETE, удаление выбранного скрипта
	$bt = new TSpeedButton($page);
	$bt->parent = $panel;
	$bt->align = alLeft;
	$bt->caption = '';
	$bt->w = 28;
	$bt->flat = true;
	$bt->hint = 'Delete';
	$bt->onClick = function()use($combo, $memo){
		$file = __DIR__.'/scripts/'.$combo->intext.'.script';
		if(is_file($file)){
			message_beep(66);
			if(messageDlg('Вы действительно хотите удалить выбранный скрипт?', mtCustom, MB_YESNO) == mrNo)
				return;
			unlink($file);
			dir_search(__DIR__.'/scripts/', $list, 'script', 0, 0);
			foreach($list as $k=>$v)
				$list[$k] = basenameNoExt($v);
			$combo->text = $list;
		}else{
			messageDlg('Скрипт не найден!', mtCustom, MB_OK);
			$combo->setFocus();
		}
	};
	if( is_file($file = __DIR__.'/img/delete.png') )
		$bt->loadPicture($file);
	else
		$bt->caption = $bt->hint;
	
	// Кнопка DO, выполнение выбранного скрипта из файла
	$bt = new TSpeedButton($page);
	$bt->parent = $panel;
	$bt->align = alRight;
	$bt->caption = '';
	$bt->w = 28;
	$bt->flat = true;
	$bt->hint = 'Do';
	$bt->onClick = function()use($combo, $memo){
		$file = __DIR__.'/scripts/'.$combo->intext.'.script';
		if(is_file($file)){
			file_put_contents(__DIR__.'/eval.tmp', $memo->text);
			$code = '$self = c('.$memo->self.');'.file_get_contents($file);
			if(@eval('return true;'.$code))
			{
				eval($code);
			} else {
				message_beep(66);
				messageDlg('Ошибка синтаксиса!', mtError, MB_OK);
			}
		}else{
			messageDlg('Скрипт не найден!', mtCustom, MB_OK);
			$combo->setFocus();
		}
	};
	if( is_file($file = __DIR__.'/img/do.png') )
		$bt->loadPicture($file);
	else
		$bt->caption = $bt->hint;
	
	// Кнопка ОК, сохранение скрипта
	$dlgEval->findComponent('button_save_ok')->onClick = function()use($dlgEval,$memo, $combo){
		$fname = $dlgEval->findComponent('edit_script_name')->text;
		if( trim($fname) <> ''){
			if(fileExt($fname) <> 'script')
				$fname .= '.script';
			$file = __DIR__.'/scripts/'.$fname;
			if(is_file($file)) {
				message_beep(66);
				if(messageDlg('Скрипт с таким именем уже существует! Заменить?', mtCustom, MB_YESNO) == mrNo)
					return;
			}
			file_put_contents($file, $memo->text);
			$dlgEval->hide();
		}else{
			messageDlg('Введите имя скрипта!', mtCustom, MB_OK);
			$dlgEval->findComponent('edit_script_name')->setFocus();
		}
	};
	
	// Отображение диалога сохранения скрипта
	$dlgEval->onShow = function()use($dlgEval){
		$dlgEval->findComponent('edit_script_name')->text = '';
		$dlgEval->findComponent('edit_script_name')->setFocus();};
	
	$dlgEval->findComponent('edit_script_name')->onKeyPress = function($self, &$key)use($dlgEval){
		$k = ord($key);
		if($k == 27){
			$bt = $dlgEval->findComponent('button_save_cancel');
			$bt->perform(513, 0, 0);
			$bt->perform(514, 0, 0);
		}elseif($k == 13){
			$bt = $dlgEval->findComponent('button_save_ok');
			$bt->perform(513, 0, 0);
			$bt->perform(514, 0, 0);
		}
	};
	
	// POPUP MENU
	$page->findComponent('it_eval_undo')->onClick = function()use($memo){$memo->undo();};
	$page->findComponent('it_eval_redo')->onClick = function()use($memo){$memo->redo();};
	$page->findComponent('it_eval_cut')->onClick = function()use($memo){$memo->cutToClipboard();};
	$page->findComponent('it_eval_copy')->onClick = function()use($memo){$memo->copyToClipboard();};
	$page->findComponent('it_eval_paste')->onClick = function()use($memo){$memo->pasteFromClipboard();};
	$page->findComponent('it_eval_delete')->onClick = function()use($memo){$memo->selText = '';};
	$page->findComponent('it_eval_selectall')->onClick = function()use($memo){$memo->selectAll();};
	$page->findComponent('it_eval_date_and_time')->onClick = function()use($memo){$memo->selText = date('d.m.Y H:i:s');};
	
	
	

	
	// functions Syn
	$cmp = $page->findComponent('evalSynCompletionProposal');
	eval_syn_setState($cmp);
	
	$memo->onKeyDown = function($self, &$key){c($self)->key = $key;};
	$memo->onChange = function($self)use($cmp){
		global $synState;
		$self = c($self);
		$line = $self->lineText;
		$x = $self->caretX;
		$str = substr($line, 0, $x-1);
		$chr1 = trim(substr($line, $x-2, 1));
		$chr2 = trim(substr($line, $x-3, 2));
		$chr3 = strtolower(trim(substr($line, $x-4, 3)));
		$chr4 = trim(substr($line, $x-4, 1));

		if(substr($line, -1, 2) == '->'){
		    $cmp->active();
		    $cmp->visible = true;
		}
		
		if(($cmp->get_empty() and $cmp->visible)
		or get_key_state(13) < 0 or get_key_state(9) < 0 or get_key_state(1) < 0 or $chr1 == ''
		or $chr1 == ')' or $chr1 == ']' or $chr1 == '}' or $chr1 == ';'){
		    $cmp->active(false);
		    $cmp->visible = false;
		    
		    if($synState)
		        eval_syn_setState($cmp);
		    /*else
		        switch($chr2){
		            case '()': case '[]': case '{}': case '""': case '\'\'':
		                $self->caretX -= 1;
		            break;
		        }*/
		}elseif(trim(chr($self->key)) > '' and trim($chr3) != '' or trim($str) != '' and $x > 0){
			if(!preg_match('/c\s*\(\s*[\'\"]+([->]*\w*)*'.$chr3.'/i', $str)){
		    	if($synState)
		    		eval_syn_setState($cmp);
			    $cmp->active();
			    $cmp->visible = true;
		    }
		}
		if($chr2 == '->'and preg_match('/\w/i', $chr4)){
			
			if(preg_match('/c\s*\(\s*[\'\"]+([->]*\w*)*'.$chr3.'/i', $str)){
		    	eval_syn_setState($cmp, 1, $str);
		    	$cmp->active();
		    	$cmp->visible = true;
		    }else{
		    	if($synState)
		    		eval_syn_setState($cmp);
		    }
		}elseif($chr2 == '->'and !preg_match('/\w/i', $chr4)){
		    if($synState)
		    	eval_syn_setState($cmp);
		}
		if($chr3 == 'c(\'' or $chr3 == 'c("'){
		    eval_syn_setState($cmp, 2, substr($chr3, -1, 1));
		}
	};
	function eval_syn_setState($cmp, $state=0, $str=false, $show=false){
	    global $synState;
	    $cmp->active(false);
	    $cmp->visible = false;
	    switch($state){
	        case 1:
	            $re = eval_syn_getControls($str);
	        break;
	        case 2:
	            $re = eval_syn_getForms($str);
	        break;
	    }
	    if(isset($re)){
	    if(count($re) > 0){
	        $synState = $state;
	    }else{
	        $synState = 0;
	        $re = array_merge_recursive(//eval_syn_getForms(),
	        		eval_syn_getGlobals(),
	        		eval_syn_getDefinedfunctions(),
	        		eval_syn_getDefinedConstants(),
	        		eval_syn_getDeclaredClasses());
		}
		}else{
	        $synState = 0;
	        $re = array_merge_recursive(//eval_syn_getForms(),
	        		eval_syn_getGlobals(),
	        		eval_syn_getDefinedfunctions(),
	        		eval_syn_getDefinedConstants(),
	        		eval_syn_getDeclaredClasses());
		}
		    $cmp->item = $re['item'];
		    $cmp->insert = $re['insert'];
	}

	function eval_syn_getForms($chr = "'"){
	    global $SCREEN;
	    $forms = $SCREEN->forms;
	    if(is_array($forms)){
	        foreach($forms as $form){
	            $class = get_class($form);

	            $name = ($form->name!=='')?$form->name:$form->self;
	            $re['item'][] = '\image{0} \style{+B}'.$name.'\style{-B}: \color{clRed}'.$class;
	            $re['insert'][] = 'c('.$chr.$name.'\')';
	            if($form->controlCount() > 0){
	                $re['item'][] = '\image{0} \style{+B}'.$name.'->\style{-B}: \color{clRed}'.$class;
	                $re['insert'][] = 'c('.$chr.$name.'->';}
	        }
	        return $re;
	    }
	    return false;
	}

	function eval_syn_getControls($str){
	    if(!$str) return false;
	    preg_match('/(?>c\s*\(\s*[\'\"]?(?:(?:\-\>)*\w+)*)*.*c\s*\(\s*([\'\"]?)((?:(?:\-\>)*\w+)*)/i', $str, $preg);
	    $chr = $preg[1];
	    $parent = c($preg[2]);
	    if(!is_a($parent, 'debugclass')){
	        $list = $parent->componentList;
	        if(count($list) < 1)
	        	$list = $parent->controlList;
	        if(is_array($list)){
	            foreach($list as $obj){
	                if(is_object($obj)){
	                    $class = get_class($obj);

	                        $name = ($obj->name!=='')?$obj->name:$obj->self;
	                    $re['item'][] = '\image{0} \style{+B}'.$name.'\style{-B}: \color{clRed}'.$class;
	                    $re['insert'][] = $name.$chr.')';

	                    if($obj->controlCount() > 0){
	                        $re['item'][] = '\image{0} \style{+B}'.$name.'->\style{-B}: \color{clRed}'.$class;
	                        $re['insert'][] = $name.'->';}
	                }
	            }
	            return $re;
	        }
	    }
	    return false;
	}

	function eval_syn_getDefinedConstants(){
	    $const = get_defined_constants();
	    if(is_array($const)){
	        foreach($const as $n=>$v){
	            $re['item'][] = '\image{2} \color{clGray}define \color{clBlack}\style{+B}'.$n.'\style{-B}';
	            $re['insert'][] = $n;
	        }
	        return $re;
	    }
	    return false;
	}

	function eval_syn_getDefinedfunctions(){
	    $func = get_defined_functions();
	    if(is_array($func)){
	        $arr = array_merge($func['internal'],$func['user']);
	        sort($arr);
	        foreach($arr as $f){
	            $re['item'][] = '\image{3} \style{+B}'.$f.'\style{-B}';
	            $re['insert'][] = $f.'()';
	        }
	        return $re;
	    }
	    return false;
	}

	function eval_syn_getGlobals(){
	    $arr = array_keys($GLOBALS);
	    if(is_array($arr)){
	        sort($arr);
	        foreach($arr as $n){
	            $re['item'][] = '\image{1} \color{clGray}global \color{clBlack}\style{+B}'.$n.'\style{-B}';
	            $re['insert'][] = '$'.$n;
	        }
	        return $re;
	    }
	    return false;
	}

	function eval_syn_getDeclaredClasses(){
	    $class = get_declared_classes();
	    if(is_array($class)){
	        sort($class);
	        foreach($class as $n){
	            $n = trim($n);
	            if($n <> '' and class_exists($n)){
	                $re['item'][] = '\image{4} \color{clGray}class \color{clBlack}\style{+B}'.$n.'\style{-B}';
	                $re['insert'][] = $n;}
	        }
	        return $re;
	    }
	    return false;
	}