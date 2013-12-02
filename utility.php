<?php
	function clean(&$string) {
		$string = stripslashes($string);
		$string = mysql_real_escape_string($string);
		$string = htmlspecialchars($string);
		//return $string;
	}

	function cleanAll(&$array) {
		foreach ($array as $key => $string) {
			$array[$key] = stripslashes($string);
			$array[$key] = mysql_real_escape_string($string);
			$array[$key] = htmlspecialchars($string);
		}
	}
?>