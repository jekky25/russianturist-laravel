<?php

namespace App\Models\Events;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\CacheKeys;

class RemoveHotelCache
{
	public function __construct(Model $model)
	{
		\Cache::forget(CacheKeys::hotelById($model->id));
		\Cache::forget(CacheKeys::hotelByName($model->slug));
	}
}
