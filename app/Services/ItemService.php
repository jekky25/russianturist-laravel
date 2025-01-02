<?php
namespace App\Services;

use App\Traits\BaseConfig;
use App\Models\Item;
use App\Models\Foto;
use App\Services\LengthPager;
use Illuminate\Support\Facades\DB;
use App\Services\ImageService;

class ItemService
{
	use BaseConfig;

	public $boardConfig 	= [];
	public $items;

	public function __construct(private ImageService $image)
	{
		$this->boardConfig = $this->getBoardConfig();
	}

	/**
	 * get all hotels
	 * @return \Illuminate\Database\Eloquent\Collection 
	 */
	public function getAll()
	{
		$this->items = Item::select('*')->with(['fotos'])->orderBy('id')->get();
		return $this->items;
	}

	/**
	* Get all items by pagination
	* @param  int  $count
	* @return \Illuminate\Database\Eloquent\Collection 
	*/
	public function getAllByPaginate($count)
	{
		$items = Item::select('*')->with(['fotos'])->orderBy('create_time')->paginate($count);
		$items = LengthPager::makeLengthAware($items, $items->total(), $count);
		$items->withPath('/items/');
		return $items;
	}

	/**
	* get item by id
	* @param int $id
	* @return \Illuminate\Database\Eloquent\Collection 
	*/
	public function getById($id)
	{
		$item = Item::select('*')
		->where('id', $id)
		->with(['fotos'])
		->first();
		return $item;
	}

	/**
	 * get pictures of the items to the object
	 * @param \Illuminate\Database\Eloquent\Collection $row 
	 * @return void
	 */
	public function getFotos(&$row)
	{
		$foto = $row->fotos()
			->where('type','item')
			->orderBy('position')
			->first();
		$row['fotos'] = $foto;
		
		$row['fotoStr']		= !empty ($row['fotos']) ? asset('fotos/items/' . $row['fotos']['id'] . '.jpg') : asset ('image/no_foto.jpg');

		$foto_out = asset('fotos/items/'. $row['fotos']['id'] . '.jpg');
		$row['items_img'] = !empty($foto_out) ? '<img title="' . $row['name'] . '" alt="' . $row['name'] . '" src="' . $foto_out . '" width="' . $this->boardConfig['foto_width_item_id'] . '" height="' . $this->boardConfig['foto_height_item_id'] . '">' : '';
	}

	/**
	* create an item
	* @param  array $request
	* @return void
	*/	
	public function create($request) 
	{
		try {
			DB::beginTransaction();
			$request['create_time']	= time();
			$item = Item::create($request);
			$this->image->create($item->id, Item::class, $request['image']);
			DB::commit();
		} catch (\Exception $e) {
			DB::rollBack();
			throw new \Exception('Failed to create an Item '.$e->getMessage());
		}
	}

	/**
	* update an Item
	* @param array $request
	* @return void
	*/	
	public function update($id, $request)
	{
		try {
			DB::beginTransaction();
			$item = Item::find($id);
			$item->update($request);
			$this->image->create($item->id, Item::class, $request['image']);
			DB::commit();
		} catch (\Exception $e) {
			DB::rollBack();
			throw new \Exception('Failed to update the Item. '.$e->getMessage());
		}
	}

	/**
	* delete a item
	* @param  id $id
	* @return void
	*/
	public function destroy($id) {
		try {
			$item = Item::find($id);
			if ($item->fotos->count() > 0)
			{
				foreach ($item->fotos as $foto)
				{
					$this->image->destroyFoto($foto);
				}
			}
			$item->delete();
		} catch (\Exception $e) {
			throw new \Exception('Failed to delete Item . '.$e->getMessage());
		}
	}
}