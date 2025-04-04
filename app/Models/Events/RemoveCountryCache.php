<?php

namespace App\Models\Events;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\CacheKeys;

class RemoveCountryCache
{
	public function __construct(Model $model)
	{
		\Cache::forget(CacheKeys::countryById($model->id));
		\Cache::forget(CacheKeys::countryByName($model->slug));
	}
}
