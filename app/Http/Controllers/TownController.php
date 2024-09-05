<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\CountryService;
use App\Services\TownService;
use App\Services\HotelService;
use App\Traits\BaseConfig;

class TownController extends Controller
{
	use BaseConfig;
	public $boardingConfig = [];
	/**
    * Create a new controller instance.
     *
     * @return void
     */
	public function __construct(
		public CountryService 	$countryService,
		public TownService 		$townService,
		public HotelService		$hotelService
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
		$countries					= $this->countryService->getAll();
		$towns						= $this->townService->getAll();
		$arMeta = [];

		$title 		= 'Города, русский турист, сайт про туризм и путешествия';
		$arMeta = [
			'title' => $title
		];

		$sapeCode 	= \App\Providers\SapeServiceProvider::getSapeCode();

		$data = [
			'boardConfig'	=> $this->boardConfig,
			'arMeta'		=> $arMeta,
			'towns'			=> $towns,
			'countries'		=> $countries,
		];
		return response()->view('towns', $data);
	}

	/**
     * Show a town page
	 * @param  \Illuminate\Http\Request  $request
	 * @param  string  $name
     * @return \Illuminate\Http\Response
     */
	public function getTown (Request $request, $name)
	{
		$town						= $this->townService->getByName($name);
		$town						= $this->townService->getPictureLink($town, $this->boardConfig['foto_width_town_id'], $this->boardConfig['foto_height_town_id']);
		$town->towns_description 	= \App\Providers\SapeServiceProvider::replaceSapeCode($town->towns_description);
		$countries					= $this->countryService->getAll();
		$hotels 					= $this->hotelService->getOfTown($town->towns_id, 0, $this->boardConfig['limit_out_hotels']);

		$arMeta 					= [];

		$title = $town['towns_name'] . ', ' . $town->country['countries_name'] . ', информация про город, сайт про туризм и путешествия';
		$arMeta = [
			'title' => $title
		];

		$data = [
			'boardConfig'	=> $this->boardConfig,
			'arMeta'		=> $arMeta,
			'town'			=> $town,
			'countries'		=> $countries,
			'hotels'		=> $hotels,
		];
		return response()->view('town_id', $data);
	}
}
