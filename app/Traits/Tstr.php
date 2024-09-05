<?php

namespace App\Traits;

trait TStr {

	/**
	* replace spaces
	* @param  string  $str
	* @return string
	*/
	public function replaceSpaces($str) {
		return str_replace("\n", "\n<br />\n", $str);
	}
}