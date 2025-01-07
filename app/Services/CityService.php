<?php
namespace App\Services;

use App\Models\City;
use App\Services\ImageService;
use Illuminate\Support\Facades\DB;

class CityService
{
	private $cities;

	public function __construct(
		private ImageService $image
	)
	{
	}

	/**
	* get all cities
	* @return \Illuminate\Database\Eloquent\Collection 
	*/
	public function getAll()
	{
		$this->cities = City::select('*')->with(['country', 'pictures'])->orderBy('name')->get();
		return $this->cities;
	}

	/**
	* get city by id
	* @return \Illuminate\Database\Eloquent\Collection 
	*/
	public function getById($id)
	{
		return City::select('*')
			->where('id', $id)
			->with(['country', 'pictures'])
			->firstOrFail();
	}

	/**
	* create a city
	* @param  array $request
	* @return void
	*/	
	public function create($request) 
	{
		try {
			DB::beginTransaction();
			$city = City::create($request);
			$this->image->create($city->id, City::class, $request['image']);
			DB::commit();
		} catch (\Exception $e) {
			DB::rollBack();
			throw new \Exception('Failed to create a City '.$e->getMessage());
		}
	}

	/**
	* update a city
	* @param array $request
	* @return void
	*/	
	public function update($id, $request)
	{
		try {
			DB::beginTransaction();
			$city = City::find($id);
			$city->update($request);
			if (!empty($request['image'])) $this->image->create($city->id, City::class, $request['image']);
			DB::commit();
		} catch (\Exception $e) {
			DB::rollBack();
			throw new \Exception('Failed to update the City. '.$e->getMessage());
		}
	}

	/**
	* delete a city
	* @param  id $id
	* @return void
	*/
	public function destroy($id) {
		try {
			$city = City::find($id);
			if ($city->pictures->count() > 0)
			{
				foreach ($city->pictures as $picture)
				{
					$this->image->destroyPicture($picture);
				}
			}
			$city->delete();
		} catch (\Exception $e) {
			throw new \Exception('Failed to delete Country . '.$e->getMessage());
		}
	}

	/**
	* add pictures of the cities to the object
	* @return void
	*/
	public function getPictures()
	{
		foreach ($this->cities as &$row) 
		{
			$picture = $row->pictures()
				->where('type', City::IMAGES_TYPE)
				->orderBy('position')
				->first();
			$row['pictures'] = $picture;
		
			$row['pictureStr']		= !empty($row['pictures']) ? asset('fotos/cities/' . $row['pictures']['id'] . '.jpg') : asset('image/no_foto.jpg');
		}
	}

	/**
	* get city by name
	* @param  string  $name
	* @return \Illuminate\Database\Eloquent\Collection 
	*/
	public function getByName($name)
	{
		$city = City::select('*')
				->where('slug', $name)
				->first();
		$city->description = str_replace("\n", "\n<br />\n", $city->description);
		$city->country = $city->country()->first();
		$picture   = $city->pictures()
				->where('type','city')
				->orderBy('position')
				->first();
		$city->picture	= $picture;
		return $city;
	}

	/**
	* get a picture link
	* @param  \Illuminate\Database\Eloquent\Collection $city
	* @param  int $width
	* @param  int $height
	* @return \Illuminate\Database\Eloquent\Collection 
	*/
	public function getPictureLink($city, $width, $height)
	{
		$picture_out 				= !empty($city->picture) ? asset('/fotos/citys/' . $city->picture['id'] . '.jpg') : '';
		$city->cities_img 			= !empty($picture_out) ? '<img title="' . $city->name . '" alt="' . $city->name . '" src="' . $picture_out . '" width="' . $width . '" height="' . $height . '">' : '';
		return $city;
	}
}