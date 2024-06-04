<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Services\ItemService;
use App\Services\CountryService;
use App\Traits\BaseConfig;
use App\Traits\Pagination;

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function index(Request $request)
	{
		$boardConfig 	= $this->boardConfig;
		$items			= $this->itemService->getAllByPaginate($this->countPerPage);
		$pagination		= $this->getPaginationLinks ($items);
		$countries		= $this->countryService->getAll();

		$arMeta = [];

		$title 		= 'Статьи, русский турист, сайт про туризм и путешествия';

		$arMeta = [
			'title' => $title
		];

		$data = [
			'boardConfig'	=> $boardConfig,
			'arMeta'		=> $arMeta,
			'countries'		=> $countries,
			'items'			=> $items,
			'pagination'	=> $pagination,
			
		];
		return response()->view('items', $data);
	}

	/**
     * Show an item page
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int     $id
     * @return \Illuminate\Http\Response
     */
	public function getItem (Request $request, $id)
	{
		global $code_sape, $sape, $sape_context;

		$boardConfig 	= $this->boardConfig;
		$item			= $this->itemService->getById($id);
		$countries		= $this->countryService->getAll();


		$arMeta 		= [];
		
		
		$title 		= $item['items_name'] . ', статья ' . $item['items_name'] . ', русский турист, сайт про туризм и путешествия';
		$arMeta 	= [
			'title' => $title
		];
		
		$item['items_description'] = \App\Providers\SapeServiceProvider::replaceSapeCode($item['items_description']);

		$data = [
			'boardConfig'	=> $boardConfig,
			'arMeta'		=> $arMeta,
			'countries'		=> $countries,
			'item'			=> $item
		];
		return response()->view('item_id', $data);
	}
}