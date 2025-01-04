<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Providers\SapeServiceProvider;
use App\Models\Foto;

class City extends Model
{
	use HasFactory;

	const IMAGES_DIRECTORY	= 'images/city';
	const IMAGES_TYPE		= 'city';

	public $timestamps		= false;
	protected $fillable		= [
		'country_id',
		'name',
		'slug',
		'description',
	];

	public function getDescriptionAttribute($val)
	{
		return SapeServiceProvider::replaceSapeCode($val);
	}

	public function getFirstImagePathAttribute()
	{
		if ($this->fotos->count() == 0) return null;
		return $this->fotos[0]->image_path;
	}

	/**
	* get fotos
	*/
	public function fotos()
	{
		return $this->hasMany(Foto::class, 'parent_id', 'id')->where('type', 'city');
	}

	/**
	* get country
	*/
	public function country()
	{
		return $this->belongsTo(Country::class, 'country_id', 'id');
	}
}