<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Providers\SapeServiceProvider;

use App\Models\Foto;

class Town extends Model
{
	use HasFactory;

	public function getTownsDescriptionAttribute ($val)
	{
		return SapeServiceProvider::replaceSapeCode($val);
	}

	/**
	* get fotos
	*/
	public function fotos()
	{
		return $this->hasMany(
			Foto::class,
			'parent_id',
			'id');
	}

	/**
	* get country
	*/
	public function country()
	{
		return $this->belongsTo(Country::class, 'country_id', 'id');
	}
}