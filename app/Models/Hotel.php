<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
	use HasFactory;

	public $fotos = [];

	public function fotos()
	{
		return $this->hasMany(
			Foto::class,
			'foto_parent_id',
		'hotels_id');
	}

	public function town()
	{
		return $this->belongsTo(Town::class, 'towns_id', 'towns_id');
	}

	public function getByName($name)
	{
		$hotel = self::select('*')
			->where('hotels_eng_name', $name)
			->first();
  
		$hotel->hotels_description 	= str_replace("\n", "\n<br />\n", $hotel->hotels_description);
		$hotel->town 				= $hotel->town()->first();
		$fotos   					= $hotel->fotos()
			->where('foto_type','hotel')
			->orderBy('foto_position')
			->get()
			->toArray();
      
		$hotel->fotos	= $fotos;
		return $hotel;
	}
}
