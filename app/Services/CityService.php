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
		$this->cities = City::select('*')->with(['country', 'fotos'])->orderBy('name')->get();
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
			->with(['country', 'fotos'])
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
			if ($city->fotos->count() > 0)
			{
				foreach ($city->fotos as $foto)
				{
					$this->image->destroyFoto($foto);
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
	public function getFotos()
	{
		foreach ($this->cities as &$row) 
		{
			$foto = $row->fotos()
				->where('type', City::IMAGES_TYPE)
				->orderBy('position')
				->first();
			$row['fotos'] = $foto;
		
			$row['fotoStr']		= !empty($row['fotos']) ? asset('fotos/cities/' . $row['fotos']['id'] . '.jpg') : asset('image/no_foto.jpg');
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
		$foto   = $city->fotos()
				->where('type','city')
				->orderBy('position')
				->first();
		$city->foto	= $foto;
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
		$foto_out 					= !empty($city->foto) ? asset('/fotos/citys/' . $city->foto['id'] . '.jpg') : '';
		$city->cities_img 			= !empty($foto_out) ? '<img title="' . $city->name . '" alt="' . $city->name . '" src="' . $foto_out . '" width="' . $width . '" height="' . $height . '">' : '';
		return $city;
	}
}