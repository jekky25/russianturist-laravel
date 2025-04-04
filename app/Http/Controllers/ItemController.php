<?php

namespace App\Http\Controllers;

use App\Traits\BaseConfig;
use App\Traits\Pagination;
use App\Services\ItemService;
use App\Http\Resources\ItemResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\ItemFullResource;

class ItemController extends Controller
{
	use BaseConfig, Pagination;
	public $boardingConfig 	= [];
	public $countPerPage 	= 30;
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(
		public ItemService 		$itemService,
	) {}
	/**
	 * Get all items
	 * @return json
	 */
	public function getItems()
	{
		$items	= $this->itemService->getAllByPaginate($this->countPerPage);
		return ItemResource::collection($items);
	}

	/**
	 * Show an item page
	 * @param  string  $id
	 * @return \Illuminate\Http\Response
	 */
	public function getItemById($id)
	{
		$item			= $this->itemService->getById($id);
		return new ItemFullResource($item);
	}
}
