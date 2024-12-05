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
			$foto				= $row->fotos()
								->where('foto_type','country')
								->orderBy('foto_position')
								->limit(1)
								->get();
			if (count($foto) == 0) continue;
			$row['fotos']		= $foto;
			$row['fotoStr']		= !empty($row['fotos']) ? asset('fotos/countries/' . $row['fotos'][0]['foto_id'] . '.jpg') : asset ('image/no_foto.jpg');
		}
	}

	/**
	* get country by id
	* @return \Illuminate\Database\Eloquent\Collection 
	*/
	public function getById($id)
	{
		$country = Country::select('*')
			->where('countries_id', $id)
			->firstOrFail();
		return $country;
	}

	/**
	* create a country
	* @param  array $request
	* @return void
	*/	
	public function create($request) 
	{
		try {
			Country::create($request);
		} catch (\Exception $e) {
			throw new \Exception('Failed to create a Country '.$e->getMessage());
		}
	}

	/**
	* update a country
	* @param array $params
	* @return void
	*/	
	public function update($id, $params)
	{
		try {
			Country::find($id)->update($params);
		} catch (\Exception $e) {
			throw new \Exception('Failed to update the Country. '.$e->getMessage());
		}
	}

	
	/**
	* delete a country
	* @param  id $id
	* @return void
	*/
	public function destroy($id) {
		try {
			Country::find($id)->delete();
		} catch (\Exception $e) {
			throw new \Exception('Failed to delete Country . '.$e->getMessage());
		}
	}
}