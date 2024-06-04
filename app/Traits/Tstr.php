<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

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