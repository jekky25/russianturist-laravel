<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Foto;

class Town extends Model
{
	use HasFactory;

	public function fotos()
	{
		return $this->hasMany(
			Foto::class,
			'foto_parent_id',
			'towns_id');
	}

	public function country()
	{
		return $this->belongsTo(Country::class, 'countries_id', 'countries_id');
	}

	public static function getByName($name)
	{
		$town = self::select('*')
				->where('towns_eng_name', $name)
				->first();

		$town->towns_description = str_replace("\n", "\n<br />\n", $town->towns_description);

		$town->country = $town->country()->first();

		$foto   = $town->fotos()
				->where('foto_type','town')
				->orderBy('foto_position')
				->first()
				->toArray();
		
		$town->foto	= $foto;
  
		return $town;
    }
}
