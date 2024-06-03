<?php
namespace App\Services;

use App\Models\Country;

class CountryService
{
	/**
	 * get country by name
	 * @param  string  $name
	 * @return \Illuminate\Database\Eloquent\Collection 
	*/
	public function getByName($name)
	{
		$country = Country::select('*')
				->where('countries_eng_name', $name)
				->first();

		$foto   = $country->fotos()
				->where('foto_type','country')
				->orderBy('foto_position')
				->first()
				->toArray();

		$country['foto']	= $foto;
		return $country;
	}

	/**
	 * get all countries
	 * @param  string  $orderBy
	 * @return \Illuminate\Database\Eloquent\Collection 
	 */
	public function getAll($orderBy)
	{
		return Country::select('*')->orderBy($orderBy)->get();
	}
}