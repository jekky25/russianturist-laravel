<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Events\RemoveCountryCache;
use App\Services\ImageService;
use App\Traits\BaseConfig;
use App\Models\Picture;
use App\Traits\TStr;

class Country extends Model
{
	use HasFactory, BaseConfig, TStr;

	const IMAGES_DIRECTORY	= 'images/country';
	const CASHE_TIME		= 60*60; //1 hour

	protected $table = 'countries';
	public $boardConfig = [];
	protected $fillable = [
		'name',
		'slug',
		'description',
		'image'
	];
	public $timestamps		= false;
	protected $primaryKey 	= 'id';

	protected $dispatchesEvents = [
        'updating' => RemoveCountryCache::class,
		'deleting' => RemoveCountryCache::class
    ];

	/**
	* Create a new controller instance.
	*
	* @return void
	*/
	public function __construct(array $attributes = [])
	{
		parent::__construct($attributes);
		$this->boardConfig = $this->getBoardConfig();
	}

	public function getShortDescriptionAttribute()
	{
		return $this->description;
	}

	public function getImagePathAttribute()
	{
		return 'storage' . ImageService::SEPARATOR . self::IMAGES_DIRECTORY . ImageService::SEPARATOR . $this->image;
	}
	

	public function getImgAttribute()
	{
		$picture = asset($this->image_path);
		return !empty($this->image) ? '<img title="' . $this['name'] . '" alt="' . $this['name'] . '" src="' . $picture . '" width="' . $this->boardConfig['picture_width_country_id'] . '" height="' . $this->boardConfig['picture_height_country_id'] . '">' : '';
	}

	/**
	* get pictures
	*/
	public function pictures()
	{
		return $this->hasMany(Picture::class, 'parent_id', 'id');
	}
}