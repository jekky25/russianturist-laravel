<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Config;

trait BaseConfig {

    /**
     * get settings from the Config model
     *
     * @return array
     */
	public function getBoardConfig() {
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