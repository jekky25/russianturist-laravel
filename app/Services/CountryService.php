<?php
namespace App\Services;

use App\Models\Country;

class CountryService
{
	private $countries;
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
	public function getAll($orderBy = 'countries_name')
	{
		$this->countries = Country::select('*')->orderBy($orderBy)->get();
		$this->addFotos();
		return $this->countries;
	}

	/**
	 * add pictures of the countries to the object
	 * @return void
	 */
	public function addFotos()
	{
		foreach ($this->countries as &$row) 
		{
			$foto               = $row->fotos()
				                ->where('foto_type','country')
				                ->orderBy('foto_position')
				                ->limit(1)
				                ->get();
			$row['fotos']       = $foto;
            $row['fotoStr'] 	= !empty ($row['fotos']) ? asset('fotos/countries/' . $row['fotos'][0]['foto_id'] . '.jpg') : asset ('image/no_foto.jpg');
        }
	}
}