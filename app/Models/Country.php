<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BaseConfig;
use App\Services\ImageService;
use App\Models\Foto;
use App\Traits\TStr;

class Country extends Model
{
	use HasFactory, BaseConfig, TStr;

	const IMAGES_DIRECTORY	= 'images/country';

	public $boardConfig = [];
	protected $fillable = [
		'name',
		'slug',
		'description',
		'image'
	];
	public $timestamps		= false;
	protected $primaryKey 	= 'id';

	/**
	* Create a new controller instance.
	*
	* @return void
	*/
	public function __construct()
	{
		$this->boardConfig = $this->getBoardConfig();
	}

	public function getCountriesDescriptionAttribute($val)
	{
		return $this->replaceSpaces($val);
	}

	public function getCountriesShortDescriptionAttribute()
	{
		return $this->description;
	}

	public function getImagePathAttribute()
	{
		return self::IMAGES_DIRECTORY . ImageService::SEPARATOR . $this->image;
	}
	

	public function getCountriesImgAttribute()
	{
		$foto = asset('fotos/countries/'. $this['foto']['foto_id'] . '.jpg');
		return !empty($foto) ? '<img title="' . $this['name'] . '" alt="' . $this['name'] . '" src="' . $foto . '" width="' . $this->boardConfig['foto_width_country_id'] . '" height="' . $this->boardConfig['foto_height_country_id'] . '">' : '';
	}

	/**
	* get fotos
	*/
	public function fotos()
	{
		return $this->hasMany(Foto::class, 'foto_parent_id', 'id');
	}
}