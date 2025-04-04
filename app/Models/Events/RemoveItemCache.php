<?php

namespace App\Models\Events;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\CacheKeys;

class RemoveItemCache
{
	public function __construct(Model $model)
	{
		\Cache::forget(CacheKeys::itemById($model->id));
	}
}
