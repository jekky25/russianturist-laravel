<?php

use Illuminate\Support\Facades\DB;
use App\Models\Config;
use \Illuminate\Support\Str;

if (!function_exists('getBoardConfig')) {
    /**
     * get settings from the Config model
     *
     * @return array
     */
	function getBoardConfig() {
        $arConfig = Config::select('*')->get()->toArray();
        if (empty($arConfig)) return [];
        $config = [];
        foreach ($arConfig as $item)
        {
            $config [$item['name']] = $item['value'];
        }
        return $config;
    }
}

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