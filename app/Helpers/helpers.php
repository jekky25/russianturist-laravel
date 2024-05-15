<?php

use Illuminate\Support\Facades\DB;
use App\Models\Config;
use \Illuminate\Support\Str;

if (!function_exists('cutText')) {

    /**
     * cuts long text
     * 
     * @param string $txt
     * @param int $lenght
     * 
     * @return string
     */
	function cutText($txt, $lenght = 0) {
        $txt = Str::limit($txt, $lenght, $end='...');
        return $txt;
    }
}