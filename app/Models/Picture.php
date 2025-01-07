<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\ImageService;

class Picture extends Model
{
	use HasFactory;

	const ITEM		= 'item';
	const HOTEL		= 'hotel';
	const COUNTRY	= 'country';
	const CITY		= 'city';

	const OLD_DIR_PICTURES = 'fotos';
	const START_SORT = '10';

	public $timestamps		= false;
	protected $fillable = [
		'parent_id',
		'position',
		'type',
		'image'
	];
	protected $primaryKey 	= 'id';

	/**
	* get a list of the storage sections folders
	*
	* @return array
	*/
	public static function getStorageSections()
	{
		return [
			self::ITEM		=> 'images/item',
			self::HOTEL		=> 'images/hotel',
			self::COUNTRY	=> 'images/country',
			self::CITY		=> 'images/city',
		];
	}

	/**
	* get a storage section folder
	*
	* @param string $name
	* @return string
	*/
	public function getStorageSectionByName($name)
	{
		return self::getStorageSections()[$name];
	}

	/**
	* get a path with old pictures
	*
	* @return string
	*/
	public function getOldPathPicture()
	{
		return $_SERVER['DOCUMENT_ROOT'] . ImageService::SEPARATOR . self::OLD_DIR_PICTURES . ImageService::SEPARATOR . $this->type . 's' . ImageService::SEPARATOR . $this->id . '.jpg';
	}

	public function getImagePathAttribute()
	{
		if (empty($this->image)) 
		{
			ImageService::copyFromOldToNewFormat($this);
		}
		return 'storage' . ImageService::SEPARATOR . $this->getStorageSectionByName($this->type) . ImageService::SEPARATOR . $this->image;

	}

	/**
	* get hotel
	*/
	public function hotel()
	{
		return $this->belongsTo(Hotel::class);
	}
}
