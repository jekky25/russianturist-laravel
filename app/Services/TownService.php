<?php
namespace App\Services;

use App\Models\Town;
use App\Services\ImageService;
use Illuminate\Support\Facades\DB;

class TownService
{
	private $towns;

	public function __construct(
		private ImageService $image
	)
	{
	}

	/**
	* get all towns
	* @return \Illuminate\Database\Eloquent\Collection 
	*/
	public function getAll()
	{
		$this->towns = Town::select('*')->with(['country', 'fotos'])->orderBy('name')->get();
		return $this->towns;
	}

	/**
	* get city by id
	* @return \Illuminate\Database\Eloquent\Collection 
	*/
	public function getById($id)
	{
		return Town::select('*')
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
			$city = Town::create($request);
			$this->image->create($city->id, Town::class, $request['image']);
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
			$city = Town::find($id);
			$city->update($request);
			$this->image->create($city->id, Town::class, $request['image']);
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
			$city = Town::find($id);
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
	* add pictures of the towns to the object
	* @return void
	*/
	public function getFotos()
	{
		foreach ($this->towns as &$row) 
		{
			$foto = $row->fotos()
				->where('type', Town::IMAGES_TYPE)
				->orderBy('position')
				->first();
			$row['fotos'] = $foto;
		
			$row['fotoStr']		= !empty($row['fotos']) ? asset('fotos/towns/' . $row['fotos']['id'] . '.jpg') : asset('image/no_foto.jpg');
		}
	}

	/**
	* get town by name
	* @param  string  $name
	* @return \Illuminate\Database\Eloquent\Collection 
	*/
	public function getByName($name)
	{
		$town = Town::select('*')
				->where('slug', $name)
				->first();
		$town->description = str_replace("\n", "\n<br />\n", $town->description);
		$town->country = $town->country()->first();
		$foto   = $town->fotos()
				->where('type','town')
				->orderBy('position')
				->first();
		$town->foto	= $foto;
		return $town;
	}

	/**
	* get a picture link
	* @param  \Illuminate\Database\Eloquent\Collection $town
	* @param  int $width
	* @param  int $height
	* @return \Illuminate\Database\Eloquent\Collection 
	*/
	public function getPictureLink($town, $width, $height)
	{
		$foto_out 					= !empty($town->foto) ? asset('/fotos/towns/' . $town->foto['id'] . '.jpg') : '';
		$town->towns_img 			= !empty($foto_out) ? '<img title="' . $town->name . '" alt="' . $town->name . '" src="' . $foto_out . '" width="' . $width . '" height="' . $height . '">' : '';
		return $town;
	}
}