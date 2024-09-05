<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\HotelService;
use App\Services\CountryService;
use App\Traits\BaseConfig;

class HomeController extends Controller
{
	use BaseConfig;
	public $boardingConfig 	= [];
	private $countHotels 	= 5;

	/**
	* Create a new controller instance.
	*
	* @return void
	*/
	public function __construct(
		public CountryService $countryService,
		public HotelService $hotelService
	)
	{
		$this->boardConfig = $this->getBoardConfig();
	}

	/**
	* Show the application dashboard.
	* 
	* @return \Illuminate\Http\Response
	*/
	public function index()
	{
		$hotels			= $this->hotelService->getByLimit($this->countHotels);
		$countries		= $this->countryService->getAll();
		
		$title 		= 'Страны, русский турист, сайт про туризм и путешествия';
		$arMeta = [
			'title' => $title
		];

		$data = [
			'boardConfig'	=> $this->boardConfig,
			'arMeta'		=> $arMeta,
			'countries'		=> $countries,
			'hotels'		=> $hotels,
		];
		return response()->view('home', $data);
	}
}