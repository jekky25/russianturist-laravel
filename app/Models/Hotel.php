<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Providers\SapeServiceProvider;

class Hotel extends Model
{
	use HasFactory;

	public $fotos = [];

	public function getHotelsDescriptionAttribute ($val)
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
	* get town
	*/
	public function town()
	{
		return $this->belongsTo(Town::class, 'town_id', 'id');
	}
}