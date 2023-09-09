<?php

use Illuminate\Support\Facades\DB;
use App\Models\Config;

if (!function_exists('getBoardConfig')) {
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
	function cutText($txt, $lenght = 0) {
        $txt = strlen($txt) > $lenght ? (mb_substr($txt, 0, $lenght, 'UTF-8') . ' ...') : $txt;
        return $txt;
    }
}

//$GLOBALS['board_config'] = Config::select('*')->get();
/*
$row = DB::table('vars') 
		->select('*')
		->get()
		->toArray();
*/
//dd ($GLOBALS['board_config']);