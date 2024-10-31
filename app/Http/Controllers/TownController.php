<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\CountryService;
use App\Services\TownService;
use App\Services\HotelService;
use App\Http\Resources\CityResource;
use App\Http\Resources\CityFullResource;
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
		public CountryService	$countryService,
		public TownService		$townService,
		public HotelService		$hotelService
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
		$countries					= $this->countryService->getAll();
		$towns						= $this->townService->getAll();
		$title						= 'Города, русский турист, сайт про туризм и путешествия';
		\App\Providers\SapeServiceProvider::getSapeCode();

		$data = [
			'boardConfig'	=> $this->boardConfig,
			'arMeta'		=> ['title'	=>	$title],
			'towns'			=> $towns,
			'countries'		=> $countries,
		];
		return response()->view('towns', $data);
	}

	/**
	* Show a town page
	* @param  string  $name
	* @return \Illuminate\Http\Response
	*/
	public function getTown($name)
	{
		$town						=	$this->townService->getByName($name);
		$town						=	$this->townService->getPictureLink($town, $this->boardConfig['foto_width_town_id'], $this->boardConfig['foto_height_town_id']);
		$countries					=	$this->countryService->getAll();
		$hotels						=	$this->hotelService->getOfTown($town->towns_id, 0, $this->boardConfig['limit_out_hotels']);
		$title						=	$town['towns_name'] . ', ' . $town->country['countries_name'] . ', информация про город, сайт про туризм и путешествия';
		$data = [
			'boardConfig'	=> $this->boardConfig,
			'arMeta'		=> ['title'	=>	$title],
			'town'			=> $town,
			'countries'		=> $countries,
			'hotels'		=> $hotels,
		];
		return response()->view('town_id', $data);
	}

	/**
	* Get all cities 
	* @return json
	*/
	public function getCities()
	{
		$cities	= $this->townService->getAll();
		return CityResource::collection($cities);
	}

	/**
	* Show a city page
	* @param  string  $name
	* @return \Illuminate\Http\Response
	*/
	public function getCityByName($name)
	{
		$city	= $this->townService->getByName($name);
		$city	= $this->townService->getPictureLink($city, $this->boardConfig['foto_width_town_id'], $this->boardConfig['foto_height_town_id']);
		return new CityFullResource($city);
	}
}