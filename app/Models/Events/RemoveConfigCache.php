<?php

namespace App\Models\Events;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\CacheKeys;

class RemoveConfigCache
{
	public function __construct(Model $model)
	{
		\Cache::forget(CacheKeys::configById($model->id));
		\Cache::forget(CacheKeys::configAll());
	}
}
