<?php
namespace App\Helpers;
use Illuminate\Support\Str;

class Helper {
    /**
	 * cuts long text
	 * 
	 * @param string $txt
	 * @param int $lenght
	 * 
	 * @return string
	 */
	public static function cutText($txt, $lenght = 0) 
    {
		return Str::limit($txt, $lenght, $end='...');
    }
}