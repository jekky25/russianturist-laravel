<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ItemService;
use App\Services\CountryService;
use App\Traits\BaseConfig;
use App\Traits\Pagination;
use App\Http\Resources\ItemResource;
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
		public CountryService 	$countryService
	)
	{
		$this->boardConfig = $this->getBoardConfig();
	}

	/**
	* Show the application dashboard.
	* @return \Illuminate\Http\Response
	*/
	public function index()
	{
		$boardConfig	= $this->boardConfig;
		$items			= $this->itemService->getAllByPaginate($this->countPerPage);
		$pagination		= $this->getPaginationLinks($items);
		$countries		= $this->countryService->getAll();
		$title 		= 'Статьи, русский турист, сайт про туризм и путешествия';
		$data = [
			'boardConfig'	=> $boardConfig,
			'arMeta'		=> ['title' => $title],
			'countries'		=> $countries,
			'items'			=> $items,
			'pagination'	=> $pagination,
			
		];
		return response()->view('items', $data);
	}

	/**
	* Show an item page
	* @param  int     $id
	* @return \Illuminate\Http\Response
	*/
	public function getItem($id)
	{
		$item			= $this->itemService->getById($id);
		$countries		= $this->countryService->getAll();
		$title			= $item['items_name'] . ', статья ' . $item['items_name'] . ', русский турист, сайт про туризм и путешествия';
		$data = [
			'boardConfig'	=> $this->boardConfig,
			'arMeta'		=> ['title' => $title],
			'countries'		=> $countries,
			'item'			=> $item
		];
		return response()->view('item_id', $data);
	}

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