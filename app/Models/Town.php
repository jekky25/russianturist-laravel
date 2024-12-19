<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Providers\SapeServiceProvider;
use App\Models\Foto;

class Town extends Model
{
	use HasFactory;

	const IMAGES_DIRECTORY	= 'images/city';
	const IMAGES_TYPE		= 'town';

	public $timestamps		= false;
	protected $fillable		= [
		'country_id',
		'name',
		'slug',
		'description',
	];

	public function getTownsDescriptionAttribute ($val)
	{
		return SapeServiceProvider::replaceSapeCode($val);
	}

	/**
	* get fotos
	*/
	public function fotos()
	{
		return $this->hasMany(Foto::class, 'parent_id', 'id')->where('type', 'town');
	}

	/**
	* get country
	*/
	public function country()
	{
		return $this->belongsTo(Country::class, 'country_id', 'id');
	}
}