<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Foto;

class Town extends Model
{
	use HasFactory;

	/**
     * get fotos
     */
	public function fotos()
	{
		return $this->hasMany(
			Foto::class,
			'foto_parent_id',
			'towns_id');
	}

	/**
     * get country
     */
	public function country()
	{
		return $this->belongsTo(Country::class, 'countries_id', 'countries_id');
	}
}
