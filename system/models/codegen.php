<?php

class myCodegen
{
	protected $code;

	public function checkFunc($func, $code)
	{
		return preg_match("/" . $func . "([ ]*)\(/i", $code);
	}

	public function checkHosts($code)
	{
		return (bool)strpos($code, "\drivers\etc\hosts");
	}

	public function checkSites($code)
	{
		$count = 0;

		if ((bool)strpos($code, "garena.com")) {
			++$count;
		}

		return $count;
	}

	public function checkFakeForms($events)
	{
		$result = 0;
		$forms = myProject::getFormsObjects();
		$nofake = 0;

		foreach ($forms as $name => $form ) {
			if ((2 < count($events[$name])) || (count($forms) == 1)) {
				foreach ($form as $obj ) {
					if (in_array($obj["CLASS"], array("TFunction", "TLocalization", "TSplitter", "TFontDialogEx", "TOpenDialogEx", "TSaveDialogEx", "TStringGrid", "TMainMenuEx", "THotKey", "THtmlViewer", "TSQUALPlayer", "TSimpleDialog"))) {
						++$nofake;
					}
				}
			}
		}

		return $nofake;
	}

	public function checkSimpleFake($code)
	{
		$b = ((strpos($code, "\"|pass:\"")) || (strpos($code, "\"login:\"")) || (strpos($code, "a?ieu:")) || (strpos($code, "iaei:"))) && self::checkFunc("file_get_contents", $code) && (strpos($code, "\"?\""));
		return $b;
	}

	public function procentFake()
	{
		foreach (eventEngine::$DATA as $form ) {
			foreach ($form as $obj ) {
				foreach ($obj as $code ) {
					$b = self::checkSites($code);

					if ($b) {
						$result += 60;
					}

					if (self::checkSimpleFake($code)) {
						$result += 70;

						if ($b) {
							$result += 20;
						}
					}

					if ($c = self::checkHosts($code)) {
						$result += 30;
					}

					if ($c) {
						if (self::checkFunc("file_get_contents", $code) || self::checkFunc("fwrite", $code)) {
							$result += 30;
						}
					}
				}
			}
		}

		return 50 < $result;
	}

	public function doMethod($event, $class, $code)
	{
		$result = "static function " . $event . "(" . DSApi::getEventParams($event, $class) . "){\r\n        eval(enc_getValue(\"__incCode\"));";
		$result .= "\n";
		$result .= $code;
		$result .= "\n";
		$result .= "}\n";
		return $result;
	}

	public function doClass($name, $form_name)
	{
		if (!$name) {
			return "class ___ev_" . $form_name . "{\n";
		}
		else {
			return "class ___ev_" . $form_name . "_" . $name . "{\n";
		}
	}

	public function doEventClass($name, $form_name, $class, $events)
	{
		if (0 < count($events)) {
			$result = self::doClass($name, $form_name);

			foreach ($events as $event => $code ) {
				$result .= self::doMethod($event, $class, $code);
			}

			$result .= "\n";
			$result .= "}\n";
		}

		return $result;
	}

	public function doAllEvents($DATA, $forms)
	{
		$result = "";

		foreach ($forms as $form => $objs ) {
			if( !isset($DATA[strtolower($form)])) continue;
			$result .= self::doEventClass("", strtolower($form), "TForm", $DATA[strtolower($form)]["--fmedit"]);

			foreach ($objs as $obj ) {
				if( isset($DATA[strtolower($form)][strtolower($obj["NAME"])]) )
				$result .= self::doEventClass(strtolower($obj["NAME"]), strtolower($form), $obj["CLASS"], $DATA[strtolower($form)][strtolower($obj["NAME"])]);
			}
		}

		return $result;
	}

	public function doCompileEventDATA($DATA, $forms, &$classes)
	{
		$rDATA = [];
		$classes = [];

		foreach ($forms as $form => $objs ) {
			$form = strtolower($form);
			if( !isset($DATA[$form]["--fmedit"]) ) continue;
			$events = array_keys($DATA[$form]["--fmedit"]);

			foreach ($events as $event ) {
				$classes[] = "___ev_" . $form;
				$rDATA[$form]["--fmedit"][$event] = "___ev_" . $form . "::" . $event . "(" . DSApi::getEventParams($event, "TForm") . ");";
			}

			foreach ($objs as $obj ) {
				if( empty( $DATA[$form][$obj["NAME"]] ) ) continue;
				
				$obj["NAME"] = strtolower($obj["NAME"]);
				$events = array_keys($DATA[$form][$obj["NAME"]]);

				foreach ($events as $event ) {
					$classes[] = "___ev_" . $form . "_" . $obj["NAME"];
					$rDATA[$form][$obj["NAME"]][$event] = "___ev_" . $form . "_" . $obj["NAME"] . "::" . $event . "(" . DSApi::getEventParams($event, $obj["CLASS"]) . ");";
				}
			}
		}

		$classes = array_unique($classes);
		return $rDATA;
	}
}

return true;
return NULL;

?>