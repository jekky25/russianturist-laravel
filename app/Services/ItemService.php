<?php
namespace App\Services;

use App\Traits\BaseConfig;
use App\Models\Item;
use App\Services\LengthPager;

class ItemService
{
	use BaseConfig;

	public $boardConfig 	= [];

	public function __construct()
	{
		$this->boardConfig = $this->getBoardConfig();
	}

	/**
	* Get all items by pagination
	* @param  int  $count
	* @return \Illuminate\Database\Eloquent\Collection 
	*/
	public function getAllByPaginate($count)
	{
		$items = Item::select('*')->orderBy('create_time')->paginate($count);
		$items = LengthPager::makeLengthAware($items, $items->total(), $count);
		foreach ($items as &$row) 
		{
			$this->getFotos($row);
		}
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
		->first();

		$this->getFotos($item);
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
}