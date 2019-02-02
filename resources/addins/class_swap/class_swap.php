<?
// CLASS BY WINRAR
// www.vk.com/id10947798
// VERSION beta 0.1


class swappanel{

	public $w = 300;
	public $h = 150;
	public $x = 0;
	public $y = 0;
	public $color = 131586;
	public $colortab = 16777215;
	public $colorselect = 16777215;
	public $colorbox = 12632256;
	private $id = array();
	private $tabs = array();

	Function NewPanel($form)
	{
		global $CLASSSWAPPANEL;

		$panel = new TPanel();
		$panel->text = "";
		$panel->bevelOuter = bvNone;
		$panel->x = $this->x;
		$panel->y = $this->y;
		$panel->w = $this->w;
		$panel->h = $this->h;
		$panel->doubleBuffered = 1;
		$panel->parent = $form;
		$CLASSSWAPPANEL[$panel->self] = $panel->self;

		$fon = new TShape();
		$fon->brushcolor = $this->colorbox;
		$fon->w = $this->w;
		$fon->h = $this->h;
		$fon->parent = $panel;
		$fon->penStyle = psClear;

		$box = new TScrollBox();
		$box->parent = $panel;
		$box->h = $this->h - 24;
		$box->y += 24;
		$box->x = 0;
		$box->w = $this->w;
		$box->doubleBuffered = 1;
		$box->autoScroll = 0;

		$select = new TShape;
		$select->brushcolor = $this->colorselect;
		$select->h = 24;
		$select->y = 0;
		$select->w = 100;
		$select->x = 0;
		$select->penStyle = psClear;
		$select->visible = 0;
		$select->parent = $panel;

		$this->id = array($panel,$box,$select);

		$panel->data_id = $this->id;
		$panel->tabs = $this->tabs;


		return $panel;

	}

	Function NewTab($caption){
		$panel = $this->id['0'];
		$box = $this->id['1'];
		$select = $this->id['2'];

		if(count($this->tabs)==0)
		{

			$x_tab = 0;
			$x_text = 0;
			$select->visible = 1;

		}
		else
		{

			$x_tab = count($this->tabs)*$this->w;
			$x_text = count($this->tabs)*100;

		}

		$tab = new TPanel();
		$tab->text = "";
		$tab->bevelOuter = bvNone;
		$tab->x = $x_tab;
		$tab->y = 0;
		$tab->doubleBuffered = 1;
		$tab->w = $this->w;
		$tab->h = $this->h - 24;
		$tab->parent = $box;

		$text = new TLabel();
		$text->id = count($this->tabs);
		$text->autosize = 0;
		$text->x = $x_text;
		$text->data = $panel->self;
		$text->y = 0;
		$text->w = 100;
		$text->h = 24;
		$text->caption = $caption;
		$text->alignment = taCenter;
		$text->layout = tlCenter;
		$text->font->color = $this->color;
		$text->parent = $panel;
		$text->onClick = function($self){
			global $CLASSSWAPPANEL,$THISSWAP;

			$panel = $CLASSSWAPPANEL[ c($self)->data ];
			$id = c($panel)->data_id;
			$tabs = c($panel)->tabs;
			$select = $id['2'];
			$count = count($tabs);
			$dataw = $tabs[0][0]->w;
			$datah = $tabs[0][0]->h;
			$text = c($self);
			if($select->x != 0)
			$this_select = $select->x / 100;
			else $this_select = 0;

			if($this_select < $text->id and $this_select != $text->id)
			{

				$count_move = $text->id - $this_select;
				$count_w_tabs = ($dataw*$count_move)/20;
				$count_w_text = (100*$count_move)/20;
				Timer::setInterval(function($timer) use ($panel,$id,$tabs,$select,$select,$count_w_tabs,$count_w_text){

					global $CLASSSWAPPANEL,$i_SWAP;
						$cc = count($tabs);
						for($z=0;$z<$cc;$z++)
						{
							$tabs[$z][0]->x -= $count_w_tabs;
						}
						$select->x += $count_w_text;
					if($i_SWAP == 19){
					Timer::ClearTimer($timer);
					$i_SWAP = -1;
					}

					$i_SWAP++;

				},15);


			}
			else
			{
				$count_move = $this_select - $text->id;
				$count_w_tabs = ($dataw*$count_move)/20;
				$count_w_text = (100*$count_move)/20;
				Timer::setInterval(function($timer) use ($panel,$id,$tabs,$select,$select,$count_w_tabs,$count_w_text){

					global $CLASSSWAPPANEL,$i_SWAP;
						$cc = count($tabs);
						for($z=0;$z<$cc;$z++)
						{
							$tabs[$z][0]->x += $count_w_tabs;
						}
						$select->x -= $count_w_text;
					if($i_SWAP == 19){
					Timer::ClearTimer($timer);
					$i_SWAP = -1;
					}

					$i_SWAP++;

				},15);

			}



		};

		$ar = $this->tabs;
		$ar[][0] = $tab;
		$ar[count($ar)-1][1] = $text;
		$this->tabs = $ar;
		//pre($this->tabs);

		$panel->data_id = $this->id;
		$panel->tabs = $this->tabs;
		return $tab;

	}

}


?>