<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Events\RemoveHotelCache;
use Illuminate\Database\Eloquent\Model;
use App\Providers\SapeServiceProvider;

class Hotel extends Model
{
	use HasFactory;

	const IMAGES_DIRECTORY	= 'images/hotel';
	const IMAGES_TYPE		= 'hotel';
	const STARS				= [1, 2, 3, 4, 5];
	const CASHE_TIME		= 60 * 60; //1 hour

	public $timestamps		= false;
	protected $fillable		= [
		'city_id',
		'country_id',
		'create_time',
		'name',
		'slug',
		'description',
		'stars'
	];

	protected $dispatchesEvents = [
		'updating' => RemoveHotelCache::class,
		'deleting' => RemoveHotelCache::class
	];

	public function getDescriptionAttribute($val)
	{
		return SapeServiceProvider::replaceSapeCode($val);
	}

	public function getFirstImagePathAttribute()
	{
		if ($this->pictures->count() == 0) return null;
		return $this->pictures[0]->image_path;
	}

	/**
	 * get pictures
	 */
	public function pictures()
	{
		return $this->hasMany(Picture::class, 'parent_id', 'id')->where('type', 'hotel');
	}

	/**
	 * get city
	 */
	public function city()
	{
		return $this->belongsTo(City::class, 'city_id', 'id');
	}
}
