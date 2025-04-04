<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Events\RemoveItemCache;
use App\Providers\SapeServiceProvider;
use App\Models\Picture;

class Item extends Model
{
	use HasFactory;

	const IMAGES_DIRECTORY	= 'images/item';
	const IMAGES_TYPE		= 'item';
	const CASHE_TIME		= 60 * 60 * 24 * 7; //1 week

	public $timestamps		= false;
	protected $fillable		= [
		'id',
		'create_time',
		'name',
		'description'
	];

	protected $dispatchesEvents = [
		'updating' => RemoveItemCache::class,
		'deleting' => RemoveItemCache::class
	];

	public function getFirstImagePathAttribute()
	{
		if ($this->pictures->count() == 0 || $this->pictures[0] == null) return null;
		return $this->pictures[0]->image_path;
	}

	public function getDescriptionAttribute($val)
	{
		return SapeServiceProvider::replaceSapeCode($val);
	}

	/**
	 * get pictures
	 */
	public function pictures()
	{
		return $this->hasMany(Picture::class, 'parent_id', 'id')->where('type', 'item');
	}
}
