<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BaseConfig;
use App\Models\Foto;
use App\Traits\Tstr;

class Country extends Model
{
	use HasFactory, BaseConfig, Tstr;

	public $boardConfig = [];

	/**
	* Create a new controller instance.
	*
	* @return void
	*/
	public function __construct()
	{
		$this->boardConfig = $this->getBoardConfig();
	}

	public function getCountriesDescriptionAttribute ($val)
	{
		return $this->replaceSpaces($val);
	}

	public function getCountriesImgAttribute ()
	{
		$foto = asset('fotos/countries/'. $this['foto']['foto_id'] . '.jpg');
		return !empty($foto) ? '<img title="' . $this['countries_name'] . '" alt="' . $this['countries_name'] . '" src="' . $foto . '" width="' . $this->boardConfig['foto_width_country_id'] . '" height="' . $this->boardConfig['foto_height_country_id'] . '">' : '';
	}

	/**
	* get fotos
	*/
	public function fotos()
	{
		return $this->hasMany(Foto::class, 'foto_parent_id', 'countries_id');
	}
}