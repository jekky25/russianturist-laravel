<?php
namespace App\Services;

use App\Models\Country;
use App\Services\ImageService;

class CountryService
{
	private $countries;

	public function __construct(
		private ImageService $image
	)
	{
	}

	/**
	 * get country by name
	 * @param  string  $name
	 * @return \Illuminate\Database\Eloquent\Collection 
	*/
	public function getByName($name)
	{
		$country = Country::select('*')
				->where('slug', $name)
				->first();

		$country->description = str_replace("\n", "\n<br />\n", $country->description);
		return $country;
	}

	/**
	 * get all countries
	 * @param  string  $orderBy
	 * @return \Illuminate\Database\Eloquent\Collection 
	 */
	public function getAll($orderBy = 'name')
	{
		$this->countries = Country::select('*')->orderBy($orderBy)->get();
		$this->addPictures();
		return $this->countries;
	}

	/**
	* add pictures of the countries to the object
	* @return void
	*/
	public function addPictures()
	{
		foreach ($this->countries as &$row) 
		{
			$row['pictureStr'] = asset($row->image_path);
		}
	}

	/**
	* get country by id
	* @return \Illuminate\Database\Eloquent\Collection 
	*/
	public function getById($id)
	{
		$country = Country::select('*')
			->where('id', $id)
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
			$request['image'] = $this->image->put(Country::IMAGES_DIRECTORY, $request['image']);
			Country::create($request);
		} catch (\Exception $e) {
			throw new \Exception('Failed to create a Country '.$e->getMessage());
		}
	}

	/**
	* update a country
	* @param array $request
	* @return void
	*/	
	public function update($id, $request)
	{
		try {
			$country = Country::find($id);
			if (!empty($request['image'])) $request['image'] = $this->image->update($country->ImagePath, Country::IMAGES_DIRECTORY, $request['image']);
			$country->update($request);
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
			$country = Country::find($id);
			$this->image->destroy($country->ImagePath);
			$country->delete();
		} catch (\Exception $e) {
			throw new \Exception('Failed to delete Country . '.$e->getMessage());
		}
	}
}