<?php
###############################################################
## Автор: Странник											 ##
## http://community.develstudio.ru/member.php/5145-Странник	 ##
## V0.1														 ##
###############################################################

################################################## 
#### Универсальная функция для создания синтаксиса
################################################## 
Function TSynT($self, $SynTactics, $Syn) {
    eval('
        $SynH = new TSyn'.$Syn.'Syn($self);
    ');

    foreach(array_keys($SynTactics) as $v) {
        $a = $SynH->getAttri($v);
		$a->style = $SynTactics[$v]['style'];
        $a->background = $SynTactics[$v]['background'];
        $a->foreground = $SynTactics[$v]['foreground'];
    }
	unset($a, $self, $SynTactics, $Syn, $v);
return $SynH;
}

##################################################
#### Нсатроим синтаксис для удобства
################################################## 
Function TSynHighlighter($self, $B) {
    switch($B[0]) {

		#######################
		## Синтаксис HTML
		#######################
        case 'HTML':
            $s = TSynT($self, array(
                    'And' => array('style' => 'fsBold', 'background' => clNone, 'foreground' => clLime),
                    'Comment' => array('style' => 'fsItalic', 'background' => clNone, 'foreground' => clGray),
                    'Identifier' => array('style' => 'fsBold', 'background' => clNone, 'foreground' => clNavy),
                    'key' => array('style' => 'fsBold', 'background' => clNone, 'foreground' => 16711808),
                    'Space' => array('style' => '', 'background' => clNone, 'foreground' => clNone),
                    'Symbol' => array('style' => '', 'background' => clNone, 'foreground' => clNavy),
                    'Text' => array('style' => '', 'background' => clNone, 'foreground' => 0),
                    'UndefKey' => array('style' => 'fsBold', 'background' => clNone, 'foreground' => clRed),
                    'Value' => array('style' => '', 'background' => clNone, 'foreground' => 16744448)
            ), $B[0]);
        break;

		#######################
		## Синтаксис PHP
		#######################
        case 'PHP':
            $s = TSynT($self, array(
                    'Comment' => array('style' => '', 'background' => 0xffffff, 'foreground' => 0x7c7c7c),
                    'Identifier' => array('style' => '', 'background' => 0xffffff, 'foreground' => 0),
                    'key' => array('style' => '', 'background' => 0xffffff, 'foreground' => 0x804000),
                    'Number' => array('style' => '', 'background' => 0xffffff, 'foreground' => 0xae5700),
                    'Space' => array('style' => '', 'background' => 0xffffff, 'foreground' => 236457567),
                    'String' => array('style' => '', 'background' => 0xffffff, 'foreground' => 0x4080),
                    'Symbol' => array('style' => '', 'background' => 0xffffff, 'foreground' => 0xff),
                    'Variable' => array('style' => '', 'background' => 0xffffff, 'foreground' => 43534)
            ), $B[0]);
        break;
        
		#######################
		## Синтаксис General
		#######################
        case 'General':
            $s = TSynT($self, array(
                    'Comment' => array('style' => '', 'background' => 0xffffff, 'foreground' => 456457),
                    'Identifier' => array('style' => '', 'background' => 0xffffff, 'foreground' => 767867),
                    'Number' => array('style' => '', 'background' => 0xffffff, 'foreground' => 3236346),
                    'Preprocessor' => array('style' => '', 'background' => 0xffffff, 'foreground' => 5675674),
                    'Space' => array('style' => '', 'background' => 0xffffff, 'foreground' => 236457567),
                    'String' => array('style' => '', 'background' => 0xffffff, 'foreground' => 23645768),
                    'Symbol' => array('style' => '', 'background' => 0xffffff, 'foreground' => 6575464)
            ), $B[0]);
        break;

		#######################
		## Синтаксис Cpp
		#######################
        case 'Cpp':
            $s = TSynT($self, array(
                    'Asm' => array('style' => '', 'background' => 0xffffff, 'foreground' => 456457),
                    'Char' => array('style' => '', 'background' => 0xffffff, 'foreground' => 767867),
                    'Comment' => array('style' => '', 'background' => 0xffffff, 'foreground' => 3236346),
                    'Direc' => array('style' => '', 'background' => 0xffffff, 'foreground' => 5675674),
                    'Identifier' => array('style' => '', 'background' => 0xffffff, 'foreground' => 236457567),
                    'Invalid' => array('style' => '', 'background' => 0xffffff, 'foreground' => 23645768),
                    'key' => array('style' => '', 'background' => 0xffffff, 'foreground' => 6575464),
                    'Number' => array('style' => '', 'background' => 0xffffff, 'foreground' => 436457),
                    'Octal' => array('style' => '', 'background' => 0xffffff, 'foreground' => 436457),
                    'Space' => array('style' => '', 'background' => 0xffffff, 'foreground' => 436457),
                    'String' => array('style' => '', 'background' => 0xffffff, 'foreground' => 436457),
                    'Symbol' => array('style' => '', 'background' => 0xffffff, 'foreground' => 436457)
            ), $B[0]);
        break;
		
		###############################################################
		## Синтаксис Css, с ImportantProperty не работает баг наверное.
		###############################################################
        case 'Css':
            $s = TSynT($self, array(
                    'Color' => array('style' => '', 'background' => clNone, 'foreground' => clNone),
                    'Comment' => array('style' => '', 'background' => clNone, 'foreground' => clGray),
                    //'ImportantProperty' => array('style' => '', 'background' => clNone, 'foreground' => clRed),
                    'key' => array('style' => 'fsBold', 'background' => clNone, 'foreground' => clNavy),
                    'Number' => array('style' => '', 'background' => clNone, 'foreground' => clFuchsia),
                    'Property' => array('style' => 'fsBold', 'background' => clNone, 'foreground' => clNone),
                    'Space' => array('style' => '', 'background' => clNone, 'foreground' => clNone),
                    'String' => array('style' => 'fsBold', 'background' => clNone, 'foreground' => clBlue),
                    'Symbol' => array('style' => 'fsBold', 'background' => clNone, 'foreground' => clNavy),
                    'Text' => array('style' => '', 'background' => clNone, 'foreground' => clNone),
                    'UndefProperty' => array('style' => 'fsBold', 'background' => clNone, 'foreground' => 16711808),
                    'Value' => array('style' => '', 'background' => clNone, 'foreground' => 16744448)
            ), $B[0]);
        break;
		
		#######################
		## Синтаксис SQL
		#######################
        case 'SQL':
            $s = TSynT($self, array(
                    'Comment' => array('style' => '', 'background' => 0xffffff, 'foreground' => 5467457),
                    'ConditionalComment' => array('style' => '', 'background' => 0xffffff, 'foreground' => 457456436),
                    'DataType' => array('style' => '', 'background' => 0xffffff, 'foreground' => 78657546),
                    'DefaultPackage' => array('style' => '', 'background' => 0xffffff, 'foreground' => 2342657568),
                    'DelimitedIdentifier' => array('style' => '', 'background' => 0xffffff, 'foreground' => 54756856),
                    'Exception' => array('style' => '', 'background' => 0xffffff, 'foreground' => 32457568),
                    'Function' => array('style' => '', 'background' => 0xffffff, 'foreground' => 78657546),
                    'Identifier' => array('style' => '', 'background' => 0xffffff, 'foreground' => 54756858),
                    'Key' => array('style' => '', 'background' => 0xffffff, 'foreground' => 76543453),
                    'Number' => array('style' => '', 'background' => 0xffffff, 'foreground' => 554575435),
                    'PLSQL' => array('style' => '', 'background' => 0xffffff, 'foreground' => 364745532),
                    'Space' => array('style' => '', 'background' => 0xffffff, 'foreground' => 547123),
                    'SQLPlus' => array('style' => '', 'background' => 0xffffff, 'foreground' => 23457234),
                    'String' => array('style' => '', 'background' => 0xffffff, 'foreground' => 1243645),
                    'Symbol' => array('style' => '', 'background' => 0xffffff, 'foreground' => 77843223),
                    'TableName' => array('style' => '', 'background' => 0xffffff, 'foreground' => 234342645),
                    'Variable' => array('style' => '', 'background' => 0xffffff, 'foreground' => 456456457)
            ), $B[0]);
        break;

		#######################
		## Синтаксис JScript
		#######################
        case 'JScript':
            $s = TSynT($self, array(
                    'Comment' => array('style' => 'fsItalic', 'background' => clNone, 'foreground' => clGray),
                    'Event' => array('style' => '', 'background' => clNone, 'foreground' => clNone),
                    'Identifier' => array('style' => 'fsBold', 'background' => clNone, 'foreground' => clTeal),
                    'Key' => array('style' => 'fsBold', 'background' => clNone, 'foreground' => clPurple),
                    'NonReservedKey' => array('style' => '', 'background' => clNone, 'foreground' => clNone),
                    'Number' => array('style' => '', 'background' => clNone, 'foreground' => clRed),
                    'Space' => array('style' => '', 'background' => clNone, 'foreground' => clNone),
                    'String' => array('style' => '', 'background' => clNone, 'foreground' => clBlue),
                    'Symbol' => array('style' => 'fsBold', 'background' => clNone, 'foreground' => clGreen)
            ), $B[0]);
        break;
        
		#######################
		## Синтаксис XML
		#######################
        case 'XML':
            $s = TSynT($self, array(
                    'Attribute' => array('style' => '', 'background' => clNone, 'foreground' => clMaroon),
                    'AttributeValue' => array('style' => 'fsBold', 'background' => clNone, 'foreground' => clNavy),
                    'CDATA' => array('style' => 'fsItalic', 'background' => clNone, 'foreground' => clOlive),
                    'Comment' => array('style' => 'fsBold,fsItalic', 'background' => clNone, 'foreground' => clGray),
                    'DocType' => array('style' => 'fsItalic', 'background' => clNone, 'foreground' => clBlue),
                    'Element' => array('style' => 'fsBold', 'background' => clNone, 'foreground' => clMaroon),
                    'EntityRef' => array('style' => 'fsBold', 'background' => clNone, 'foreground' => clBlue),
                    'NamespaceAttribute' => array('style' => '', 'background' => clNone, 'foreground' => clRed),
                    'NamespaceAttributeValue' => array('style' => 'fsBold', 'background' => clNone, 'foreground' => clRed),
                    'ProcessingInstruction' => array('style' => '', 'background' => clNone, 'foreground' => clBlue),
                    'Space' => array('style' => '', 'background' => clNone, 'foreground' => clNone),
                    'Symbol' => array('style' => '', 'background' => clNone, 'foreground' => clBlue),
                    'Text' => array('style' => '', 'background' => clNone, 'foreground' => clBlack)
            ), $B[0]);
        break;
		
		default: 
			unset($B, $self);
			break;
    }

	#####################################
	## Присвоим имя или это будет все зря
	#####################################
	if(!empty($s) && !empty($B)) {
		$s->name = $B[1];
	}

    unset($s, $B, $self);
}

################################################################################################
#### функция для применения синтаксиса как парметр highlighter  не принимает значения и всегда 0
################################################################################################
Function highlighterSynEdit($self, $highlighter) {
    gui_readstr(c($self)->self, 'object '.$self.': TSynEdit
        highlighter = '.$highlighter.'
    end
');
}

?>